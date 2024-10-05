<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');
?>
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

$students = [];
if (isset($_GET['class_id']) && isset($_GET['date']) && isset($_GET['section'])) {
    $class_id = $_GET['class_id'];
    $date = $_GET['date'];
    $section = $_GET['section'];

    $result = mysqli_query($db_connection, "SELECT user_id FROM `usermeta` WHERE (meta_key = 'class' AND meta_value = '$class_id') OR (meta_key = 'section' AND meta_value = '$section') GROUP BY user_id HAVING COUNT(DISTINCT meta_key) = 2;
");


    foreach ($result as $stu) {

        $student = get_users(array('id' => $stu['user_id']));

        foreach ($student as $key) {
            $students[] = array(
                "id" => $key->id,
                "name" => $key->name,
            );
        }
    }
    $_SESSION['toastMessage'] = "Data Loaded successfully";
}

if (isset($_POST['SaveAttendance'])) {
    $class_id = $_POST['class_id'];
    $date = $_POST['date'];
    $attendance = $_POST['attendance'];
    $section = $_POST['section'];

    foreach ($attendance as $student_id => $status) {
        $query = "INSERT INTO `attendance`(`class`, `date`, `student_id`, `status`) VALUES ('$class_id','$date','$student_id','$status')";
        mysqli_query($db_connection, $query);
    }
    $_SESSION['toastMessage'] = "Attendance marked successfully";
    echo "<script>window.location.href = 'attendance.php';</script>";
    exit();

}
?>


<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="d-flex">
                    <h1 class="m-0 text-dark">Manage Attendance</h1>
                </div>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Attendance</a></li>
                    <li class="breadcrumb-item active">Admin</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <form method="GET" action="">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="class">Select Class</label>
                                <select name="class_id" id="class" class="form-select">
                                    <option value="" selected disabled>--Select Class--</option>
                                    <?php
                                    $classes = get_posts(['type' => 'class', 'status' => 'publish']);
                                    foreach ($classes as $class) { ?>
                                        <option value="<?php echo $class->id ?>"><?php echo $class->title ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" id="section-container">
                                <label for="Section">Select Section</label>
                                <select name="section" id="Section" class="form-select">
                                    <option value="" selected disabled>--Select Section--</option>
                                    <?php
                                    $sections = get_posts(['type' => 'section', 'status' => 'publish']);
                                    foreach ($sections as $section) { ?>
                                        <option value="<?php echo $section->id ?>"><?php echo $section->title ?>
                                        </option>
                                    <?php } ?>
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="attendance-date">Date</label>
                            <input type="date" class="form-control" id="attendance-date" name="date" required
                                value="<?php echo date('Y-m-d') ?>">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Load Attendance</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <?php if (!empty($students)) { ?>

            <form method="POST" action="">
                <input type="hidden" name="class_id" value="<?php echo $_GET['class_id']; ?>">
                <input type="hidden" name="date" value="<?php echo $_GET['date']; ?>">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Student Attendance</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary btn-sm" id="mark-all-present">Mark All
                                Present</button>
                            <button type="button" class="btn btn-primary btn-sm" id="mark-all-Absent">Mark All
                                Absent</button>
                            <button type="submit" class="btn btn-success btn-sm" name="SaveAttendance">Save
                                Attendance</button>
                            <button type="button" class="btn btn-info btn-sm" id="export-attendance">Export (CSV)</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Roll No.</th>
                                    <th>Student Name</th>
                                    <th>Attendance Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($students as $student) {
                                    ?>
                                    <tr>
                                        <td><?php echo $student["id"] ?></td>
                                        <td><?php echo $student["name"] ?></td>
                                        <td>
                                            <select class="form-control attendance-status"
                                                name="attendance[<?php echo $student["id"]; ?>]">
                                                <option value="present">Present</option>
                                                <option value="absent">Absent</option>
                                                <option value="late">Late</option>
                                                <option value="leave">Leave</option>
                                            </select>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        <?php } ?>

    </div>
</section>

<?php include('footer.php'); ?>
<script>
    $(document).ready(function () {
        $('.attendance-status').change(function () {
            var status = $(this).val();
            $(this).removeClass('bg-success bg-danger bg-warning');
            if (status === 'present') {
                $(this).addClass('bg-success');
            } else if (status === 'absent') {
                $(this).addClass('bg-danger');
            } else if (status === 'late') {
                $(this).addClass('bg-warning');
            } else if (status === 'leave') {
                $(this).addClass('bg-info');
            }
        }).trigger('change');

        $('#mark-all-present').click(function () {
            $('.attendance-status').val('present').trigger('change');
        });
        $('#mark-all-Absent').click(function () {
            $('.attendance-status').val('absent').trigger('change');
        });

        $('#export-attendance').click(function () {
            // Implement CSV export functionality here
            alert('CSV export functionality to be implemented');
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