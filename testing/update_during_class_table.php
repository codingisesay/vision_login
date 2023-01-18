<?php 
include('testing_session.php');

?>
            <?php 

            $checklist_id = $_POST['id'];
            $issue_start_time = $_POST['issue_start'];
            $selected_issue = $_POST['select_issue'];
            $issue_detail_remark = $_POST['issue_detail'];
            $issue_end = $_POST['issue_end'];
            $live_class_effect = $_POST['live_class_effect'];
            $lost_time = (strtotime($issue_end) - strtotime($issue_start_time))/60;

            $query = "INSERT INTO issue_during_testing_remark (issue_id,issue_start_time,issue_end_time,observation,live_class_affect,time_lost_during_class,checklist_id) VALUES ('$selected_issue','$issue_start_time','$issue_end','$issue_detail_remark','$live_class_effect','$lost_time','$checklist_id')";
            $run_insert = mysqli_query($connect,$query);
			mysqli_close($connect);
            if($run_insert){
                echo 1;
				
            }else{
                echo 0;
				
            }




        ?>