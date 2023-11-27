<?php
$serverName = "DESKTOP-322D3F1";
$database = "finalfprojectbasdat";
$uid = "";
$pass = "";

$connection = [
    "Database" => $database,
    "Uid" => $uid,
    "PWD" => $pass
];

$koneksi = sqlsrv_connect($serverName, $connection);

if (!$koneksi) {
    die(print_r(sqlsrv_errors(), true));
}else{
    echo 'berhasil';
}
?>