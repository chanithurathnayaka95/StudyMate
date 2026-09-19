<?php

include 'includes/auth.php';
include 'includes/db.php';

$id = (int) $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = trim($_POST['full_name']);
    $university_email = trim($_POST['university_email']);
    $faculty = $_POST['faculty'];

    if ($full_name != "" && $university_email != "" && $faculty != "") {

        $update = "UPDATE users
                   SET full_name = ?, university_email = ?, faculty = ?
                   WHERE id = ?";

        $stmt = $conn->prepare($update);

        $stmt->bind_param(
            "sssi",
            $full_name,
            $university_email,
            $faculty,
            $id
        );

        if ($stmt->execute()) {

            $_SESSION['full_name'] = $full_name;
            $_SESSION['faculty'] = $faculty;

            header("Location: profile.php");
            exit();

        }
    }
}

include 'includes/header.php';
?>

<div class="card shadow p-4">

    <h2 class="mb-4">Edit Profile</h2>

    <form method="POST">

        <div class="mb-3">

            <label class="form-label">
                Full Name
            </label>

            <input
                type="text"
                name="full_name"
                class="form-control"
                value="<?php echo htmlspecialchars($user['full_name']); ?>"
                required>

        </div>

        <div class="mb-3">

            <label class="form-label">
                University Email
            </label>

            <input
                type="email"
                name="university_email"
                class="form-control"
                value="<?php echo htmlspecialchars($user['university_email']); ?>"
                required>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Faculty
            </label>

            <select name="faculty" class="form-select">

                <option
                    <?php if ($user['faculty'] == "Faculty of Computing") echo "selected"; ?>>
                    Faculty of Computing
                </option>

                <option
                    <?php if ($user['faculty'] == "Faculty of Business") echo "selected"; ?>>
                    Faculty of Business
                </option>

                <option
                    <?php if ($user['faculty'] == "Faculty of Engineering") echo "selected"; ?>>
                    Faculty of Engineering
                </option>

                <option
                    <?php if ($user['faculty'] == "Faculty of Science") echo "selected"; ?>>
                    Faculty of Science
                </option>

            </select>

        </div>

        <button
            type="submit"
            class="btn btn-primary">

            Update Profile

        </button>

        <a
            href="profile.php"
            class="btn btn-secondary">

            Cancel

        </a>

    </form>

</div>

<?php include 'includes/footer.php'; ?>