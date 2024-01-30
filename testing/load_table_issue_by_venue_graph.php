<?php 
include('testing_session.php');
//include('testing_functions.php');

?>

<head>
                    <link rel="stylesheet" href="css/generate_report.css">
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

                </head>
<?php
include('testing_functions.php');
//$from_date = '2022-08-20';
//$to_date = '2022-09-20';
//$venue = "GMMR";
//load_table_issue_by_venue_graph.php
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
$venue = $_POST['center_name'];
include('../database_connection.php');
$query="SELECT * FROM center_name where center_name = '$venue'";
$run_for_center_id = mysqli_query($connect,$query);
$data_for_center_id = mysqli_fetch_assoc($run_for_center_id);
$center_id_venue = $data_for_center_id['center_id'];

$query_for_venue_classrooms = "SELECT * FROM venues WHERE center_id = '$center_id_venue'";
$run_query_for_venue_classrooms = mysqli_query($connect,$query_for_venue_classrooms);
while($data_run_query_for_venue_classrooms = mysqli_fetch_assoc($run_query_for_venue_classrooms)){

    $classroom_on_venue[] = array("Venue Id" => $data_run_query_for_venue_classrooms['venue_id'], "Classroom Name" => $data_run_query_for_venue_classrooms['venue_name']);

}


$count_classroom_on_venue = count($classroom_on_venue);

$run_issue = issue_data($from_date,$to_date);
$all_class_data = all_class_from_date($from_date,$to_date);

while($total_classes = mysqli_fetch_assoc($all_class_data)){

    $total_cls[] = array("tot venue" => $total_classes['venue']);

}
$total = count($total_cls);


$run_issue = issue_data($from_date,$to_date);
while($data_issue = mysqli_fetch_assoc($run_issue)){

$issue_arr[] = array("class id"=>$data_issue['class_id_from_lecture_list'],"Class Date"=>$data_issue['class_date'],"Venue"=>$data_issue['venue'],"Batch"=>$data_issue['batch'],
"Time Slot"=>$data_issue['time_slot'],"Issue Name"=>$data_issue['issue_name'],"Issue Start Time"=>$data_issue['issue_start_time'],
"Issue End Time"=>$data_issue['issue_end_time'],"Observation"=>$data_issue['observation'],"Time Lost During Class"=>$data_issue['time_lost_during_class']);

}

$array_count_issue_arr = count($issue_arr);?>

<div class="container-fluid">
    <table class="table table-bordered">
    <thead style="background-color: #1c3961; color:white; font-weight: bolder;">
      <tr>
        <td>CLASSROOM</td>
        <td>TOTAL CLASS</td>
        <td>ISSUE</td>
        
      </tr>
      </thead>
      <?php 
      for($cen = 0; $cen < $count_classroom_on_venue; $cen++){
        $totl = 0;
        $isscl = 0;
        for($total_cl = 0; $total_cl < $total; $total_cl++){
          if($classroom_on_venue[$cen]['Classroom Name'] == $total_cls[$total_cl]['tot venue']){
            $totl++;
          }


        }
        for($iscl = 0; $iscl < $array_count_issue_arr; $iscl++){
       if($classroom_on_venue[$cen]['Classroom Name'] == $issue_arr[$iscl]['Venue']){
        $isscl++;
       }

        }
 ?>
      
      <tr>
        <td><?php echo $classroom_on_venue[$cen]['Classroom Name']; ?></td>
        <td><?php  echo $totl; ?></td>
        <td><?php  echo $isscl; ?></td>
        
      </tr>
      
      <?php

      }
      
      
      ?>
     
    
    </table>
  </div>

<?php

for($classroom_on_venue_ar = 0; $classroom_on_venue_ar < $count_classroom_on_venue; $classroom_on_venue_ar++){?>
<div class="container-fluid">
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $classroom_on_venue_ar; ?>"><?php echo $classroom_on_venue[$classroom_on_venue_ar]['Classroom Name']; ?></a>
        </h4>
      </div>
      <div id="collapse<?php echo $classroom_on_venue_ar; ?>" class="panel-collapse collapse">
        <div class="panel-body">
        <table class="table table-striped">
      <thead class="table_heading">
        <tr>
          <td>Date</td>
          <td>Venue</td>
          <td>Batch</td>
          <td>Issue Name</td>
          <td>Start Time</td>
          <td>End Time</td>
          <td>Time Lost</td>
          <td>Detail</td>
        </tr>
        </thead>
        <?php 
        for($issue_array = 0 ; $issue_array < $array_count_issue_arr; $issue_array++){
            if($classroom_on_venue[$classroom_on_venue_ar]['Classroom Name'] == $issue_arr[$issue_array]['Venue']){?>
            <tbody>
  <td><?php echo $issue_arr[$issue_array]['Class Date'] ?></td>
  <td><?php echo $issue_arr[$issue_array]['Venue'] ?></td>
  <td><?php  echo "*".$str_batch = str_replace(",","<br>*",$issue_arr[$issue_array]['Batch']);   ?></td>
  <td><?php echo $issue_arr[$issue_array]['Issue Name'] ?></td>
  <td><?php echo $issue_arr[$issue_array]['Issue Start Time'] ?></td>
  <td><?php echo $issue_arr[$issue_array]['Issue End Time'] ?></td>
  <td><?php echo $issue_arr[$issue_array]['Time Lost During Class'] ?></td>
  <td><button class="view_details" data-class_id="<?php echo $issue_arr[$issue_array]['class id']?>">View</button></td>


            
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