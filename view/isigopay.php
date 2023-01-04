<?php session_start();
    if(!isset($_SESSION['id'])){
        header("Location: login.php");
    }

    if(isset($_POST['tambah'])){
        require '../config.php';
        $terms = ['_id' => $_SESSION['id']];
        $user = $collection->findOne($terms);

        $saldoLama = $user['gopay']['saldo'];
        $saldoBaru = $saldoLama + $_POST['tambahSaldo'];

        // Update saldo gopay
          $collection->updateOne(
              ['_id' => $_SESSION['id']],
              [array('$set' => array('gopay.saldo' => $saldoBaru))]

        );

        $insertOneResult = $collection_riwayat->insertOne([
            'id_user' => $_SESSION['id'],
            'riwayat' => [
                'tanggal' => new MongoDB\BSON\UTCDateTime((new DateTime($today))->getTimestamp()*1000),
                'keterangan' => "Top Up Saldo Go-Pay",
                'simbol' => "+",
                'jumlah' => $_POST['tambahSaldo'],
                'saldo_awal' => $saldoLama,
                'saldo_akhir' => $saldoBaru,
            ]
        ]);

        header("Location: index.php");
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Isi Go-Pay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="../style/style.css" rel="stylesheet">
  </head>
  <body>

  <h1 class="text-center m-5">Isi Saldo Go-Pay</h1>

    <div class="d-flex justify-content-center">
        <form action="isigopay.php" method="POST">
            <div class="mb-3">
                <label for="tambahSaldo" class="form-label">Masukkan jumlah saldo</label>
                <input type="number" class="form-control" id="tambahSaldo" name="tambahSaldo">
                <div id="isiSaldoHelp" class="form-text">Masukkan tanpa tanda koma<br>contoh: 50000</div>
            </div>
            <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
            <a href="index.php"><div class="btn btn-danger ms-5">Batal</div></a>
        </form>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>