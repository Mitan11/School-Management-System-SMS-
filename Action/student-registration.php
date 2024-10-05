<?php
include('../includes/config.php');

if (isset($_POST['type']) && $_POST['type'] == 'student' && isset($_POST['email']) && !empty($_POST['email'])) {

    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $dob = isset($_POST['dob']) ? $_POST['dob'] : '';
    $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $country = isset($_POST['country']) ? $_POST['country'] : '';
    $state = isset($_POST['state']) ? $_POST['state'] : '';
    $zip = isset($_POST['zip']) ? $_POST['zip'] : '';
    $password = date('dmY', strtotime($dob));
    $md_password = md5($password);

    $father_name = isset($_POST['father_name']) ? $_POST['father_name'] : '';
    $father_mobile = isset($_POST['father_mobile']) ? $_POST['father_mobile'] : '';
    $mother_name = isset($_POST['mother_name']) ? $_POST['mother_name'] : '';
    $mother_mobile = isset($_POST['mother_mobile']) ? $_POST['mother_mobile'] : '';
    $parents_address = isset($_POST['parents_address']) ? $_POST['parents_address'] : '';
    $parents_country = isset($_POST['parents_country']) ? $_POST['parents_country'] : '';
    $parents_state = isset($_POST['parents_state']) ? $_POST['parents_state'] : '';
    $parents_zip = isset($_POST['parents_zip']) ? $_POST['parents_zip'] : '';

    $school_name = isset($_POST['school_name']) ? $_POST['school_name'] : '';
    $previous_class = isset($_POST['previous_class']) ? $_POST['previous_class'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    $total_marks = isset($_POST['total_marks']) ? $_POST['total_marks'] : '';
    $obtain_mark = isset($_POST['obtain_mark']) ? $_POST['obtain_mark'] : '';
    $previous_percentage = isset($_POST['previous_percentage']) ? $_POST['previous_percentage'] : '';

    $class = isset($_POST['class']) ? $_POST['class'] : '';
    $section = isset($_POST['section']) ? $_POST['section'] : '';
    $subject_streem = isset($_POST['subject_streem']) ? $_POST['subject_streem'] : '';
    $doa = isset($_POST['doa']) ? $_POST['doa'] : '';
    $type = isset($_POST['type']) ? $_POST['type'] : '';
    $date_add = date('Y-m-d');

    $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';

    $user_id = "";
    $check_query = mysqli_query($db_connection, "SELECT * FROM user_accounts WHERE email = '$email'");
    if (mysqli_num_rows($check_query) > 0) {
        $error = 'Email already exists';
        echo "Email already exists";
    } else {
        $query = mysqli_query($db_connection, "INSERT INTO user_accounts (`name`,`email`,`password`,`user_type`) VALUES ('$name','$email','$md_password','$type')") or die(mysqli_error($db_connection));
        if ($query) {
            $user_id = mysqli_insert_id($db_connection);
        }
    }

    $usermeta = array(
        'dob' => $dob,
        'mobile' => $mobile,
        'payment_method' => $payment_method,
        'class' => $class,
        'address' => $address,
        'country' => $country,
        'state' => $state,
        'zip' => $zip,
        'father_name' => $father_name,
        'father_mobile' => $father_mobile,
        'mother_name' => $mother_name,
        'mother_mobile' => $mother_mobile,
        'parents_address' => $parents_address,
        'parents_country' => $parents_country,
        'parents_state' => $parents_state,
        'parents_zip' => $parents_zip,
        'school_name' => $school_name,
        'previous_class' => $previous_class,
        'status' => $status,
        'total_marks' => $total_marks,
        'obtain_mark' => $obtain_mark,
        'previous_percentage' => $previous_percentage,
        'section' => $section,
        'subject_streem' => $subject_streem,
        'doa' => $doa,
    );

    foreach ($usermeta as $key => $value) {
        mysqli_query($db_connection, "INSERT INTO usermeta (`user_id`,`meta_key`,`meta_value`) VALUES ('$user_id','$key','$value')") or die(mysqli_error($db_connection));
    }

    $response = array(
        'success'=>true,
        'payment_method'=>$payment_method,
        'std_id'=>$user_id,
    );
    $_SESSION['toastMessage'] = 'Student has been succefuly registered';
    header('location: ../Admin/user-accounts.php?user=' . $type);
}

?>