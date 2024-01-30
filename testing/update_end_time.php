<?php 
include('testing_session.php');

?>
            <?php 
             if(isset($_POST['id']) && isset($_POST['end_time'])){
            $checklist_id = mysqli_real_escape_string($connect,$_POST['id']);
            $end_time = trim(mysqli_real_escape_string($connect,$_POST['end_time']));

            $que = "UPDATE checklist_record SET class_end_at ='$end_time' WHERE checklist_id ='$checklist_id'";
            $update_end_time = mysqli_query($connect,$que);
			mysqli_close($connect);
            if($update_end_time){

                echo 1;
				

            }else{


                echo 0;
				
            }
        }



        ?>