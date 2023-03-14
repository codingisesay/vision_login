<?php 
include('testing_session.php');
//mysqli_close($connect);
if(isset($_POST['download_raw_data'])){
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $query = "Select checklist_record.checklist_id, checklist_record.class_date, checklist_record.venue,
    checklist_record.batch, checklist_record.time_slot, user.user_name,issue_during_class.issue_name,
    issue_during_testing_remark.issue_start_time,issue_during_testing_remark.issue_end_time,
    issue_during_testing_remark.observation,issue_during_testing_remark.time_lost_during_class,issue_during_testing_remark.live_class_affect,issue_during_testing_remark.user_id,user.user_name from checklist_record
    inner join user on checklist_record.testing_mamber = user.user_id inner join issue_during_testing_remark on 
    checklist_record.checklist_id = issue_during_testing_remark.checklist_id 
    inner join issue_during_class on issue_during_testing_remark.issue_id = issue_during_class.issue_id 
    where checklist_record.class_date between '$from_date' and '$to_date'  ORDER BY checklist_id ASC";
     
     $run = mysqli_query($connect,$query);
     echo $rows = mysqli_num_rows($run);

    
     
    ob_clean();   
    header("Content-Disposition: attachment; filename=abc.xls"); 
    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    ?>

<table border="1" style="margin-top: 2%;">
    <tr style="background-color:#87CEEB; color:white;">
        <th>Date</th>
        <th>Venue</th>
        <th>Batch</th>
        <th>Time</th>
        <th>Issue Type</th>
        <th>Issue Started At</th>
        <th>Issue End At</th>
        <th>Live Class Affect</th>
        <th>Observation</th>
        <th>Time Lost</th>
        <th>Updated By</th>
     </tr>
    <?php
    while($data = mysqli_fetch_assoc($run)){?>
    <table border="1" style="margin-top: 2%;">
    <tr>
        <td><?php echo $data['class_date']; ?></td>
        <td><?php echo $data['venue']; ?></td>
        <td><?php echo $data['batch']; ?></td>
        <td><?php echo $data['time_slot']; ?></td>
        <td><?php echo $data['issue_name']; ?></td>
        <td><?php echo $data['issue_start_time']; ?></td>
        <td><?php echo $data['issue_end_time']; ?></td>
        <td><?php echo $data['live_class_affect']; ?></td>
        <td><?php echo $data['observation']; ?></td>
        <td><?php echo $data['time_lost_during_class']; ?></td>
        <td><?php echo $data['user_name'];?></td>
    </tr>
    </table>
    
    
    <?php

    }


     }

    


?>



