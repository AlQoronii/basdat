<?php
include_once '../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = isset($_POST["username"]) ? $_POST["username"] : '';
    $password = isset($_POST["password"]) ? $_POST["password"] : '';

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
                if (password_verify($password, $result['password'])) {
                    // Password is correct, set session variables or perform other actions
                    session_start();
                    $_SESSION['id_petugas'] = $result['id_petugas'];
                    $_SESSION['nama_petugas'] = $result['nama_petugas'];
                    $_SESSION['level'] = $result['level'];

                    // Redirect based on the user's level
                    if ($result['level'] == 'admin') {
                        header("Location: ../Pages/admin/index.php");
                    } elseif ($result['level'] == 'petugas') {
                        header("Location: ../Pages/petugas/index.php");
                    } else {
                        echo "Unknown user level. Please contact the administrator.";
                    }
                    exit; // Stop further execution after redirect
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
