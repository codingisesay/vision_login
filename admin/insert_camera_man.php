<?php
session_start();
include('../database_connection.php');
include('../testing/testing_functions.php');
if(!isset($_SESSION['admin_id'])){
	header('location:index.php');

}
	?>
	<?php 
	$camera_man = trim(mysqli_real_escape_string($connect,$_POST['camera_man']));

$query_insert_camera_man = "INSERT INTO camera_man (camera_man_name) VALUES ('$camera_man')";
$run_query_insert_camera_man = mysqli_query($connect,$query_insert_camera_man);
mysqli_close($connect);
if($run_query_insert_camera_man){
	echo 1;
	

}else{
	echo 0;
	
}

?>