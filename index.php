  <?php
error_reporting(0);
ini_set('session.cookie_lifetime', 2592000);
ini_set('session.gc_maxlifetime', 2592000);
//ini_set('session.save_path', '/var/lib/php/sessions');
session_start();
include('database_connection.php');
include('functions.php');
$cookie_name = "PHPSESSID";
$device_cookie=$_COOKIE['PHPSESSID'];
$user_id=$_SESSION['id'];
$row_of_specific_device = specific_device_from_login_log($device_cookie,$user_id);
mysqli_num_rows($row_of_specific_device);
$data = mysqli_fetch_assoc($row_of_specific_device);

if(isset($_SESSION['id']) && isset($_COOKIE['PHPSESSID']) && $data['session_status'] == "active"){
setcookie($cookie_name,$device_cookie,time()+2592000);
$q="SELECT user.user_id, user.user_name,user.user_mobile,user.user_mail_id,user.user_password,user.number_of_device_access,department.department_name
         FROM user
         INNER JOIN department
         ON user.department_id = department.department_id
         WHERE user.user_id = '$user_id'";
	     $result=mysqli_query($connect,$q); 
	     $row=mysqli_num_rows($result);
	     $data=mysqli_fetch_assoc($result);
	     $department_name = $data['department_name'];
		  mysqli_close($connect);
         department_redirect($department_name);
		

}
mysqli_close($connect);
			




?>
<html>
<head>
<title>login page</title>
<link rel="stylesheet" href="css/index.css">
<!--<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500&family=Pushster&family=Raleway:ital,wght@1,700&display=swap" rel="stylesheet">-->
</head>
<body>
<div class="bgimg">
<div class="centerdiv">
<img src="image/vision_logo-removebg-preview.png" id="profilepic">
<h2 style="font-family: Arial, Helvetica, sans-serif;">user login</h2>
<form method="POST" action="validate_login.php">
<div>
<input type="text" name="filed_username" class="inputbox" placeholder="Username">
</div>
<br>
<div>
<input type="password" name="filed_password" class="inputbox" placeholder="Password">
</div>
<br>
<div>
<button type="submit" name="submit">LogIn</button>
</div>
</form><br>
<div class="forgot-section">
<h4>Forgot Password?</h4>
</div>
</div>
</div>
</body>
</html>