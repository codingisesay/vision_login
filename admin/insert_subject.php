<?php
session_start();
include('../database_connection.php');
include('../testing/testing_functions.php');
if(!isset($_SESSION['admin_id'])){
	header('location:index.php');

}
	?>
	<?php 
	$subject = trim(mysqli_real_escape_string($connect,$_POST['subject']));

$query_insert_subject = "INSERT INTO 	subjects (subject_name) VALUES ('$subject')";
$run_query_insert_subject = mysqli_query($connect,$query_insert_subject);
mysqli_close($connect);
if($run_query_insert_subject){
	echo 1;
	

}else{
	echo 0;
	
}

?>