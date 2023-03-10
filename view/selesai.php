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
    <title>Perjalanan Selesai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="../style/style.css" rel="stylesheet">
  </head>
  <body class="m-auto d-flex justify-content-center">
    
    <div class="position-absolute top-50 start-50 translate-middle row">
      <div class="card p-5">
        <h1 class="text-center">Driver Telah Mengantar Sesuai Tujuan Anda</h1>

        <div class="col d-flex justify-content-center">
          <?php 
          $id_transaksi = $_GET['id_transaksi'];
            echo "<a href='Review.php?id_transaksi=$id_transaksi' class='btn btn-warning me-3'>Berikan Penilaian</a>";
            ?>
            <a href="index.php" class="btn btn-success">Selesai</a>
        </div>
      </div>    
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>