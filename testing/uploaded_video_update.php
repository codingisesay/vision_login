<?php 
include('testing_session.php');

?>
            <?php 

           if(isset($_POST['id']) && isset($_POST['recorded_video_status']) && isset($_POST['recorded_video_time'])){

            $checklist_id = mysqli_real_escape_string($connect,$_POST['id']);
            $recorded_video_status = mysqli_real_escape_string($connect,$_POST['recorded_video_status']);
            $recorded_video_time = mysqli_real_escape_string($connect,$_POST['recorded_video_time']);
            $recorded_remark = mysqli_real_escape_string($connect,$_POST['recorded_remark']);

            if($recorded_video_status == "Uploaded"){

            $query = "UPDATE checklist_record SET recorded_video_uploaded = '$recorded_video_status',recorded_video_uploaded_remark = '$recorded_video_time' WHERE checklist_id ='$checklist_id'";
            $run_update_recorded_video = mysqli_query($connect,$query);

            if($run_update_recorded_video){
				mysqli_close($connect);
                echo 1;
				
            }else{
				mysqli_close($connect);
                echo 0;
				
            }
            exit();

            }else if($recorded_video_status == "Not Uploaded"){

                $query_not_uploaded = "UPDATE checklist_record SET recorded_video_uploaded = '$recorded_video_status' WHERE checklist_id = '$checklist_id'";
                $run_not_uploaded = mysqli_query($connect,$query_not_uploaded);

                $query_for_check_remark = "SELECT * FROM remark WHERE checklist_id = '$checklist_id'";
                $run_query_for_check_remark = mysqli_query($connect,$query_for_check_remark);
                $row_run_query_for_check_remark = mysqli_num_rows($run_query_for_check_remark);

                
                if($row_run_query_for_check_remark == 0){
                    $insert_query_remark = "INSERT INTO remark (recorded_video_remark,checklist_id) VALUES ('$recorded_remark','$checklist_id')";
                    mysqli_query($connect,$insert_query_remark);
                }else if($row_run_query_for_check_remark == 1){

                    $query_update_remark = "UPDATE remark SET recorded_video_remark = '$recorded_remark' WHERE checklist_id = '$checklist_id'";
                      mysqli_query($connect,$query_update_remark);

                }


            }

            if($query_not_uploaded){
				mysqli_close($connect);
                echo 1;
				
            }else{
				mysqli_close($connect);
                echo 0;
				
            }

         


        }


        ?>