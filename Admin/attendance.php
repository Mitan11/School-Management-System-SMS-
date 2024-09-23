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
                "id"=>$key->id,
                "name"=>$key->name,
            );
        }
    }

print_r($students);
}

?>


<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="d-flex">
                    <h1 class="m-0 text-dark">Manage Attendance</h1>
                    <!-- <a href="user-account.php?user=&action=add-new" class="btn btn-primary btn-sm">Add New</a> -->
                </div>

            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Attendance</a></li>
                    <li class="breadcrumb-item active">Admin</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Total Students</h5>
                        <p class="card-text"><?php #echo $overview['total_students']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Present Today</h5>
                        <p class="card-text"><?php #echo $overview['present_today']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Absent Today</h5>
                        <p class="card-text"><?php #echo $overview['absent_today']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger">
                    <div class="card-body">
                        <h5 class="card-title">Late Today</h5>
                        <p class="card-text"><?php #echo $overview['late_today']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <form method="GET" action="">
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="class-select">Class</label>
                    <select class="form-control" id="class-select" name="class_id" required>
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


        <?php #if (!empty($students)): ?>

        <form method="POST" action="">
            <input type="hidden" name="class_id" value="<?php #echo $_GET['class_id']; ?>">
            <input type="hidden" name="date" value="<?php #echo $_GET['date']; ?>">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Student Attendance</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary btn-sm" id="mark-all-present">Mark All
                            Present</button>
                        <button type="submit" class="btn btn-success btn-sm">Save Attendance</button>
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
                            $student_data = get_users(array('user_type' => "student"));
                            foreach ($student_data as $student) {
                                ?>
                                <tr>
                                    <td><?php echo $student->id ?></td>
                                    <td><?php echo $student->name ?></td>
                                    <td>
                                        <select class="form-control attendance-status"
                                            name="attendance[<?php echo $student->id; ?>]">
                                            <option value="present" <?php #echo $student['status'] == 'present' ? 'selected' : ''; ?>>Present</option>
                                            <option value="absent" <?php #echo $student['status'] == 'absent' ? 'selected' : ''; ?>>Absent</option>
                                            <option value="late" <?php #echo $student['status'] == 'late' ? 'selected' : ''; ?>>Late</option>
                                        </select>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
        <?php #endif; ?>

    </div>
</section>

<?php include('footer.php'); ?>