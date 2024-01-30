<?php
session_start();
include('../database_connection.php');
include('../testing/testing_functions.php');
if(!isset($_SESSION['admin_id'])){
	header('location:index.php');

}
	?>
<?php 
$output = "";
$output = '<table>
<tr><th colspan="2"><h2>Create Checklist</h2></th></tr>
<tr>
<td>Date</td>
<td><input type="date" id="class_date"></td>
</tr>
<tr onclick="display_disscussion();">
<td>Checklist Type</td>
<td><select id="select_checklist_type">
<option value="">Select Any One</option>
<option value="Class">Class</option>
<option value="Discussion">Discussion</option>
</select</td>
</tr>
<tr>
			<td id="classid"><label>Class ID</label></td>
			<td><input type="number" id="class_id" ></br></td>
		</tr>
		<tr>
			<td><label>Testing Member</label></td>
			<td><select id="testing_mamber" required>
				<option value="">Select Any One</option>';
				$query = "Select * FROM user WHERE user_role = '1' ORDER BY user_name ASC";
                $run = mysqli_query($connect,$query);
                $rows = mysqli_num_rows($run);
                while($data = mysqli_fetch_assoc($run)){
                	$output.="<option value={$data["user_id"]}>{$data["user_name"]}</option>";

                }

           $output.='</select></td>
           
           </tr>

		   <tr>
			<td><label>Monitor By</label></td>
			<td><select id="monitor_mamber" required>
				<option value="">Select Any One</option>';
				$query = "Select * FROM user WHERE user_role = '1' ORDER BY user_name ASC";
                $run = mysqli_query($connect,$query);
                $rows = mysqli_num_rows($run);
                while($data = mysqli_fetch_assoc($run)){
                	$output.="<option value={$data["user_id"]}>{$data["user_name"]}</option>";

                }

           $output.='</select></td>
           
           </tr>
		   
           <tr>
           <td id="batch_name"><label>Batch</label></td>
           <td id="select_batch_td"><select id="select_batch" multiple style="width:600px;">';
           $query_batch="SELECT * FROM batch";
           $run_batch = mysqli_query($connect,$query_batch);
           while($data_batch = mysqli_fetch_assoc($run_batch)){
           	$output.="<option>{$data_batch["batch_name"]}</option>";
           }

           $output.='</select>

           <td id="test_code_name" style="display:none;"><input type="text" id="input_test_code_name">
           </td>
           
           
           
           </tr>
           	<tr>
			<td><label>Time Slot</label></td>
			<td><select id="select_time_slot" >
				<option value="">Select And One</option>
				<option value="09 am - 12 pm">09 am - 12 pm</option>
				<option value="01 pm - 04 pm">01 pm - 04 pm</option>
				<option value="05 pm - 08 pm">05 pm - 08 pm</option>
			</select></br></td>
		</tr>
		<tr>
			<td><label>Venue</label></td>
			
			<td><select id="select_venue">

			<option value="">Select Any One</option>';
			$run_venue = all_data_from_venue();
            $row_venue = mysqli_num_rows($run_venue);
             while($data_venue = mysqli_fetch_assoc($run_venue)){
             	$output.="<option>{$data_venue['venue_name']}</option>";

             }

			$output.='</select></td>
			</tr>
		<tr>
		<th colspan="2"><button class="btn btn-success insert_btn">Create</button></th>
		</tr>

</table>';
mysqli_close($connect);
echo $output;


?>