<?php
require_once 'functions/Class/Petugas.php'; // Sesuaikan dengan path ke class Petugas

$petugas = new Petugas();
// Menampilkan data petugas
$allPetugas = $petugas->getAllPetugas();

// Menambahkan petugas
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addPetugas'])) {
    $nama_petugas = $_POST['nama_petugas'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $telp = $_POST['telp'];
    $level = $_POST['level'];

    $petugas->addPetugas($nama_petugas, $username, $password, $telp, $level);
    // Setelah menambahkan petugas, Anda bisa redirect atau refresh halaman untuk menampilkan perubahan
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Menangani penyuntingan petugas
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editPetugas'])) {
    $id_petugas = $_POST['id_petugas'];
    $editNamaPetugas = isset($_POST['editNamaPetugas']) ? $_POST['editNamaPetugas'] : '';
    $editUsername = isset($_POST['editUsername']) ? $_POST['editUsername'] : '';
    $editPassword = isset($_POST['editPassword']) ? $_POST['editPassword'] : '';
    $editTelp = isset($_POST['editTelp']) ? $_POST['editTelp'] : '';
    $editLevel = isset($_POST['editLevel']) ? $_POST['editLevel'] : '';

    // Panggil metode editPetugas yang mungkin telah Anda buat di kelas Petugas
    $petugas->editPetugas($id_petugas, $editNamaPetugas, $editUsername, $editPassword, $editTelp, $editLevel);

    // Setelah menyunting petugas, Anda bisa redirect atau refresh halaman untuk menampilkan perubahan
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Menangani penghapusan petugas
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmDeletePetugas'])) {
    $id_petugas_to_delete = $_POST['confirmDeletePetugas'];

    $result = $petugas->deletePetugas($id_petugas_to_delete);

    if ($result) {
        echo json_encode(["status" => "success", "message" => "Petugas deleted successfully."]);
        header('Location: index.php?page=petugas');
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to delete petugas."]);
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
                <h2>List of Petugas</h2>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPetugasModal">
                    Tambah
                </button>
            </div>

            <table class="table table-responsive">
                <thead>
                    <tr>
                        <td>ID Petugas</td>
                        <td>Nama Petugas</td>
                        <td>Username</td>
                        <td>Password</td>
                        <td>No. Telepon</td>
                        <td>Level</td>
                        <td>Aksi</td>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($allPetugas as $petugasData) : ?>
                        <tr>
                            <td><?php echo $petugasData['id_petugas']; ?></td>
                            <td><?php echo $petugasData['nama_petugas']; ?></td>
                            <td><?php echo $petugasData['username']; ?></td>
                            <td><?php echo isset($petugasData['password']) ? $petugasData['password'] : ''; ?></td>
                            <td><?php echo $petugasData['telp']; ?></td>
                            <td><?php echo $petugasData['level']; ?></td>
                            <td>
                                <!-- Inside the foreach loop for displaying petugas data -->
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editPetugasModal<?php echo $petugasData['id_petugas']; ?>">
                                    Edit
                                </button>

                                <!-- Modal for edit -->
                                <div class="modal fade" id="editPetugasModal<?php echo $petugasData['id_petugas']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Petugas</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form for editing data -->
                                                <form id="editPetugasForm<?php echo $petugasData['id_petugas']; ?>" method="post" action="">
                                                    <input type="hidden" name="id_petugas" value="<?php echo $petugasData['id_petugas']; ?>">

                                                    <div class="mb-3">
                                                        <label for="editNamaPetugas" class="form-label">Nama Petugas:</label>
                                                        <input type="text" class="form-control" name="editNamaPetugas" id="editNamaPetugas" value="<?php echo $petugasData['nama_petugas']; ?>" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="editUsername" class="form-label">Username:</label>
                                                        <input type="text" class="form-control" name="editUsername" id="editUsername" value="<?php echo $petugasData['username']; ?>" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="editPassword" class="form-label">Password:</label>
                                                        <input type="password" class="form-control" name="editPassword" id="editPassword">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="editTelp" class="form-label">No. Telepon:</label>
                                                        <input type="text" class="form-control" name="editTelp" id="editTelp" value="<?php echo $petugasData['telp']; ?>" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="editLevel" class="form-label">Level:</label>
                                                        <input type="text" class="form-control" name="editLevel" id="editLevel" value="<?php echo $petugasData['level']; ?>" required>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" name="editPetugas">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Inside the foreach loop -->
                                <form id="deletePetugasForm<?php echo $petugasData['id_petugas']; ?>" method="post" action="">
                                    <input type="hidden" name="confirmDeletePetugas" value="<?php echo $petugasData['id_petugas']; ?>">
                                    <button type="submit" class="btn btn-danger" name="deletePetugas">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bagian modal -->
<div class="modal fade" id="addPetugasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Petugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk menambahkan data -->
                <form id="addPetugasForm" method="post" action="">
                    <div class="mb-3">
                        <label for="nama_petugas" class="form-label">Nama Petugas:</label>
                        <input type="text" class="form-control" name="nama_petugas" id="nama_petugas" required>
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
                        <label for="telp" class="form-label">No. Telepon:</label>
                        <input type="text" class="form-control" name="telp" id="telp" required>
                    </div>

                    <div class="mb-3">
                        <label for="level" class="form-label">Level:</label>
                        <input type="text" class="form-control" name="level" id="level" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="addPetugas">Tambahkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan script untuk library atau fungsi lainnya di sini -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myModal = new bootstrap.Modal(document.getElementById('addPetugasModal'));
    });
</script>