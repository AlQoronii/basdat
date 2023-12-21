<?php

class Petugas
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function addPetugas($nama_petugas, $username, $password, $telp, $level)
    {

        $connection = $this->database->getConnection();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $hashedPassword = substr($hashedPassword, 0, 50); // Batasi panjang hash sesuai kebutuhan

        // Gunakan query-parameterized untuk mencegah SQL injection
        $query = "INSERT INTO petugas (nama_petugas, username, password, telp, level) VALUES (?, ?, ?, ?, ?)";


        // Persiapkan pernyataan SQL
        $stmt = odbc_prepare($connection, $query);

        // Jalankan pernyataan yang telah disiapkan dengan nilai parameter
        $result = odbc_execute($stmt, array(
            $nama_petugas, $username, $hashedPassword, $telp, $level
        ));


        if (!$result) {
            die("Query gagal: " . odbc_errormsg());
        }

        return true;
    }


    public function getAllPetugas()
    {
        $connection = $this->database->getConnection();
        $query = "SELECT * FROM petugas";
        $result = odbc_exec($connection, $query);

        if (!$result) {
            die("Query failed: " . odbc_errormsg());
        }

        $petugasArray = array();
        while ($row = odbc_fetch_array($result)) {
            $petugasArray[] = $row;
        }

        return $petugasArray;
    }

    public function getPetugasById($id_petugas)
    {
        $connection = $this->database->getConnection();
        $query = "SELECT * FROM petugas WHERE id_petugas=?";
        $stmt = odbc_prepare($connection, $query);
        $result = odbc_execute($stmt, array($id_petugas));

        if (!$result) {
            die("Query failed: " . odbc_errormsg());
        }

        return odbc_fetch_array($stmt);
    }

    public function editPetugas($id_petugas, $nama_petugas, $username, $password, $telp, $level)
    {
        // Batasi panjang password menjadi maksimum 40 karakter

        // Sisanya tetap sama
        $connection = $this->database->getConnection();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $hashedPassword = substr($hashedPassword, 0, 50);
        // Gunakan query-parameterized untuk mencegah SQL injection
        $query = "UPDATE petugas SET nama_petugas=?, username=?, password=?, telp=?, level=? WHERE id_petugas=?";
        $stmt = odbc_prepare($connection, $query);

        // Jalankan pernyataan yang telah disiapkan dengan nilai parameter
        $result = odbc_execute($stmt, array($nama_petugas, $username, $hashedPassword, $telp, $level, $id_petugas));

        if (!$result) {
            die("Query failed: " . odbc_errormsg());
        }

        return true;
    }




    public function deletePetugas($id_petugas)
    {
        $connection = $this->database->getConnection();
        $query = "DELETE FROM petugas WHERE id_petugas='$id_petugas'";
        $result = odbc_exec($connection, $query);

        if (!$result) {
            die("Query failed: " . odbc_errormsg());
        }

        return odbc_num_rows($result) > 0; // Return true if at least one row is affected (deletion is successful)
    }
}
