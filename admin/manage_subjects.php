<?php
include '../includes/auth.php';
include '../includes/db.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: ../dashboard.php");
    exit();
}

if (isset($_POST['add_subject'])) {

    $subject_name = trim($_POST['subject_name']);
    $faculty = trim($_POST['faculty']);

    if ($subject_name != "" && $faculty != "") {

        $sql = "INSERT INTO subjects (subject_name, faculty)
                VALUES (?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $subject_name, $faculty);
        $stmt->execute();
    }
}

$sql = "SELECT * FROM subjects ORDER BY faculty, subject_name";
$result = $conn->query($sql);

include '../includes/header.php';
?>

<h2 class="mb-4">Manage Subjects</h2>

<div class="card shadow mb-4">

    <div class="card-body">

        <h5 class="mb-3">Add New Subject</h5>

        <form method="POST">

            <div class="row">

                <div class="col-md-5 mb-3">

                    <label class="form-label">
                        Subject Name
                    </label>

                    <input
                        type="text"
                        name="subject_name"
                        class="form-control"
                        placeholder="e.g. Database Systems"
                        required>

                </div>

                <div class="col-md-5 mb-3">

                    <label class="form-label">
                        Faculty
                    </label>

                    <select
                        name="faculty"
                        class="form-select"
                        required>

                        <option value="">Select Faculty</option>

                        <option value="Faculty of Computing">
                            Faculty of Computing
                        </option>

                        <option value="Faculty of Business">
                            Faculty of Business
                        </option>

                        <option value="Faculty of Engineering">
                            Faculty of Engineering
                        </option>

                        <option value="Faculty of Science">
                            Faculty of Science
                        </option>

                    </select>

                </div>

                <div class="col-md-2 mb-3 d-flex align-items-end">

                    <button
                        type="submit"
                        name="add_subject"
                        class="btn btn-primary w-100">

                        Add

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>


<h4>Subjects</h4>

<table class="table table-bordered table-hover bg-white">

    <thead class="table-dark">

        <tr>
            <th>ID</th>
            <th>Subject</th>
            <th>Faculty</th>
        </tr>

    </thead>

    <tbody>

        <?php while ($row = $result->fetch_assoc()) { ?>

            <tr>

                <td>
                    <?php echo $row['id']; ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row['subject_name']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row['faculty']); ?>
                </td>

            </tr>

        <?php } ?>

    </tbody>

</table>

<?php include '../includes/footer.php'; ?>