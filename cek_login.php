<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "config/koneksi.php";
include "fungsi/pesan_kilat.php";
include "fungsi/anti_injection.php";

// Validate the presence of username and password in the POST request
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    pesan('danger', "Login gagal. Username atau password tidak valid.");
    header("Location: login.php");
    exit();
}

// Sanitize user input to prevent SQL injection
$username = antiinjection($koneksi, $_POST['username']);
$password = antiinjection($koneksi, $_POST['password']);

// Prepare and execute the SQL query
$query = "SELECT username, password from admin";
$params = array($username);
$result = sqlsrv_query($koneksi, $query, $params);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

$rowCount = sqlsrv_num_rows($result);

if ($rowCount > 0) {
    // Fetch the result row
    $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);

    // Check if password matches using password_verify
    if (password_verify($password, $row['password'])) {
        $_SESSION['username'] = $row['username'];
        header("Location: index.php");
        exit();
    } else {
        pesan('danger', "Login gagal. Password Anda Salah");
        header("Location: login.php");
        exit();
    }
} else {
    pesan('warning', "Username tidak ditemukan.");
    header("Location: login.php");
    exit();
}

sqlsrv_close($koneksi);
?>




/*$query = "select username, password from admin where username = '$username'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
mysqli_close($koneksi);

if(password_verify($row['password'])){
    $_SESSION['username'] = $row['username'];
    header("Location: index.php");
}else{
    ?
}*/

?>
