<?php

include 'includes/auth.php';
include 'includes/db.php';

if (isset($_POST['submit'])) {

    $title = trim($_POST['title']);
    $question = trim($_POST['question']);

    $user_id = $_SESSION['user_id'];
    $faculty = $_SESSION['faculty'];

    if ($title != "" && $question != "") {

        $stmt = $conn->prepare("
            INSERT INTO questions
            (title, question, asked_by, faculty)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "ssis",
            $title,
            $question,
            $user_id,
            $faculty
        );

        if ($stmt->execute()) {

            header("Location: forum.php");
            exit();

        }
    }
}

include 'includes/header.php';
?>

<div class="container mt-4">

    <h2>Ask a Question</h2>

    <form method="POST">

        <div class="mb-3">

            <label class="form-label">
                Question Title
            </label>

            <input
                type="text"
                name="title"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Question
            </label>

            <textarea
                name="question"
                class="form-control"
                rows="6"
                required></textarea>

        </div>

        <button
            type="submit"
            name="submit"
            class="btn btn-primary">

            Post Question

        </button>

    </form>

</div>

<?php include 'includes/footer.php'; ?>