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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="library/Excel-like-Bootstrap-Table-Sorting-Filtering-Plugin/dist/excel-bootstrap-table-filter-bundle.js"></script>
  <link rel="stylesheet" href="library/Excel-like-Bootstrap-Table-Sorting-Filtering-Plugin/src/excel-bootstrap-table-filter-style.css">
  <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
 

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="library/live-search-jquery/css/bootstrap/bootstrap.min.css">
        <script src="library/live-search-jquery/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
<?php 
include('attendance_function.php');
include('attendance_navbar.php');

if(isset($_POST['submit_date'])){

    $from_date = $_POST['fromDate'];
    $to_date = $_POST['toDate'];

}
//$from_date = '2023-09-01';
//$to_date = '2023-09-10';
$runForClassDate = all_class_from_date($from_date,$to_date);
while($dataForClassDate = mysqli_fetch_assoc($runForClassDate)){

    $classFromDate[] = array("checklist_id" => $dataForClassDate['checklist_id'],"class_date" => $dataForClassDate['class_date'],
"class_id_from_lecture_list" => $dataForClassDate['class_id_from_lecture_list'],"batch_coordinator" => $dataForClassDate['batch_coordinator'],
"time_slot" => $dataForClassDate['time_slot'],"checklist_type" => $dataForClassDate['checklist_type'],"faculty" => $dataForClassDate['faculty'],
"venue" => $dataForClassDate['venue'],"batch" => $dataForClassDate['batch'],"subject" => $dataForClassDate['subject'],"att_ass_id" => $dataForClassDate['att_ass_id'],
"att_ass_id" => $dataForClassDate['att_ass_id'],"attendance" => $dataForClassDate['attendance'],"response" => $dataForClassDate['response'],
"assignment" => $dataForClassDate['assignment']); 

}
//echo "<pre>";
//print_r($classFromDate);

$classFromDateCount = count($classFromDate);
for($facultyToFrom = 0; $facultyToFrom <= $classFromDateCount;$facultyToFrom++){
    
    $facultyToFromArray[] = array("faculty" => $classFromDate[$facultyToFrom]['faculty']);
    
}

//echo "<pre>";
//print_r($facultyToFromArray);

$facultyToFromArrayUnique = array_unique($facultyToFromArray,SORT_REGULAR);
$facultyToFromArrayUnique_reindex = array_values($facultyToFromArrayUnique);
$facultyToFromArrayUniqueCount = count($facultyToFromArrayUnique_reindex);

//echo "<pre>";
//print_r($facultyToFromArrayUnique);

?>
<br>

  <div class="container-fluid">
  
  <form class="form-inline" method="POST" action="<?php $_SERVER["PHP_SELF"]; ?>">
    
      <label for="email">From:</label>
      <input type="date" class="form-control" name="fromDate" value="<?php echo $from_date; ?>" id="fromdatebatch" required>
   
   
      <label for="pwd">To:</label>
      <input type="date" class="form-control" name="toDate" value ="<?php echo $to_date; ?>" id="todatebatch" required>
    
   
    <button type="submit" class="btn btn-primary" name="submit_date">Submit</button>
  </form>
</div>
<br>
<?php 
if($from_date != ""){?>
<div class="container-fluid">
<h4>Date From: <?php echo date("d-m-Y", strtotime($from_date));  ?> To: <?php echo date("d-m-Y", strtotime($to_date)); ?></h4>
</div><br>

<?php
}

?>

<div class="container-fluid">
<div class="row">
<div class="col-sm-12">
<div id="bts-ex-5" class="selectpicker" data-clear="true" data-live="true">
<a href="#" class="clear"><span class="fa fa-times"></span><span class="sr-only">Cancel the selection</span></a>
<button data-id="prov" type="button" class="btn btn-lg btn-block btn-default dropdown-toggle">
<span class="placeholder">First Select Date</span>
<span class="caret"></span>
</button>
<div class="dropdown-menu">
<div class="live-filtering" data-clear="true" data-autocomplete="true" data-keys="true">
<label class="sr-only" for="input-bts-ex-5">Search in the list</label>
<div class="search-box">
<div class="input-group">
<span class="input-group-addon" id="search-icon5">
<span class="fa fa-search"></span>
<a href="#" class="fa fa-times hide filter-clear"><span class="sr-only">Clear filter</span></a>
</span>
<input type="text" placeholder="Search in the list" id="input-bts-ex-5" class="form-control live-search" aria-describedby="search-icon5" tabindex="1" />
</div>
</div>
<div class="list-to-filter">
<ul class="list-unstyled">
<li class="optgroup">
<span class="optgroup-header">List Group <span class="subtext"></span></span>
<ul class="list-unstyled">
<?php 
    for($facultyDisplayDropdown = 0; $facultyDisplayDropdown < $facultyToFromArrayUniqueCount;$facultyDisplayDropdown++){
        if($facultyToFromArrayUnique_reindex[$facultyDisplayDropdown]['faculty'] != ""){?>
        
        <li class="selectedfaculty filter-item items" data-filter="<?php echo $facultyToFromArrayUnique_reindex[$facultyDisplayDropdown]['faculty'];?>" data-value="<?php echo $facultyToFromArrayUnique_reindex[$facultyDisplayDropdown]['faculty'];?>"><?php echo $facultyToFromArrayUnique_reindex[$facultyDisplayDropdown]['faculty'];?></li>
        
        <?php

        }
        ?>
    <?php

    }
    
    ?>
    

</ul>
</li>
</ul>
<div class="no-search-results">
<div class="alert alert-warning" role="alert"><i class="fa fa-warning margin-right-sm"></i>No entry for <strong>'<span></span>'</strong> was found.</div>
</div>
</div>
</div>
</div>
<input type="hidden" name="bts-ex-5" value="">
</div>
</div>
</div><br>
<div class="row">
<div class="col-sm-12">
<button type="button" id="offline" class="btn btn-primary" data-value="<?php $facultyToFromArrayUnique[$facultyDisplayDropdown]['faculty']; ?>">Offline</button>
<button type="button" id="offline_percentage" class="btn btn-primary" data-value="<?php $facultyToFromArrayUnique[$facultyDisplayDropdown]['faculty']; ?>">Offline (%)</button>
<button type="button" id="online" class="btn btn-primary" data-value="<?php $facultyToFromArrayUnique[$facultyDisplayDropdown]['faculty']; ?>">Online</button>
<button type="button" id="online_percentage" class="btn btn-primary" data-value="<?php $facultyToFromArrayUnique[$facultyDisplayDropdown]['faculty']; ?>">Online (%)</button>
<button style = "display:none" type="button" id="offline_online" class="btn btn-primary" data-value="<?php $facultyToFromArrayUnique[$facultyDisplayDropdown]['faculty']; ?>">Offline Online</button>
<button style = "display:none" type="button" id="offline_online_percentage" class="btn btn-primary" data-value="<?php $facultyToFromArrayUnique[$facultyDisplayDropdown]['faculty']; ?>">Offline Online (%)</button>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div id="chartContainer" style="height: 370px; width: 100%;">

</div>
    </div>
</div><br><br>

</div>
</div>
<div id="load_table_data">
</div>
<script>
$(document).ready(function(){
    $("#offline").on("click",function(){
        var faculty = $(".selectedfaculty.selected").html();
        var from = $('#fromdatebatch').val();
        var to = $('#todatebatch').val();
        //console.log(faculty);
        //console.log(from);
        //console.log(to);
        if(from != ""){
        $.ajax({
            url:"loadBatchFacultyGraph.php",
            type:"POST",
            data:{faculty:faculty,from:from,to:to},
            success:function(data){
                $("#chartContainer").html(data);
                $.ajax({
        url:"load_table_faculty.php",
        type:"POST",
        data:{faculty:faculty,from:from,to:to},
        success:function(data){
         $("#load_table_data").html(data)
        }
       })
            }
        })
    }else{
alert("Please select Date First");
    }
    })

    $("#offline_percentage").on("click",function(){
        var faculty = $(".selectedfaculty.selected").html();
        var from = $('#fromdatebatch').val();
        var to = $('#todatebatch').val();
        //console.log(faculty);
        //console.log(from);
        //console.log(to);
        if(from != ""){
        $.ajax({
            url:"GraphofflinePercentageFacultyWiseAtt.php",
            type:"POST",
            data:{faculty:faculty,from:from,to:to},
            success:function(data){
                $("#chartContainer").html(data);
                $.ajax({
        url:"TablefflinePercentageFacultyWiseAtt.php",
        type:"POST",
        data:{faculty:faculty,from:from,to:to},
        success:function(data){
         $("#load_table_data").html(data)
        }
       })
            }
        })
    }else{
alert("Please select Date First");
    }
    })

    $("#online").on("click",function(){
        var faculty = $(".selectedfaculty.selected").html();
        var from = $('#fromdatebatch').val();
        var to = $('#todatebatch').val();
        //console.log(faculty);
        //console.log(from);
        //console.log(to);
        if(from != ""){
        $.ajax({
            url:"GraphOnlineFacultyWiseAtt.php",
            type:"POST",
            data:{faculty:faculty,from:from,to:to},
            success:function(data){
                $("#chartContainer").html(data);
                $.ajax({
        url:"TableOnlineFacultyWiseAtt.php",
        type:"POST",
        data:{faculty:faculty,from:from,to:to},
        success:function(data){
         $("#load_table_data").html(data);
        }
       })
            }
        })
    }else{
alert("Please select Date First");
    }
    })

    $("#online_percentage").on("click",function(){
        var faculty = $(".selectedfaculty.selected").html();
        var from = $('#fromdatebatch').val();
        var to = $('#todatebatch').val();
        //console.log(faculty);
        //console.log(from);
        //console.log(to);
        if(from != ""){
        $.ajax({
            url:"GraphOnlinePercentageFacultyWiseAtt.php",
            type:"POST",
            data:{faculty:faculty,from:from,to:to},
            success:function(data){
                $("#chartContainer").html(data);
                $.ajax({
        url:"TableOnlinePercentageFacultyWiseAtt.php",
        type:"POST",
        data:{faculty:faculty,from:from,to:to},
        success:function(data){
         $("#load_table_data").html(data)
        }
       })
            }
        })
    }else{
alert("Please select Date First");
    }
    })

    $("#offline_online").on("click",function(){
        var faculty = $(".selectedfaculty.selected").html();
        var from = $('#fromdatebatch').val();
        var to = $('#todatebatch').val();
        //console.log(faculty);
        //console.log(from);
        //console.log(to);
        if(from != ""){
        $.ajax({
            url:"GraphOnlineOfflineFacultyWiseAtt.php",
            type:"POST",
            data:{faculty:faculty,from:from,to:to},
            success:function(data){
                $("#chartContainer").html(data);
                $.ajax({
        url:"TableOnlineOfflineFacultyWiseAtt.php",
        type:"POST",
        data:{faculty:faculty,from:from,to:to},
        success:function(data){
         $("#load_table_data").html(data)
        }
       })
            }
        })
    }else{
alert("Please select Date First");
    }
    })

    $("#offline_online_percentage").on("click",function(){
        var faculty = $(".selectedfaculty.selected").html();
        var from = $('#fromdatebatch').val();
        var to = $('#todatebatch').val();
        //console.log(faculty);
        //console.log(from);
        //console.log(to);
        if(from != ""){
        $.ajax({
            url:"",
            type:"POST",
            data:{faculty:faculty,from:from,to:to},
            success:function(data){
                $("#chartContainer").html(data);
                $.ajax({
        url:"",
        type:"POST",
        data:{faculty:faculty,from:from,to:to},
        success:function(data){
         $("#load_table_data").html(data)
        }
       })
            }
        })
    }else{
alert("Please select Date First");
    }
    })

})

</script>
        <script src="library/live-search-jquery/js/vendor/jquery-2.1.4.min.js"></script>
        <script src="library/live-search-jquery/js/vendor/bootstrap.min.js"></script>
        <script src="library/live-search-jquery/js/vendor/tabcomplete.min.js"></script>
        <script src="library/live-search-jquery/js/vendor/livefilter.min.js"></script>
        <script src="library/live-search-jquery/js/vendor/src/bootstrap-select.js"></script>
        <script src="library/live-search-jquery/js/vendor/filterlist.min.js"></script>
        <script src="library/live-search-jquery/js/plugins.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
        </body>