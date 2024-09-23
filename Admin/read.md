<?php 

// Fetch classes
$class_query = "SELECT * FROM user_accounts";
$class_result = mysqli_query($db_connection, $class_query);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $class_id = $_POST['class_id'];
    $date = $_POST['date'];
    $attendance = $_POST['attendance'];

    foreach ($attendance as $student_id => $status) {
        $query = "INSERT INTO attendance (student_id, class_id, date, status) 
                  VALUES ('$student_id', '$class_id', '$date', '$status')
                  ON DUPLICATE KEY UPDATE status = '$status'";
        mysqli_query($conn, $query);
    }

    $success_message = "Attendance saved successfully!";
}

// Fetch attendance data if class and date are selected
$students = [];
if (isset($_GET['class_id']) && isset($_GET['date'])) {
    $class_id = $_GET['class_id'];
    $date = $_GET['date'];

    $query = "SELECT s.id, s.roll_number, s.name, a.status
              FROM students s
              LEFT JOIN attendance a ON s.id = a.student_id AND a.date = '$date'
              WHERE s.class_id = '$class_id'
              ORDER BY s.roll_number";
    $result = mysqli_query($db_connection, $query);
    $students = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// // Fetch attendance overview
// $overview_query = "SELECT 
//                     (SELECT COUNT(*) FROM students) as total_students,
//                     (SELECT COUNT(*) FROM attendance WHERE date = CURDATE() AND status = 'present') as present_today,
//                     (SELECT COUNT(*) FROM attendance WHERE date = CURDATE() AND status = 'absent') as absent_today,
//                     (SELECT COUNT(*) FROM attendance WHERE date = CURDATE() AND status = 'late') as late_today";
// $overview_result = mysqli_query($db_connection, $overview_query);
// $overview = mysqli_fetch_assoc($overview_result);
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <h1>Attendance Management</h1>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Attendance Overview Dashboard -->
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

        <!-- Class and Date Selection -->
        <form method="GET" action="">
            <div class="row mb-4">
                <div class="col-md-6">
                    <select class="form-control" id="class-select" name="class_id" required>
                        <option value="">Select Class</option>
                        <?php while ($class = mysqli_fetch_assoc($class_result)): ?>
                            <option value="<?php echo $class['id']; ?>" <?php echo (isset($_GET['class_id']) && $_GET['class_id'] == $class['id']) ? 'selected' : ''; ?>>
                                <?php echo $class['name']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <input type="date" class="form-control" id="attendance-date" name="date" required value="<?php echo isset($_GET['date']) ? $_GET['date'] : date('Y-m-d'); ?>">
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Load Attendance</button>
                </div>
            </div>
        </form>

        <?php if (!empty($students)): ?>
        <!-- Attendance Table -->
        <form method="POST" action="">
            <input type="hidden" name="class_id" value="<?php echo $_GET['class_id']; ?>">
            <input type="hidden" name="date" value="<?php echo $_GET['date']; ?>">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Student Attendance</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary btn-sm" id="mark-all-present">Mark All Present</button>
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
                            <?php foreach ($students as $student): ?>
                            <tr>
                                <td><?php echo $student['roll_number']; ?></td>
                                <td><?php echo $student['name']; ?></td>
                                <td>
                                    <select class="form-control attendance-status" name="attendance[<?php echo $student['id']; ?>]">
                                        <option value="present" <?php echo $student['status'] == 'present' ? 'selected' : ''; ?>>Present</option>
                                        <option value="absent" <?php echo $student['status'] == 'absent' ? 'selected' : ''; ?>>Absent</option>
                                        <option value="late" <?php echo $student['status'] == 'late' ? 'selected' : ''; ?>>Late</option>
                                    </select>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
        <?php endif; ?>

        <?php if (isset($success_message)): ?>
        <div class="alert alert-success mt-3">
            <?php echo $success_message; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('.attendance-status').change(function() {
            var status = $(this).val();
            $(this).removeClass('bg-success bg-danger bg-warning');
            if (status === 'present') {
                $(this).addClass('bg-success');
            } else if (status === 'absent') {
                $(this).addClass('bg-danger');
            } else if (status === 'late') {
                $(this).addClass('bg-warning');
            }
        }).trigger('change');

        $('#mark-all-present').click(function() {
            $('.attendance-status').val('present').trigger('change');
        });

        $('#export-attendance').click(function() {
            // Implement CSV export functionality here
            alert('CSV export functionality to be implemented');
        });
    });
</script>

<?php include('footer.php'); ?>