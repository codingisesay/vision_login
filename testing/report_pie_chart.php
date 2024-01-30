<?php 
error_reporting(0);
include('testing_session.php');

?>

        <link rel="stylesheet" href="css/generate_report.css">

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Time Slot', 'Total Class', 'Issue','Percent',{ role: 'annotation' }],
          <?php

 $from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
//$from_date = '2022-08-20';
//$to_date = '2022-09-20';
include('testing_functions.php');
$run_all_class = all_class_from_date($from_date,$to_date);
$run_issue = issue_data($from_date,$to_date);
while($all_class_data = mysqli_fetch_assoc($run_all_class)){

  $all_class[] = $all_class_data['time_slot'];

}
while($data_issue = mysqli_fetch_assoc($run_issue)){
$issue_data[]=$data_issue['time_slot'];
}
$time_slot_array = array("09 am - 12 pm","01 pm - 04 pm","05 pm - 08 pm");

$all_class_count = count($all_class);
$issue_class_count = count($issue_data);
$time_slot_class_count = count($time_slot_array);

for($time_slot_arr_str = 0; $time_slot_arr_str < $time_slot_class_count; $time_slot_arr_str++){
  $all_cls = 0;
  $isuue_cls = 0;
  for($all_class_arr_str = 0; $all_class_arr_str < $all_class_count; $all_class_arr_str++){
    if($time_slot_array[$time_slot_arr_str] == $all_class[$all_class_arr_str]){

$all_cls++;

    }

  }
  for($issue_class_arr_str = 0; $issue_class_arr_str < $issue_class_count; $issue_class_arr_str++){

    if($time_slot_array[$time_slot_arr_str] == $issue_data[$issue_class_arr_str]){

      $isuue_cls++;
      
          }

  }
  $percent = ($isuue_cls*100)/$all_cls;
  $new_per = round($percent);


?>
["<?php echo $time_slot_array[$time_slot_arr_str]; ?>", <?php echo $all_cls; ?>, <?php echo $isuue_cls; ?>,<?php echo $new_per; ?>,'aka'],

<?php
  

}

          
        
          
          ?>
          
          
         
        ]);
        // var view = new google.visualization.DataView(data);
        // view.setColumns([0, 1,
        //                { calc: "stringify",
        //                  sourceColumn: 1,
        //                  type: "string",
        //                  role: "annotation" },
        //                2]);
       
        var options = {
          chart: {
            title: 'Class Timing Vs Interruptions',
            subtitle: '',
            
            
           
          }
        };
        
        var chart = new google.charts.Bar(document.getElementById('charts'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
        // chart.draw(view, options);
      }
    </script>