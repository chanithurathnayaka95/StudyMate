<?php

include '../includes/auth.php';
include '../includes/db.php';

$admin_id = $_SESSION['user_id'];

$sql = "SELECT role FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $admin_id);
$stmt->execute();

$result = $stmt->get_result();
$admin = $result->fetch_assoc();

if (!$admin || $admin['role'] != 'admin') {
    header("Location: ../dashboard.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: admin.php");
    exit();
}

$user_id = (int) $_GET['id'];

if ($user_id == $admin_id) {
    die("You cannot delete your own admin account.");
}

$sql = "DELETE FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

header("Location: admin.php");
exit();

?>