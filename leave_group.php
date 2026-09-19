<?php

include 'includes/auth.php';
include 'includes/db.php';

if (isset($_GET['id'])) {

    $group_id = (int) $_GET['id'];
    $user_id = $_SESSION['user_id'];

    $sql = "DELETE FROM group_members
            WHERE group_id = ? AND user_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $group_id, $user_id);
    $stmt->execute();
}

header("Location: studygroups.php");
exit();

?>