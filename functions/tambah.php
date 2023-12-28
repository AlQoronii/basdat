<?php
session_start();

$dir = "../img/";
$nik = $_SESSION['nik'];

if (isset($_POST['submit'])) {
    require '../config/koneksi.php';
    $database = new Database();
    $connection = $database->getConnection();
    // Check if the file input is set and not empty
    if (!empty($_FILES["file"]["name"])) {
        $namaFile = $_FILES["file"]["name"];
        $filePath = $dir . $namaFile;
        $tipeFile = pathinfo($filePath, PATHINFO_EXTENSION);
        $allowedExtensions = array('jpg', 'png', 'jpeg');

        // Check file type and size
        if (in_array($tipeFile, $allowedExtensions) && $_FILES["file"]["size"] < 500000) {
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)) {

                // Use parameterized query to prevent SQL injection
                $status = $_POST['status'];
                $kategori = $_POST['id_kategori'];
                $laporan = $_POST['description'];
                $img = $namaFile;

                $query = "INSERT INTO pengaduan (tanggal, nik, laporan, foto, id_kategori, id_status) 
                          VALUES (GETDATE(), ?, ?, ?, ?, ?)";

                $statement = odbc_prepare($connection, $query);

                if ($statement) {
                    // Bind parameters and execute the statement
                    $result = odbc_execute($statement, array($nik, $laporan, $img, $kategori, $status));

                    if ($result) {
                        echo "File uploaded successfully.";
                        header("Location: ../Pages/user/history.php");
                    } else {
                        // Handle the case where odbc_execute fails
                        echo "Error executing SQL statement: " . odbc_errormsg($connection);
                    }
                } else {
                    // Handle the case where odbc_prepare fails
                    echo "Error preparing SQL statement: " . odbc_errormsg($connection);
                }
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Invalid file type or size.";
        }
    } else {
        echo "File not selected.";
    }
}
?>
