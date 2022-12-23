<?php

session_start();
include('database_connection.php');
include('functions.php');
$device_cookie=$_COOKIE['PHPSESSID'];
$user_id=$_SESSION['id'];
$row_of_specific_device = specific_device_from_login_log($device_cookie,$user_id);
mysqli_num_rows($row_of_specific_device);
$data = mysqli_fetch_assoc($row_of_specific_device);
if(isset($_SESSION['id']) && $data['device_cookie'] == $device_cookie && $data['session_status'] == "active"){
	$q="UPDATE login_log
        SET session_status='inactive'
        WHERE device_cookie='$device_cookie' AND user_id = '$user_id'";
		$result = mysqli_query($connect,$q);
		if($result == true){
			session_unset();
				mysqli_close($connect);
			page_redirect('index.php');
		
		}
}elseif(isset($_SESSION['id']) && $data['device_cookie'] == $device_cookie && $data['session_status'] == "inactive"){
mysqli_close($connect);
	page_redirect('index.php');
	

}else if(!isset($_SESSION['id'])){
	$q="UPDATE login_log
        SET session_status='inactive'
        WHERE device_cookie='$device_cookie'"; //AND user_id = '$user_id'";
		$result = mysqli_query($connect,$q);
mysqli_close($connect);
	page_redirect('index.php');
	

}else{
mysqli_close($connect);
	page_redirect('index.php');
	

}


?>