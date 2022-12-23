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
    <tr><th colspan='2'><h2>Create Faculty</h2></th></tr>
    <tr>
    <td>Insert Faculty</td>
    <td><input type='text' id='faculty'></td>
    </tr>
    <tr>
    <th colspan='2'><button class='insert_faculty'>Insert Faculty</button></th>
    </tr>
    </table>";
    echo $output;
	


?>