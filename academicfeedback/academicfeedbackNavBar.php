


<html>
		<head>
			<style>

			*{
				margin: 0px;
				padding: 0px;
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

			.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {background-color: #1c3961; color:white;}

.dropdown:hover .dropdown-content {
  display: block;
}

		</style>
		</head>
		<body>

			<div class="navigation">
				<div class="logo_img">
		<a href="../module_assign.php"><img src="image/logo.png" alt="logo" width="220" height="70"></a>
				</div>
				<div class="navbar_links">
		         <ul>
					 <li><a href="index.php">Home</a></li>
					<?php 
					$query = "SELECT * FROM user WHERE user_id = '$user_id'";
					$run = mysqli_query($connect,$query);
					$dataFordashboardPermission = mysqli_fetch_assoc($run);
					$dashboard = $dataFordashboardPermission['dashboard_permission'];
				
					// $dashboard = 1;
					if($dashboard == 1){?>
					
					<li class="dropdown" style="display:inline-block;">
					
					<?php

					}else{?>
					
					<li class="dropdown" style="display:none;">
					
					<?php

					}
					
					
					?>
					 <!-- <li class="dropdown" style="display:none;"> -->
                     <a href="javascript:void(0)" class="dropbtn">Dashboard</a>
                     <div class="dropdown-content">
                     <a href="dateWiseAcademicForm.php">Last Three Days</a>
                     <a href="summaryAcademicForm.php">Summary</a>
					 <a href="masterSheet.php">Master Sheet</a>
					
                     
    </div>
  </li>
		         	<li><a href="../logout.php">LogOut</a></li>
		         </ul>
				</div>
			</div>