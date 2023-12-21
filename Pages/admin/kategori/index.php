<?php
require_once 'functions/Class/Kategori.php'; // Sesuaikan dengan path ke class Kategori

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
        $editNamaKategori = $_POST['editNamaKategori'];
        $kategori->editKategori($id_kategori, $editNamaKategori);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    if (isset($_POST['confirmDeleteKategori'])) {
        $id_kategori_to_delete = $_POST['confirmDeleteKategori'];
        $kategori->deleteKategori($id_kategori_to_delete);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
