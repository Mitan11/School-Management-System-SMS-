<?php include('../includes/config.php') ?>
<?php
include('header.php');
include('sidebar.php');
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Time Table</h1>
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
                                <td>
                                    <?php echo date('h:i A', strtotime($from)) ?> -
                                    <?php echo date('h:i A', strtotime($to)) ?>
                                </td>
                                <?php
                                $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                                $usermeta = get_user_metadata($std_id);
                                $class = get_post(['id' => $usermeta['class']]);
                                $section = get_post(['id' => $usermeta['section']]);
                                foreach ($days as $day) {
                                    $query = mysqli_query($db_connection, "SELECT * FROM posts as p 
                                        INNER JOIN metadata as md ON (md.item_id = p.id) 
                                        INNER JOIN metadata as mp ON (mp.item_id = p.id) 
                                        INNER JOIN metadata as mc ON (mc.item_id = p.id) 
                                        INNER JOIN metadata as ms ON (ms.item_id = p.id) 
                                        WHERE p.type = 'timetable' AND p.status = 'publish' 
                                        AND md.meta_key = 'day_name' AND md.meta_value = '$day' 
                                        AND mp.meta_key = 'lectur_id' AND mp.meta_value = $period->id 
                                        AND mc.meta_key = 'class_id' AND mc.meta_value = $class->id
                                        AND ms.meta_key = 'section_id' AND ms.meta_value = $section->id");

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
    </div>
</section>

<?php include('footer.php'); ?>