<?php
session_start();
include('../database_connection.php');
include('../testing/testing_functions.php');
if(!isset($_SESSION['admin_id'])){
	header('location:index.php');

}
	?>
	<?php 
	$Internet_line = trim(mysqli_real_escape_string($connect,$_POST['Internet_line']));

$query_insert_internet_line = "INSERT INTO internet_line (internet_name) VALUES ('$Internet_line')";
$run_query_insert_internet_line = mysqli_query($connect,$query_insert_internet_line);
mysqli_close($connect);
if($run_query_insert_internet_line){
	echo 1;
	

}else{
	echo 0;

}

?>