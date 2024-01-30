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
$atten = $_POST['atten'];
$response = $_POST['response'];
$assignment = $_POST['assignment'];
$chechlistId = $_POST['chechlistId'];
$userID = $_POST['userID'];

$query = "UPDATE attendance_assignment_record
SET attendance = '$atten', response= '$response', assignment = '$assignment', user_id = '$userID'
WHERE checklist_id = '$chechlistId'";
 $run_insert = mysqli_query($connect,$query);
 if($run_insert){

    echo "1";

 }else{
    echo "0";
 }


?>