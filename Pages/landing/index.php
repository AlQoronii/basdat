<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <!-- Tautan CDN CSS AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
    <!-- Tautan CDN Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        footer {
            margin-top: 50px;
            background-color: #1E2A3A;
            color: #fff;
            padding-top: 50px;
        }

        .hero {
            background-image: url('path/to/your-image.jpg');
            background-size: cover;
            background-position: center;
            color: #fff;
            padding: 100px 0;
        }

        .hero h2 {
            font-size: 2.5em;
        }

        .hero p {
            font-size: 1.2em;
            margin-bottom: 30px;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5em;
        }

        .navbar-nav .nav-item {
            margin-right: 15px;
        }

        /* Additional Styles for About Section */
        #about {
            margin-top: 110px;
            background-color: #f8f9fa;
            /* Light gray background */
            padding: 80px 0;
        }

        .section-title {
            color: #007bff;
            /* Primary color for the title */
            font-size: 2.5em;
        }

        .section-description {
            font-size: 1.2em;
            color: #6c757d;
            /* Medium gray text color */
            line-height: 1.6;
        }



        /* Add more styles for other sections as needed */
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Pengadu</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#team">Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-success text-white" href="../login/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-light" href="#">Daftar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Hero Section -->
    <section id="hero " class="hero d-flex align-items-center justify-content-center mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="text-dark">
                        <h2 class="text-uppercase">Selamat Datang di Pengadu!</h2>
                        <p>Temukan solusi untuk masalah Anda dengan layanan pengaduan kami.</p>
                        <a href="#contact" class="btn btn-primary btn-lg mt-3">Ajukan Pengaduan</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Gambar atau konten visual di sini -->
                    <img src="../../img/Hero-Image.svg" width="450px" alt="Image">
                </div>
            </div>
        </div>
    </section>
    <br>
    <!-- About Section -->
    <section id="about" class="d-flex align-items-center justify-content-center mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <h2 class="section-title text-dark mb-4">Tentang Pengadu</h2>
                    <p class="section-description">
                        Pengadu adalah platform pengaduan online yang memudahkan Anda untuk menyampaikan dan menyelesaikan masalah dengan cepat dan efisien. Dengan layanan kami, Anda dapat dengan mudah mengajukan pengaduan, mengikuti perkembangan pengaduan Anda, dan berinteraksi dengan tim pendukung kami.
                    </p>
                    <p class="section-description">
                        Kami bertekad untuk memberikan solusi terbaik bagi setiap masalah yang Anda hadapi. Pengadu memprioritaskan kepuasan pengguna dan berkomitmen untuk memberikan layanan yang transparan, aman, dan dapat diandalkan.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer Section -->
    <footer>
        <div class="container pd-5">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4 pd-5">
                    <h5 class="mb-3">Pengadu</h5>
                    <p>Selamat datang di aplikasi Pengadu! Aplikasi yang membantu Anda untuk melakukan pengaduan secara online.</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="mb-1">Contact</h5>
                    <p class="mb-1">Email:</p>
                    <p>support@pengadu.com</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="mb-1">Opening Hours</h5>
                    <table class="table" style="color: #ddd;">
                        <tbody>
                            <tr>
                                <td>Mon - Fri:</td>
                                <td>9am - 5pm</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </footer>

    <!-- Script AdminLTE dan Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>

</body>

</html>