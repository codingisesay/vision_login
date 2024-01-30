<?php
session_start();
include('../database_connection.php');
include('../testing/testing_functions.php');
if(!isset($_SESSION['admin_id'])){
	header('location:index.php');

}
	?>
	<?php 
	$venue = trim(mysqli_real_escape_string($connect,$_POST['venue']));

$query_insert_venue = "INSERT INTO venues (venue_name) VALUES ('$venue')";
$run_query_insert_venue = mysqli_query($connect,$query_insert_venue);
mysqli_close($connect);
if($run_query_insert_venue){
	echo 1;
	

}else{
	echo 0;
	
}

?>