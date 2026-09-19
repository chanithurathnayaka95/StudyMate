<?php

include 'includes/auth.php';
include 'includes/db.php';

if (isset($_GET['id'])) {

    $id = (int) $_GET['id'];

    $sql = "SELECT file_name, uploaded_by
            FROM resources
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $resource = $result->fetch_assoc();

        $user_id = $_SESSION['user_id'];

        $userSql = "SELECT role FROM users WHERE id = ?";
        $userStmt = $conn->prepare($userSql);
        $userStmt->bind_param("i", $user_id);
        $userStmt->execute();

        $userResult = $userStmt->get_result();
        $user = $userResult->fetch_assoc();

        if ($resource['uploaded_by'] != $user_id && $user['role'] != 'admin') {
            header("Location: resources.php");
            exit();
        }

        $file = "uploads/" . $resource['file_name'];

        if (file_exists($file)) {
            unlink($file);
        }

        $delete = "DELETE FROM resources WHERE id = ?";

        $stmt = $conn->prepare($delete);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}

header("Location: resources.php");
exit();

?>