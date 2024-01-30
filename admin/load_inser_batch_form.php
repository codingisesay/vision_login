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
    <td><input type='text' id='batch' placeholder='4040_RB1_2021_ENG/HIN'></td>
    </tr>
    <tr>
    <td>Batch code</td>
    <td><input type='number' id='batch_code' placeholder='4040'></td>
    </tr>
    <tr>
    <td>Batch Short Code</td>
    <td><input type='text' id='batchSCode' placeholder='2022_RB1/HRB1'></td>
    </tr>
    <tr>
    <td>Batch Timing</td>
    <td><select id='batchTime'>
    <option>09 am - 12 pm</option>
    <option>01 pm - 04 pm</option>
    <option>05 pm - 08 pm</option>
    </select></td>
    </tr>
    <tr>
    <td>Batch Year</td>
    <td><input type='number' id='batch_year' placeholder='Enter Year Of Batch'></td>
    </tr>
    <tr>
    <td>Offline Students</td>
    <td><input type='number' id='offline_student' placeholder='120'></td>
    </tr>
    <tr>
    <td>Online Students</td>
    <td><input type='number' id='online_student' placeholder='120'></td>
    </tr>
    <tr>
    <th colspan='2'><button class='insert_batch'>Insert Batch</button></th>
    </tr>
    </table>";
    echo $output;
	


?>