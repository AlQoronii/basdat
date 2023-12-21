<?php
class Database
{
    private $serverName = "EDDO";
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
}
