<?php
session_start();
include('database_connection.php');
include('functions.php');
$device_cookie=$_COOKIE['PHPSESSID'];
$user_id=$_SESSION['id'];
$row_of_specific_device = specific_device_from_login_log($device_cookie,$user_id);
mysqli_num_rows($row_of_specific_device);
$data = mysqli_fetch_assoc($row_of_specific_device);

if(!isset($_SESSION['id']) || !isset($_COOKIE['PHPSESSID']) || $data['session_status'] == "inactive"){

         page_redirect('index.php');
		 mysqli_close($connect);
}
?>

<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>

*{
    margin: 0px;
    padding: 0px;
    
}
body{
    background-color: rgba(0,0,0,0.1);
}
.navigation{
    
    background-color: #1c3961;
    display: flex;
    align-items: center;
    justify-content: space-between;

}
.logo_img{

}


.navbar_links> ul{
  list-style-type: none;
  position: relative;
  right: 30px;




}
.navbar_links> ul >li{
  display: inline-block;
margin: 10px;
padding: 10px;
}

.navbar_links> ul >li>a{
  text-decoration: none;
color: white;
font-size: 18px;
font-weight: bold;
font-family: "Trirong", serif;

}
.outer_module_assign_div{
    border:1px solid black;
     height:200px;
      margin:10px;
       background-color:white;
        padding:0px;
        text-align: center;
       
}
.outer_module_assign_div,p{
    font-weight: bolder;
    letter-spacing: 2px;
    position: relative;
    top: 30%;
}
.inner_module_assign_div{
    border:1px solid black;
     height:50px;
      background-color:#1c3961;
       display: flex;
       justify-content: center;
       align-items: center;
        text-align:center;
         position:relative;
          top:60%;
          
}
.inner_module_assign_div, a{
    color: white;
    
}

</style>
</head>
<body>

<div class="navigation">
				<div class="logo_img">
		<img src="image/logo 2.png" alt="logo" width="220" height="70">
				</div>
				<div class="navbar_links">
		         <ul>
		         	<li><a href="logout.php">LogOut</a></li>
		         </ul>
				</div>
			</div>
    
<?php
$query = "SELECT department.department_name FROM module_assign LEFT JOIN department on department.department_id = module_assign.department WHERE user = '$user_id'";
$run = mysqli_query($connect,$query);
$raw = mysqli_num_rows($run);
while($data = mysqli_fetch_assoc($run)){
    $module_ass[] = array("Departmemt name" =>$data['department_name']);
}
$module_assign_count = count($module_ass);
for($i = 0; $i < $module_assign_count; $i++){?>
        <div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 outer_module_assign_div"><p><?php echo ucfirst($module_ass[$i]['Departmemt name']); ?></p><a href="<?php echo $module_ass[$i]['Departmemt name'];?>"><div class="col-sm-12 inner_module_assign_div"><?php $deprt = $module_ass[$i]['Departmemt name'];
    echo ucfirst($deprt);
    ?></div></a>
</div>

<?php



}

?>
</div>
</div>

</body>
</html>
