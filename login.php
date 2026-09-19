<?php

session_start();

include 'includes/db.php';

$message = "";

if (isset($_POST['login'])) {

    $email = trim($_POST['university_email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE university_email = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['student_id'] = $user['student_id'];
            $_SESSION['faculty'] = $user['faculty'];
            $_SESSION['role'] = $user['role'];

            header("Location: dashboard.php");
            exit();

        } else {

            $message = "<div class='alert alert-danger'>
                            Incorrect password.
                        </div>";
        }

    } else {

        $message = "<div class='alert alert-danger'>
                        Email not found.
                    </div>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | StudyMate</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/login.css">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">

        <div class="container">

            <a class="navbar-brand" href="index.php">
                StudyMate
            </a>

            <div class="ms-auto">

                <a
                    href="index.php"
                    class="btn btn-outline-light me-2">

                    Home

                </a>

                <a
                    href="register.php"
                    class="btn btn-outline-light">

                    Register

                </a>

            </div>

        </div>

    </nav>


    <div class="container-fluid">

        <div class="row min-vh-100">

            <div class="col-lg-6 d-flex justify-content-center align-items-center left-side">

                <div class="text-center">

                    <img
                        src="assets/images/register-illustration.svg"
                        class="img-fluid illustration"
                        alt="Login Illustration">

                    <h2 class="mt-4">
                        Welcome Back!
                    </h2>

                    <p>
                        Sign in to continue your learning journey with StudyMate.
                    </p>

                </div>

            </div>


            <div class="col-lg-6 d-flex justify-content-center align-items-center">

                <div class="register-card">

                    <div class="text-center mb-4">

                        <h2 class="fw-bold text-primary">

                            <i class="bi bi-mortarboard-fill"></i>

                            StudyMate

                        </h2>

                        <h3 class="mt-3">
                            Login
                        </h3>

                        <p class="text-muted">
                            Welcome back! Please login to your account.
                        </p>

                    </div>


                    <?php echo $message; ?>


                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">
                                University Email
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">

                                    <i class="bi bi-envelope-fill"></i>

                                </span>

                                <input
                                    type="email"
                                    name="university_email"
                                    class="form-control"
                                    placeholder="example@students.nsbm.ac.lk"
                                    required>

                            </div>

                        </div>


                        <div class="mb-4">

                            <label class="form-label">
                                Password
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">

                                    <i class="bi bi-lock-fill"></i>

                                </span>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    id="password"
                                    placeholder="Enter your password"
                                    required>

                                <button
                                    class="btn btn-outline-secondary"
                                    type="button"
                                    id="togglePassword">

                                    <i class="bi bi-eye-fill"></i>

                                </button>

                            </div>

                        </div>


                        <button
                            type="submit"
                            name="login"
                            class="btn btn-primary w-100">

                            Login

                        </button>


                        <p class="text-center mt-3">

                            Don't have an account?

                            <a href="register.php">
                                Register
                            </a>

                        </p>

                    </form>

                </div>

            </div>

        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <script>

        const togglePassword =
            document.getElementById("togglePassword");

        const password =
            document.getElementById("password");

        togglePassword.addEventListener("click", function () {

            const type =
                password.getAttribute("type") === "password"
                ? "text"
                : "password";

            password.setAttribute("type", type);

            this.innerHTML =
                type === "password"
                ? '<i class="bi bi-eye-fill"></i>'
                : '<i class="bi bi-eye-slash-fill"></i>';

        });

    </script>

</body>

</html>