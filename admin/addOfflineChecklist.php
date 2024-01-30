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
<tr><th colspan="2"><h2>Create Offline Checklist</h2></th></tr>
<tr>
<td>Date</td>
<td><input type="date" id="offline_class_date"></td>
</tr>
<tr>
<td><label>Class ID</label></td>
<td><input type="number" id="offline_class_id" ></br></td>
</tr>
<tr>
<td><label>Batch</label></td>
<td><select id="offline_select_batch" multiple style="width:600px;">';
$query_batch="SELECT * FROM batch";
$run_batch = mysqli_query($connect,$query_batch);
while($data_batch = mysqli_fetch_assoc($run_batch)){
    $output.="<option>{$data_batch["batch_name"]}</option>";
}

$output.='</select>


</tr>

<tr>
<td><label>Subject</label></td>
<td><select id="offline_subject_name" required>
    <option value="">Select Any One</option>';
    $query = "Select * FROM subjects ORDER BY subject_name ASC";
    $run = mysqli_query($connect,$query);
    $rows = mysqli_num_rows($run);
    while($data = mysqli_fetch_assoc($run)){
        $output.="<option>{$data['subject_name']}</option>";

    }

$output.='</select>
<td><input type="number" id="offline_subject_number"></td>
</td>

</tr>
		<tr>
			<td><label>Coordinator Name</label></td>
			<td><select id="offline_coordinator_name" required>
				<option value="">Select Any One</option>';
				$query = "Select * FROM batch_coordinator ORDER BY batch_coordinator_name ASC";
                $run = mysqli_query($connect,$query);
                $rows = mysqli_num_rows($run);
                while($data = mysqli_fetch_assoc($run)){
                	$output.="<option>{$data["batch_coordinator_name"]}</option>";

                }

           $output.='</select></td>
           
           </tr>

           <tr>
           <td><label>Faculty</label></td>
           <td><select id="offline_faculty_name" required>
               <option value="">Select Any One</option>';
               $query = "Select * FROM faculty ORDER BY faculty_name ASC";
               $run = mysqli_query($connect,$query);
               $rows = mysqli_num_rows($run);
               while($data = mysqli_fetch_assoc($run)){
                   $output.="<option>{$data["faculty_name"]}</option>";

               }

          $output.='</select></td>
          
          </tr>

		
		   
        
           	<tr>
			<td><label>Time Slot</label></td>
			<td><select id="offline_time_slot" >
				<option value="">Select And One</option>
				<option value="09 am - 12 pm">09 am - 12 pm</option>
				<option value="01 pm - 04 pm">01 pm - 04 pm</option>
				<option value="05 pm - 08 pm">05 pm - 08 pm</option>
			</select></br></td>
		</tr>
		<tr>
        <td><label>Class Start</label></td>
			<td><input type="datetime-local" id="offline_class_time"></td>
		</tr>
			<td><label>Venue</label></td>
			
			<td><select id="offline_select_venue">

			<option value="">Select Any One</option>';
			$run_venue = all_data_from_venue();
            $row_venue = mysqli_num_rows($run_venue);
             while($data_venue = mysqli_fetch_assoc($run_venue)){
             	$output.="<option>{$data_venue['venue_name']}</option>";

             }

			$output.='</select></td>
			</tr>
		<tr>
		<th colspan="2"><button class="btn btn-success offline_insert_btn">Create</button></th>
		</tr>

</table>';
mysqli_close($connect);
echo $output;


?>