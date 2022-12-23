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
    <tr><th colspan='2'><h2>Create Internet Line</h2></th></tr>
    <tr>
    <td>Insert Internet Line</td>
    <td><input type='text' id='Internet_line'></td>
    </tr>
    <tr>
    <th colspan='2'><button class='insert_internet_btn'>Insert Internet Line</button></th>
    </tr>
    </table>";
    echo $output;
	

?>