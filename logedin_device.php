<?php 
include('database_connection.php');
include('functions.php');
$user_id = $_GET['user_id'];
$colunm = "user_id";
$result_from_login_log = active_row_from_login_log($colunm,$user_id);

$rows = mysqli_num_rows($result_from_login_log);
if($rows > 0){?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container">
<table class="table table-bordered">
<thead>
        
        <th>Device Name</th>
        <th>Device OS</th>
        <th>Device Browser</th>
        <th>Session Status</th>
        <th>Log Out</th>
        </thead>

 <?php

for($i=0; $i < $rows; $i++){
$data=mysqli_fetch_assoc($result_from_login_log);
?>

<tbody>
<tr>
<td><?php echo $data['device_name']; ?></td>
<td><?php echo $data['device_os']; ?></td>
<td><?php echo $data['device_browser']; ?></td>
<td><?php echo $data['session_status']; ?></td>
<td><a href='update_Active.php?login_id=<?php echo $data['login_id']; ?>'>Log Out</a></td>
<td><a href='update_Active.php?user_id=<?php echo $user_id; ?>'>Log Out In All Devices</a></td>
<?php } ?>
</tr>
</tbody>
<?php } ?>
<?php mysqli_close($connect); ?>
</table>
</div>
</body>
