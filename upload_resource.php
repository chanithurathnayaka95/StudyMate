<?php

include 'includes/auth.php';
include 'includes/db.php';

$message = "";

if (isset($_POST['upload'])) {

    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    $faculty = $_SESSION['faculty'];
    $user_id = $_SESSION['user_id'];

    if ($title == "") {

        $message = "<div class='alert alert-danger'>
                        Please enter a resource title.
                    </div>";

    } elseif (!isset($_FILES['resource_file']) ||
              $_FILES['resource_file']['error'] != UPLOAD_ERR_OK) {

        $message = "<div class='alert alert-danger'>
                        Please choose a valid file.
                    </div>";

    } else {

        $fileName = $_FILES['resource_file']['name'];
        $tempName = $_FILES['resource_file']['tmp_name'];

        $allowedTypes = [
            'pdf',
            'doc',
            'docx',
            'ppt',
            'pptx',
            'jpg',
            'jpeg',
            'png'
        ];

        $fileExtension = strtolower(
            pathinfo($fileName, PATHINFO_EXTENSION)
        );

        if (!in_array($fileExtension, $allowedTypes)) {

            $message = "<div class='alert alert-danger'>
                            This file type is not allowed.
                        </div>";

        } else {

            $newFileName = time() . "_" . basename($fileName);

            $target = "uploads/" . $newFileName;

            if (move_uploaded_file($tempName, $target)) {

                $status = "Pending";

                $sql = "INSERT INTO resources
                        (title, description, faculty, file_name, uploaded_by, status)
                        VALUES (?, ?, ?, ?, ?, ?)";

                $stmt = $conn->prepare($sql);

                $stmt->bind_param(
                    "ssssis",
                    $title,
                    $description,
                    $faculty,
                    $newFileName,
                    $user_id,
                    $status
                );

                if ($stmt->execute()) {

                    $message = "<div class='alert alert-success'>
                                    Resource uploaded successfully. Waiting for admin approval.
                                </div>";

                } else {

                    if (file_exists($target)) {
                        unlink($target);
                    }

                    $message = "<div class='alert alert-danger'>
                                    Database error.
                                </div>";
                }

                $stmt->close();

            } else {

                $message = "<div class='alert alert-danger'>
                                File upload failed.
                            </div>";
            }
        }
    }
}
?>

<?php include 'includes/header.php'; ?>

<div class="card shadow p-4">

    <h2 class="mb-4">Upload Study Resource</h2>

    <?php echo $message; ?>

    <form method="POST" enctype="multipart/form-data">

        <div class="mb-3">

            <label class="form-label">
                Resource Title
            </label>

            <input
                type="text"
                name="title"
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
                rows="4"></textarea>

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

        <div class="mb-3">

            <label class="form-label">
                Choose File
            </label>

            <input
                type="file"
                name="resource_file"
                class="form-control"
                required>

        </div>

        <button
            type="submit"
            name="upload"
            class="btn btn-primary">

            Upload Resource

        </button>

        <a
            href="resources.php"
            class="btn btn-secondary ms-2">

            Back to Resources

        </a>

    </form>

</div>

<?php include 'includes/footer.php'; ?>