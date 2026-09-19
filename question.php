<?php

include 'includes/auth.php';
include 'includes/db.php';

if (!isset($_GET['id'])) {
    header("Location: forum.php");
    exit();
}

$id = (int) $_GET['id'];

$user_id = $_SESSION['user_id'];
$faculty = $_SESSION['faculty'];
$role = $_SESSION['role'];

if ($role == 'admin') {

    $stmt = $conn->prepare("
        SELECT questions.*, users.full_name
        FROM questions
        JOIN users ON questions.asked_by = users.id
        WHERE questions.id = ?
    ");

    $stmt->bind_param("i", $id);

} else {

    $stmt = $conn->prepare("
        SELECT questions.*, users.full_name
        FROM questions
        JOIN users ON questions.asked_by = users.id
        WHERE questions.id = ?
        AND questions.faculty = ?
    ");

    $stmt->bind_param("is", $id, $faculty);
}

$stmt->execute();

$questionResult = $stmt->get_result();

if ($questionResult->num_rows == 0) {

    header("Location: forum.php");
    exit();
}

$question = $questionResult->fetch_assoc();


if (isset($_POST['submit'])) {

    $answer = trim($_POST['answer']);

    if ($answer != "") {

        $stmt = $conn->prepare("
            INSERT INTO answers
            (question_id, answer, answered_by)
            VALUES (?, ?, ?)
        ");

        $stmt->bind_param(
            "isi",
            $id,
            $answer,
            $user_id
        );

        $stmt->execute();

        header("Location: question.php?id=" . $id);
        exit();
    }
}


$stmt = $conn->prepare("
    SELECT answers.*, users.full_name
    FROM answers
    JOIN users ON answers.answered_by = users.id
    WHERE question_id = ?
    ORDER BY created_at ASC
");

$stmt->bind_param("i", $id);
$stmt->execute();

$answers = $stmt->get_result();

include 'includes/header.php';
?>

<div class="container mt-4">

    <div class="card mb-4">

        <div class="card-body">

            <h3>
                <?php echo htmlspecialchars($question['title']); ?>
            </h3>

            <p>
                <?php echo nl2br(htmlspecialchars($question['question'])); ?>
            </p>

            <small>
                Asked by
                <?php echo htmlspecialchars($question['full_name']); ?>
            </small>

        </div>

    </div>


    <h4>Answers</h4>

    <?php if ($answers->num_rows > 0) { ?>

        <?php while ($row = $answers->fetch_assoc()) { ?>

            <div class="card mb-3">

                <div class="card-body">

                    <p>
                        <?php echo nl2br(htmlspecialchars($row['answer'])); ?>
                    </p>

                    <small>
                        Answered by
                        <?php echo htmlspecialchars($row['full_name']); ?>
                    </small>

                </div>

            </div>

        <?php } ?>

    <?php } else { ?>

        <div class="alert alert-info">
            No answers yet.
        </div>

    <?php } ?>


    <h4 class="mt-4">Your Answer</h4>

    <form method="POST">

        <div class="mb-3">

            <textarea
                name="answer"
                class="form-control"
                rows="5"
                required></textarea>

        </div>

        <button
            type="submit"
            name="submit"
            class="btn btn-primary">

            Submit Answer

        </button>

    </form>

</div>

<?php include 'includes/footer.php'; ?>