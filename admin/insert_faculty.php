<?php
session_start();
include('../database_connection.php');
include('../testing/testing_functions.php');
if(!isset($_SESSION['admin_id'])){
	header('location:index.php');

}
	?>
	<?php 
	$faculty = trim(mysqli_real_escape_string($connect,$_POST['faculty']));

$query_insert_faculty = "INSERT INTO faculty (faculty_name) VALUES ('$faculty')";
$run_query_insert_faculty = mysqli_query($connect,$query_insert_faculty);
	mysqli_close($connect);
if($run_query_insert_faculty){
	echo 1;


}else{
	echo 0;
	
}

?>