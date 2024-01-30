<?php
session_start();
include('../database_connection.php');
include('../testing/testing_functions.php');
if(!isset($_SESSION['admin_id'])){
	header('location:index.php');

}
	?>
	<?php 
	$batch_coordinator = trim(mysqli_real_escape_string($connect, $_POST['batch_coordinator']));

$query_insert_batch_coordinator = "INSERT INTO batch_coordinator (batch_coordinator_name) VALUES ('$batch_coordinator')";
$run_query_insert_batch_coordinator = mysqli_query($connect,$query_insert_batch_coordinator );
mysqli_close($connect);
if($run_query_insert_batch_coordinator){
	echo 1;
	

}else{
	echo 0;
	
}

?>