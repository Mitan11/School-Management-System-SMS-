<?php include('../includes/config.php') ?>
<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Student Fee Details</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Student Fee</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <?php
        // $std_id = isset($_GET['std_id']) ? $_GET['std_id'] : '';
        $usermeta = get_user_metadata($std_id);
        ?>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Student Detail
                </h3>
            </div>
            <div class="card-body">
                <strong>Name : </strong><?php print_r(get_users(array('id' => $std_id))[0]->name); ?>
                <br><strong>Class : </strong><?php echo $usermeta['class']; ?>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Tution Fee
                </h3>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Month</th>
                            <th>Fee Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $months = array('January', 'Fabruary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
                        foreach ($months as $key => $month) {
                            $highlight = '';
                            if (date('F') == ucwords($month)) {
                                $highlight = 'class="bg-success"';
                            }

                            ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td <?= $highlight ?>> <?php echo ucwords($month) ?></td>
                                <td></td>
                                <td>
                                    <a href="?action=pay&month=<?php echo $month ?>&std_id=<?php echo $std_id ?>"
                                        class="btn btn-sm btn-primary">
                                        <i class="fa fa-eye fa-fw"></i> View
                                    </a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#paynow-popup" data-month="<?php echo ucwords($month) ?>"
                                        class="btn btn-sm btn-warning paynow-btn">
                                        <i class="fa fa-money-check-alt fa-fw"></i> Pay Now
                                    </a>
                                    <a href="?action=pay&month=<?php echo $month ?>&std_id=<?php echo $std_id ?>"
                                        class="btn btn-sm btn-secondary">
                                        <i class="fa fa-envelope fa-fw"></i> Send Message
                                    </a>
                                    <a href="?action=pay&month=<?php echo $month ?>&std_id=<?php echo $std_id ?>"
                                        class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash fa-fw"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php
$MERCHANT_KEY = 'awUp7zBb'; // PROVIDED BY PAYU
$SALT = 'T4meBzglbm'; // PROVIDED BY PAYU

$PAY_BASE_URL = "https://test.payu.in"; // PayU test environment
// $PAY_BASE_URL = "https://secure.payu.in"; // Uncomment for the production environment

$action = '';
$posted = array();

// Capture the POST data
if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        $posted[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}

$formError = 0;

// Generate transaction ID if not present
if (empty($posted['txnid'])) {
    $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
    $txnid = $posted['txnid'];
}

// Hash calculation
$hash = '';
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if (empty($posted['hash']) && sizeof($posted) > 0) {
    if (
        empty($posted['key']) ||
        empty($posted['txnid']) ||
        empty($posted['amount']) ||
        empty($posted['firstname']) ||
        empty($posted['email']) ||
        empty($posted['phone']) ||
        empty($posted['productinfo']) ||
        empty($posted['surl']) ||
        empty($posted['furl']) ||
        empty($posted['service_provider'])
    ) {
        $formError = 1;
    } else {
        $hashVarSeq = explode('|', $hashSequence);
        $hash_string = '';
        foreach ($hashVarSeq as $hash_var) {
            $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
            $hash_string .= '|';
        }
        $hash_string .= $SALT;
        $hash = strtolower(hash('sha512', $hash_string));
        $action = $PAY_BASE_URL . '/_payment';
    }
} elseif (!empty($posted['hash'])) { 
    $hash = $posted['hash'];
    $action = $PAY_BASE_URL . '/_payment';
}

?>

<div class="modal fade" id="paynow-popup" tabindex="-1" aria-labelledby="paynow-popupLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="paynow-popupLabel">Paynow</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo $action ?>" method="post" name="payuForm">
                    <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>">
                    <input type="hidden" name="hash" value="<?php echo $hash ?>">
                    <input type="hidden" name="txnid" value="<?php echo $txnid ?>">
                    <input type="hidden" name="amount" value="500">
                    <input type="hidden" name="surl" value="http://localhost/School-Management-System%20-%20Copy/Action/success.php" size="64">
                    <input type="hidden" name="furl" value="http://localhost/School-Management-System%20-%20Copy/Action/failure.php" size="64">
                    <input type="hidden" name="service_provider" value="payu_paisa" size="64">
                    <input type="hidden" name="productinfo" value="Fee Payment" size="64">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Full Name</label>
                                <input type="text" class="form-control" readonly name="firstname"
                                    value="<?php echo $student->name ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" readonly name="email"
                                    value="<?php echo $student->email ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Mobile</label>
                                <input type="text" class="form-control" readonly name="phone" value="7986541230">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Month</label>
                                <input type="text" class="form-control" id="month" readonly name="month" value="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Amount&nbsp;</label>
                                <i class="fa fa-rupee-sign"></i>500.00
                            </div>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-success">Confirm & pay</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script>

    $(document).on('click','.paynow-btn',function () {
        var month = jQuery(this).data('month');
        jQuery('#month').val(month);
    });

</script>

<script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm(){
        if(hash == ''){
            return
        }else{
            var payuForm =document.forms.payuForm;
            payuForm.submit();
        }
    }
</script>

<?php include('footer.php'); ?>