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
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="../style/style.css" rel="stylesheet">
  </head>
  <body>

  <?php

?>

    <!-- Navbar -->
    <section>
      <nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.html">Jek-Go</a>
          <div class="d-flex">
            <a class="text-decoration-none text-white" href="logout.php">
              <div class="btn btn-danger">
                Logout</div></a>
          </div>
        </div>
      </nav>
    </section>
    
 <!-- Profile -->
    <?php
			require '../config.php';
      $terms = ['_id' => $_SESSION['id']];
			$user = $collection->findOne($terms);
      
      echo "<section>
        <div class='m-3'>
          <!-- Card Profile -->
          <div class='card mb-3' style='width: 18rem;'>
            <div class='card-body text-center'>
              <h5 class='card-title'>Profile</h5>
              <h6 class='card-subtitle mb-2 text-muted'>$user->nama</h6>
              <p class='card-text'>
                $user->email
                <br>
                $user->notelp
              </p>
            </div>
          </div>
   
    
        
      

        <!-- Card Go-Pay -->
        <div class='card' style='width: 18rem;'>
          <div class='card-body text-center'>
            <h5 class='card-title'>Saldo Go-Pay</h5>
            <h6 class='card-subtitle mb-2 text-muted'>Rp". $user['gopay']['saldo']. "</h6>
            <div class='row'>
              <div class='col'>
                <a href='isigopay.php' class='btn btn-primary'>Isi Gopay</a>
              </div>
              <div class='col'>
              <a href='riwayatgopay.php' class='btn btn-danger'>Riwayat</a>
              </div>
            </div>
            
          </div>
        </div>";
        ?>
      </div>
    </section>

    <!-- Pesan GoRide -->
    <section class="m-auto d-flex justify-content-center">
      <div class="position-absolute top-50 start-50 translate-middle row">
        <div class="card p-5">
          <h1 class="text-center">Selamat Datang Di Jek-Go</h1>
          <a href="caridriver.php" class="btn btn-success">Gunakan GoRide</a>
        </div>
          
      </div>
    </section>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>

