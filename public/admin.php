<?php
session_start();

// Cek apakah pengguna sudah login sebagai admin
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
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

    .card {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .logout-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
    }

    /* Dark mode styles */
    body[data-bs-theme='dark'] {
        background-color: #121212;
        color: #ffffff;
    }

    body[data-bs-theme='dark'] .navbar {
        background-color: #1f1f1f;
    }

    body[data-bs-theme='dark'] .card {
        background-color: #1f1f1f;
        color: #ffffff;
    }

    body[data-bs-theme='dark'] .nav-link {
        color: #ffffff;
    }

    body[data-bs-theme='dark'] .dropdown-menu {
        background-color: #1f1f1f;
        color: #ffffff;
    }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Dashboard Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="edit_article.php">Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
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

    <!-- Content -->
    <!-- Dashboard Section -->
    <section id="dashboard" class="py-5 mt-5">
        <div class="container">
            <h1 class="text-center fw-bold mb-5">Dashboard</h1>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Articles</h5>
                            <?php
                            // Koneksi ke database
                            $conn = new mysqli("localhost", "root", "", "pbw_admin");

                            // Cek koneksi
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Ambil jumlah artikel dari database
                            $sql = "SELECT COUNT(*) as total FROM articles";
                            $result = $conn->query($sql);
                            $total_articles = $result->fetch_assoc()['total'];

                            // Tutup koneksi
                            $conn->close();
                            ?>
                            <p class="card-text fs-1 fw-bold"><?php echo $total_articles; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Gallery Images</h5>
                            <?php
                        // Koneksi ke database
                        $conn = new mysqli("localhost", "root", "", "pbw_admin");

                        // Cek koneksi
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Ambil jumlah gambar dari tabel gallery
                        $sql = "SELECT COUNT(*) as total FROM gallery";
                        $result = $conn->query($sql);
                        $total_images = $result->fetch_assoc()['total'];

                        // Tutup koneksi
                        $conn->close();
                        ?>
                            <p class="card-text fs-1 fw-bold"><?php echo $total_images; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Dashboard -->

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
                        echo '        <img src="../img/' . $row["image"] . '" class="card-img-top" alt="' . $row["title"] . '" />';
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

    <footer class="text-center py-4 color-dark">
        <a href="https://github.com/alvindeo" class="text-dark">Alvin Deo Ardiansyah &copy; 2024</a>
    </footer>

    <!-- Theme Switcher -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
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
            const themeSwitcherLabel =
                `${themeSwitcherText.textContent} (${btnToActive.dataset.bsThemeValue})`
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