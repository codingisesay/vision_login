<?php 
include('../session.php');
?>
<?php 
$faculty = $_REQUEST['faculty'];
$from = $_REQUEST['from'];
$to = $_REQUEST['to'];
$SelectedSubject = $_REQUEST['SelectedSubject'];

$query = "SELECT checklist_record.checklist_id,checklist_record.class_date,checklist_record.class_id_from_lecture_list,
checklist_record.batch_coordinator,checklist_record.time_slot,checklist_record.checklist_type,checklist_record.faculty,checklist_record.venue,checklist_record.batch,checklist_record.subject,
attendance_assignment_record.att_ass_id,attendance_assignment_record.attendance,
attendance_assignment_record.response,attendance_assignment_record.assignment 
FROM checklist_record LEFT JOIN attendance_assignment_record 
ON checklist_record.checklist_id =  attendance_assignment_record.checklist_id WHERE checklist_record.faculty='$faculty' AND checklist_record.subject LIKE '%$SelectedSubject%' AND (checklist_record.checklist_type = 'Class' OR checklist_record.checklist_type = 'Offline') AND checklist_record.class_date between '$from' and '$to'";
$run = mysqli_query($connect,$query);
while($data = mysqli_fetch_assoc($run)){

    $batchs[] = array("checklist_id"=>$data['checklist_id'],"class_id_from_lecture_list"=>$data['class_id_from_lecture_list'],"Batch"=>$data['batch'],"Subject"=>$data['subject'],"Date"=>$data['class_date'],
"Attendance"=>$data['attendance'],"response"=>$data['response']);

}

$batchsCount = count($batchs);

for($onlyBatch = 0; $onlyBatch < $batchsCount; $onlyBatch++){

    $onlyBatchArray[] = array("Batch"=>$batchs[$onlyBatch]['Batch']);

}
$onlyBatchArrayUnique = array_unique($onlyBatchArray,SORT_REGULAR);
$onlyBatchArrayUnique_reindex = array_values($onlyBatchArrayUnique);
$onlyBatchArrayUnique_reindexCount = count($onlyBatchArrayUnique_reindex);


for($batchTotlCls = 0; $batchTotlCls < $onlyBatchArrayUnique_reindexCount;$batchTotlCls++){
    $attendance = 0;
    $response = 0;
    
    ?>

<div class="container-fluid">

  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><?php echo $onlyBatchArrayUnique_reindex[$batchTotlCls]['Batch']; ?></a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body">  
     <table class="table table-bordered" id="table<?php echo $ThreeDay; ?>">
    <thead style="background-color:#1c3961; color:white;">
      <tr>
        <th>Batch</th>
        <th>Subject</th>
        <th>No. Of Classes</th>
        <th>Offline Avg</th>
        <th>Online Avg</th>
        
      </tr>
    </thead>
    <tbody>
        <?php 

if(strpos($onlyBatchArrayUnique_reindex[$batchTotlCls]['Batch'],',')){
    //seprate the combined batch
    $onlyBatchArrayUnique_reindexarray = explode(",",$onlyBatchArrayUnique_reindex[$batchTotlCls]['Batch']);
    //count the combined batch
    $onlyBatchArrayUnique_reindexarrayCount = count($onlyBatchArrayUnique_reindexarray);
    //combined batch total strength online offline
    $oflineStrcombinedbatch = 0;
    $onlineStrcombinedbatch = 0;

    //this loop return online offline combined batch str
    for($onlineOflineSt = 0; $onlineOflineSt < $onlyBatchArrayUnique_reindexarrayCount; $onlineOflineSt++){

        $queryForStr = "SELECT * FROM batch WHERE batch_name = '$onlyBatchArrayUnique_reindexarray[$onlineOflineSt]'";
        $runForStr = mysqli_query($connect,$queryForStr);
        $dataForStr = mysqli_fetch_assoc($runForStr);
        $oflineStrcombinedbatch = $oflineStrcombinedbatch + $dataForStr['offline_students'];
        $onlineStrcombinedbatch = $onlineStrcombinedbatch + $dataForStr['online_student'];
    }
//this loop contain classes of batch where loop working for everytimes
for($totalclass = 0; $totalclass < $batchsCount; $totalclass++){

    if($onlyBatchArrayUnique_reindex[$batchTotlCls]['Batch'] == $batchs[$totalclass]['Batch']){
        //this array contain all class of the combined batch
        $totalclassarray[] = array("checklist_id"=>$batchs[$totalclass]['checklist_id'],"class_id_from_lecture_list"=>$batchs[$totalclass]['class_id_from_lecture_list'],"Batch"=>$batchs[$totalclass]['Batch'],"Subject"=>$batchs[$totalclass]['Subject'],"Date"=>$batchs[$totalclass]['Date'],
        "Attendance"=>$batchs[$totalclass]['Attendance'],"response"=>$batchs[$totalclass]['response']);
    }

}

$totalclassarraycount = count($totalclassarray);
$resultArray = array();


for($sepratebatch = 0; $sepratebatch < $onlyBatchArrayUnique_reindexarrayCount; $sepratebatch++){
    $batch = $onlyBatchArrayUnique_reindexarray[$sepratebatch];
    $queryForBatchSt = "SELECT * FROM batch WHERE batch_name = '$batch'";
    $runForBatchSt = mysqli_query($connect,$queryForBatchSt);
    $dataForBatchSt = mysqli_fetch_assoc($runForBatchSt);
    //offline online batch str in every batch
    $strengthofthebatchOffline = $dataForBatchSt['offline_students'];
    $strengthofthebatchOnline = $dataForBatchSt['online_student'];
    

    //avarage student in every batch
    $avgOfline = 0;
    $avgOnline = 0;
     for($totcls = 0; $totcls < $totalclassarraycount; $totcls++){
       $percentofthsbatchwithcombbatchofline = round($strengthofthebatchOffline*100/$oflineStrcombinedbatch);
       $percentofthsbatchwithcombbatchonline = round($strengthofthebatchOnline*100/$onlineStrcombinedbatch);
       $avgOfline = $avgOfline+round($totalclassarray[$totcls]['Attendance']*$percentofthsbatchwithcombbatchofline/100);
       $avgOnline = $avgOnline+round($totalclassarray[$totcls]['response']*$percentofthsbatchwithcombbatchonline/100);

}
array_push($resultArray,array("Batch"=>$batch,"subject"=>$SelectedSubject,'No of class'=>$totalclassarraycount,"strengthofthebatchOffline"=>$strengthofthebatchOffline,"strengthofthebatchOnline"=>$strengthofthebatchOnline,
"strengthofthebatchCombinedOffline"=>$oflineStrcombinedbatch,"strengthofthebatchCombinedOnline"=>$onlineStrcombinedbatch,"percentofthsbatchwithcombbatchofline"=>$percentofthsbatchwithcombbatchofline,"percentofthsbatchwithcombbatchonline"=>$percentofthsbatchwithcombbatchonline,
"AvgOffline"=>round($avgOfline/$totalclassarraycount),"AvgOnline"=>round($avgOnline/$totalclassarraycount)));
}

}else{
    $resultArray = array();
    $batch = $onlyBatchArrayUnique_reindex[$batchTotlCls]['Batch'];
    for($totalclass = 0; $totalclass < $batchsCount; $totalclass++){

        if($onlyBatchArrayUnique_reindex[$batchTotlCls]['Batch'] == $batchs[$totalclass]['Batch']){
            //this array contain all class of the combined batch
            $totalclassarray[] = array("checklist_id"=>$batchs[$totalclass]['checklist_id'],"class_id_from_lecture_list"=>$batchs[$totalclass]['class_id_from_lecture_list'],"Batch"=>$batchs[$totalclass]['Batch'],"Subject"=>$batchs[$totalclass]['Subject'],"Date"=>$batchs[$totalclass]['Date'],
            "Attendance"=>$batchs[$totalclass]['Attendance'],"response"=>$batchs[$totalclass]['response']);
        }
    
    }
    $totalclassarraycount = count($totalclassarray);
    $avgOfline = 0;
    $avgOnline = 0;
     for($totcls = 0; $totcls < $totalclassarraycount; $totcls++){

       $avgOfline = $avgOfline+$totalclassarray[$totcls]['Attendance'];
       $avgOnline = $avgOnline+$totalclassarray[$totcls]['response'];

}
    
   
    
    array_push($resultArray,array("Batch"=>$batch,"subject"=>$SelectedSubject,'No of class'=>$totalclassarraycount,"AvgOffline"=>round($avgOfline/$totalclassarraycount),"AvgOnline"=>round($avgOnline/$totalclassarraycount)));
    }


 ?>
 <?php 
 $resultArrayCound = count($resultArray);
 for($printres = 0; $printres < $resultArrayCound; $printres++){?>
 
 <tr>
    <td><?php echo $resultArray[$printres]['Batch']; ?></td>
    <td><?php echo $resultArray[$printres]['subject']; ?></td>
    <td><?php echo $resultArray[$printres]['No of class']; ?></td>
    <td><?php echo $resultArray[$printres]['AvgOffline']; ?></td>
    <td><?php echo $resultArray[$printres]['AvgOnline']; ?></td>
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
unset($totalclassarray);
unset($resultArray);
    

}


?>