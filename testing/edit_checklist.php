<?php 
include('testing_session.php');
include('testing_functions.php');
?>
<html>
<head>
	<link rel="stylesheet" href="css/edit_checklist.css">
	
	</head>
	<body>
		<?php include('testing_navbar.php');?>
		<?php
           $class_id = $_GET['class_id'];
           $q="SELECT checklist_record.*, user.user_id,user.user_name,user.user_role,user.department_id,remark.* FROM checklist_record LEFT JOIN user ON checklist_record.testing_mamber = user.user_id LEFT JOIN remark ON checklist_record.checklist_id = remark.checklist_id WHERE checklist_record.class_id_from_lecture_list = '$class_id'";
           $run = mysqli_query($connect,$q);
           $row = mysqli_num_rows($run);
           $data = mysqli_fetch_assoc($run);
          
           ?>
           <div class="main_form">
            <form action="update_edit.php" method="POST">
              <?php 

              $query_for_cl_id = "SELECT checklist_id FROM checklist_record WHERE class_id_from_lecture_list = '$class_id'";
              $run_for_cl_id = mysqli_query($connect,$query_for_cl_id);
              $data_cl_id = mysqli_fetch_assoc($run_for_cl_id);
              ?>
              <input type="hidden" name="checklist_id" value="<?php echo $data_cl_id['checklist_id']; ?>">
           <table width='100%'>

           <tr>
           <th colspan='2'>Edit Record</th>
           </tr>
           <tr>
           <td>Date</td>
           <td><input type="date" value="<?php echo $data['class_date']; ?>" name="class_date"></td>
           </tr>
           <tr>
           <td><label>Time Slot</label></td>
           <td><select id="select_time_slot" class="main_form_select" name="select_time_slot">
            <option value="<?php echo $data['time_slot']; ?>"><?php echo $data['time_slot']; ?></option>
            <option value="09 am - 12 pm">09 am - 12 pm</option>
            <option value="01 pm - 04 pm">01 pm - 04 pm</option>
            <option value="05 pm - 08 pm">05 pm - 08 pm</option>
      </select></td>
    </tr>
           <tr>
           <td>Checklist Type</td>
           <td><select class="main_form_select" name="checklist_type">
           	<option value="<?php echo $data['checklist_type'];?>"><?php echo $data['checklist_type'];?></option>
           	<option value="Class">Class</option>
            <option value ="Discussion">Discussion</option>
           </select>

           	</td>
           </tr>
           <tr>
                <td>Name of Testing Member</td>
                <td><select class="main_form_select" name="testing_member">
                	<option value="<?php echo $data['user_id'];?>"><?php echo $data['user_name'];?></option>

                	<?php
                		$data_from_user_table = all_data_from_user_table();
                        $row = mysqli_num_rows($data_from_user_table);
                	while($data_user = mysqli_fetch_assoc($data_from_user_table)){?>
                         
                        <option value="<?php echo $data_user['user_id']?>"><?php echo $data_user['user_name']; ?></option>
                		<?php

                	}
                	?>

                </select>

                	</td>
              </tr>
              <tr>
              <td>Class ID From Lecture List</td>
              <td><input type="number" value="<?php echo $data['class_id_from_lecture_list'];?>" name="class_id_from_lecture_list"></td>
            </tr>
              <tr>
                <td>Testing Started At</td>
                <td><input type="datetime-local" value="<?php echo $data['testing_started_at']; ?>" name="testing_started_at"></td>
              </tr>
              <tr>
                <td>Testing End At</td>
                <td><input type="datetime-local" value="<?php echo $data['testing_end_at'];?>" name="testing_end_at"></td>
              </tr>
              <tr>
                <td>Venue</td>
                  <?php 
                       $run_venue = all_data_from_venue();
                        $row_venue = mysqli_num_rows($run_venue);

                    ?>
                            <td><select class="main_form_select" name="insert_venue" >

                                <option value="<?php echo $data['venue']?>"><?php echo $data['venue']?></option>
                                <?php 
                                  for($venue=0; $venue < $row_venue; $venue++){

                                     $data_from_venue = mysqli_fetch_assoc($run_venue);
                                    ?>

                                        <option><?php echo $data_from_venue['venue_name']; ?></option>
                                    <?php
                                   
                                  }
                                 
                                ?>
              </td>
              </tr>
              <tr>
                <td>Batch</td>
                
                <td><textarea name="insert_batch" rows="4" cols="38"><?php echo $data['batch']; ?></textarea>
                	</td>
              </tr>
              <tr>
                <td>Subject</td>
                <td><select class="main_form_select" name="subject_name">
                  <?php 
                  $subject = $data['subject'];
                  $subject_name = substr_replace($subject ,"",-2);


                  ?>
                	<option value="<?php echo $subject_name; ?>"><?php echo $subject_name; ?></option>
                
                <?php 

                                $run_subject = all_data_from_subjects();
                                $row_subject =mysqli_num_rows($run_subject);
                                 for($subject = 0; $subject < $row_subject; $subject++){
                                    $subject_data = mysqli_fetch_assoc($run_subject);?>
                                    <option value="<?php echo $subject_data['subject_name']; ?>"><?php echo $subject_data['subject_name']; ?></option>

                                    <?php
                                }

                                ?>

                	</select><select style="width: 20%; padding: 10px; margin-left: 5px" name="classnumber">
                    <?php $txt = $data['subject'];
                    $class_number = substr($txt, -2);?>
                        <option value="<?php echo $class_number; ?>"><?php echo $class_number; ?></option>
                                <?php for($i = 0; $i <= 75; $i++){?>

                                    <option><?php echo $i; ?></option>
                                    <?php

                                }?>
                            </select></td>
              </tr>
              <tr>
                <td>Faculty</td>

                  <?php 
                             $run_faculty = all_data_form_Faculty();
                             $row_faculty = mysqli_num_rows($run_faculty);

                            ?>
                            <td><select class="main_form_select" name="insert_faculty" >
                                <option value="<?php echo $data['faculty']; ?>"><?php echo $data['faculty']; ?></option>
                                <?php 
                                 for($faculty=0; $faculty < $row_faculty; $faculty++){
                                    $data_faculty = mysqli_fetch_assoc($run_faculty);?>

                                     <option value="<?php echo $data_faculty['faculty_name'];  ?>"><?php echo $data_faculty['faculty_name'];  ?></option>
                                    <?php
                                 }

                                ?>
                            </select></td>
                        </tr>
              
              <tr>
              <td>Batch Coordinator</td>
              <td>
                                <select class="main_form_select" name="batch_coordinator_avail" >
                                    <option value="<?php echo $data['coordinator_presence']; ?>"><?php echo $data['coordinator_presence']; ?></option>
                                    <option value="Available">Available</option>
                                    <option value="Not Available">Not Available</option>
									<option value="Not Applicable">Not Applicable</option>
                                </select>
                            </td>

              </tr>


              <tr>
                <td>Batch Coordinator Name</td>

                 <?php 
                            $run_batch_coordinator = all_data_from_batch_coordinator();
                            $row_batch_coo = mysqli_num_rows($run_batch_coordinator);

                            ?>
                            <td><select class="main_form_select" name="insert_batch_coordinator" >
                                <option value="<?php echo $data['batch_coordinator']; ?>"><?php echo $data['batch_coordinator']; ?></option>
                                <?php 
                                 for($batch_coordinator = 0; $batch_coordinator < $row_batch_coo; $batch_coordinator++){
                                    $data_faculty = mysqli_fetch_assoc($run_batch_coordinator);?>
                                    <option value="<?php echo $data_faculty['batch_coordinator_name'];?>"><?php echo $data_faculty['batch_coordinator_name'];?></option>

                                    <?php

                                 }

                                 ?>
                            </select></td>
                        </tr>

              <tr>
                <td>Camera Man</td>

                    <?php
                             $run_camera_name = all_data_from_cameraman();
                             $row_camera_man = mysqli_num_rows($run_camera_name);

                             ?>
                            <td><select class="main_form_select" name="insert_camera_man" >
                                <option value="<?php echo $data['cameraman'];?>"><?php echo $data['cameraman'];?></option>
                                <?php 
                                for($camera_man = 0; $camera_man < $row_camera_man; $camera_man++){
                                    $data_camera_man = mysqli_fetch_assoc($run_camera_name);?>

                                    <option value="<?php echo $data_camera_man['camera_man_name'];?>"><?php echo $data_camera_man['camera_man_name'];?></option>

                                    <?php
                                }

                                 ?>
                            </select></td>
                        </tr>
          
               <tr>
               <td>Tech Support Person</td>

               <td>
                                <select class="main_form_select" name="tech_support_person_avail" >
                                    <option value="<?php echo $data['tech_support_presence'];?>"><?php echo $data['tech_support_presence'];?></option>
                                    <option value="Available">Available</option>
                                    <option value="Not Available">Not Available</option>
									<option value="Not Applicable">Not Applicable</option>
                                </select>
                            </td>
                        </tr>


               <tr>
                <td>Tech Support Person Name</td>

                 <?php 
                            $run_tech_support_person = all_data_from_tech_support_team();
                           $row_tech_support_person =  mysqli_num_rows($run_tech_support_person);

                            ?>
                            <td><select name="tech_support_person" class="main_form_select" >
                                <option value="<?php echo $data['tech_support_person'];?>"><?php echo $data['tech_support_person'];?></option>
                                <?php 
                                 for($tech_person = 0; $tech_person < $row_tech_support_person; $tech_person++){
                                    $data_tech_suppport = mysqli_fetch_assoc($run_tech_support_person);?>

                                    <option value="<?php echo $data_tech_suppport['Name'];?>"><?php echo $data_tech_suppport['Name'];?></option>


                                    <?php


                                 }
                                ?>
                            </select></td>
                        </tr>


              <tr>
                <td>Board Marker/Digital Board Pen</td>

                 <td><select name="board_pen_marker" class="main_form_select" id="marker_pen" >
                                <option value="<?php echo $data['board_marker_pen']; ?>"><?php echo $data['board_marker_pen']; ?></option>
                                <option value="Checked">Checked</option>
                                <option value="Unchecked">Unchecked</option>
                            </select>
                        </td>
                        </tr>

                
              <tr id='board_remark_tr'>
                <td>Board Remark</td>
                <td id='board_remark_td'><textarea id="board_pen_marker_remark" style="display: block;margin-top:10px;" placeholder="Remark" rows="2" cols="38" name="insert_board_pen_marker_remark" ><?php echo $data['board_marker_pen_remark']; ?></textarea></td>
              </tr>


              <tr>
                <td>Synopsis Display</td>
                <td><select name="display_synopsis" class="main_form_select" id="pre_synopsis" >
                                <option value="<?php echo $data['display_synopsis']; ?>"><?php echo $data['display_synopsis']; ?></option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
								<option value="Not Applicable">Not Applicable</option></select></td>
              </tr>
              
              <tr id='synopsis_display_remark_tr'>
                <td>Synopsis Display Remark</td>
                <td id='synopsis_display_remark_td'><textarea id="display_synopsis_remark" style="display: block;margin-top:10px;" placeholder ="Remark" rows="2" cols="38" name="insert_display_synopsis_remark" ><?php echo $data['synopsis_display_remark'];?></textarea></td>
              </tr>


              <tr>
                <td>Camera Focus</td>
                <td><select class="main_form_select" id="Camera_Focous" name="insert_camera_focous" >
                                <option value="<?php echo $data['camera_focus']; ?>"><?php echo $data['camera_focus']; ?></option>
                                <option value="Correct">Correct</option>
                                <option value="Incorrect">Incorrect</option>
                            </select>
                </td>
              </tr>
              <tr id='camera_focus_remark_tr'>
             <td>Camera Focus Remark</td>
                <td id='camera_focus_remark_td'><textarea id="Camera_Focous_incorrect_remark" style="display: block;margin-top:10px;" placeholder ="Remark" rows="2" cols="38" name="insert_camera_focous_remark" ><?php echo $data['camera_focus_remark'];?></textarea></td>
              </tr>

              <tr>
                <td>Camera Battery</td>
                <td><select class="main_form_select" id="Camera_Battery"  name="insert_camera_battery" >
                                <option value="<?php echo $data['camera_battery']; ?>"><?php echo $data['camera_battery']; ?></option>
                                <option value="Charger Pluged">Charger Pluged</option>
                                <option value="Charger Not Pluged">Charger Not Pluged</option></select>
                </td>
              </tr>

              <tr id='camera_battery_remark_tr'>

              <td>Camera Battery Remark</td>
                <td id='camera_battery_remark_td'><textarea id="Camera_Battery_incorrect_remark" style="display: block; margin-top:10px;" placeholder ="Remark" rows="2" cols="38" name="insert_camera_battery_remark" ><?php echo $data['camera_battery_remark']; ?></textarea></td>
              </tr>

              <tr>
                <td>Memory Card</td>

                <td><select class="main_form_select" id="Memory_Card" onclick="Memory_Card_remark();" name="insert_memory_card" >
                                <option value="<?php echo $data['memnory_card']; ?>"><?php echo $data['memnory_card']; ?></option>
                                <option value="Inserted">Inserted</option>
                                <option value="Not Inserted">Not Inserted</option>
                                </td>
              </tr>
              <tr>
                <td>Time Duration for Available Recording (In Mins)</td>

                <td><textarea id="memory_card_remark" style="display: block; margin-top:10px;"  rows="2" cols="38" name="insert_memory_card_remark" ><?php echo $data['memnory_card_remark'];?></textarea>
                </td>
              </tr>


               <tr>
                <td>Audio Live</td>
                <td><select class="main_form_select" id="Audio_Live" onclick="Audio_Live_remark();" name="insert_audio_live" >
                                <option value="<?php echo $data['audio_live']; ?>"><?php echo $data['audio_live']; ?></option>
                                <option value="Checked">Checked</option>
                                <option value="Unchecked">Unchecked</option>
                            </select>
                </td>
              </tr>

              <tr>
                <td>Audio level in Decibels</td>
                <td><textarea id="audio_live_remark" style="display: block; margin-top:10px;" placeholder="Remark" rows="2" cols="38" name="insert_audio_live_remark" ><?php echo $data['audio_level_remark'];?></textarea></td>
              </tr>

              <tr>
                <td>Mic Testing Done By</td>
                <td><select class="main_form_select" name="insert_mic_testing" >
                                <option value="<?php echo $data['mic_testing_done_by'];?>"><?php echo $data['mic_testing_done_by'];?></option>
                                <option value="Camera man">Camera man</option>
                                <option value="Testing Person"> Testing Person</option>
                                <option value="Faculty">Faculty</option>
                                <option value="Not checked">Not checked</option>
                            </select></td>
              </tr>
              <tr>
                <td>Video Pixxel</td>
                <td><select class="main_form_select" name="insert_video_pixxel" >
                                <option value="<?php echo $data['video_pixxel']; ?>"><?php echo $data['video_pixxel']; ?></option>
                                <option value="360px, 480px, 720px">360px, 480px, 720px</option>
                                <option value="360px, 480px, 720px, 1080px">360px, 480px, 720px, 1080px</option>
                            </select></td>
              </tr>

              <tr>
                <td>Internet Line</td>


                 <?php 

                             $run_internet_line = all_data_from_internet();
                             $rows_internet_line = mysqli_num_rows($run_internet_line);
                            ?>
                            <td><select class="main_form_select" name="insert_internet_line" id="internetline" onclick="internet_spd();" >
                                <option value="<?php echo $data['internet_line'];?>"><?php echo $data['internet_line'];?></option>
                                <?php 
                                 for($internet_line = 0; $internet_line < $rows_internet_line; $internet_line++){
                                    $data_internet_line = mysqli_fetch_assoc($run_internet_line);
                                    ?>
                                      <option value="<?php echo $data_internet_line['internet_name']; ?>"><?php echo $data_internet_line['internet_name']; ?></option>

                                    <?php

                                 }
                                
                                ?>
                </td>
              </tr>
              <tr>
                <td>Internet Speed</td>

                <td><textarea id="internet_speed" style="display: block; margin-top:10px;" placeholder="Remark" rows="2" cols="38" name="insert_internet_speed"><?php echo $data['internet_speed'];?></textarea></td>
              </tr>

              <tr>
                <td>Remote System Laptop</td>
                <td><select class="main_form_select" id="Remote_System_Laptop" name="insert_remote_system_laptop">
                                <option value="<?php echo $data['remote_system_laptop'];?>"><?php echo $data['remote_system_laptop'];?></option>
                                <option value="Connected">Connected</option>
                                <option value="Not Connected">Not Connected</option>
								<option value="Not Applicable">Not Applicable</option>
                                
                            </select></td>
              </tr>
              <tr id='remote_system_laptop_tr'>
                <td>Remote System Laptop Remark</td>
                <td id='remote_system_laptop_td'><textarea id="remote_system_remark" style="display: block; margin-top:10px;" placeholder="Remark" rows="2" cols="38" name="insert_remote_laptop_remar" ><?php echo $data['remote_system_laptop_remark'];?></textarea></td>
              </tr>

               <tr >
                <td>Remote System ipad</td>
                <td><select class="main_form_select" id="Remote_System_I_pad"  name="remote_system_ipad">
                                <option value="<?php echo $data['remote_system_ipad']; ?>"><?php echo $data['remote_system_ipad']; ?></option>
                                <option value="Connected">Connected</option>
                                <option value="Not Connected">Not Connected</option>
                                <option value="Not Applicable">Not Applicable</option>
                                
                            </select></td>
              </tr>
              <tr id='remote_system_ipad_remark_tr'>
              <td>Remote System ipad Remark</td>
                <td id='remote_system_ipad_remark_td'><textarea id="remote_system_i_pad_remark" style="display: block; margin-top:10px;" placeholder="Remark" rows="2" cols="38" name="remote_ipad_remark"><?php echo $data['remote_system_ipad_remark']; ?></textarea></td>
              </tr>


              <td>Prompter Name</td>
              <?php 
                                 $run_venue = all_data_from_venue();
                                 $row_venue = mysqli_num_rows($run_venue);

                                ?>
                                <td><select class="main_form_select" name="insert_prompter">

                                <option value="<?php echo $data['prompter_name']; ?>"><?php echo $data['prompter_name']; ?></option>
                                <?php 
                                  for($venue=0; $venue < $row_venue; $venue++){

                                     $data_from_venue = mysqli_fetch_assoc($run_venue);
                                    ?>

                                        <option value="<?php echo $data_from_venue['venue_name']; ?>"><?php echo $data_from_venue['venue_name']; ?></option>
                                    <?php
                                   
                                  }
                                 
                                ?></select></td>
                        </tr>


              <tr>
                <td>Batch Coordinator Convey</td>
                <td><select class="main_form_select" id="Conved_To_Batch_Coo" name="convey_to_bcoo">
                                <option value="<?php echo $data['batch_coordinator_convey']; ?>"><?php echo $data['batch_coordinator_convey']; ?></option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
								<option value="Not Required">Not Required</option>
                                
                            </select>
                </td>
              </tr>
                
              <tr id='batch_coordinator_convey_remark_tr'>
               <td>Batch Coordinator Convey Remark</td>
                <td id='batch_coordinator_convey_remark_td'><textarea id="Conved_To_Batch_Coo_remark" style="display: block; margin-top:10px;" placeholder="Remark" rows="2" cols="38" name="convey_to_bcoo_remark" ><?php echo $data['batch_coordinator_convey_remark'];?></textarea></td>
              </tr>


              <tr>
                <td>Handout</td>
                <td><select class="main_form_select" id="Handout_remark" name="handout">
                                <option value="<?php echo $data['handout'];?>"><?php echo $data['handout'];?></option>
                                <option value="Uploaded">Uploaded</option>
                                <option value="Not Uploaded">Not Uploaded</option>
                                <option value="Not Applicable">Not Applicable</option>
                                
                            </select></td>
              </tr>

              <tr id='handout_remark_tr'>
                <td>Handout Remark</td>
                <td id='handout_remark_td'><textarea id="handout_remark" style="display: block; margin-top:10px;" placeholder="Remark" rows="2" cols="38" name="handout_remark"><?php echo $data['handout_remark'];?></textarea></td>
              </tr>

               <tr>
                <td>Next Class Update</td>
                <td><select class="main_form_select" id="Next_Class_Update"  name="next_class_update">
                                <option value="<?php echo $data['next_class_update'];?>"><?php echo $data['next_class_update'];?></option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
								<option value="Not Applicable">Not Applicable</option>
                                
                            </select></td>
              </tr>
              <tr id='next_class_update_remark_tr'>
              <td>Next Class Update Remark</td>
                <td id='next_class_update_remark_td'><textarea id="next_class_remark" style="display: block; margin-top:10px;" placeholder="Remark" rows="2" cols="38" name="next_class_remark"><?php echo $data['next_class_update_remark'];?></textarea></td>
              </tr>
              <tr>
                <td>Testing Query</td>
                <td><select class="main_form_select" id="query_testing" name="query_testing">
                                <option value="<?php echo $data['testing_query'];?>"><?php echo $data['testing_query'];?></option>
                                <option value="Tested">Tested</option>
                                <option value="Not Tested">Not Tested</option>
								<option value="Not Applicable">Not Applicable</option>
                                
                            </select></td>
              </tr>
              <tr id='testing_query_remark_tr'>
               <td>Testing Query Remark</td>
                <td id='testing_query_remark_td'><textarea id="query_testing_remark" style="display: block; margin-top:10px;" placeholder="Remark" rows="2" cols="38" name="testing_query_remark" ><?php echo $data['testing_query_remark'];?></textarea></td>
              </tr>

              <tr>
                <td>Observation During Testing</td>
                <td><textarea rows="4" cols="40" name="observation_during_testing" ><?php echo $data['observation_during_testing'];?></textarea></td>
              </tr>
              <tr id="class_started_tr">
                <td>Class Started At</td>
                <td ><input type="time" value="<?php echo $data['class_started'];?>" name="class_started" id="class_started_td"></td>
              </tr>
              <tr id="class_end_at_tr">
                <td>Class End At</td>
                <td><input type="time" value="<?php echo $data['class_end_at'];?>" name="class_end" id="class_end_at_td"></td>
              </tr>
              <tr id="event_post_update_tr">
                <td>Event Post Update</td>
                <td><select id='select_event_post' class="main_form_select" name="event_post">
            <option value="<?php echo $data['event_post_update'];?>"><?php echo $data['event_post_update'];?></option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            </select></td>
              </tr>
              <tr id='event_post_update_remark_tr'>
              <td>Event Post Update Remark</td>
                <td id='event_post_update_remark_td'><textarea placeholder='Remark' rows='2' cols='38' id='event_post_remark' name="event_post_remark" style='display:block; margin-top:10px;'><?php echo $data['event_post_update_remark'];?></textarea></td>
              </tr>

              <tr id="recorded_video_tr">
                <td>Recorded Video Uploaded</td>
                <td><select id='recorded_video_uploaded' class="main_form_select" name="recorded_video">
            <option value="<?php echo $data['recorded_video_uploaded']; ?>"><?php echo $data['recorded_video_uploaded']; ?></option>
            <option value="Uploaded">Uploaded</option>
            <option value="Not Uploaded">Not Uploaded</option>
            </select></td>
              </tr>
              <tr id="recorded_video_uploaded_time_tr">
                <td>Recorded Video Uploaded Time</td>
                <td><input type="datetime-local" value="<?php echo $data['recorded_video_uploaded_remark']; ?>" name="recoreded_video_uploaded_time" id="recorded_video_uploaded_time"></td>
              </tr>
              <tr id='recorded_video_uploaded_remark_tr'>

            <td>Recorded Video Uploaded Remark</td>
                <td style='recorded_video_uploaded_remark_td'><textarea placeholder='Remark' rows='2' cols='38' id='recorded_video_remark' style='display:block; margin-top:10px;' name="recorded_video_remark"><?php echo $data['recorded_video_remark'];?></textarea></td>
              </tr>
              <tr>
           <th colspan='2'><input type="submit" name="submit" value="Update"></th>
           </tr>
       </table>
     </form>
   </div>
   <script type="text/javascript" src="js/jquery.js"></script>


<script type="text/javascript">
  $(document).ready(function(){

    // on first load page
    var marker_pen = $("#marker_pen").val();
    var pre_synopsis = $("#pre_synopsis").val();
    var Camera_Focous =  $("#Camera_Focous").val();
    var Camera_Battery = $("#Camera_Battery").val();
    var Remote_System_Laptop = $("#Remote_System_Laptop").val();
    var Remote_System_I_pad = $("#Remote_System_I_pad").val();
    var Conved_To_Batch_Coo = $("#Conved_To_Batch_Coo").val();
    var Handout_remark = $("#Handout_remark").val();
    var Next_Class_Update = $("#Next_Class_Update").val();
    var query_testing = $("#query_testing").val();
    var select_event_post = $("#select_event_post").val();

    // for board marker

    if(marker_pen == "Checked"){

      $("#board_remark_tr").hide();


    }else if(marker_pen == "Unchecked"){

     $("#board_remark_tr").show();
    }

    $("#marker_pen").on("click",function(){

      var marker_pen = $("#marker_pen").val();

      if(marker_pen == "Unchecked"){

        $("#board_remark_tr").show();

      }else if(marker_pen == "Checked"){

       $("#board_remark_tr").hide();

      }

    })    

    //for synopsis


    if(pre_synopsis == "No"){

      $("#synopsis_display_remark_tr").show();

    }else if(pre_synopsis == "Yes" || pre_synopsis == "Not Applicable"){

      $("#synopsis_display_remark_tr").hide();
    }

        $("#pre_synopsis").on("click",function(){

      var pre_synopsis = $("#pre_synopsis").val();

      if(pre_synopsis == "No"){

      $("#synopsis_display_remark_tr").show();

    }else if(pre_synopsis == "Yes" || pre_synopsis == "Not Applicable"){

      $("#synopsis_display_remark_tr").hide();
    }

    })

    // for camera focous

    if(Camera_Focous == "correct"){

      $("#camera_focus_remark_tr").hide();

    }else if(Camera_Focous == "incorrect"){

    $("#camera_focus_remark_tr").show();

    }

    $("#Camera_Focous").on("click",function(){

      var Camera_Focous =  $("#Camera_Focous").val();

       if(Camera_Focous == "Correct"){

      $("#camera_focus_remark_tr").hide();

    }else if(Camera_Focous == "Incorrect"){

    $("#camera_focus_remark_tr").show();

    }

    })

    //camera battery

    if(Camera_Battery == "charger pluged"){

      $("#camera_battery_remark_tr").hide();

    }else if(Camera_Battery == "charger not pluged"){

      $("#camera_battery_remark_tr").show();

    }

    $("#Camera_Battery").on("click",function(){
      var Camera_Battery = $("#Camera_Battery").val();
      if(Camera_Battery == "Charger Pluged"){
        $("#camera_battery_remark_tr").hide();
      }else if(Camera_Battery == "Charger Not Pluged"){
        $("#camera_battery_remark_tr").show();
      }
    })

    // remote system laptop

    if(Remote_System_Laptop == "Connected" || Remote_System_Laptop == "Not Applicable"){

      $("#remote_system_laptop_tr").hide();

    }else if(Remote_System_Laptop == "Not Connected"){

      $("#remote_system_laptop_tr").show();

    }

$("#Remote_System_Laptop").on("click",function(){

var Remote_System_Laptop = $("#Remote_System_Laptop").val();

 if(Remote_System_Laptop == "Connected" || Remote_System_Laptop == "Not Applicable"){

      $("#remote_system_laptop_tr").hide();

    }else if(Remote_System_Laptop == "Not Connected"){

      $("#remote_system_laptop_tr").show();

    }

})

// remote system i-pad

if(Remote_System_I_pad == "connected" || Remote_System_I_pad == "Not Applicable"){


$("#remote_system_ipad_remark_tr").hide();

}else if(Remote_System_I_pad == "not connected"){

  $("#remote_system_ipad_remark_tr").show();


}

$("#Remote_System_I_pad").on("click",function(){
   var Remote_System_I_pad = $("#Remote_System_I_pad").val();
  if(Remote_System_I_pad == "Connected" || Remote_System_I_pad == "Not Applicable"){


$("#remote_system_ipad_remark_tr").hide();

}else if(Remote_System_I_pad == "Not Connected"){

  $("#remote_system_ipad_remark_tr").show();


}
})

//batch coordinator convey

if(Conved_To_Batch_Coo == "yes" || Conved_To_Batch_Coo == "Not Required"){

  $("#batch_coordinator_convey_remark_tr").hide();

}else if(Conved_To_Batch_Coo == "no"){

  $("#batch_coordinator_convey_remark_tr").show();
}

$("#Conved_To_Batch_Coo").on("click",function(){
  var Conved_To_Batch_Coo = $("#Conved_To_Batch_Coo").val();
  if(Conved_To_Batch_Coo == "yes" || Conved_To_Batch_Coo == "Not Required"){

  $("#batch_coordinator_convey_remark_tr").hide();

}else if(Conved_To_Batch_Coo == "no"){

  $("#batch_coordinator_convey_remark_tr").show();
}
})

//handout

if(Handout_remark == "uploaded" || Handout_remark == "not uploaded"){

  $("#handout_remark_tr").show();



}else if(Handout_remark == "Not Applicable"){

  $("#handout_remark_tr").hide();

}

$("#Handout_remark").on("click",function(){
  var Handout_remark = $("#Handout_remark").val();

  if(Handout_remark == "Uploaded" || Handout_remark == "Not Uploaded"){

  $("#handout_remark_tr").show();



}else if(Handout_remark == "Not Applicable"){

  $("#handout_remark_tr").hide();

}

})

//next class update

if(Next_Class_Update == "yes" || Next_Class_Update == "Not Applicable"){

$("#next_class_update_remark_tr").hide();

}else if(Next_Class_Update == "no"){

$("#next_class_update_remark_tr").show();

}

$("#Next_Class_Update").on("click",function(){
  var Next_Class_Update = $("#Next_Class_Update").val();
  if(Next_Class_Update == "yes" || Next_Class_Update == "Not Applicable"){

$("#next_class_update_remark_tr").hide();

}else if(Next_Class_Update == "no"){

$("#next_class_update_remark_tr").show();

}

})

//testing query

if(query_testing == "tested" || query_testing == "Not Applicable"){

$("#testing_query_remark_tr").hide();

}else if(query_testing == "not tested"){

$("#testing_query_remark_tr").show();

}

$("#query_testing").on("click",function(){
  var query_testing = $("#query_testing").val();
  if(query_testing == "Tested" || query_testing == "Not Applicable"){

$("#testing_query_remark_tr").hide();

}else if(query_testing == "Not Tested"){

$("#testing_query_remark_tr").show();

}

})

//event post option

if(select_event_post == "yes"){

  $("#event_post_update_remark_tr").hide();

}else if(select_event_post == "no"){

  $("#event_post_update_remark_tr").show();

}else if(select_event_post == ""){

  $("#event_post_update_tr").hide();
  $("#event_post_update_remark_tr").hide();

}



$("#select_event_post").on("click",function(){
   var select_event_post = $("#select_event_post").val();
  if(select_event_post == "Yes"){

  $("#event_post_update_remark_tr").hide();

}else if(select_event_post == "No"){

  $("#event_post_update_remark_tr").show();

}
})

var class_started_data = $("#class_started_td").val();
 if(class_started_data == ""){
    $("#class_started_tr").hide();
 }else{
    $("#class_started_tr").show();
 }

 var class_end_at_td = $("#class_end_at_td").val();
 if(class_end_at_td == ""){
    $("#class_end_at_tr").hide();
 }else{
    $("#class_end_at_tr").show();
 }

var recorded_video =  $("#recorded_video_uploaded").val();
if(recorded_video == ""){

$("#recorded_video_tr").hide();

}else{
    $("#recorded_video_tr").show();
}

var recorded_video_uploaded_time = $("#recorded_video_uploaded_time").val();

if(recorded_video_uploaded_time == ""){

    $("#recorded_video_uploaded_time_tr").hide();

}else{

    $("#recorded_video_uploaded_time_tr").show();

}

var recorded_video_remark = $("#recorded_video_remark").val();
if(recorded_video_remark == ""){

    $("#recorded_video_uploaded_remark_tr").hide();

}else{
    $("#recorded_video_uploaded_remark_tr").show();
}

$("#recorded_video_uploaded").on("click",function(){
	var record_video = $(this).val();
	if(record_video == "Uploaded"){
		$("#recorded_video_uploaded_time_tr").show();
		$("#recorded_video_uploaded_remark_tr").hide();
	}else if(record_video == "Not Uploaded"){
		$("#recorded_video_uploaded_remark_tr").show();
		$("#recorded_video_uploaded_time_tr").hide();
		
	}
})
 

  })
</script>
</body>
</html>
