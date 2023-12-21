<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard | Korsat X Parmaga</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/styleAdmin.css">
    <!-- Bootstrap CSS from CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-TygpuPtXnWshq8Uwru4ZrBfDewHxqzWu2Kluz9o1ur5An1LQSLtmo8gO3yZK7uf" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">

  <script src="https://kit.fontawesome.com/b450899c31.js" crossorigin="anonymous"></script>
</head>

<style>

.btn-proses {
  color: #fff;
  background-color: #0d6efd;
  border-color: #0d6efd;
}
.btn-proses:hover {
  color: #fff;
  background-color: #0b5ed7;
  border-color: #0a58ca;
}

.btn-selesai {
  color: #fff;
  background-color: #198754;
  border-color: #198754;
}
.btn-selesai:hover {
  color: #fff;
  background-color: #157347;
  border-color: #146c43;
}

.btn-coba {
  position: relative;
  padding: 5px 10px;
  background: var(--blue);
  text-decoration: none;
  color: var(--white);
  border-radius: 6px;
}

.btn-selesai {
  position: relative;
  padding: 5px 10px;
  background: green;
  text-decoration: none;
  color: var(--white);
  border-radius: 6px;
}




</style>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="logo-apple"></ion-icon>
                        </span>
                        <span class="title">Pengadu</span>
                    </a>
                </li>

                <li>
                    <a href="index.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="index.php?page=masyarakat">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Masyarakat</span>
                    </a>
                </li>

                <li>
                    <a href="index.php?page=petugas">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Petugas</span>
                    </a>
                </li>

                <li>
                    <a href="index.php?page=aduan">
                        <span class="icon">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </span>
                        <span class="title">Aduan</span>
                    </a>
                </li>

                <li>
                    <a href="index.php?page=tanggapan">
                        <span class="icon">
                            <ion-icon name="mail-open-outline"></ion-icon>
                        </span>
                        <span class="title">Tanggapan</span>
                    </a>
                </li>

                <li>
                    <a href="functions/logout.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>