<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Pengaduan Masyarakat Kota Malang</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('../../assets/bg2.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
if (isset($_GET['id_pengaduan'])) {
    $id_pengaduan = filter_var($_GET['id_pengaduan'], FILTER_SANITIZE_NUMBER_INT);

    include_once("../../config/koneksi.php");

    $query = "SELECT * FROM tanggapan WHERE id_pengaduan = '" . $id_pengaduan . "'";
    $result = odbc_exec($connection, $query);

    if ($result === false) {
        die(odbc_errormsg($connection));  // Output any SQL errors
    }

    // Fetch a single row as an associative array
    $data = odbc_fetch_array($result);


?>

<div class="container">
    <br>
    <div class="row mt-5 mb-5">
        <div class="row">
            <div class="col-md-6">
                <h5 class="text-warning">Tanggapan Pengaduan</h5>
                <hr width="100" class="text-right" style="height: 2px; color: blue;">
                <br>

                <?php if (!empty($data)): ?>
                    <div class="card shadow" id="card-cart">
                        <div class="card-body">
                            <?php
                            $text = $data['tanggapan'];
                            $tanggapan = substr($text, 0, 200) . '...';
                            ?>
                            <h5 class="text-warning">Tanggapan - <?php echo $data['tgl_tanggapan']; ?></h5>
                            <hr>
                            <?php echo $tanggapan; ?>
                            <hr>
                            <a href="#" id="swalButton" class="btn btn-warning px-5 text-light float-right"
   style="border-radius: 25px;">Detail</a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="card shadow" id="card-cart">
                        <div class="card-body">
                            <h5>Tidak ada tanggapan</h5>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <br>
    </div>
</div>

<?php if (!empty($data)): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript"> 
    $(document).ready(function () {
        $("#swalButton").click(function() {
            var textFromPHP = <?php echo json_encode($text); ?>;
            Swal.fire('Detail', textFromPHP);
        });
    });
</script>

<?php endif;
} ?>
</body>

</html>
