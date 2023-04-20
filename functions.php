<?php
//include('database_connection.php');

function page_redirect($page_name){
	header("location:$page_name");
}

function active_row_from_login_log($colunm,$value){
	include('database_connection.php');
	$q="SELECT * FROM login_log WHERE $colunm='$value' AND session_status='active'";
	return $result_from_login_log=mysqli_query($connect,$q);
	mysqli_close($connect);

}
function specific_device_from_login_log($device_cookie,$user_id){
	include('database_connection.php');
	$q="SELECT * FROM login_log WHERE device_cookie='$device_cookie' AND user_id='$user_id'";
	return $specific_device_from_login_log = mysqli_query($connect,$q);
	mysqli_close($connect);
}
function department_redirect(){

	header("location:module_assign.php");

	
}

function data_from_user($user){
	include('database_connection.php');
	$q="SELECT * FROM user WHERE user_id = $user";
	return $data_from_user_table = mysqli_query($connect,$q);
	mysqli_close($connect);

}

?>