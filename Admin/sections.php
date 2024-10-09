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
    $query = mysqli_query($db_connection, "INSERT INTO `posts`(`author`, `title`, `description`, `type`, `status`,`parent`) VALUES ('1','$title','description','section','publish',0)") or die('DB error');
    $_SESSION['toastMessage'] = "Section added successfully";
    echo "<script>window.location.href = 'sections.php';</script>";
    exit();
}
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Sections</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Section</li>
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
                            <h3 class="card-title">Sections</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered bg-white">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        $args = array('type' => 'section', 'status' => 'publish', );
                                        $sections = get_posts($args);
                                        foreach ($sections as $section) { ?>
                                            <tr>
                                                <td><?= $count++ ?></td>
                                                <td><?= $section->title ?></td>
                                                <td>
                                                    <a class="btn btn-warning" href="" data-bs-toggle="modal"
                                                        data-bs-target="#updateUserModal<?= $section->id ?>"><i
                                                            class="fa fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <div class="modal fade" id="updateUserModal<?= $section->id ?>"
                                                        tabindex="-1" aria-labelledby="updateUserModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="updateUserModalLabel">
                                                                        Update Section
                                                                        Information</h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id="updateUserForm" method="POST" action="">
                                                                        <input type="hidden" name="action" value="edit">
                                                                        <input type="hidden" name="editId"
                                                                            value="<?= $section->id ?>">
                                                                        <div class="mb-3">
                                                                            <label for="userId" class="form-label">Section id</label>
                                                                            <input type="text" class="form-control"
                                                                                id="userId" name="sectionid"
                                                                                value="<?= $section->id ?>" readonly>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="userName"
                                                                                class="form-label">Section</label>
                                                                            <input type="text" class="form-control"
                                                                                id="userName" name="sectionName"
                                                                                value="<?= $section->title ?>" required>
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
                                                        href="sections.php?action=delete&deleteId=<?= $section->id ?>"><i
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
                            <h3 class="card-title">Add New Section</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" id="title" name="title" placeholder="Enter Title" required
                                            class="form-control">
                                    </div>

                                    <button class="float-right btn btn-success" name="submit">Submit</button>
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
    $_SESSION['toastMessage'] = 'Record Deleted Successfully';
    echo "<script>window.location.href='sections.php'</script>";
}

if (isset($_POST['action']) && $_POST['action'] === 'edit' && isset($_POST['editId'])) {

    $sectionid = $_POST['sectionid'];
    $sectionName = $_POST['sectionName'];

    $sql = "UPDATE `posts` SET `title` = '$sectionName'  WHERE `id` = $sectionid";
    $result = mysqli_query($db_connection, $sql);
    $_SESSION['toastMessage'] = 'Record Updated Successfully';

    echo "<script>window.location.href='sections.php'</script>";
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