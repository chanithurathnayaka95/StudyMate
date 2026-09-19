<?php

include 'includes/auth.php';
include 'includes/db.php';

$error = "";

if (isset($_POST['create'])) {

    $group_name = trim($_POST['group_name']);
    $description = trim($_POST['description']);

    if ($group_name == "" || $description == "") {

        $error = "Please enter the group name and description.";

    } else {

        $faculty = $_SESSION['faculty'];
        $created_by = $_SESSION['user_id'];

        $sql = "INSERT INTO study_groups
                (group_name, description, faculty, created_by)
                VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "sssi",
            $group_name,
            $description,
            $faculty,
            $created_by
        );

        if ($stmt->execute()) {

            $group_id = $conn->insert_id;

            $member = $conn->prepare("
                INSERT INTO group_members
                (group_id, user_id)
                VALUES (?, ?)
            ");

            $member->bind_param(
                "ii",
                $group_id,
                $created_by
            );

            $member->execute();

            header("Location: studygroups.php");
            exit();

        } else {

            $error = "Failed to create group.";

        }
    }
}

include 'includes/header.php';
?>

<div class="container mt-4">

    <h2>Create Study Group</h2>

    <?php if ($error != "") { ?>

        <div class="alert alert-danger">
            <?php echo htmlspecialchars($error); ?>
        </div>

    <?php } ?>

    <form method="POST">

        <div class="mb-3">

            <label class="form-label">
                Group Name
            </label>

            <input
                type="text"
                name="group_name"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Description
            </label>

            <textarea
                name="description"
                class="form-control"
                rows="4"
                required></textarea>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Faculty
            </label>

            <input
                type="text"
                class="form-control"
                value="<?php echo htmlspecialchars($_SESSION['faculty']); ?>"
                readonly>

        </div>

        <button
            type="submit"
            name="create"
            class="btn btn-primary">

            Create Group

        </button>

        <a
            href="studygroups.php"
            class="btn btn-secondary">

            Cancel

        </a>

    </form>

</div>

<?php include 'includes/footer.php'; ?>