<?php

include 'includes/auth.php';
include 'includes/db.php';
include 'includes/header.php';

$faculty = $_SESSION['faculty'];
$role = $_SESSION['role'];

if ($role == 'admin') {

    $sql = "SELECT questions.*, users.full_name
            FROM questions
            JOIN users ON questions.asked_by = users.id
            ORDER BY created_at DESC";

    $result = $conn->query($sql);

} else {

    $sql = "SELECT questions.*, users.full_name
            FROM questions
            JOIN users ON questions.asked_by = users.id
            WHERE questions.faculty = ?
            ORDER BY created_at DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $faculty);
    $stmt->execute();

    $result = $stmt->get_result();
}
?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Discussion Forum</h2>

        <a href="ask_question.php" class="btn btn-primary">
            Ask Question
        </a>

    </div>

    <?php if ($result->num_rows > 0) { ?>

        <?php while ($row = $result->fetch_assoc()) { ?>

            <div class="card mb-3">

                <div class="card-body">

                    <h5>
                        <?php echo htmlspecialchars($row['title']); ?>
                    </h5>

                    <p>
                        Asked by:
                        <?php echo htmlspecialchars($row['full_name']); ?>
                    </p>

                    <a
                        href="question.php?id=<?php echo $row['id']; ?>"
                        class="btn btn-outline-primary">

                        View Question

                    </a>

                </div>

            </div>

        <?php } ?>

    <?php } else { ?>

        <div class="alert alert-info">
            No questions available for your faculty.
        </div>

    <?php } ?>

</div>

<?php include 'includes/footer.php'; ?>