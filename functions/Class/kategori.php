<?php
class Kategori
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function addKategori($nama_kategori)
    {
        // Batasi panjang data menjadi 10 karakter
        $nama_kategori = substr($nama_kategori, 0, 10);

        $connection = $this->database->getConnection();

        // Gunakan query-parameterized untuk mencegah SQL injection
        $query = "INSERT INTO kategori (nama_kategori) VALUES (?)";
        $stmt = odbc_prepare($connection, $query);

        // Jalankan pernyataan yang telah disiapkan dengan nilai parameter
        $result = odbc_execute($stmt, array($nama_kategori));

        if (!$result) {
            die("Query failed: " . odbc_errormsg());
        }

        return true;
    }

    public function getAllKategori()
    {
        $connection = $this->database->getConnection();
        $query = "SELECT * FROM kategori";
        $result = odbc_exec($connection, $query);

        if (!$result) {
            die("Query failed: " . odbc_errormsg());
        }

        $kategoriArray = array();
        while ($row = odbc_fetch_array($result)) {
            $kategoriArray[] = $row;
        }

        return $kategoriArray;
    }

    public function getKategoriById($id_kategori)
    {
        $connection = $this->database->getConnection();
        $query = "SELECT * FROM kategori WHERE id_kategori=?";
        $stmt = odbc_prepare($connection, $query);
        $result = odbc_execute($stmt, array($id_kategori));

        if (!$result) {
            die("Query failed: " . odbc_errormsg());
        }

        return odbc_fetch_array($stmt);
    }

    public function editKategori($id_kategori, $nama_kategori)
    {
        $connection = $this->database->getConnection();

        // Gunakan query-parameterized untuk mencegah SQL injection
        $query = "UPDATE kategori SET nama_kategori=? WHERE id_kategori=?";
        $stmt = odbc_prepare($connection, $query);

        // Jalankan pernyataan yang telah disiapkan dengan nilai parameter
        $result = odbc_execute($stmt, array($nama_kategori, $id_kategori));

        if (!$result) {
            die("Query failed: " . odbc_errormsg());
        }

        return true;
    }

    public function deleteKategori($id_kategori)
    {
        $connection = $this->database->getConnection();
        $query = "DELETE FROM kategori WHERE id_kategori=?";
        $stmt = odbc_prepare($connection, $query);
        $result = odbc_execute($stmt, array($id_kategori));

        if (!$result) {
            die("Query failed: " . odbc_errormsg());
        }

        return odbc_num_rows($stmt) > 0; // Return true if at least one row is affected (deletion is successful)
    }
}
