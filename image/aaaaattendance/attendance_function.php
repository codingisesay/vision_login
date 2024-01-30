<?php 
function load_all_checklist_date($date){
    include('../database_connection.php');
    $query = "SELECT checklist_record.checklist_id,checklist_record.class_date,checklist_record.class_id_from_lecture_list,checklist_record.batch_coordinator,
    checklist_record.batch,checklist_record.subject,attendance_assignment_record.att_ass_id,
    attendance_assignment_record.attendance,attendance_assignment_record.response,attendance_assignment_record.assignment FROM checklist_record LEFT JOIN attendance_assignment_record ON checklist_record.checklist_id =  attendance_assignment_record.checklist_id WHERE checklist_record.class_date = '$date'";
    return $run = mysqli_query($connect, $query);
}
function fetch_user_name_by_id($user_id){
    include('../database_connection.php');
    $query = "SELECT * FROM user WHERE user_id = '$user_id'";
    return $run = mysqli_query($connect,$query);
}

function all_class_from_date($from_date,$to_date){
    include('../database_connection.php');
    $query = "SELECT checklist_record.checklist_id,checklist_record.class_date,checklist_record.class_id_from_lecture_list,
    checklist_record.batch_coordinator,checklist_record.time_slot,checklist_record.checklist_type,checklist_record.faculty,checklist_record.venue,checklist_record.batch,checklist_record.subject,
    attendance_assignment_record.att_ass_id,attendance_assignment_record.attendance,
    attendance_assignment_record.response,attendance_assignment_record.assignment 
    FROM checklist_record LEFT JOIN attendance_assignment_record 
    ON checklist_record.checklist_id =  attendance_assignment_record.checklist_id 
    WHERE (checklist_record.checklist_type = 'Class' OR checklist_record.checklist_type = 'Offline') AND checklist_record.class_date between '$from_date' and '$to_date'";
    return mysqli_query($connect,$query);
    mysqli_close($connect);
  
  }

  function AllClassAtDate($date){
    include('../database_connection.php');
    $query = "SELECT checklist_record.checklist_id,checklist_record.class_date,checklist_record.class_id_from_lecture_list,
    checklist_record.batch_coordinator,checklist_record.time_slot,checklist_record.checklist_type,checklist_record.faculty,checklist_record.venue,checklist_record.batch,checklist_record.subject,
    attendance_assignment_record.att_ass_id,attendance_assignment_record.attendance,
    attendance_assignment_record.response,attendance_assignment_record.assignment 
    FROM checklist_record LEFT JOIN attendance_assignment_record 
    ON checklist_record.checklist_id =  attendance_assignment_record.checklist_id 
    WHERE checklist_record.class_date = '$date'";
    return mysqli_query($connect,$query);
    mysqli_close($connect);


  }

  function FetchAllDataFromBatch(){
    include('../database_connection.php');
    $query = "SELECT * FROM batch";
    return mysqli_query($connect,$query);
  }

  function batchDetail($batch){
    include('../database_connection.php');
    $query = "SELECT * FROM batch WHERE batch_name = '$batch'";
    return $run = mysqli_query($connect,$query);

  }

  // function AttandanceRatio(array $allClassInBatch,$batch){
  //   include('../database_connection.php');

    
  //   for($i = 0; $i < $allClassInBatchcount; $i++){
  //     $batchCom = $allClassInBatch[$i]['batch'];
  //     $attendance = $allClassInBatch[$i]['attendance'];
  //     $batchArray = explode(",",$batchCom);
  //     $batchArrayCount = count($batchArray);
  //     $x = 0;
  //     for($totalStudent = 0; $totalStudent < $batchArrayCount; $totalStudent++){
  //     $query = "SELECT * FROM batch WHERE batch_name = '$batchArray[$totalStudent]'";
  //     $run = mysqli_query($connect,$query);
  //     $data = mysqli_fetch_assoc($run);
  //      $x = $x + $data['offline_students'];
  //     }
      
  //     for($j = 0; $j < $batchArrayCount; $j++){
  //     $query = "SELECT * FROM batch WHERE batch_name = '$batchArray[$j]'";
  //     $run = mysqli_query($connect,$query);
  //     $data = mysqli_fetch_assoc($run);
  //     $attandacePercentage = round($data['offline_students']*100/$x);
  //     $t = round($attendance*$attandacePercentage/100);
      
  //     }
  //   }


  // }

  function all_class_from_date_WithTesting($from_date,$to_date){
    include('../database_connection.php');
    $query = "SELECT checklist_record.checklist_id,checklist_record.class_date,checklist_record.class_id_from_lecture_list,
    checklist_record.batch_coordinator,checklist_record.time_slot,checklist_record.checklist_type,checklist_record.faculty,checklist_record.venue,checklist_record.batch,checklist_record.subject,
    attendance_assignment_record.att_ass_id,attendance_assignment_record.attendance,
    attendance_assignment_record.response,attendance_assignment_record.assignment 
    FROM checklist_record LEFT JOIN attendance_assignment_record 
    ON checklist_record.checklist_id =  attendance_assignment_record.checklist_id 
    WHERE checklist_record.testing_started_at != '' AND (checklist_record.checklist_type = 'Class' OR checklist_record.checklist_type = 'Offline') AND checklist_record.class_date between '$from_date' and '$to_date'";
    return mysqli_query($connect,$query);
    mysqli_close($connect);
  
  }

?>