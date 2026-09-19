<?php

include 'includes/auth.php';
include 'includes/db.php';

if (isset($_GET['id'])) {

    $group_id = (int) $_GET['id'];
    $user_id = $_SESSION['user_id'];
    $faculty = $_SESSION['faculty'];

    $sql = "SELECT faculty
            FROM study_groups
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $group_id);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $group = $result->fetch_assoc();

        if ($group['faculty'] == $faculty) {

            $sql = "INSERT IGNORE INTO group_members
                    (group_id, user_id)
                    VALUES (?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $group_id, $user_id);
            $stmt->execute();
        }
    }
}

header("Location: studygroups.php");
exit();

?>