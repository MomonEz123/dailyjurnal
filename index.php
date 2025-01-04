<?php
include "koneksi.php";

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web jurnal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" href="img/logo.png" />
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <a name="atas"></a>
    <!-- Nav Start -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
      <div class="container">
        <a class="navbar-brand" href="#atas">My Daily Jurnal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#hero">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#article">Article</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#gallery">Gallery</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#schedule">Jadwal</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#profile">Profil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="login.php">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Nav end -->
    <!-- Hero start -->
    <section id="hero" class="text-sm-start p-5 bg-primary-subtle text-center">
      <div class="container">
        <div class="d-sm-flex flex-sm-row-reverse align-items-center">
          <img src="img/book.jpg" class="img-fluid" width="300">
          <div>
            <h1 class="fw-bold display-4">
              Mind Controls Everything And Without Strength
            </h1>
            <h4 class="lead display-6">
              You Cannot Protect Anything
            </h4>
          </div>
        </div>
      </div>
    </section>
    <!-- Hero end -->
    <!-- article begin -->
    <section id="article" class="text-center p-5">
      <div class="container">
        <h1 class="fw-bold display-4 pb-3">Article</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
          <?php
          $sql = "SELECT * FROM article ORDER BY tanggal DESC";
          $hasil = $conn->query($sql); 

          while($row = $hasil->fetch_assoc()){
          ?>
            <div class="col">
              <div class="card h-100">
                <img src="img/<?= $row["gambar"]?>" class="card-img-top" alt="..." />
                <div class="card-body">
                  <h5 class="card-title"><?= $row["judul"]?></h5>
                  <p class="card-text">
                    <?= $row["isi"]?>
                  </p>
                </div>
                <div class="card-footer">
                  <small class="text-body-secondary">
                    <?= $row["tanggal"]?>
                  </small>
                </div>
              </div>
            </div>
            <?php
          }
          ?> 
        </div>
      </div>
    </section>
    <!-- article end -->
    <!-- Galery start -->
    <section id="gallery" class="text-center p-5 bg-primary-subtle gy-3">
      <div class="container gy-3">
          <h1 class="fw-bold display-4 pb-3">
            Gallery
          </h1>
          <!-- Carousel start -->
          <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <?php
              include "koneksi.php"; // Koneksi ke database

              $sql = "SELECT * FROM gallery ORDER BY tanggal DESC"; // Query untuk mengambil data gallery
              $hasil = $conn->query($sql);
              $i = 0;
              while ($row = $hasil->fetch_assoc()) {
                  $active = ($i == 0) ? 'active' : ''; // Kelas 'active' hanya untuk indikator pertama
                  echo '<button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="'.$i.'" class="'.$active.'" aria-label="Slide '.($i + 1).'"></button>';
                  $i++;
              }
              ?>

            </div>
            <div class="carousel-inner">
              <?php
              $hasil->data_seek(0); // Kembali ke awal hasil query
              $i = 0;
              while ($row = $hasil->fetch_assoc()) {
                  $active = ($i == 0) ? 'active' : ''; // Kelas 'active' hanya untuk slide pertama
                  echo '
                  <div class="carousel-item '.$active.'" data-bs-interval="5000">
                      <img src="img/'.$row["gambar"].'" class="d-block w-100" alt="'.$row["judul"].'">
                      <div class="carousel-caption d-none d-md-block">
                          <h5>'.$row["judul"].'</h5>
                          <p>Diposting pada: '.$row["tanggal"].'</p>
                      </div>
                  </div>';
                  $i++;
              }
              ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
          </div>  
      </div>
      <!-- Carousel end -->
    </section>
    <!-- Galery end -->
    <!-- Scedule Start -->
     <section id="schedule" class="mt-4 text-center p-5">
      <div class="container">
        <h1 class="fw-bold display-4 pb-3">
          Jadwal kuliah & Kegiatan Mahasiswa
        </h1>
        <div class="row justify-content-center">
          <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-dark mb-3" >
              <div class="card-header text-center text-bg-info">Senin</div>
              <div class="card-body">
                <h5 class="card-title text-center">09.00-10.30</h5>
                <p class="card-text text-center">Basis Data
                </p>
                <p class="card-text text-center">Ruang H.3.4
                </p>
                <h5 class="card-title text-center">13.00-15.00</h5>
                <p class="card-text text-center">Dasar Pemrograman
                </p>
                <p class="card-text text-center">Ruang H.3.1
                </p>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-dark mb-3" >
              <div class="card-header text-center text-bg-success">Selasa</div>
              <div class="card-body">
                <h5 class="card-title text-center">08.00-09.30</h5>
                <p class="card-text text-center">Pemrograman Berbasis Web
                </p>
                <p class="card-text text-center">Ruang D.2.J
                </p>
                <h5 class="card-title text-center">14.00-16.00</h5>
                <p class="card-text text-center">Basis Data
                </p>
                <p class="card-text text-center">Ruang D.3.M
                </p>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-dark mb-3">
              <div class="card-header text-center text-bg-danger">Rabu</div>
              <div class="card-body">
                <h5 class="card-title text-center">10.00-12.00</h5>
                <p class="card-text text-center">Pemrograman Berbasis Object
                </p>
                <p class="card-text text-center">Ruang D.2.A
                </p>
                <h5 class="card-title text-center">13.30-15.00</h5>
                <p class="card-text text-center">Pemrograman Sisi Server
                </p>
                <p class="card-text text-center">Ruang D.2.A
                </p>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-dark mb-3" >
              <div class="card-header text-center text-bg-warning">Kamis</div>
              <div class="card-body">
                <h5 class="card-title text-center">08.00-10.00</h5>
                <p class="card-text text-center">Pengantar Teknologi Informasi
                </p>
                <p class="card-text text-center">Ruang D.3.N
                </p>
                <h5 class="card-title text-center">11.00-13.00</h5>
                <p class="card-text text-center">Logika Informatika
                </p>
                <p class="card-text text-center">Ruang H.3.7
                </p>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-dark mb-3" >
              <div class="card-header text-center text-bg-primary">Jumat</div>
              <div class="card-body">
                <h5 class="card-title text-center">09.00-11.00</h5>
                <p class="card-text text-center">Data Mining
                </p>
                <p class="card-text text-center">Ruang G.2.3
                </p>
                <h5 class="card-title text-center">13.00-15.00</h5>
                <p class="card-text text-center">Sistem Informasi
                </p>
                <p class="card-text text-center">Ruang H.3.10
                </p>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-dark mb-3" >
              <div class="card-header text-center text-bg-light">Sabtu</div>
              <div class="card-body">
                <h5 class="card-title text-center">08.00-10.00</h5>
                <p class="card-text text-center">Bimbingan Karir
                </p>
                <p class="card-text text-center">Ruang D.3.N
                </p>
                <h5 class="card-title text-center">10.30-12.00</h5>
                <p class="card-text text-center">Bimbingan Skripsi
                </p>
                <p class="card-text text-center">Online
                </p>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-dark mb-3">
              <div class="card-header text-center text-bg-dark">Minggu</div>
              <div class="card-body">
                <h5 class="card-title text-center">Kosong</h5>
                <p class="card-text text-center">-
                </p>
                <p class="card-text text-center">-
                </p>
                <h5 class="card-title text-center">-</h5>
                <p class="card-text text-center">-
                </p>
                <p class="card-text text-center">-
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
     </section>
     <!-- schedule end -->
    <!-- Profile Start -->
    <section id="profile">
      <h1 class="fw-bold text-center">-Profile-</h1>
      <div class="container">
        <div class="d-md-flex flex-md-row align-items-center p-5 g-5 ms-auto justify-content-center">
          <img src="img/Anda siapa ratio2.jpg" class="rounded-circle d-md-flex justify-content-start" alt="saya">
          <div class="d-md p-5 g-4 align-items-center border-end">
            <div class="text-center">
              <h3>Sandy Candra Ramadhan</h3>
              <div>Mahasiswa Teknik Informatika</div>
            </div>
            <br>
            <div class="text-center">
              <div><b>NIM: </b>A11.2023.15302</div>
              <div><b>Program Studi: </b>Teknik Informatika-S1</div>
              <div><b>Email: </b>111202315302@mhs.dinus.ac.id</div>
              <div><b>Telepon: </b>+62-881-869-1183</div>
              <div><b>Alamat: </b>Genuksari, RT.03/RW.02</div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Footer Start -->
    <footer class="text-center p-5">
      <div>
        <a href="http://" target="_blank" rel="noopener noreferrer"><i class="bi bi-instagram h2 p-2 text-dark"></i></a>
        <a href="http://" target="_blank" rel="noopener noreferrer"><i class="bi bi-twitter-x h2 p-2 text-dark"></i></a>
        <a href="http://" target="_blank" rel="noopener noreferrer"><i class="bi bi-whatsapp h2 p-2 text-dark"></i></a>
      </div>
      <div>
        <h3>Sandy Candra Ramadhan &copy; 2024</h3>
      </div>
    </footer>
    <!-- Footer end -->
  </body>
</html>