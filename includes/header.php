<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>StudyMate</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/StudyMate/assets/css/dashboard.css">

</head>

<body class="bg-light">

    <?php
    $isAdmin = isset($_SESSION['role']) && $_SESSION['role'] == 'admin';
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">

        <div class="container">

            <?php if ($isAdmin) { ?>

                <a class="navbar-brand fw-bold" href="/StudyMate/admin/admin.php">

            <?php } else { ?>

                <a class="navbar-brand fw-bold" href="/StudyMate/dashboard.php">

            <?php } ?>

                <i class="bi bi-mortarboard-fill"></i>

                StudyMate

            </a>

            <div>

                <?php if ($isAdmin) { ?>

                    <a href="/StudyMate/admin/admin.php"
                       class="btn btn-warning me-2">

                        Admin Panel

                    </a>

                <?php } else { ?>

                    <a href="/StudyMate/dashboard.php"
                       class="btn btn-outline-light me-2">

                        Dashboard

                    </a>

                    <a href="/StudyMate/resources.php"
                       class="btn btn-outline-light me-2">

                        Resources

                    </a>

                    <a href="/StudyMate/my_uploads.php"
                       class="btn btn-outline-light me-2">

                        My Uploads

                    </a>

                    <a href="/StudyMate/upload_resource.php"
                       class="btn btn-outline-light me-2">

                        Upload

                    </a>

                    <a href="/StudyMate/profile.php"
                       class="btn btn-outline-light me-2">

                        Profile

                    </a>

                <?php } ?>

                <a href="/StudyMate/logout.php"
                   class="btn btn-light">

                    Logout

                </a>

            </div>

        </div>

    </nav>

    <div class="container mt-4">