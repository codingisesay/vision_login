<?php 
include('../session.php');

?>

<head>
   
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<?php 
include('academicfeedbackFunction.php');
include('academicfeedbackNavBar.php');
date_default_timezone_set('Asia/Kolkata');
$today = date("Y-m-d");
// $today = "2024-03-19";
$dateChecklistData = AllClassInDate($today);
$userNAme = fetchUserNameById($user_id);

$allclasscount = count($dateChecklistData);

// echo "<pre>";
// print_r($dateChecklistData);

?>
<body>
  <br>
<div class="container-fluid">
  <div class="row">

    <div class="col-sm-6"><input type="date" id="input_date" class="form-control" style="width:500px;display:inline; margin-right:5px;">
    <button type="button" id="DateSubmit" class="btn btn-info">Submit</button></div>

</div>
  </div><br>

  <div class="container-fluid">
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Today Academic feedback Form</a>
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
        <td><?php echo date("d-m-Y", strtotime($dateChecklistData[$allClass]['class date']));?></td>
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
          
    </table>
        </tbody>
        </div>
      </div>
    </div>
  </div> 
</div>
<div id="loadPreDate">

</div>
<script>
  $(document).ready(function(){
    $("#DateSubmit").on("click",function(){
      var inputDate = $("#input_date").val();
      if(inputDate != ""){
        $.ajax({
        url:"loadPreviousDateForm.php",
        type:"POST",
        data:{inputDate:inputDate},
        success:function(data){
         $("#loadPreDate").html(data);
        }
      })

      }else{
      alert("Please Fill The Date First");
      }
      //alert($inputDate);
     
    })
    

  })
</script>
</body>

