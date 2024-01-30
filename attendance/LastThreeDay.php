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
        color: black;
    }
  </style>
</head>
<?php 
//echo $current_date = date("Y-m-d");
//$t = strtotime("-10 day");
//echo $ten_day_back =  date("Y-m-d",$t);
include('attendance_function.php');
include('attendance_navbar.php');

$current_date = date("Y-m-d")."<br>";
$t = strtotime("-2 day");
$ten_day_back =  date("Y-m-d",$t);

for($i = 2; $i >= 1; $i--){
 
    $dt = strtotime("-$i day");
    $three_day_date = date("Y-m-d",$dt);
    $three_day_array[] = array("date" => $three_day_date);

}

array_push($three_day_array,array("date" => date("Y-m-d")));

$fromDate = $three_day_array[0]['date'];
$ToDate = $three_day_array[2]['date'];

$RunThreeDayData = all_class_from_date($fromDate,$ToDate);

$RunThreeDayDataCount = count($three_day_array);

while($DataThreeDayData = mysqli_fetch_assoc($RunThreeDayData)){

    $ArrayThreeDayData[] = array("checklist Id" => $DataThreeDayData['checklist_id'],"class date" => $DataThreeDayData['class_date'],"Time Slot" => $DataThreeDayData['time_slot'],"Checklist Type" => $DataThreeDayData['checklist_type'],
    "Faculty" =>$DataThreeDayData['faculty'], "Venue" =>$DataThreeDayData['venue'],"class id" => $DataThreeDayData['class_id_from_lecture_list'],"Coordinator Name" => $DataThreeDayData['batch_coordinator'],"Batch" => $DataThreeDayData['batch'],
    "subject" => $DataThreeDayData['subject'],"AttAssId" => $DataThreeDayData['att_ass_id'],"Attendance" => $DataThreeDayData['attendance'],
    "Response" => $DataThreeDayData['response'],"Assignment" => $DataThreeDayData['assignment']);

}

$ArrayThreeDayDataCount = count($ArrayThreeDayData);

//echo "<pre>";
//print_r($ArrayThreeDayData);



?>
<body>
</br>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-6"><input type="date" id="input_date" class="form-control" style="width:500px;display:inline; margin-right:5px;"><button type="button" id="DateSubmit" class="btn btn-info">Submit</button></div>
    <div class="col-sm-6"><input type="text" id="myInput" class="form-control" placeholder="Search..." name="search" style="width:500px;">
</div>
    
  </div>
</div>
<div id="t1">
</br>
<?php
for($ThreeDay = 0; $ThreeDay < $RunThreeDayDataCount;$ThreeDay++){?>
<div class="container-fluid">
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $ThreeDay; ?>" class="myTable"><?php $OrgDate = $three_day_array[$ThreeDay]['date']; echo $newDate = date("d-m-Y", strtotime($OrgDate));  ?></a>
        </h4>
      </div>
      <div id="collapse<?php echo $ThreeDay; ?>" class="panel-collapse collapse">
        <div class="panel-body">
        
        <table class="table table-bordered" id="table<?php echo $ThreeDay; ?>">
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
    <tbody >
    <?php 
    for($TotalClass = 0; $TotalClass < $ArrayThreeDayDataCount;$TotalClass++){
        if($three_day_array[$ThreeDay]['date'] == $ArrayThreeDayData[$TotalClass]['class date']){?>
        <tr>
        <td><?php echo $ArrayThreeDayData[$TotalClass]['Time Slot'];?></td>
        <td><?php $OrDate = $ArrayThreeDayData[$TotalClass]['class date']; echo $CorrectFormat = date("d-m-Y", strtotime($OrDate))?></td>
        <td><?php echo $result = preg_replace('/[0-9-]/', '', $ArrayThreeDayData[$TotalClass]['Coordinator Name']); ?></td>
        <td><?php 
        if($ArrayThreeDayData[$TotalClass]['Checklist Type'] == 'Discussion'){

            echo "*".$ArrayThreeDayData[$TotalClass]['Batch']; 

        }else{

        $str = $ArrayThreeDayData[$TotalClass]['Batch']; 
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

        }
        
        
        
        ?></td>
        <td><?php echo $res = preg_replace('/[0-9-]+/', '', $ArrayThreeDayData[$TotalClass]['subject']); ?></td>
        <td><?php echo $SubName = preg_replace('/[A-Za-z-]+/', '', $ArrayThreeDayData[$TotalClass]['subject']); ?></td>
        <td><?php echo $ArrayThreeDayData[$TotalClass]['Faculty'];?></td>
        <td><?php echo $ArrayThreeDayData[$TotalClass]['Venue']?></td>
        <td><?php echo $ArrayThreeDayData[$TotalClass]['Attendance']; ?></td>
        <td><?php echo $ArrayThreeDayData[$TotalClass]['Response']; ?></td>
        <td><?php echo $ArrayThreeDayData[$TotalClass]['Assignment']; ?></td>


    </tr>

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
</div>
<div id="load_table"></div>
</body>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".myTable").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
  $("#DateSubmit").on("click",function(){
    var input_date = $("#input_date").val();
    //console.log(input_date);
    $.ajax({
        url:"loadAttendanceForDate.php",
        type:"POST",
        data:{input_date:input_date},
        success:function(data){
            $("#t1").hide();
            $("#load_table").html(data);

        }


    })

  })

  
});
$('#table0').excelTableFilter();
$('#table1').excelTableFilter();
$('#table2').excelTableFilter();
</script>

