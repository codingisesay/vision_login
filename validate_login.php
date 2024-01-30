<?php
session_start();
//include('database_connection.php');
include('database_connection.php');
error_reporting(0);
ini_set('session.cookie_lifetime', 2592000);
ini_set('session.gc_maxlifetime', 2592000);
include('functions.php');
include('library/UserInformation.php');
if(isset($_POST['submit']) & !empty($_POST['filed_username']) & !empty($_POST['filed_password'])){
	//data from user table
	$filed_username = mysqli_real_escape_string($connect,$_POST['filed_username']);
	 $filed_password=md5($_POST['filed_password']);
	 $q="SELECT user.user_id, user.user_name,user.user_mobile,user.user_mail_id,user.user_password,user.number_of_device_access
         FROM user
         WHERE user_mail_id='$filed_username' AND user_password ='$filed_password'";
	 $result=mysqli_query($connect,$q); 
	 $row=mysqli_num_rows($result);
	 $data=mysqli_fetch_assoc($result);
	 //$department_name = $data['department_name'];
	 $user_id=$data['user_id']; 
	 $number_of_device_access = $data['number_of_device_access'];
	 

	 
	 //data from login_log, Active Row
	 
	    $column_name="user_id";
		$active_row_from_login_log = active_row_from_login_log($column_name,$user_id);
		$active_row_from_login_log = mysqli_num_rows($active_row_from_login_log);
		
	//	data from login_log,
	    $cookie_name = "PHPSESSID";
	    $device_cookie=$_COOKIE['PHPSESSID'];
        $row_of_specific_device = specific_device_from_login_log($device_cookie,$user_id);
        mysqli_num_rows($row_of_specific_device);
        $data_specific_device = mysqli_fetch_assoc($row_of_specific_device);
		
	    if($row == 1 && !isset($_SESSION['id']) && isset($_COOKIE['PHPSESSID']) && $data_specific_device['session_status'] == "inactive"){
	      
		  if($number_of_device_access > $active_row_from_login_log){
		      setcookie($cookie_name,$device_cookie,time()+2592000);
			  session_start();
			  $_SESSION['id'] = $user_id;
              $q="UPDATE login_log
              SET session_status='active'
              WHERE device_cookie='$device_cookie' AND user_id = '$user_id'";
		      $result = mysqli_query($connect,$q);
			   mysqli_close($connect);
		      department_redirect();
			  
		 }else{
			 mysqli_close($connect);
			?>
		 <script>
		 alert('You have reached Maximum device Access');
	     location.replace("logedin_device.php?user_id=<?php echo $user_id; ?>");
		 </script>
		 <?php
		 
		 }
		 }elseif($row == 1 && isset($_SESSION['id']) && isset($_COOKIE['PHPSESSID']) && $data_specific_device['session_status'] == "inactive"){
	             if($number_of_device_access > $active_row_from_login_log){
					 setcookie($cookie_name,$device_cookie,time()+2592000);
			     $q="UPDATE login_log
                 SET session_status='active'
                 WHERE device_cookie='$device_cookie' AND user_id = '$user_id'";
		         $result = mysqli_query($connect,$q);
		         if($result == true){
					 mysqli_close($connect);
			department_redirect();
			 
		 }
				 }else{
					 mysqli_close($connect);
			?>
			
		 <script>
		 alert('You have reached Maximum device Access');
	     location.replace("logedin_device.php?user_id=<?php echo $user_id; ?>");
		 </script>
		 <?php
		 
		 
		}
	
        }elseif($row == 1){
		
		if($number_of_device_access > $active_row_from_login_log){
			ini_set('session.cookie_lifetime', 2592000);
			ini_set('session.gc_maxlifetime', 2592000);
		 session_start();
		 $_SESSION['id']=$user_id;
		 $device_cookie=$_COOKIE['PHPSESSID'];
		 $device_name = UserInfo::get_device();
		 $device_os =  UserInfo::get_os();
		 $device_browser = UserInfo::get_browser();
		 date_default_timezone_set('Asia/kolkata');
		 $time= date('d/m/Y')." ". date('h:i:sa');
		 $query="INSERT INTO login_log (device_name,device_cookie,device_os,device_browser,date_time_login,session_status,user_id)
		     VALUES ('$device_name','$device_cookie','$device_os','$device_browser','$time','active','$user_id')";
		 $res=mysqli_query($connect,$query);
		 //checking insert in log table
		 if($res == true){
			  mysqli_close($connect);
			department_redirect();
			
		 }
		}else{
			mysqli_close($connect);
			?>
			
		<script>
		 alert('You have reached Maximum device Access');
	     location.replace("logedin_device.php?user_id=<?php echo $user_id; ?>");
		 </script>
		 <?php
		 
		}
		 }else{
			 mysqli_close($connect);
		 ?>
		 <script>
		 alert('Username and Password Not Match');
	     location.replace("index.php");
		 </script>
		 <?php
		 
		 
}
}else{
	mysqli_close($connect);  
	?>
	<script>
	alert('Username and Password Both are Required');
	location.replace("index.php");
	</script>
	<?php
     
}

mysqli_close($connect);
?>