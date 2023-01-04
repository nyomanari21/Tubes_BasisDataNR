<?php session_start();

  if(!isset($_SESSION['id'])){
    header("Location: login.php");
  }
  else{
    if(isset($_POST['submit_2'])){
        require '../config.php';
        $terms = ['_id' => $_SESSION['id']];
        $user = $collection->findOne($terms);
    
        if($_POST['metode_transaksi'] == "gopay"){
          if($user['gopay']['saldo'] < $_POST['total_biaya']){
            
            $message = "Saldo Gopay Tidak Cukup";
            echo "<script type='text/javascript'>alert('$message');</script>";
          }
          else{
            $awal = $user['gopay']['saldo'];
            $hasil = $awal - $_POST['total_biaya'];
            $collection->updateOne(
              ['_id' => $_SESSION['id']],
              [array('$set' => array('gopay.saldo' => $hasil))]
            );

            date_default_timezone_set("Asia/Jakarta");
            $insertOneResult = $collection_transaksi->insertOne([
                'id_driver' =>new MongoDB\BSON\ObjectId($_POST['id_driver']),
                'id_customer' => $_SESSION['id'],
                'lokasi_penjemputan' => $_POST['lokaski_Penjemputan'],
                'lokasi_tujuan' => $_POST['lokasi_Tujuan'],
                'id_promo' => $_POST['id_promo'],
                'total_biaya' => $_POST['total_biaya'],
                'waktu_pemesanan' => new MongoDB\BSON\UTCDateTime((new DateTime($today))->getTimestamp()*1000),
                'metode_transaksi' => $_POST['metode_transaksi'],
            ]);
            $id_transaksi = $insertOneResult->getInsertedId();
            
            $insertOneResult = $collection_riwayat->insertOne([
                'id_user' => $_SESSION['id'],
                'riwayat' => [
                    'tanggal' => new MongoDB\BSON\UTCDateTime((new DateTime($today))->getTimestamp()*1000),
                    'keterangan' => "Pemakaian Gojek",
                    'simbol' => "-",
                    'jumlah' => $_POST['total_biaya'],
                    'saldo_awal' => $awal,
                    'saldo_akhir' => $hasil,
                ]
            ]);
            
            
            header("Location: selesai.php?id_transaksi=$id_transaksi");
          }
        }
        else{
            $insertOneResult = $collection_transaksi->insertOne([
                'id_driver' =>new MongoDB\BSON\ObjectId($_POST['id_driver']),
                'id_customer' => $_SESSION['id'],
                'lokasi_penjemputan' => $_POST['lokaski_Penjemputan'],
                'lokasi_tujuan' => $_POST['lokasi_Tujuan'],
                'id_promo' => $_POST['id_promo'],
                'total_biaya' => $_POST['total_biaya'],
                'waktu_pemesanan' => new MongoDB\BSON\UTCDateTime((new DateTime($today))->getTimestamp()*1000),
                'metode_transaksi' => $_POST['metode_transaksi'],
            ]);
            $id_transaksi = $insertOneResult->getInsertedId();
            header("Location: selesai.php?id_transaksi=$id_transaksi");
        }
      }
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Driver Ditemukan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="../style/style.css" rel="stylesheet">
  </head>
  <body class="m-auto d-flex justify-content-center">
    
    <div class="position-absolute top-50 start-50 translate-middle row">
      <div class="card p-5">
        <h1 class="text-center">Driver Telah Ditemukan</h1>
        <?php
            require '../config.php';
            $driver = $collection_driver->findOne();
            echo "<h3> Driver: $driver[nama] <h3>";
        ?>
        <h3>Lokasi Tujuan: <?php echo $_POST['lokTujuan']?></h3>
        <div class="col d-flex justify-content-center">
            <form action="driverditemukan.php"method="post">
                  <?php
                  require '../config.php';
                  $driver = $collection_driver->findOne();
                  echo "<input type='hidden' name='id_driver' value='$driver[_id]' required>";
                  ?>

                  <input type="hidden" name="lokasi_Tujuan" value="<?php echo $_POST['lokTujuan']?>" required>
                  <input type="hidden" name="lokaski_Penjemputan" value="<?php echo $_POST['lokSekarang']?>" required>
                  <input type="hidden" name="id_promo" value="<?php echo $_POST['promo'] ?>">
                  <input type="hidden" name="total_biaya" value="<?php echo $_POST['harga']?>">
                  <input type="hidden" name="metode_transaksi" value="<?php echo $_POST['pembayaran']?>">
                <button type="submit" name="submit_2" class="btn btn-danger" >Mulai Perjalanan</button>
            </form>
        </div>
      </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>