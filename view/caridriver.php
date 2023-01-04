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
    <title>Cari Driver</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="../style/style.css" rel="stylesheet">
  </head>
  <body class="my-5 d-flex justify-content-center">

  <div class="row">
    <div class="container" style="width: 900px;">
      <div class="card mb-4"  >
          <div class="card-body">
            <p class="text-center fw-bold fs-5 ">Mau ke Mana Hari ini?</p>

              <div class="mb-3">
                <label for="lokasiSekarang" class="form-label">Pilih titik penjemputan</label>
                <input type="text" class="form-control" id="lokasiSekarang" name="lokasiSekarang" placeholder="Lokasi Saat Ini" required>
              </div>
              <div class="mb-3">
                <label for="lokasiTujuan" class="form-label">Pilih titik tujuan</label>
                <input type="text" class="form-control" id="lokasiTujuan" name="lokasiTujuan" placeholder="Lokasi Tujuan" required>
              </div>
              <div class="mb-3">
                <label for="kendaraan" class="form-label">Pilih tipe kendaraan</label>
                <select class="form-select" name="kendaraan" id="kendaraan" aria-label="Tipe Kendaraan">
                    <option value="motor">Motor</option>
                    <option value="mobil">Mobil</option>
                  </select>
              </div>
              <div class="mb-3">
                  <label for="promo" class="form-label">Masukkan kode promo</label>
                  <input type="text" class="form-control" name="promo" id="promo" placeholder="promo">
              </div>
              <div class="mb-3">
                  <label for="pembayaran" class="form-label">Pilih metode pembayaran</label>
                  <p>
                    <?php require '../config.php';
                    $terms = ['_id' => $_SESSION['id']];
                    $user = $collection->findOne($terms);
                    echo $user['gopay']['saldo']?>
                  </p>
                  <select class="form-select" name="pembayaran" id="pembayaran" aria-label="Pembayaran">
                      <option value="gopay">Go-Pay</option>
                      <option value="cash">Cash</option>
                    </select>
              </div>
              
              <div class="row">
                <div class="col">
                  <a href="index.php">
                    <div class="btn btn-danger">Kembali</div>
                  </a>
                </div>
                <div class="col d-flex justify-content-end">
                  <div class="btn btn-primary" onclick="get()">Cari</div>
                </div>
              </div>
              
          </div>
      </div>
      <div class="d-flex justify-content-center" >
        <div class="all-Driver-cards row"></div>
      </div>
    </div>
  </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
      function get() {
        var lokasiTujuan = document.getElementById("lokasiTujuan").value;
        var lokasiSekarang = document.getElementById("lokasiSekarang").value;
        var Promo = document.getElementById("promo").value;
        var kendaraan = document.getElementById("kendaraan").value;
        var pembayaran = document.getElementById("pembayaran").value;
        const driverArray = [
          {
            id: 1,
            lokSekarang: lokasiSekarang,
            lokTujuan: lokasiTujuan,
            kend: kendaraan,
            promo: Promo,
            pemb: pembayaran,
            harga: Math.floor((Math.random() * 100) + 1) * 1000,

          },
          {
            id: 2,
            lokSekarang: lokasiSekarang,
            lokTujuan: lokasiTujuan,
            kend: kendaraan,
            promo: Promo,
            pemb: pembayaran,
            harga: Math.floor((Math.random() * 100) + 1)  * 1000,

          },
          {
            id: 3,
            lokSekarang: lokasiSekarang,
            lokTujuan: lokasiTujuan,
            kend: kendaraan,
            promo: Promo,
            pemb: pembayaran,
            harga: Math.floor((Math.random() * 100) + 1)  * 1000,

          }
        ];
              
        let htmlCode = ``;
        
        driverArray.forEach(function(singleDriverObjects) {
          
          htmlCode =
            htmlCode +
            `
            <form class="col-4" action="driverditemukan.php" method="post">
            
            <div class="card">
              <div class="card-body">
                <card>
                  <div>
                  <p>Lokasi Sekarang: ${singleDriverObjects.lokSekarang}</p>
                  <input type="hidden" name="lokTujuan" value="${singleDriverObjects.lokTujuan}" required>
                  <input type="hidden" name="lokSekarang" value="${singleDriverObjects.lokSekarang}" required>
                  <input type="hidden" name="promo" value="${singleDriverObjects.promo}">
                  <input type="hidden" name="harga" value="${singleDriverObjects.harga}">
                  <input type="hidden" name="pembayaran" value="${singleDriverObjects.pemb}">
                  <p>Lokasi Tujuan: ${singleDriverObjects.lokTujuan}</p>
                  <p>Kendaraan: ${singleDriverObjects.kend}</p>
                  <p>Harga: Rp ${singleDriverObjects.harga}</p>
                  
                  <button type="submit" name="caridriver" class="btn btn-danger" >pilih</button>
                  </div>
                </card>
              </div>
          </div>
          </form>
          `;
          // uncomment the line below to see the output in the browser console.
          // console.log(htmlCode);
        
        });
        // we are simply saying, "let DriverCards be = to that div", to target that div, we reference the class we gave to it.
        const DriverCards = document.querySelector(".all-Driver-cards");

        // here's how we do the render;
        // since DriverCards is now = to that div, we now say let the inside of that div take in our htmlCode variable that holds our html codes.
        DriverCards.innerHTML = htmlCode;
      }
    </script>

  </body>
</html>
