<?php
require_once '../config/koneksi.php'; // Assuming koneksi.php includes the ODBC connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $nik = $_POST["nik"];
    $nama = $_POST["nama"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Limit password length (adjust the value based on your column size)
    $password = substr($password, 0, 50); // Assuming the password column size is 50

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    echo "Length of nik: " . strlen($nik) . "<br>";
    echo "Length of nama: " . strlen($nama) . "<br>";
    echo "Length of username: " . strlen($username) . "<br>";
    echo "Length of password: " . strlen($password) . "<br>";
    echo "Length of Hashpassword: " . strlen($hashedPassword) . "<br>";
    // Insert the user data into the masyarakat table
    // Note: Adjust the SQL query based on your actual table structure
    $sql = "INSERT INTO masyarakat (nik, nama, username, password) VALUES (?, ?, ?, ?)";

    // Use prepared statements to prevent SQL injection
    $stmt = odbc_prepare($connection, $sql);

    if ($stmt) {
        // Execute the statement with parameters
        if (odbc_execute($stmt, array($nik, $nama, $username, $hashedPassword))) {
            // Check if the query was successful
            echo "Registration successful. Redirecting to login page...";
            // You can add a header redirect here
            header("Location: ../Pages/login/index.php");
        } else {
            echo "Registration failed. Please try again.";
        }

        // Close the statement
        odbc_free_result($stmt);
    } else {
        echo "Database error: " . odbc_errormsg();
    }

    // Close the connection
    odbc_close($connection);
} else {
    // Handle invalid request method
    echo "Invalid request method.";
}
