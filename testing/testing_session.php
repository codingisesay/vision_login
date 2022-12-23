<?php
error_reporting(0);
ini_set('session.gc_maxlifetime', 2592000);
//ini_set('session.save_path', '/var/lib/php/sessions');
session_start();
include('../database_connection.php');
include('../functions.php');
$device_cookie=$_COOKIE['PHPSESSID'];
$user_id=$_SESSION['id'];
$row_of_specific_device = specific_device_from_login_log($device_cookie,$user_id);
mysqli_num_rows($row_of_specific_device);
$data = mysqli_fetch_assoc($row_of_specific_device);

if(!isset($_SESSION['id']) || !isset($_COOKIE['PHPSESSID']) || $data['session_status'] == "inactive"){

    $q="UPDATE login_log
        SET session_status='inactive'
        WHERE device_cookie='$device_cookie' OR user_id = '$user_id'";
        $result = mysqli_query($connect,$q);

         page_redirect('../index.php');
}
?>