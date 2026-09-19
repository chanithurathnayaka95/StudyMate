<?php

include 'includes/auth.php';
include 'includes/db.php';

$id = $_SESSION['user_id'];

$sql = "SELECT role FROM users WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user || $user['role'] != 'admin') {
    header("Location: dashboard.php");
    exit();
}

if (isset($_GET['id']) && isset($_GET['status'])) {

    $resource_id = (int) $_GET['id'];
    $status = $_GET['status'];

    if ($status == 'Approved' || $status == 'Rejected') {

        $sql = "UPDATE resources
                SET status = ?
                WHERE id = ?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "si",
            $status,
            $resource_id
        );

        $stmt->execute();
    }
}

header("Location: admin/admin.php");
exit();

?>