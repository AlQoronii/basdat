<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = isset($_POST["username"]) ? $_POST["username"] : '';
    $password = isset($_POST["password"]) ? $_POST["password"] : '';

    include_once '../config/koneksi.php';
    $database = new Database();
    $connection = $database->getConnection();

    if (!$connection) {
        die("Connection failed: " . odbc_errormsg());
    }

    // Query to retrieve user data based on the provided username
    $sql = "SELECT id_petugas, nama_petugas, password, level FROM petugas WHERE username = ?";

    // Use prepared statements to prevent SQL injection
    $stmt = odbc_prepare($connection, $sql);

    if ($stmt) {
        // Execute the statement with parameters
        if (odbc_execute($stmt, array($username))) {
            // Fetch the result
            $result = odbc_fetch_array($stmt);

            if ($result) {
                // Verify the password
                if ($password === $result['password']) {
                    // Password is correct, set session variables or perform other actions
                    session_start();
                     = $result['id_petugas'];
                    $_SESSION['nama_petugas'] = $result['nama_petugas'];
                    $_SESSION['level'] = $result['level'];

                    // Redirect based on the user's level
                    if ($result['level'] == 'admin' || $result['level'] == 'petugas') {
                        header("Location: ../index.php");
                        exit; // Stop further execution after redirect
                    } else {
                        echo "Unknown user level. Please contact the administrator.";
                    }
                } else {
                    echo "Invalid password. Please try again.";
                }
            } else {
                echo "User not found. Please check your username.";
            }
        } else {
            echo "Login failed. Please try again.";
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
?>
