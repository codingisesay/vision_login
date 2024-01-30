<?php 
include('testing_functions.php');

$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];

$run_all_class = all_class_from_date($from_date,$to_date);
while($all_class_data = mysqli_fetch_assoc($run_all_class)){

  $all_class[] = $all_class_data['time_slot'];

}

   $run_issue = issue_data($from_date,$to_date);
   while($data_issue = mysqli_fetch_assoc($run_issue)){

 $issue_arr[] = array("class id"=>$data_issue['class_id_from_lecture_list'],"Class Date"=>$data_issue['class_date'],"Venue"=>$data_issue['venue'],"Batch"=>$data_issue['batch'],
 "Time Slot"=>$data_issue['time_slot'],"Issue Name"=>$data_issue['issue_name'],"Issue Start Time"=>$data_issue['issue_start_time'],
 "Issue End Time"=>$data_issue['issue_end_time'],"Observation"=>$data_issue['observation'],"Time Lost During Class"=>$data_issue['time_lost_during_class']);

   }

   $array_count_issue_arr = count($issue_arr); //106
   $time_slot_array = array("09 am - 12 pm","01 pm - 04 pm","05 pm - 08 pm");
   $array_count_time_slot = count($time_slot_array); //3
   $all_class_count = count($all_class);
   ?>
   <div class="container-fluid">
    <table class="table table-bordered">
    <thead style="background-color: #1c3961; color:white; font-weight: bolder;">
      <tr>
        <td>TIME SLOT</td>
        <td>TOTAL CLASS</td>
        <td>ISSUE</td>
        <td>PERCENT</td>
      </tr>
    </thead>
    <?php 
    for($slot = 0; $slot < $array_count_time_slot; $slot++){
      $all_cls = 0;
      $isuue_cls = 0;
      for($all_cl = 0; $all_cl < $all_class_count; $all_cl++){
        if($time_slot_array[$slot] == $all_class[$all_cl]){
          $all_cls++;
        }
  
      }
      for($iss = 0; $iss < $array_count_issue_arr; $iss++){
        if($time_slot_array[$slot] == $issue_arr[$iss]['Time Slot']){
          $isuue_cls++;
        }

      }

      $percent = ($isuue_cls*100)/$all_cls;
      $new_per = round($percent);?>
      <tr>
        <td><?php echo $time_slot_array[$slot]; ?></td>
        <td><?php echo $all_cls; ?></td>
        <td><?php echo $isuue_cls; ?></td>
        <td><?php echo  $new_per."%"; ?></td>
      </tr>
      
      
      
      
      <?php
     
    }
    
    
    ?>
  </table>
   </div>
   
   <?php

   for($time_slot = 0; $time_slot < $array_count_time_slot; $time_slot++){?>
    <div class="container-fluid">

    <div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $time_slot;?>" style="text-decoration:none;">Time Slot (<?php echo $time_slot_array[$time_slot];?>)</a>
          </h4>
        </div>
        <div id="collapse<?php echo $time_slot;?>" class="panel-collapse collapse">
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
        for($issue = 0; $issue < $array_count_issue_arr; $issue++){
          if($time_slot_array[$time_slot] == $issue_arr[$issue]['Time Slot']){?>
          

<tbody>
<td><?php echo $issue_arr[$issue]['Class Date'] ?></td>
<td><?php echo $issue_arr[$issue]['Venue'] ?></td>
<td><?php  echo "*".$str_batch = str_replace(",","<br>*",$issue_arr[$issue]['Batch']);   ?></td>
<td><?php echo $issue_arr[$issue]['Issue Name'] ?></td>
<td><?php echo $issue_arr[$issue]['Issue Start Time'] ?></td>
<td><?php echo $issue_arr[$issue]['Issue End Time'] ?></td>
<td><?php echo $issue_arr[$issue]['Time Lost During Class'] ?></td>
<td><button class="view_details" data-class_id="<?php echo $issue_arr[$issue]['class id']?>">View</button></td>
    
          
          <?php


          }
        }?>
         </tbody>
</table>
</div>
</div>
</div>
</div> 
</div>
        
        <?php


       }
        
          ?>






