<?php 
include('../session.php');
include('academicfeedbackFunction.php');

?>
<?php 
$selectedDate = trim($_POST['stelectedDate']);

$dataForThreeDay = FetchDataForDate($selectedDate);
$dataForThreeDayCount = count($dataForThreeDay);


?>
<div class="container-fluid">

<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse"><?php echo $newDate = date("d-m-Y", strtotime($selectedDate));?></a>
      </h4>
    </div>
    <div id="collapse" class="panel-collapse collapse">
      <div class="panel-body"><table class="table table-bordered" id="myTable">
  <thead style="background-color:#1c3961; color:white;">
    <tr>
      <th style="color: white;">Time/Date</th>
      <th style="color: white;">Coordinator</th>
      <th style="color: white;">Batch</th>
      <th style="color: white;">Subject</th>
      <th style="color: white;">Number</th>
      <th style="color: white;">Faculty</th>
      <th style="color: white;">Venue</th>
      <th style="color: white;">Status</th>
    </tr>
  </thead>
  <tbody>
      <?php 
      for($tabledata = 0; $tabledata < $dataForThreeDayCount; $tabledata++){
          ?>
      <tr>
      <td><?php  echo $newDate = date("d-m-Y", strtotime($dataForThreeDay[$tabledata]['class_date'])); ?></td>
      <td><?php echo preg_replace('/[0-9-]+/', '',$dataForThreeDay[$tabledata]['batch_coordinator']); ?></td>

      <td><?php echo batchShortCode($dataForThreeDay[$tabledata]['batch']); ?></td>

      <td><?php echo preg_replace("/[0-9-]+/","",$dataForThreeDay[$tabledata]['subject']); ?></td>
      <td><?php echo preg_replace("/[A-Z,a-z-]+/","",$dataForThreeDay[$tabledata]['subject']); ?></td>
      <td><?php echo $dataForThreeDay[$tabledata]['faculty']; ?></td>
      <td><?php echo $dataForThreeDay[$tabledata]['venue']; ?></td>
      <?php 
      $overall_rating_for_the_class = $dataForThreeDay[$tabledata]['overall_rating_for_the_class'];
      if($overall_rating_for_the_class == ""){?>
      <td style="background-color: red;">Not Done</td>
      
      <?php 

      }else{?>
      
      <td style="background-color: green;">Done</td>
      <?php

      }
      
      ?>
      
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
        $('#myTable').excelTableFilter();
    })
</script>