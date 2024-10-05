<?php include('../includes/config.php') ?>
<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
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
<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];

    $sections = $_POST['section'];
    // $added_date = date('Y-m-d');
    $query = mysqli_query($db_connection, "INSERT INTO `posts`(`author`, `title`, `description`, `type`, `status`,`parent`) VALUES ('1','$title','description','class','publish',0)") or die('DB error');

    if ($query) {
        $post_id = mysqli_insert_id($db_connection);
    }
    foreach ($sections as $key => $value) {
        mysqli_query($db_connection, "INSERT INTO `metadata` (`item_id`,`meta_key`,`meta_value`) VALUES ('$post_id','section','$value')") or die(mysqli_error($db_conn));
    }

    $_SESSION['toastMessage'] = "Class added successfully";
    echo "<script>window.location.href = 'classes.php';</script>";
    exit();

}
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Classes</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Classes</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <section class="content">
        <div class="container-fluid">

            <?php
            if (isset($_REQUEST['action'])) {
                ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add New Classes</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" id="title" name="title" placeholder="Enter Title" required
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="section">Section</label>
                                    <?php
                                    $args = array(
                                        'type' => 'section',
                                        'status' => 'publish',
                                    );
                                    $sections = get_posts($args);
                                    foreach ($sections as $key => $section) { ?>
                                        <div>
                                            <label for="<?php echo $key ?>">
                                                <input type="checkbox" name="section[]" id="<?php echo $key ?>"
                                                    value="<?= $section->id ?>" placeholder="section">
                                                <?php echo $section->title ?>
                                            </label>
                                        </div>
                                        <?php
                                    } ?>
                                </div>
                                <button class="btn btn-success" name="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } else { ?>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Classes</h3>
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
                                        <th>Name</th>
                                        <th>Sections</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    $args = array('type' => 'class', 'status' => 'publish', );
                                    $classes = get_posts($args);
                                    foreach ($classes as $class) {
                                        ?>
                                        <tr>
                                            <td><?= $count++ ?></td>
                                            <td><?= $class->title ?></td>
                                            <td>
                                                <?php
                                                $class_meta = get_metadata($class->id, 'section');
                                                foreach ($class_meta as $meta) {
                                                    $section = get_post(array('id' => $meta->meta_value));
                                                    echo $section->title . "<br>";
                                                }
                                                ?>
                                            </td>
                                            <td><?= $class->publish_date ?></td>
                                            <td></td>
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
        <!--/. container-fluid -->
    </section>

</div>
<!-- /.content-header -->
<?php include('footer.php'); ?>

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