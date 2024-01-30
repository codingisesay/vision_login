<?php
session_start();
include('../database_connection.php');
include('../testing/testing_functions.php');
if(!isset($_SESSION['admin_id'])){
	header('location:index.php');

}
	?>
	<?php 
	$batch = trim(mysqli_real_escape_string($connect,$_POST['batch']));
	$batch_code = trim(mysqli_real_escape_string($connect,$_POST['batch_code']));
	$batchSCode = trim(mysqli_real_escape_string($connect,$_POST['batchSCode']));
	$batchTime = trim(mysqli_real_escape_string($connect,$_POST['batchTime']));
	$batch_year = trim(mysqli_real_escape_string($connect,$_POST['batch_year']));
	$offline_student = trim(mysqli_real_escape_string($connect,$_POST['offline_student']));
	$online_student = trim(mysqli_real_escape_string($connect,$_POST['online_student']));
	

$query_insert_batch = "INSERT INTO batch (batch_name,batch_code,batch_short_name,batch_timing,batch_year,offline_students,online_student) VALUES ('$batch','$batch_code','$batchSCode','$batchTime','$batch_year','$offline_student','$online_student')";
$run_query_insert_batch = mysqli_query($connect,$query_insert_batch );
mysqli_close($connect);
if($run_query_insert_batch ){
	echo 1;
	

}else{
	echo 0;
	
}

?>