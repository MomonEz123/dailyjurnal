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
            <i class="bi bi-plus-lg"></i> Tambah Gallery
        </button>
        <div class="row">
            <div class="table-responsive" id="gallery_data">

            </div>
            <!-- Awal Modal Tambah-->
            <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Gallerry</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="formGroupExampleInput" class="form-label">Judul</label>
                                    <input type="text" class="form-control" name="judul"
                                        placeholder="Tuliskan Judul Gambar" required>
                                </div>
                                <div class="mb-3">
                                    <label for="formGroupExampleInput2" class="form-label">Gambar</label>
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
        $(document).ready(function() {
            load_data();

            function load_data(hlm) {
                $.ajax({
                    url: "gallery_data.php",
                    method: "POST",
                    data: {
                        hlm: hlm
                    },
                    success: function(data) {
                        $('#gallery_data').html(data);
                    }
                })
            }
            $(document).on('click', '.halaman', function() {
                var hlm = $(this).attr("id");
                load_data(hlm);
            });
        });
    </script>

    <?php
    include "upload_foto.php";

    //jika tombol simpan diklik
    if (isset($_POST['simpan'])) {
        $id = $_POST['id'];
        $judul = $_POST['judul'];
        $tanggal = date("Y-m-d H:i:s");
        $username = $_SESSION['username'];
    
        // Validasi input judul
        if (empty($judul)) {
            echo "<script>
                alert('Judul tidak boleh kosong!');
                document.location='admin.php?page=gallery';
            </script>";
            die;
        }
    
        // Proses gambar baru jika ada
        $gambar = $_POST['gambar_lama']; // Default gunakan gambar lama
        if (!empty($_FILES['gambar']['name'])) {
            $cek_upload = upload_foto($_FILES["gambar"]);
    
            if ($cek_upload['status']) {
                $gambar = $cek_upload['message'];
                // Hapus gambar lama jika ada
                if (!empty($_POST['gambar_lama']) && file_exists('img/' . $_POST['gambar_lama'])) {
                    unlink('img/' . $_POST['gambar_lama']);
                }
            } else {
                echo "<script>
                    alert('" . $cek_upload['message'] . "');
                    document.location='admin.php?page=gallery';
                </script>";
                die;
            }
        }
    
        // Update data ke database
        $stmt = $conn->prepare("UPDATE gallery SET judul = ?, gambar = ?, tanggal = ?, username = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $judul, $gambar, $tanggal, $username, $id);
        $simpan = $stmt->execute();
    
        if ($simpan) {
            echo "<script>
                alert('Data berhasil diperbarui');
                document.location='admin.php?page=gallery';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal diperbarui');
                document.location='admin.php?page=gallery';
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

        $stmt = $conn->prepare("DELETE FROM gallery WHERE id =?");

        $stmt->bind_param("i", $id);
        $hapus = $stmt->execute();

        if ($hapus) {
            echo "<script>
                alert('Hapus data sukses');
                document.location='admin.php?page=gallery';
            </script>";
        } else {
            echo "<script>
                alert('Hapus data gagal');
                document.location='admin.php?page=gallery';
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