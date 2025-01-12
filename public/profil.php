<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashbord Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    .current-profile-pic {
        max-width: 150px;
        /* Adjust the size as needed */
        height: auto;
    }

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
            <a class="navbar-brand fw-bold" href="admin.php">Dashboard Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="edit_article.php">Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="gallery.php">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profil.php">Homepage</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Admin
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            <li><a class="dropdown-item" href="../index.php">Profil</a></li>
                        </ul>
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


    <!-- Profil Section -->
    <div class="container profile-section mt-5">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $password = $_POST['password'];

            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'pbw_admin');

            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }

            // Update password if provided
            if (!empty($password)) {
            $hashedPassword = md5($password);
            $stmt = $conn->prepare("UPDATE user SET password=? WHERE id=2"); // Change 'id=1' to the appropriate user ID
            $stmt->bind_param("s", $hashedPassword);
            if ($stmt->execute()) {
                echo "<script>alert('Password updated successfully.');</script>";
            } else {
                echo "<script>alert('Error updating password: " . $stmt->error . "');</script>";
            }
            $stmt->close();
            }

            $conn->close();
        }
        ?>

        <div class="container mt-5" style="padding-top: 70px;">
            <h1 class="text-start"> Profil </h1>
            <hr>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="password" class="form-label"><strong>Ganti Password</strong></label>
                    <input type="password" id="password" name="password" class="form-control"
                        placeholder="Tuliskan Password Baru atau Biarkan Kosong">
                </div>
                <div class="mb-3">
                    <label for="profile-pic" class="form-label"><strong>Ganti Foto Profil</strong></label>
                    <input type="file" id="profile-pic" name="profile-pic" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Foto Profil Saat Ini</label>
                    <div>
                        <img src="profile.jpg" alt="Profile Picture" class="img-thumbnail current-profile-pic">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.getElementById('profile-pic').addEventListener('change', function(event) {
    var reader = new FileReader();
    reader.onload = function(e) {
        document.querySelector('.current-profile-pic').src = e.target.result;
    };
    reader.readAsDataURL(event.target.files[0]);
});

// Theme switcher script
document.querySelectorAll('[data-bs-theme-value]').forEach(function(button) {
    button.addEventListener('click', function() {
        var theme = this.getAttribute('data-bs-theme-value');
        document.documentElement.setAttribute('data-bs-theme', theme);
        localStorage.setItem('theme', theme);
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var storedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-bs-theme', storedTheme);
});
</script>

</html>