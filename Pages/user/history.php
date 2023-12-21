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
    background-image: url('../../assets/bg2.png'); /* Replace 'path/to/your/bg2.png' with the actual path to your image */
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
                        <a class="nav-link" href="../../functions/logout.php"><h5>Logout</h5></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();


// Check if the user is logged in
if (!isset($_SESSION["nik"]) || !isset($_SESSION["password"])) {
    // Redirect to the login page or handle accordingly
    header("Location: login.php");
    exit();
}

// Retrieve username and password from the session
$nik = $_SESSION["nik"];
$userpassword = $_SESSION["password"];



// Include your database connection file or establish a connection here
include_once("../../config/koneksi.php"); // Adjust the path accordingly
$database = new Database();
$connection = $database->getConnection();
// Query the database for pengaduan history
$query = "SELECT p.id_pengaduan, p.tanggal, p.nik, p.laporan, 
p.foto, p.id_kategori, p.id_status,
m.nama, m.username, m.noTelp,
sp.nama_status
FROM pengaduan p
JOIN masyarakat m ON p.nik = m.nik
JOIN status_pengaduan sp ON p.id_status = sp.id_status
WHERE m.nik = ?";

$stmt = odbc_prepare($connection, $query);

if ($stmt) {
    // Bind the parameter directly in the SQL statement
    odbc_execute($stmt, array($nik));

    // Fetch all results as an associative array
    $results = array();
    while ($row = odbc_fetch_array($stmt)) {
        $results[] = $row;
    }
    ?>

    <section class="content">
        <div class="row justify-content-center">
        <h3 class="text-warning">History pengaduan</h3>
                        <hr width="100" class="text-right" style="height: 2px; color: blue;">
                        <br>
            <?php if (!empty($results)): ?>
                <?php foreach ($results as $item): ?>
                    <?php $kode = 'MP135'.$item['id_pengaduan'] ?>
                    <div class="col-md-6">
                        <!-- Your HTML code for displaying individual result items goes here -->
                        
                        <div class="card mr-3" id="card-cart" style="box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2);" style="width: 25rem; height: 18rem;">
                            <div class="card-body">
                                <h5 class="text-warning"><?php echo $kode; ?> | <?php echo $item['nama_status']; ?></h5>
                                <hr>
                                <div class="row">
                                <div class="col-md-4 col-12">
                                    <?php if (!empty($item['foto'])): ?>
                                        <img src="../../img/<?php echo $item['foto']; ?>" width="150" alt="Foto">
                                    <?php else: ?>
                                        <img src="../../img/nonimage.jpg" width="150" alt="Non Image">
                                    <?php endif; ?>
                                </div>

                                    <div class="col-md-8 col-12">
                                        <b>Isi pengaduan</b><br>
                                        <?php
                                            $num_char = 150;
                                            $text = $item['laporan'];
                                            $isi = substr($text, 0, $num_char).'.....';
                                        ?>
                                        <p style="text-align: justify;"><?php echo $isi; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent text-warning text-right">
                            <div class="card-footer bg-transparent text-warning text-right">
    <a href="tanggapan.php?id_pengaduan=<?= $item["id_pengaduan"] ?>" class="text-warning" data-id="<?= $item["id_pengaduan"] ?>">Lihat tanggapan</a>
</div>


                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Tidak ada pengaduan yang ditemukan.</p>
            <?php endif; ?>
        </div>
    </section>

<?php }
} ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>
</body>

</html>
