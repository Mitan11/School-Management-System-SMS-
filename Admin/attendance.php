<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');
?>

<?php

$students = [];
if (isset($_GET['class_id']) && isset($_GET['date'])) {
    $class_id = $_GET['class_id'];
    $date = $_GET['date'];

    $result = get_users_meta(array('meta_value' => $class_id));

    foreach ($result as $stu) {

        $student = get_users(array('id' => $stu->user_id));

        foreach ($student as $key) {
            $students[] = array(
                "id" => $key->id,
                "name" => $key->name,
            );
        }
    }
}

if (isset($_POST['SaveAttendance'])) {
    $class_id = $_POST['class_id'];
    $date = $_POST['date'];
    $attendance = $_POST['attendance'];

    foreach ($attendance as $student_id => $status) {
        $query = "INSERT INTO `attendance`(`class`, `date`, `student_id`, `status`) VALUES ('$class_id','$date','$student_id','$status')";
        mysqli_query($db_connection, $query);
    }

    echo "<script>window.location.href = 'attendance.php';</script>";

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
                        <div class="col-md-6">
                            <label for="class-select">Class</label>
                            <select class="form-select" id="class-select" name="class_id" required>
                                <option selected disabled>-- SelectClass --</option>
                                <?php
                                $result = get_posts(['type' => 'class']);
                                foreach ($result as $class) { ?>
                                    <option value="<?= $class->id ?>"><?= $class->title ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6">
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