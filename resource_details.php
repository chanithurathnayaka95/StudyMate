<?php

include 'includes/auth.php';
include 'includes/db.php';
include 'includes/header.php';

if (!isset($_GET['id'])) {
    header("Location: resources.php");
    exit();
}

$id = (int) $_GET['id'];

$stmt = $conn->prepare("
    SELECT resources.*, users.full_name
    FROM resources
    JOIN users ON resources.uploaded_by = users.id
    WHERE resources.id = ?
");

$stmt->bind_param("i", $id);
$stmt->execute();

$resource = $stmt->get_result()->fetch_assoc();

if (!$resource) {
    header("Location: resources.php");
    exit();
}


$stmt = $conn->prepare("
    SELECT resource_comments.*, users.full_name
    FROM resource_comments
    JOIN users ON resource_comments.user_id = users.id
    WHERE resource_id = ?
    ORDER BY created_at DESC
");

$stmt->bind_param("i", $id);
$stmt->execute();

$comments = $stmt->get_result();


$stmt = $conn->prepare("
    SELECT AVG(rating) AS average_rating
    FROM resource_ratings
    WHERE resource_id = ?
");

$stmt->bind_param("i", $id);
$stmt->execute();

$rating = $stmt->get_result()->fetch_assoc();

$average_rating = $rating['average_rating']
    ? round($rating['average_rating'], 1)
    : 0;

?>

<div class="container mt-4">

    <div class="card mb-4">

        <div class="card-body">

            <h3>
                <?php echo htmlspecialchars($resource['title']); ?>
            </h3>

            <p>
                Uploaded by
                <?php echo htmlspecialchars($resource['full_name']); ?>
            </p>

            <p>

                <strong>Description:</strong><br>

                <?php
                echo nl2br(
                    htmlspecialchars($resource['description'])
                );
                ?>

            </p>

            <p>

                Average Rating:
                <?php echo $average_rating; ?>/5

            </p>

            <a
                href="uploads/<?php echo htmlspecialchars($resource['file_name']); ?>"
                class="btn btn-success">

                Download

            </a>

        </div>

    </div>


    <h4>Comments</h4>

    <?php if ($comments->num_rows > 0) { ?>

        <?php while ($row = $comments->fetch_assoc()) { ?>

            <div class="card mb-2">

                <div class="card-body">

                    <strong>
                        <?php echo htmlspecialchars($row['full_name']); ?>
                    </strong>

                    <p>
                        <?php echo nl2br(htmlspecialchars($row['comment'])); ?>
                    </p>

                </div>

            </div>

        <?php } ?>

    <?php } else { ?>

        <div class="alert alert-info">
            No comments yet.
        </div>

    <?php } ?>


    <h4 class="mt-4">Add Comment</h4>

    <form
        action="add_comment.php"
        method="POST">

        <input
            type="hidden"
            name="resource_id"
            value="<?php echo $id; ?>">

        <div class="mb-3">

            <textarea
                name="comment"
                class="form-control"
                rows="4"
                required></textarea>

        </div>

        <button
            type="submit"
            name="submit"
            class="btn btn-primary">

            Post Comment

        </button>

    </form>


    <h4 class="mt-4">Rate this Resource</h4>

    <form
        action="rate_resource.php"
        method="POST">

        <input
            type="hidden"
            name="resource_id"
            value="<?php echo $id; ?>">

        <div class="mb-3">

            <select
                name="rating"
                class="form-select"
                required>

                <option value="">
                    Select Rating
                </option>

                <option value="1">
                    ⭐ 1
                </option>

                <option value="2">
                    ⭐⭐ 2
                </option>

                <option value="3">
                    ⭐⭐⭐ 3
                </option>

                <option value="4">
                    ⭐⭐⭐⭐ 4
                </option>

                <option value="5">
                    ⭐⭐⭐⭐⭐ 5
                </option>

            </select>

        </div>

        <button
            type="submit"
            name="submit"
            class="btn btn-warning">

            Submit Rating

        </button>

    </form>

</div>

<?php include 'includes/footer.php'; ?>