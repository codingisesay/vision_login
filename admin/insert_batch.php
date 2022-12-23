<?php
session_start();
include('../database_connection.php');
include('../testing/testing_functions.php');
if(!isset($_SESSION['admin_id'])){
	header('location:index.php');

}
	?>
	<?php 
	$batch = $_POST['batch'];
	$batch_code = $_POST['batch_code'];

$query_insert_batch = "INSERT INTO batch (batch_name,batch_year) VALUES ('$batch','$batch_code')";
$run_query_insert_batch = mysqli_query($connect,$query_insert_batch );
mysqli_close($connect);
if($run_query_insert_batch ){
	echo 1;
	

}else{
	echo 0;
	
}

?>