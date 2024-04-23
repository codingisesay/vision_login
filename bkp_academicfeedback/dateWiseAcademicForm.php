<?php 
include('../session.php');
include('academicfeedbackFunction.php');


?>
<?php 
include('academicfeedbackNavBar.php');

$current_date = date("Y-m-d")."<br>";
$t = strtotime("-2 day");
$ten_day_back =  date("Y-m-d",$t);

for($i = 2; $i >= 1; $i--){
 
    $dt = strtotime("-$i day");
    $three_day_date = date("Y-m-d",$dt);
    $three_day_array[] = array("date" => $three_day_date);

}

array_push($three_day_array,array("date" => date("Y-m-d")));
$dateEnd = count($three_day_array);

$fromDate = $three_day_array[0]['date'];
$ToDate = $three_day_array[2]['date'];
$dataForThreeDay = AcadmicForFillOrNot($fromDate,$ToDate);
$dataForThreeDayCount = count($dataForThreeDay);
// echo "<pre>";
// print_r($dataForThreeDay);
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="library/Excel-like-Bootstrap-Table-Sorting-Filtering-Plugin/dist/excel-bootstrap-table-filter-bundle.js"></script>
  <link rel="stylesheet" href="library/Excel-like-Bootstrap-Table-Sorting-Filtering-Plugin/src/excel-bootstrap-table-filter-style.css">

  <style>
    *{
        color: black;
    }
  </style>
</head>
<body>
    <br>
<div class="container-fluid">
<form action="/action_page.php">
  <label for="birthday">Select Date:</label>
  <input type="date" id="slectDate" name="birthday">
  <input type="button" class="btn btn-success" id="selectDateBtn" value="Submit">
</form>
    </div>
    
    <br>
    <div id="t1">
    <?php 
    for($date_start = 0; $date_start < $dateEnd; $date_start++){?>
    
    <div class="container-fluid">

  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $date_start; ?>"><?php echo $newDate = date("d-m-Y", strtotime($three_day_array[$date_start]['date']));?></a>
        </h4>
      </div>
      <div id="collapse<?php echo $date_start; ?>" class="panel-collapse collapse">
        <div class="panel-body"><table class="table table-bordered" id="myTable<?php echo $date_start; ?>">
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
            if($three_day_array[$date_start]['date'] == $dataForThreeDay[$tabledata]['class_date']){?>
        <tr>
        <td><?php  echo $newDate = date("d-m-Y", strtotime($dataForThreeDay[$tabledata]['class_date'])); ?></td>
        <td><?php echo preg_replace('/[0-9-]+/', '',$dataForThreeDay[$tabledata]['batch_coordinator']); ?></td>

        <td><?php echo batchShortCode($dataForThreeDay[$tabledata]['batch']); ?></td>

        <td><?php echo preg_replace("/[0-9-]+/","",$dataForThreeDay[$tabledata]['subject']); ?></td>
        <td><?php echo preg_replace("/[A-Z,a-z-]+/","",$dataForThreeDay[$tabledata]['subject']); ?></td>
        <td><?php echo $dataForThreeDay[$tabledata]['faculty']; ?></td>
        <td><?php echo $dataForThreeDay[$tabledata]['venue']; ?></td>
        <?php 
        $startTime = $dataForThreeDay[$tabledata]['class_start_time'];
        if($startTime == ""){?>
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
    <div id="loadnew">

    </div>

   <script>
    $(document).ready(function(){
        $("#selectDateBtn").on("click",function(){
            var stelectedDate = $("#slectDate").val();
            if(stelectedDate != ""){

                $.ajax({
                    url:"loadDesDateData.php",
                    type:"POST",
                    data:{stelectedDate:stelectedDate},
                    success:function(data){
                        $("#t1").hide();
                        $("#loadnew").html(data);


                    }

                        });

            }else{

                alert("Please Select The Date First!!");

            }
           

        })
$('#myTable0').excelTableFilter();
$('#myTable1').excelTableFilter();
$('#myTable2').excelTableFilter();
    })
   </script> 
</body>
</html>
