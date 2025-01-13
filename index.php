<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Daily Journal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <style>
    .navbar {
        position: fixed;
        top: 0;
        width: 100%;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .nav-item {
        margin: 10px;
    }

    #hero {
        margin-top: 70px;
        padding: 50px;
        text-align: center;
    }

    #gallery img {
        border-radius: 10px;
    }

    .carousel-item img {
        object-fit: cover;
        height: 70vh;
        border-radius: 10px;
    }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">My Daily Journal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#articles">Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#gallery">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="public/login.php">Login</a>
                    </li>
                </ul>
            </div>

            <!-- Theme Switcher -->
            <div class="dropdown ms-4" id="themeDropdown">
                <button class="btn nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bi-sun-fill theme-icon-active" data-theme-icon-active="bi-sun-fill"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end my-2" aria-labelledby="dropdownMenuButton"
                    data-bs-popper="static">
                    <li>
                        <button class="dropdown-item d-flex align-items-center" type="button"
                            data-bs-theme-value="light">
                            <i class="bi bi-sun-fill me-2 opacity-50" data-theme-icon="bi-sun-fill"></i>
                            Light
                        </button>
                    </li>
                    <li>
                        <button class="dropdown-item d-flex align-items-center" type="button"
                            data-bs-theme-value="dark">
                            <i class="bi bi-moon-stars-fill me-2 opacity-50" data-theme-icon="bi-moon-stars-fill"></i>
                            Dark
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Hero Section -->
    <section id="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="img/alvin.png" class="img-fluid rounded" alt="Hero Image" />
                </div>
                <div class="col-md-6 text-md-start">
                    <h1 class="fw-bold">Create Memories, Save Memories</h1>
                    <p class="lead">
                        Mencatat semua kegiatan sehari-hari yang ada tanpa terkecuali.
                    </p>
                    <div>
                        <span id="tanggal"></span>
                        <span id="jam"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Articles Section -->
    <section id="articles" class="py-5">
        <div class="container">
            <h1 class="text-center fw-bold mb-5">Articles</h1>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php
                // Koneksi ke database
                $conn = new mysqli("localhost", "root", "", "pbw_admin");

                // Cek koneksi
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Ambil data artikel dari database
                $sql = "SELECT title, image FROM articles";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data dari setiap baris
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col">';
                        echo '    <div class="card h-100">';
                        echo '        <img src="img/' . $row["image"] . '" class="card-img-top" alt="' . $row["title"] . '" />';
                        echo '        <div class="card-body">';
                        echo '            <h5 class="card-title text-center">' . $row["title"] . '</h5>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '</div>';
                    }
                } else {
                    echo "0 results";
                }

                // Tutup koneksi
                $conn->close();
                ?>
            </div>
        </div>
    </section>
    <!-- End Content -->

    <!-- Gallery Section -->
    <section id="gallery" class="py-5">
        <div class="container">
            <h1 class="text-center fw-bold mb-5">Gallery</h1>
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/end game.jpg" class="d-block w-100" alt="End Game" />
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/inception.jpg" class="d-block w-100" alt="End Game" />
                        </div>
                        <div class="carousel-item active">
                            <img src="img/interstellar.jpg" class="d-block w-100" alt="End Game" />
                        </div>
                        <div class="carousel-item active">
                            <img src="img/parasite.jpg" class="d-block w-100" alt="End Game" />
                        </div>
                        <div class="carousel-item active">
                            <img src="img/the dark knight.jpg" class="d-block w-100" alt="End Game" />
                        </div>
                        <div class="carousel-item active">
                            <img src="img/the lord of the rings.jpg" class="d-block w-100" alt="End Game" />
                        </div>

                        <!-- Repeat for other images -->
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-4 mt-5" style="box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.1);">
        <div class="container">
            <a href="https://github.com/alvindeo"><i class="bi bi-github h5 p-1"></i></a>
            <a href="https://www.instagram.com/alvndeoo/"><i class="bi bi-instagram h5 p-1"></i></a>
            <a href="https://wa.me/+6285174455921"><i class="bi bi-whatsapp h5 p-1"></i></a>
            <p class="mb-0">Alvin Deo Ardiansyah &copy; 2024</p>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function tampilWaktu() {
        const waktu = new Date();
        const bulan = waktu.getMonth() + 1;
        document.getElementById(
            "tanggal"
        ).innerText = `${waktu.getDate()}/${bulan}/${waktu.getFullYear()}`;
        document.getElementById(
            "jam"
        ).innerText = `${waktu.getHours()}:${waktu.getMinutes()}:${waktu.getSeconds()}`;
        setTimeout(tampilWaktu, 1000);
    }
    window.onload = tampilWaktu;
    </script>

    <!--MODE-->
    <script>
    (() => {
        'use strict'

        const getStoredTheme = () => localStorage.getItem('theme')
        const setStoredTheme = theme => localStorage.setItem('theme', theme)

        const getPreferredTheme = () => {
            const storedTheme = getStoredTheme()
            if (storedTheme) {
                return storedTheme
            }

            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
        }

        const setTheme = theme => {
            if (theme === 'auto') {
                document.documentElement.setAttribute('data-bs-theme', (window.matchMedia(
                    '(prefers-color-scheme: dark)').matches ? 'dark' : 'light'))
            } else {
                document.documentElement.setAttribute('data-bs-theme', theme)
            }
        }

        setTheme(getPreferredTheme())

        const showActiveTheme = (theme, focus = false) => {
            const themeSwitcher = document.querySelector('#bd-theme')

            if (!themeSwitcher) {
                return
            }

            const themeSwitcherText = document.querySelector('#bd-theme-text')
            const activeThemeIcon = document.querySelector('.theme-icon-active use')
            const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
            const svgOfActiveBtn = btnToActive.querySelector('svg use').getAttribute('href')

            document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
                element.classList.remove('active')
                element.setAttribute('aria-pressed', 'false')
            })

            btnToActive.classList.add('active')
            btnToActive.setAttribute('aria-pressed', 'true')
            activeThemeIcon.setAttribute('href', svgOfActiveBtn)
            const themeSwitcherLabel = `${themeSwitcherText.textContent} (${btnToActive.dataset.bsThemeValue})`
            themeSwitcher.setAttribute('aria-label', themeSwitcherLabel)

            if (focus) {
                themeSwitcher.focus()
            }
        }

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
            const storedTheme = getStoredTheme()
            if (storedTheme !== 'light' && storedTheme !== 'dark') {
                setTheme(getPreferredTheme())
            }
        })

        window.addEventListener('DOMContentLoaded', () => {
            showActiveTheme(getPreferredTheme())

            document.querySelectorAll('[data-bs-theme-value]')
                .forEach(toggle => {
                    toggle.addEventListener('click', () => {
                        const theme = toggle.getAttribute('data-bs-theme-value')
                        setStoredTheme(theme)
                        setTheme(theme)
                        showActiveTheme(theme, true)
                    })
                })
        })
    })()
    </script>
</body>

</html>
