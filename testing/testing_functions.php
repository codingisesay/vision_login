<?php

	function all_data_from_venue(){
		include('../database_connection.php');
    
		$query = "SELECT * FROM venues ORDER BY venue_name ASC";
		return $run = mysqli_query($connect, $query);
		mysqli_close($connect);
	}

	function all_data_from_batch(){
		include('../database_connection.php');
			$query = "SELECT * FROM batch ";
			return $run = mysqli_query($connect, $query);
			mysqli_close($connect);
	}

	function all_data_form_Faculty(){
		include('../database_connection.php');
		$query = "SELECT * FROM faculty ORDER By faculty_name ASC";
		return $run = mysqli_query($connect, $query);
		mysqli_close($connect);
	}
	function all_data_from_batch_coordinator(){
		include('../database_connection.php');
		$query = "SELECT * from batch_coordinator ORDER BY batch_coordinator_name ASC";
		return $run = mysqli_query($connect, $query);
		mysqli_close($connect);
	}
	function all_data_from_cameraman(){
		include('../database_connection.php');
		$query = "Select * FROM camera_man ORDER BY camera_man_name ASC";
		return $run = mysqli_query($connect, $query);
		mysqli_close($connect);
	}
	function all_data_from_subjects(){
		include('../database_connection.php');
		$query = "Select * FROM subjects ORDER BY subject_name ASC";
		return $run = mysqli_query($connect, $query);
		mysqli_close($connect);
	}

	function all_data_from_internet(){
		include('../database_connection.php');
		$query = "Select * FROM internet_line";
		return $run = mysqli_query($connect, $query);
		mysqli_close($connect);

	}

  function all_data_from_tech_support_team(){
    include('../database_connection.php');
    $query = "Select * FROM tech_support_person ORDER BY Name ASC";
    return mysqli_query($connect,$query);
	mysqli_close($connect);
  }


function all_data_from_user_table(){
  include('../database_connection.php');
    $query = "Select * FROM user WHERE department_id = '1' AND user_role = '1' ORDER BY user_name ASC";
    return mysqli_query($connect,$query);
  mysqli_close($connect);
}

function issue_data($from_date,$to_date){
  include('../database_connection.php');
  $query = "Select checklist_record.class_id_from_lecture_list,checklist_record.checklist_id, checklist_record.class_date, checklist_record.venue,
   checklist_record.batch, checklist_record.time_slot, user.user_name,issue_during_class.issue_name,
   issue_during_testing_remark.issue_start_time,issue_during_testing_remark.issue_end_time,
   issue_during_testing_remark.observation,issue_during_testing_remark.time_lost_during_class from checklist_record
    inner join user on checklist_record.testing_mamber = user.user_id inner join issue_during_testing_remark on 
    checklist_record.checklist_id = issue_during_testing_remark.checklist_id 
    inner join issue_during_class on issue_during_testing_remark.issue_id = issue_during_class.issue_id 
    where checklist_record.class_date between '$from_date' and '$to_date'  ORDER BY checklist_id ASC";

    return mysqli_query($connect,$query);
    mysqli_close($connect);
  

}
function all_class_from_date($from_date,$to_date){
  include('../database_connection.php');
  $query="select * from checklist_record where class_date between '$from_date' and '$to_date' 
  and testing_started_at is NOT NULL";
  return mysqli_query($connect,$query);
  mysqli_close($connect);

}

function user_permission($user_id){
  include('../database_connection.php');
  $query="SELECT * FROM user WHERE user_id = '$user_id'";
  return mysqli_query($connect,$query);

}

function all_issue_category(){
  include('../database_connection.php');
  $query = "SELECT * FROM issue_during_class";
  return mysqli_query($connect,$query);
  mysqli_close($connect);

}

function fetch_center_id_from_van($ven){
    include('../database_connection.php');
    $query="SELECT * FROM venues where venue_name = '$ven'";
    return mysqli_query($connect,$query);
    mysqli_close($connect);
}

function center_name($center_id){
  include('../database_connection.php');
  $query = "SELECT * FROM center_name WHERE center_id = $center_id";
  return $run = mysqli_query($connect,$query);
  mysqli_close($connect);

}

function fetch_center_table_data(){

  include('../database_connection.php');
  $query="SELECT * FROM center_name";
    return mysqli_query($connect,$query);
    mysqli_close($connect);


}

function fetch_user_name_by_id($monitor_id){
  include('../database_connection.php');
  $query = "SELECT * FROM user WHERE user_id = '$monitor_id'";
   $run = mysqli_query($connect,$query);
   $data = mysqli_fetch_assoc($run);
   return $user_name = $data['user_name'];
   

}

function fetch_center_name(){
  include('../database_connection.php');
  $query = "SELECT * FROM center_name";
  return $run = mysqli_query($connect,$query);
  mysqli_close($connect);

}

	function download_checklist($checklist_id){
	include('../database_connection.php');
		$q="SELECT `checklist_record`.*, `user`.`user_name`,`remark`.* FROM `checklist_record` LEFT JOIN `user` ON `checklist_record`.`testing_mamber` = `user`.`user_id` LEFT JOIN `remark` ON `checklist_record`.`checklist_id` = `remark`.`checklist_id` WHERE checklist_record.checklist_id = '$checklist_id'";
		$run = mysqli_query($connect,$q);
		$row = mysqli_num_rows($run);
		//mysqli_close($connect);
		if($row == 1){
			$checklist_data = mysqli_fetch_assoc($run); 
      
			?>
			<head>

	        <style>
	        	table{
			width: 80%;
			margin-left: 10%;
		}
		table, th, td {
		  border: 1px solid black;
		  border-collapse: collapse;
		  font-weight: bold;
		  padding: 10px;
		  font-size: 16px;
		}
</style>
	        </head>
	        <?php include('testing_navbar.php'); ?>
	        <body>
	         <table border="1" style="margin-top: 2%;">
              <tr>
                <td>Checklist Type</td>
                <td><?php echo $checklist_data['checklist_type']; ?></td>
              </tr>
              <tr>
                <td>Name of Testing Member</td>
                <td><?php echo $checklist_data['user_name']; ?></td>
              </tr>
              <tr>
                <td>Monitor By</td>
                <?php 
                            $query = "SELECT checklist_record.monitor_by from checklist_record WHERE checklist_id = '$checklist_id'";
                            $run = mysqli_query($connect,$query);
                            $data = mysqli_fetch_assoc($run);
                            $moni_by = $data['monitor_by'];
                            $mon_run = data_from_user($moni_by);
                            $data_mon_name = mysqli_fetch_assoc($mon_run);
                            ?>
                <td><?php echo $data_mon_name['user_name']; ?></td>
              </tr>
              <tr>
              <td>Class ID From Lecture List</td>
              <td><?php echo $checklist_data['class_id_from_lecture_list']; ?></td>
            </tr>
              <tr>
                <td>Testing Started At</td>
                <td><?php echo $checklist_data['testing_started_at']; ?></td>
              </tr>
              <tr>
                <td>Testing End At</td>
                <td><?php echo $checklist_data['testing_end_at']; ?></td>
              </tr>
              <tr>
                <td>Venue</td>
                <td><?php echo $checklist_data['venue']; ?></td>
              </tr>
              <tr>
                <td>Batch</td>
                <td><?php $str_batch = $checklist_data['batch']; 
				$str = str_replace(",","<br>*","$str_batch");
				echo "*".$str;
				
				?></td>
              </tr>
              <tr>
                <td>Subject</td>
                <td><?php  echo $checklist_data['subject'];
				


				?></td>
              </tr>
              <tr>
                <td>Faculty</td>
                <td><?php echo $checklist_data['faculty']; ?></td>
              </tr>

             <tr>
                <td>Batch Coordinator</td>
                <td><?php echo $checklist_data['coordinator_presence']; ?></td>
              </tr>


              <tr>
                <td>Batch Coordinator Name</td>
                <td><?php echo $checklist_data['batch_coordinator']; ?></td>
              </tr>
              <tr>
                <td>Camera Man</td>
                <td><?php echo $checklist_data['cameraman']; ?></td>
              </tr>

             <tr>
                <td>Tech Support Person</td>
                <td><?php echo $checklist_data['tech_support_presence']; ?></td>
              </tr>


              <tr>
                <td>Tech Support Person Name</td>
                <td><?php echo $checklist_data['tech_support_person']; ?></td>
              </tr>
              <tr>
                <td>Board Marker/Digital Board Pen</td>
                <td><?php echo $checklist_data['board_marker_pen']; ?></td>
              </tr>

              <tr id="board_remark_tr">
                <td>Board Remark</td>
                <td id="board_remark_td"><?php echo $checklist_data['board_marker_pen_remark']; ?></td>
              </tr>

              <tr>
                <td>Synopsis Display</td>
                <td><?php echo $checklist_data['display_synopsis']; ?></td>
              </tr>

              <tr id="synopsis_display_remark_tr">
                <td>Synopsis Display Remark</td>
                <td id="synopsis_display_remark_td"><?php echo $checklist_data['synopsis_display_remark']; ?></td>
              </tr>

              <tr>
                <td>Camera Focus</td>
                <td><?php echo $checklist_data['camera_focus']; ?></td>
              </tr>
              <tr id="camera_focous_remark_tr"> 
                <td>Camera Focus Remark</td>
                <td id="camera_focous_remark_td"><?php echo $checklist_data['camera_focus_remark']; ?></td>
              </tr>
              <tr>
                <td>Camera Battery</td>
                <td><?php echo $checklist_data['camera_battery']; ?></td>
              </tr>
              <tr id="camera_battery_remark_tr">
                <td>Camera Battery Remark</td>
                <td id="camera_battery_remark_td"><?php echo $checklist_data['camera_battery_remark']; ?></td>
              </tr>
              <tr>
                <td>Memory Card</td>
                <td><?php echo $checklist_data['memnory_card']; ?></td>
              </tr>
              <tr>
                <td>Time Duration for Available Recording (In Mins)</td>
                <td><?php echo $checklist_data['memnory_card_remark']; ?></td>
              </tr>
               <tr>
                <td>Audio Live</td>
                <td><?php echo $checklist_data['audio_live']; ?></td>
              </tr>
              <tr>
                <td>Audio level in Decibels</td>
                <td><?php echo $checklist_data['audio_level_remark']; ?></td>
              </tr>
              <tr>
                <td>Mic Testing Done By</td>
                <td><?php echo $checklist_data['mic_testing_done_by']; ?></td>
              </tr>
              <tr>
                <td>Video Pixxel</td>
                <td><?php echo $checklist_data['video_pixxel']; ?></td>
              </tr>
              <tr>
                <td>Internet Line</td>
                <td><?php echo $checklist_data['internet_line']; ?></td>
              </tr>
              <tr>
                <td>Internet Speed</td>
                <td><?php echo $checklist_data['internet_speed']; ?></td>
              </tr>
              <tr>
                <td>Remote System Laptop</td>
                <td><?php echo $checklist_data['remote_system_laptop']; ?></td>
              </tr>
              <tr id="remote_system_laptop_remark_tr">
                <td>Remote System Laptop Remark</td>
                <td id="remote_system_laptop_remark_td"><?php echo $checklist_data['remote_system_laptop_remark']; ?></td>
              </tr>
               <tr >
                <td>Remote System ipad</td>
                <td><?php echo $checklist_data['remote_system_ipad']; ?></td>
              </tr>
               <tr id="remote_system_ipad_remark_tr">
                <td>Remote System ipad Remark</td>
                <td id="remote_system_ipad_remark_td"><?php echo $checklist_data['remote_system_ipad_remark']; ?></td>
              </tr>
              <tr>
                <td>Prompter Name</td>
                <td><?php echo $checklist_data['prompter_name']; ?></td>
              </tr>
              <tr>
                <td>Batch Coordinator Convey</td>
                <td><?php echo $checklist_data['batch_coordinator_convey']; ?></td>
              </tr>
               <tr id="batch_coordinator_convey_remark_tr">
                <td>Batch Coordinator Convey Remark</td>
                <td id="batch_coordinator_convey_remark_td"><?php echo $checklist_data['batch_coordinator_convey_remark']; ?></td>
              </tr>
              <tr>
                <td>Handout</td>
                <td><?php echo $checklist_data['handout']; ?></td>
              </tr>
              <tr id="handout_remark_tr">
                <td>Handout Name</td>
                <td id="handout_remark_td"><?php echo $checklist_data['handout_remark']; ?></td>
              </tr>
              <tr>
                <td>Next Class Update</td>
                <td><?php echo $checklist_data['next_class_update']; ?></td>
              </tr>
              <tr id="next_class">
                <td>Next Class Update Remark</td>
                <td id="next_clas_td"><?php echo $checklist_data['next_class_update_remark']; ?>
                </td>
              </tr>
              <tr>
                <td>Testing Query</td>
                <td><?php echo $checklist_data['testing_query']; ?></td>
              </tr>
               <tr id="testing_query_remark_tr">
                <td>Testing Query Remark</td>
                <td id="testing_query_remark_td"><?php echo $checklist_data['testing_query_remark']; ?></td>
              </tr>
              <tr>
                <td>Live Stream Started:</td>
                <td><?php echo $checklist_data['live_started_at'];?></td>
              </tr>
              <tr>
                <td>Checklist Submit Time:</td>
                <td><?php echo $checklist_data['submit_checklist_time'];?></td>
              </tr>
              <tr>
                <td>Observation During Testing</td>
                <td><?php echo $checklist_data['observation_during_testing']; ?></td>
              </tr>
            </table>
            <button style="width:80%; margin-left: 10%; margin-top:2%; height:8%;"><a href="download_excel.php?checklist_id=<?php echo $checklist_id; ?>">Download Excel</a></button>

              <script>
               //Board Remark
                var board_remark_td = document.getElementById('board_remark_td').innerText;

                if(board_remark_td == ""){
                  document.getElementById('board_remark_tr').style.display = "none";
                }

                //display synopsis

               var synopsis_display_remark_td = document.getElementById('synopsis_display_remark_td').innerText;

               if(synopsis_display_remark_td == ""){
                document.getElementById('synopsis_display_remark_tr').style.display = "none";
               }

              //camera focous remark
             var camera_focous_remark_td = document.getElementById('camera_focous_remark_td').innerText;
             if(camera_focous_remark_td == ""){

               document.getElementById('camera_focous_remark_tr').style.display = "none";

             }

             //battery remark
             var camera_battery_remark_td = document.getElementById('camera_battery_remark_td').innerText;

             if(camera_battery_remark_td == ""){

              document.getElementById('camera_battery_remark_tr').style.display = "none";

             }


             //remote_system_laptop_remark
             var remote_system_laptop_remark_td = document.getElementById('remote_system_laptop_remark_td').innerText;
             if(remote_system_laptop_remark_td == ""){

             document.getElementById('remote_system_laptop_remark_tr').style.display = "none";

             }

             //remote_system_ipad_remark

             var remote_system_ipad_remark_td = document.getElementById('remote_system_ipad_remark_td').innerText;
             if(remote_system_ipad_remark_td == ""){

              document.getElementById('remote_system_ipad_remark_tr').style.display = "none";

             }

             //batch_coordinator_convey_remark

             var batch_coordinator_convey_remark_td = document.getElementById('batch_coordinator_convey_remark_td').innerText;
             if(batch_coordinator_convey_remark_td == ""){

              document.getElementById('batch_coordinator_convey_remark_tr').style.display = "none";

             }


             //handout remark

             var handout_remark_td = document.getElementById('handout_remark_td').innerText;
             if(handout_remark_td == ""){

              document.getElementById('handout_remark_tr').style.display = "none";

             }


             //next class
             
             var next_clas_td = document.getElementById('next_clas_td').innerText;

             if(next_clas_td == ""){
              document.getElementById('next_class').style.display = "none";
             }

             //testing query
            
             var testing_query_remark_td = document.getElementById('testing_query_remark_td').innerText;
             if(testing_query_remark_td == ""){

              document.getElementById('testing_query_remark_tr').style.display = "none";

             }
            
             
            </script>
	         
	     </body>
<?php 
}

}



?>