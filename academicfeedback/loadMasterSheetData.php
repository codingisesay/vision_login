 <?php 
include('../session.php');
include('academicfeedbackFunction.php');



?>
<head>
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {background-color: #f2f2f2;}
</style>
</head>
<?php 
// $fromdate = '2024-04-01';
// $todate = '2024-04-05';
$fromdate = $_POST['fromdate'];
// $todate = $_POST['todate'];
$mastersheetArray = fetchDataForMasterSheet($fromdate);
$mastersheetArrayCount = count($mastersheetArray);
// Declare two dates 
// $Date1 = '01-10-2010'; 
// $Date2 = '05-10-2010'; 
  
// Declare an empty array 
$array = array(); 
  
// Use strtotime function 
$Variable1 = strtotime($fromdate); 
$Variable2 = strtotime($fromdate); 
  
// Use for loop to store dates into array 
// 86400 sec = 24 hrs = 60*60*24 = 1 day 
for ($currentDate = $Variable1; $currentDate <= $Variable2;  
                                $currentDate += (86400)) { 
                                      
$Store = date('Y-m-d', $currentDate); 
$datesarray[] = $Store; 
} 
  
// Display the dates in array format 
// print_r($datesarray);

$datesarrayCount = count($datesarray);


?>
<?php 
for($datesarrayin = 0; $datesarrayin < $datesarrayCount; $datesarrayin++){?>


<div  class="container-fluid" style="overflow-x: auto; height:1200px;">

  <table class="table table-bordered" id="myTable<?php echo $datesarrayin; ?>" >
    <thead>
      <tr>
        <th>Class Date</th>
        <th>Batch</th>
        <th>Subject</th>
        <th>Faculty</th>
    
        <th>Class Number</th>
     
        <th>Start Time</th>
        <th>Attendance</th>
        <th>Online Attendance</th>
        <th>Assignments</th>
        <th>Topics Covered</th>
        <th>No of Queries</th>
        <th>Coordinator Name</th>
        <th>Coordinator Rating</th>
        <th>factual Error</th>
        <th>factual Detail</th>
        <th>Pace Of The Class</th>
        <th>Any Video Portion Removed</th>
        <th>Video Portion Details</th>
        <th>Feedback Miscellaneous</th>
        <th>View Details</th>
        
      </tr>
    </thead>
    <tbody>
        <?php 
        for($masterData = 0;$masterData < $mastersheetArrayCount; $masterData++ ){
            if($datesarray[$datesarrayin] == $mastersheetArray[$masterData]['class_date']){?>
            
            <tr>
        <td><?php $originalDate = $mastersheetArray[$masterData]['class_date'];
                  echo $newDate = date("d-m-Y", strtotime($originalDate)); ?></td>
        <td><?php echo batchShortCode($mastersheetArray[$masterData]['batch']); ?></td>
        <td><?php echo preg_replace('/[0-9-]+/','',$mastersheetArray[$masterData]['subject']); ?></td>
        <td><?php echo $mastersheetArray[$masterData]['faculty']; ?></td>
       
        <td><?php echo preg_replace('/[A-Z,a-z-]+/','',$mastersheetArray[$masterData]['subject']); ?></td>
       
        <td><?php echo $mastersheetArray[$masterData]['class_start_time']; ?></td>
        <td><?php echo $mastersheetArray[$masterData]['attendance']; ?></td>
        <td><?php echo $mastersheetArray[$masterData]['response']; ?></td>
        <td><?php echo $mastersheetArray[$masterData]['assignment_confirmed_with_faculty']; ?></td>
        <td><?php echo $mastersheetArray[$masterData]['major_topics_covered']; ?></td>
        <td><?php echo $mastersheetArray[$masterData]['No_of_live_query']; ?></td>
        <td><?php echo preg_replace('/[0-9-]+/','',$mastersheetArray[$masterData]['batch_coordinator']); ?></td>
        <td><?php echo $mastersheetArray[$masterData]['overall_rating_for_the_class']; ?></td>
        <td><?php echo $mastersheetArray[$masterData]['factual_errors_or_conceptual_lags']; ?></td>
        <td><?php echo $mastersheetArray[$masterData]['factual_errors_or_conceptual_lags_text']; ?></td>
        <td><?php echo $mastersheetArray[$masterData]['pace_of_the_class']; ?></td>
        <td><?php echo $mastersheetArray[$masterData]['video_portion_removed']; ?></td>
        <td><?php echo $mastersheetArray[$masterData]['video_portion_need_to_cut_remark']; ?></td>
        <td>Management/Tech :<?php echo $mastersheetArray[$masterData]['management_technical_issue'];?> <br>Issue by Student : <?php echo $mastersheetArray[$masterData]['specific_issue_highlighted_by_students'];?><br>Other Feedback :<?php echo $mastersheetArray[$masterData]['any_other_feedback'];?> </td>
        <td><a class="view_checklist_detail" data-checklist_id="<?php echo $mastersheetArray[$masterData]['checklist_id'];?>"><button type="button"  class="btn btn-info" data-toggle="modal" data-target="#myModal">View</button></a></td>
        
      </tr>
            
            
            
            <?php

            }
            ?>
             
       <?php
        }
        
        
        
        ?>
  
    </tbody>
  </table>
  
</div> 

<?php

}


?>
  <script>
        var my_variable = <?php echo json_encode($datesarrayCount); ?>;
      for(i = 0; i < my_variable; i++){
        var id = '#myTable'.concat(i);
        // console.log(id);
        $(id).excelTableFilter();

      }
</script>