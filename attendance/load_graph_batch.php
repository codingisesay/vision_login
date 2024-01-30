<?php 
include('../session.php');
// // //error_reporting(0);
// // ini_set('session.gc_maxlifetime', 2592000);
// // //ini_set('session.save_path', '/var/lib/php/sessions');
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
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
<!-- <head>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</head> 

<body>
  <div id="chartContainer" style="height: 300px; width: 100%;">
  </div>
</body> -->

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
    
    $previousDateClassArrayCount = count($previousDateClassArray);

    // echo "<pre>";
    // print_r($previousDateClassArray);
 
    for($batchClss = 0; $batchClss < $previousDateClassArrayCount;$batchClss++){
        if($batch == $previousDateClassArray[$batchClss]['Batch']){
         
            $sourse = $previousDateClassArray[$batchClss]['class date'];
            $date = new DateTime($sourse);
            $newFormat = $date->format('d/m/Y'); 
             $t = $previousDateClassArray[$batchClss]['Attendance'];
             $T = intval($t);
             //var_dump($T);
            $dataPoints[]  = array("label" => $newFormat."<br>".$previousDateClassArray[$batchClss]['Faculty']."<br>".$previousDateClassArray[$batchClss]['subject'],"y" => $T, "indexLabel" => "$T");
            

        }
       

      }

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
    
    $previousDateClassArrayCount = count($previousDateClassArray);

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
        $newFormat = $date->format('d/m/Y'); 
    
        $dataPoints[]  = array("label" => $newFormat."<br>".$previousDateClassArray[$batchClss]['Faculty']."<br>".$previousDateClassArray[$batchClss]['subject'], "y" => $t, 'indexLabel' => "$t");
      }

    
      
      }

    }

    // echo "<pre>";
    // print_r($dataPoints);

}

?>
  <script type="text/javascript">
//    window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer",
    {
        theme:"light2",
       animationEnabled: true,

      title:{
        text: "Batch Attendance"
      },

            axisY :{
            title: "Number of Students",
            lineColor: "#4F81BC",
            tickColor: "#4F81BC",
            labelFontColor: "#4F81BC"

        },
        axisX: {
 labelFormatter: function(e){
  if(e.label != null){
    XaxisValue1 = e.label;
  XaxisValue = XaxisValue1.split("<br>");

   //return Object.keys(e);
   
   return XaxisValue[0];

  }else{
    return " ";
  }
 
 }
},
        toolTip: {
            content: "{label}{name}: {y}"
        },
        

        legend: {
            cursor: "pointer",
            itemclick: function (e) {
                if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                } else {
                    e.dataSeries.visible = true;
                }

                e.chart.render();
            }
        },
        
        options: {
        maintainAspectRatio: false,
        responsive: true,
      
    },

  
      data: [
      {
        type: "line",
            showInLegend: true,
            connectNullData:true,
            name: "",
            dataPoints : <?php echo json_encode($dataPoints);?>
      },


      ]
    });

    chart.render();
 // }
  </script>



