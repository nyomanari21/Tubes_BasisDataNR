<?php session_start();
   if(isset($_POST['register'])){
      require '../config.php';
      $insertOneResult = $collection->insertOne([
          'nama' => $_POST['nama'],
          'email' => $_POST['email'],
          'password' => md5($_POST['password']),
          'notelp' => $_POST['notelp'],
          'gopay'=> array('saldo' => 0),
      ]);
      $_SESSION['id'] = $insertOneResult->getInsertedId();
      $_SESSION['success'] = "Data Berhasil di tambahkan";
      header("Location: index.php");
   }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="../style/style.css" rel="stylesheet">
  </head>
  <body>
    
    <!-- Form Register -->
    <section>
        <div class="container-fluid">
            <div class="row">
                <!-- Image -->
                <div class="col">
                    <img src="https://upload.wikimedia.org/wikipedia/it/6/61/Death_Stranding_-_Sam_%28trailer%29.png" class="img-fluid" alt="img">
                </div>
                <!-- Forms -->                                                                                                                                                                                                      
                <div class="col mt-5">
                    <h1 class="text-center mb-5">
                        Ayo buat akun baru!
                    </h1>
                    <form class="container" action="register.php" method="POST">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" aria-describedby="namaHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="notelp" class="form-label">No Telepon</label>
                            <input type="notelp" class="form-control" name="notelp">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <button type="submit" name="register" class="btn btn-success me-4">Daftar</button>
                    </form>
                    <p class="container mt-3">Sudah punya akun? <a href="login.php">Masuk sekarang!</a></p>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>