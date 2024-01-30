<?php 
include('../session.php');
// error_reporting(0);
// ini_set('session.gc_maxlifetime', 2592000);
// //ini_set('session.save_path', '/var/lib/php/sessions');
// session_start();
// include('../database_connection.php');
// include('../functions.php');
// $device_cookie=$_COOKIE['PHPSESSID'];
// $user_id=$_SESSION['id'];
// $row_of_specific_device = specific_device_from_login_log($device_cookie,$user_id);
// mysqli_num_rows($row_of_specific_device);
// $data = mysqli_fetch_assoc($row_of_specific_device);

// if(!isset($_SESSION['id']) || !isset($_COOKIE['PHPSESSID']) || $data['session_status'] == "inactive"){

//     $q="UPDATE login_log
//         SET session_status='inactive'
//         WHERE device_cookie='$device_cookie' OR user_id = '$user_id'";
//         $result = mysqli_query($connect,$q);

//          page_redirect('../index.php');
// }
?>
<?php 

include('attendance_function.php');
$faculty = trim($_POST['faculty'], " ");
$from = $_POST['from'];
$to = $_POST['to'];

// $faculty = "Neeraj Rao";
// $from = "2023-08-01";
// $to = "2023-08-30";
//$runForClassDate = all_class_from_date($from,$to);

// Declare an empty array 
$datesArray = array(); 
  
// Use strtotime function 
$Variable1 = strtotime($from); 
$Variable2 = strtotime($to); 
  
// Use for loop to store dates into array 
// 86400 sec = 24 hrs = 60*60*24 = 1 day 
for ($currentDate = $Variable1; $currentDate <= $Variable2; $currentDate += (86400)) { 
                                      
$Store = date('Y-m-d', $currentDate); 
$datesArray[] = $Store; 
} 
  
// Display the dates in array format 
// echo "<pre>";
// print_r($datesArray); 

$datesCount = count($datesArray);

$query = "SELECT checklist_record.checklist_id,checklist_record.class_date,checklist_record.class_id_from_lecture_list,
checklist_record.batch_coordinator,checklist_record.time_slot,checklist_record.checklist_type,checklist_record.faculty,checklist_record.venue,checklist_record.batch,checklist_record.subject,
attendance_assignment_record.att_ass_id,attendance_assignment_record.attendance,
attendance_assignment_record.response,attendance_assignment_record.assignment 
FROM checklist_record LEFT JOIN attendance_assignment_record 
ON checklist_record.checklist_id =  attendance_assignment_record.checklist_id 
WHERE checklist_record.testing_started_at != '' AND  checklist_record.faculty = '$faculty' AND (checklist_record.checklist_type = 'Class' OR checklist_record.checklist_type = 'Offline') AND checklist_record.class_date between '$from' and '$to'";

$runForFaculty = mysqli_query($connect,$query);


while($dataForClassDate = mysqli_fetch_assoc($runForFaculty)){

    $classFromDate[] = array("checklist_id" => $dataForClassDate['checklist_id'],"class_date" => $dataForClassDate['class_date'],
"class_id_from_lecture_list" => $dataForClassDate['class_id_from_lecture_list'],"batch_coordinator" => $dataForClassDate['batch_coordinator'],
"time_slot" => $dataForClassDate['time_slot'],"checklist_type" => $dataForClassDate['checklist_type'],"faculty" => $dataForClassDate['faculty'],
"venue" => $dataForClassDate['venue'],"batch" => $dataForClassDate['batch'],"subject" => $dataForClassDate['subject'],"att_ass_id" => $dataForClassDate['att_ass_id'],
"att_ass_id" => $dataForClassDate['att_ass_id'],"attendance" => $dataForClassDate['attendance'],"response" => $dataForClassDate['response'],
"assignment" => $dataForClassDate['assignment']); 

}
// echo "<pre>";
// print_r($classFromDate);

$classFromDateCount = count($classFromDate);
for($all_class_faculty = 0; $all_class_faculty <= $classFromDateCount;$all_class_faculty++){
    if($faculty == $classFromDate[$all_class_faculty]['faculty']){

        $all_class_faculty_array[] = array("batch"=>$classFromDate[$all_class_faculty]['batch']);

    }

}
// echo "<pre>";
// print_r($all_class_faculty_array);
$all_class_faculty_array_unique = array_unique($all_class_faculty_array,SORT_REGULAR);
$all_class_faculty_array_unique_reindex = array_values($all_class_faculty_array_unique); //reindexing the array
$all_class_faculty_array_unique_count = count($all_class_faculty_array_unique_reindex);



for($batchCount = 0; $batchCount < $all_class_faculty_array_unique_count; $batchCount++){

    $batch = $all_class_faculty_array_unique_reindex[$batchCount]['batch'];

    $query = "SELECT checklist_record.checklist_id,checklist_record.class_date,checklist_record.class_id_from_lecture_list,
    checklist_record.batch_coordinator,checklist_record.time_slot,checklist_record.checklist_type,checklist_record.faculty,checklist_record.venue,checklist_record.batch,checklist_record.subject,
    attendance_assignment_record.att_ass_id,attendance_assignment_record.attendance,
    attendance_assignment_record.response,attendance_assignment_record.assignment 
    FROM checklist_record LEFT JOIN attendance_assignment_record 
    ON checklist_record.checklist_id =  attendance_assignment_record.checklist_id 
    WHERE checklist_record.batch = '$batch' AND checklist_record.faculty = '$faculty' AND (checklist_record.checklist_type = 'Class' OR checklist_record.checklist_type = 'Offline') AND checklist_record.class_date between '$from' and '$to'";

    $runForbatchData = mysqli_query($connect,$query);

    while($dataForGraph = mysqli_fetch_assoc($runForbatchData)){
        $totalStrenght = 0;
        if(strpos($batch, ",")){
            $batchArray = explode(",",$batch);
            $batchArrayCount = count($batchArray);
            for($bat = 0; $bat < $batchArrayCount; $bat++){
                $runForBat = batchDetail($batchArray[$bat]);
                $dataForBat = mysqli_fetch_assoc($runForBat);
                $totalStrenght = $totalStrenght + $dataForBat['online_student'];
            }
        }else{
            $runForTotalStrength = batchDetail($batch);
            $dataForTotalStrength = mysqli_fetch_assoc($runForTotalStrength);
            $totalStrenght = $dataForTotalStrength['online_student'];
        }
        $attendance =  $dataForGraph['response'];
        $percentage = round($attendance*100/$totalStrenght);

        $dataForBatchWise[] = array("checklist_id" => $dataForGraph['checklist_id'],"class_date" => $dataForGraph['class_date'],
        "class_id_from_lecture_list" => $dataForGraph['class_id_from_lecture_list'],"batch_coordinator" => $dataForGraph['batch_coordinator'],
        "time_slot" => $dataForGraph['time_slot'],"checklist_type" => $dataForGraph['checklist_type'],"faculty" => $dataForGraph['faculty'],
        "venue" => $dataForGraph['venue'],"batch" => $dataForGraph['batch'],"subject" => $dataForGraph['subject'],"att_ass_id" => $dataForGraph['att_ass_id'],
        "att_ass_id" => $dataForGraph['att_ass_id'],"attendance" => $dataForGraph['attendance'],"percentage" => $percentage,"total strength" =>$totalStrenght,"response" => $dataForGraph['response'],
        "assignment" => $dataForGraph['assignment']);

    }

    $dataForBatchWiseCount = count($dataForBatchWise);?>
    <div class="container-fluid">
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $batchCount; ?>"><?php echo $batch;?></a>
        </h4>
      </div>
      <div id="collapse<?php echo $batchCount; ?>" class="panel-collapse collapse in">
        <div class="panel-body"><table class="table table-bordered" id="myTable">
    <thead style="background-color:#1c3961; color:white;">
      <tr>
        <th>Date</th>
        <th>Batch</th>
        <th>Subject</th>
        <th>Response</th>
        <th>Total Strenght</th>
        <th>Percentage</th>
        
      </tr>
    </thead>
    <tbody>
    <?php

    for($dates = 0; $dates < $datesCount; $dates++){

        for($dataDate = 0; $dataDate < $dataForBatchWiseCount; $dataDate++){
        
            if($datesArray[$dates] == $dataForBatchWise[$dataDate]['class_date'] && $dataForBatchWise[$dataDate]['attendance'] != ""){?>
            <tr>
                <td><?php echo $dataForBatchWise[$dataDate]['class_date']; ?></td>
                <td><?php $allBatch = $dataForBatchWise[$dataDate]['batch'];
                $allBatchArray = explode(",",$allBatch);
                $allBatchArrayCount = count($allBatchArray);
                for($i = 0; $i < $allBatchArrayCount; $i++){
                    $runForShortName = batchDetail($allBatchArray[$i]);
                    $dataForShortName = mysqli_fetch_assoc($runForShortName);
                    echo "*".$dataForShortName['batch_short_name']." ";

                }
             
                
                ?></td>
                <td><?php echo $dataForBatchWise[$dataDate]['subject']; ?></td>
                <td><?php echo $dataForBatchWise[$dataDate]['response']; ?></td>
                <td><?php echo $dataForBatchWise[$dataDate]['total strength']; ?></td>
                <td><?php echo $dataForBatchWise[$dataDate]['percentage']."%"; ?></td>
                
            </tr>

            <?php
        
            }
        
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
        unset($dataForBatchWise);
}


?>



   
