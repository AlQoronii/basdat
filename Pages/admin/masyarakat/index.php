<?php
require_once 'functions/Class/User.php'; // Sesuaikan dengan path ke class User

$user = new User();
// Menampilkan data pengguna
$allUsers = $user->getUsers();
// Menambahkan user
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addUser'])) {
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

// Menangani penyuntingan user
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editUser'])) {
    $user = new User();

    $nik = $_POST['nik'];
    $editNama = isset($_POST['editNama']) ? $_POST['editNama'] : '';
    $editUsername = isset($_POST['editUsername']) ? $_POST['editUsername'] : '';
    $editPassword = isset($_POST['editPassword']) ? $_POST['editPassword'] : '';
    $editNoTelp = isset($_POST['editNoTelp']) ? $_POST['editNoTelp'] : '';

    // Panggil metode editUser yang mungkin telah Anda buat di kelas User
    $user->editUser($nik, $editNama, $editUsername, $editPassword, $editNoTelp);

    // Setelah menyunting user, Anda bisa redirect atau refresh halaman untuk menampilkan perubahan
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmDeleteUser'])) {
    $user = new User();
    $nik_to_delete = $_POST['confirmDeleteUser'];

    $result = $user->deleteUser($nik_to_delete);

    if ($result) {
        echo json_encode(["status" => "success", "message" => "User deleted successfully."]);
        header('Location: index.php?page=masyarakat');
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to delete user."]);
    }
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

            <table class="table table-responsive">
                <thead>
                    <tr>
                        <td>NIK</td>
                        <td>Nama</td>
                        <td>Username</td>
                        <td>Password</td>
                        <td>No. Telepon</td>
                        <td>Aksi</td>
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
                            <div class="d-flex">
                                <td>
                                    <!-- Tombol atau ikon edit dan delete -->
                                    <button type="button" class="btn btn-warning " data-bs-toggle="modal" data-bs-target="#editUserModal<?php echo $userData['nik']; ?>">
                                        Edit
                                    </button>

                                    <!-- Bagian modal edit -->
                                    <div class="modal fade" id="editUserModal<?php echo $userData['nik']; ?>" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark" id="editUserModalLabel">Edit User</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Form untuk menyunting data -->
                                                    <form id="editUserForm<?php echo $userData['nik']; ?>" method="post" action="">
                                                        <div class="mb-3">
                                                            <label for="editNama" class="form-label text-dark">Nama:</label>
                                                            <input type="text" class="form-control" name="editNama" id="editNama<?php echo $userData['nik']; ?>" value="<?php echo $userData['nama']; ?>" required>
                                                        </div>

                                                        <!-- Sisipkan input untuk data lain yang ingin disunting -->
                                                        <div class="mb-3">
                                                            <label for="editUsername" class="form-label text-dark">Username:</label>
                                                            <input type="text" class="form-control" name="editUsername" id="editUsername<?php echo $userData['nik']; ?>" value="<?php echo $userData['username']; ?>" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="editPassword" class="form-label text-dark">Password:</label>
                                                            <input type="password" class="form-control" name="editPassword" id="editPassword<?php echo $userData['nik']; ?>">
                                                            <small class="text-muted">Kosongkan jika tidak ingin mengganti password</small>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="editNoTelp" class="form-label text-dark">No. Telepon:</label>
                                                            <input type="text" class="form-control" name="editNoTelp" id="editNoTelp<?php echo $userData['nik']; ?>" value="<?php echo $userData['noTelp']; ?>" required>
                                                        </div>

                                                        <input type="hidden" name="nik" value="<?php echo $userData['nik']; ?>">

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary" name="editUser">Simpan Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Inside the foreach loop -->
                                    <form id="deleteForm<?php echo $userData['nik']; ?>" method="post" action="">
                                        <input type="hidden" name="confirmDeleteUser" value="<?php echo $userData['nik']; ?>">
                                        <button type="submit" class="delete-user btn btn-danger btn-xs">Hapus</button>
                                    </form>

                                </td>
                            </div>
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
                        <button type="submit" class="btn btn-primary" name="addUser">Tambahkan</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Tambahkan script untuk library atau fungsi lainnya di sini -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myModal = new bootstrap.Modal(document.getElementById('addUserModal'));
    });
</script>