  <?php 
include('testing_session.php');
include('testing_functions.php');

?>
<?php
if(isset($_POST['submit'])){

	$checklist_id = mysqli_real_escape_string($connect,$_POST['checklist_id']);
	$class_date = mysqli_real_escape_string($connect,$_POST['class_date']);
	$select_time_slot = mysqli_real_escape_string($connect,$_POST['select_time_slot']);
	$checklist_type = mysqli_real_escape_string($connect,$_POST['checklist_type']);
	$testing_member = mysqli_real_escape_string($connect,$_POST['testing_member']);
	$class_id_from_lecture_list = mysqli_real_escape_string($connect,$_POST['class_id_from_lecture_list']);
	$testing_started_at = mysqli_real_escape_string($connect,$_POST['testing_started_at']);
	$testing_end_at = mysqli_real_escape_string($connect,$_POST['testing_end_at']);
	$insert_venue = mysqli_real_escape_string($connect,$_POST['insert_venue']);
	$insert_batch = mysqli_real_escape_string($connect,$_POST['insert_batch']);
	$subject_name_number = mysqli_real_escape_string($connect,$_POST['subject_name'])."".mysqli_real_escape_string($connect,$_POST['classnumber']);

	$insert_faculty = mysqli_real_escape_string($connect,$_POST['insert_faculty']);
	$batch_coordinator_avail = mysqli_real_escape_string($connect,$_POST['batch_coordinator_avail']);
	$insert_batch_coordinator = mysqli_real_escape_string($connect,$_POST['insert_batch_coordinator']);
	$insert_camera_man = mysqli_real_escape_string($connect,$_POST['insert_camera_man']);
	$tech_support_person_avail = mysqli_real_escape_string($connect,$_POST['tech_support_person_avail']);
	$tech_support_person = mysqli_real_escape_string($connect,$_POST['tech_support_person']);
	$board_pen_marker = mysqli_real_escape_string($connect,$_POST['board_pen_marker']);
	
	$display_synopsis = mysqli_real_escape_string($connect,$_POST['display_synopsis']);
	
	$insert_camera_focous = mysqli_real_escape_string($connect,$_POST['insert_camera_focous']);
	
	$insert_camera_battery = mysqli_real_escape_string($connect,$_POST['insert_camera_battery']);
	
	$insert_memory_card = mysqli_real_escape_string($connect,$_POST['insert_memory_card']);
	$insert_memory_card_remark = mysqli_real_escape_string($connect,$_POST['insert_memory_card_remark']);
	$insert_audio_live = mysqli_real_escape_string($connect,$_POST['insert_audio_live']);
	$insert_audio_live_remark = mysqli_real_escape_string($connect,$_POST['insert_audio_live_remark']);
	$insert_mic_testing = mysqli_real_escape_string($connect,$_POST['insert_mic_testing']);
	$insert_video_pixxel = mysqli_real_escape_string($connect,$_POST['insert_video_pixxel']);
	$insert_internet_line = mysqli_real_escape_string($connect,$_POST['insert_internet_line']);
	$insert_internet_speed = mysqli_real_escape_string($connect,$_POST['insert_internet_speed']);
	$insert_remote_system_laptop = mysqli_real_escape_string($connect,$_POST['insert_remote_system_laptop']);
	
	$remote_system_ipad = mysqli_real_escape_string($connect,$_POST['remote_system_ipad']);
	$remote_ipad_remark = mysqli_real_escape_string($connect,$_POST['remote_ipad_remark']);
	$insert_prompter = mysqli_real_escape_string($connect,$_POST['insert_prompter']);
	$convey_to_bcoo = mysqli_real_escape_string($connect,$_POST['convey_to_bcoo']);
	
	$handout = mysqli_real_escape_string($connect,$_POST['handout']);
	$handout_remark = mysqli_real_escape_string($connect,$_POST['handout_remark']);
	$next_class_update = mysqli_real_escape_string($connect,$_POST['next_class_update']);
	
	$query_testing = mysqli_real_escape_string($connect,$_POST['query_testing']);
	
	$observation_during_testing = mysqli_real_escape_string($connect,$_POST['observation_during_testing']);
	$class_started = mysqli_real_escape_string($connect,$_POST['class_started']);

	$class_end = mysqli_real_escape_string($connect,$_POST['class_end']);
	$event_post = mysqli_real_escape_string($connect,$_POST['event_post']);
	
	$recorded_video = mysqli_real_escape_string($connect,$_POST['recorded_video']);
	$recoreded_video_uploaded_time = mysqli_real_escape_string($connect,$_POST['recoreded_video_uploaded_time']);


	// remark colum

  $insert_board_pen_marker_remark = mysqli_real_escape_string($connect,$_POST['insert_board_pen_marker_remark']);
  $insert_display_synopsis_remark = mysqli_real_escape_string($connect,$_POST['insert_display_synopsis_remark']);
  $insert_camera_focous_remark = mysqli_real_escape_string($connect,$_POST['insert_camera_focous_remark']);
  $insert_camera_battery_remark = mysqli_real_escape_string($connect,$_POST['insert_camera_battery_remark']);
  $insert_remote_laptop_remar = mysqli_real_escape_string($connect,$_POST['insert_remote_laptop_remar']);
  $convey_to_bcoo_remark = mysqli_real_escape_string($connect,$_POST['convey_to_bcoo_remark']);
  $next_class_remark = mysqli_real_escape_string($connect,$_POST['next_class_remark']);
  $testing_query_remark = mysqli_real_escape_string($connect,$_POST['testing_query_remark']);
  $event_post_remark = mysqli_real_escape_string($connect,$_POST['event_post_remark']);
  $recorded_video_remark = mysqli_real_escape_string($connect,$_POST['recorded_video_remark']);
	

	
//for create class
if($testing_started_at == "" && isset($class_date,$select_time_slot,$checklist_type,$testing_member,$class_id_from_lecture_list,$insert_venue,$insert_batch)){

	$query_u = "UPDATE checklist_record SET class_date = '$class_date',checklist_type = '$checklist_type', testing_mamber = '$testing_member',class_id_from_lecture_list = '$class_id_from_lecture_list', time_slot = '$select_time_slot',venue = '$insert_venue', batch = '$insert_batch' WHERE checklist_id = '$checklist_id'";
	$run_update = mysqli_query($connect,$query_u);
	if($run_update){?>

     <script type="text/javascript">
     	alert("Record Updated");
     	location.replace("index.php");
     </script>

		<?php


	}else {?>

<script type="text/javascript">
	alert("Record Not Updated");
	location.replace("index.php");
</script>

	<?php

	}

// for observation_during_testing
}else if($testing_started_at !== "" && $class_started == "" && $class_end == "" && $event_post == "" && $recorded_video == "" && $recoreded_video_uploaded_time == "" && isset($checklist_id,$class_date,$select_time_slot,$checklist_type,$testing_member,$class_id_from_lecture_list,$testing_started_at,$testing_end_at,$insert_venue,$insert_batch,$subject_name_number,$insert_faculty,$batch_coordinator_avail,$insert_batch_coordinator,$insert_camera_man,$tech_support_person_avail,$tech_support_person,$board_pen_marker,$display_synopsis,$insert_camera_focous,$insert_camera_battery,$insert_memory_card,$insert_memory_card_remark,$insert_audio_live,$insert_audio_live_remark,$insert_mic_testing,$insert_video_pixxel,$insert_internet_line,$insert_internet_speed,$insert_remote_system_laptop,$remote_system_ipad,$remote_ipad_remark,$insert_prompter,$convey_to_bcoo,$handout,$handout_remark,$next_class_update,$query_testing,$observation_during_testing)){

$query = "UPDATE checklist_record SET
       class_date = '$class_date',
       time_slot = '$select_time_slot',
       checklist_type = '$checklist_type',
       testing_mamber ='$testing_member',
       class_id_from_lecture_list = '$class_id_from_lecture_list',
       testing_started_at = '$testing_started_at',
       testing_end_at = '$testing_end_at',
       venue = '$insert_venue',
       batch = '$insert_batch',
       subject = '$subject_name_number',
       faculty = '$insert_faculty',
       coordinator_presence = '$batch_coordinator_avail',
       batch_coordinator = '$insert_batch_coordinator',
       cameraman = '$insert_camera_man',
       tech_support_presence = '$tech_support_person_avail',
       tech_support_person = '$tech_support_person',
       board_marker_pen = '$board_pen_marker',
       display_synopsis = '$display_synopsis',
       camera_focus = '$insert_camera_focous',
       camera_battery = '$insert_camera_battery',
       memnory_card = '$insert_memory_card',
       memnory_card_remark = '$insert_memory_card_remark',
       audio_live = '$insert_audio_live',
       audio_level_remark = '$insert_audio_live_remark',
       mic_testing_done_by = '$insert_mic_testing',
       video_pixxel = '$insert_video_pixxel',
       internet_line = '$insert_internet_line',
       internet_speed = '$insert_internet_speed',
       remote_system_laptop = '$insert_remote_system_laptop',
       remote_system_ipad = '$remote_system_ipad',
       remote_system_ipad_remark = '$remote_ipad_remark',
       prompter_name = '$insert_prompter',
       batch_coordinator_convey = '$convey_to_bcoo',
       handout = '$handout',
       handout_remark = '$handout_remark',
       next_class_update = '$next_class_update',
       testing_query = '$query_testing',
       observation_during_testing = '$observation_during_testing'
       WHERE checklist_id = '$checklist_id'";

$run_after_testing = mysqli_query($connect,$query);
 	
if($run_after_testing){

 $query_for_remark_checklist_id = "SELECT * FROM remark WHERE checklist_id = '$checklist_id'";
  $run_for_remark_checklist_id = mysqli_query($connect,$query_for_remark_checklist_id);
  $row_for_remark_checklist_id = mysqli_num_rows($run_for_remark_checklist_id);

  if($row_for_remark_checklist_id == 1){
   $query_remark_update = "UPDATE remark SET 
            board_marker_pen_remark = '$insert_board_pen_marker_remark',
            synopsis_display_remark = '$insert_display_synopsis_remark',
            camera_focus_remark = '$insert_camera_focous_remark',
            camera_battery_remark = '$insert_camera_battery_remark',
            remote_system_laptop_remark = '$insert_remote_laptop_remar',
            batch_coordinator_convey_remark = '$convey_to_bcoo_remark',
            next_class_update_remark = '$next_class_remark ',
            testing_query_remark = '$testing_query_remark',
            event_post_update_remark = '$event_post_remark',
            recorded_video_remark = '$recorded_video_remark' WHERE checklist_id = '$checklist_id'";

            $run_remark_update = mysqli_query($connect,$query_remark_update);

            if($run_remark_update){?>

               <script type="text/javascript">
                alert("Record Updated");
                location.replace("index.php");
               </script>

              <?php

            }else{?>

                <script type="text/javascript">
                alert("Record Not Updated");
                location.replace("index.php");
               </script>

              <?php
              

            }



  }else if($row_for_remark_checklist_id == 0){

  	if($insert_board_pen_marker_remark !== "" || $insert_display_synopsis_remark !== "" || $insert_camera_focous_remark !== "" || $insert_camera_battery_remark !== "" || $insert_remote_laptop_remar !== "" || $convey_to_bcoo_remark !== "" || $next_class_remark !== "" || $testing_query_remark !== "" || $event_post_remark !== "" || $recorded_video_remark !== ""){

  		 $query_insert_remark = "INSERT INTO remark (board_marker_pen_remark, synopsis_display_remark,   camera_focus_remark, camera_battery_remark, remote_system_laptop_remark, batch_coordinator_convey_remark, next_class_update_remark, testing_query_remark, event_post_update_remark, recorded_video_remark,checklist_id) VALUES ('$insert_board_pen_marker_remark','$insert_display_synopsis_remark','$insert_camera_focous_remark','$insert_camera_battery_remark','$insert_remote_laptop_remar','$convey_to_bcoo_remark','$next_class_remark','$testing_query_remark','$event_post_remark','$recorded_video_remark','$checklist_id')";

    $run_insert_remark = mysqli_query($connect,$query_insert_remark);

    if($run_insert_remark){?>
             <script type="text/javascript">
              alert("Record Updated");
              location.replace("index.php");
             </script>

      <?php
  	}

   

    }else{?>

     <script type="text/javascript">
              alert("Record Updated");
              location.replace("index.php");
             </script>


      <?php

    }



  }

   

}else{?>

<script type="text/javascript">
	alert("Record Nottttt Updated");
	location.replace("index.php");
</script>

	<?php

}


// for class started
}else if($testing_started_at !== "" && $class_started !== "" && $class_end == "" && $event_post == "" && $recorded_video == "" && $recoreded_video_uploaded_time == "" && isset($checklist_id,$class_date,$select_time_slot,$checklist_type,$testing_member,$class_id_from_lecture_list,$testing_started_at,$testing_end_at,$insert_venue,$insert_batch,$subject_name_number,$insert_faculty,$batch_coordinator_avail,$insert_batch_coordinator,$insert_camera_man,$tech_support_person_avail,$tech_support_person,$board_pen_marker,$display_synopsis,$insert_camera_focous,$insert_camera_battery,$insert_memory_card,$insert_memory_card_remark,$insert_audio_live,$insert_audio_live_remark,$insert_mic_testing,$insert_video_pixxel,$insert_internet_line,$insert_internet_speed,$insert_remote_system_laptop,$remote_system_ipad,$remote_ipad_remark,$insert_prompter,$convey_to_bcoo,$handout,$handout_remark,$next_class_update,$query_testing,$observation_during_testing,$class_started)){
	
	$query = "UPDATE checklist_record SET
       class_date = '$class_date',
       time_slot = '$select_time_slot',
       checklist_type = '$checklist_type',
       testing_mamber ='$testing_member',
       class_id_from_lecture_list = '$class_id_from_lecture_list',
       testing_started_at = '$testing_started_at',
       testing_end_at = '$testing_end_at',
       venue = '$insert_venue',
       batch = '$insert_batch',
       subject = '$subject_name_number',
       faculty = '$insert_faculty',
       coordinator_presence = '$batch_coordinator_avail',
       batch_coordinator = '$insert_batch_coordinator',
       cameraman = '$insert_camera_man',
       tech_support_presence = '$tech_support_person_avail',
       tech_support_person = '$tech_support_person',
       board_marker_pen = '$board_pen_marker',
       display_synopsis = '$display_synopsis',
       camera_focus = '$insert_camera_focous',
       camera_battery = '$insert_camera_battery',
       memnory_card = '$insert_memory_card',
       memnory_card_remark = '$insert_memory_card_remark',
       audio_live = '$insert_audio_live',
       audio_level_remark = '$insert_audio_live_remark',
       mic_testing_done_by = '$insert_mic_testing',
       video_pixxel = '$insert_video_pixxel',
       internet_line = '$insert_internet_line',
       internet_speed = '$insert_internet_speed',
       remote_system_laptop = '$insert_remote_system_laptop',
       remote_system_ipad = '$remote_system_ipad',
       remote_system_ipad_remark = '$remote_ipad_remark',
       prompter_name = '$insert_prompter',
       batch_coordinator_convey = '$convey_to_bcoo',
       handout = '$handout',
       handout_remark = '$handout_remark',
       next_class_update = '$next_class_update',
       testing_query = '$query_testing',
       observation_during_testing = '$observation_during_testing',
	   class_started = '$class_started'
       WHERE checklist_id = '$checklist_id'";

$run_after_testing = mysqli_query($connect,$query);

if($run_after_testing){
	$query_for_remark_checklist_id = "SELECT * FROM remark WHERE checklist_id = '$checklist_id'";
  $run_for_remark_checklist_id = mysqli_query($connect,$query_for_remark_checklist_id);
  $row_for_remark_checklist_id = mysqli_num_rows($run_for_remark_checklist_id);
  
  if($row_for_remark_checklist_id == 0){
	  if($insert_board_pen_marker_remark !== "" || $insert_display_synopsis_remark !== "" || $insert_camera_focous_remark !== "" || $insert_camera_battery_remark !== "" || $insert_remote_laptop_remar !== "" || $convey_to_bcoo_remark !== "" || $next_class_remark !== "" || $testing_query_remark !== "" || $event_post_remark !== "" || $recorded_video_remark !== ""){
		  $query_insert_remark = "INSERT INTO remark (board_marker_pen_remark, synopsis_display_remark,   camera_focus_remark, camera_battery_remark, remote_system_laptop_remark, batch_coordinator_convey_remark, next_class_update_remark, testing_query_remark, event_post_update_remark, recorded_video_remark,checklist_id) VALUES ('$insert_board_pen_marker_remark','$insert_display_synopsis_remark','$insert_camera_focous_remark','$insert_camera_battery_remark','$insert_remote_laptop_remar','$convey_to_bcoo_remark','$next_class_remark','$testing_query_remark','$event_post_remark','$recorded_video_remark','$checklist_id')";

    $run_insert_remark = mysqli_query($connect,$query_insert_remark);
	
	if($run_insert_remark){?>
	 <script type="text/javascript">
              alert("Record Updated");
              location.replace("index.php");
             </script>
	
	<?php
		
	}
		  
		  
	  }else{?>
	 <script type="text/javascript">
              alert("Record Updated");
              location.replace("index.php");
             </script>
	
	<?php
		
	}
	  
	 
			
}else if($row_for_remark_checklist_id == 1){
	
	$query_remark_update = "UPDATE remark SET 
            board_marker_pen_remark = '$insert_board_pen_marker_remark',
            synopsis_display_remark = '$insert_display_synopsis_remark',
            camera_focus_remark = '$insert_camera_focous_remark',
            camera_battery_remark = '$insert_camera_battery_remark',
            remote_system_laptop_remark = '$insert_remote_laptop_remar',
            batch_coordinator_convey_remark = '$convey_to_bcoo_remark',
            next_class_update_remark = '$next_class_remark ',
            testing_query_remark = '$testing_query_remark',
            event_post_update_remark = '$event_post_remark',
            recorded_video_remark = '$recorded_video_remark' WHERE checklist_id = '$checklist_id'";

            $run_remark_update = mysqli_query($connect,$query_remark_update);
			
			if($run_remark_update){?>
			<script type="text/javascript">
                alert("Record Updated");
                location.replace("index.php");
               </script>
			
			<?php
				
			}else{?>
			<script type="text/javascript">
                alert("Record Not Updated");
                location.replace("index.php");
               </script>
			
			<?php
				
			}
	
	
}
}


//for class end update

}else if($testing_started_at !== "" && $class_started !== "" && $class_end !== "" && $event_post == "" && $recorded_video == "" && $recoreded_video_uploaded_time == "" && isset($checklist_id,$class_date,$select_time_slot,$checklist_type,$testing_member,$class_id_from_lecture_list,$testing_started_at,$testing_end_at,$insert_venue,$insert_batch,$subject_name_number,$insert_faculty,$batch_coordinator_avail,$insert_batch_coordinator,$insert_camera_man,$tech_support_person_avail,$tech_support_person,$board_pen_marker,$display_synopsis,$insert_camera_focous,$insert_camera_battery,$insert_memory_card,$insert_memory_card_remark,$insert_audio_live,$insert_audio_live_remark,$insert_mic_testing,$insert_video_pixxel,$insert_internet_line,$insert_internet_speed,$insert_remote_system_laptop,$remote_system_ipad,$remote_ipad_remark,$insert_prompter,$convey_to_bcoo,$handout,$handout_remark,$next_class_update,$query_testing,$observation_during_testing,$class_started,$class_end)){
	
	$query = "UPDATE checklist_record SET
       class_date = '$class_date',
       time_slot = '$select_time_slot',
       checklist_type = '$checklist_type',
       testing_mamber ='$testing_member',
       class_id_from_lecture_list = '$class_id_from_lecture_list',
       testing_started_at = '$testing_started_at',
       testing_end_at = '$testing_end_at',
       venue = '$insert_venue',
       batch = '$insert_batch',
       subject = '$subject_name_number',
       faculty = '$insert_faculty',
       coordinator_presence = '$batch_coordinator_avail',
       batch_coordinator = '$insert_batch_coordinator',
       cameraman = '$insert_camera_man',
       tech_support_presence = '$tech_support_person_avail',
       tech_support_person = '$tech_support_person',
       board_marker_pen = '$board_pen_marker',
       display_synopsis = '$display_synopsis',
       camera_focus = '$insert_camera_focous',
       camera_battery = '$insert_camera_battery',
       memnory_card = '$insert_memory_card',
       memnory_card_remark = '$insert_memory_card_remark',
       audio_live = '$insert_audio_live',
       audio_level_remark = '$insert_audio_live_remark',
       mic_testing_done_by = '$insert_mic_testing',
       video_pixxel = '$insert_video_pixxel',
       internet_line = '$insert_internet_line',
       internet_speed = '$insert_internet_speed',
       remote_system_laptop = '$insert_remote_system_laptop',
       remote_system_ipad = '$remote_system_ipad',
       remote_system_ipad_remark = '$remote_ipad_remark',
       prompter_name = '$insert_prompter',
       batch_coordinator_convey = '$convey_to_bcoo',
       handout = '$handout',
       handout_remark = '$handout_remark',
       next_class_update = '$next_class_update',
       testing_query = '$query_testing',
       observation_during_testing = '$observation_during_testing',
	   class_started = '$class_started',
	   class_end_at = '$class_end'
       WHERE checklist_id = '$checklist_id'";

$run_after_testing = mysqli_query($connect,$query);

if($run_after_testing){
	$query_for_remark_checklist_id = "SELECT * FROM remark WHERE checklist_id = '$checklist_id'";
  $run_for_remark_checklist_id = mysqli_query($connect,$query_for_remark_checklist_id);
  $row_for_remark_checklist_id = mysqli_num_rows($run_for_remark_checklist_id);
  
  if($row_for_remark_checklist_id == 0){
	  if($insert_board_pen_marker_remark !== "" || $insert_display_synopsis_remark !== "" || $insert_camera_focous_remark !== "" || $insert_camera_battery_remark !== "" || $insert_remote_laptop_remar !== "" || $convey_to_bcoo_remark !== "" || $next_class_remark !== "" || $testing_query_remark !== "" || $event_post_remark !== "" || $recorded_video_remark !== ""){
		  $query_insert_remark = "INSERT INTO remark (board_marker_pen_remark, synopsis_display_remark,   camera_focus_remark, camera_battery_remark, remote_system_laptop_remark, batch_coordinator_convey_remark, next_class_update_remark, testing_query_remark, event_post_update_remark, recorded_video_remark,checklist_id) VALUES ('$insert_board_pen_marker_remark','$insert_display_synopsis_remark','$insert_camera_focous_remark','$insert_camera_battery_remark','$insert_remote_laptop_remar','$convey_to_bcoo_remark','$next_class_remark','$testing_query_remark','$event_post_remark','$recorded_video_remark','$checklist_id')";

    $run_insert_remark = mysqli_query($connect,$query_insert_remark);
	
	if($run_insert_remark){?>
	 <script type="text/javascript">
              alert("Record Updated");
              location.replace("index.php");
             </script>
	
	<?php
		
	}
		  
		  
	  }else{?>
	 <script type="text/javascript">
              alert("Record Updated");
              location.replace("index.php");
             </script>
	
	<?php
		
	}
	  
	 
			
}else if($row_for_remark_checklist_id == 1){
	
	$query_remark_update = "UPDATE remark SET 
            board_marker_pen_remark = '$insert_board_pen_marker_remark',
            synopsis_display_remark = '$insert_display_synopsis_remark',
            camera_focus_remark = '$insert_camera_focous_remark',
            camera_battery_remark = '$insert_camera_battery_remark',
            remote_system_laptop_remark = '$insert_remote_laptop_remar',
            batch_coordinator_convey_remark = '$convey_to_bcoo_remark',
            next_class_update_remark = '$next_class_remark ',
            testing_query_remark = '$testing_query_remark',
            event_post_update_remark = '$event_post_remark',
            recorded_video_remark = '$recorded_video_remark' WHERE checklist_id = '$checklist_id'";

            $run_remark_update = mysqli_query($connect,$query_remark_update);
			
			if($run_remark_update){?>
			<script type="text/javascript">
                alert("Record Updated");
                location.replace("index.php");
               </script>
			
			<?php
				
			}else{?>
			<script type="text/javascript">
                alert("Record Not Updated");
                location.replace("index.php");
               </script>
			
			<?php
				
			}
	
	
}
}

//event post option
}else if($testing_started_at !== "" && $class_started !== "" && $class_end !== "" && $event_post !== "" && $recorded_video == "" && $recoreded_video_uploaded_time == "" && isset($checklist_id,$class_date,$select_time_slot,$checklist_type,$testing_member,$class_id_from_lecture_list,$testing_started_at,$testing_end_at,$insert_venue,$insert_batch,$subject_name_number,$insert_faculty,$batch_coordinator_avail,$insert_batch_coordinator,$insert_camera_man,$tech_support_person_avail,$tech_support_person,$board_pen_marker,$display_synopsis,$insert_camera_focous,$insert_camera_battery,$insert_memory_card,$insert_memory_card_remark,$insert_audio_live,$insert_audio_live_remark,$insert_mic_testing,$insert_video_pixxel,$insert_internet_line,$insert_internet_speed,$insert_remote_system_laptop,$remote_system_ipad,$remote_ipad_remark,$insert_prompter,$convey_to_bcoo,$handout,$handout_remark,$next_class_update,$query_testing,$observation_during_testing,$class_started,$class_end,$event_post)){
	
	$query = "UPDATE checklist_record SET
       class_date = '$class_date',
       time_slot = '$select_time_slot',
       checklist_type = '$checklist_type',
       testing_mamber ='$testing_member',
       class_id_from_lecture_list = '$class_id_from_lecture_list',
       testing_started_at = '$testing_started_at',
       testing_end_at = '$testing_end_at',
       venue = '$insert_venue',
       batch = '$insert_batch',
       subject = '$subject_name_number',
       faculty = '$insert_faculty',
       coordinator_presence = '$batch_coordinator_avail',
       batch_coordinator = '$insert_batch_coordinator',
       cameraman = '$insert_camera_man',
       tech_support_presence = '$tech_support_person_avail',
       tech_support_person = '$tech_support_person',
       board_marker_pen = '$board_pen_marker',
       display_synopsis = '$display_synopsis',
       camera_focus = '$insert_camera_focous',
       camera_battery = '$insert_camera_battery',
       memnory_card = '$insert_memory_card',
       memnory_card_remark = '$insert_memory_card_remark',
       audio_live = '$insert_audio_live',
       audio_level_remark = '$insert_audio_live_remark',
       mic_testing_done_by = '$insert_mic_testing',
       video_pixxel = '$insert_video_pixxel',
       internet_line = '$insert_internet_line',
       internet_speed = '$insert_internet_speed',
       remote_system_laptop = '$insert_remote_system_laptop',
       remote_system_ipad = '$remote_system_ipad',
       remote_system_ipad_remark = '$remote_ipad_remark',
       prompter_name = '$insert_prompter',
       batch_coordinator_convey = '$convey_to_bcoo',
       handout = '$handout',
       handout_remark = '$handout_remark',
       next_class_update = '$next_class_update',
       testing_query = '$query_testing',
       observation_during_testing = '$observation_during_testing',
	   class_started = '$class_started',
	   class_end_at = '$class_end',
	   event_post_update = '$event_post'
       WHERE checklist_id = '$checklist_id'";

$run_after_testing = mysqli_query($connect,$query);

if($run_after_testing){
	$query_for_remark_checklist_id = "SELECT * FROM remark WHERE checklist_id = '$checklist_id'";
  $run_for_remark_checklist_id = mysqli_query($connect,$query_for_remark_checklist_id);
  $row_for_remark_checklist_id = mysqli_num_rows($run_for_remark_checklist_id);
  
  if($row_for_remark_checklist_id == 0){
	  if($insert_board_pen_marker_remark !== "" || $insert_display_synopsis_remark !== "" || $insert_camera_focous_remark !== "" || $insert_camera_battery_remark !== "" || $insert_remote_laptop_remar !== "" || $convey_to_bcoo_remark !== "" || $next_class_remark !== "" || $testing_query_remark !== "" || $event_post_remark !== "" || $recorded_video_remark !== ""){
		  $query_insert_remark = "INSERT INTO remark (board_marker_pen_remark, synopsis_display_remark,   camera_focus_remark, camera_battery_remark, remote_system_laptop_remark, batch_coordinator_convey_remark, next_class_update_remark, testing_query_remark, event_post_update_remark, recorded_video_remark,checklist_id) VALUES ('$insert_board_pen_marker_remark','$insert_display_synopsis_remark','$insert_camera_focous_remark','$insert_camera_battery_remark','$insert_remote_laptop_remar','$convey_to_bcoo_remark','$next_class_remark','$testing_query_remark','$event_post_remark','$recorded_video_remark','$checklist_id')";

    $run_insert_remark = mysqli_query($connect,$query_insert_remark);
	
	if($run_insert_remark){?>
	 <script type="text/javascript">
              alert("Record Updated");
              location.replace("index.php");
             </script>
	
	<?php
		
	}
		  
		  
	  }else{?>
	 <script type="text/javascript">
              alert("Record Updated");
              location.replace("index.php");
             </script>
	
	<?php
		
	}
	  
	 
			
}else if($row_for_remark_checklist_id == 1){
	
	$query_remark_update = "UPDATE remark SET 
            board_marker_pen_remark = '$insert_board_pen_marker_remark',
            synopsis_display_remark = '$insert_display_synopsis_remark',
            camera_focus_remark = '$insert_camera_focous_remark',
            camera_battery_remark = '$insert_camera_battery_remark',
            remote_system_laptop_remark = '$insert_remote_laptop_remar',
            batch_coordinator_convey_remark = '$convey_to_bcoo_remark',
            next_class_update_remark = '$next_class_remark ',
            testing_query_remark = '$testing_query_remark',
            event_post_update_remark = '$event_post_remark',
            recorded_video_remark = '$recorded_video_remark' WHERE checklist_id = '$checklist_id'";

            $run_remark_update = mysqli_query($connect,$query_remark_update);
			
			if($run_remark_update){?>
			<script type="text/javascript">
                alert("Record Updated");
                location.replace("index.php");
               </script>
			
			<?php
				
			}else{?>
			<script type="text/javascript">
                alert("Record Not Updated");
                location.replace("index.php");
               </script>
			
			<?php
				
			}
	
	
}
}

//recorded video update

}else if($testing_started_at !== "" && $class_started !== "" && $class_end !== "" && $event_post !== "" && $recorded_video !== "" && $recoreded_video_uploaded_time !== "" && isset($checklist_id,$class_date,$select_time_slot,$checklist_type,$testing_member,$class_id_from_lecture_list,$testing_started_at,$testing_end_at,$insert_venue,$insert_batch,$subject_name_number,$insert_faculty,$batch_coordinator_avail,$insert_batch_coordinator,$insert_camera_man,$tech_support_person_avail,$tech_support_person,$board_pen_marker,$display_synopsis,$insert_camera_focous,$insert_camera_battery,$insert_memory_card,$insert_memory_card_remark,$insert_audio_live,$insert_audio_live_remark,$insert_mic_testing,$insert_video_pixxel,$insert_internet_line,$insert_internet_speed,$insert_remote_system_laptop,$remote_system_ipad,$remote_ipad_remark,$insert_prompter,$convey_to_bcoo,$handout,$handout_remark,$next_class_update,$query_testing,$observation_during_testing,$class_started,$class_end,$event_post,$recorded_video)){
	
	$query = "UPDATE checklist_record SET
       class_date = '$class_date',
       time_slot = '$select_time_slot',
       checklist_type = '$checklist_type',
       testing_mamber ='$testing_member',
       class_id_from_lecture_list = '$class_id_from_lecture_list',
       testing_started_at = '$testing_started_at',
       testing_end_at = '$testing_end_at',
       venue = '$insert_venue',
       batch = '$insert_batch',
       subject = '$subject_name_number',
       faculty = '$insert_faculty',
       coordinator_presence = '$batch_coordinator_avail',
       batch_coordinator = '$insert_batch_coordinator',
       cameraman = '$insert_camera_man',
       tech_support_presence = '$tech_support_person_avail',
       tech_support_person = '$tech_support_person',
       board_marker_pen = '$board_pen_marker',
       display_synopsis = '$display_synopsis',
       camera_focus = '$insert_camera_focous',
       camera_battery = '$insert_camera_battery',
       memnory_card = '$insert_memory_card',
       memnory_card_remark = '$insert_memory_card_remark',
       audio_live = '$insert_audio_live',
       audio_level_remark = '$insert_audio_live_remark',
       mic_testing_done_by = '$insert_mic_testing',
       video_pixxel = '$insert_video_pixxel',
       internet_line = '$insert_internet_line',
       internet_speed = '$insert_internet_speed',
       remote_system_laptop = '$insert_remote_system_laptop',
       remote_system_ipad = '$remote_system_ipad',
       remote_system_ipad_remark = '$remote_ipad_remark',
       prompter_name = '$insert_prompter',
       batch_coordinator_convey = '$convey_to_bcoo',
       handout = '$handout',
       handout_remark = '$handout_remark',
       next_class_update = '$next_class_update',
       testing_query = '$query_testing',
       observation_during_testing = '$observation_during_testing',
	   class_started = '$class_started',
	   class_end_at = '$class_end',
	   event_post_update = '$event_post',
	   recorded_video_uploaded = '$recorded_video',
	   recorded_video_uploaded_remark = '$recoreded_video_uploaded_time'
       WHERE checklist_id = '$checklist_id'";

$run_after_testing = mysqli_query($connect,$query);

if($run_after_testing){
	$query_for_remark_checklist_id = "SELECT * FROM remark WHERE checklist_id = '$checklist_id'";
  $run_for_remark_checklist_id = mysqli_query($connect,$query_for_remark_checklist_id);
  $row_for_remark_checklist_id = mysqli_num_rows($run_for_remark_checklist_id);
  
  if($row_for_remark_checklist_id == 0){
	  if($insert_board_pen_marker_remark !== "" || $insert_display_synopsis_remark !== "" || $insert_camera_focous_remark !== "" || $insert_camera_battery_remark !== "" || $insert_remote_laptop_remar !== "" || $convey_to_bcoo_remark !== "" || $next_class_remark !== "" || $testing_query_remark !== "" || $event_post_remark !== "" || $recorded_video_remark !== ""){
		  $query_insert_remark = "INSERT INTO remark (board_marker_pen_remark, synopsis_display_remark,   camera_focus_remark, camera_battery_remark, remote_system_laptop_remark, batch_coordinator_convey_remark, next_class_update_remark, testing_query_remark, event_post_update_remark, recorded_video_remark,checklist_id) VALUES ('$insert_board_pen_marker_remark','$insert_display_synopsis_remark','$insert_camera_focous_remark','$insert_camera_battery_remark','$insert_remote_laptop_remar','$convey_to_bcoo_remark','$next_class_remark','$testing_query_remark','$event_post_remark','$recorded_video_remark','$checklist_id')";

    $run_insert_remark = mysqli_query($connect,$query_insert_remark);
	
	if($run_insert_remark){?>
	 <script type="text/javascript">
              alert("Record Updated");
              location.replace("index.php");
             </script>
	
	<?php
		
	}
		  
		  
	  }else{?>
	 <script type="text/javascript">
              alert("Record Updated");
              location.replace("index.php");
             </script>
	
	<?php
		
	}
	  
	 
			
}else if($row_for_remark_checklist_id == 1){
	
	$query_remark_update = "UPDATE remark SET 
            board_marker_pen_remark = '$insert_board_pen_marker_remark',
            synopsis_display_remark = '$insert_display_synopsis_remark',
            camera_focus_remark = '$insert_camera_focous_remark',
            camera_battery_remark = '$insert_camera_battery_remark',
            remote_system_laptop_remark = '$insert_remote_laptop_remar',
            batch_coordinator_convey_remark = '$convey_to_bcoo_remark',
            next_class_update_remark = '$next_class_remark ',
            testing_query_remark = '$testing_query_remark',
            event_post_update_remark = '$event_post_remark',
            recorded_video_remark = '$recorded_video_remark' WHERE checklist_id = '$checklist_id'";

            $run_remark_update = mysqli_query($connect,$query_remark_update);
			
			if($run_remark_update){?>
			<script type="text/javascript">
                alert("Record Updated");
                location.replace("index.php");
               </script>
			
			<?php
				
			}else{?>
			<script type="text/javascript">
                alert("Record Not Updated");
                location.replace("index.php");
               </script>
			
			<?php
				
			}
	
	
}
}
}
}


?>