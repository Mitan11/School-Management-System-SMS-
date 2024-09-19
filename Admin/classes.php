<?php include('../includes/config.php')?>
<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<?php
    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $sections = implode(',',$_POST['section']);
        $added_date = date('y-m-d');
        mysqli_query($db_connection , "INSERT INTO classes (title,section,added_date) value ('$title','$sections','$added_date')") or die('Try Again');
    }
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Classes</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Classes</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <section class="content">
        <div class="container-fluid">

            <?php
            if(isset($_REQUEST['action'])){
        ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add New Classes</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" name="title" placeholder="Enter Title" required
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="section">Section</label>
                                <?php
                                $query = mysqli_query($db_connection , 'SELECT * FROM sections');
                                $count =1;
                                while($sections = mysqli_fetch_object($query)){?>
                                <div class="">
                                    <label for="<?=$count ?>">
                                        <input type="checkbox" id="<?=$count ?>" value="<?=$sections->id?>"
                                            name="section[]" placeholder="Enter Section">
                                        <?=$sections->title?>
                                    </label>
                                </div>
                                <?php $count++; } ?>
                            </div>
                            <button class="btn btn-success" name="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php }else{ ?>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Classes</h3>
                    <div class="card-tools">
                        <a href="?action=add-new" class="btn btn-sm btn-success"><i class="fa fa-plus mr-2"></i>Add
                            New</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered bg-white">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Sections</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $count = 1;
                                    $args = array('type'=>'class','status'=>'publish',);
                                    $classes = get_posts($args);
                                    foreach($classes as $class){
                                ?>
                                <tr>
                                    <td><?=$count++ ?></td>
                                    <td><?=$class->title?></td>
                                    <td>
                                        <?php 
                                        $class_meta = get_metadata($class->id,'section');
                                    foreach ($class_meta as $meta) {
                                        $section = get_post(array('id'=>$meta->meta_value));
                                                echo $section->title . "<br>";
                                    }
                                    ?></td>
                                    <td><?=$class->publish_date?></td>
                                    <td></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <?php } ?>
        </div>
        <!--/. container-fluid -->
    </section>

</div>
<!-- /.content-header -->
<?php include('footer.php'); ?>