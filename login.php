<?php
//memulai session atau melanjutkan session yang sudah ada
session_start();

//menyertakan code dari file koneksi
include "koneksi.php";

//check jika sudah ada user yang login arahkan ke halaman admin
if (isset($_SESSION['username'])) { 
	header("location:admin.php"); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['user'];
  
  //menggunakan fungsi enkripsi md5 supaya sama dengan password  yang tersimpan di database
  $password = md5($_POST['pass']);

	//prepared statement
  $stmt = $conn->prepare("SELECT username 
                          FROM user 
                          WHERE username=? AND password=?");

	//parameter binding 
  $stmt->bind_param("ss", $username, $password);//username string dan password string
  
  //database executes the statement
  $stmt->execute();
  
  //menampung hasil eksekusi
  $hasil = $stmt->get_result();
  
  //mengambil baris dari hasil sebagai array asosiatif
  $row = $hasil->fetch_array(MYSQLI_ASSOC);

  //check apakah ada baris hasil data user yang cocok
  if (!empty($row)) {
    //jika ada, simpan variable username pada session
    $_SESSION['username'] = $row['username'];

    //mengalihkan ke halaman admin
    header("location:admin.php");
  } else {
	  //jika tidak ada (gagal), alihkan kembali ke halaman login
    
    header("location:login.php");

  }

	//menutup koneksi database
  $stmt->close();
  $conn->close();
} else {
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" href="img/logo.png" />
    <link rel="stylesheet" href="style.css">
  </head>
  <body class="bg-primary-subtle">
    <a name="atas"></a>
    
      <!-- user dan pasword -->
    
    <section>
      <div class="container mt-5 pt-5">
        <h1 class="fw-bold display-4 pb-3 text-center">
          Form Login
        <h1>
        <div class="row">
          <div class="col-12 col-sm-8 col-md-6 m-auto">
            <div class="card border-0 shadow">
              <div class="card-body">
                <center>
                  <svg class="my-3" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                  </svg>
                </center>
                <form method="POST" action="">
                  <input type="text" name="user" id="" class="form-control my-4 py-2" placeholder="Username">
                  <input type="password" name="pass" id="" class="form-control my-4 py-2" placeholder="Password">
                  <div class="text-center mt-3">
                    <button class="btn btn-primary">
                      login
                    </button>
                  </div>
                </form>
                <div>
                  
                    <!-- php post -->
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Footer Start -->
    <footer class="text-center p-5 mt-5">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 </body>
</html>
<?php
}
?>