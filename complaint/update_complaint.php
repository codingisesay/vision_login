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
$complaint_id = mysqli_real_escape_string($connect,$_POST['complaint_id']);
$complaint_txt = mysqli_real_escape_string($connect,$_POST['complaint_txt']);
$mode_of_complaint = mysqli_real_escape_string($connect,$_POST['mode_of_complaint']);
$datetime  = mysqli_real_escape_string($connect,$_POST['datetime']);
$complain_cat = mysqli_real_escape_string($connect,$_POST['complain_cat']);
$somplaint_sub_cat = mysqli_real_escape_string($connect,$_POST['somplaint_sub_cat']);
$resolution = mysqli_real_escape_string($connect,$_POST['resolution']);
$issue_at_end = mysqli_real_escape_string($connect,$_POST['issue_at_end']);
$status_of_complaint = mysqli_real_escape_string($connect,$_POST['status_of_complaint']);
date_default_timezone_set("Asia/Calcutta");
$current_date = date("Y-m-d H:i:s");

$user_id = $_SESSION['id'];

$query = "UPDATE complaint_record
SET student_reg_no = '$student_reg', complain_text= '$complaint_txt', mode_of_complaint = '$mode_of_complaint', complaint_received = '$datetime',
complaint_category = '$complain_cat', complaint_sub_category = '$somplaint_sub_cat', resolution = '$resolution', issue_at = '$issue_at_end', status = '$status_of_complaint', currentdate = '$current_date', updated_by = '$user_id'
WHERE complaint_record_id = '$complaint_id'";

$run = mysqli_query($connect,$query);
if($run){

    echo "1";

}


?>