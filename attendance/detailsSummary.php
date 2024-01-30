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
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="library/Excel-like-Bootstrap-Table-Sorting-Filtering-Plugin/dist/excel-bootstrap-table-filter-bundle.js"></script>
  <link rel="stylesheet" href="library/Excel-like-Bootstrap-Table-Sorting-Filtering-Plugin/src/excel-bootstrap-table-filter-style.css">
  <style>
    *{
        color:black;
    }
</style>
</head>


<?php 
include('attendance_function.php');
include('attendance_navbar.php');


$current_date = date("Y-m-d");
$t = strtotime("-7 day");
$days_back =  date("Y-m-d",$t);

 $RunDaysBackData = all_class_from_date($days_back,$current_date);

 while($DataForBackDate = mysqli_fetch_assoc($RunDaysBackData)){

    $ArrayForBackDAte[] = array("Batch" => $DataForBackDate['batch']);

}

$batchInLAstSevenDays = array_unique($ArrayForBackDAte,SORT_REGULAR);

//echo "<pre>";
//print_r($batchInLAstSevenDays);
$batchKey = array_keys($batchInLAstSevenDays);
$CountArrayForBackDAte = count($ArrayForBackDAte);
$CountbatchInLAstSevenDays = count($batchKey);?>

<body>
  <br>
<div class="container-fluid">
  <div class="row">
    
    <div class="col-sm-6"><input type="text" id="myInput" class="form-control" placeholder="Search..." name="search" style="width:500px;">
</div>
    
  </div>
</div>
<br>
<div id = "myDIv">
<?php
    for($i = 0; $i < $CountbatchInLAstSevenDays; $i++){
    $key = $batchKey[$i];
    $batchSevenDay = $batchInLAstSevenDays[$key]['Batch'];
    
    $query = "SELECT checklist_record.checklist_id,checklist_record.class_date,checklist_record.testing_started_at,checklist_record.class_id_from_lecture_list,checklist_record.testing_started_at,
    checklist_record.batch_coordinator,checklist_record.time_slot,checklist_record.checklist_type,checklist_record.faculty,checklist_record.venue,checklist_record.batch,checklist_record.subject,
    attendance_assignment_record.att_ass_id,attendance_assignment_record.attendance,
    attendance_assignment_record.response,attendance_assignment_record.assignment 
    FROM checklist_record LEFT JOIN attendance_assignment_record 
    ON checklist_record.checklist_id =  attendance_assignment_record.checklist_id 
    WHERE batch = '$batchSevenDay' AND checklist_record.testing_started_at != '' ORDER BY checklist_id DESC LIMIT 21";
    $run = mysqli_query($connect,$query);
    while($dataTotalClass = mysqli_fetch_assoc($run)){

        $ArraydataTotalClass[] = array("checklist Id" => $dataTotalClass['checklist_id'],"class date" => $dataTotalClass['class_date'],"Time Slot" => $dataTotalClass['time_slot'],"Checklist Type" => $dataTotalClass['checklist_type'],
        "Faculty" =>$dataTotalClass['faculty'], "Venue" =>$dataTotalClass['venue'],"class id" => $dataTotalClass['class_id_from_lecture_list'],"Coordinator Name" => $dataTotalClass['batch_coordinator'],"Batch" => $dataTotalClass['batch'],
        "testing started at" => $dataTotalClass['testing_started_at'], "subject" => $dataTotalClass['subject'],"AttAssId" => $dataTotalClass['att_ass_id'],"Attendance" => $dataTotalClass['attendance'],
        "Response" => $dataTotalClass['response'],"Assignment" => $dataTotalClass['assignment']);
    
    }
    $dataTotalClassCount = count($ArraydataTotalClass);

    //echo "<pre>";
    //print_r($ArraydataTotalClass);
  
    ?>

<div class="container-fluid">
  <div class="panel-group" id="accordion" >
    <div class="panel panel-default" >
      <div class="panel-heading">
        <h4 class="panel-title" >
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>" class="myTable"><?php echo str_replace(","," ",$batchSevenDay); ?></a>
        </h4>
      </div>
      <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse">
        <div class="panel-body">
        <table class="table table-bordered" id="tab<?php echo $i; ?>" >
    <thead>
    <tr style="background-color: #1c3961;">
        <th style="color:white;">Time Slot</th>
        <th style="color:white;">Date</th>
        <th style="color:white;">Coordinator Name</th>
        <th style="color:white;" >Batch</th>
        <th style="color:white;">Subject Name</th>
        <th style="color:white;">Number</th>
        <th style="color:white;">Faculty</th>
        <th style="color:white;">Venue</th>
        <th style="color:white;">Atten.</th>
        <th style="color:white;">Resp.</th>
        <th style="color:white;">Assig.</th>

  </tr>
    </thead>
<tbody>

<?php 
        for($displayData = 0; $displayData < $dataTotalClassCount; $displayData++){?>
       <tr>
        <td><?php echo $ArraydataTotalClass[$displayData]['Time Slot']; ?></td>
        <td><?php 
        $sourse = $ArraydataTotalClass[$displayData]['class date'];
        $date = new DateTime($sourse);
        echo $newFormat = $date->format('d-m-Y');
        
        ?></td>
        <td><?php echo $result = preg_replace('/[0-9-]/', '', $ArraydataTotalClass[$displayData]['Coordinator Name']); ?></td>
        <td><?php
        $str = $ArraydataTotalClass[$displayData]['Batch']; 
        $arr = explode(",",$str);

        //echo "<pre>";
        //print_r($arr);
        
        $arr_count = count($arr);
        
        for($out = 0; $out < $arr_count; $out++){
        $BatchArrayDta =  $arr[$out];
        $qery = "SELECT batch_short_name FROM batch WHERE batch_name = '$BatchArrayDta'";
        $rn = mysqli_query($connect,$qery);
        $dta = mysqli_fetch_assoc($rn);
        echo $shortNAme = "*".$dta['batch_short_name'];
        }
?>

        </td>
        <td><?php echo $res = preg_replace('/[0-9-]+/', '', $ArraydataTotalClass[$displayData]['subject']); ?></td>
        <td><?php echo $SubName = preg_replace('/[A-Za-z-]+/', '', $ArraydataTotalClass[$displayData]['subject']); ?></td>
        <td><?php echo $ArraydataTotalClass[$displayData]['Faculty'];?></td>
        <td><?php echo $ArraydataTotalClass[$displayData]['Venue']?></td>
        <td><?php echo $ArraydataTotalClass[$displayData]['Attendance']; ?></td>
        <td><?php echo $ArraydataTotalClass[$displayData]['Response']; ?></td>
        <td><?php echo $ArraydataTotalClass[$displayData]['Assignment']; ?></td>
        
        </tr>
        
  
        <?php
         
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
unset($ArraydataTotalClass);?>

<script>
$('#tab<?php echo $i; ?>').excelTableFilter();
</script>

<?php

 }
?>
</div>

      <script>

$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    //console.log(value);
    $("#myDIv .container-fluid").filter(function() {
      console.log(this,)
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      
    
    });
  });
});
</script>
</body>

