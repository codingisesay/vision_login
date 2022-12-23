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
    <tr><th colspan='2'><h2>Create Camera Mam</h2></th></tr>
    <tr>
    <td>Insert Camera Man</td>
    <td><input type='text' id='camera_man'></td>
    </tr>
    <tr>
    <th colspan='2'><button class='insert_camera_man'>Insert Camera Man</button></th>
    </tr>
    </table>";
    echo $output;
	


?>