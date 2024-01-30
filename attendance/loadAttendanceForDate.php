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
<script src="library/Excel-like-Bootstrap-Table-Sorting-Filtering-Plugin/dist/excel-bootstrap-table-filter-bundle.js"></script>
<link rel="stylesheet" href="library/Excel-like-Bootstrap-Table-Sorting-Filtering-Plugin/src/excel-bootstrap-table-filter-style.css">
</head>
<?php
include('attendance_function.php');
$date = $_POST['input_date'];
$RunForDAte = AllClassAtDate($date);
while($DataForDate = mysqli_fetch_assoc($RunForDAte)){

        $ArrayForDAte[] = array("checklist Id" => $DataForDate['checklist_id'],"class date" => $DataForDate['class_date'],"Time Slot" => $DataForDate['time_slot'],"Checklist Type" => $DataForDate['checklist_type'],
        "Faculty" =>$DataForDate['faculty'], "Venue" =>$DataForDate['venue'],"class id" => $DataForDate['class_id_from_lecture_list'],"Coordinator Name" => $DataForDate['batch_coordinator'],"Batch" => $DataForDate['batch'],
        "subject" => $DataForDate['subject'],"AttAssId" => $DataForDate['att_ass_id'],"Attendance" => $DataForDate['attendance'],
        "Response" => $DataForDate['response'],"Assignment" => $DataForDate['assignment']);
    
}

$ArrayForDateCount = count($ArrayForDAte);


?>
<br>
<div class="container-fluid">
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><?php echo $date;  ?></a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body">
        
        <table class="table table-bordered">
    <thead style="background-color:#1c3961; color:white;">
    <tr>
        <th style="color:white;">Time Slot</th>
        <th style="color:white;">Date</th>
        <th style="color:white;">Coordinator Name</th>
        <th style="color:white;">Batch</th>
        <th style="color:white;">Subject Name</th>
        <th style="color:white;">Number</th>
        <th style="color:white;">Faculty</th>
        <th style="color:white;">Venue</th>
        <th style="color:white;">Atten.</th>
        <th style="color:white;">Resp.</th>
        <th style="color:white;">Assig.</th>
      </tr>
    </thead>
    <tbody class="myTable">
    <?php 
    for($Class = 0; $Class < $ArrayForDateCount; $Class++){?>
        <tr>
        <td><?php echo $ArrayForDAte[$Class]['Time Slot'];?></td>
        <td><?php $OrDate = $ArrayForDAte[$Class]['class date']; echo $CorrectFormat = date("d-m-Y", strtotime($OrDate))?></td>
        <td><?php echo $result = preg_replace('/[0-9-]/', '', $ArrayForDAte[$Class]['Coordinator Name']); ?></td>
        <td><?php 
        if($ArrayForDAte[$Class]['Checklist Type'] == 'Discussion'){

            echo "*".$ArrayForDAte[$Class]['Batch']; 

        }else{

        $str = $ArrayForDAte[$Class]['Batch']; 
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

        }
        
        
        
        ?></td>
        <td><?php echo $res = preg_replace('/[0-9-]+/', '', $ArrayForDAte[$Class]['subject']); ?></td>
        <td><?php echo $SubName = preg_replace('/[A-Za-z-]+/', '', $ArrayForDAte[$Class]['subject']); ?></td>
        <td><?php echo $ArrayForDAte[$Class]['Faculty'];?></td>
        <td><?php echo $ArrayForDAte[$Class]['Venue']?></td>
        <td><?php echo $ArrayForDAte[$Class]['Attendance']; ?></td>
        <td><?php echo $ArrayForDAte[$Class]['Response']; ?></td>
        <td><?php echo $ArrayForDAte[$Class]['Assignment']; ?></td>


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
<script>
$(document).ready(function(){
    $('table').excelTableFilter();
})
</script>