


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
		         	<li><a href="monitor.php">Monitor</a></li>
		         	<li><a href="generate_report.php">Generate Report</a></li>
		         	<li><a href="view_checklist.php">View</a></li>
		         	<li><a href="../logout.php">LogOut</a></li>
		         </ul>
				</div>
			</div>