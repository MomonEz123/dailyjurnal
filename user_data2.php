<table class="table table-hover">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th class="w-25">Username</th>
            <th class="w-25">Foto</th>
            <th class="w-25">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include "koneksi.php";

        // Variabel pagination
        $limit = 5;
        $hlm = (isset($_POST['hlm'])) ? $_POST['hlm'] : 1;
        $limit_start = ($hlm - 1) * $limit;

        // Hitung total records dan jumlah halaman
        $total_records_query = $conn->query("SELECT COUNT(*) as total FROM user");
        $total_records = $total_records_query->fetch_assoc()['total'];
        $jumlah_page = ceil($total_records / $limit);

        // Ambil data sesuai halaman
        $sql = "SELECT * FROM user ORDER BY id DESC LIMIT $limit_start, $limit";
        $hasil = $conn->query($sql);
        $no = $limit_start + 1;

        // Tampilkan data
        while ($row = $hasil->fetch_assoc()) {
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><strong><?= $row["username"] ?></strong></td>
                <td>
                    <?php if ($row["gambar"] && file_exists('img/' . $row["gambar"])) { ?>
                        <img src="img/<?= $row["gambar"] ?>" width="100">
                    <?php } ?>
                </td>
                <td>
                    <a href="#" title="edit" class="badge rounded-pill text-bg-success" data-bs-toggle="modal"
                        data-bs-target="#modalEdit<?= $row["id"] ?>"><i class="bi bi-pencil"></i></a>
                    <a href="#" title="delete" class="badge rounded-pill text-bg-danger" data-bs-toggle="modal"
                        data-bs-target="#modalHapus<?= $row["id"] ?>"><i class="bi bi-x-circle"></i></a>
                </td>
            </tr>
        <?php
        }
        ?>

        <!-- Navigasi Pagination -->
        <ul class="pagination">
            <?php
            // Tombol "First" dan "Previous"
            if ($hlm == 1) {
                echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
                echo '<li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>';
            } else {
                $link_prev = $hlm - 1;
                echo '<li class="page-item halaman" id="1"><a class="page-link" href="#">First</a></li>';
                echo '<li class="page-item halaman" id="' . $link_prev . '"><a class="page-link" href="#">&laquo;</a></li>';
            }

            // Tombol halaman
            $jumlah_number = 1; // jumlah halaman di kanan dan kiri halaman aktif
            $start_number = ($hlm > $jumlah_number) ? $hlm - $jumlah_number : 1;
            $end_number = ($hlm < ($jumlah_page - $jumlah_number)) ? $hlm + $jumlah_number : $jumlah_page;

            for ($i = $start_number; $i <= $end_number; $i++) {
                $link_active = ($hlm == $i) ? ' active' : '';
                echo '<li class="page-item halaman' . $link_active . '" id="' . $i . '"><a class="page-link" href="#">' . $i . '</a></li>';
            }

            // Tombol "Next" dan "Last"
            if ($hlm == $jumlah_page) {
                echo '<li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>';
                echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
            } else {
                $link_next = $hlm + 1;
                echo '<li class="page-item halaman" id="' . $link_next . '"><a class="page-link" href="#">&raquo;</a></li>';
                echo '<li class="page-item halaman" id="' . $jumlah_page . '"><a class="page-link" href="#">Last</a></li>';
            }
            ?>
        </ul>
    </tbody>
</table>