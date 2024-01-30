<?php 
error_reporting(0);
ini_set('session.gc_maxlifetime', 2592000);
//ini_set('session.save_path', '/var/lib/php/sessions');
session_start();
include('../database_connection.php');
include('../functions.php');
$device_cookie=$_COOKIE['PHPSESSID'];
$user_id=$_SESSION['id'];
$row_of_specific_device = specific_device_from_login_log($device_cookie,$user_id);
mysqli_num_rows($row_of_specific_device);
$data = mysqli_fetch_assoc($row_of_specific_device);

if(!isset($_SESSION['id']) || !isset($_COOKIE['PHPSESSID']) || $data['session_status'] == "inactive"){

    $q="UPDATE login_log
        SET session_status='inactive'
        WHERE device_cookie='$device_cookie' OR user_id = '$user_id'";
        $result = mysqli_query($connect,$q);

         page_redirect('../index.php');
}
?>
<?php 
include('attendance_function.php');
//5564,5563
$selectedBatch = $_REQUEST['batch'];
$batchInArray = explode(",",$selectedBatch);
// $batchInArray = array('5563_RB20_2024_ENG','5564_RB21_2024_ENG');
$batchInArrayCount = count($batchInArray);
$subject = $_REQUEST['subject'];
// $subject = "Polity";?>
<script type="text/javascript">
    var chart = new CanvasJS.Chart("chartContainer",
{
    theme:"light2",
   animationEnabled: true,

  title:{
    text: "Attendance"},

        axisY :{
        title: "Attendance in %",
        lineColor: "#4F81BC",
        tickColor: "#4F81BC",
        labelFontColor: "#4F81BC"

    },

    toolTip: {
        content: "{label}<?php echo"<br>";?>{name}: {y}"
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

<?php

for($i = 0; $i < $batchInArrayCount; $i++){
    $batchSep = $batchInArray[$i];
    $queryForSelectedBatchClass = "SELECT checklist_record.checklist_id,checklist_record.class_date,checklist_record.class_id_from_lecture_list,
    checklist_record.batch_coordinator,checklist_record.time_slot,checklist_record.checklist_type,checklist_record.faculty,checklist_record.venue,checklist_record.batch,checklist_record.subject,
        attendance_assignment_record.att_ass_id,attendance_assignment_record.attendance,
        attendance_assignment_record.response,attendance_assignment_record.assignment,user.user_mail_id
        FROM checklist_record LEFT JOIN attendance_assignment_record ON checklist_record.checklist_id =  attendance_assignment_record.checklist_id 
        LEFT JOIN user ON checklist_record.batch_coordinator = user.user_name WHERE checklist_record.batch LIKE '%$batchSep%' AND checklist_record.subject LIKE '%$subject%' AND checklist_record.testing_started_at != '' AND (checklist_record.checklist_type = 'Class' OR checklist_record.checklist_type = 'Offline') ORDER BY checklist_record.class_id_from_lecture_list ASC;";
    $runForSelectedBatchClass = mysqli_query($connect,$queryForSelectedBatchClass);?>
       {
           type: "line",
            showInLegend: true,
            connectNullData:true,
            name: "<?php $runForShort = batchDetail($batchSep); $dataForShort = mysqli_fetch_assoc($runForShort); echo $dataForShort['batch_short_name']; ?>",
            dataPoints: [
    
    <?php

    while($data = mysqli_fetch_assoc($runForSelectedBatchClass)){
     $batch = $data['batch'];
     $attendence = $data['attendance'];
     if(strpos($batch,',')){
        $batchCombine = explode(",",$batch);
        $batchCombineCount = count($batchCombine);
        $totalCombStudent = 0;
        $totalStudentofSelectedBatch = 0;
        for($j = 0; $j < $batchCombineCount;$j++){
            $runForTotalStu = batchDetail($batchCombine[$j]);
            $dataForTotalStu = mysqli_fetch_assoc($runForTotalStu);
            $totalCombStudent = $totalCombStudent+$dataForTotalStu['offline_students'];
            if($batchInArray[$i] == $batchCombine[$j]){
                $runtotalStudentofSelectedBatch = batchDetail($batchCombine[$j]);
                $datatotalStudentofSelectedBatch = mysqli_fetch_assoc($runtotalStudentofSelectedBatch);
                $totalStudentofSelectedBatch = $datatotalStudentofSelectedBatch['offline_students'];
            }
        }
       $totalCombStudent;
       $attendence = $data['attendance'];
       $totalStudentofSelectedBatch;
       $percentageOfselectedbatch = round($totalStudentofSelectedBatch*100/$totalCombStudent);
       $noOfStudentInSelectedBatch = round($attendence*$percentageOfselectedbatch/100);
       $attend = intval(round($noOfStudentInSelectedBatch*100/$totalStudentofSelectedBatch));

     }else{
        $runForBatchAtt = batchDetail($batch);
        $dataForBatchAtt = mysqli_fetch_assoc($runForBatchAtt);
        $offlineStudent = $dataForBatchAtt['offline_students'];
        $attend = intval(round($attendence*100/$offlineStudent));
        // $attend = intval($t);
        
     }?>
        { label: "<?php echo $data['class_date'];?>",  y: <?php echo $attend; ?>, indexLabel : "<?php echo $attend.'%'?>"},

     <?php

    //  $allClassArray[] = array("checklist Id" => $data['checklist_id'],"checklist_type" => $data['checklist_type'], "class date" => $data['class_date'],
    //  "class id" => $data['class_id_from_lecture_list'],"Coordinator Name" => $data['batch_coordinator'],"Batch" => $data['batch'],
    //  "subject" => $data['subject'],"Batch Coo MailID" =>$data['user_mail_id'],"AttAssId" => $data['att_ass_id'],"Attendance" => $attend,
    //  "Response" => $data['response'],"Assignment" => $data['assignment']);
    }?>
    ]
},
    <?php
}

?>

]
});
    
    chart.render();