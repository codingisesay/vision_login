<?php 
include('testing_session.php');
 mysqli_close($connect);

?>


  <?php 
  include('../database_connection.php');
  include('testing_functions.php');

  $checklist_type = trim(mysqli_real_escape_string($connect,$_POST['type_of_checklist']));

  $testing_member = trim(mysqli_real_escape_string($connect,$_POST['testing_user_id']));
  $monitor_user_id = trim(mysqli_real_escape_string($connect,$_POST['monitor_user_id']));

  $testing_time_started = trim(mysqli_real_escape_string($connect,$_POST['testing_time_started']));
  $testing_time_end = trim(mysqli_real_escape_string($connect,$_POST['testing_time_end']));
  $insert_venue = trim(mysqli_real_escape_string($connect,$_POST['insert_venue']));
  $class = trim($_POST['class']).'-'.trim($_POST['classnumber']);
  $insert_faculty = trim(mysqli_real_escape_string($connect,$_POST['insert_faculty']));


  $insert_batch_coordinator_avail = trim(mysqli_real_escape_string($connect,$_POST['batch_coordinator_avail']));


  $insert_batch_coordinator = trim(mysqli_real_escape_string($connect,$_POST['insert_batch_coordinator']));
  $insert_camera_man = trim(mysqli_real_escape_string($connect,$_POST['insert_camera_man']));

  
  $insert_tech_support_person_avail = trim(mysqli_real_escape_string($connect,$_POST['tech_support_person_avail']));

  $insert_tech_support_person = trim(mysqli_real_escape_string($connect,$_POST['tech_support_person']));
  $insert_board_marker_pen = trim(mysqli_real_escape_string($connect,$_POST['board_pen_marker']));
  $insert_display_synopsis = trim(mysqli_real_escape_string($connect,$_POST['display_synopsis']));


  $insert_camera_focous = trim(mysqli_real_escape_string($connect,$_POST['insert_camera_focous']));
  $insert_camera_battery = trim(mysqli_real_escape_string($connect,$_POST['insert_camera_battery']));
  $insert_memory_card = trim(mysqli_real_escape_string($connect,$_POST['insert_memory_card']));
  $insert_memory_card_remark = trim(mysqli_real_escape_string($connect,$_POST['insert_memory_card_remark']));
  $insert_audio_live = trim(mysqli_real_escape_string($connect,$_POST['insert_audio_live']));
  $insert_audio_live_remark = trim(mysqli_real_escape_string($connect,$_POST['insert_audio_live_remark']));
  $insert_mic_testing = trim(mysqli_real_escape_string($connect,$_POST['insert_mic_testing']));
  $insert_video_pixxel = trim(mysqli_real_escape_string($connect,$_POST['insert_video_pixxel']));
  $insert_internet_line = trim(mysqli_real_escape_string($connect,$_POST['insert_internet_line']));
  $insert_internet_speed = trim(mysqli_real_escape_string($connect,$_POST['insert_internet_speed']));
  $insert_remote_system_laptop = trim(mysqli_real_escape_string($connect,$_POST['insert_remote_system_laptop']));
  $remote_system_ipad = trim(mysqli_real_escape_string($connect,$_POST['remote_system_ipad']));
  $remote_ipad_remark = trim(mysqli_real_escape_string($connect,$_POST['remote_ipad_remark']));
  $prompter_name = trim(mysqli_real_escape_string($connect,$_POST['insert_prompter']));
  $convey_to_bcoo = trim(mysqli_real_escape_string($connect,$_POST['convey_to_bcoo']));
  $handout = trim(mysqli_real_escape_string($connect,$_POST['handout']));
  $handout_remark = trim(mysqli_real_escape_string($connect,$_POST['handout_remark']));
  $next_class_update = trim(mysqli_real_escape_string($connect,$_POST['next_class_update']));
  $query_testing = trim(mysqli_real_escape_string($connect,$_POST['query_testing']));

  $live_started_at = trim(mysqli_real_escape_string($connect,$_POST['live_started_at']));

  $observation_during_testing = trim(mysqli_real_escape_string($connect,$_POST['observation_during_testing']));
  $checklist_id = trim($_POST['checklist_id']);
  date_default_timezone_set("Asia/Kolkata");
  $submit_checklist_time = date("H:i:s");


  if(isset($_POST['submit']) && isset($checklist_type,$testing_time_started,$testing_time_end,$insert_venue,$class,$insert_faculty,$insert_batch_coordinator_avail,$insert_batch_coordinator,$insert_camera_man,$insert_tech_support_person_avail,$insert_tech_support_person,$insert_board_marker_pen,$insert_display_synopsis,$insert_camera_focous,$insert_camera_battery,$insert_memory_card,$insert_memory_card_remark,$insert_audio_live,$insert_audio_live_remark,$insert_mic_testing,$insert_video_pixxel,$insert_internet_line,$insert_internet_speed,$insert_remote_system_laptop,$remote_system_ipad,$remote_ipad_remark,$prompter_name,$convey_to_bcoo,$handout,$handout_remark,$next_class_update,$query_testing,$live_started_at,$observation_during_testing,$submit_checklist_time)){


    $q="UPDATE checklist_record
        SET checklist_type = '$checklist_type', testing_mamber = '$testing_member', monitor_by = '$monitor_user_id', testing_started_at = '$testing_time_started', 
        testing_end_at = '$testing_time_end', venue = '$insert_venue', subject = '$class', 
        faculty = '$insert_faculty',   coordinator_presence = '$insert_batch_coordinator_avail',
         batch_coordinator = '$insert_batch_coordinator', cameraman = '$insert_camera_man', 
         tech_support_presence = '$insert_tech_support_person_avail', tech_support_person = '$insert_tech_support_person', 
         board_marker_pen = '$insert_board_marker_pen', display_synopsis = '$insert_display_synopsis', 
         camera_focus = '$insert_camera_focous', camera_battery = '$insert_camera_battery',
          memnory_card = '$insert_memory_card', memnory_card_remark = '$insert_memory_card_remark',
           audio_live = '$insert_audio_live', audio_level_remark = '$insert_audio_live_remark',
            mic_testing_done_by = '$insert_mic_testing', video_pixxel = '$insert_video_pixxel', 
            internet_line = '$insert_internet_line', internet_speed = '$insert_internet_speed',
             remote_system_laptop = '$insert_remote_system_laptop', 
             remote_system_ipad = '$remote_system_ipad',remote_system_ipad_remark = '$remote_ipad_remark', 
             prompter_name = '$prompter_name', batch_coordinator_convey = '$convey_to_bcoo', handout = '$handout',
             handout_remark = '$handout_remark', next_class_update = '$next_class_update', 
             testing_query = '$query_testing', live_started_at = '$live_started_at',
             observation_during_testing = '$observation_during_testing',
            submit_checklist_time = '$submit_checklist_time' WHERE checklist_id = '$checklist_id'";
      

      $insert_record = mysqli_query($connect,$q);

      if($insert_record == true){


          $insert_board_pen_marker_remark = trim(mysqli_real_escape_string($connect,$_POST['insert_board_pen_marker_remark']));
          $insert_display_synopsis_remark = trim(mysqli_real_escape_string($connect,$_POST['insert_display_synopsis_remark']));

          $insert_camera_focous_remark = trim(mysqli_real_escape_string($connect,$_POST['insert_camera_focous_remark']));
          $insert_camera_battery_remark = trim(mysqli_real_escape_string($connect,$_POST['insert_camera_battery_remark']));
          $insert_remote_laptop_remar = trim(mysqli_real_escape_string($connect,$_POST['insert_remote_laptop_remar']));
          $convey_to_bcoo_remark = trim(mysqli_real_escape_string($connect,$_POST['convey_to_bcoo_remark']));
          $next_class_remark = trim(mysqli_real_escape_string($connect,$_POST['next_class_remark']));
          $testing_query_remark = trim(mysqli_real_escape_string($connect,$_POST['testing_query_remark']));

          if($insert_board_pen_marker_remark !=="" || $insert_display_synopsis_remark !== "" || $insert_camera_focous_remark !== "" || $insert_camera_battery_remark !== "" || $insert_remote_laptop_remar !== "" || $convey_to_bcoo_remark !== "" || $next_class_remark !== "" || $testing_query_remark !== ""){

            $query ="INSERT INTO remark (board_marker_pen_remark, synopsis_display_remark, camera_focus_remark,camera_battery_remark,remote_system_laptop_remark, batch_coordinator_convey_remark,next_class_update_remark,testing_query_remark,checklist_id) VALUES ('$insert_board_pen_marker_remark','$insert_display_synopsis_remark','$insert_camera_focous_remark','$insert_camera_battery_remark','$insert_remote_laptop_remar','$convey_to_bcoo_remark','$next_class_remark','$testing_query_remark','$checklist_id')";

            mysqli_query($connect,$query);
			mysqli_close($connect);

          }

          download_checklist($checklist_id);
		  

      }else{

       echo "Record Not Inserted success";

      }
    }
  ?>