<?php
$serverName = "EDDO";
$database = "db_pengaduan";

// ODBC Connection
$dsn = "Driver={SQL Server};Server=$serverName;Database=$database;";
$connection = odbc_connect($dsn, "", "");

// Check the connection
if (!$connection) {
    die("ODBC connection failed: " . odbc_errormsg());
}
