<?php

class User
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function addUser($nik, $nama, $username, $password, $noTelp)
    {
        $connection = $this->database->getConnection();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO masyarakat (nik, nama, username, password, noTelp) VALUES ('$nik', '$nama', '$username', '$hashedPassword', '$noTelp')";
        $result = odbc_exec($connection, $query);

        if (!$result) {
            die("Query failed: " . odbc_errormsg());
        }

        return true;
    }

    public function getUsers()
    {
        $connection = $this->database->getConnection();
        $query = "SELECT * FROM masyarakat";
        $result = odbc_exec($connection, $query);

        if (!$result) {
            die("Query failed: " . odbc_errormsg());
        }

        $users = array();
        while ($row = odbc_fetch_array($result)) {
            $users[] = $row;
        }

        return $users;
    }

    public function getUserByNIK($nik)
    {
        $connection = $this->database->getConnection();
        $query = "SELECT * FROM masyarakat WHERE nik='$nik'";
        $result = odbc_exec($connection, $query);

        if (!$result) {
            die("Query failed: " . odbc_errormsg());
        }

        return odbc_fetch_array($result);
    }

    public function updateUser($nik, $nama, $username, $password, $noTelp)
    {
        $connection = $this->database->getConnection();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "UPDATE masyarakat SET nama='$nama', username='$username', password='$hashedPassword', noTelp='$noTelp' WHERE nik='$nik'";
        $result = odbc_exec($connection, $query);

        if (!$result) {
            die("Query failed: " . odbc_errormsg());
        }

        return true;
    }

    public function deleteUser($nik)
    {
        $connection = $this->database->getConnection();
        $query = "DELETE FROM masyarakat WHERE nik='$nik'";
        $result = odbc_exec($connection, $query);

        if (!$result) {
            die("Query failed: " . odbc_errormsg());
        }

        return true;
    }

    // Tambahkan metode lain sesuai kebutuhan
}
