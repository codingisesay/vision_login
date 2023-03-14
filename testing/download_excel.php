<?php 
include('testing_session.php');
include('testing_functions.php');
//mysqli_close($connect);

?>

<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    include('../database_connection.php');
    $checklist_id = $_GET['checklist_id'];
    $q="SELECT `checklist_record`.*, `user`.`user_name`,`remark`.* FROM `checklist_record` LEFT JOIN `user` ON `checklist_record`.`testing_mamber` = `user`.`user_id` LEFT JOIN `remark` ON `checklist_record`.`checklist_id` = `remark`.`checklist_id` WHERE checklist_record.checklist_id = '$checklist_id'";
    $run = mysqli_query($connect,$q);
    $row = mysqli_num_rows($run);
	//mysqli_close($connect);
    if($row == 1){
        $checklist_data = mysqli_fetch_assoc($run);
        ob_clean();
        
        header("Content-Disposition: attachment; filename=abc.xls"); 
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        
?>
<head>

  
    </head>
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
                <td><?php echo $checklist_data['batch']; ?></td>
              </tr>
              <tr>
                <td>Subject</td>
                <td><?php echo $checklist_data['subject']; ?></td>
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


              <?php if($checklist_data['board_marker_pen_remark'] == ""){?>
                <tr style="display: none;">

                <?php


              }else if($checklist_data['board_marker_pen_remark'] !== ""){?>
                <tr style="display: block;">

                <?php

              }?>
               
                <td>Board Remark</td>
                <td id="board_remark_td"><?php echo $checklist_data['board_marker_pen_remark']; ?></td>
              </tr>

              <tr>
                <td>Synopsis Display</td>
                <td><?php echo $checklist_data['display_synopsis']; ?></td>

              </tr>


              <?php if($checklist_data['synopsis_display_remark'] == ""){?>
                <tr style="display:none;">
                  <?php

              }else if($checklist_data['synopsis_display_remark'] !== ""){?>

                <tr style="display:block;">

                <?php

              }?>
                <td>Synopsis Display Remark</td>
                <td id="synopsis_display_remark_td"><?php echo $checklist_data['synopsis_display_remark']; ?></td>
              </tr>

              <tr>
                <td>Camera Focus</td>
                <td><?php echo $checklist_data['camera_focus']; ?></td>
              </tr>
              <?php  if($checklist_data['camera_focus_remark'] == ""){?>
                  <tr style="display: none;"> 
                <?php
                }else if($checklist_data['camera_focus_remark'] !== ""){?>

                    <tr style="display: block;">
                  <?php

                } ?> 
                <td>Camera Focus Remark</td>
                <td id="camera_focous_remark_td"><?php echo $checklist_data['camera_focus_remark']; ?></td>
              </tr>
              <tr>
                <td>Camera Battery</td>
                <td><?php echo $checklist_data['camera_battery']; ?></td>
              </tr>

              <?php  if($checklist_data['camera_battery_remark'] == ""){?>
                <tr style="display: none;">
                <?php

              }else if($checklist_data['camera_battery_remark'] !== ""){?>

                 <tr style="display: block;">
                <?php

              } ?>
              
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
              <?php if($checklist_data['remote_system_laptop_remark'] == ""){?>

                <tr style="display: none;">
                <?php

              }else if($checklist_data['remote_system_laptop_remark'] !== ""){?>
                <tr style="display: block;">
                <?php

              } ?>
              
                <td>Remote System Laptop Remark</td>
                <td id="remote_system_laptop_remark_td"><?php echo $checklist_data['remote_system_laptop_remark']; ?></td>
              </tr>
               <tr >
                <td>Remote System ipad</td>
                <td><?php echo $checklist_data['remote_system_ipad']; ?></td>
              </tr>
              <?php if($checklist_data['remote_system_ipad_remark'] == ""){?>

                <tr style="display: none">
                <?php

              }else if($checklist_data['remote_system_ipad_remark'] !== ""){?>
                <tr style="display: block">
                <?php

              }?>
               
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
              <?php if($checklist_data['batch_coordinator_convey_remark'] == ""){?>
                 <tr style="display: none;">
                <?php

              }else if($checklist_data['batch_coordinator_convey_remark'] !== ""){?>
                  <tr style="display: block;">
                <?php

              }?>
               
                <td>Batch Coordinator Convey Remark</td>
                <td id="batch_coordinator_convey_remark_td"><?php echo $checklist_data['batch_coordinator_convey_remark']; ?></td>
              </tr>
              <tr>
                <td>Handout</td>
                <td><?php echo $checklist_data['handout']; ?></td>
              </tr>
             <?php if($checklist_data['handout_remark'] == ""){?>

               <tr style="display:none;">

              <?php



             }else if($checklist_data['handout_remark'] != ""){?>

              <tr style="display:block;">
              <?php


             }?>
              
                <td>Handout Remark</td>
                <td><?php echo $checklist_data['handout_remark']; ?></td>
              </tr>
              <tr>
                <td>Next Class Update</td>
                <td><?php echo $checklist_data['next_class_update']; ?></td>
              </tr>
              <?php if($checklist_data['next_class_update_remark'] == ""){?>
                 <tr style="display: none;">
                <?php

              }else if($checklist_data['next_class_update_remark'] !== ""){?>
                <tr style="display: block;">
                <?php

              } ?>
              
                <td>Next Class Update Remark</td>
                <td id="next_clas_td"><?php echo $checklist_data['next_class_update_remark']; ?>
                </td>
              </tr>
              <tr>
                <td>Testing Query</td>
                <td><?php echo $checklist_data['testing_query']; ?></td>
              </tr>

              <tr>
                <td>Live Stream Started:</td>
                <td><?php echo $checklist_data['live_started_at'];?></td>
              </tr>
              <tr>
                <td>Checklist Submit Time:</td>
                <td><?php echo $checklist_data['submit_checklist_time'];?></td>
              </tr>





              <?php if($checklist_data['testing_query_remark'] == ""){?>
                <tr style="display: none;">
                <?php


              }else if($checklist_data['testing_query_remark'] !== ""){?>
                 <tr style="display: block;">
                <?php

              } ?>
               
                <td>Testing Query Remark</td>
                <td id="testing_query_remark_td"><?php echo $checklist_data['testing_query_remark']; ?></td>
              </tr>
              <tr>
                <td>Observation During Testing</td>
                <td><?php echo $checklist_data['observation_during_testing']; ?></td>
              </tr>
            </table>
              <script>

              
            </script>
            
         </body>
<?php 


    
}
mysqli_close($connect);
?>