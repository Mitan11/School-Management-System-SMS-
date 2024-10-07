<?php include('../includes/config.php') ?>
<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<style>
    .gallery-image {
        border: 2px solid #ddd;
        /* Light gray border */
        border-radius: 5px;
        /* Rounded corners */
        transition: transform 0.2s;
        /* Smooth transition for hover effect */
    }

    .gallery-image:hover {
        transform: scale(1.05);
        /* Slightly enlarge the image on hover */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        /* Add shadow on hover */
    }
</style>
<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">SMS</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="message">
            <!-- Message will be displayed here -->
        </div>
    </div>
</div>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Gallery</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Gallery</li>
                </ol>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Gallery</h4>
                        <a class="btn btn-sm btn-primary float-end" href="?upload=upload-img">Upload Images</a>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['upload']) && $_GET['upload'] == 'upload-img') { ?>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="imageUpload">Upload Images:</label>
                                    <input type="file" name="images[]" id="imageUpload" class="form-control" multiple
                                        required>
                                </div>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        <?php } else { ?>
                            <div class="row">
                                <?php
                                // Fetch and display images from the database
                                $query = "SELECT * FROM images ORDER BY upload_date DESC";
                                $result = mysqli_query($db_connection, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<div class='col-sm-2'>
                                        <a href='#' data-toggle='modal' data-target='#imageModal'
                                            data-image='" . htmlspecialchars($row['file_path']) . "' 
                                            data-title='" . htmlspecialchars($row['file_name']) . "'>
                                            <img src='" . htmlspecialchars($row['file_path']) . "' class='img-fluid mb-2 gallery-image' alt='Image'>
                                        </a>
                                      </div>";
                                }
                                ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal for viewing images -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Image View</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body position-relative">
                <button id="prevButton" class="btn bg-gray rounded-circle position-absolute"
                    style="left: 10px; top: 50%; transform: translateY(-50%);"><i
                        class="fa-solid fa-angle-left"></i></button>
                <img id="modalImage" src="" class="img-fluid" alt="Image">
                <button id="nextButton" class="btn bg-gray rounded-circle position-absolute"
                    style="right: 10px; top: 50%; transform: translateY(-50%);"><i
                        class="fa-solid fa-angle-right"></i></button>
            </div>
            <div class="modal-footer">
                <a id="downloadButton" class="btn btn-primary" href="#" download>Download</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
<script>
    // jQuery function to handle modal
    $(document).ready(function () {
        let currentIndex = 0;
        let images = [];

        $('[data-toggle="modal"]').on('click', function () {
            var imageSrc = $(this).data('image');
            var imageTitle = $(this).data('title');

            $('#modalImage').attr('src', imageSrc);
            $('#downloadButton').attr('href', imageSrc);
            $('#imageModalLabel').text(imageTitle);

            // Store all images in an array
            images = $('[data-toggle="modal"]').map(function () {
                return $(this).data('image');
            }).get();

            currentIndex = images.indexOf(imageSrc); // Set current index
        });

        // Next button functionality
        $('#nextButton').on('click', function () {
            currentIndex = (currentIndex + 1) % images.length; // Loop back to start
            $('#modalImage').attr('src', images[currentIndex]);
            $('#downloadButton').attr('href', images[currentIndex]);
        });

        // Previous button functionality
        $('#prevButton').on('click', function () {
            currentIndex = (currentIndex - 1 + images.length) % images.length; // Loop to end
            $('#modalImage').attr('src', images[currentIndex]);
            $('#downloadButton').attr('href', images[currentIndex]);
        });
    });
</script>
<script>
    $(document).ready(function () {
        <?php if (isset($_SESSION['toastMessage'])): ?>
            // Set the message inside the toast
            $('#message').text("<?php echo htmlspecialchars($_SESSION['toastMessage']); ?>");

            // Show the toast
            $('.toast').toast('show');

            // Unset the session message to avoid showing it again on page reload
            <?php unset($_SESSION['toastMessage']); ?>
        <?php endif; ?>
    });
</script>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['images'])) {
    $targetDir = "../dist/uploads/"; // Ensure this directory exists and is writable
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true); // Create directory if it doesn't exist
    }
    $uploadOk = 1;

    foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
        $targetFile = $targetDir . basename($_FILES["images"]["name"][$key]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($tmpName);
        if ($check === false) {
            echo "File " . htmlspecialchars(basename($_FILES["images"]["name"][$key])) . " is not an image.<br>";
            $uploadOk = 0;
            continue; // Skip to the next file
        }

        // Check file size (e.g., limit to 5MB)
        if ($_FILES["images"]["size"][$key] > 5000000) {
            echo "Sorry, your file " . htmlspecialchars(basename($_FILES["images"]["name"][$key])) . " is too large.<br>";
            $uploadOk = 0;
            continue; // Skip to the next file
        }

        // Allow certain file formats
        if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed for " . htmlspecialchars(basename($_FILES["images"]["name"][$key])) . ".<br>";
            $uploadOk = 0;
            continue; // Skip to the next file
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file " . htmlspecialchars(basename($_FILES["images"]["name"][$key])) . " was not uploaded.<br>";
        } else {
            if (move_uploaded_file($tmpName, $targetFile)) {
                // Insert image details into the database using prepared statements
                $fileName = htmlspecialchars(basename($_FILES["images"]["name"][$key]));
                $filePath = htmlspecialchars($targetFile);
                $stmt = $db_connection->prepare("INSERT INTO images (file_name, file_path) VALUES (?, ?)");
                $stmt->bind_param("ss", $fileName, $filePath);
                if ($stmt->execute()) {
                    $_SESSION['toastMessage'] = "Image Uploded successfully";
                    echo "<script>window.location.href = 'Image-Gallery.php'</script>";
                } else {
                    echo "Error: " . $stmt->error . "<br>";
                }
                $stmt->close();
            } else {
                echo "Sorry, there was an error uploading your file " . htmlspecialchars(basename($_FILES["images"]["name"][$key])) . ".<br>";
            }
        }
    }
}
?>