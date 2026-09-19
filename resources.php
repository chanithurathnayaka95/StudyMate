<?php

include 'includes/auth.php';
include 'includes/db.php';

$user_id = $_SESSION['user_id'];
$faculty = $_SESSION['faculty'];
$role = $_SESSION['role'];

$search_text = isset($_GET['search'])
    ? trim($_GET['search'])
    : "";

if ($search_text != "") {

    $search = "%" . $search_text . "%";

    if ($role == 'admin') {

        $sql = "SELECT resources.*, users.full_name
                FROM resources
                JOIN users ON resources.uploaded_by = users.id
                WHERE resources.title LIKE ?
                   OR resources.description LIKE ?
                   OR resources.faculty LIKE ?
                ORDER BY uploaded_at DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sss",
            $search,
            $search,
            $search
        );

    } else {

        $sql = "SELECT resources.*, users.full_name
                FROM resources
                JOIN users ON resources.uploaded_by = users.id
                WHERE resources.faculty = ?
                  AND resources.status = 'Approved'
                  AND (
                      resources.title LIKE ?
                      OR resources.description LIKE ?
                  )
                ORDER BY uploaded_at DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sss",
            $faculty,
            $search,
            $search
        );
    }

    $stmt->execute();
    $result = $stmt->get_result();

} else {

    if ($role == 'admin') {

        $sql = "SELECT resources.*, users.full_name
                FROM resources
                JOIN users ON resources.uploaded_by = users.id
                ORDER BY uploaded_at DESC";

        $result = $conn->query($sql);

    } else {

        $sql = "SELECT resources.*, users.full_name
                FROM resources
                JOIN users ON resources.uploaded_by = users.id
                WHERE resources.faculty = ?
                  AND resources.status = 'Approved'
                ORDER BY uploaded_at DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $faculty);
        $stmt->execute();

        $result = $stmt->get_result();
    }
}

if (!$result) {
    die("Failed to load resources.");
}

?>

<?php include 'includes/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>Study Resources</h2>

    <div>

        <form class="d-flex" method="GET">

            <input
                type="text"
                name="search"
                class="form-control me-2"
                placeholder="Search resources..."
                value="<?php echo htmlspecialchars($search_text); ?>">

            <button
                class="btn btn-success me-2"
                type="submit">

                Search

            </button>

        </form>

    </div>

    <a
        href="upload_resource.php"
        class="btn btn-primary">

        Upload Resource

    </a>

</div>

<table class="table table-bordered table-hover bg-white">

    <thead class="table-primary">

        <tr>

            <th>Title</th>
            <th>Description</th>
            <th>Faculty</th>
            <th>Uploaded By</th>
            <th>Date</th>
            <th>Download</th>
            <th>Delete</th>

        </tr>

    </thead>

    <tbody>

        <?php while ($row = $result->fetch_assoc()) { ?>

            <tr>

                <td>

                    <a
                        href="resource_details.php?id=<?php echo $row['id']; ?>">

                        <?php echo htmlspecialchars($row['title']); ?>

                    </a>

                </td>

                <td>

                    <?php echo htmlspecialchars($row['description']); ?>

                </td>

                <td>

                    <?php echo htmlspecialchars($row['faculty']); ?>

                </td>

                <td>

                    <?php echo htmlspecialchars($row['full_name']); ?>

                </td>

                <td>

                    <?php echo htmlspecialchars($row['uploaded_at']); ?>

                </td>

                <td>

                    <a
                        href="uploads/<?php echo htmlspecialchars($row['file_name']); ?>"
                        class="btn btn-success btn-sm"
                        download>

                        Download

                    </a>

                </td>

                <td>

                    <?php
                    if (
                        $row['uploaded_by'] == $user_id ||
                        $role == 'admin'
                    ) {
                    ?>

                        <a
                            href="delete_resource.php?id=<?php echo $row['id']; ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this resource?');">

                            Delete

                        </a>

                    <?php } ?>

                </td>

            </tr>

        <?php } ?>

    </tbody>

</table>

<?php include 'includes/footer.php'; ?>