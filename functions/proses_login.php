<?php
// Include koneksi.php for database connection
require_once "../config/koneksi.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query the database to check user credentials
    $sql = "SELECT id_petugas, username, password, level FROM petugas WHERE username = ?";
    $stmt = odbc_prepare($connection, $sql);

    if ($stmt) {
        // Execute the statement with parameters
        if (odbc_execute($stmt, array($username))) {
            // Fetch the result
            $row = odbc_fetch_array($stmt);

            if ($row && password_verify($password, $row['password'])) {
                // Start a session
                session_start();
                // Store user information in session variables
                $_SESSION['user_id'] = $row['id_petugas'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['level'] = $row['level'];

                // Redirect to the appropriate dashboard
                if ($row['level'] == 'admin') {
                    header("Location: admin_dashboard.php");
                } elseif ($row['level'] == 'petugas') {
                    header("Location: petugas_dashboard.php");
                }
                exit();
            } else {
                // Invalid username or password
                header("Location: login.php?error=invalid");
                exit();
            }
        } else {
            // Database error
            header("Location: login.php?error=db");
            exit();
        }

        // Close the statement
        odbc_free_result($stmt);
    } else {
        // Database error
        header("Location: login.php?error=db");
        exit();
    }

    // Close the connection
    odbc_close($connection);
} else {
    // Invalid request method
    header("Location: login.php");
    exit();
}
