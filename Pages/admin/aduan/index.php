<?php

    include 'functions/Class/pengaduan.php';
    include 'functions/Class/tanggapan.php';
    $database = new Database();
    $connection = $database->getConnection();
    $tanggapan = new Tanggapan($connection);
   
    $add = $tanggapan->addTanggapan();


    $pengaduan = new Pengaduan();
    $queryAduan = $pengaduan->selectPengaduan();

   
    $id_petugas = $_SESSION["id_petugas"];
$resultAduan = odbc_exec($connection, $queryAduan);

// Mengecek apakah query berhasil dieksekusi
if (!$resultAduan) {
    die("Query failed: " . odbc_errormsg());
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-TygpuPtXnWshq8Uwru4ZrBfDewHxqzWu2Kluz9o1ur5An1LQSLtmo8gO3yZK7uf" crossorigin="anonymous">


<!-- ================ Order Details List ================= -->
<div class="main">
    <div class="topbar">
        <div class="toggle">
            <ion-icon name="menu-outline"></ion-icon>
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

            <table class="table">
                <thead>
                    <tr>
                        <td>Nama</td>
                        <td>Kategori</td>
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
            <form method="post" index.php?page=aduan>
            <div id="myModal<?= $rowAduan['id_pengaduan'] ?>" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Pengaduan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <div class="modal-body">
                            <p><strong>NIK:</strong> <?= $rowAduan['nik'] ?></p>
                            <p><strong>Nama:</strong> <?= $rowAduan['nama_masyarakat'] ?></p>
                            <p><strong>Laporan:</strong> <?= $rowAduan['laporan'] ?></p>
                            <div class="mb-3">
                                <label for="response<?= $rowAduan['id_pengaduan'] ?>" class="form-label">Tanggapan:</label>
                                <textarea class="form-control" id="tanggapan" name="tanggapan"></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="tanggal" value="<?= $rowAduan['tanggal'] ?>">
                        <input type="hidden" name="id_petugas" value="<?= $id_petugas ?>">
                        <input type="hidden" name="id_pengaduan" value="<?= $rowAduan['id_pengaduan'] ?>">
                        <div class="modal-footer">
                            <button type="submit" name="submit" class="btn btn-primary" >Submit Response</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <?php
                $text = $rowAduan['laporan'];
                $laporan = substr($text, 0, 10) . '...'; 
            ?>
            <tr>
                <td><?= $rowAduan['nama_masyarakat'] ?></td>
                <td><?= $rowAduan['nama_kategori'] ?></td>
                <td><?=$laporan ?></td>
                <td><?= $rowAduan['foto'] ?></td>
                <td><?=  $rowAduan['nama_status'] ?></td>
                <td>
                    <div class="">
                    <?php if ($rowAduan['nama_status'] == 'Terkirim') { ?>
                        <a href="index.php?page=aduan&action=2&id_pengaduan=<?= $rowAduan['id_pengaduan']; ?>"><button class="btn btn-primary m-1">Proses</button></a>
                    <?php } elseif ($rowAduan['nama_status'] == 'Diproses') { ?>
                        <a href="index.php?page=aduan&action=3&id_pengaduan=<?= $rowAduan['id_pengaduan']; ?>"><button class="btn btn-success m-1">Selesai</button></a>
                    <?php } else { ?>
                
                    <?php } ?>
                    <a href='index.php?page=edit&id=<?= $rowAduan['id_pengaduan'] ?>' data-bs-toggle="modal" data-bs-target="#myModal<?= $rowAduan['id_pengaduan'] ?>"><button class="btn btn-warning">Tanggapi</button></a>
                    
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

