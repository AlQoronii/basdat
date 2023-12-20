<?php
include("../templates/header.php");
include_once("../../../config/koneksi.php"); // Menghubungkan ke database

// Query untuk mengambil data aduan
$queryAduan = "SELECT p.*, m.nama AS nama_masyarakat, k.nama_kategori, sp.nama_status
               FROM pengaduan p
               INNER JOIN masyarakat m ON p.nik = m.nik
               INNER JOIN kategori k ON p.id_kategori = k.id_kategori
               INNER JOIN status_pengaduan sp ON p.id_status = sp.id_status
               ORDER BY p.tanggal DESC"; // Sesuaikan dengan kolom yang diperlukan

// Melakukan query ke database
$resultAduan = odbc_exec($connection, $queryAduan);

// Mengecek apakah query berhasil dieksekusi
if (!$resultAduan) {
    die("Query failed: " . odbc_errormsg());
}
?>


<!-- ================ Order Details List ================= -->
<div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Aduan Terbaru</h2>
            <a href="#" class="btn">View All</a>
        </div>

        <table>
            <thead>
                <tr>
                    <td>Nama</td>
                    <td>Laporan</td>
                    <td>Foto</td>
                    <td>Status</td>
                </tr>
            </thead>

            <tbody>
                <?php
                while ($rowAduan = odbc_fetch_array($resultAduan)) {
                ?>
                    <tr>
                        <td><?php echo $rowAduan['nama_masyarakat']; ?></td>
                        <td><?php echo $rowAduan['laporan']; ?></td>
                        <td><?php echo $rowAduan['foto']; ?></td>
                        <td><span class="status <?php echo strtolower($rowAduan['nama_status']); ?>"><?php echo $rowAduan['nama_status']; ?></span></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include("../templates/footer.php"); ?>