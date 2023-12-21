<?php
session_start();
include '../../../config/koneksi.php';

$database = new Database();
$connection = $database->getConnection();
$id = $_GET['id_pengaduan'];
$query = "SELECT p.id_pengaduan, p.tanggal, p.nik, p.laporan, 
        p.foto, p.id_kategori, p.id_status,
        m.nama, m.username, m.noTelp,
        sp.nama_status
        FROM pengaduan p
        JOIN masyarakat m ON p.nik = m.nik
        JOIN status_pengaduan sp ON p.id_status = sp.id_status
        WHERE p.id_pengaduan = $id";

$stmt = odbc_prepare($connection, $query);

if ($stmt) {
    // Execute the statement and fetch the row
    odbc_execute($stmt, []);
    $row = odbc_fetch_array($stmt);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard | Korsat X Parmaga</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="../../../assets/css/styleAdmin.css">
    <!-- Bootstrap CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-TygpuPtXnWshq8Uwru4ZrBfDewHxqzWu2Kluz9o1ur5An1LQSLtmo8gO3yZK7uf" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">

    <script src="https://kit.fontawesome.com/b450899c31.js" crossorigin="anonymous"></script>
</head>

<style>

.btn-proses {
  color: #fff;
  background-color: #0d6efd;
  border-color: #0d6efd;
}
.btn-proses:hover {
  color: #fff;
  background-color: #0b5ed7;
  border-color: #0a58ca;
}

.btn-selesai {
  color: #fff;
  background-color: #198754;
  border-color: #198754;
}
.btn-selesai:hover {
  color: #fff;
  background-color: #157347;
  border-color: #146c43;
}

</style>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="logo-apple"></ion-icon>
                        </span>
                        <span class="title">Pengadu</span>
                    </a>
                </li>

                <li>
                    <a href="index.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="index.php?page=masyarakat">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Masyarakat</span>
                    </a>
                </li>

                <li>
                    <a href="index.php?page=petugas">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Petugas</span>
                    </a>
                </li>

                <li>
                    <a href="index.php?page=aduan">
                        <span class="icon">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </span>
                        <span class="title">Aduan</span>
                    </a>
                </li>

                <li>
                    <a href="index.php?page=tanggapan">
                        <span class="icon">
                            <ion-icon name="mail-open-outline"></ion-icon>
                        </span>
                        <span class="title">Tanggapan</span>
                    </a>
                </li>

                <li>
                    <a href="functions/logout.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
        <?php if (isset($row)) : ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?php echo 'assets/img/produk/' . $row['foto']; ?>" class="img-thumbnail" width="100%" alt="bukti">
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5>Pengaduan - <?php echo $row['tanggal']; ?> | <?php echo $row['nama_status']; ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-md-2">NIK</label>
                                    <input type="text" class="form-control col-md-4" value="<?php echo $row['nik']; ?>" disabled>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2">Nama</label>
                                    <input type="text" class="form-control col-md-4" value="<?php echo $row['nama']; ?>" disabled>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2">Isi</label>
                                    <textarea rows="10" disabled class="form-control col-md-10"><?php echo $row['laporan']; ?></textarea>
                                </div>
                                <form action="/tambahtanggapan" method="POST">
                                    <div class="form-group row">
                                        <label class="col-md-2">Tanggapan</label>
                                        <input type="hidden" name="id" value="<?php echo $row['id_pengaduan']; ?>">
                                        <textarea rows="10" class="form-control col-md-10" name="isi"></textarea>
                                    </div>
                                    <a href="/pengaduan" class="btn btn-secondary ml-3 float-right"><i class="fas fa-undo-alt"></i> Kembali</a>
                                    <button type="submit" class="btn btn-warning float-right"><i class="fas fa-paper-plane"></i> Kirim</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- =========== Scripts =========  -->
        <script src="../../../assets/js/admin.js"></script>

        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>

    </html>
