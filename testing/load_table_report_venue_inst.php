<?php 
error_reporting(0);
include('testing_functions.php');
//load_table_report_venue_inst.php
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
//$from_date = '2022-08-20';
//$to_date = '2022-09-20';

$run_all_class = all_class_from_date($from_date,$to_date);
while($data_all_class = mysqli_fetch_assoc($run_all_class)){

    $all_class[]=array("venue"=>$data_all_class['venue'],"Class date"=>$data_all_class['class_date']);

}
$all_class_count = count($all_class);
for($all_data_rw = 0; $all_data_rw <$all_class_count; $all_data_rw++){

    $all_class_ven = $all_class[$all_data_rw]['venue'];
    $run_all_class = fetch_center_id_from_van($all_class_ven);
    $data_all_class = mysqli_fetch_assoc($run_all_class);
     $all_class_venue_center[]=array("class id"=>$data_all_class['center_id']);   //issue data array with venue and center
    

}

   
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

$center_count = count($center); ?>

<div class="container-fluid">
    <table class="table table-bordered">
    <thead style="background-color: #1c3961; color:white; font-weight: bolder;">
      <tr>
        <td>VENUE</td>
        <td>TOTAL CLASS</td>
        <td>ISSUE</td>
        <td>PERCENT</td>
      </tr>
    </thead>
<?php
for($cent = 0; $cent<$center_count;$cent++){
  $all_class_on_particular_venue = 0;
  for($all=0;$all<$all_class_count;$all++){

      if($center[$cent]['center id'] == $all_class_venue_center[$all]['class id']){
          $all_class_on_particular_venue++;
      }

      

  }
  $issue_class_on_particular_venue = 0;
  for($issu = 0; $issu<$array_count_issue_arr;$issu++){
      
      if($center[$cent]['center id'] == $issue_venue_center[$issu]['center id']){

          $issue_class_on_particular_venue++;

      }

  }

  $percent = ($issue_class_on_particular_venue*100)/$all_class_on_particular_venue;

  
   if($issue_class_on_particular_venue == 0 && $all_class_on_particular_venue == 0 ){

      $new_percent = 0;

   }else{

      $new_percent = round($percent);

   }
  
  ?>
  
  <tr>
    <td><?php echo $center[$cent]['name']; ?></td>
    <td><?php echo $all_class_on_particular_venue; ?></td>
    <td><?php echo $issue_class_on_particular_venue; ?></td>
    <td><?php echo $new_percent."%"; ?></td>
  </tr>
  
  <?php

  


}

?>
</table>
 </div>


<?php 

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
   
   
   
 