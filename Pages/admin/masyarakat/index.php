<?php
require_once 'functions/Class/User.php'; // Sesuaikan dengan path ke class User

$user = new User();

// Menampilkan data pengguna
$allUsers = $user->getUsers();

// Menambahkan user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Anda perlu menambahkan input untuk password di dalam form juga
    $noTelp = $_POST['noTelp'];

    $user->addUser($nik, $nama, $username, $password, $noTelp);
    // Setelah menambahkan user, Anda bisa redirect atau refresh halaman untuk menampilkan perubahan
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
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
        <div class="recentCustomers">
            <div class="cardHeader">
                <h2>List of Users</h2>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    tambah
                </button>
            </div>

            <table>
                <thead>
                    <tr>
                        <td>NIK</td>
                        <td>Nama</td>
                        <td>Username</td>
                        <td>Password</td>
                        <td>No. Telepon</td>
                        <!-- Tambahkan kolom lain sesuai kebutuhan -->
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($allUsers as $userData) : ?>
                        <tr>
                            <td><?php echo $userData['nik']; ?></td>
                            <td><?php echo $userData['nama']; ?></td>
                            <td><?php echo $userData['username']; ?></td>
                            <td><?php echo isset($userData['password']) ? $userData['password'] : ''; ?></td>
                            <td><?php echo $userData['noTelp']; ?></td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>



</div>

<!-- Bagian modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk menambahkan data -->
                <form id="addUserForm" method="post" action="">
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK:</label>
                        <input type="text" class="form-control" name="nik" id="nik" required>
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama:</label>
                        <input type="text" class="form-control" name="nama" id="nama" required>
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="noTelp" class="form-label">No. Telepon:</label>
                        <input type="text" class="form-control" name="noTelp" id="noTelp" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Tambahkan script untuk library atau fungsi lainnya di sini -->
<!-- Tambahkan script untuk library atau fungsi lainnya di sini -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myModal = new bootstrap.Modal(document.getElementById('addUserModal'));

        function addUser() {
            // Mendapatkan nilai dari form tambah user
            var nik = document.getElementById('nik').value;
            var nama = document.getElementById('nama').value;
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value; // Anda perlu menambahkan input untuk password di dalam form juga
            var noTelp = document.getElementById('noTelp').value;

            // Mengirim data ke PHP menggunakan AJAX
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Jika berhasil tambah user, Anda bisa menutup modal dan melakukan refresh halaman atau menampilkan pesan sukses
                    myModal.hide();
                    window.location.reload();
                }
            };

            xhr.open('POST', 'index.php', true); // Sesuaikan dengan nama file Anda
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('nik=' + nik + '&nama=' + nama + '&username=' + username + '&password=' + password + '&noTelp=' + noTelp);
        }

        document.getElementById('addUserForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Mencegah form submit secara default
            addUser(); // Panggil fungsi addUser
        });
    });
</script>