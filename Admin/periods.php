<?php include('../includes/config.php')?>
<?php include('header.php'); ?>

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
if(isset($_POST['submit'])){
$title = isset($_POST['title'])?$_POST['title']:'';
$from = isset($_POST['from'])?$_POST['from']:'';
$to = isset($_POST['to'])?$_POST['to']:'';
$status = 'publish';
$type = 'period';
$date_add = date('y-m-d g:i:s');

$query = mysqli_query($db_connection,"INSERT INTO `posts` (`title`,`status`,`publish_date`,`type`) VALUES ('$title','$status','$date_add','$type')");

if ($query) {
    $item_id = mysqli_insert_id($db_connection);
}

mysqli_query($db_connection,"INSERT INTO `metadata`(`meta_key`, `meta_value`,`item_id`) VALUES ('from','$from','$item_id')");
mysqli_query($db_connection,"INSERT INTO `metadata` (`meta_key`,`meta_value`,`item_id`) VALUES ('to','$to','$item_id')");
$_SESSION['toastMessage'] = "Period added successfully";
header("Location: periods.php");
exit();
}
?>
<?php include('sidebar.php'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Periods</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Periods</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Periods</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered bg-white">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Title</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $count = 1;
                                            $args = array('type'=>'period','status'=>'publish',);
                                            $periods = get_posts($args);
                                            foreach($periods as $period){
                                                // Retrieve metadata for 'from'
                                                $from_meta = get_metadata($period->id, 'from');
                                                $from = !empty($from_meta) ? $from_meta[0]->meta_value : 'N/A'; // Default to 'N/A' if not found

                                                // Retrieve metadata for 'to'
                                                $to_meta = get_metadata($period->id, 'to');
                                                $to = !empty($to_meta) ? $to_meta[0]->meta_value : 'N/A'; // Default to 'N/A' if not found
                                                ?>
                                            <tr>
                                                <td><?=$count++ ?></td>
                                                <td><?=$period->title ?></td>
                                                <td><?php echo date('h:i A',strtotime($from)) ?></td>
                                                <td><?php echo date('h:i A',strtotime($to)) ?></td>
                                                <td>
                                                <a class="btn btn-warning" href="" data-bs-toggle="modal"
                                                    data-bs-target="#updateUserModal<?= $period->id ?>"><i
                                                        class="fa fa-solid fa-pen-to-square"></i></a>
                                                <div class="modal fade" id="updateUserModal<?= $period->id ?>" tabindex="-1"
                                                    aria-labelledby="updateUserModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="updateUserModalLabel">Update
                                                                    Period Information</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form id="updateUserForm" method="POST" action="">
                                                                    <input type="hidden" name="action" value="edit">
                                                                    <input type="hidden" name="editId"
                                                                        value="<?= $period->id ?>">

                                                                        <div class="form-group">
                                                                            <label for="periodid<?= $period->id ?>">Perido id</label>
                                                                            <input type="text" id="periodid<?= $period->id ?>" name="periodid" value="<?= htmlspecialchars($period->id) ?>" required class="form-control" readonly>
                                                                        </div>
                                                                    <!-- New fields for editing -->
                                                                    <div class="form-group">
                                                                        <label for="editTitle<?= $period->id ?>">Title</label>
                                                                        <input type="text" id="editTitle<?= $period->id ?>" name="editTitle" value="<?= htmlspecialchars($period->title) ?>" required class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="editFrom<?= $period->id ?>">From</label>
                                                                        <input type="time" id="editFrom<?= $period->id ?>" name="editFrom" value="<?= date('H:i', strtotime($from)) ?>" required class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="editTo<?= $period->id ?>">To</label>
                                                                        <input type="time" id="editTo<?= $period->id ?>" name="editTo" value="<?= date('H:i', strtotime($to)) ?>" required class="form-control">
                                                                    </div>
                                                                    <!-- End of new fields -->

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
                                                    href="periods.php?action=delete&deleteId=<?= $period->id ?>"><i
                                                        class="fa fa-solid fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add New Periods</h3>
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
                                        <label for="From">From</label>
                                        <input type="time" id="From" name="from" placeholder="from" required
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="To">To</label>
                                        <input type="time" id="To" name="to" placeholder="to" required
                                            class="form-control">
                                    </div>
                                    <button class="float-right btn btn-success" type="submit" name="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
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
    echo "<script>window.location.href='periods.php'</script>";
}

if (isset($_POST['action']) && $_POST['action'] === 'edit' && isset($_POST['editId'])) {
    $periodid = $_POST['periodid'];
    $editTitle = $_POST['editTitle'];
    $editFrom = $_POST['editFrom'];
    $editTo = $_POST['editTo'];

    // Update the post title
    $updatePostQuery = "UPDATE `posts` SET `title` = '$editTitle' WHERE `id` = $periodid";
    mysqli_query($db_connection, $updatePostQuery);

    // Update the metadata for 'from'
    $updateFromMetaQuery = "UPDATE `metadata` SET `meta_value` = '$editFrom' WHERE `item_id` = $periodid AND `meta_key` = 'from'";
    mysqli_query($db_connection, $updateFromMetaQuery);

    // Update the metadata for 'to'
    $updateToMetaQuery = "UPDATE `metadata` SET `meta_value` = '$editTo' WHERE `item_id` = $periodid AND `meta_key` = 'to'";
    mysqli_query($db_connection, $updateToMetaQuery);

   

    $_SESSION['toastMessage'] = 'Record Updated Successfully';

    echo "<script>window.location.href='periods.php'</script>";
}


?>

<script>
$(document).ready(function() {
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