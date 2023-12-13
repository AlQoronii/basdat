<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/b450899c31.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../../assets/css/styleLogin.css" />
    <title>Sign in & Sign up Form</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="../../functions/proses_login.php" class="sign-in-form" method="POST">
                    <h2 class="title">Masuk</h2>
                    <a href="./indexAdmin.php">Admin Login Disini</a>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" placeholder="Username" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" />
                    </div>
                    <input type="submit" class="btn" value="Masuk" />

                </form>
                <form action="../../functions/proses_register.php" method="POST" class="sign-up-form">
                    <h2 class="title">Daftar</h2>
                    <div class="input-field">
                        <i class="fa-solid fa-user-lock"></i>
                        <input type="number" name="nik" placeholder="NIK" required />
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-user-lock"></i>
                        <input type="text" name="nama" placeholder="Nama" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" placeholder="Username" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required />
                    </div>
                    <div class="col-8">
                        <a href="../landing/index.php" style="text-decoration:none;"><span style="color:black; ">Kembali ke-home </span>klik disini</a>
                    </div>
                    <input type="submit" value="Daftar" class="btn solid" />

                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Baru disini ?</h3>
                    <p>
                        Yuk segera daftarkan dirimu untuk mengajukan aduan
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Daftar
                    </button>
                </div>
                <img src="../../img/log.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Sudah jadi bagian dari kami ?</h3>
                    <p>
                        Silahkan login disini
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Masuk
                    </button>
                </div>
                <img src="../../img/register.svg" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="../../assets/js/app.js"></script>
</body>

</html>