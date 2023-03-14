<?php 
include('testing_session.php');
//include('testing_functions.php');

?>
<link rel="stylesheet" href="css/generate_report.css">
<?php
include('testing_functions.php');
//$from_date = '2022-08-20';
//$to_date = '2022-09-20';
//$venue = "GMMR";
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
$total_ven_class = 0;
for($total_clss = 0; $total_clss < $total; $total_clss++){
    $t_ven = $total_cls[$total_clss]['tot venue'];
    $cen_ru = fetch_center_id_from_van($t_ven);
    $cen_i = mysqli_fetch_assoc($cen_ru);
    $c_id = $cen_i['center_id'];
    $center_run_na = center_name($c_id);
    $center_da = mysqli_fetch_assoc($center_run_na);
    $center_nae = $center_da['center_name'];
    if($venue == $center_nae){

        $total_ven_class++;

    }

}


while($issue_data = mysqli_fetch_assoc($run_issue)){

$total_issue[]=array("checklist id"=>$issue_data['checklist_id'],"class date"=>$issue_data['class_date'],"venue"=>$issue_data['venue'],
"batch"=>$issue_data['batch'],"time_slot"=>$issue_data['time_slot'],"user name"=>$issue_data['user_name'],"issue name"=>$issue_data['issue_name'],
"issue start time"=>$issue_data['issue_start_time'],"issue end time"=>$issue_data['issue_end_time'],"observation"=>$issue_data['observation'],
"time lost during class"=>$issue_data['time_lost_during_class']);
$issue = count($total_issue);

$venuee = 0;

}
for($total_iss = 0; $total_iss < $issue; $total_iss++){
    $ven = $total_issue[$total_iss]['venue'];
    $center_run = fetch_center_id_from_van($ven);
    $center_id = mysqli_fetch_assoc($center_run);
    $cen_id = $center_id['center_id'];
   $center_run_name = center_name($cen_id);
   $center_data = mysqli_fetch_assoc($center_run_name);
   $center_name = $center_data['center_name'];
   if($venue == $center_name){
    $venuee++;
   }


}

?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Classroom', 'Total Class', 'Issue'],
          ['<?php echo $venue; ?>', <?php echo $total_ven_class; ?>, <?php echo $venuee; ?>],
          <?php 
          for($classroom_on_venue_array = 0; $classroom_on_venue_array < $count_classroom_on_venue; $classroom_on_venue_array++){
            $total_class_on_classroom = 0;
            for($total_cls_array = 0; $total_cls_array < $total; $total_cls_array++){
                if($classroom_on_venue[$classroom_on_venue_array]['Classroom Name'] == $total_cls[$total_cls_array]['tot venue']){
                    $total_class_on_classroom++;
                }
                
        
            }
            $issue_on_clas = 0;
            for($total_issue_array = 0; $total_issue_array < $issue; $total_issue_array++){
                if($classroom_on_venue[$classroom_on_venue_array]['Classroom Name'] == $total_issue[$total_issue_array]['venue']){
                    $issue_on_clas++;
                }
        
                
        
            }?>
            ['<?php echo $classroom_on_venue[$classroom_on_venue_array]['Classroom Name']; ?>', <?php echo $total_class_on_classroom; ?>,<?php echo $issue_on_clas; ?>],
            <?php
        
        
        }
          
          ?>
        
          
        ]);

        var options = {
          chart: {
            title: 'Issue By Classroom',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('charts'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  
  

