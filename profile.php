<?php

include 'includes/auth.php';
include 'includes/db.php';

$id = $_SESSION['user_id'];

$sql = "SELECT *
        FROM users
        WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

?>

<?php include 'includes/header.php'; ?>

<div class="card shadow">

    <div class="card-body p-5">

        <div class="text-center mb-4">

            <i
                class="bi bi-person-circle text-primary"
                style="font-size:90px;">
            </i>

            <h2 class="mt-3">
                <?php echo htmlspecialchars($user['full_name']); ?>
            </h2>

        </div>

        <table class="table">

            <tr>

                <th>Full Name</th>

                <td>
                    <?php echo htmlspecialchars($user['full_name']); ?>
                </td>

            </tr>

            <tr>

                <th>University Email</th>

                <td>
                    <?php echo htmlspecialchars($user['university_email']); ?>
                </td>

            </tr>

            <tr>

                <th>Student ID</th>

                <td>
                    <?php echo htmlspecialchars($user['student_id']); ?>
                </td>

            </tr>

            <tr>

                <th>Faculty</th>

                <td>
                    <?php echo htmlspecialchars($user['faculty']); ?>
                </td>

            </tr>

        </table>

        <div class="text-center mt-4">

            <a
                href="dashboard.php"
                class="btn btn-secondary">

                Back to Dashboard

            </a>

            <a
                href="edit_profile.php"
                class="btn btn-primary">

                Edit Profile

            </a>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>