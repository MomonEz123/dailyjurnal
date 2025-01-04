<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Daily Journal | Admin</title>
    <link rel="icon" href="img/logo.png" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous">
    </script>
</head>

<body>

    <div class="container">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-lg"></i> Tambah User
        </button>
        <div class="row">
            <div class="table-responsive" id="user_data">

            </div>
            <!-- Awal Modal Tambah-->
            <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="formGroupExampleInput" class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username"
                                        placeholder="Tuliskan Username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="floatingTextarea2">Password</label>
                                    <textarea class="form-control" placeholder="Tuliskan Password Dalam Hash" name="password"
                                        required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="formGroupExampleInput2" class="form-label">Foto</label>
                                    <input type="file" class="form-control" name="gambar">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" value="simpan" name="simpan" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Akhir Modal Tambah-->
        </div>
    </div>

    <script>
        $(document).ready(function () {
            load_data();
            function load_data(hlm) {
                $.ajax({
                    url: "user_data.php",
                    method: "POST",
                    data: {
                        hlm: hlm
                    },
                    success: function (data) {
                        $('#user_data').html(data);
                    }
                })
            }
            $(document).on('click', '.halaman', function () {
                var hlm = $(this).attr("id");
                load_data(hlm);
            });
        });
    </script>

    <?php
    include "upload_foto.php";

    //jika tombol simpan diklik
    if (isset($_POST['simpan'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $gambar = '';
        $nama_gambar = $_FILES['gambar']['name'];

        //jika ada file yang dikirim  
        if ($nama_gambar != '') {
            //panggil function upload_foto untuk cek spesifikasi file yg dikirimkan user
            //function ini memiliki 2 keluaran yaitu status dan message
            $cek_upload = upload_foto($_FILES["gambar"]);

            //cek status true/false
            if ($cek_upload['status']) {
                //jika true maka message berisi nama file gambar
                $gambar = $cek_upload['message'];
            } else {
                //jika true maka message berisi pesan error, tampilkan dalam alert
                echo "<script>
                    alert('" . $cek_upload['message'] . "');
                    document.location='admin.php?page=user';
                </script>";
                die;
            }
        }

        //cek apakah ada id yang dikirimkan dari form
        if (isset($_POST['id'])) {
            //jika ada id,    lakukan update data dengan id tersebut
            $id = $_POST['id'];

            if ($nama_gambar == '') {
                //jika tidak ganti gambar
                $gambar = $_POST['gambar_lama'];
            } else {
                //jika ganti gambar, hapus gambar lama
                unlink("img/" . $_POST['gambar_lama']);
            }

            $stmt = $conn->prepare("UPDATE user 
                                    SET 
                                    username =?,
                                    password =?,
                                    gambar = ?
                                    WHERE id = ?");

            $stmt->bind_param("sssi", $username, $password, $gambar, $id);
            $simpan = $stmt->execute();
        } else {
            //jika tidak ada id, lakukan insert data baru
            $stmt = $conn->prepare("INSERT INTO user (username,password,gambar)
                                    VALUES (?,?,?)");

            $stmt->bind_param("sss", $username, $password, $gambar);
            $simpan = $stmt->execute();
        }

        if ($simpan) {
            echo "<script>
                alert('Simpan data sukses');
                document.location='admin.php?page=user';
            </script>";
        } else {
            echo "<script>
                alert('Simpan data gagal');
                document.location='admin.php?page=user';
            </script>";
        }

        $stmt->close();
        $conn->close();
    }

    //jika tombol hapus diklik
    if (isset($_POST['hapus'])) {
        $id = $_POST['id'];
        $gambar = $_POST['gambar'];

        if ($gambar != '') {
            //hapus file gambar
            unlink("img/" . $gambar);
        }

        $stmt = $conn->prepare("DELETE FROM user WHERE id =?");

        $stmt->bind_param("i", $id);
        $hapus = $stmt->execute();

        if ($hapus) {
            echo "<script>
                alert('Hapus data sukses');
                document.location='admin.php?page=user';
            </script>";
        } else {
            echo "<script>
                alert('Hapus data gagal');
                document.location='admin.php?page=user';
            </script>";
        }

        $stmt->close();
        $conn->close();
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>