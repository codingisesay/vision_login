<?php 
include('testing_session.php');

?>
            <?php 

            $checklist_id = trim(mysqli_real_escape_string($connect,$_POST['id']));
            $issue_start_time = trim(mysqli_real_escape_string($connect,$_POST['issue_start']));
            $selected_issue = trim(mysqli_real_escape_string($connect,$_POST['select_issue']));
            $issue_detail_remark = trim(mysqli_real_escape_string($connect,$_POST['issue_detail']));
            $issue_end = trim(mysqli_real_escape_string($connect,$_POST['issue_end']));
            $live_class_effect = trim(mysqli_real_escape_string($connect,$_POST['live_class_effect']));
            $lost_time = (strtotime($issue_end) - strtotime($issue_start_time))/60;
            

            $query = "INSERT INTO issue_during_testing_remark (issue_id,issue_start_time,issue_end_time,observation,live_class_affect,time_lost_during_class,checklist_id,user_id) VALUES ('$selected_issue','$issue_start_time','$issue_end','$issue_detail_remark','$live_class_effect','$lost_time','$checklist_id','$user_id')";
            $run_insert = mysqli_query($connect,$query);
			mysqli_close($connect);
            if($run_insert){
                echo 1;
				
            }else{
                echo 0;
				
            }




        ?>