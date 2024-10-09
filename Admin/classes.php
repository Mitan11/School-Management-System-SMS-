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
    if (isset($_POST['sections']) && is_array($_POST['sections'])) {
        $sections = $_POST['sections']; // This should now be an array
        // Debugging: Print the sections array
        echo '<pre>';
        print_r($sections);
        echo '</pre>';
    } else {
        echo 'No sections selected or sections is not an array.';
    }
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
                                    foreach ($sections as $section) { ?>
                                        <div>
                                            <label for="section_<?php echo $section->id; ?>">
                                                <input type="checkbox" name="sections[]" 
                                                    id="section_<?php echo $section->id; ?>"
                                                    value="<?= $section->id ?>"
                                                    placeholder="section">
                                                <?php echo htmlspecialchars($section->title); ?>
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
                                            <td>
                                                <a class="btn btn-warning" href="" data-bs-toggle="modal"
                                                    data-bs-target="#updateUserModal<?= $class->id ?>"><i
                                                        class="fa fa-solid fa-pen-to-square"></i></a>
                                                <div class="modal fade" id="updateUserModal<?= $class->id ?>" tabindex="-1"
                                                    aria-labelledby="updateUserModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="updateUserModalLabel">Update
                                                                    Class
                                                                    Information</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form id="updateUserForm" method="POST" action="">
                                                                    <input type="hidden" name="action" value="edit">
                                                                    <input type="hidden" name="editId"
                                                                        value="<?= $class->id ?>">

                                                                    <div class="form-group">
                                                                        <label for="classid">Class id</label>
                                                                        <input type="text" id="classid" name="classid" value="<?= $class->id ?>"
                                                                            placeholder="Enter id" required
                                                                            class="form-control" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="classname">Class name</label>
                                                                        <input type="text" id="classname" name="classname" value="<?= $class->title ?>"
                                                                            placeholder="Enter Title" required
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
                                                                                    <input type="checkbox" name="sections[]"
                                                                                        id="<?php echo $key ?>"
                                                                                        value="<?= $section->id ?>"
                                                                                        placeholder="section">
                                                                                    <?php echo $section->title ?>
                                                                                </label>
                                                                            </div>
                                                                            <?php
                                                                        } ?>
                                                                    </div>

                                                                    <div class="float-end">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary"
                                                                            id="saveChanges" name="save"
                                                                            value="SaveChanges">Save
                                                                            Changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                &nbsp;&nbsp;
                                                <a class="btn btn-danger"
                                                    href="classes.php?action=delete&deleteId=<?= $class->id ?>"><i
                                                        class="fa fa-solid fa-trash"></i></a>
                                            </td>
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


<?php

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['deleteId'])) {
    $deleteId = $_GET['deleteId'];

    $sql = "DELETE FROM `posts` WHERE id=$deleteId";
    $result = mysqli_query($db_connection, $sql);

    $sql = "DELETE FROM `metadata` WHERE item_id=$deleteId";
    $result = mysqli_query($db_connection, $sql);
    $_SESSION['toastMessage'] = 'Record Deleted Successfully';
    echo "<script>window.location.href='classes.php'</script>";
}

if (isset($_POST['action']) && $_POST['action'] === 'edit' && isset($_POST['editId'])) {

    $classid = $_POST['classid'];
    $classname = $_POST['classname'];

    $sections = $_POST['sections'];

    $sql = "UPDATE `posts` SET `title` = '$classname'  WHERE `id` = $classid";
    $result = mysqli_query($db_connection, $sql);
    
    foreach($sections as $key => $value){    
        $sql = "DELETE FROM `metadata` WHERE `item_id` = $classid AND `meta_key` = 'section'";
        $result = mysqli_query($db_connection, $sql);
    }
    foreach($sections as $key => $value){    
        mysqli_query($db_connection, "INSERT INTO `metadata` (`item_id`,`meta_key`,`meta_value`) VALUES ('$classid','section','$value')") or die(mysqli_error($db_conn));
    }

    $_SESSION['toastMessage'] = 'Record Updated Successfully';

    echo "<script>window.location.href='classes.php'</script>";
}

?>

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