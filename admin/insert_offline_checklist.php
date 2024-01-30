<?php
session_start();
include('../database_connection.php');
include('../testing/testing_functions.php');
if(!isset($_SESSION['admin_id'])){
    header('location:index.php');

}
    ?>
    <?php 

    $checklist_type = "Offline";
    $offline_class_date = trim(mysqli_real_escape_string($connect,$_POST['offline_class_date']));
    $offline_class_id = trim(mysqli_real_escape_string($connect,$_POST['offline_class_id']));
    $offline_batch = trim(mysqli_real_escape_string($connect,$_POST['batch']));
    
    $offline_subject_name = trim(mysqli_real_escape_string($connect,$_POST['offline_subject_name']));
    $offline_class_number = trim(mysqli_real_escape_string($connect,$_POST['offline_class_number']));

    $subject_name_number  = trim($offline_subject_name)."-".trim($offline_class_number);
    
    $offline_coordinator_name = trim(mysqli_real_escape_string($connect,$_POST['offline_coordinator_name']));
    $offline_faculty_name = trim(mysqli_real_escape_string($connect,$_POST['offline_faculty_name']));
    $offline_time_slot = trim(mysqli_real_escape_string($connect,$_POST['offline_time_slot']));
    $offline_class_time = trim(mysqli_real_escape_string($connect,$_POST['offline_class_time']));
    $offline_select_venue = trim(mysqli_real_escape_string($connect,$_POST['offline_select_venue']));

    $query = "INSERT INTO `checklist_record` (`checklist_id`, `class_date`, `checklist_type`, `testing_mamber`, `monitor_by`, `class_id_from_lecture_list`, `time_slot`, `testing_started_at`, `testing_end_at`, `venue`, `batch`, `subject`, `faculty`, `coordinator_presence`, `batch_coordinator`, `cameraman`, `tech_support_presence`, `tech_support_person`, `board_marker_pen`, `display_synopsis`, `camera_focus`, `camera_battery`, `memnory_card`, `memnory_card_remark`, `audio_live`, `audio_level_remark`, `mic_testing_done_by`, `video_pixxel`, `internet_line`, `internet_speed`, `remote_system_laptop`, `remote_system_ipad`, `remote_system_ipad_remark`, `prompter_name`, `batch_coordinator_convey`, `handout`, `handout_remark`, `next_class_update`, `testing_query`, `live_started_at`, `observation_during_testing`, `submit_checklist_time`, `class_started`, `class_end_at`, `event_post_update`, `recorded_video_uploaded`, `recorded_video_uploaded_remark`) 
    VALUES (NULL, '$offline_class_date', '$checklist_type', 3, 3, '$offline_class_id', '$offline_time_slot', '$offline_class_time', NULL, '$offline_select_venue', '$offline_batch', '$subject_name_number', '$offline_faculty_name', NULL, '$offline_coordinator_name', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);";
    
    $run = mysqli_query($connect,$query);

    if($run){
        echo 1;
    }else{
        echo 0;
    }
    
    

    
    
    ?>