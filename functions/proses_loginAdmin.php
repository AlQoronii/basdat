<?php
include_once 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate and sanitize input (add more validation as needed)
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    // Query the database to check petugas credentials
    $sql = "SELECT id_petugas, username, password, level FROM petugas WHERE username = ?";
    $stmt = odbc_prepare($connection, $sql);

    if ($stmt) {
        // Execute the statement with parameters
        if (odbc_execute($stmt, array($username))) {
            // Fetch the result
            $row = odbc_fetch_array($stmt);

            if ($row && password_verify($password, $row['password'])) {
                // Login successful, create session
                session_start();
                $_SESSION['user_id'] = $row['id_petugas'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['level'] = $row['level'];

                // Redirect to the petugas dashboard
                header("Location: petugas_dashboard.php");
                exit();
            } else {
                // Invalid username or password
                echo "Invalid username or password. Please try again.";
            }
        } else {
            echo "Database error: " . odbc_errormsg();
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
