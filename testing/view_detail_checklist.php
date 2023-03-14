<?php 
include('testing_session.php');
include('testing_functions.php');

$class_id = $_POST['class_id'];

$qu="SELECT checklist_id FROM checklist_record WHERE class_id_from_lecture_list = '$class_id'";
$run_for_checklist_id = mysqli_query($connect,$qu);
$data_checklist = mysqli_fetch_assoc($run_for_checklist_id);
$checklist_id = $data_checklist['checklist_id'];

$query = "SELECT checklist_record.monitor_by from checklist_record WHERE checklist_id = '$checklist_id'";
$run = mysqli_query($connect,$query);
$data = mysqli_fetch_assoc($run);
$moni_by = $data['monitor_by'];
$mon_run = data_from_user($moni_by);
$data_mon_name = mysqli_fetch_assoc($mon_run);
$monitor_name = $data_mon_name['user_name'];

?>

            <?php
           
           $q="SELECT `checklist_record`.*, `user`.`user_name`,`remark`.* FROM `checklist_record` LEFT JOIN `user` ON `checklist_record`.`testing_mamber` = `user`.`user_id` LEFT JOIN `remark` ON `checklist_record`.`checklist_id` = `remark`.`checklist_id` WHERE checklist_record.class_id_from_lecture_list = '$class_id'";
           $run = mysqli_query($connect,$q);
           $row = mysqli_num_rows($run);
           $data = mysqli_fetch_assoc($run);




           $output="";
           $output = "<table width='100%'>
           <tr>
           <th colspan='2'>Checklist Record</th>
           </tr>
           <tr>
           <td>Checklist Type</td>
           <td>{$data['checklist_type']}</td>
           </tr>
           <tr>
                <td>Name of Testing Member</td>
                <td>{$data['user_name']}</td>
              </tr>
              
              


              <tr>
              <td>Monitor By</td>";
             


              $output.="<td>{$monitor_name}</td>
              </tr>
              <tr>
              <td>Class ID From Lecture List</td>
              <td>{$data['class_id_from_lecture_list']}</td>
            </tr>
              <tr>
                <td>Testing Started At</td>
                <td>{$data['testing_started_at']}</td>
              </tr>
              <tr>
                <td>Testing End At</td>
                <td>{$data['testing_end_at']}</td>
              </tr>
              <tr>
                <td>Venue</td>
                <td>{$data['venue']}</td>
              </tr>
              <tr>
                <td>Batch</td>";
                $str_batch = $data['batch']; 

                $str = str_replace(",","<br>*","$str_batch");
                

                $output.="<td>*{$str}</td>
              </tr>
              <tr>
                <td>Subject</td>
                <td>{$data['subject']}</td>
              </tr>
              <tr>
                <td>Faculty</td>
                <td>{$data['faculty']}</td>
              </tr>
              
              <tr>
              <td>Batch Coordinator</td>
              <td>{$data['coordinator_presence']}</td>

              </tr>


              <tr>
                <td>Batch Coordinator Name</td>
                <td>{$data['batch_coordinator']}</td>
              </tr>
              <tr>
                <td>Camera Man</td>
                <td>{$data['cameraman']}</td>
              </tr>
               
               <tr>
               <td>Tech Support Person</td>
               <td>{$data['tech_support_presence']}</td>
               </tr>

               <tr>
                <td>Tech Support Person Name</td>
                <td>{$data['tech_support_person']}</td>
              </tr>
              <tr>
                <td>Board Marker/Digital Board Pen</td>
                <td>{$data['board_marker_pen']}</td>
              </tr>
              <tr id='board_remark_tr'>
                <td>Board Remark</td>
                <td id='board_remark_td'>{$data['board_marker_pen_remark']}</td>
              </tr>
              <tr>
                <td>Synopsis Display</td>
                <td>{$data['display_synopsis']}</td>
              </tr>
              
              <tr id='synopsis_display_remark_tr'>
                <td>Synopsis Display Remark</td>
                <td id='synopsis_display_remark_td'>{$data['synopsis_display_remark']}</td>
              </tr>


              <tr>
                <td>Camera Focus</td>
                <td>{$data['camera_focus']}</td>
              </tr>
              <tr id='camera_focus_remark_tr'>
             <td>Camera Focus Remark</td>
                <td id='camera_focus_remark_td'>{$data['camera_focus_remark']}</td>
              </tr>

              <tr>
                <td>Camera Battery</td>
                <td>{$data['camera_battery']}</td>
              </tr>

              <tr id='camera_battery_remark_tr'>

              <td>Camera Battery Remark</td>
                <td id='camera_battery_remark_td'>{$data['camera_battery_remark']}</td>
              </tr>
              <tr>
                <td>Memory Card</td>
                <td>{$data['memnory_card']}</td>
              </tr>
              <tr>
                <td>Time Duration for Available Recording (In Mins)</td>
                <td>{$data['memnory_card_remark']}</td>
              </tr>
               <tr>
                <td>Audio Live</td>
                <td>{$data['audio_live']}</td>
              </tr>
              <tr>
                <td>Audio level in Decibels</td>
                <td>{$data['audio_level_remark']}</td>
              </tr>
              <tr>
                <td>Mic Testing Done By</td>
                <td>{$data['mic_testing_done_by']}</td>
              </tr>
              <tr>
                <td>Video Pixxel</td>
                <td>{$data['video_pixxel']}</td>
              </tr>
              <tr>
                <td>Internet Line</td>
                <td>{$data['internet_line']}</td>
              </tr>
              <tr>
                <td>Internet Speed</td>
                <td>{$data['internet_speed']}</td>
              </tr>
              <tr>
                <td>Remote System Laptop</td>
                <td>{$data['remote_system_laptop']}</td>
              </tr>
              <tr id='remote_system_laptop_tr'>
                <td>Remote System Laptop Remark</td>
                <td id='remote_system_laptop_td'>{$data['remote_system_laptop_remark']}</td>
              </tr>
               <tr >
                <td>Remote System ipad</td>
                <td>{$data['remote_system_ipad']}</td>
              </tr>
              <tr id='remote_system_ipad_remark_tr'>
              <td>Remote System ipad Remark</td>
                <td id='remote_system_ipad_remark_td'>{$data['remote_system_ipad_remark']}</td>
              </tr>
              <td>Prompter Name</td>
                <td>{$data['prompter_name']}</td>
              </tr>
              <tr>
                <td>Batch Coordinator Convey</td>
                <td>{$data['batch_coordinator_convey']}</td>
              </tr>
                
              <tr id='batch_coordinator_convey_remark_tr'>
               <td>Batch Coordinator Convey Remark</td>
                <td id='batch_coordinator_convey_remark_td'>{$data['batch_coordinator_convey_remark']}</td>
              </tr>
              <tr>
                <td>Handout</td>
                <td>{$data['handout']}</td>
              </tr>
              <tr id='handout_remark_tr'>
                <td>Handout Remark</td>
                <td id='handout_remark_td'>{$data['handout_remark']}</td>
              </tr>
               <tr>
                <td>Next Class Update</td>
                <td>{$data['next_class_update']}</td>
              </tr>
              <tr id='next_class_update_remark_tr'>
              <td>Next Class Update Remark</td>
                <td id='next_class_update_remark_td'>{$data['next_class_update_remark']}</td>
              </tr>
              <tr>
                <td>Testing Query</td>
                <td>{$data['testing_query']}</td>
              </tr>
              <tr id='testing_query_remark_tr'>
               <td>Testing Query Remark</td>
                <td id='testing_query_remark_td'>{$data['testing_query_remark']}</td>
              </tr>
              <tr>
              <td>Live Stream Started:</td>
              <td>{$data['live_started_at']}</td>
              </tr>
              <tr>
              <td>Checklist Submit Time:</td>
              <td>{$data['submit_checklist_time']}</td>
              </tr>
               


              <tr>
                <td>Observation During Testing</td>
                <td>{$data['observation_during_testing']}</td>
              </tr>
              <tr>
                <td>Class Started At</td>
                <td>{$data['class_started']}</td>
              </tr>
              <tr>
                <td>Class End At</td>
                <td>{$data['class_end_at']}</td>
              </tr>
              <tr>
                <td>Event Post Update</td>
                <td>{$data['event_post_update']}</td>
              </tr>
              <tr id='event_post_update_remark_tr'>
              <td>Event Post Update Remark</td>
                <td id='event_post_update_remark_td'>{$data['event_post_update_remark']}</td>
              </tr>
              <tr>
                <td>Recorded Video Uploaded</td>
                <td>{$data['recorded_video_uploaded']}</td>
              </tr>
              <tr>
                <td>Recorded Video Uploaded Time</td>
                <td>{$data['recorded_video_uploaded_remark']}</td>
              </tr>
              <tr style='recorded_video_uploaded_remark_tr'>

            <td>Recorded Video Uploaded Remark</td>
                <td style='recorded_video_uploaded_remark_td'>{$data['recorded_video_remark']}</td>
              </tr>
              <tr>
           <th colspan='2'>Issue During Class</th>
           </tr>";

           


           $query ="SELECT `issue_during_testing_remark`.*, `issue_during_class`.`issue_name`,user.user_name FROM `issue_during_testing_remark` LEFT JOIN `issue_during_class` ON `issue_during_testing_remark`.`issue_id` = `issue_during_class`.`issue_id` LEFT JOIN user on issue_during_testing_remark.user_id = user.user_id WHERE issue_during_testing_remark.checklist_id = '$checklist_id' ORDER BY issue_during_testing_remark_id ASC";
           $run_during_class = mysqli_query($connect,$query);
           $row_during_class = mysqli_num_rows($run_during_class);
           if($row_during_class > 0){
            for($i=1; $i <= $row_during_class; $i++){
            $data_issue_during_class = mysqli_fetch_assoc($run_during_class);
			 mysqli_close($connect);
            $output.="<tr>
            <tr>
            <th colspan='2'>Issue No. {$i}</th>
            </tr>
           <td>Issue Start Time</td>
           <td>{$data_issue_during_class['issue_start_time']}</td>
           </tr>
           <tr>
           <td>Issue End Time</td>
           <td>{$data_issue_during_class['issue_end_time']}</td>
           </tr>
           <tr>
           <td>Issue Type</td>
           <td>{$data_issue_during_class['issue_name']}</td>
           </tr>
           <td>Time Lost</td>
           <td>{$data_issue_during_class['time_lost_during_class']} Mins</td>
           </tr>
           
           <tr>
           <td>Observation</td>
           <td>{$data_issue_during_class['observation']}</td>
           </tr>
           <tr>
           <td>Had Live classes Stopped?</td>
           <td>{$data_issue_during_class['live_class_affect']}</td>
           </tr>
           <tr>
           <td>Issue Update By</td>
           <td>{$data_issue_during_class['user_name']}</td>
           </tr>";
           

           }
        }else{
        $output.="<tr>
           <th colspan='2'>No Issue In this Class</th>
           </tr>";

        }

     

        
     
          $output.="</table>";
           echo $output;
		  
           

        ?>

         
     