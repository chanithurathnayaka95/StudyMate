<?php

include 'includes/auth.php';
include 'includes/db.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT *
        FROM resources
        WHERE uploaded_by = ?
        ORDER BY uploaded_at DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();

?>

<?php include 'includes/header.php'; ?>

<div class="container mt-4">

    <h2 class="mb-4">My Uploaded Resources</h2>

    <table class="table table-bordered table-hover bg-white">

        <thead class="table-primary">

            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Faculty</th>
                <th>Date</th>
                <th>Status</th>
            </tr>

        </thead>

        <tbody>

        <?php while ($row = $result->fetch_assoc()) { ?>

            <tr>

                <td>
                    <?php echo htmlspecialchars($row['title']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row['description']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row['faculty']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row['uploaded_at']); ?>
                </td>

                <td>

                    <?php if ($row['status'] == 'Approved') { ?>

                        <span class="badge bg-success">
                            Approved
                        </span>

                    <?php } elseif ($row['status'] == 'Rejected') { ?>

                        <span class="badge bg-danger">
                            Rejected
                        </span>

                    <?php } else { ?>

                        <span class="badge bg-warning text-dark">
                            Pending
                        </span>

                    <?php } ?>

                </td>

            </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

<?php include 'includes/footer.php'; ?>