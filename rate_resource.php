<?php

include 'includes/auth.php';
include 'includes/db.php';

if (isset($_POST['submit'])) {

    $resource_id = (int) $_POST['resource_id'];
    $rating = (int) $_POST['rating'];

    $user_id = $_SESSION['user_id'];
    $faculty = $_SESSION['faculty'];
    $role = $_SESSION['role'];

    if ($rating < 1 || $rating > 5) {
        header("Location: resources.php");
        exit();
    }

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
            SELECT id
            FROM resource_ratings
            WHERE resource_id = ?
            AND user_id = ?
        ");

        $stmt->bind_param(
            "ii",
            $resource_id,
            $user_id
        );

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            $stmt = $conn->prepare("
                UPDATE resource_ratings
                SET rating = ?
                WHERE resource_id = ?
                AND user_id = ?
            ");

            $stmt->bind_param(
                "iii",
                $rating,
                $resource_id,
                $user_id
            );

        } else {

            $stmt = $conn->prepare("
                INSERT INTO resource_ratings
                (resource_id, user_id, rating)
                VALUES (?, ?, ?)
            ");

            $stmt->bind_param(
                "iii",
                $resource_id,
                $user_id,
                $rating
            );
        }

        $stmt->execute();

        header("Location: resource_details.php?id=" . $resource_id);
        exit();
    }
}

header("Location: resources.php");
exit();

?>