<?php
session_start();
include('../database_connection.php');
include('../testing/testing_functions.php');
if(!isset($_SESSION['admin_id'])){
	header('location:index.php');

}
?>
<?php 
$checklist_id = trim($_GET['checklist_id']);
$query="DELETE FROM checklist_record WHERE checklist_id='$checklist_id'";
$run = mysqli_query($connect,$query);
if($run){?>
<script>
alert("Checklist Deleted!!");
location.replace("delete_checklist.php");
</script>
<?php

}else{?>
    <script>
    alert("Checklist Not Deleted!!");
    location.replace("admin_home.php");
    </script>
    <?php

}


?>