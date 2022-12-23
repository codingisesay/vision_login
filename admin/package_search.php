<?php
include('../database_connection.php');

$search_term = $_POST['search_batch'];

$sql = "SELECT batch_name FROM batch WHERE batch_name LIKE '%{$search_term}%'";
$result = mysqli_query($connect, $sql) or die("SQL Query Failed.");

$output = "<select>";

	if(mysqli_num_rows($result) > 0){  
		while($row = mysqli_fetch_assoc($result)){
			$output .= "<option>{$row['batch_name']}</option>";
		}
  }else{  
  	$output .= "<option>Batch Not Found</option>";
  } 
$output .= "</select>";

echo $output;







	?>