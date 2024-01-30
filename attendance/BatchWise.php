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
  <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
  <style>
       *{
        color: black;
    }
  

 
 
</style>

</head>
<body>
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

<div class="container-fluid">
  
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Update Assignment And Attendance Record</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body"><table class="table table-bordered" id="myTable">
    <thead style="background-color:#1c3961; color:white;">
<tr>
    <th style="background-color: #3d59a6; color:white;">Timing</th>
    <th style="background-color: #3d59a6; color:white;">Batch</th>
    <th style="background-color: #3d59a6; color:white;">Total</th>
    <th style="background-color: #804b54; color:white;">7DA</th>
    <th style="background-color: #804b54; color:white;">7DM</th>
    <th style="background-color: #804b54; color:white;">21DA</th>
    <th style="background-color: #804b54; color:white;">21DM</th>
    <th style="background-color: #4b7a80; color:white;">Graph</th>

  </tr>

  </thead>
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
    WHERE batch = '$batchSevenDay' AND checklist_record.testing_started_at != '' ORDER BY checklist_id desc LIMIT 21";
    $run = mysqli_query($connect,$query);
    while($dataTotalClass = mysqli_fetch_assoc($run)){

        $ArraydataTotalClass[] = array("checklist Id" => $dataTotalClass['checklist_id'],"class date" => $dataTotalClass['class_date'],"Time Slot" => $dataTotalClass['time_slot'],"Checklist Type" => $dataTotalClass['checklist_type'],
        "Faculty" =>$dataTotalClass['faculty'], "Venue" =>$dataTotalClass['venue'],"class id" => $dataTotalClass['class_id_from_lecture_list'],"Coordinator Name" => $dataTotalClass['batch_coordinator'],"Batch" => $dataTotalClass['batch'],
        "testing started at" => $dataTotalClass['testing_started_at'], "subject" => $dataTotalClass['subject'],"AttAssId" => $dataTotalClass['att_ass_id'],"Attendance" => $dataTotalClass['attendance'],
        "Response" => $dataTotalClass['response'],"Assignment" => $dataTotalClass['assignment']);
    
    }
    $dataTotalClassCount = count($ArraydataTotalClass);
   
    $ArraydataTotalClassRev = array_reverse($ArraydataTotalClass);

    //echo "<pre>";
    //print_r($ArraydataTotalClassRev);
  
    ?>
    <tbody>
    <tr>
    
    <td>
        
        <?php 
        if(strpos($batchSevenDay,",") == true){

            $queryForLastClass = "Select checklist_record.time_slot FROM checklist_record WHERE batch = '$batchSevenDay' ORDER BY checklist_id DESC LIMIT 1";
            $runForLastClass = mysqli_query($connect,$queryForLastClass);
            $dataForLastClass = mysqli_fetch_assoc($runForLastClass);
            echo $dataForLastClass['time_slot'];
            
            }else{
            
            $run = batchDetail($batchSevenDay);
            $dataBatchTime = mysqli_fetch_assoc($run);
            echo $dataBatchTime['batch_timing'];
            
            }
     ?>
    

</td>
    <td>
    <?php 
    //echo "*".str_replace(",","<br>*",$batchSevenDay); 
    //$str = $ArraydataTotalClass[$i]['Batch']; 
    $str =  $batchSevenDay;
    $arr = explode(",",$str);

    //echo "<pre>";
    //print_r($arr);
    
    $arr_count = count($arr);
    
    for($out = 0; $out < $arr_count; $out++){
    $BatchArrayDta =  $arr[$out];
    $qery = "SELECT batch_short_name FROM batch WHERE batch_name = '$BatchArrayDta'";
    $rn = mysqli_query($connect,$qery);
    $dta = mysqli_fetch_assoc($rn);
    echo $shortNAme = "*".$dta['batch_short_name']."<br>";
    }

    
    
    
    ?>
</td>
    <td>
    <?php
    echo $dataTotalClassCount;
      
    ?>
    
</td>
  <td>
    <?php
  if($dataTotalClassCount >= 7){
    $x = 0;
   for($SevenAVG = 0; $SevenAVG < 7; $SevenAVG++){
    //	x = x + y

    //echo $ArraydataTotalClass[$SevenAVG]['Attendance']."<br>";

    $x = $x + $ArraydataTotalClass[$SevenAVG]['Attendance'];

   }

   $SevenDayAvg = $x/7;
   echo round($SevenDayAvg,0,PHP_ROUND_HALF_UP); 

  }elseif($dataTotalClassCount < 7){
    
    $x = 0;
    for($SevenAVG = 0; $SevenAVG < $dataTotalClassCount; $SevenAVG++){
     //	x = x + y
 
     $x = $x + $ArraydataTotalClass[$SevenAVG]['Attendance'];
 
    }
    $SevenDayAvg = $x/$dataTotalClassCount;
    echo round($SevenDayAvg,0,PHP_ROUND_HALF_UP); 
   

  }else{
    echo "No record";
  }
   
  ?>
  </td>
  <td>
<?php
if($dataTotalClassCount >= 7){
    for($SevenMAX = 0; $SevenMAX < 7; $SevenMAX++){

        $SevenDayArray[] = array($ArraydataTotalClass[$SevenMAX]['Attendance']);

    }
    $merged_array = call_user_func_array('array_merge', $SevenDayArray);
    //echo "<pre>";
    //print_r($SevenDayArray);
    echo max($merged_array);
    unset($SevenDayArray);

}elseif($dataTotalClassCount < 7){

    for($SevenMAX = 0; $SevenMAX < $dataTotalClassCount; $SevenMAX++){

        $SevenDayArray[] = array($ArraydataTotalClass[$SevenMAX]['Attendance']);

    }
    $merged_array = call_user_func_array('array_merge', $SevenDayArray);
    //echo "<pre>";
    //print_r($SevenDayArray);
    echo max($merged_array);
    unset($SevenDayArray);

}else{
echo "No record";
}


?>
  </td>
  <td>
<?php 
if($dataTotalClassCount <= 21){
    $ToD = 0;
    for($TwentyOneDay = 0; $TwentyOneDay < $dataTotalClassCount; $TwentyOneDay++){
        //echo $ArraydataTotalClass[$TwentyOneDay]['Attendance']."<br>";
        $ToD = $ToD + $ArraydataTotalClass[$TwentyOneDay]['Attendance'];
    }
    //echo $ToD."<br>";
    $twentyOneDayAvg = $ToD/$dataTotalClassCount;
    echo round($twentyOneDayAvg,0,PHP_ROUND_HALF_UP);
    }else{
        echo "No Record";
    }

?>
  </td>
  <td>
<?php 
if($dataTotalClassCount <= 21){
    for($TwentyOneDayMAX = 0; $TwentyOneDayMAX < $dataTotalClassCount; $TwentyOneDayMAX++){

        $TwentyOneDayMAXArray[] = array($ArraydataTotalClass[$TwentyOneDayMAX]['Attendance']);

    }
    $merged_array_TwentyOneDay = call_user_func_array('array_merge', $TwentyOneDayMAXArray);
    //echo "<pre>";
    //print_r($SevenDayArray);
    echo max($merged_array_TwentyOneDay);
    unset($TwentyOneDayMAXArray);
}else{
    echo "No Record";
}


?>
  </td>
  <td>
  <?php

for($graph = 0; $graph < $dataTotalClassCount; $graph++){

    $sourse = $ArraydataTotalClassRev[$graph]['class date'];
    $date = new DateTime($sourse);
    $newFormat = $date->format('d/m/Y'); // 31/07 
   // $newFormat."<br>".$ArraydataTotalClassRev[$graph]['Faculty']."<br>".$ArraydataTotalClassRev[$graph]['subject']
   //array($newFormat,$ArraydataTotalClassRev[$graph]['Faculty'],$ArraydataTotalClassRev[$graph]['subject'])
    $dataPoints[]  = array("y" =>  $ArraydataTotalClassRev[$graph]['Attendance'],"label" => $newFormat."<br>".$ArraydataTotalClassRev[$graph]['Faculty']."<br>".$ArraydataTotalClassRev[$graph]['subject']);

}

//echo "<pre>";
//print_r($dataPoints);


 ?>

<div id="chartContainer<?php echo $i; ?>" style="width:750px;height:300px;"></div>

     
     <script>

$(document).ready(function(){

    var chart<?php echo $i; ?> = new CanvasJS.Chart("chartContainer<?php echo $i; ?>", {
    title: {
        text: "Attandance"
    },
    axisX: {

    labelFormatter: function(){
      return " ";}
    },
    axisY: {
        title: "Number Of Student"
    },
    data: [{
        type: "line",
        //nullDataLineDashType: "dashed",
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    }]

});
chart<?php echo $i; ?>.render();

});


 </script>

  </td>

   <?php
unset($dataPoints);
unset($ArraydataTotalClass);
}



?>
<tbody>
</table>
</div>
      </div>
    </div>
    
  </div> 
</div>

</body>
<script>

    $('table').excelTableFilter();
    </script>


    


