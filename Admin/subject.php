<?php include('../includes/config.php')?>
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
    if(isset($_POST['submit'])){ 
        $name = $_POST['cname'];
        $category = $_POST['category'];
        $duration = $_POST['duration'];
        $image = $_FILES['thumbnail']['name'];
        $today = date('Y-m-d');

        $target_dir = "../dist/uploads/";
        $target_file = $target_dir . basename($_FILES["thumbnail"]["name"]);

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["thumbnail"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file)) {
                mysqli_query($db_connection , "INSERT INTO courses (`name` , category , duration , `image` , `date`) VALUES ('$name' , '$category' , '$duration' , '$image' , '$today')") or die("Error");
                header('Location: courses.php');
                $_SESSION['success_msg'] = 'Course Has Been Added Successfully..!';
                exit;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        
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
            if(isset($_SESSION['success_msg'])){?>
            <div class="toast-container top-0 end-0 p-3">
                <div class="toast show fade" id="liveToast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-body">
                        <div class="d-flex gap-4">
                            <span class="text-primary"><i class="fa-solid fa-circle-info fa-lg"></i></span>
                            <div class="d-flex flex-grow-1 align-items-center">
                                <span class="fw-semibold">
                                    <?=$_SESSION['success_msg']?>
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

            <?php
            if(isset($_REQUEST['action'])){
        ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add New Subjects</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="ctitle">Course Name</label>
                                <input type="text" id="ctitle" name="cname" placeholder="Course Name" required
                                    class="form-control">
                            </div>
                            <label for="category">Course Category</label>
                            <select class="form-select mb-3" aria-label="Default select example" name="category"
                                id="category">
                                <option selected disabled>-- Select Category --</option>
                                <option value="Programming">Programming</option>
                                <option value="WEB DEVLOPMENT">WEB DEVLOPMENT</option>
                                <option value="APP DEVLOPMENT">APP DEVLOPMENT</option>
                            </select>
                            <div class="form-group">
                                <label for="duration">Duration</label>
                                <input type="text" id="duration" name="duration" placeholder="Enter Duration" required
                                    class="form-control">
                            </div>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" name="thumbnail" id="thumnail" required>
                            </div>

                            <button class="btn btn-success" name="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php }else{ ?>

            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header py-2">
                            <h3 class="card-title">Add New Subjects</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="">
                                <div class="form-group">
                                    <label for="class">Select Class</label>
                                    <select name="class" id="class" class="form-select">
                                        <option value="" selected disabled>--Select Class--</option>
                                        <?php 
                                        $args = array('type'=>'class','status'=>'publish',);
                                        $classes = get_posts($args);
                                        foreach($classes as $key => $class){?>
                                            <option value="<?php echo $class -> id ?>"><?php echo $class -> title ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group" id="section-container" style="display: none;">
                                    <label for="Section">Select Section</label>
                                    <select name="section" id="Section" class="form-select">
                                        <option value="" selected disabled>--Select Section--</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="subject">Subject Name</label>
                                    <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject Name" required>
                                </div>
                                <button type="submit" id="submit" name="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Courses</h3>
                            <div class="card-tools">
                                <a href="?action=add-new" class="btn btn-sm btn-success"><i
                                        class="fa fa-plus mr-2"></i>Add New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered bg-white">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Course Name</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $count = 1;
                                            $args = array('type'=>'subject','status'=>'publish',);
                                            $subjects = get_posts($args);
                                            foreach($subjects as $subject){?>
                                        <tr>
                                            <td><?=$count++ ?></td>
                                            <td><?=$subject->title?></td>
                                            <td><?=$subject->publish_date?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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

<script>
$(document).ready(function() {
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