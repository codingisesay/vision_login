<?php
session_start();
include('../database_connection.php');
include('../testing/testing_functions.php');
if(!isset($_SESSION['admin_id'])){
	header('location:index.php');

}
	?>
	<?php 
	$tech_person =trim(mysqli_real_escape_string($connect,$_POST['tech_person']));

$query_insert_venue = "INSERT INTO tech_support_person (Name) VALUES ('$tech_person')";
$run_query_insert_venue = mysqli_query($connect,$query_insert_venue);
mysqli_close($connect);
if($run_query_insert_venue){
	echo 1;
	

}else{
	echo 0;
	
}

?>