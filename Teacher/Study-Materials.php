<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');
?>
<?php
if (isset($_POST['submit'])) {
    $class = $_POST['class'];
    $subject = $_POST['subject'];
    $title = $_POST['title'];
    $discription = $_POST['discription'];
    $file = $_FILES['attachment']['name'];
    $today = date('Y-m-d');

    $target_dir = "../dist/uploads/";
    $target_file = $target_dir . basename($_FILES["attachment"]["name"]);

    $uploadOk = 1;

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["attachment"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {

            $query = mysqli_query($db_connection, "INSERT INTO `posts` (`title` , `description` , `type` , `status` , `parent` , `author`) VALUES ('$title' , '$discription' , 'study-material' , 'publish' , 0,1)") or die(mysqli_error($db_connection));


            if ($query) {
                $item_id = mysqli_insert_id($db_connection);
            }

            $meta_data = array(
                'class' => $class,
                'subject' => $subject,
                'file_attachment' => $file
            );

            foreach ($meta_data as $key => $value) {
                mysqli_query($db_connection, "INSERT INTO `metadata` (`item_id`, `meta_key`, `meta_value`) VALUES ('$item_id', '$key', '$value')");
            }

            echo "<script>window.location.href = 'Study-Materials.php';</script>";

            exit;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Study Materials</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Teacher</a></li>
                    <li class="breadcrumb-item active">Study Materials</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <?php if (isset($_GET['action']) && $_GET['action'] == 'add-new') { 

            $classes = get_posts(['type' => 'class', 'status' => 'publish']);
            $subjects = get_posts(['type' => 'subject', 'status' => 'publish']);

            ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add New Study Material</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="title">Class</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    placeholder="Enter the title">
                            </div>

                            <div class="form-group">
                                <label for="title">Class</label>
                                <textarea name="discription" id="discription" class="form-control"
                                    placeholder="Enter discription">discription</textarea>
                            </div>

                            <div class="form-group">
                                <label for="class">Class</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="class" required
                                    id="class">
                                    <option selected disabled>-- Select Class --</option>
                                    <?php foreach ($classes as $class) { ?>
                                        <option value="<?= $class->id ?>"><?= $class->title ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                            <label for="subject">Subject</label>
                            <select class="form-select mb-3" aria-label="Default select example" name="subject" id="subject"
                                required>
                                <option selected disabled>-- Select Subject --</option>
                                <?php foreach ($subjects as $subject) { ?>
                                    <option value="<?= $subject->id ?>"><?= $subject->title ?></option>
                                <?php } ?>
                            </select>

                            <div class="input-group mb-3">
                                <input type="file" class="form-control" name="attachment" id="attachment" required>
                            </div>

                            <button class="btn btn-success" name="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php } else { ?>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Study Materials</h3>
                    <div class="card-tools">
                        <a href="?action=add-new" class="btn btn-sm btn-success"><i class="fa fa-plus mr-2"></i>Add
                            New</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered bg-white">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Attachment</th>
                                    <th>Title</th>
                                    <th>Class</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                $query = mysqli_query($db_connection, "SELECT * FROM `posts` WHERE `type`='study-material' AND author = 1 ");
                                while ($attachment = mysqli_fetch_object($query)) { 
                                    $class_id = get_metadata($attachment->id,'class')[0]->meta_value;
                                    $class = get_post(['id'=>$class_id]);

                                    $subject_id = get_metadata($attachment->id,'subject')[0]->meta_value;
                                    $subject = get_post(['id'=>$subject_id]);

                                    $file_attachment = get_metadata($attachment->id,'file_attachment')[0]->meta_value;
                                    ?>
                                    <tr>
                                        <td><?= $count++ ?></td>
                                        <td><?= $attachment->title ?></td>
                                        <td><?= $file_attachment ?>&nbsp;&nbsp;&nbsp;<a href="../dist/uploads/<?= $file_attachment ?>" download="<?= $file_attachment ?>"><i class="fa fa-solid fa-download"></i></a></td>
                                        <td><?= $class->title ?></td>
                                        <td><?= $subject->title ?></td>
                                        <td><?= $attachment->publish_date ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        <?php } ?>

    </div>
</section>


<?php include('footer.php'); ?>