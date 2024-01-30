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
<!DOCTYPE html>
<html>
<!-- <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head> -->
<body>
    <?php
include('attendance_function.php');
$batch = trim($_POST['batch']," ");
$from = $_POST['from'];
$to = $_POST['to'];

// $batch = "5210_RB05_HIN_2023";
// $from = "2023-08-01";
// $to = "2023-08-30";

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

// echo "<pre>";
// print_r($dates);
$runForSelectedBatch = batchDetail($batch);
$dataForSelectedBatch = mysqli_fetch_assoc($runForSelectedBatch);
$offlineStudentForSelBat = $dataForSelectedBatch['offline_students'];//total student in selected batch


$query = "SELECT checklist_record.checklist_id,checklist_record.class_date,checklist_record.class_id_from_lecture_list,
    checklist_record.batch_coordinator,checklist_record.time_slot,checklist_record.checklist_type,checklist_record.faculty,checklist_record.venue,checklist_record.batch,checklist_record.subject,
    attendance_assignment_record.att_ass_id,attendance_assignment_record.attendance,
    attendance_assignment_record.response,attendance_assignment_record.assignment 
    FROM checklist_record LEFT JOIN attendance_assignment_record 
    ON checklist_record.checklist_id =  attendance_assignment_record.checklist_id 
    WHERE checklist_record.batch LIKE '%$batch%' AND checklist_record.testing_started_at != '' AND (checklist_record.checklist_type = 'Class' OR checklist_record.checklist_type = 'Offline') AND checklist_record.class_date between '$from' and '$to'";

$runForClassDate =  mysqli_query($connect,$query);

// $runForClassDate = all_class_from_date_WithTesting($from,$to);
while($dataForClassDate = mysqli_fetch_assoc($runForClassDate)){

    $classFromDate[] = array("checklist_id" => $dataForClassDate['checklist_id'],"class_date" => $dataForClassDate['class_date'],
"class_id_from_lecture_list" => $dataForClassDate['class_id_from_lecture_list'],"batch_coordinator" => $dataForClassDate['batch_coordinator'],
"time_slot" => $dataForClassDate['time_slot'],"checklist_type" => $dataForClassDate['checklist_type'],"faculty" => $dataForClassDate['faculty'],
"venue" => $dataForClassDate['venue'],"batch" => $dataForClassDate['batch'],"subject" => $dataForClassDate['subject'],"att_ass_id" => $dataForClassDate['att_ass_id'],
"att_ass_id" => $dataForClassDate['att_ass_id'],"attendance" => $dataForClassDate['attendance'],"response" => $dataForClassDate['response'],
"assignment" => $dataForClassDate['assignment']); 

}

$classFromDateCount = count($classFromDate);


for($subject = 0; $subject < $classFromDateCount; $subject++){
    $allSubjectArray[] = array(preg_replace('/[0-9-]/', '', $classFromDate[$subject]['subject']));
     }
    
    
     $allSubjectArrayUnique = array_unique($allSubjectArray,SORT_REGULAR);
     $all_class_faculty_array_unique_reindex = array_values($allSubjectArrayUnique);
     $all_class_unique_reindex_count = count($all_class_faculty_array_unique_reindex);
     for($graph = 0; $graph < $all_class_unique_reindex_count; $graph++){?>
     
     <div class="container-fluid">
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $graph; ?>"><?php echo $all_class_faculty_array_unique_reindex[$graph][0];?></a>
        </h4>
      </div>
      <div id="collapse<?php echo $graph;?>" class="panel-collapse collapse in">
        <div class="panel-body"><table class="table table-bordered" id="myTable">
    <thead style="background-color:#1c3961; color:white;">
      <tr>
        <th>Date</th>
        <th>Batch</th>
        <th>Subject</th>
        <th>Present Students</th>
        <th>Total Students</th>
        <th>Selected Batch</th>
        <th>% Selected Batch</th>
        <th>Prob. Student</th>
        
      </tr>
    </thead>
    <?php 
    
    $subject = $all_class_faculty_array_unique_reindex[$graph][0];


    $query = "SELECT checklist_record.checklist_id,checklist_record.class_date,checklist_record.class_id_from_lecture_list,
    checklist_record.batch_coordinator,checklist_record.time_slot,checklist_record.checklist_type,checklist_record.faculty,checklist_record.venue,checklist_record.batch,checklist_record.subject,
    attendance_assignment_record.att_ass_id,attendance_assignment_record.attendance,
    attendance_assignment_record.response,attendance_assignment_record.assignment 
    FROM checklist_record LEFT JOIN attendance_assignment_record 
    ON checklist_record.checklist_id =  attendance_assignment_record.checklist_id 
    WHERE checklist_record.subject LIKE '%$subject%' AND checklist_record.batch LIKE '%$batch%' AND (checklist_record.checklist_type = 'Class' OR checklist_record.checklist_type = 'Offline') AND checklist_record.class_date between '$from' and '$to'";

    $runn = mysqli_query($connect,$query);

   
    while($dataForGraph = mysqli_fetch_assoc($runn)){

        $dataForSubectWise[] = array("checklist_id" => $dataForGraph['checklist_id'],"class_date" => $dataForGraph['class_date'],
        "class_id_from_lecture_list" => $dataForGraph['class_id_from_lecture_list'],"batch_coordinator" => $dataForGraph['batch_coordinator'],
        "time_slot" => $dataForGraph['time_slot'],"checklist_type" => $dataForGraph['checklist_type'],"faculty" => $dataForGraph['faculty'],
        "venue" => $dataForGraph['venue'],"batch" => $dataForGraph['batch'],"subject" => $dataForGraph['subject'],"att_ass_id" => $dataForGraph['att_ass_id'],
        "att_ass_id" => $dataForGraph['att_ass_id'],"attendance" => $dataForGraph['attendance'],"response" => $dataForGraph['response'],
        "assignment" => $dataForGraph['assignment']);

    }
    $dataForSubectWiseCount = count($dataForSubectWise);
    for($i = 0; $i < $dataForSubectWiseCount; $i++){
           $batchCom = $dataForSubectWise[$i]['batch'];
           $attendance = $dataForSubectWise[$i]['attendance']; //student present in combined batch
           $batchArray = explode(",",$batchCom);
           $batchArrayCount = count($batchArray);
           $totalStudentInComBatch = 0;
          for($totalStudent = 0; $totalStudent < $batchArrayCount; $totalStudent++){
           $queryForTotalStudent = "SELECT * FROM batch WHERE batch_name = '$batchArray[$totalStudent]'";
         $runForTotalStudent = mysqli_query($connect,$queryForTotalStudent);
         $dataForTotalStudent = mysqli_fetch_assoc($runForTotalStudent);
         $totalStudentInComBatch = $totalStudentInComBatch + $dataForTotalStudent['offline_students']; // total student in combined batch
       }
       $percentageOfStudent = round($offlineStudentForSelBat*100/$totalStudentInComBatch);
       $probabilityNoOfStudent = round($attendance*$percentageOfStudent/100);
  
      $newAllClassInBatch[] = array("batch" => $dataForSubectWise[$i]['batch'],
      "subject" => $dataForSubectWise[$i]['subject'],"class_date" => $dataForSubectWise[$i]['class_date'],
      "attendance" => $dataForSubectWise[$i]['attendance'],"total student in CB" => $totalStudentInComBatch,
      "Offline Student For Selected batch" => $offlineStudentForSelBat,"percentageOfStudentForSelectedBAtch" => $percentageOfStudent,
      "probabilityNoOfStudent" => $probabilityNoOfStudent);
  
  }
  $newAllClassInBatchcount = count($newAllClassInBatch);
// echo "<pre>";
// print_r($newAllClassInBatch);    
 
    ?>
    <tbody>
        <?php
        
  for($inputDate = 0; $inputDate < $datesCount; $inputDate++){

    for($datasubwise = 0; $datasubwise < $newAllClassInBatchcount; $datasubwise++ ){
        if($datesArray[$inputDate] == $newAllClassInBatch[$datasubwise]['class_date']){?>
        <tr>
        <td><?php echo $newAllClassInBatch[$datasubwise]['class_date']; ?></td>
        <td><?php $allBatch = $newAllClassInBatch[$datasubwise]['batch'];
                $allBatchArray = explode(",",$allBatch);
                $allBatchArrayCount = count($allBatchArray);
                for($i = 0; $i < $allBatchArrayCount; $i++){
                    $runForShortName = batchDetail($allBatchArray[$i]);
                    $dataForShortName = mysqli_fetch_assoc($runForShortName);
                    echo "*".$dataForShortName['batch_short_name']." ";

                }
 ?></td>
        <td><?php echo $newAllClassInBatch[$datasubwise]['subject']; ?></td>
        <td><?php echo $newAllClassInBatch[$datasubwise]['attendance']; ?></td>
        <td><?php echo $newAllClassInBatch[$datasubwise]['total student in CB']; ?></td>
        <td><?php echo $newAllClassInBatch[$datasubwise]['Offline Student For Selected batch']; ?></td>
        <td><?php echo $newAllClassInBatch[$datasubwise]['percentageOfStudentForSelectedBAtch']; ?></td>
        <td><?php echo $newAllClassInBatch[$datasubwise]['probabilityNoOfStudent']; ?></td>
        </tr>
        
        
        <?php

        }
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
unset($newAllClassInBatch);
unset($dataForSubectWise);
     }
     
     ?>


    
</body>
</html>