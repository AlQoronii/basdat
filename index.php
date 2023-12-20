<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if (isset($_SESSION["id_petugas"]) && isset($_SESSION["level"])) {
        include "config/koneksi.php";
        $userLevel = $_SESSION["level"];

        if ($userLevel == "admin") {
            if (!empty($_GET['page'])) {
                ob_start();
                include 'Pages/admin/header.php';
                include 'Pages/admin/' . $_GET['page'] . '/index.php';
                include 'Pages/admin/footer.php';
                ob_end_flush();
            } else {
                include 'Pages/admin/indexAdmin.php';
            }
        } elseif ($userLevel == "petugas") {
            if (!empty($_GET['page'])) {
                ob_start();
                include 'Pages/petugas/header.php';
                include 'Pages/petugas/' . $_GET['page'] . '/index.php';
                include 'Pages/petugas/footer.php';
                ob_end_flush();
            } else {
                include 'Pages/petugas/indexPetugas.php';
            }
        }
    } else {
        header("Location: Pages/landing/index.php");
    }
}
