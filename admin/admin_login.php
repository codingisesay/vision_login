<?php
include('../database_connection.php');
if(isset($_POST['submit'])){
$user_name = mysqli_real_escape_string($connect,$_POST['filed_username']);
$user_password = md5($_POST['filed_password']);
$q = "SELECT * FROM admin WHERE admin_name = '$user_name' AND admin_password = '$user_password'";
$run = mysqli_query($connect,$q);
$rows = mysqli_num_rows($run);
mysqli_close($connect);

if($rows > 0){
	$data = mysqli_fetch_assoc($run);
	session_start();
	$_SESSION['admin_id'] = $data['admin_id'];
	header("location:admin_home.php");

}else{
	?>
	
	<script>
	alert("Username and Password not Match");
	location.replace("index.php");
	</script>
	
	<?php
}


}

	?>