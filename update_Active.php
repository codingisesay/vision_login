<?php
include('database_connection.php');
include('functions.php');
$login_id = $_GET['login_id'];
$user_id = $_GET['user_id'];
if(isset($login_id)){

$q="UPDATE login_log
        SET session_status='inactive'
        WHERE login_id = '$login_id'";
		$run = mysqli_query($connect,$q);
if($run == true){
	page_redirect('index.php');
	mysqli_close($connect);
}
}elseif($user_id){
	
	$q="UPDATE login_log
        SET session_status='inactive'
        WHERE user_id = '$user_id'";
		$run = mysqli_query($connect,$q);
        if($run == true){
	    page_redirect('index.php');
		mysqli_close($connect);
}
	
	
}
?>