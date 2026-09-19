<?php

include 'includes/db.php';

$message = "";

if (isset($_POST['register'])) {

    $full_name = trim($_POST['full_name']);
    $university_email = trim($_POST['university_email']);
    $student_id = trim($_POST['student_id']);
    $faculty = trim($_POST['faculty']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (
        $full_name == "" ||
        $university_email == "" ||
        $student_id == "" ||
        $faculty == "" ||
        $password == "" ||
        $confirm_password == ""
    ) {

        $message = "<div class='alert alert-danger'>
                        Please fill in all fields.
                    </div>";

    } elseif (!filter_var($university_email, FILTER_VALIDATE_EMAIL)) {

        $message = "<div class='alert alert-danger'>
                        Please enter a valid email address.
                    </div>";

    } elseif ($password != $confirm_password) {

        $message = "<div class='alert alert-danger'>
                        Passwords do not match.
                    </div>";

    } else {

        $check = $conn->prepare("
            SELECT id
            FROM users
            WHERE university_email = ?
            OR student_id = ?
        ");

        $check->bind_param(
            "ss",
            $university_email,
            $student_id
        );

        $check->execute();

        $result = $check->get_result();

        if ($result->num_rows > 0) {

            $message = "<div class='alert alert-warning'>
                            Email or Student ID already exists.
                        </div>";

        } else {

            $hashed_password = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            $sql = "INSERT INTO users
                    (full_name, university_email, student_id, faculty, password, role)
                    VALUES (?, ?, ?, ?, ?, 'student')";

            $stmt = $conn->prepare($sql);

            $stmt->bind_param(
                "sssss",
                $full_name,
                $university_email,
                $student_id,
                $faculty,
                $hashed_password
            );

            if ($stmt->execute()) {

                $message = "<div class='alert alert-success'>
                                Registration Successful!
                            </div>";

            } else {

                $message = "<div class='alert alert-danger'>
                                Something went wrong.
                            </div>";
            }

            $stmt->close();
        }

        $check->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register | StudyMate</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="assets/css/register.css">

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
                    href="login.php"
                    class="btn btn-outline-light">

                    Login

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
                        alt="Register Illustration"
                        class="img-fluid illustration">

                    <h2 class="mt-4">
                        Welcome to StudyMate
                    </h2>

                    <p>
                        Join thousands of university students and start
                        learning together.
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
                            Create Your Account
                        </h3>

                        <p class="text-muted">
                            Join the StudyMate community and start learning together.
                        </p>

                    </div>


                    <?php echo $message; ?>


                    <form method="POST" action="">

                        <div class="mb-3">

                            <label class="form-label">
                                Full Name
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="bi bi-person-fill"></i>
                                </span>

                                <input
                                    type="text"
                                    name="full_name"
                                    class="form-control"
                                    placeholder="Enter your full name"
                                    required>

                            </div>

                        </div>


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


                        <div class="mb-3">

                            <label class="form-label">
                                Student ID
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="bi bi-person-vcard-fill"></i>
                                </span>

                                <input
                                    type="text"
                                    name="student_id"
                                    class="form-control"
                                    placeholder="Enter your Student ID"
                                    required>

                            </div>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Faculty
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="bi bi-building"></i>
                                </span>

                                <select
                                    name="faculty"
                                    class="form-select"
                                    required>

                                    <option
                                        value=""
                                        selected
                                        disabled>

                                        Select Faculty

                                    </option>

                                    <option>
                                        Faculty of Computing
                                    </option>

                                    <option>
                                        Faculty of Business
                                    </option>

                                    <option>
                                        Faculty of Engineering
                                    </option>

                                    <option>
                                        Faculty of Science
                                    </option>

                                </select>

                            </div>

                        </div>


                        <div class="mb-3">

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


                        <div class="mb-4">

                            <label class="form-label">
                                Confirm Password
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="bi bi-lock-fill"></i>
                                </span>

                                <input
                                    type="password"
                                    name="confirm_password"
                                    class="form-control"
                                    id="confirmPassword"
                                    placeholder="Confirm your password"
                                    required>

                                <button
                                    class="btn btn-outline-secondary"
                                    type="button"
                                    id="toggleConfirmPassword">

                                    <i class="bi bi-eye-fill"></i>

                                </button>

                            </div>

                        </div>


                        <button
                            type="submit"
                            name="register"
                            class="btn btn-primary w-100">

                            Register

                        </button>


                        <p class="text-center mt-3">

                            Already have an account?

                            <a href="login.php">
                                Login
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


    <script>

        const toggleConfirmPassword =
            document.getElementById("toggleConfirmPassword");

        const confirmPassword =
            document.getElementById("confirmPassword");

        toggleConfirmPassword.addEventListener("click", function () {

            const type =
                confirmPassword.getAttribute("type") === "password"
                ? "text"
                : "password";

            confirmPassword.setAttribute("type", type);

            this.innerHTML =
                type === "password"
                ? '<i class="bi bi-eye-fill"></i>'
                : '<i class="bi bi-eye-slash-fill"></i>';

        });

    </script>

</body>

</html>