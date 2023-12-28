<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Pengaduan Masyarakat Kota Malang</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">

    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-image: url('../../assets/12.jpg'); /* Replace 'path/to/your/bg2.png' with the actual path to your image */
    background-size: cover; /* This property ensures that the background image covers the entire viewport */
    background-repeat: no-repeat; /* This property prevents the background image from repeating */
    background-position: center center; /* This property centers the background image */
}
        

        header {                                                       



            
            background-color: #007bff;
            color: white;
            padding: 1em 0;
            text-align: center;
        }

        h1 {
            font-size: 1.5em;
            margin-top: 0.5em;
        }

        section {
            margin: 2em;
        }

        form {
            max-width: 600px;
            margin: auto;
            background-color: white;
            padding: 2em;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 123, 255, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        form:hover {
            transform: scale(1.02);
        }

        input,
        textarea {
            width: 100%;
            padding: 1em;
            margin-bottom: 1.5em;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f8f9fa;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 1em 1.5em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }


    </style>
</head>
<?php
    include "../../config/koneksi.php";

    $database = new Database();
    $connection = $database->getConnection();
?>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#"><h5><b>Pengadu</b></h5></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><h5>Home</h5></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="history.php"><h5>History</h5></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-white" href="../../functions/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<section class="content">
    <form id="complaintForm" method="POST" enctype="multipart/form-data" action="../../functions/tambah.php">
        <?php
            $query3 = "SELECT * FROM status_pengaduan";
            $result3 = odbc_exec($connection, $query3);
            $row3 = odbc_fetch_array($result3);
        ?>
        <input type="hidden" name="status" value="<?= $row3['id_status']?>">
        <div class="mb-3">
            <label for="id_kategori" class="form-label">Kategori:</label>
            <select name="id_kategori" class="form-select" aria-label="Default select example">
                <option selected>Pilih Kategori</option>
                <?php
                $query2 = "SELECT * FROM kategori";
                $result2 = odbc_exec($connection, $query2);
                while ($row2 = odbc_fetch_array($result2)) {
                ?>
                    <option value="<?= $row2['id_kategori'] ?>"><?= $row2['nama_kategori'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <textarea id="description" name="description" class="form-control" rows="4" placeholder="Deskripsi" required></textarea>
        </div>
        <div class="mb-3 row form-group">
            <label for="">Foto :</label>
            <div class="col-sm-12">
                <input type="file" class="form-control" name="file" required>
            </div>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Kirim Pengaduan</button>
    </form>
</section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>
</body>

</html>
