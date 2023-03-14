<?php 
include('testing_session.php');
include('testing_functions.php');
$checklist_id = $_GET['checklist_id'];

?>
        <html>
        <head>
        <link rel="stylesheet" href="css/checklist_form.css">

            </head>
            <body>
                <form action="insert_checklist.php" method="POST">
                <?php include('testing_navbar.php');
                ?>
                <div class="testing_mode">
                    <label>Testing Type</label>
                    <input type="text" name="type_of_checklist" value="<?php  echo $_GET['checklist_type']?>">
                   
                </div>
                <div class="main_form">
                    <table border="1">
                        <tr>
                            <td>Name of Testing Member</td>
                            <?php $data_from_user_table = data_from_user($user_id);
                              $row = mysqli_num_rows($data_from_user_table);
                              $data_user = mysqli_fetch_assoc($data_from_user_table);
                             ?>
                             
                            <td><input type="text" value="<?php echo $data_user['user_name']; ?>" name="testing_member" ></td>
                            <input type="hidden" value="<?php echo $data_user['user_id']; ?>" name="testing_user_id">
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
                         
                            <td><input type="text" value="<?php echo $data_mon_name['user_name']; ?>" name="monitor_by"></td>
                            <input type="hidden" value="<?php echo $data_mon_name['user_id']; ?>" name="monitor_user_id">
                        </tr>
                        <!--<tr>
                            <td>Class ID From Lecture List</td>
                            <td><input type="text" name="class_id_from_lecture_list" ></td>
                        </tr>-->
                         <tr>
                            <td>Testing Started At</td>
                            <td><input type="datetime-local" name="testing_time_started" required></td>
                        </tr>
                         <tr>
                            <td>Testing End At</td>
                            <td><input type="datetime-local" name="testing_time_end" required></td>
                        </tr>
                          <tr>
                            <td>Venue</td>
                            <?php 
                                 $run_venue = all_data_from_venue();
                                 $row_venue = mysqli_num_rows($run_venue);

                                ?>
                            <td><select class="main_form_select" name="insert_venue" required>

                                <option value="">Select Any One</option>
                                <?php 
                                  for($venue=0; $venue < $row_venue; $venue++){

                                     $data_from_venue = mysqli_fetch_assoc($run_venue);
                                    ?>

                                        <option><?php echo $data_from_venue['venue_name']; ?></option>
                                    <?php
                                   
                                  }
                                 
                                ?>
                               
                            </select></td>
                        </tr>
                         
                        <tr>
                            <td>Subject :</td>
                            <td><select class="main_form_select" name="class" required>
                                <?php 

                                $run_subject = all_data_from_subjects();
                                $row_subject =mysqli_num_rows($run_subject);
                                ?>
                                <option value="">Select Subject Name</option>
                                <?php 
                                for($subject = 0; $subject < $row_subject; $subject++){
                                    $subject_data = mysqli_fetch_assoc($run_subject);?>
                                    <option><?php echo $subject_data['subject_name']; ?></option>

                                    <?php
                                }

                                ?>
                            </select><select style="width: 20%; padding: 10px; margin-left: 5px" name="classnumber">
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
                            <td><select class="main_form_select" name="insert_faculty" required >
                                <option value="">Select Any One</option>
                                <?php 
                                 for($faculty=0; $faculty < $row_faculty; $faculty++){
                                    $data_faculty = mysqli_fetch_assoc($run_faculty);?>

                                     <option><?php echo $data_faculty['faculty_name'];  ?></option>
                                    <?php
                                 }

                                ?>
                            </select></td>
                        </tr>



                        <tr>
                        <td>Batch Coordinator</td>
                         <td>
                                <select class="main_form_select" name="batch_coordinator_avail" required>
                                    <option value="">Select Any One</option>
                                    <option value="Available">Available</option>
                                    <option value="Not Available">Not Available</option>
									<option value="Not Applicable">Not Applicable</option>
                                </select>
                            </td></tr>





                           <tr class="Discussion_disable">
                            <td>Batch Coordinator Name</td>
                            <?php 
                            $run_batch_coordinator = all_data_from_batch_coordinator();
                            $row_batch_coo = mysqli_num_rows($run_batch_coordinator);

                            ?>
                            <td><select class="main_form_select" name="insert_batch_coordinator" required>
                                <option value="">Select Any One</option>
                                <?php 
                                 for($batch_coordinator = 0; $batch_coordinator < $row_batch_coo; $batch_coordinator++){
                                    $data_faculty = mysqli_fetch_assoc($run_batch_coordinator);?>
                                    <option><?php echo $data_faculty['batch_coordinator_name'];?></option>

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
                            <td><select class="main_form_select" name="insert_camera_man" required>
                                <option value="">Select Any One</option>
                                <?php 
                                for($camera_man = 0; $camera_man < $row_camera_man; $camera_man++){
                                    $data_camera_man = mysqli_fetch_assoc($run_camera_name);?>

                                    <option><?php echo $data_camera_man['camera_man_name'];?></option>

                                    <?php
                                }

                                 ?>
                            </select></td>
                        </tr>





                        <tr>
                            <td>Tech Support Person</td>
                            <td>
                                <select class="main_form_select" name="tech_support_person_avail" required>
                                    <option value="">Select Any One</option>
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
                            <td><select name="tech_support_person" class="main_form_select" required>
                                <option value="">Select Any One</option>
                                <?php 
                                 for($tech_person = 0; $tech_person < $row_tech_support_person; $tech_person++){
                                    $data_tech_suppport = mysqli_fetch_assoc($run_tech_support_person);?>

                                    <option><?php echo $data_tech_suppport['Name'];?></option>


                                    <?php


                                 }
                                ?>
                            </select></td>
                        </tr>
                        <tr>
                            <td>Board Marker/Digital Board Pen</td>
                            <td><select name="board_pen_marker" class="main_form_select" id="marker_pen" onclick="board_merker_digital_pen();" required>
                                <option value="">Select Any One</option>
                                <option value="Checked">Checked</option>
                                <option value="Unchecked">Unchecked</option>
                            </select><textarea id="board_pen_marker_remark" style="display: none;margin-top:10px;"placeholder="Remark" rows="2" cols="38" name="insert_board_pen_marker_remark" ></textarea></td>
                        </tr>

                        <tr>
                            <td>Synopsis Display (Previous Class)</td>
                            <td><select name="display_synopsis" class="main_form_select" id="pre_synopsis" onclick="disply_synopsis();" required>
                                <option value="">Select Any One</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
								<option value="Not Applicable">Not Applicable</option>
                            </select><textarea id="display_synopsis_remark" style="display: none;margin-top:10px;"placeholder="Remark" rows="2" cols="38" name="insert_display_synopsis_remark" ></textarea></td>
                        </tr>

                        <tr>
                            <td>Camera Focus</td>
                            <td><select class="main_form_select" id="Camera_Focous" onclick="camera_focous_remark();" name="insert_camera_focous" required>
                                <option value="">Select Any One</option>
                                <option value="Correct">Correct</option>
                                <option value="Incorrect">Incorrect</option>
                            </select><textarea id="Camera_Focous_incorrect_remark" style="display: none;margin-top:10px;"placeholder="Remark" rows="2" cols="38" name="insert_camera_focous_remark" ></textarea></td>
                            
                        </tr>
                         <tr>
                            <td>Camera Battery</td>
                            <td><select class="main_form_select" id="Camera_Battery" onclick="Camera_Battery_remark();" name="insert_camera_battery" required>
                                <option value="">Select Any One</option>
                                <option value="Charger Pluged">Charger Pluged</option>
                                <option value="Charger Not Pluged">Charger Not Pluged</option>
                            </select><textarea id="Camera_Battery_incorrect_remark" style="display: none; margin-top:10px;" placeholder="Remark" rows="2" cols="38" name="insert_camera_battery_remark" ></textarea></td>
                        </tr>
                        <tr>
                            <td>Memory Card</td>
                            <td><select class="main_form_select" id="Memory_Card" onclick="Memory_Card_remark();" name="insert_memory_card" required>
                                <option value="">Select Any One</option>
                                <option value="Inserted">Inserted</option>
                                <option value="Not Inserted">Not Inserted</option>
                            </select><textarea id="memory_card_remark" style="display: none; margin-top:10px;" placeholder="Remark" rows="2" cols="38" name="insert_memory_card_remark" required></textarea></td>
                        </tr>
                        <tr>
                            <td>Audio Live</td>
                            <td><select class="main_form_select" id="Audio_Live" onclick="Audio_Live_remark();" name="insert_audio_live" required>
                                <option value="">Select Any One</option>
                                <option value="Checked">Checked</option>
                                <option value="Unchecked">Unchecked</option>
                            </select><textarea id="audio_live_remark" style="display: none; margin-top:10px;" placeholder="Remark" rows="2" cols="38" name="insert_audio_live_remark" required></textarea></td>
                        </tr>



                          <tr>
                            <td>Mic Testing Done By :</td>
                            <td><select class="main_form_select" name="insert_mic_testing" required>
                                <option value="">Select Any One</option>
                                <option value="Camera man">Camera man</option>
                                <option value="Testing Person"> Testing Person</option>
                                <option value="Faculty">Faculty</option>
                                <option value="Not checked">Not checked</option>
                            </select></td>
                        </tr>



                        <tr>
                            <td>Video Pixxels :</td>
                            <td><select class="main_form_select" name="insert_video_pixxel" required>
                                <option value="">Select Any One</option>
                                <option value="360px, 480px, 720px">360px, 480px, 720px</option>
                                <option value="360px, 480px, 720px, 1080px">360px, 480px, 720px, 1080px</option>
                            </select></td>
                        </tr>
                        <tr>
                            <td> Internet Line :</td>
                            <?php 

                             $run_internet_line = all_data_from_internet();
                             $rows_internet_line = mysqli_num_rows($run_internet_line);
                            ?>
                            <td><select class="main_form_select" name="insert_internet_line" id="internetline" onclick="internet_spd();" required>
                                <option value="">Select Any One</option>
                                <?php 
                                 for($internet_line = 0; $internet_line < $rows_internet_line; $internet_line++){
                                    $data_internet_line = mysqli_fetch_assoc($run_internet_line);
                                    ?>
                                      <option><?php echo $data_internet_line['internet_name']; ?></option>

                                    <?php

                                 }
                                
                                ?></select><textarea id="internet_speed" style="display: none; margin-top:10px;" placeholder="Remark" rows="2" cols="38" name="insert_internet_speed" required></textarea></td>
                        </tr>
                        <tr>
                            <td> Remote System Laptop :</td>
                            <td><select class="main_form_select" id="Remote_System_Laptop" onclick="Remote_System();" name="insert_remote_system_laptop" required>
                                <option value="">Select Any One</option>
                                <option value="Connected">Connected</option>
                                <option value="Not Connected">Not Connected</option>
								<option value="Not Applicable">Not Applicable</option>
                                
                            </select><textarea id="remote_system_remark" style="display: none; margin-top:10px;" placeholder="Remark" rows="2" cols="38" name="insert_remote_laptop_remar" ></textarea></td>
                        </tr>



                         <tr>
                            <td> Remote System I-pad :</td>
                            <td><select class="main_form_select" id="Remote_System_I_pad" onclick="Remote_SystemIpad();" name="remote_system_ipad" required>
                                <option value="">Select Any One</option>
                                <option value="Connected">Connected</option>
                                <option value="Not Connected">Not Connected</option>
                                <option value="Not Applicable">Not Applicable</option>
                                
                            </select><textarea id="remote_system_i_pad_remark" style="display: none; margin-top:10px;" placeholder="Remark" rows="2" cols="38" name="remote_ipad_remark"></textarea></td>
                        </tr>




                         <tr class="Discussion_disable">
                            <td> Prompter Name :</td>
                            <?php 
                                 $run_venue = all_data_from_venue();
                                 $row_venue = mysqli_num_rows($run_venue);

                                ?>
                                <td><select class="main_form_select" name="insert_prompter" required>

                                <option value="">Select Any One</option>
                                <?php 
                                  for($venue=0; $venue < $row_venue; $venue++){

                                     $data_from_venue = mysqli_fetch_assoc($run_venue);
                                    ?>

                                        <option><?php echo $data_from_venue['venue_name']; ?></option>
                                    <?php
                                   
                                  }
                                 
                                ?></select></td>
                        </tr>
                        <tr class="Discussion_disable">
                            <td> Convey To Batch Coo. :</td>
                            <td><select class="main_form_select" id="Conved_To_Batch_Coo" onclick="Conved_To_BatchCoo();" name="convey_to_bcoo" required >
                                <option value="">Select Any One</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
								<option value="Not Required">Not Required</option>
                                
                            </select><textarea id="Conved_To_Batch_Coo_remark" style="display: none; margin-top:10px;" placeholder="Remark" rows="2" cols="38" name="convey_to_bcoo_remark" ></textarea></td>
                        </tr>
                        <tr>
                            <td> Handout :</td>
                            <td><select class="main_form_select" id="Handout_remark" onclick="Handout_mark();" name="handout" required>
                                <option value="">Select Any One</option>
                                <option value="Uploaded">Uploaded</option>
                                <option value="Not Uploaded">Not Uploaded</option>
                                <option value="Not Applicable">Not Applicable</option>
                                
                            </select><textarea id="handout_remark" style="display: none; margin-top:10px;" placeholder="Remark" rows="2" cols="38" name="handout_remark"></textarea></td>
                        </tr>
                         <tr class="Discussion_disable">
                            <td> Next Class Update:</td>
                            <td><select class="main_form_select" id="Next_Class_Update" onclick="Next_Class();" name="next_class_update" required>
                                <option value="">Select Any One</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
								<option value="Not Applicable">Not Applicable</option>
                                
                            </select><textarea id="next_class_remark" style="display: none; margin-top:10px;" placeholder="Remark" rows="2" cols="38" name="next_class_remark"></textarea></td>
                        </tr>
                         <tr class="Discussion_disable">
                            <td> Query Testing:</td>
                            <td><select class="main_form_select" id="query_testing" onclick="query_testing_check();" name="query_testing" required>
                                <option value="">Select Any One</option>
                                <option value="Tested">Tested</option>
                                <option value="Not Tested">Not Tested</option>
								<option value="Not Applicable">Not Applicable</option>
                                
                            </select><textarea id="query_testing_remark" style="display: none; margin-top:10px;" placeholder="Remark" rows="2" cols="38" name="testing_query_remark" ></textarea></td>
                        </tr>
                        <tr>
                            <td>Live Streaming Started</td>
                            <td><input type="time" name="live_started_at" required></td>
                        </tr>
                        <tr>
                            <th colspan="2">Observation</th>
                        </tr>
                        <tr>
                            <td>During Testing</td>
                            <td><textarea rows="4" cols="40" name="observation_during_testing" required></textarea>
                            </td>
                        </tr>
                        
                  
                         <tr>
                            <input type="hidden" name ='checklist_id' value="<?php echo $_GET['checklist_id']?>">
                            <th><input type="reset"></th>
                            <th><input type="Submit" name="submit"></th>
                        </tr>
                    </table>
                </div>
            </form>
        <script src="js/checklist_form.js">
            
        </script>
<?php mysqli_close($connect); ?>
            </body>
        </html>