<?php session_start();
    require '../config.php';
    if(isset($_POST['login'])){
        $user = $collection->findOne(['email' => $_POST['loginEmail']]);
        
        if($user){ 
            $password = md5($_POST['loginPassword']);
            if($password == $user['password']){
                $_SESSION['id'] = $user['_id'];
                // login sukses, alihkan ke halaman timeline
                header("Location: index.php");
            }
            else{
                $message = "Password Salah";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }
        else{
            $message = "Email Salah";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }

   }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    
    <!-- Form Login -->
    <section>
        <div class="container-fluid h-10">
            <div class="row">
                <!-- Image -->
                <div class="col" style="
                background-image: url(https://upload.wikimedia.org/wikipedia/it/6/61/Death_Stranding_-_Sam_%28trailer%29.png); background-position: center;
                background-size: cover;
                background-repeat: no-repeat;
                background-attachment: fixed;">
                    <!-- <img src="https://upload.wikimedia.org/wikipedia/it/6/61/Death_Stranding_-_Sam_%28trailer%29.png" class="img-fluid" alt="img"> -->
                </div>
                <!-- Forms -->                                                                                                                                                                                                      
                <div class="col mt-5">
                    <h1 class="text-center mb-5">
                        Selamat Datang!
                        <br>
                        Silahkan Login
                    </h1>
                    <form class="container" action="login.php" method="post">
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" name="loginEmail" aria-describedby="emailHelp" required>
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" name="loginPassword" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-success">Masuk</button>
                    </form>
                    <p class="container mt-3">Belum punya akun? <a href="register.php">Daftar sekarang!</a></p>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>