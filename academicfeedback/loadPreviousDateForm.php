<?php 
include('../session.php');
include('academicfeedbackFunction.php');
?>
<?php
$inputDate = $_POST['inputDate'];
$dateChecklistData = AllClassInDate($inputDate);
$userNAme = fetchUserNameById($user_id);

$allclasscount = count($dateChecklistData);

?>
<div class="container-fluid">
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Academic feedback Form Date : <?php echo $inputDate;?></a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body"><table class="table table-bordered" id="myTable">
    <thead style="background-color:#1c3961; color:white;">
      <tr>
        <th>Class Id</th>
        <th>Date</th>
        <th>Coordinator Name</th>
        <th>Batch</th>
        <th>Subject</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      for($allClass = 0; $allClass < $allclasscount; $allClass++){
        if($userNAme == $dateChecklistData[$allClass]['batch_coordinator']){?>
        <tr>
        <td><?php echo $dateChecklistData[$allClass]['class_id_from_lecture_list'];?></td>
        <td><?php echo date("d-m-Y", strtotime($dateChecklistData[$allClass]['class date'])); ?></td>
        <td><?php echo $dateChecklistData[$allClass]['batch_coordinator'];?></td>
        <td><?php echo batchShortCode($dateChecklistData[$allClass]['batch']);?></td>
        <td><?php echo $dateChecklistData[$allClass]['subject'];?></td>
        <?php 
        // $formStatus = insertStatus($dateChecklistData[$allClass]['checklist id']);
        $formStatus =  insertFormStatus($dateChecklistData[$allClass]['checklist id']);
        $acadmicFeebackData = fetchDataFromAcadmicData($dateChecklistData[$allClass]['checklist id']);
       $handoutStatus = $acadmicFeebackData[0]['handout_provided'];
        if($formStatus != ""){?>
                      <td><a href="formAcademicFeedback.php?class_id=<?php echo $dateChecklistData[$allClass]['class_id_from_lecture_list'];?>" class="btn btn-primary">Feedback Form</a>
                <a href="uploadHandout.php?checklist_id=<?php echo $dateChecklistData[$allClass]['checklist id'];?>&class_id=<?php echo $dateChecklistData[$allClass]['class_id_from_lecture_list']; ?>" class="btn btn-info" style="display:<?php echo $handoutst = ($handoutStatus == "Yes")?("inline-block"):("none"); ?>">Upload Handout</a>
              </td>
        
        <?php

        }else{?>
        
        <td><a href="formAcademicFeedback.php?class_id=<?php echo $dateChecklistData[$allClass]['class_id_from_lecture_list'];?>" class="btn btn-primary">Feedback Form</a></td>
        
        <?php

        }
        
        ?>

        </tr>
        <?php

        }

      }
      
      
      ?>