<?php

include 'includes/auth.php';
include 'includes/db.php';

if (isset($_GET['id'])) {

    $group_id = (int) $_GET['id'];
    $user_id = $_SESSION['user_id'];
    $role = $_SESSION['role'];

    $check = $conn->prepare("
        SELECT created_by
        FROM study_groups
        WHERE id = ?
    ");

    $check->bind_param("i", $group_id);
    $check->execute();

    $group = $check->get_result()->fetch_assoc();

    if (
        $group &&
        (
            $group['created_by'] == $user_id ||
            $role == 'admin'
        )
    ) {

        $delete = $conn->prepare("
            DELETE FROM study_groups
            WHERE id = ?
        ");

        $delete->bind_param("i", $group_id);
        $delete->execute();
    }
}

header("Location: studygroups.php");
exit();

?>