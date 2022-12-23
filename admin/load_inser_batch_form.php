<?php
session_start();

include('../testing/testing_functions.php');
if(!isset($_SESSION['admin_id'])){
	header('location:index.php');

}
	?>
	<?php
	$output = "";

	$output = "<table>
    <tr><th colspan='2'><h2>Create Batch</h2></th></tr>
    <tr>
    <td>Insert Batch</td>
    <td><input type='text' id='batch'></td>
    </tr>
    <tr>
    <td>Batch Year</td>
    <td><input type='number' id='batch_code'></td>
    </tr>
    <tr>
    <th colspan='2'><button class='insert_batch'>Insert Batch</button></th>
    </tr>
    </table>";
    echo $output;
	


?>