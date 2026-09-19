<?php

include 'includes/auth.php';
include 'includes/db.php';

if (!isset($_GET['id'])) {
    die("Group not found.");
}

$group_id = (int) $_GET['id'];

$user_id = $_SESSION['user_id'];
$faculty = $_SESSION['faculty'];
$role = $_SESSION['role'];

if ($role == 'admin') {

    $sql = "SELECT *
            FROM study_groups
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $group_id);

} else {

    $sql = "SELECT *
            FROM study_groups
            WHERE id = ?
            AND faculty = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $group_id, $faculty);
}

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {

    header("Location: studygroups.php");
    exit();
}

$group = $result->fetch_assoc();

if (isset($_POST['post_message'])) {

    $message = trim($_POST['message']);

    if (!empty($message)) {

        $sql = "INSERT INTO group_messages
                (group_id, user_id, message)
                VALUES (?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $group_id, $user_id, $message);
        $stmt->execute();

        header("Location: group_details.php?id=" . $group_id);
        exit();
    }
}

$sql = "SELECT users.full_name
        FROM group_members
        JOIN users
        ON group_members.user_id = users.id
        WHERE group_members.group_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $group_id);
$stmt->execute();

$members = $stmt->get_result();

$sql = "SELECT group_messages.*, users.full_name
        FROM group_messages
        JOIN users
        ON group_messages.user_id = users.id
        WHERE group_messages.group_id = ?
        ORDER BY group_messages.created_at ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $group_id);
$stmt->execute();

$messages = $stmt->get_result();

include 'includes/header.php';
?>

<div class="container">

    <div class="card shadow">

        <div class="card-body">

            <h2 class="text-primary">
                <?php echo htmlspecialchars($group['group_name']); ?>
            </h2>

            <hr>

            <p>
                <strong>Faculty:</strong>
                <?php echo htmlspecialchars($group['faculty']); ?>
            </p>

            <p>
                <strong>Description:</strong><br>
                <?php echo htmlspecialchars($group['description']); ?>
            </p>

            <hr>

            <h3 class="mt-4">👥 Group Members</h3>

            <?php if ($members->num_rows > 0) { ?>

                <ul class="list-group">

                    <?php while ($member = $members->fetch_assoc()) { ?>

                        <li class="list-group-item">
                            👤 <?php echo htmlspecialchars($member['full_name']); ?>
                        </li>

                    <?php } ?>

                </ul>

            <?php } else { ?>

                <div class="alert alert-warning">
                    No members have joined this group yet.
                </div>

            <?php } ?>

            <hr>

            <h3>💬 Group Discussion</h3>

            <form method="POST">

                <div class="mb-3">

                    <textarea
                        name="message"
                        class="form-control"
                        rows="3"
                        placeholder="Write a message..."
                        required></textarea>

                </div>

                <button
                    type="submit"
                    name="post_message"
                    class="btn btn-primary">

                    Post Message

                </button>

            </form>

            <hr>

            <?php if ($messages->num_rows > 0) { ?>

                <?php while ($msg = $messages->fetch_assoc()) { ?>

                    <div class="card mb-2">

                        <div class="card-body">

                            <strong>
                                <?php echo htmlspecialchars($msg['full_name']); ?>
                            </strong>

                            <small class="text-muted float-end">
                                <?php echo htmlspecialchars($msg['created_at']); ?>
                            </small>

                            <br><br>

                            <?php echo nl2br(htmlspecialchars($msg['message'])); ?>

                        </div>

                    </div>

                <?php } ?>

            <?php } else { ?>

                <div class="alert alert-info">
                    No discussion messages yet.
                </div>

            <?php } ?>

            <br>

            <a href="studygroups.php" class="btn btn-secondary">
                Back to Study Groups
            </a>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>