
<?php 
include('testing_functions.php');

$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
$selected_cat = $_POST['selected_cat'];

        //$from_date = '2022-08-20';
        //$to_date = '2022-09-20';
        //$selected_cat = "Internet Issue";
   
   $run_issue = issue_data($from_date,$to_date);
   while($data_issue = mysqli_fetch_assoc($run_issue)){

 $issue_arr[] = array("class id"=>$data_issue['class_id_from_lecture_list'],"Class Date"=>$data_issue['class_date'],"Venue"=>$data_issue['venue'],"Batch"=>$data_issue['batch'],
 "Time Slot"=>$data_issue['time_slot'],"Issue Name"=>$data_issue['issue_name'],"Issue Start Time"=>$data_issue['issue_start_time'],
 "Issue End Time"=>$data_issue['issue_end_time'],"Observation"=>$data_issue['observation'],"Time Lost During Class"=>$data_issue['time_lost_during_class']);

   }

   $array_count_issue_arr = count($issue_arr); //106 

   $year = array("01"=>"January","02"=>"February","03"=>"March","04"=>"April","05"=>"May","06"=>"June","07"=>"July","08"=>"August","09"=>"September","10"=>"October","11"=>"November","12"=>"December");
 
   foreach($year as $key => $value){?>
     <div class="container-fluid">
  
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $key; ?>"><?php echo  $value; ?></a>
        </h4>
      </div>
      <div id="collapse<?php echo $key; ?>" class="panel-collapse collapse">
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
 for($total_issue = 0; $total_issue < $array_count_issue_arr; $total_issue++){
  $class_date = $issue_arr[$total_issue]['Class Date'];
  if($key == $class_date[5].$class_date[6] && $selected_cat == $issue_arr[$total_issue]['Issue Name']){
  ?>
 <tbody>
  <td><?php echo $issue_arr[$total_issue]['Class Date'] ?></td>
  <td><?php echo $issue_arr[$total_issue]['Venue'] ?></td>
  <td><?php  echo "*".$str_batch = str_replace(",","<br>*",$issue_arr[$total_issue]['Batch']);   ?></td>
  <td><?php echo $issue_arr[$total_issue]['Issue Name'] ?></td>
  <td><?php echo $issue_arr[$total_issue]['Issue Start Time'] ?></td>
  <td><?php echo $issue_arr[$total_issue]['Issue End Time'] ?></td>
  <td><?php echo $issue_arr[$total_issue]['Time Lost During Class'] ?></td>
  <td><button class="view_details" data-class_id="<?php echo $issue_arr[$total_issue]['class id']?>">View</button></td>
          
 
 <?php
 
}
 }
 
 ?>
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



