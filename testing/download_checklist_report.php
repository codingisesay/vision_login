<?php 
include('testing_session.php');

?>
<?php      $from_date = $_GET['from_date'];
           $to_date = $_GET['to_date'];
           $select_catogray = $_GET['select_catogray'];
           $load_data = $_GET['load_data'];
           //$venue_name_data = $_POST['venue_name_data'];

            if($select_catogray == "batch" OR $select_catogray == "venue"){

                $q="SELECT `checklist_record`.*, `user`.`user_name` FROM `checklist_record` LEFT JOIN `user` ON `checklist_record`.`testing_mamber` = `user`.`user_id` WHERE checklist_record.testing_started_at >= '$from_date' && checklist_record.testing_started_at <= '$to_date' && $select_catogray LIKE '%$load_data%'";

                $run_query_batch = mysqli_query($connect,$q);
                $row = mysqli_num_rows($run_query_batch);

                if($row > 0){

                    ob_clean();
        
        header("Content-Disposition: attachment; filename=abc.xls"); 
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");


?>
            <table border="1px" width="100%" cellspacing="0">
            <tr>
            <th>Class/Diss. Id</th>
            <th>Date</th>
            <th>Checklist Type</th>
            <th>Batch/Test Code</th>
           
            <th>Venue</th>
            
            
            <th>No. of Interruption</th>
            <th>Time Lost</th>
            </tr>

            <?php 

            while($data=mysqli_fetch_assoc($run_query_batch)){
              
               $checklist_id = $data['checklist_id'];
                $qury="SELECT * FROM issue_during_testing_remark WHERE checklist_id = '$checklist_id'";
                $run_remark = mysqli_query($connect,$qury);
                $row_remark = mysqli_num_rows($run_remark);
                
                $total_time_lost = 0;
                 for($i=1; $i <= $row_remark; $i++){
                    $issue_data = mysqli_fetch_assoc($run_remark);
                    //x += y
                    
                $total_time_lost += $issue_data['time_lost_during_class'];
			
                }


                ?>

             <tr>
                 <td><?php echo $data['class_id_from_lecture_list']?></td>
                 <td><?php $date = $data['class_date'];
                echo $newDate = date("d/m/Y", strtotime($date)); ?></td>
                 <td><?php echo $data['checklist_type']; ?></td>
                 <td><?php $str_batch = $data['batch'];
                 $str = str_replace(",","<br>*","$str_batch");
                 echo "*".$str;

             ?></td>
                 <td><?php echo $data['venue'] ?></td>
                 <td><?php echo $row_remark." "."time"; ?></td>
                 <td><?php echo $total_time_lost." "."Mins"; ?></td>
             </tr>

                <?php
				
					

            }
            ?>


        <?php

mysqli_close($connect);
                }else{

                }
               
        }else{

            echo "not if";
        }

       


            ?>
