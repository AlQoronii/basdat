<?php
class Database
{   
    private $serverName = "DESKTOP-322D3F1";
    private $database = "db_pengaduan";
    private $dsn; // Added the $dsn property

    private $connection;

    public function __construct()
    {
        // Set the $dsn property here
        $this->dsn = "Driver={SQL Server};Server=$this->serverName;Database=$this->database;";

        // Use the $this->dsn property in the odbc_connect function
        $this->connection = odbc_connect($this->dsn, "", "");

        if (!$this->connection) {
            die("Connection failed: " . odbc_errormsg());
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function executeQuery($connection, $query)
    {
        $result = odbc_exec($connection, $query);

        if (!$result) {
            die("Query failed: " . odbc_errormsg());
        }

        return $result;
    }
}
