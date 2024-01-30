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
    <tr><th colspan='2'><h2>Create Batch Coordinator</h2></th></tr>
    <tr>
    <td>Insert Batch Coordinator</td>
    <td><input type='text' id='batch_coordinator' placeholder='Name-1228'></td>
    </tr>
    <tr>
    <th colspan='2'><button class='insert_batch_coordinator'>Insert Batch Coordinator</button></th>
    </tr>
    </table>";
    echo $output;
	


?>