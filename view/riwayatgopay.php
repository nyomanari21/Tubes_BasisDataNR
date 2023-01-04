<?php session_start();
  if(!isset($_SESSION['id'])){
    header("Location: login.php");
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Go-Pay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="../style/style.css" rel="stylesheet">
  </head>
  <body class="container">
  
  <?php
    require '../config.php';
    $terms = ['id_user' => $_SESSION['id']];
    $options = ['sort' => ['riwayat.tanggal' => -1]];
    $user_history = $collection_riwayat->find($terms, $options);

    $terms = ['_id' => $_SESSION['id']];
    $user = $collection->findOne($terms);
    echo "  <h1 class='text-center mt-5'>Riwayat Transaksi Go-Pay Anda</h1>
            <h1 class='text-center '>Total Saldo: Rp ".$user['gopay']['saldo']."</h1>
            <div class='mx-5 px-5'>
                <a href='index.php' class='btn btn-danger ms-5 ' >Kembali</a>
            </div>
            <div class='mx-5 px-5'>";

    
    foreach ($user_history as $hs) {

        echo "<div class='card m-5 p-5' style='widht: 100px !important;'>
                <h4 class='card-title'>".$hs['riwayat']['simbol']."".$hs['riwayat']['jumlah']."</h4>
                <p class='card-text'>".$hs['riwayat']['keterangan']."</p>
                <p class='card-text'>". $hs['riwayat']['tanggal']->toDateTime()->format(\DateTime::ISO8601)."</p>
                <h4 class='card-text'>Saldo Akhir: Rp ". $hs['riwayat']['saldo_akhir']."</h4>
              </div>";
    }
  ?>
  </div>
      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>