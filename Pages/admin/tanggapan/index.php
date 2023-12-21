<?php
$database = new Database();
$connection = $database->getConnection();
// Query untuk mengambil data tanggapan
$queryTanggapan = "SELECT t.*, p.laporan, m.nama AS nama_masyarakat, petugas.nama_petugas
                   FROM tanggapan t
                   INNER JOIN pengaduan p ON t.id_pengaduan = p.id_pengaduan
                   INNER JOIN masyarakat m ON p.nik = m.nik
                   INNER JOIN petugas ON t.id_petugas = petugas.id_petugas
                   ORDER BY t.tgl_tanggapan DESC"; // Sesuaikan dengan kolom yang diperlukan

// Melakukan query ke database
$resultTanggapan = odbc_exec($connection, $queryTanggapan);

// Mengecek apakah query berhasil dieksekusi
if (!$resultTanggapan) {
    die("Query failed: " . odbc_errormsg());
}
?>

<!-- ================ List of Responses/Tanggapan ================ -->
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
                <h2>List of Responses</h2>
                <a href="#" class="btn">Tambah</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <td>Nama Masyarakat</td>
                        <td>Laporan</td>
                        <td>Tanggapan</td>
                        <td>Nama Petugas</td>
                        <td>Aksi</td>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($rowTanggapan = odbc_fetch_array($resultTanggapan)) {
                    ?>
                        <tr>
                            <td><?php echo $rowTanggapan['nama_masyarakat']; ?></td>
                            <td><?php echo $rowTanggapan['laporan']; ?></td>
                            <td><?php echo $rowTanggapan['tanggapan']; ?></td>
                            <td><?php echo $rowTanggapan['nama_petugas']; ?></td>
                            <td>

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