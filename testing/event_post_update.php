<?php 
include('testing_session.php');

?>
            <?php 

            if(isset($_POST['id']) && isset($_POST['select_eventpost'])){

            $checklist_id = mysqli_real_escape_string($connect,$_POST['id']);
            $select_event_post = trim(mysqli_real_escape_string($connect,$_POST['select_eventpost']));
            $event_post_remark = trim(mysqli_real_escape_string($connect,$_POST['event_postremark']));

            if($select_event_post == "Yes"){

            $quer = "UPDATE checklist_record SET event_post_update ='$select_event_post' WHERE checklist_id ='$checklist_id'";

            $update_event_option = mysqli_query($connect,$quer);

            if($update_event_option){
                mysqli_close($connect);
                echo 1;
				

            }else{
                mysqli_close($connect);
                echo 0;
				

            }
            exit();
        }else if($select_event_post == "No"){
            $query_no_insert = "UPDATE checklist_record SET event_post_update ='$select_event_post' WHERE checklist_id ='$checklist_id'";
            $run_remark = mysqli_query($connect,$query_no_insert);
            $q = "SELECT * FROM remark WHERE checklist_id = '$checklist_id'";
            $run_select_remark = mysqli_query($connect,$q);
            $remark_rows = mysqli_num_rows($run_select_remark);
            //print_r($remark_rows);
            if($remark_rows == 0){

                $query_insert_remark = "INSERT INTO remark (event_post_update_remark,checklist_id) VALUES ('$event_post_remark','$checklist_id')";
                mysqli_query($connect,$query_insert_remark);

            }else if($remark_rows == 1){
                $query_update = "UPDATE remark SET event_post_update_remark = '$event_post_remark' WHERE checklist_id = '$checklist_id'";
                mysqli_query($connect,$query_update);
            }

            }

            if($run_remark){
				mysqli_close($connect);
                echo 1;
				
            }else{
				mysqli_close($connect);
                echo 0;
				
            }

        }
    


        ?>