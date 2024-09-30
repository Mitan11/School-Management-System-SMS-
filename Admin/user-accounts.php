<?php include('../includes/config.php') ?>
<?php
$error = '';
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5(1234567890);
    $type = $_POST['type'];

    $check_query = mysqli_query($db_connection, "SELECT * FROM user_accounts WHERE email = '$email'");
    if (mysqli_num_rows($check_query) > 0) {
        $error = 'Email already exists';
    } else {
        
    }
}

?>

<?php include('header.php') ?>
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
<?php include('sidebar.php') ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="d-flex">
                    <h1 class="m-0 text-dark">Manage Accounts</h1>
                    <!-- <a href="user-account.php?user=<?php #echo $_REQUEST['user'] ?>&action=add-new" class="btn btn-primary btn-sm">Add New</a> -->
                </div>

            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Accounts</a></li>
                    <li class="breadcrumb-item active"><?php echo ucfirst($_REQUEST['user']) ?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <?php if (isset($_GET['action']) && $_REQUEST['user'] == "student") { ?>
            <div class="card">
                <div class="card-body" id="form-container">
                    <?php if ($_GET['action'] == 'add-new') { ?>
                        <form action="../Action/student-registration.php" id="student-registration" method="post">
                            <fieldset class="border border-dark p-3 mb-3 form-group">
                                <legend class="d-inline w-auto float-none">Student Information</legend>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="name">Full Name</label>
                                            <input type="text" id="name" class="form-control" placeholder="Full Name"
                                                name="name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="date">DOB</label>
                                            <input type="date" id="date" required class="form-control" placeholder="DOB"
                                                name="dob">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="mobile">Mobile</label>
                                            <input type="text" id="mobile" class="form-control" placeholder="Mobile"
                                                name="mobile">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" id="email" required class="form-control"
                                                placeholder="Email Address" name="email">
                                        </div>
                                    </div>

                                    <!-- Address Fields -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea class="form-control" id="address" placeholder="Address"
                                                name="address"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <input type="text" id="country" class="form-control" placeholder="Country"
                                                name="country">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="state">State</label>
                                            <input type="text" id="state" class="form-control" placeholder="State" name="state">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="code">Pin/Zip Code</label>
                                            <input type="text" id="code" class="form-control" placeholder="Pin/Zip Code"
                                                name="zip">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="border border-dark p-3 mb-3 form-group">
                                <legend class="d-inline w-auto float-none">Parents Information</legend>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="FatherName">Father's Name</label>
                                            <input type="text" id="FatherName" class="form-control" placeholder="Father's Name"
                                                name="father_name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="FatherMobile">Father's Mobile</label>
                                            <input type="text" id="FatherMobile" class="form-control"
                                                placeholder="Father's Mobile" name="father_mobile">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="MotherName">Mother's Name</label>
                                            <input type="text" id="MotherName" class="form-control" placeholder="Mother's Name"
                                                name="mother_name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="MothersMobile">Mothers's Mobile</label>
                                            <input type="text" id="MothersMobile" class="form-control"
                                                placeholder="Mothers's Mobile" name="mother_mobile">
                                        </div>
                                    </div>
                                    <!-- Address Fields -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="Address">Address</label>
                                            <textarea class="form-control" id="Address" placeholder="Address"
                                                name="parents_address"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="Country">Country</label>
                                            <input type="text" id="Country" class="form-control" placeholder="Country"
                                                name="parents_country">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="State">State</label>
                                            <input type="text" id="State" class="form-control" placeholder="State"
                                                name="parents_state">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="Code">Pin/Zip Code</label>
                                            <input type="text" id="Code" class="form-control" placeholder="Pin/Zip Code"
                                                name="parents_zip">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="border border-dark p-3 mb-3 form-group">
                                <legend class="d-inline w-auto float-none">Last Qualification</legend>
                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="SchoolName">School Name</label>
                                            <input type="text" id="SchoolName" class="form-control" placeholder="School Name"
                                                name="school_name">
                                        </div>
                                    </div>
                                    <div class="col-lg">
                                        <div class="form-group">
                                            <label for="Class">Class</label>
                                            <input type="text" id="Class" class="form-control" placeholder="Class"
                                                name="previous_class">
                                        </div>
                                    </div>
                                    <div class="col-lg">
                                        <div class="form-group">
                                            <label for="Status">Status</label>
                                            <input type="text" id="Status" class="form-control" placeholder="Status"
                                                name="status">
                                        </div>
                                    </div>
                                    <div class="col-lg">
                                        <div class="form-group">
                                            <label for="TotalMarks">Total Marks</label>
                                            <input type="text" id="TotalMarks" class="form-control" placeholder="Total Marks"
                                                name="total_marks">
                                        </div>
                                    </div>
                                    <div class="col-lg">
                                        <div class="form-group">
                                            <label for="ObtainMarks">Obtain Marks</label>
                                            <input type="text" id="ObtainMarks" class="form-control" placeholder="Obtain Marks"
                                                name="obtain_mark">
                                        </div>
                                    </div>
                                    <div class="col-lg">
                                        <div class="form-group">
                                            <label for="Percentage">Percentage</label>
                                            <input type="text" id="Percentage" class="form-control" placeholder="Percentage"
                                                name="previous_percentage">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="border border-dark p-3 mb-3 form-group">
                                <legend class="d-inline w-auto float-none">Admission Details</legend>
                                <div class="row">
                                    <div class="col-lg">
                                        <div class="form-group">
                                            <label for="class">Class</label>

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
                                    <div class="col-lg">
                                        <div class="form-group" id="section-container">
                                            <label for="Section">Select Section</label>
                                            <select name="section" id="Section" class="form-select">
                                                <option value="" selected disabled>--Select Section--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg">
                                        <div class="form-group">
                                            <label for="Subject">Subject Streem</label>
                                            <input type="text" id="Subject" class="form-control" placeholder="Subject Streem"
                                                name="subject_streem">
                                        </div>
                                    </div>
                                    <div class="col-lg">
                                        <div class="form-group">
                                            <label for="doa">Date of Admission</label>
                                            <input type="date" id="doa" class="form-control" placeholder="Date of Admission"
                                                name="doa">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="form-group">
                                <label for="online-payment">
                                    <input type="radio" name="payment_method" value="online" id="online-payment"> Online
                                    Payment</label>
                            </div>
                            <div class="form-group">
                                <label for="offline-payment">
                                    <input type="radio" name="payment_method" value="offline" id="offline-payment"> Offline
                                    Payment</label>
                            </div>
                            <input type="hidden" name="type" value="<?php echo $_REQUEST['user'] ?>">
                            <button type="submit" name="submit" class="btn btn-primary"><span id="loader"
                                    style='display:none'><i class="fas fa-circle-notch fa-spin"></i></span> Register</button>
                        </form>
                    <?php } ?>

                </div>
            </div>
        <?php } else { ?>
            <!-- Info boxes -->
            <div class="card">
                <div class="card-header py-2">
                    <h3 class="card-title">
                        <?php echo ucfirst($_REQUEST['user']) ?>s
                    </h3>
                    <div class="card-tools">
                        <a href="?user=<?php echo $_REQUEST['user'] ?>&action=add-new" class="btn btn-success btn-sm"><i
                                class="fa fa-plus mr-2"></i>Add New</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive bg-white">
                        <table class="table table-bordered" id="users-table" width="100%">
                            <thead>
                                <tr>
                                    <th width="50">ID</th>
                                    <th>Name</th>
                                    <th>email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                $user_query = 'SELECT * FROM user_accounts WHERE user_type = "' . $_REQUEST['user'] . '"';
                                $user_result = mysqli_query($db_connection, $user_query);
                                while ($users = mysqli_fetch_object($user_result)) {
                                    ?>
                                    <tr>
                                        <td><?= $count++ ?></td>
                                        <td><?= $users->name ?></td>
                                        <td><?= $users->email ?></td>
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
    </div><!--/. container-fluid -->
</section>


<?php include('footer.php') ?>

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
