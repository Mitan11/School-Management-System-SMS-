<?php include('../includes/config.php') ?>
<?php

if(isset($_POST['class_id']) && $_POST['class_id']){
    
    $class_id = $_POST['class_id'];
    $class_meta = get_metadata($class_id,'section');
    $output[] = '<option value="" selected disabled>--Select Section--</option>';
    foreach($class_meta as $meta){
        $section = get_post(array('id'=>$meta->meta_value));
        $output[] = '<option value="'.$section->id.'">'.$section->title.'</option>';
    }
    echo json_encode($output);
die;
}


?>