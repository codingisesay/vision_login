<?php
session_start();
include('../database_connection.php');
include('../testing/testing_functions.php');
if(!isset($_SESSION['admin_id'])){
	header('location:index.php');

}
	?>

	<?php 
$class_date = trim(mysqli_real_escape_string($connect,$_POST['class_date']));
$select_checklist_type =trim(mysqli_real_escape_string($connect,$_POST['select_checklist_type']));
$class_id = trim(mysqli_real_escape_string($connect,$_POST['class_id']));
$testing_mamber = trim(mysqli_real_escape_string($connect,$_POST['testing_mamber']));
$monitor_mamber = trim(mysqli_real_escape_string($connect,$_POST['monitor_mamber']));
$select_batch = trim(mysqli_real_escape_string($connect,$_POST['batch']));
$select_time_slot = trim(mysqli_real_escape_string($connect,$_POST['select_time_slot']));
$select_venue = trim(mysqli_real_escape_string($connect,$_POST['select_venue']));

$select_time_slot = trim(mysqli_real_escape_string($connect,$_POST['select_time_slot']));
$select_venue = trim(mysqli_real_escape_string($connect,$_POST['select_venue']));

$query_insert = "INSERT INTO `checklist_record` (`checklist_id`, `class_date`,`checklist_type`, `testing_mamber`, `monitor_by`, `class_id_from_lecture_list`, `time_slot`, `testing_started_at`, `testing_end_at`, `venue`, `batch`, `subject`, `faculty`, `batch_coordinator`, `cameraman`, `camera_focus`, `camera_battery`, `memnory_card`, `memnory_card_remark`, `audio_live`, `audio_level_remark`, `mic_testing_done_by`, `video_pixxel`, `internet_line`, `internet_speed`, `remote_system_laptop`, `remote_system_ipad`, `remote_system_ipad_remark`, `prompter_name`, `batch_coordinator_convey`, `handout`, `handout_remark`, `next_class_update`, `testing_query`, `observation_during_testing`, `class_started`, `class_end_at`, `event_post_update`, `recorded_video_uploaded`, `recorded_video_uploaded_remark`) VALUES (NULL,'$class_date', '$select_checklist_type', '$testing_mamber', '$monitor_mamber', '$class_id', '$select_time_slot', NULL, NULL, '$select_venue', '$select_batch', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)";

$run_checklist = mysqli_query($connect,$query_insert);
	mysqli_close($connect);
if($run_checklist){
	echo 1;

}else{
	echo 0;
	
}

?>