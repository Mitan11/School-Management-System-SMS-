<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Study Materials</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Student</a></li>
                    <li class="breadcrumb-item active">Study Materials</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Study Materials</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered bg-white">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Attachment</th>
                                <th>Title</th>
                                <th>Class</th>
                                <th>Subject</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $usermeta = get_user_metadata($std_id);
                            $class = $usermeta['class'];
                            $count = 1;
                            $query = mysqli_query($db_connection, "SELECT * FROM `posts` as p JOIN `metadata` as m ON p.id = m.item_id WHERE p.`type`='study-material' AND m.meta_key = 'class' AND m.meta_value =  $class");
                            while ($attachment = mysqli_fetch_object($query)) {
                                // $class_id = get_metadata($attachment->id, 'class')[0]->meta_value;
                                $class = get_post(['id' => $usermeta['class']]);

                                $subject_id = get_metadata($attachment->item_id, 'subject')[0]->meta_value;
                                $subject = get_post(['id' => $subject_id]);

                                $file_attachment = get_metadata($attachment->item_id, 'file_attachment')[0]->meta_value;
                                ?>
                                <tr>
                                    <td><?= $count++ ?></td>
                                    <td><?= $attachment->title ?></td>
                                    <td><a href="../dist/uploads/<?= $file_attachment ?>"
                                            download="<?= $file_attachment ?>" class="text-black"><?= $file_attachment ?>&nbsp;&nbsp;&nbsp;<i class="text-primary fa fa-solid fa-download"></i></a>
                                    </td>
                                    <td><?= $class->title ?></td>
                                    <td><?= $subject->title ?></td>
                                    <td><?= $attachment->publish_date ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>


<?php include('footer.php'); ?>