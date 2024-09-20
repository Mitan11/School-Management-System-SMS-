<?php include('../includes/config.php') ?>

<?php
if (isset($_POST['submit'])) {
    $class_id = $_POST['class'];
    $section_id = $_POST['section'];
    $teacher_id = $_POST['teacher'];
    $period_id = $_POST['period'];
    $day_name = $_POST['day'];
    $subject_id = $_POST['Subject'];
    $date_add = date('Y-m-d H:i:s');
    $status = 'publish';
    $author = 1;
    $type = 'timetable';

    $query = mysqli_query($db_connection, "INSERT INTO `posts`(`author`, `title`, `description`, `type`, `status`,`parent`) VALUES ('1','$type','description','timetable','publish',0)") or die('DB error');

    if ($query) {
        $item_id = mysqli_insert_id($db_connection);
    }

    $metadata = array(
        'class_id' => $class_id,
        'section_id' => $section_id,
        'teacher_id' => $teacher_id,
        'lectur_id' => $period_id,
        'day_name' => $day_name,
        'subject_id' => $subject_id,
    );

    foreach ($metadata as $key => $value) {
        mysqli_query($db_connection, "INSERT INTO metadata (`item_id`,`meta_key`,`meta_value`) VALUES ('$item_id','$key','$value')");
    }
    header('Location: tt.php');
}

include('header.php');
include('sidebar.php');
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Time Table</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Time Table</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <?php if (isset($_GET['action']) && $_GET['action'] == 'add') { ?>
            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="class">Select Class</label>
                                    <select name="class" id="class" class="form-select">
                                        <option value="" selected disabled>--Select Class--</option>
                                        <?php
                                        $args = array(
                                            'type' => 'class',
                                            'status' => 'publish',
                                        );
                                        $classes = get_posts($args);
                                        foreach ($classes as $class) { ?>
                                            <option value="<?php echo $class->id ?>"><?php echo $class->title ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group" id="section-container">
                                    <label for="Section">Select Section</label>
                                    <select name="section" id="Section" class="form-select">
                                        <option value="" selected disabled>--Select Section--</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group" id="section-container">
                                    <label for="teacher">Select Teacher</label>
                                    <select name="teacher" id="teacher" class="form-select">
                                        <option value="" selected disabled>--Select Teacher--</option>
                                        <option value="1">Teacher 1</option>
                                        <option value="2">Teacher 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group" id="section-container">
                                    <label for="period">Select Period</label>
                                    <select name="period" id="period" class="form-select">
                                        <option value="" selected disabled>--Select Period--</option>
                                        <?php
                                        $periods = get_posts(['type' => 'period', 'status' => 'publish']);
                                        foreach ($periods as $period) { ?>
                                            <option value="<?php echo $period->id ?>"><?php echo $period->title ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group" id="section-container">
                                    <label for="day">Select Day</label>
                                    <select name="day" id="day" class="form-select">
                                        <option value="" selected disabled>--Select day--</option>
                                        <?php
                                        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                                        foreach ($days as $day) { ?>
                                            <option value="<?php echo $day ?>"><?php echo ucwords($day) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group" id="section-container">
                                    <label for="Subject">Select Subject</label>
                                    <select name="Subject" id="Subject" class="form-select">
                                        <option value="" selected disabled>--Select Subject--</option>
                                        <option value="19">Mathematics</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-auto">
                                <button class="btn btn-success" name="submit" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php } else { ?>
            <div class="card">
                <div class="card-header">
                    <a href="?action=add" class="btn btn-sm btn-success float-end">Add new</a>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="class">Select Class</label>
                                    <select name="class" id="class" class="form-select">
                                        <option value="" selected disabled>--Select Class--</option>
                                        <?php
                                        $classes = get_posts(['type' => 'class', 'status' => 'publish']);
                                        foreach ($classes as $class) { ?>
                                            <option value="<?php echo $class->id ?>"><?php echo $class->title ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group" id="section-container" style="display: none;">
                                    <label for="Section">Select Section</label>
                                    <select name="section" id="Section" class="form-select">
                                        <option value="" selected disabled>--Select Section--</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Timing</th>
                                <th>Monday</th>
                                <th>Tuesday</th>
                                <th>Wednesday</th>
                                <th>Thursday</th>
                                <th>Friday</th>
                                <th>Saturday</th>
                                <th>Sunday</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $periods = get_posts(['type' => 'period', 'status' => 'publish']);
                            foreach ($periods as $period) {
                                $from = get_metadata($period->id, 'from')[0]->meta_value;
                                $to = get_metadata($period->id, 'to')[0]->meta_value;
                                ?>
                                <tr>
                                    <td><?php echo date('h:i A', strtotime($from)) ?> -
                                        <?php echo date('h:i A', strtotime($to)) ?>
                                    </td>
                                    <?php
                                    $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                                    foreach ($days as $day) {
                                        $query = mysqli_query($db_connection, "SELECT * FROM posts as p 
                                        INNER JOIN metadata as md ON (md.item_id = p.id) 
                                        INNER JOIN metadata as mp ON (mp.item_id = p.id) 
                                        WHERE p.type = 'timetable' AND p.status = 'publish' 
                                        AND md.meta_key = 'day_name' AND md.meta_value = '$day' 
                                        AND mp.meta_key = 'lectur_id' AND mp.meta_value = $period->id ");

                                        if (mysqli_num_rows($query) > 0) {
                                            while ($timetable = mysqli_fetch_object($query)) { ?>
                                                <td>
                                                    <p>
                                                        <b>Teacher: </b>
                                                        <?php
                                                        $teacher_id = get_metadata($timetable->item_id, 'teacher_id')[0]->meta_value;

                                                        echo get_user_data($teacher_id)->name;
                                                        ?>


                                                        <br>
                                                        <b>Class: </b>
                                                        <?php
                                                        $class_id = get_metadata($timetable->item_id, 'class_id', )[0]->meta_value;
                                                        echo get_post(array('id' => $class_id))->title;
                                                        ?>
                                                        <br>
                                                        <b>Section: </b>
                                                        <?php
                                                        $section_id = get_metadata($timetable->item_id, 'section_id', )[0]->meta_value;
                                                        echo get_post(array('id' => $section_id))->title;
                                                        ?>
                                                        <br>
                                                        <b>Subject: </b>
                                                        <?php
                                                        $subject_id = get_metadata($timetable->item_id, 'subject_id', )[0]->meta_value;
                                                        echo get_post(array('id' => $subject_id))->title;
                                                        ?>
                                                        <br>
                                                    </p>
                                                </td>
                                            <?php }
                                        } else { ?>
                                            <td>off</td>
                                        <?php }
                                    } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<?php include('footer.php'); ?>