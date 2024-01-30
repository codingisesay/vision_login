<?php 
include('testing_session.php');

?>
            <?php

            if(isset($_POST['id']) && isset($_POST['starting_time'])){

            $checklist_id = mysqli_real_escape_string($connect,$_POST['id']);
            $starting_time = trim(mysqli_real_escape_string($connect,$_POST['starting_time']));

           $q = "UPDATE checklist_record SET class_started='$starting_time' WHERE checklist_id ='$checklist_id'";
           $run_update_starting_time = mysqli_query($connect,$q);
		   mysqli_close($connect);
           if($run_update_starting_time){

             echo 1;
			 

           }else{

            echo 0;
			

           }

        }


             ?>