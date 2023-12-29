<?php
include 'functions/class/tanggapan.php';

$database = new Database();
$connection = $database->getConnection();
// Query to retrieve tanggapan data
$tanggapan = new Tanggapan($connection);
$edit = $tanggapan->editTanggapan();

$delete = $tanggapan->delete();


$queryTanggapan = "SELECT t.*, p.laporan, m.nama AS nama_masyarakat, petugas.nama_petugas, m.nik
                   FROM tanggapan t
                   INNER JOIN pengaduan p ON t.id_pengaduan = p.id_pengaduan
                   INNER JOIN masyarakat m ON p.nik = m.nik
                   INNER JOIN petugas ON t.id_petugas = petugas.id_petugas
                   ORDER BY t.tgl_tanggapan DESC"; // Adjust with the required columns

// Perform the database query
$resultTanggapan = odbc_exec($connection, $queryTanggapan);

// Check if the query was successful
if (!$resultTanggapan) {
    die("Query failed: " . odbc_errormsg());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-TygpuPtXnWshq8Uwru4ZrBfDewHxqzWu2Kluz9o1ur5An1LQSLtmo8gO3yZK7uf" crossorigin="anonymous">
    <title>List of Responses</title>
</head>

<body>

<!-- ================ List of Responses/Tanggapan ================ -->
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
                <h2>List of Responses</h2>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Masyarakat</th>
                        <th>Laporan</th>
                        <th>Tanggapan</th>
                        <th>Nama Petugas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($rowTanggapan = odbc_fetch_array($resultTanggapan)) {
                    ?>
                    <form method="post" action="index.php?page=tanggapan">
                    <div id="myModall<?= $rowTanggapan['id_tanggapan'] ?>" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Tanggapan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <div class="col-2"><strong>NIK</strong></div>
                                        <div class="col-10">: <?= $rowTanggapan['nik'] ?></div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-2"><strong>Nama</strong></div>
                                        <div class="col-10">: <?= $rowTanggapan['nama_masyarakat'] ?></div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-2"><strong>Laporan</strong></div>
                                        <div class="col-10">: <?= $rowTanggapan['laporan'] ?></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggapan<?= $rowTanggapan['id_pengaduan'] ?>" class="form-label"><strong>Tanggapan</strong></label>
                                        <textarea class="form-control" id="tanggapan<?= $rowTanggapan ?>" name="tanggapan"><?= $rowTanggapan['tanggapan'] ?></textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="id_pengaduan" id="id_pengaduan" value="<?= $rowTanggapan['id_pengaduan'] ?>">
                                <div class="modal-footer">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit Response</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                        <?php
                            $text = $rowTanggapan['laporan'];
                            $laporan = substr($text, 0, 10) . '...';


                            $res = $rowTanggapan['tanggapan'];
                            $tanggapan = substr($res, 0, 10) . '...';
                        ?>

                        <tr>
                            
                            <td><?= $rowTanggapan['nama_masyarakat'] ?></td>
                            <td><div class="d-flex"><?= $laporan; ?></div></td>
                            <td><div class="d-flex"><?= $tanggapan; ?></div></td>
                            <td><?= $rowTanggapan['nama_petugas'] ?></td>
                            <td>
                                <div class="d-flex">
                                    
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModall<?= $rowTanggapan['id_tanggapan']; ?>"><i class="fa fa-pencil-square"></i></button>
                                <a href="index.php?page=tanggapan&id_pengaduan=<?= $rowTanggapan['id_tanggapan'] ?>" onclick="javascript:return confirm('Hapus Data Buku?');" class="btn btn-danger btn-xs m-1"><i class="fa fa-trash"></i></a>

                                </div>
                                <!-- Modal -->
                                <div id="myModal<?= $rowTanggapan['id_tanggapan']; ?>" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Tanggapan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <form method="post" action="index.php?page=tanggapan">
                                                <div class="modal-body">
                                                    <p><strong>Nama:</strong> <?= $rowTanggapan['nama_masyarakat'] ?></p>
                                                    <p><strong>Laporan:</strong> <?= $rowTanggapan['laporan'] ?></p>
                                                    <div class="mb-3">
                                                        <label for="tanggapan<?= $rowTanggapan['id_tanggapan'] ?>" class="form-label">Tanggapan:</label>
                                                        <textarea class="form-control" id="tanggapan<?= $rowTanggapan['id_tanggapan'] ?>" name="tanggapan"></textarea>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="id_pengaduan" id="id_pengaduan" value="<?= $rowTanggapan['id_pengaduan'] ?>">
                                                
                                                <div class="modal-footer">
                                                    <button type="submit" name="submit" class="btn btn-primary">Submit Response</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-rX1cpqtrqVDIZ0+TnFEW+DvBiHP8z9f8+O2brKnrjL5W93IA0E6Z9vZyMQ5iQZXP" crossorigin="anonymous"></script>
</body>

</html>
