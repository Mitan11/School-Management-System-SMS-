<?php include('../includes/config.php') ?>
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
if (isset($_POST['submit']) && $_POST['submit'] == 'submitSubject') {
    $subject = $_POST['subject'];
    mysqli_query($db_connection, "INSERT INTO `posts`(`author`, `title`, `description`, `type`, `status`,`parent`) VALUES ('1','$subject','description','subject','publish',0)") or die('DB error');
    echo $subject;

    $_SESSION['toastMessage'] = "Subject added successfully";
    echo "<script>window.location.href = 'subject.php';</script>";
    exit();
}
?>
<?php include('sidebar.php'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Subjects</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Subjects</li>
                </ol>
            </div><!-- /.col -->
            <?php
            if (isset($_SESSION['success_msg'])) { ?>
                <div class="toast-container top-0 end-0 p-3">
                    <div class="toast show fade" id="liveToast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-body">
                            <div class="d-flex gap-4">
                                <span class="text-primary"><i class="fa-solid fa-circle-info fa-lg"></i></span>
                                <div class="d-flex flex-grow-1 align-items-center">
                                    <span class="fw-semibold">
                                        <?= $_SESSION['success_msg'] ?>
                                    </span>
                                    <button type="button" class="btn-close btn-close-sm btn-close-black ms-auto"
                                        data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                unset($_SESSION['success_msg']);
            }
            ?>
        </div><!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header py-2">
                            <h3 class="card-title">Add New Subjects</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="subject">Subject Name</label>
                                    <input type="text" id="subject" name="subject" class="form-control"
                                        placeholder="Subject Name" required>
                                </div>
                                <button type="submit" id="submit" name="submit" value="submitSubject"
                                    class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Subjects</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered bg-white">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Course Name</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        $args = array('type' => 'subject', 'status' => 'publish', );
                                        $subjects = get_posts($args);
                                        foreach ($subjects as $subject) { ?>
                                            <tr>
                                                <td><?= $count++ ?></td>
                                                <td><?= $subject->title ?></td>
                                                <td><?= $subject->publish_date ?></td>
                                                <td>
                                                    <a class="btn btn-warning" href="" data-bs-toggle="modal"
                                                        data-bs-target="#updateUserModal<?= $subject->id ?>"><i
                                                            class="fa fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <div class="modal fade" id="updateUserModal<?= $subject->id ?>"
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
                                                                            value="<?= $subject->id ?>">
                                                                        <div class="mb-3">
                                                                            <label for="userId" class="form-label">Subject
                                                                                id</label>
                                                                            <input type="text" class="form-control"
                                                                                id="userId" name="subjectid"
                                                                                value="<?= $subject->id ?>" readonly>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="userName"
                                                                                class="form-label">Subject</label>
                                                                            <input type="text" class="form-control"
                                                                                id="userName" name="subjectname"
                                                                                value="<?= $subject->title ?>" required>
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
                                                        href="subject.php?action=delete&deleteId=<?= $subject->id ?>"><i
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
            </div>
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
    echo "<script>window.location.href='subject.php'</script>";
}

if (isset($_POST['action']) && $_POST['action'] === 'edit' && isset($_POST['editId'])) {

    $subjectid = $_POST['subjectid'];
    $subjectname = $_POST['subjectname'];

    $sql = "UPDATE `posts` SET `title` = '$subjectname'  WHERE `id` = '$subjectid'";
    $result = mysqli_query($db_connection, $sql);
    $_SESSION['toastMessage'] = 'Record Updated Successfully';

    echo "<script>window.location.href='subject.php'</script>";
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