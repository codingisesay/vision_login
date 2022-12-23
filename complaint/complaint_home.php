<?php
session_start();
include('../database_connection.php');
include('../functions.php');
$device_cookie=$_COOKIE['PHPSESSID'];
$user_id=$_SESSION['id'];
$row_of_specific_device = specific_device_from_login_log($device_cookie,$user_id);
mysqli_num_rows($row_of_specific_device);
$data = mysqli_fetch_assoc($row_of_specific_device);

if(!isset($_SESSION['id']) || !isset($_COOKIE['PHPSESSID']) || $data['session_status'] == "inactive"){

         page_redirect('../index.php');
}
?>

<html>
<head>
</head>
<body>
<h1>Hello Complaint</h1>
<?php
echo $_SESSION['id']."<br>";
echo $_COOKIE['PHPSESSID']."<br>";
?>
<a href="../logout.php">Logout</a>
</body>
</html>