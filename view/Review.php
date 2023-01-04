<?php session_start(); 
  if(!isset($_SESSION['id'])){
    header("Location: login.php");
  }
  if(isset($_POST['komen'])){
    require '../config.php';
    $insertOneResult = $collection_review->insertOne([
        'id_driver' =>$_POST['id_driver'],
        'id_customer' => $_SESSION['id'],
        'rating' => $_POST['rating'],
        'komentar' => $_POST['komentar'],
    
    ]);
      header("Location: page2.php");
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
    <style>
      .rating{
        display: flex;
        padding: 0;
        margin: 0;
      }

      .rating li {
        list-style-type: none;
      }

      .rating-item {
        border: 1px solid #fff;
        cursor: pointer;
        font-size: 2em;
        color: yellowgreen;
      }

      .rating-item::before {
        content: "\2605";
      }

      .rating-item.active ~ .rating-item::before{
        content: "\2606";
      }



    </style>
  </head>
  <body class="m-auto d-flex justify-content-center">

<?php
			require '../config.php';
      $terms = ['_id' => new MongoDB\BSON\ObjectId($_GET['id_transaksi'])];
			$transaksi = $collection_transaksi->findOne($terms);

      $terms = ['_id' => $transaksi->id_driver];
			$driver = $collection_driver->findOne($terms);
      
      echo "
    <div class='my-5 d-flex justify-content-center'>
      <div class='row'>
        <div class='container'>
          <div class='card'>
              <div class='card-body'>
                <h3 class='text-center'>". $driver['nama']."</h3>
                <div class='row'>
                  <div class='col'>
                    <p class='text-center'>".$transaksi['metode_transaksi']."</p>
                  </div>
                  <div class='col'>
                    <p class='text-center'>Rp ".$transaksi['total_biaya']."</p>
                  </div>
                </div>
                
                <form action='Review.php' method='post'>
                <div class='mb-3'>
                <label for='rating' class='form-label'>Beri Rating</label>
                <select class='form-select' name='rating' id='rating' aria-label='Beri Penilaian'>
                    <option value='5'>5</option>
                    <option value='4'>4</option>
                    <option value='3'>3</option>
                    <option value='2'>2</option>
                    <option value='1'>1</option>
                  </select>
              </div>
                  <div class='form-floating mt-1 mb'>
                    <textarea class='form-control' name='komentar' placeholder='Leave a comment here' id='floatingTextarea' style='width:300px; height:200px;resize:none'></textarea>
                    <label for='floatingTextarea'>Comments</label>
                  </div>
                  <input type='hidden' name='id_driver' value='".$driver['_id']."'>
                  <div class='d-flex justify-content-center mt-5'>
                  <button type='submit' name='komen' class='btn btn-danger' >Beri Nilai</button>
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>;
      ";?>
  </div>

    <script>

      const container = document.querySelector('.rating');
  
      const items = container.querySelectorAll('.rating-item')

      container.onclick = e =>{
        const elClass = e.target.classList;
        if (!elClass.contains('active')) {
          items.forEach(
            item => item.classList.remove('active')
          );
          console.log(e.target.getAttribute("data-rate"));
          elClass.add('active');
        }
      };


    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>