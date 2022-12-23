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
    <tr><th colspan='2'><h2>Create Tech Person</h2></th></tr>
    <tr>
    <td>Insert Tech Support Person</td>
    <td><input type='text' id='tech_person'></td>
    </tr>
    <tr>
    <th colspan='2'><button class='insert_tech_person'>Insert Tech Person</button></th>
    </tr>
    </table>";
    echo $output;



?>