<?php

include 'includes/auth.php';
include 'includes/db.php';
include 'includes/header.php';

$user_id = $_SESSION['user_id'];
$faculty = $_SESSION['faculty'];
$role = $_SESSION['role'];

?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Study Groups</h2>

        <a href="create_group.php" class="btn btn-primary">
            + Create Group
        </a>

    </div>

    <?php

    if ($role == 'admin') {

        $sql = "SELECT study_groups.*, users.full_name
                FROM study_groups
                JOIN users ON study_groups.created_by = users.id
                ORDER BY created_at DESC";

        $result = $conn->query($sql);

    } else {

        $sql = "SELECT study_groups.*, users.full_name
                FROM study_groups
                JOIN users ON study_groups.created_by = users.id
                WHERE study_groups.faculty = ?
                ORDER BY created_at DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $faculty);
        $stmt->execute();

        $result = $stmt->get_result();
    }

    if ($result->num_rows > 0) {

        while ($group = $result->fetch_assoc()) {

            $count = $conn->prepare("
                SELECT COUNT(*) AS total
                FROM group_members
                WHERE group_id = ?
            ");

            $count->bind_param("i", $group['id']);
            $count->execute();

            $memberData = $count->get_result()->fetch_assoc();

            $totalMembers = $memberData['total'];

            $check = $conn->prepare("
                SELECT id
                FROM group_members
                WHERE group_id = ?
                AND user_id = ?
            ");

            $check->bind_param(
                "ii",
                $group['id'],
                $user_id
            );

            $check->execute();

            $isJoined = $check->get_result();

    ?>

        <div class="card mb-3 shadow-sm">

            <div class="card-body">

                <h4>

                    <a
                        href="group_details.php?id=<?php echo $group['id']; ?>"
                        class="text-decoration-none">

                        <?php echo htmlspecialchars($group['group_name']); ?>

                    </a>

                </h4>

                <p>

                    <strong>Faculty:</strong>

                    <?php echo htmlspecialchars($group['faculty']); ?>

                </p>

                <p>

                    <strong>Created by:</strong>

                    <?php echo htmlspecialchars($group['full_name']); ?>

                </p>

                <p>

                    <strong>Members:</strong>

                    <?php echo $totalMembers; ?>

                </p>

                <p>

                    <?php echo htmlspecialchars($group['description']); ?>

                </p>


                <?php if ($isJoined->num_rows > 0) { ?>

                    <a
                        href="leave_group.php?id=<?php echo $group['id']; ?>"
                        class="btn btn-danger">

                        Leave Group

                    </a>

                <?php } else { ?>

                    <a
                        href="join_group.php?id=<?php echo $group['id']; ?>"
                        class="btn btn-success">

                        Join Group

                    </a>

                <?php } ?>


                <?php

                if ($group['created_by'] == $user_id) {

                ?>

                    <a
                        href="delete_group.php?id=<?php echo $group['id']; ?>"
                        class="btn btn-outline-danger ms-2"
                        onclick="return confirm('Are you sure you want to delete this study group?');">

                        Delete Group

                    </a>

                <?php } ?>

            </div>

        </div>

    <?php

        }

    } else {

    ?>

        <div class="alert alert-info">

            No study groups available for your faculty yet.

        </div>

    <?php

    }

    ?>

</div>

<?php include 'includes/footer.php'; ?>