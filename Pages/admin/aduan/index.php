<?php
    include 'functions/Class/pengaduan.php';

    $pengaduan = new Pengaduan();
    $queryAduan = $pengaduan->selectPengaduan();

    $database = new Database();
    $connection = $database->getConnection();

$resultAduan = odbc_exec($connection, $queryAduan);

// Mengecek apakah query berhasil dieksekusi
if (!$resultAduan) {
    die("Query failed: " . odbc_errormsg());
}
?>


<!-- ================ Order Details List ================= -->
<div class="main">
    <div class="topbar">
        <div class="toggle">
            <ion-icon name="menu-outline"></ion-icon>
        </div>

        <div class="search">
            <label>
                <input type="text" placeholder="Search here">
                <ion-icon name="search-outline"></ion-icon>
            </label>
        </div>

        <div class="user">
            <img src="assets/imgs/customer01.jpg" alt="">
        </div>
    </div>
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>List Pengaduan</h2>
            </div>

            <table>
                <thead>
                    <tr>
                        <td>Nama</td>
                        <td>Laporan</td>
                        <td>Foto</td>
                        <td>Status</td>
                        <td>Aksi</td>
                    </tr>
                </thead>

                <tbody>
        <?php
        while ($rowAduan = odbc_fetch_array($resultAduan)) {
            ?>
            <tr>
                <td><?= $rowAduan['nama_masyarakat'] ?></td>
                <td><?=$rowAduan['laporan'] ?></td>
                <td><?= $rowAduan['foto'] ?></td>
                <td><?=  $rowAduan['nama_status'] ?></td>
                <td>
                    <div class="d-flex">
                    <?php if ($rowAduan['nama_status'] == 'Terkirim') { ?>
                        <a href="index.php?page=aduan&action=2&id_pengaduan=<?= $rowAduan['id_pengaduan']; ?>"><button class="btn-coba">Proses</button></a>
                    <?php } elseif ($rowAduan['nama_status'] == 'Diproses') { ?>
                        <a href="index.php?page=aduan&action=3&id_pengaduan=<?= $rowAduan['id_pengaduan']; ?>"><button class="btn-selesai">Selesaikan</button></a>
                    <?php } else { ?>
                
                    <?php } ?>
                    <a href="pages/admin/aduan/tanggapi.php" class="btn-coba">Tanggapi</a>

                    </div>
                    <?php
                    if (isset($_GET['action']) && isset($_GET['id_pengaduan']) && $_GET['id_pengaduan'] == $rowAduan['id_pengaduan']) {
                        if ($_GET['action'] == 2 && $rowAduan['nama_status'] == 'Terkirim') {
                            $queryEdit = "UPDATE pengaduan SET id_status = 2 WHERE id_pengaduan = " . $rowAduan['id_pengaduan'];
                            $resultEdit = odbc_exec($connection, $queryEdit);
                        } elseif ($_GET['action'] == 3 && $rowAduan['nama_status'] == 'Diproses') {
                            $queryEdit = "UPDATE pengaduan SET id_status = 3 WHERE id_pengaduan = " . $rowAduan['id_pengaduan'];
                            $resultEdit = odbc_exec($connection, $queryEdit);

                        }
                        header("Location: index.php?page=aduan&id_pengaduan=" . $rowAduan['id_pengaduan']);
                            exit();
                    }
                    ?>
            </td>
        </tr>
        
        <?php
    }
    ?>
</tbody>



            </table>
        </div>
</div>