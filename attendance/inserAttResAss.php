<?php
include('../session.php');
// session_start();
// include('../database_connection.php');
// include('../functions.php');
// $device_cookie=$_COOKIE['PHPSESSID'];
// $user_id=$_SESSION['id'];
// $row_of_specific_device = specific_device_from_login_log($device_cookie,$user_id);
// mysqli_num_rows($row_of_specific_device);
// $data = mysqli_fetch_assoc($row_of_specific_device);

// if(!isset($_SESSION['id']) || !isset($_COOKIE['PHPSESSID']) || $data['session_status'] == "inactive"){

//          page_redirect('../index.php');
// }
?>
<?php 
$atten = trim(mysqli_real_escape_string($connect,$_POST['atten']));
$response = trim(mysqli_real_escape_string($connect,$_POST['response']));
$assignment = trim(mysqli_real_escape_string($connect,$_POST['assignment']));
$chechlistId = trim($_POST['chechlistId']);
$userID = $_POST['userID'];

if($userID == 0){

   echo 0;

}else{

   $query = "INSERT INTO `attendance_assignment_record` ( `attendance`, `response`, `assignment`, `checklist_id`, `user_id`)
 VALUES ('$atten', '$response', '$assignment', '$chechlistId', '$userID')";
 $run_insert = mysqli_query($connect,$query);
 if($run_insert){

    echo "1";

 }

}




?>