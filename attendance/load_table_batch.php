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
$batch = trim($_POST['batch']," ");

$from = $_POST['from'];
$to = $_POST['to'];

// $from = "2023-08-01";
// $to = "2023-08-30";
// //$batch = "5210_RB05_HIN_2023";
// $batch = "5071_RB_03_2023_HIN,5142_RB_04_2023_HIN,5210_RB05_HIN_2023,5254_RB06_2023_HIN";

if(strpos($batch,',')){

    $query = "SELECT checklist_record.checklist_id,checklist_record.class_date,
    checklist_record.class_id_from_lecture_list, checklist_record.batch_coordinator,
    checklist_record.time_slot,checklist_record.checklist_type,checklist_record.faculty,
    checklist_record.venue,checklist_record.batch,checklist_record.subject, 
    attendance_assignment_record.att_ass_id,attendance_assignment_record.attendance, 
    attendance_assignment_record.response,attendance_assignment_record.assignment
     FROM checklist_record 
     LEFT JOIN attendance_assignment_record 
     ON checklist_record.checklist_id = attendance_assignment_record.checklist_id 
     WHERE checklist_record.batch LIKE '$batch' AND checklist_record.faculty != ''
     AND (checklist_record.checklist_type = 'Class' OR checklist_record.checklist_type = 'Offline') 
     AND checklist_record.class_date between '$from' and '$to'";
    
     $run = mysqli_query($connect,$query);
    
    while($previousDateClassData = mysqli_fetch_assoc($run)){
    
        $previousDateClassArray[] = array("checklist Id" => $previousDateClassData['checklist_id'],"class date" => $previousDateClassData['class_date'],"Faculty" =>$previousDateClassData['faculty'],
        "class id" => $previousDateClassData['class_id_from_lecture_list'],"Coordinator Name" => $previousDateClassData['batch_coordinator'],"Batch" => $previousDateClassData['batch'],
        "subject" => $previousDateClassData['subject'],"AttAssId" => $previousDateClassData['att_ass_id'],"Attendance" => $previousDateClassData['attendance'],
        "Response" => $previousDateClassData['response'],"Assignment" => $previousDateClassData['assignment']);
    
    }
    
    $previousDateClassArrayCount = count($previousDateClassArray);?>
    
  <div class="container-fluid">
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><?php echo $batch; ?></a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body"><table class="table table-bordered" id="myTable">
    <thead style="background-color:#1c3961; color:white;">
      <tr>
        <th>Date</th>
        <th>Batch</th>
        <th>Subject</th>
        <th>Attendance</th>
      </tr>
    </thead>
    <tbody>
 
    <?php
    for($batchClss = 0; $batchClss < $previousDateClassArrayCount;$batchClss++){
        if($batch == $previousDateClassArray[$batchClss]['Batch']){
         
            $sourse = $previousDateClassArray[$batchClss]['class date'];
            $date = new DateTime($sourse);
            $newFormat = $date->format('d/m/Y'); 
             $t = $previousDateClassArray[$batchClss]['Attendance'];
             $T = intval($t);?>
             <tr>
             <td><?php echo $newFormat; ?></td>
             <td><?php echo $previousDateClassArray[$batchClss]['Batch']; ?></td>
             <td><?php echo $previousDateClassArray[$batchClss]['subject']; ?></td>
             <td><?php echo $previousDateClassArray[$batchClss]['Attendance']; ?></td>
             </tr>
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

}else{

    $query = "SELECT checklist_record.checklist_id,checklist_record.class_date,
    checklist_record.class_id_from_lecture_list, checklist_record.batch_coordinator,
    checklist_record.time_slot,checklist_record.checklist_type,checklist_record.faculty,
    checklist_record.venue,checklist_record.batch,checklist_record.subject, 
    attendance_assignment_record.att_ass_id,attendance_assignment_record.attendance, 
    attendance_assignment_record.response,attendance_assignment_record.assignment
     FROM checklist_record 
     LEFT JOIN attendance_assignment_record 
     ON checklist_record.checklist_id = attendance_assignment_record.checklist_id 
     WHERE checklist_record.batch LIKE '%$batch%' 
     AND (checklist_record.checklist_type = 'Class' OR checklist_record.checklist_type = 'Offline') 
     AND checklist_record.class_date between '$from' and '$to'";
    
     $run = mysqli_query($connect,$query);
    
    while($previousDateClassData = mysqli_fetch_assoc($run)){
    
        $previousDateClassArray[] = array("checklist Id" => $previousDateClassData['checklist_id'],"class date" => $previousDateClassData['class_date'],"Faculty" =>$previousDateClassData['faculty'],
        "class id" => $previousDateClassData['class_id_from_lecture_list'],"Coordinator Name" => $previousDateClassData['batch_coordinator'],"Batch" => $previousDateClassData['batch'],
        "subject" => $previousDateClassData['subject'],"AttAssId" => $previousDateClassData['att_ass_id'],"Attendance" => $previousDateClassData['attendance'],
        "Response" => $previousDateClassData['response'],"Assignment" => $previousDateClassData['assignment']);
    
    }
    
    $previousDateClassArrayCount = count($previousDateClassArray);?>
    
    <div class="container-fluid">
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><?php echo $batch; ?></a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body"><table class="table table-bordered" id="myTable">
    <thead style="background-color:#1c3961; color:white;">
      <tr>
        <th>Date</th>
        <th>Batch</th>
        <th>Subject</th>
        <th>Attendance</th>
      </tr>
    </thead>
    <tbody>
    <?php

    for($batchClss = 0; $batchClss < $previousDateClassArrayCount;$batchClss++){

        $batchCom = $previousDateClassArray[$batchClss]['Batch'];
        $attendance = $previousDateClassArray[$batchClss]['Attendance'];
        $batchArray = explode(",",$batchCom);
        $batchArrayCount = count($batchArray);
        $x = 0;
      for($totalStudent = 0; $totalStudent < $batchArrayCount; $totalStudent++){
      $query = "SELECT * FROM batch WHERE batch_name = '$batchArray[$totalStudent]'";
      $run = mysqli_query($connect,$query);
      $data = mysqli_fetch_assoc($run);
       $x = $x + $data['offline_students'];
      }

    for($j = 0; $j < $batchArrayCount; $j++){
      $query = "SELECT * FROM batch WHERE batch_name = '$batchArray[$j]'";
      $run = mysqli_query($connect,$query);
      $data = mysqli_fetch_assoc($run);
      $attandacePercentage = round($data['offline_students']*100/$x);
      $t = round($attendance*$attandacePercentage/100);

      if($batchArray[$j] == $batch){
        $sourse = $previousDateClassArray[$batchClss]['class date'];
        $date = new DateTime($sourse);
        $newFormat = $date->format('d/m/Y'); ?>
           <tr>
             <td><?php echo $newFormat; ?></td>
             <td><?php echo $previousDateClassArray[$batchClss]['Batch']; ?></td>
             <td><?php echo $previousDateClassArray[$batchClss]['subject']; ?></td>
             <td><?php echo $t; ?></td>
             </tr>
        <?php
    
        //$dataPoints[]  = array("label" => $newFormat."<br>".$previousDateClassArray[$batchClss]['Faculty']."<br>".$previousDateClassArray[$batchClss]['subject'], "y" => $t, 'indexLabel' => "$t");
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

}