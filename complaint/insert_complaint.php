<?php 
session_start();
include('../database_connection.php');
include('../functions.php');
$device_cookie=$_COOKIE['PHPSESSID'];
$user_id=$_SESSION['id'];
$row_of_specific_device = specific_device_from_login_log($device_cookie,$user_id);
mysqli_num_rows($row_of_specific_device);
$data = mysqli_fetch_assoc($row_of_specific_device);

if(!isset($_SESSION['id']) || !isset($_COOKIE['PHPSESSID']) || $data['session_status'] == "inactive"){

         page_redirect('../index.php');
}
?>
<?php
//include('../database_connection.php');
$student_reg = mysqli_real_escape_string($connect,$_POST['student_reg']);
$complaint_txt = mysqli_real_escape_string($connect,$_POST['complaint_txt']);
$mode_of_complaint = mysqli_real_escape_string($connect,$_POST['mode_of_complaint']);
$datetime  = mysqli_real_escape_string($connect,$_POST['datetime']);
$complain_cat = mysqli_real_escape_string($connect,$_POST['complain_cat']);
$somplaint_sub_cat = mysqli_real_escape_string($connect,$_POST['somplaint_sub_cat']);
$resolution = mysqli_real_escape_string($connect,$_POST['resolution']);
$issue_at_end = mysqli_real_escape_string($connect,$_POST['issue_at_end']);
$status_of_complaint = mysqli_real_escape_string($connect,$_POST['status_of_complaint']);
//$curent_date = date('Y-m-d');
date_default_timezone_set("Asia/Calcutta");
$current_date = date("Y-m-d H:i:s");

$user_id = $_SESSION['id'];

if($user_id == 0){

    // page_redirect('../index.php');
    echo "0";

}else{

    $query = "INSERT INTO `complaint_record` (`complaint_record_id`, `student_reg_no`, `complain_text`, `mode_of_complaint`,`complaint_received`, `complaint_category`, `complaint_sub_category`, `resolution`, `issue_at`, `status`,`currentdate`, `updated_by`) VALUES (NULL, '$student_reg', '$complaint_txt', '$mode_of_complaint', '$datetime', '$complain_cat', '$somplaint_sub_cat', '$resolution', '$issue_at_end', '$status_of_complaint','$current_date', '$user_id')";

    $run = mysqli_query($connect,$query);
    
    if($run){
    
        echo "1";
    
    }

}



?>


