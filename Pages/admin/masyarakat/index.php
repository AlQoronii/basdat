<?php
    $database = new Database();
    $connection = $database->getConnection();

// Query untuk mengambil data masyarakat
$queryMasyarakat = "SELECT * FROM masyarakat"; // Sesuaikan dengan kolom yang diperlukan

// Melakukan query ke database
$resultMasyarakat = odbc_exec($connection, $queryMasyarakat);

// Mengecek apakah query berhasil dieksekusi
if (!$resultMasyarakat) {
    die("Query failed: " . odbc_errormsg());
}
?>

<!-- ================ List of Users/Masyarakat ================ -->
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
    <div class="recentCustomers">
        <div class="cardHeader">
            <h2>List of Users</h2>
        </div>

        <table>
            <thead>
                <tr>
                    <td>NIK</td>
                    <td>Nama</td>
                    <td>Username</td>
                    <td>No. Telepon</td>
                    <!-- Tambahkan kolom lain yang diperlukan -->
                </tr>
            </thead>

            <tbody>
                <?php
                while ($rowMasyarakat = odbc_fetch_array($resultMasyarakat)) {
                ?>
                    <tr>
                        <td><?php echo $rowMasyarakat['nik']; ?></td>
                        <td><?php echo $rowMasyarakat['nama']; ?></td>
                        <td><?php echo $rowMasyarakat['username']; ?></td>
                        <td><?php echo $rowMasyarakat['noTelp']; ?></td>
                        <!-- Tambahkan baris lain sesuai dengan kolom yang diperlukan -->
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>
