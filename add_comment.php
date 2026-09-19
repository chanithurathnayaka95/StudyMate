<?php

include 'includes/auth.php';
include 'includes/db.php';

if (isset($_POST['submit'])) {

    $resource_id = (int) $_POST['resource_id'];
    $comment = trim($_POST['comment']);

    $user_id = $_SESSION['user_id'];
    $faculty = $_SESSION['faculty'];
    $role = $_SESSION['role'];

    if (!empty($comment)) {

        if ($role == 'admin') {

            $sql = "SELECT id
                    FROM resources
                    WHERE id = ?";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $resource_id);

        } else {

            $sql = "SELECT id
                    FROM resources
                    WHERE id = ?
                    AND faculty = ?
                    AND status = 'Approved'";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $resource_id, $faculty);
        }

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows == 1) {

            $stmt = $conn->prepare("
                INSERT INTO resource_comments
                (resource_id, user_id, comment)
                VALUES (?, ?, ?)
            ");

            $stmt->bind_param(
                "iis",
                $resource_id,
                $user_id,
                $comment
            );

            if ($stmt->execute()) {

                header("Location: resource_details.php?id=" . $resource_id);
                exit();

            }
        }
    }
}

header("Location: resources.php");
exit();

?>