<?php
session_start();
include "koneksi.php";

// Fetch Articles
$result = $conn->query("SELECT * FROM articles");

if (isset($_POST['create'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = '';
    $username = "admin"; // Ganti sesuai dengan sistem username Anda
    $created_at = date("Y-m-d H:i:s"); // Tanggal dan waktu saat ini

    // Handle Image Upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "../img/"; // Folder tujuan
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $image = $_FILES["image"]["name"];
        } else {
            $_SESSION['message'] = "Failed to upload image.";
            $_SESSION['msg_type'] = "danger";
            header("refresh:2;url=edit_article.php");
            exit;
        }
    }

    // Do not truncate the table to keep existing articles

    // Save Data to Database
    $stmt = $conn->prepare("INSERT INTO articles (title, image, content, username, created_at) VALUES (?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sssss", $title, $image, $content, $username, $created_at);
        if ($stmt->execute()) {
            $_SESSION['message'] = "Article created successfully!";
            $_SESSION['msg_type'] = "success";
        } else {
            $_SESSION['message'] = "Failed to create article.";
            $_SESSION['msg_type'] = "danger";
        }
        $stmt->close();
    } else {
        $_SESSION['message'] = "Failed to prepare statement.";
        $_SESSION['msg_type'] = "danger";
    }
    header("refresh:2;url=edit_article.php");
}

// Handle Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Fetch the current image from the database
    $stmt = $conn->prepare("SELECT image FROM articles WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($currentImage);
    $stmt->fetch();
    $stmt->close();

    // Check if a new image is uploaded
    if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] == 0) {
        $targetDir = "../img/"; // Folder tujuan
        $targetFile = $targetDir . basename($_FILES["new_image"]["name"]);
        if (move_uploaded_file($_FILES["new_image"]["tmp_name"], $targetFile)) {
            $image = $_FILES["new_image"]["name"]; // New image
        } else {
            $_SESSION['message'] = "Failed to upload new image.";
            $_SESSION['msg_type'] = "danger";
            header("refresh:2;url=edit_article.php");
            exit;
        }
    } else {
        // If no new image, use the current image
        $image = $currentImage;
    }

    // Update data in the database
    $stmt = $conn->prepare("UPDATE articles SET title=?, image=?, content=? WHERE id=?");
    if ($stmt) {
        $stmt->bind_param("sssi", $title, $image, $content, $id);
        if ($stmt->execute()) {
            $_SESSION['message'] = "Article updated successfully!";
            $_SESSION['msg_type'] = "success";
            header("refresh:2;url=edit_article.php");
        } else {
            $_SESSION['message'] = "Failed to update article.";
            $_SESSION['msg_type'] = "danger";
            header("refresh:2;url=edit_article.php");
        }
        $stmt->close();
    } else {
        $_SESSION['message'] = "Failed to prepare statement.";
        $_SESSION['msg_type'] = "danger";
    }
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $stmt = $conn->prepare("DELETE FROM articles WHERE id=?");
    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $_SESSION['message'] = "Article deleted successfully!";
            $_SESSION['msg_type'] = "success";
            header("refresh:2;url=edit_article.php"); // Redirect after 2 seconds
        } else {
            $_SESSION['message'] = "Failed to delete article.";
            $_SESSION['msg_type'] = "danger";
            header("refresh:2;url=edit_article.php"); // Redirect after 2 seconds
        }
        $stmt->close();
    } else {
        $_SESSION['message'] = "Failed to prepare statement.";
        $_SESSION['msg_type'] = "danger";
    }
}
?>

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
    .navbar {
        position: fixed;
        top: 0;
        width: 100%;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
                        <a class="nav-link" href="#">Article</a>
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


    <!-- Main Content -->
    <div class="container mt-5" style="padding-top: 70px;">
        <h1 class="text-start"> Artikel </h1>
        <hr>
        <!-- Notification -->
        <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?php echo $_SESSION['msg_type']; ?> alert-dismissible fade show" role="alert">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            unset($_SESSION['msg_type']);
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <!-- Create Article Button -->
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#createArticleModal">
            Buat Artikel
        </button>

        <tbody>
            <!-- Create Article POP UP -->
            <div class="modal fade" id="createArticleModal" tabindex="-1" aria-labelledby="createArticleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createArticleModalLabel">Buat Artikel</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                                <div class="mb-3">
                                    <label for="content" class="form-label">Isi</label>
                                    <textarea class="form-control" id="content" name="content" rows="3"
                                        required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Gambar</label>
                                    <input type="file" class="form-control" id="image" name="image" required>
                                </div>
                                <button type="submit" name="create" class="btn btn-primary">Create</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Articles List -->
            <div class="">
                <div class="card-body">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th class="w-25">Judul</th>
                                <th class="w-75">Isi</th>
                                <th class="w-25">Gambar</th>
                                <th class="w-25">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
                            <tr>

                                <td><?php echo $no++; ?></td>
                                <td>
                                    <strong><?php echo $row['title']; ?></strong>
                                    <br> Pada: <?= $row['created_at']; ?>
                                    <br> Oleh: <?= $row['username']; ?>
                                </td>
                                <td><?php echo $row['content']; ?>
                                </td>
                                <td><img src="../img/<?php echo $row['image']; ?>" class="img-fluid"
                                        style="max-width: 100px;"></td>

                                <td>

                                    <a href="#" title="edit" class="badge rounded-pill text-bg-success"
                                        data-bs-toggle="modal" data-bs-target="#editModal"
                                        data-id="<?php echo $row['id']; ?>"
                                        data-title="<?php echo htmlspecialchars($row['title'], ENT_QUOTES); ?>"
                                        data-content="<?php echo htmlspecialchars($row['content'], ENT_QUOTES); ?>"
                                        data-image="<?php echo htmlspecialchars($row['image'], ENT_QUOTES); ?>">
                                        <i class="bi bi-pencil"></i>
                                    </a>


                                    <a href="?delete=<?php echo $row['id']; ?>" title="delete"
                                        class="badge rounded-pill text-bg-danger">
                                        <i class="bi bi-x-circle"></i>
                                    </a>

                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Edit Article Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Artikel</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="" enctype="multipart/form-data">
                                <!-- Hidden input for article ID -->
                                <input type="hidden" name="id" id="modal-id">

                                <!-- Title Input -->
                                <div class="mb-3">
                                    <label for="modal-title" class="form-label">Judul</label>
                                    <input type="text" class="form-control" id="modal-title" name="title" required>
                                </div>

                                <!-- Content Input -->
                                <div class="mb-3">
                                    <label for="modal-content" class="form-label">Isi</label>
                                    <textarea class="form-control" id="modal-content" name="content" rows="3"
                                        required></textarea>
                                </div>

                                <!-- Existing Image Display -->
                                <div class="mb-3">
                                    <label class="form-label">Gambar Lama</label>
                                    <div>
                                        <img id="modal-current-image" src="" alt="Current Image" class="img-thumbnail"
                                            style="max-width: 100%; height: auto;">
                                    </div>
                                </div>

                                <!-- New Image Input -->
                                <div class="mb-3">
                                    <label for="modal-new-image" class="form-label">Upload Gambar Baru</label>
                                    <input type="file" class="form-control" id="modal-new-image" name="new_image">
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" name="update" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <script>
            const editModal = document.getElementById('editModal');
            editModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget; // Button that triggered the modal
                const id = button.getAttribute('data-id');
                const title = button.getAttribute('data-title');
                const content = button.getAttribute('data-content');
                const image = button.getAttribute('data-image');

                // Populate the modal fields
                const modalId = editModal.querySelector('#modal-id');
                const modalTitle = editModal.querySelector('#modal-title');
                const modalContent = editModal.querySelector('#modal-content');
                const modalCurrentImage = editModal.querySelector('#modal-current-image');

                modalId.value = id;
                modalTitle.value = title;
                modalContent.value = content;

                // Update the current image source
                modalCurrentImage.src = '../img/' + image;
            });
            </script>
        </tbody>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
$conn->close();
?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const themeDropdown = document.getElementById('themeDropdown');
    const themeButtons = themeDropdown.querySelectorAll('.dropdown-item');
    const themeIconActive = themeDropdown.querySelector('.theme-icon-active');

    // Load saved theme from localStorage
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        document.documentElement.setAttribute('data-bs-theme', savedTheme);
        updateThemeIcon(savedTheme);
    }

    themeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const theme = this.getAttribute('data-bs-theme-value');
            document.documentElement.setAttribute('data-bs-theme', theme);
            localStorage.setItem('theme', theme);
            updateThemeIcon(theme);
        });
    });

    function updateThemeIcon(theme) {
        const iconClass = theme === 'dark' ? 'bi-moon-stars-fill' : 'bi-sun-fill';
        themeIconActive.className = `bi ${iconClass} theme-icon-active`;
    }
});
</script>
