<?php 
include('testing_functions.php');

$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
   
   $run_issue = issue_data($from_date,$to_date);
   while($data_issue = mysqli_fetch_assoc($run_issue)){

 $issue_arr[] = array("class id"=>$data_issue['class_id_from_lecture_list'],"Class Date"=>$data_issue['class_date'],"Venue"=>$data_issue['venue'],"Batch"=>$data_issue['batch'],
 "Time Slot"=>$data_issue['time_slot'],"Issue Name"=>$data_issue['issue_name'],"Issue Start Time"=>$data_issue['issue_start_time'],
 "Issue End Time"=>$data_issue['issue_end_time'],"Observation"=>$data_issue['observation'],"Time Lost During Class"=>$data_issue['time_lost_during_class']);

   }

   $array_count_issue_arr = count($issue_arr); //106

   for($rw = 0; $rw <$array_count_issue_arr; $rw++){

    $ven = $issue_arr[$rw]['Venue'];
    $run = fetch_center_id_from_van($ven);
    $data = mysqli_fetch_assoc($run);
     $issue_venue_center[]=array("center id"=>$data['center_id']);   //issue data array with venue and center
    

}

$issue_venue_center_count = count($issue_venue_center);

$run_center_data = fetch_center_table_data();
while($data_center = mysqli_fetch_assoc($run_center_data)){

$center[] = array("center id"=>$data_center['center_id'],"name"=>$data_center['center_name']); //all center array

}

$center_count = count($center);   

for($cen = 0; $cen < $center_count; $cen++){?>
<div class="container-fluid">

<div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $cen;?>"><?php echo $center[$cen]['name']; ?></a>
</h4>
</div>
<div id="collapse<?php echo $cen;?>" class="panel-collapse collapse">
<div class="panel-body">
<table class="table table-striped">
      <thead class="table_heading">
        <tr>
          <td>Date</td>
          <td>Venue</td>
          <td>Batch</td>
          <td>Issue Name</td>
          <td>Start Time</td>
          <td>End Time</td>
          <td>Time Lost</td>
          <td>Detail</td>
        </tr>
        </thead>
        <?php
       for($issue_ven = 0; $issue_ven < $issue_venue_center_count; $issue_ven++){
         if($center[$cen]['center id'] == $issue_venue_center[$issue_ven]['center id']){?>
          <tbody>
          <td><?php echo $issue_arr[$issue_ven]['Class Date'] ?></td>
<td><?php echo $issue_arr[$issue_ven]['Venue'] ?></td>
<td><?php  echo "*".$str_batch = str_replace(",","<br>*",$issue_arr[$issue_ven]['Batch']);   ?></td>
<td><?php echo $issue_arr[$issue_ven]['Issue Name'] ?></td>
<td><?php echo $issue_arr[$issue_ven]['Issue Start Time'] ?></td>
<td><?php echo $issue_arr[$issue_ven]['Issue End Time'] ?></td>
<td><?php echo $issue_arr[$issue_ven]['Time Lost During Class'] ?></td>
<td><button class="view_details" data-class_id="<?php echo $issue_arr[$issue_ven]['class id']?>">View</button></td>
        </tbody>
        
         <?php

         }

       }
        
        ?>
        
</table>
</div>
</div>
</div>  
</div>
</div>

<?php

}
  ?>
   
   
   
 