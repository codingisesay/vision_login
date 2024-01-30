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
  <link rel="stylesheet" href="../admin/chosen/chosen.min.css">
  <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
  <style>
    *{
        color: black;
    }
  </style>
</head>
<?php 
include('attendance_function.php');
include('attendance_navbar.php');

?>
<body>

<br>
<div class="container-fluid">
<label style="color:red;">Select Batch : </label>
<select id="select_batch" multiple style="width:500px;height:35px;">
<?php 
$query_batch="SELECT * FROM batch";
$run_batch = mysqli_query($connect,$query_batch);
while($data_batch = mysqli_fetch_assoc($run_batch)){?>
<option value="<?php echo $data_batch["batch_name"]?>"><?php echo $data_batch["batch_short_name"]?></option>;
<?php
    
}
?>
</select>
<label style="color:red;">Select Subject : </label>
<select id = "selectedSubject" style="width:400px;height:35px;">
<option>Please Select Subject</option>
    <?php 
    $queryForSubject = "SELECT * FROM subjects";
    $runForSubject = mysqli_query($connect,$queryForSubject);
    $allSubject = mysqli_fetch_all($runForSubject,MYSQLI_ASSOC);
   foreach($allSubject AS $value){?>
   
   <option><?php echo $value['subject_name']; ?></option>
   
   <?php
   }
    
    ?>
</select><br><br>
<button type="button" id="getReport" class="btn btn-success" style="height:35px;">Offline</button>
<button type="button" id="getReportOflinePercent" class="btn btn-success" style="height:35px;">Offline (%)</button>
<button type="button" id="onlinegetReport" class="btn btn-success" style="height:35px;">Online</button>
<button type="button" id="getonlinepercentage" class="btn btn-success" style="height:35px;">Online (%)</button>
<button style = "display:none;" type="button" id="getReport" class="btn btn-success" style="height:35px;">Offline Online</button>
<button style = "display:none;" type="button" id="getReport" class="btn btn-success" style="height:35px;">Offline Online (%)</button>
<div id="chartContainer" style="height: 500px; width: 100%;"></div><br><br>
<div id="load_table_data">
</div>
</div>
</body>
<script type="text/javascript" src="../admin/admin_js/jquery.js"></script>
<script src="../admin/chosen/chosen.jquery.min.js"></script>
<script type="text/javascript">
   
$(document).ready(function(){
    $("#select_batch").chosen();
    $("#getReport").on("click",function(){

        var selectedBatch = $("#select_batch").val();
        var batch = selectedBatch.toString();
        var subject = $("#selectedSubject").val();
        // console.log(batch);
        // console.log(subject);
        $.ajax({
            url:"subjectGraphCompression.php",
            type:"POST",
            data:{batch:batch,subject:subject},
            success:function(data){
             $("#chartContainer").html(data);
             $.ajax({
            url:"subjectTableCompression.php",
            type:"POST",
            data:{batch:batch,subject:subject},
            success:function(data){
             $("#load_table_data").html(data);
            }
             })
            }
        })

        
    })

    $("#getReportOflinePercent").on("click",function(){

var selectedBatch = $("#select_batch").val();
var batch = selectedBatch.toString();
var subject = $("#selectedSubject").val();
// console.log(batch);
// console.log(subject);
$.ajax({
    url:"OflinePercentagesubjectGraphCompression.php",
    type:"POST",
    data:{batch:batch,subject:subject},
    success:function(data){
     $("#chartContainer").html(data);
     $.ajax({
    url:"OflinePercentagesubjectTableCompression.php",
    type:"POST",
    data:{batch:batch,subject:subject},
    success:function(data){
     $("#load_table_data").html(data);
    }
     })
    }
})


})

$("#onlinegetReport").on("click",function(){

var selectedBatch = $("#select_batch").val();
var batch = selectedBatch.toString();
var subject = $("#selectedSubject").val();
// console.log(batch);
// console.log(subject);
$.ajax({
    url:"onlineGraphCompression.php",
    type:"POST",
    data:{batch:batch,subject:subject},
    success:function(data){
     $("#chartContainer").html(data);
     $.ajax({
    url:"onlineTableCompression.php",
    type:"POST",
    data:{batch:batch,subject:subject},
    success:function(data){
     $("#load_table_data").html(data);
    }
     })
    }
})


})

$("#getonlinepercentage").on("click",function(){

var selectedBatch = $("#select_batch").val();
var batch = selectedBatch.toString();
var subject = $("#selectedSubject").val();
// console.log(batch);
// console.log(subject);
$.ajax({
    url:"onlineGraphPercentageCompression.php",
    type:"POST",
    data:{batch:batch,subject:subject},
    success:function(data){
     $("#chartContainer").html(data);
     $.ajax({
    url:"onlineTablePercentageCompression.php",
    type:"POST",
    data:{batch:batch,subject:subject},
    success:function(data){
     $("#load_table_data").html(data);
    }
     })
    }
})


})


})


</script>