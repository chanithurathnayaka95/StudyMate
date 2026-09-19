<?php

include 'includes/auth.php';

if ($_SESSION['role'] == 'admin') {
    header("Location: admin/admin.php");
    exit();
}

include 'includes/header.php';
?>

<div class="welcome-card mb-4">

    <h2>
        Welcome,
        <?php echo htmlspecialchars($_SESSION['full_name']); ?> 👋
    </h2>

    <p class="text-muted mb-1">
        Student ID :
        <strong><?php echo htmlspecialchars($_SESSION['student_id']); ?></strong>
    </p>

    <p class="text-muted">
        Faculty :
        <strong><?php echo htmlspecialchars($_SESSION['faculty']); ?></strong>
    </p>

</div>

<div class="row g-4">

    <div class="col-md-4">

        <a href="resources.php" class="menu-card d-block">

            <i class="bi bi-book-half"></i>

            <h5>Resources</h5>

        </a>

    </div>

    <div class="col-md-4">

        <a href="studygroups.php" class="menu-card d-block">

            <i class="bi bi-people-fill"></i>

            <h5>Study Groups</h5>

        </a>

    </div>

    <div class="col-md-4">

        <a href="forum.php" class="menu-card d-block">

            <i class="bi bi-chat-left-text-fill"></i>

            <h5>Discussion Forum</h5>

        </a>

    </div>

    <div class="col-md-4">

        <a href="profile.php" class="menu-card d-block">

            <i class="bi bi-person-circle"></i>

            <h5>My Profile</h5>

        </a>

    </div>

    <div class="col-md-4">

        <a href="logout.php" class="menu-card d-block">

            <i class="bi bi-box-arrow-right"></i>

            <h5>Logout</h5>

        </a>

    </div>

</div>

<?php include 'includes/footer.php'; ?>