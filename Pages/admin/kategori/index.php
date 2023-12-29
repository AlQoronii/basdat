<?php
require_once 'functions/Class/Kategori.php'; // Adjust the path to the Kategori class

$kategori = new Kategori();
$allKategori = $kategori->getAllKategori();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['addKategori'])) {
        $nama_kategori = $_POST['nama_kategori'];
        $kategori->addKategori($nama_kategori);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    if (isset($_POST['editKategori'])) {
        $id_kategori = $_POST['id_kategori'];
        $editNamaKategori = isset($_POST['editNamaKategori']) ? $_POST['editNamaKategori'] : '';
        $kategori->editKategori($id_kategori, $editNamaKategori);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    if (isset($_POST['confirmDeleteKategori'])) {
        $id_kategori_to_delete = $_POST['confirmDeleteKategori'];

        $result = $kategori->deleteKategori($id_kategori_to_delete);

        if ($result) {
            echo json_encode(["status" => "success", "message" => "Kategori deleted successfully."]);
            header('Location: index.php?page=kategori');
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to delete kategori."]);
        }
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add your head content here, e.g., meta tags, CSS links, etc. -->
</head>

<body>

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
            <div class="recentCategories">
                <div class="cardHeader">
                    <h2>List of Categories</h2>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKategoriModal">
                        Add Category
                    </button>
                </div>

                <!-- Display Categories in a table -->
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <td>ID Category</td>
                            <td>Name Category</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allKategori as $kategoriData) : ?>
                            <tr>
                                <td><?php echo $kategoriData['id_kategori']; ?></td>
                                <td><?php echo $kategoriData['nama_kategori']; ?></td>
                                <td>
                                    <!-- Button to edit category -->
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editKategoriModal<?php echo $kategoriData['id_kategori']; ?>">
                                        Edit
                                    </button>

                                    <!-- Modal for editing category -->
                                    <div class="modal fade" id="editKategoriModal<?php echo $kategoriData['id_kategori']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Form for editing data -->
                                                    <form id="editKategoriForm<?php echo $kategoriData['id_kategori']; ?>" method="post" action="">
                                                        <input type="hidden" name="id_kategori" value="<?php echo $kategoriData['id_kategori']; ?>">

                                                        <div class="mb-3">
                                                            <label for="editNamaKategori" class="form-label">Nama Kategori:</label>
                                                            <input type="text" class="form-control" name="editNamaKategori" id="editNamaKategori" value="<?php echo $kategoriData['nama_kategori']; ?>" required>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary" name="editKategori">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Button to delete category -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteKategoriModal<?php echo $kategoriData['id_kategori']; ?>">
                                        Delete
                                    </button>

                                    <!-- Confirm Delete Modal -->
                                    <div class="modal fade" id="confirmDeleteKategoriModal<?php echo $kategoriData['id_kategori']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Confirm Delete Kategori</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete this category?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <form id="deleteKategoriForm<?php echo $kategoriData['id_kategori']; ?>" method="post" action="">
                                                        <input type="hidden" name="confirmDeleteKategori" value="<?php echo $kategoriData['id_kategori']; ?>">
                                                        <button type="submit" class="btn btn-danger" name="deleteKategori">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for adding category -->
    <div class="modal fade" id="addKategoriModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for adding data -->
                    <form id="addKategoriForm" method="post" action="">
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">Nama Kategori:</label>
                            <input type="text" class="form-control" name="nama_kategori" id="nama_kategori" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="addKategori">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Your scripts and any necessary libraries go here -->

</body>

</html>