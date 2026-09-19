<?php

include 'includes/auth.php';
include 'includes/db.php';

if (isset($_GET['id'])) {

    $question_id = (int) $_GET['id'];
    $user_id = $_SESSION['user_id'];

    $check = $conn->prepare("
        SELECT role
        FROM users
        WHERE id = ?
    ");

    $check->bind_param("i", $user_id);
    $check->execute();

    $user = $check->get_result()->fetch_assoc();

    if ($user && $user['role'] == 'admin') {

        $deleteAnswers = $conn->prepare("
            DELETE FROM answers
            WHERE question_id = ?
        ");

        $deleteAnswers->bind_param("i", $question_id);
        $deleteAnswers->execute();

        $deleteQuestion = $conn->prepare("
            DELETE FROM questions
            WHERE id = ?
        ");

        $deleteQuestion->bind_param("i", $question_id);
        $deleteQuestion->execute();
    }
}

header("Location: admin/admin.php");
exit();

?>