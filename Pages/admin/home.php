<?php
    $database = new Database();
    $connection = $database->getConnection();
// Query untuk mengambil data aduan terbaru
$queryAduan = "SELECT TOP 8 p.*, m.nama AS nama_masyarakat, k.nama_kategori, sp.nama_status
               FROM pengaduan p
               INNER JOIN masyarakat m ON p.nik = m.nik
               INNER JOIN kategori k ON p.id_kategori = k.id_kategori
               INNER JOIN status_pengaduan sp ON p.id_status = sp.id_status
               ORDER BY p.tanggal DESC"; // Sesuaikan dengan kolom yang diperlukan

// Query untuk menghitung jumlah aduan
$queryCountAduan = "SELECT COUNT(*) AS total_aduan FROM pengaduan";

// Query untuk menghitung jumlah tanggapan
$queryCountTanggapan = "SELECT COUNT(*) AS total_tanggapan FROM tanggapan";

// Query untuk menghitung jumlah pengguna/masyarakat
$queryCountMasyarakat = "SELECT COUNT(*) AS total_masyarakat FROM masyarakat";

// Melakukan query ke database
$resultAduan = odbc_exec($connection, $queryAduan);
$resultCountAduan = odbc_exec($connection, $queryCountAduan);
$resultCountTanggapan = odbc_exec($connection, $queryCountTanggapan);
$resultCountMasyarakat = odbc_exec($connection, $queryCountMasyarakat);

// Mengecek apakah query berhasil dieksekusi
if (!$resultAduan || !$resultCountAduan || !$resultCountTanggapan || !$resultCountMasyarakat) {
    die("Query failed: " . odbc_errormsg());
}

// Mengambil hasil perhitungan
$rowCountAduan = odbc_fetch_array($resultCountAduan);
$rowCountTanggapan = odbc_fetch_array($resultCountTanggapan);
$rowCountMasyarakat = odbc_fetch_array($resultCountMasyarakat);
?>


<!-- ========================= Main ==================== -->
<div class="main">
    <div class="topbar">
        <div class="toggle">
            <ion-icon name="menu-outline"></ion-icon>
        </div>


        <div class="user">
            <img src="img/customer01.jpg" alt="">
        </div>
    </div>

    <!-- ======================= Cards ================== -->
    <div class="cardBox">

        <div class="card">
            <div>
                <div class="numbers"><?php echo $rowCountTanggapan['total_tanggapan']; ?></div>
                <div class="cardName">Tanggapans</div>
            </div>

            <div class="iconBx">
                <ion-icon name="mail-open-outline"></ion-icon>
            </div>
        </div>

        <div class="card">
            <div>
                <div class="numbers"><?php echo $rowCountAduan['total_aduan']; ?></div>
                <div class="cardName">Aduan</div>
            </div>

            <div class="iconBx">
                <ion-icon name="chatbubbles-outline"></ion-icon>
            </div>
        </div>

        <div class="card">
            <div>
                <div class="numbers"><?php echo $rowCountMasyarakat['total_masyarakat']; ?></div>
                <div class="cardName">User</div>
            </div>

            <div class="iconBx">
                <ion-icon name="people-outline"></ion-icon>
            </div>
        </div>
    </div>

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
        <!-- ================= New Customers ================ -->
        <div class="recentCustomers">
            <div class="cardHeader">
                <h2>Recent Customers</h2>
            </div>

            <table>
                <?php
                // Query untuk mengambil data pelanggan terbaru
                $queryPelanggan = "SELECT TOP 8 * FROM masyarakat ORDER BY nik DESC";

                // Melakukan query ke database
                $resultPelanggan = odbc_exec($connection, $queryPelanggan);

                // Mengecek apakah query berhasil dieksekusi
                if (!$resultPelanggan) {
                    die("Query failed: " . odbc_errormsg());
                }

                // Mengambil hasil query pelanggan
                while ($rowPelanggan = odbc_fetch_array($resultPelanggan)) {
                ?>
                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="img/<?php echo $rowPelanggan['nama_foto']; ?>" alt=""></div>
                        </td>
                        <td>
                            <h4><?php echo $rowPelanggan['nama']; ?> </h4>
                        </td>
                    </tr>
                    
                <?php
                }
                ?>
            </table>
        </div>

    </div>
</div>
</div>
