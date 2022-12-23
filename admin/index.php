<?php
session_start();

include('../testing/testing_functions.php');
if(isset($_SESSION['admin_id'])){
		
	header('location:admin_home.php');


}

	?>

<html>
<head>
	<style>
	*{
	margin:0px;
	padding:0px;
	font-family: Arial, Helvetica, sans-serif;
}
.bgimg{
	width:100%;
	height:100vh;
	background-image:linear-gradient(27deg,#1c3961 50%, white 50%);
	
}
.centerdiv{
	width:350px;
	height:400px;
	position:absolute;
	top:50%;
	left:50%;
	transform:translate(-50%, -50%);
	background-image:linear-gradient(27deg, white 50%, #1c3961 50%);
	box-shadow:0 1px 10px white, 0 1px 10px black;
}
#profilepic{
	width:130px;
	height:130px;
	border-radius:60%;
	position:relative;
	top:-70px;
	left:calc((350px - 120px)/2);

}
h2{
	text-align:center;
	text-transform:uppercase;
	font-size:2em;
	word-spacing:2px;
	position: relative;
	top:-50px;
	bottom:50px;
	text-shadow:-2px 1px 1px black;
	color: white;
}
.inputbox{
	width:calc(100% - 40px);
	height:30px;
	display:block;
	margin:auto;
	padding:0 10px;
	box-sizing:border-box;
	border: 1px solid black;
}
::placeholder{
	letter-spacing:2px;
	color:black;
}
button{
	width:calc(100% - 40px);
	height:30px;
	display:block;
	margin:auto;
	background-color:#1c3961;
	color: white;
	border:none;
	font-weight:bold;
	cursor: pointer;
	
}
.forgot-section{
	width:calc(100% - 40px);
	line-height:30px;
	display:block;
	margin:auto;
	color:white;
	background-color:#1c3961;
	font-size:0.8em;
	text-align:right;
	padding-right:20px;
	box-sizing:border-box;
	cursor: pointer;
}
</style>

<title>Admin login</title>
<!--<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500&family=Pushster&family=Raleway:ital,wght@1,700&display=swap" rel="stylesheet">-->
</head>
<body>
<div class="bgimg">
<div class="centerdiv">
<img src="../image/vision_logo-removebg-preview.png" id="profilepic">
<h2 style="font-family: Arial, Helvetica, sans-serif;">Admin Login</h2>
<form method="POST" action="admin_login.php">
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