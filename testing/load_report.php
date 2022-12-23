<?php 
include('testing_session.php');

?>
        <?php
        $date = $_POST['select_date'];


    $query_for_user_role = "SELECT user_role FROM user WHERE user_id = '$user_id'";
    $run_for_user_role = mysqli_query($connect,$query_for_user_role);
    $data__for_user_role = mysqli_fetch_assoc($run_for_user_role);

    $user_role = $data__for_user_role['user_role'];

       if($user_role == 1){

      $q="SELECT `checklist_record`.*, `user`.`user_name` FROM `checklist_record` LEFT JOIN `user` ON `checklist_record`.`testing_mamber` = `user`.`user_id` WHERE checklist_record.testing_mamber = '$user_id' AND checklist_record.testing_started_at LIKE '%$date%'";
        $run_report = mysqli_query($connect,$q);
        $output="";
        if(mysqli_num_rows($run_report) > 0){
            $output='<table border="1px" width="100%" cellspacing="0">
            <tr>
            <th>Class/Diss. Id</th>
            <th>Checklist Type</th>
            <th>Batch/Test Code</th>
            <th>Class</th>
            <th>Testing Person</th>
            <th>Issue During Testing</th>
            <th>No. of Interruption</th>
            <th>Time Lost</th>
            <th>Event Post Update</th>
            <th>Check Full Detail</th>
           
            </tr>';
               
            while($data = mysqli_fetch_assoc($run_report)){
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
                $output.="<tr>
                <td>{$data['class_id_from_lecture_list']}</td>
                 <td>{$data['checklist_type']}</td>";
                 $str_batch = $data['batch'];
                 $str = str_replace(",","<br>*","$str_batch");

                 $output.="<td>*{$str}</td>
                 <td>{$data['subject']}</td>
                 <td>{$data['user_name']}</td>
                 <td>{$data['observation_during_testing']}</td>
                 <td>{$row_remark}</td>
                 <td>{$total_time_lost} Mins</td>
                 <td>{$data['event_post_update']}</td>
                 <td><button class='view_detail_checklist' data-class_id='{$data['class_id_from_lecture_list']}'style='padding:5px;background-color:#1c3961; color:white;'>View</button></td>
               
                </tr>";
            }
            $output.="</table>";
            
                    mysqli_close($connect);
            echo $output;
            
        }else{
        mysqli_close($connect);
    echo"Record Not Found";
    
    
}


       }else if($user_role == 3 || $user_role == 2){

        $q="SELECT `checklist_record`.*, `user`.`user_name` FROM `checklist_record` LEFT JOIN `user` ON `checklist_record`.`testing_mamber` = `user`.`user_id` WHERE checklist_record.testing_started_at LIKE '%$date%'";
        $run_report = mysqli_query($connect,$q);
        $output="";
        if(mysqli_num_rows($run_report) > 0){
            $output='<table border="1px" width="100%" cellspacing="0">
            <tr>
            <th>Class/Diss. Id</th>
            <th>Checklist Type</th>
            <th>Batch/Test Code</th>
            <th>Class</th>
            <th>Testing Person</th>
            <th>Issue During Testing</th>
            <th>No. of Interruption</th>
            <th>Time Lost</th>
            <th>Event Post Update</th>
            <th>Check Full Detail</th>
           
            </tr>';
               
            while($data = mysqli_fetch_assoc($run_report)){
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
                $output.="<tr>
                <td>{$data['class_id_from_lecture_list']}</td>
                 <td>{$data['checklist_type']}</td>";
                 $str_batch = $data['batch'];
                 $str = str_replace(",","<br>*","$str_batch");

                 $output.="<td>*{$str}</td>
                 <td>{$data['subject']}</td>
                 <td>{$data['user_name']}</td>
                 <td>{$data['observation_during_testing']}</td>
                 <td>{$row_remark}</td>
                 <td>{$total_time_lost} Mins</td>
                 <td>{$data['event_post_update']}</td>
                 <td><button class='view_detail_checklist' data-class_id='{$data['class_id_from_lecture_list']}'style='padding:5px;background-color:#1c3961; color:white;'>View</button></td>
               
                </tr>";
            }
            $output.="</table>";
            $output.="<a href='send_mail.php?date={$date}'><button style='width:100%; padding:5px; background-color: #1c3961;color: white;font-weight: bold;
                border: none; margin:5px;'>Mail Report</button></a>";
                    mysqli_close($connect);
            echo $output;
            
        }else{
        mysqli_close($connect);
    echo"Record Not Found";
    
    
}


       }
        


        

    ?>