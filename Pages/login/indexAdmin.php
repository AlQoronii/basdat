<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AdminLTE</title>

    <!-- Add AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">

    <!-- Add Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Add custom styles -->
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            margin: 0;
        }

        .login-box {
            width: 360px;
            margin: 0 auto;
        }

        .login-logo a {
            color: #007bff;
            font-size: 1.8rem;
            font-weight: bold;
        }

        .login-card-body {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .login-box-msg {
            margin-bottom: 20px;
            font-size: 1.2rem;
            color: #333;
            text-align: center;
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-control {
            border: 1px solid #d2d6de;
            border-radius: 4px;
            padding: 12px;
            transition: border-color 0.2s;
            width: 100%;
            font-size: 0.9rem;
            color: #495057;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: none;
        }

        .form-control+label {
            position: absolute;
            top: 0;
            left: 0;
            padding: 12px;
            pointer-events: none;
            transition: transform 0.3s, color 0.3s;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .form-control:focus+label,
        .form-control:not(:placeholder-shown)+label {
            transform: translateY(-50%) scale(0.75);
            color: #007bff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 12px;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#">Pengaduan <b>Admin</b></a>
        </div>

        <!-- /.login-logo -->
        <div class="card login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <!-- Your login form goes here -->
            <form action="../../functions/proses_loginAdmin.php" method="post">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" required>
                    <label>Username</label>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" required>
                    <label>Password</label>
                    <div class="password-toggle" onclick="togglePasswordVisibility(this)">
                        <i class="fas fa-eye-slash"></i>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <p>kembali ke home</p><a href="../landing/index.php">klik disini</a>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        </div>
        <!-- /.login-card-body -->
    </div>
    <!-- /.login-box -->

    <!-- Add AdminLTE JS -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>

    <!-- Add custom script for password toggle -->
    <script>
        function togglePasswordVisibility(icon) {
            var passwordField = document.querySelector('input[name="password"]');
            var iconElement = icon.querySelector('i');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                iconElement.classList.remove('fa-eye-slash');
                iconElement.classList.add('fa-eye');
            } else {
                passwordField.type = 'password';
                iconElement.classList.remove('fa-eye');
                iconElement.classList.add('fa-eye-slash');
            }
        }
    </script>
</body>

</html>