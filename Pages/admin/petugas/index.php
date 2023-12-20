<?php


// Query untuk mengambil data petugas
$queryPetugas = "SELECT * FROM petugas"; // Sesuaikan dengan kolom yang diperlukan

// Melakukan query ke database
$resultPetugas = odbc_exec($connection, $queryPetugas);

// Mengecek apakah query berhasil dieksekusi
if (!$resultPetugas) {
    die("Query failed: " . odbc_errormsg());
}
?>

<!-- ================ List of Officers/Petugas ================ -->
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
            <h2>List of Officers</h2>
        </div>

        <table>
            <thead>
                <tr>
                    <td>ID Petugas</td>
                    <td>Nama Petugas</td>
                    <td>Username</td>
                    <td>No. Telepon</td>
                    <td>Level</td>
                    <!-- Tambahkan kolom lain yang diperlukan -->
                </tr>
            </thead>

            <tbody>
                <?php
                while ($rowPetugas = odbc_fetch_array($resultPetugas)) {
                ?>
                    <tr>
                        <td><?php echo $rowPetugas['id_petugas']; ?></td>
                        <td><?php echo $rowPetugas['nama_petugas']; ?></td>
                        <td><?php echo $rowPetugas['username']; ?></td>
                        <td><?php echo $rowPetugas['telp']; ?></td>
                        <td><?php echo $rowPetugas['level']; ?></td>
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
