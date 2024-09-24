<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');

// Initialize arrays to store attendance records and status
$attendance_records = [];
$attendance_status = [];

// Query to fetch attendance records for a specific student
$attendance_query = "SELECT * FROM `attendance` WHERE student_id = $std_id";
$attendance_data = mysqli_query($db_connection, $attendance_query);

// Loop through the fetched attendance data and store it in arrays
while ($record = mysqli_fetch_object($attendance_data)) {
    $attendance_records[] = $record;
    $attendance_status[date('Y-m-d', strtotime($record->date))] = $record->status;
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Manage Attendance</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Attendance</a></li>
                    <li class="breadcrumb-item active">Student</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <?php
        // Calendar class to render the attendance calendar
        class Calendar
        {
            private $currentYear;
            private $currentMonth;

            // Constructor to initialize the current year and month
            public function __construct()
            {
                $this->currentYear = isset($_GET['year']) ? (int) $_GET['year'] : date('Y');
                $this->currentMonth = isset($_GET['month']) ? (int) $_GET['month'] : date('m');
            }

            // Render the calendar with attendance status
            public function render($attendance_status)
            {
                $this->renderHeader();
                $this->renderDays($attendance_status);
            }

            // Render the calendar header with navigation
            private function renderHeader()
            {
                echo "<div class='datepicker'>";
                echo "<div class='datepicker-days'>";
                echo "<table class='table table-sm text-center'>";
                echo "<thead><tr>";
                echo "<th class='prev'><a href='?year={$this->currentYear}&month=" . ($this->currentMonth - 1) . "'><span class='fa fa-chevron-left'></span></a></th>";
                echo "<th class='picker-switch' colspan='5'>" . date('F Y', strtotime("{$this->currentYear}-{$this->currentMonth}-01")) . "</th>";
                echo "<th class='next'><a href='?year={$this->currentYear}&month=" . ($this->currentMonth + 1) . "'><span class='fa fa-chevron-right'></span></a></th>";
                echo "</tr><tr>";
                echo "<th class='dow'>Sunday</th><th class='dow'>Monday</th><th class='dow'>Tuesday</th><th class='dow'>Wednesday</th><th class='dow'>Thursday</th><th class='dow'>Friday</th><th class='dow'>Saturday</th>";
                echo "</tr></thead><tbody>";
            }

            // Render the days of the month with attendance status
            private function renderDays($attendance_status)
            {
                $firstDayOfMonth = mktime(0, 0, 0, $this->currentMonth, 1, $this->currentYear);
                $totalDays = date('t', $firstDayOfMonth);
                $startingDay = date('w', $firstDayOfMonth);

                echo "<tr>";
                // Render empty cells for days before the first day of the month
                for ($i = 0; $i < $startingDay; $i++) {
                    echo "<td></td>";
                }

                // Render each day of the month with attendance status
                for ($day = 1; $day <= $totalDays; $day++) {
                    if (($startingDay + $day - 1) % 7 == 0 && $day > 1) {
                        echo "</tr><tr>";
                    }

                    $dateString = sprintf('%04d-%02d-%02d', $this->currentYear, $this->currentMonth, $day);
                    $statusClass = '';

                    // Determine the CSS class based on attendance status
                    if (isset($attendance_status[$dateString])) {
                        switch ($attendance_status[$dateString]) {
                            case 'present':
                                $statusClass = 'bg-success';
                                break;
                            case 'absent':
                                $statusClass = 'bg-danger';
                                break;
                            case 'leave':
                                $statusClass = 'bg-info';
                                break;
                            case 'late':
                                $statusClass = 'bg-warning';
                                break;
                        }
                    }

                    echo "<td data-action='selectDay' data-day='{$dateString}' class='day'><p class='m-0 d-flex justify-content-center'><span style='width:30px;height:30px;' class='{$statusClass} d-flex justify-content-center align-items-center rounded-circle'>{$day}</span></p></td>";
                }

                // Render empty cells for days after the last day of the month
                while (($startingDay + $totalDays) % 7 != 0) {
                    echo "<td></td>";
                    $totalDays++;
                }
                echo "</tr></tbody></table></div></div>";
            }
        }
        ?>

        <div class="card bg-body-tertiary">
            <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">
                    <i class="far fa-calendar-alt"></i>
                    Calendar
                </h3>
                <div class="d-flex">
                    <div class="px-3 d-flex align-items-center">
                        <div class="bg-danger rounded-circle" style="height: 10px; width: 10px; margin-right: 5px;">
                        </div>
                        <span>Absent</span>
                    </div>
                    <div class="px-3 d-flex align-items-center">
                        <div class="bg-success rounded-circle" style="height: 10px; width: 10px; margin-right: 5px;">
                        </div>
                        <span>Present</span>
                    </div>

                    <div class="px-3 d-flex align-items-center">
                        <div class="bg-info rounded-circle" style="height: 10px; width: 10px; margin-right: 5px;">
                        </div>
                        <span>Leave</span>
                    </div>
                    <div class="px-3 d-flex align-items-center">
                        <div class="bg-warning rounded-circle" style="height: 10px; width: 10px; margin-right: 5px;">
                        </div>
                        <span>Late</span>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div id="calendar" style="width: 100%;">
                    <?php
                    // Create a new Calendar instance and render it with attendance status
                    $calendar = new Calendar();
                    $calendar->render($attendance_status);
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>