<?php
include('testing_session.php');




?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Venue', 'Total Class', 'Issue','Percent'],
<?php 

$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
//$from_date = '2022-08-20';
//$to_date = '2022-09-20';

include('testing_functions.php');

// issue data from to date
$run_issue = issue_data($from_date,$to_date);
while($data_issue = mysqli_fetch_assoc($run_issue)){

    $issue[]=array("checklist_id"=>$data_issue['checklist_id'],"class Date"=>$data_issue['class_date'],"venue"=>$data_issue['venue'],
"batch"=>$data_issue['batch'],"time slot"=>$data_issue['time_slot'],"user name"=>$data_issue['user_name'],"issue name"=>$data_issue['issue_name'],
"issue start time"=>$data_issue['issue_start_time'],"issue end time"=>$data_issue['issue_end_time'],"observation"=>$data_issue['observation'],
"time lost during class"=>$data_issue['time_lost_during_class']);

}
$issue_count = count($issue);

for($rw = 0; $rw <$issue_count; $rw++){

    $ven = $issue[$rw]['venue'];
    $run = fetch_center_id_from_van($ven);
    $data = mysqli_fetch_assoc($run);
     $issue_venue_center[]=array("center id"=>$data['center_id']);   //issue data array with venue and center
    

}

//All class data from to date
$run_all_class = all_class_from_date($from_date,$to_date);
while($data_all_class = mysqli_fetch_assoc($run_all_class)){

    $all_class[]=array("venue"=>$data_all_class['venue'],"Class date"=>$data_all_class['class_date']);

}
$all_class_count = count($all_class);
for($all_data_rw = 0; $all_data_rw <$all_class_count; $all_data_rw++){

    $all_class_ven = $all_class[$all_data_rw]['venue'];
    $run_all_class = fetch_center_id_from_van($all_class_ven);
    $data_all_class = mysqli_fetch_assoc($run_all_class);
     $all_class_venue_center[]=array("class id"=>$data_all_class['center_id']);   //issue data array with venue and center
    

}

//all data of center table

$run_center_data = fetch_center_table_data();
while($data_center = mysqli_fetch_assoc($run_center_data)){

    $center[] = array("center id"=>$data_center['center_id'],"name"=>$data_center['center_name']); //all center array

}
$center_count = count($center);

for($cent = 0; $cent<$center_count;$cent++){
    $all_class_on_particular_venue = 0;
    for($all=0;$all<$all_class_count;$all++){

        if($center[$cent]['center id'] == $all_class_venue_center[$all]['class id']){
            $all_class_on_particular_venue++;
        }

        

    }
    $issue_class_on_particular_venue = 0;
    for($issu = 0; $issu<$issue_count;$issu++){
        
        if($center[$cent]['center id'] == $issue_venue_center[$issu]['center id']){

            $issue_class_on_particular_venue++;

        }

    }

    $percent = ($issue_class_on_particular_venue*100)/$all_class_on_particular_venue;

    
     if($issue_class_on_particular_venue == 0 && $all_class_on_particular_venue == 0 ){

        $new_percent = 0;

     }else{

        $new_percent = round($percent);

     }
    
    ?>
    
    ["<?php echo $center[$cent]['name']; ?>",<?php echo $all_class_on_particular_venue; ?>,<?php echo $issue_class_on_particular_venue;?>,<?php echo $new_percent; ?>],
    
    <?php

    


}




?>


        
        ]);

        var options = {
          chart: {
            title: 'Venue Vs Interruption',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('charts'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
 
</html>