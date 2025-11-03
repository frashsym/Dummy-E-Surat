<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap Offline -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">

    <!-- Custom Style -->
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Poppins', sans-serif;
        }
        .navbar {
            background: linear-gradient(90deg, #4f46e5, #9333ea);
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
            font-weight: 500;
        }
        .hero-section {
            margin-top: 2rem;
        }
        .card-service {
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform .2s ease;
        }
        .card-service:hover {
            transform: translateY(-5px);
        }
        footer {
            background: #facc15;
            padding: 20px 0;
            color: #000;
            font-weight: 500;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" height="50" class="me-2">
                <span>Fakultas Ekonomi dan Bisnis<br>Universitas Swadaya Gunung Jati</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="#home" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="#layanan" class="nav-link">Layanan</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero / Slider -->
    <section id="home" class="hero-section container mt-4">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner rounded-4 shadow">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/img/home.jpg') }}" class="d-block w-100" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/img/home.jpg') }}" class="d-block w-100" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/img/home.jpg') }}" class="d-block w-100" alt="Slide 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </section>

    <!-- Layanan -->
    <section id="layanan" class="container text-center mt-5 mb-5">
        <h2 class="fw-bold mb-4">Layanan</h2>
        <div class="row justify-content-center g-4">
            <div class="col-md-3">
                <div class="card card-service py-4">
                    <img src="{{ asset('assets/images/mail.png') }}" alt="E-Surat" class="mx-auto mb-3" width="70">
                    <h5 class="fw-semibold">E-Surat</h5>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-service py-4">
                    <img src="{{ asset('assets/images/star.png') }}" alt="Penilaian Kinerja" class="mx-auto mb-3" width="70">
                    <h5 class="fw-semibold">Penilaian Kinerja</h5>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-service py-4">
                    <img src="{{ asset('assets/images/team.png') }}" alt="Layanan Karir" class="mx-auto mb-3" width="70">
                    <h5 class="fw-semibold">Layanan Karir</h5>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" height="50">
        <p class="mt-2 mb-0">Fakultas Ekonomi dan Bisnis - Universitas Swadaya Gunung Jati</p>
    </footer>

    <!-- Bootstrap JS Offline -->
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
