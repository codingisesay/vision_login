<?php 
include('../session.php');
include('academicfeedbackFunction.php');


?>
<?php 
include('academicfeedbackNavBar.php');
// $date = '2023-10-14';
$date = date("Y-m-d");
$dataForSummar = fetchForSummary($date);

$newDate = date("d-m-Y", strtotime($date));  
// echo "<pre>";
// print_r($dataForSummar);
$dataForSummarCount = count($dataForSummar);



?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="library/Excel-like-Bootstrap-Table-Sorting-Filtering-Plugin/dist/excel-bootstrap-table-filter-bundle.js"></script>
  <link rel="stylesheet" href="library/Excel-like-Bootstrap-Table-Sorting-Filtering-Plugin/src/excel-bootstrap-table-filter-style.css">
</head>
<style>
    *{
        color: black;
    }
</style>
<body>

    <br>
    <div class="container-fluid">

  <label for="birthday">Select Date:</label>
  <input type="date" id="selectDate" name="birthday">
  <input type="button" id ="selectDateButton" class="btn btn-success" value="Submit">

    </div>
    <br>
<div class="container-fluid" id="currentDate">

  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><?php echo $newDate; ?></a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body"><table class="table table-bordered" id="myTable">
    <thead style="background-color:#1c3961; color:white; font-size:12px;">
      <tr>
        <th style="color:white;">Batch</th>
        <th style="color:white;">Subject</th>
        <th style="color:white;">Faculty</th>
        <th style="color:white;">Coordinator</th>
        <th style="color:white;">Class Start Time</th>
        <th style="color:white;">Overall Rating</th>
        <th style="color:white;">Major Topics Covered</th>
        <th style="color:white;">Language</th>
        <th style="color:white;">Preparation</th>
        <th style="color:white;">Organisation</th>
        <th style="color:white;">Dictation</th>
        <th style="color:white;">Factual Error</th>
        <th style="color:white;">Expectations</th>
        <th style="color:white;">Video Portion removed?</th>
        <th style="color:white;">Number of LIVE Queries (approx.)</th>
        <th style="color:white;">Miscellaneous</th>
        <th style="color:white;">View Form</th>
        

      </tr>
    </thead>
    <tbody style="font-size: 12px;">
    <?php 
    for($summary = 0; $summary < $dataForSummarCount; $summary++){?>
        <tr>
        <td><?php echo $data = batchShortCode($dataForSummar[$summary]['batch']);
        
        
        ?></td>
        <td><?php echo $dataForSummar[$summary]['subject'];?></td>
        <td><?php echo $dataForSummar[$summary]['faculty'];?></td>
        <td><?php echo preg_replace('/[0-9-]+/', '', $dataForSummar[$summary]['batch_coordinator']);?></td>
        <td><?php echo $dataForSummar[$summary]['class_start_time'];?></td>
        <td><?php echo $dataForSummar[$summary]['overall_rating_for_the_class'];?></td>
        <td><?php echo $dataForSummar[$summary]['major_topics_covered'];?></td>
        <td><?php echo $dataForSummar[$summary]['faculty_primarily_used_language']."(".$dataForSummar[$summary]['percentage_secondary_language']."%".")";?></td>
        <td><?php echo $dataForSummar[$summary]['preparation_for_class'];?></td>
        <td><?php echo $dataForSummar[$summary]['organization_of_content'];?></td>
        <td><?php echo $dataForSummar[$summary]['dictation_in_class']."(".$dataForSummar[$summary]['no_pages_dictated_in_class'].")";?></td>
        <td><?php echo $dataForSummar[$summary]['factual_errors_or_conceptual_lags'];?></td>
        <td><?php echo $dataForSummar[$summary]['faculty_meet_your_expectations'];?></td>
        <td><?php echo $dataForSummar[$summary]['video_portion_removed'];?></td>
        <td><?php echo $dataForSummar[$summary]['No_of_live_query'];?></td>
        <td>Management/Tech : <?php echo $dataForSummar[$summary]['management_technical_issue'];?><br>Issue by Student : <?php echo $dataForSummar[$summary]['specific_issue_highlighted_by_students'];?><br>Other Feedback : <?php echo $dataForSummar[$summary]['any_other_feedback'];?></td>
        <?php 
        if($dataForSummar[$summary]['overall_rating_for_the_class'] != ""){?>
        
        <td><a class="view_checklist_detail" data-checklist_id="<?php echo $dataForSummar[$summary]['checklist_id'];?>"><button type="button"  class="btn btn-info" data-toggle="modal" data-target="#myModal">View</button></a></td>
        <?php

        }else{?>
        
        <td><button type="button"  class="btn btn-info notfill">View</button></td>
        
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

<div id="loadPreviousdatedata">

</div>

<div class="container">

  <!-- Trigger the modal with a button -->


  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" >
    <div class="modal-dialog" style="width: 80%;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center;">Feedback Report</h4>
        </div>
        <div class="modal-body">
 
  
</div>
</div>
<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>

        </div>
        
      </div>
      
    </div>
 <script>
    $(document).ready(function(){

        $('#selectDateButton').on("click",function(){
      var selectedDate = $('#selectDate').val();

      if(selectedDate != ""){

        $.ajax({
        url:"loadPreviousDateSummar.php",
        type:"POST",
        data:{selectedDate:selectedDate},
        success:function(data){
            $("#currentDate").hide();
            $("#loadPreviousdatedata").html(data);
        }
      })

      }else{

        alert("Please Select The Date First!!");

      }
    
      })

        $(document).on("click",".view_checklist_detail",function(){
            var checklist_id = $(this).data("checklist_id");
           
            $.ajax({
                url:"loadSummarForClass.php",
                type:"POST",
                data:{checklist_id:checklist_id},
                success:function(data){
                    $(".modal-body").html(data);
                    
                }
            })
          
            

        })

        $(".notfill").on("click",function(){
            alert("This Form Is Not Filled Yet!!");
        })

 
        
    })
    $('table').excelTableFilter();
 </script>
    

</html>
