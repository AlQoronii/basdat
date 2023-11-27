<?php
function antiinjection($koneksi, $data)
{
    $query = "SELECT * FROM admin WHERE username=? AND password=?";
    $parameters = [$_POST["username"], $_POST["password"]];
    $result = sqlsrv_query($koneksi, $query, $parameters);
    }

?>