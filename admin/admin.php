<?php

include '../includes/auth.php';
include '../includes/db.php';

$id = $_SESSION['user_id'];

$sql = "SELECT role FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user['role'] != 'admin') {
    header("Location: ../dashboard.php");
    exit();
}

$userCount = $conn->query("SELECT COUNT(*) AS total FROM users");
$totalUsers = $userCount->fetch_assoc()['total'];

$resourceCount = $conn->query("SELECT COUNT(*) AS total FROM resources");
$totalResources = $resourceCount->fetch_assoc()['total'];

$groupCount = $conn->query("SELECT COUNT(*) AS total FROM study_groups");
$totalGroups = $groupCount->fetch_assoc()['total'];

$questionCount = $conn->query("SELECT COUNT(*) AS total FROM questions");
$totalQuestions = $questionCount->fetch_assoc()['total'];

$sql = "SELECT id, full_name, university_email, student_id, faculty, role
        FROM users
        ORDER BY id ASC";

$result = $conn->query($sql);

$sqlResources = "SELECT resources.*, users.full_name
                 FROM resources
                 JOIN users ON resources.uploaded_by = users.id
                 ORDER BY uploaded_at DESC";

$resourceResult = $conn->query($sqlResources);

include '../includes/header.php';
?>

<h2 class="mb-4">Admin Panel</h2>

<div class="alert alert-success">
    Welcome, Admin!
</div>

<div class="row mb-4">

    <div class="col-md-3 mb-3">

        <div class="card text-center shadow h-100">

            <div class="card-body">

                <h5>👥 Total Users</h5>

                <h2 class="text-primary">
                    <?php echo $totalUsers; ?>
                </h2>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-3">

        <div class="card text-center shadow h-100">

            <div class="card-body">

                <h5>📚 Resources</h5>

                <h2 class="text-primary">
                    <?php echo $totalResources; ?>
                </h2>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-3">

        <div class="card text-center shadow h-100">

            <div class="card-body">

                <h5>👥 Study Groups</h5>

                <h2 class="text-primary">
                    <?php echo $totalGroups; ?>
                </h2>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-3">

        <div class="card text-center shadow h-100">

            <div class="card-body">

                <h5>💬 Questions</h5>

                <h2 class="text-primary">
                    <?php echo $totalQuestions; ?>
                </h2>

            </div>

        </div>

    </div>

</div>

<h4 class="mt-4">Registered Users</h4>

<table class="table table-bordered table-hover">

    <thead class="table-dark">

        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Student ID</th>
            <th>Faculty</th>
            <th>Role</th>
            <th>Action</th>
        </tr>

    </thead>

    <tbody>

    <?php while ($row = $result->fetch_assoc()) { ?>

        <tr>

            <td>
                <?php echo $row['id']; ?>
            </td>

            <td>
                <?php echo htmlspecialchars($row['full_name']); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($row['university_email']); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($row['student_id']); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($row['faculty']); ?>
            </td>

            <td>
                <?php echo htmlspecialchars(ucfirst($row['role'])); ?>
            </td>

            <td>

                <a
                    href="delete_user.php?id=<?php echo $row['id']; ?>"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure you want to delete this user?');">

                    Delete

                </a>

            </td>

        </tr>

    <?php } ?>

    </tbody>

</table>

<h4 class="mt-5">Uploaded Resources</h4>

<table class="table table-bordered table-hover">

    <thead class="table-dark">

        <tr>
            <th>Title</th>
            <th>Faculty</th>
            <th>Uploaded By</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

    </thead>

    <tbody>

    <?php while ($resource = $resourceResult->fetch_assoc()) { ?>

        <tr>

            <td>
                <?php echo htmlspecialchars($resource['title']); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($resource['faculty']); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($resource['full_name']); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($resource['uploaded_at']); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($resource['status']); ?>
            </td>

            <td>

                <a
                    href="../uploads/<?php echo htmlspecialchars($resource['file_name']); ?>"
                    target="_blank"
                    class="btn btn-info btn-sm">

                    Preview

                </a>

                <?php if ($resource['status'] == 'Pending') { ?>

                    <a
                        href="../update_resource_status.php?id=<?php echo $resource['id']; ?>&status=Approved"
                        class="btn btn-success btn-sm">

                        Approve

                    </a>

                    <a
                        href="../update_resource_status.php?id=<?php echo $resource['id']; ?>&status=Rejected"
                        class="btn btn-warning btn-sm">

                        Reject

                    </a>

                <?php } ?>

                <a
                    href="../delete_resource.php?id=<?php echo $resource['id']; ?>"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Delete this resource?');">

                    Delete

                </a>

            </td>

        </tr>

    <?php } ?>

    </tbody>

</table>

<h4 class="mt-5">Study Groups</h4>

<table class="table table-bordered table-hover">

    <thead class="table-dark">

        <tr>
            <th>Group Name</th>
            <th>Faculty</th>
            <th>Created By</th>
            <th>Members</th>
            <th>Action</th>
        </tr>

    </thead>

    <tbody>

    <?php

    $groupSql = "SELECT study_groups.*, users.full_name
                 FROM study_groups
                 JOIN users ON study_groups.created_by = users.id
                 ORDER BY created_at DESC";

    $groupResult = $conn->query($groupSql);

    ?>

    <?php while ($group = $groupResult->fetch_assoc()) { ?>

        <?php

        $memberCount = $conn->prepare("
            SELECT COUNT(*) AS total
            FROM group_members
            WHERE group_id = ?
        ");

        $memberCount->bind_param("i", $group['id']);
        $memberCount->execute();

        $members = $memberCount->get_result()->fetch_assoc();

        ?>

        <tr>

            <td>
                <?php echo htmlspecialchars($group['group_name']); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($group['faculty']); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($group['full_name']); ?>
            </td>

            <td>
                <?php echo $members['total']; ?>
            </td>

            <td>

                <a
                    href="../group_details.php?id=<?php echo $group['id']; ?>"
                    class="btn btn-info btn-sm">

                    View

                </a>

                <a
                    href="../delete_group.php?id=<?php echo $group['id']; ?>"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure you want to delete this study group?');">

                    Delete

                </a>

            </td>

        </tr>

    <?php } ?>

    </tbody>

</table>

<h4 class="mt-5">Discussion Questions</h4>

<table class="table table-bordered table-hover">

    <thead class="table-dark">

        <tr>
            <th>Title</th>
            <th>Faculty</th>
            <th>Asked By</th>
            <th>Date</th>
            <th>Action</th>
        </tr>

    </thead>

    <tbody>

    <?php

    $questionSql = "SELECT questions.*, users.full_name
                    FROM questions
                    JOIN users ON questions.asked_by = users.id
                    ORDER BY created_at DESC";

    $questionResult = $conn->query($questionSql);

    ?>

    <?php while ($question = $questionResult->fetch_assoc()) { ?>

        <tr>

            <td>
                <?php echo htmlspecialchars($question['title']); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($question['faculty']); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($question['full_name']); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($question['created_at']); ?>
            </td>

            <td>

                <a
                    href="../question.php?id=<?php echo $question['id']; ?>"
                    class="btn btn-info btn-sm">

                    View

                </a>

                <a
                    href="../delete_question.php?id=<?php echo $question['id']; ?>"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure you want to delete this question?');">

                    Delete

                </a>

            </td>

        </tr>

    <?php } ?>

    </tbody>

</table>

<?php include '../includes/footer.php'; ?>