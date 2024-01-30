<?php
error_reporting(0);
include('testing_session.php');

include('testing_functions.php');
//$from_date = '2022-08-20';
//$to_date = '2022-09-20';
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];

$run_issue = issue_data($from_date,$to_date);
while($issue_data = mysqli_fetch_assoc($run_issue)){

  $total_issue[]=array("checklist id"=>$issue_data['checklist_id'],"class date"=>$issue_data['class_date'],"venue"=>$issue_data['venue'],
"batch"=>$issue_data['batch'],"time_slot"=>$issue_data['time_slot'],"user name"=>$issue_data['user_name'],"issue name"=>$issue_data['issue_name'],
"issue start time"=>$issue_data['issue_start_time'],"issue end time"=>$issue_data['issue_end_time'],"observation"=>$issue_data['observation'],
"time lost during class"=>$issue_data['time_lost_during_class']);

}
$total_issue_count = count($total_issue);

$run_issue_catogry = all_issue_category();
while($data_issue_catogry = mysqli_fetch_assoc($run_issue_catogry)){

  $issue_cat[] = array("issue id"=>$data_issue_catogry['issue_id'],"issue name"=>$data_issue_catogry['issue_name']);

}

$issue_cat_count = count($issue_cat);


?>

  

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
        ["Total Issue", <?php echo $total_issue_count; ?>, "red"],

        <?php 
        for($cat = 0; $cat < $issue_cat_count; $cat++){
          $issuee = 0;
          for($total_issuee = 0; $total_issuee < $total_issue_count; $total_issuee++){
        
            if($issue_cat[$cat]['issue name'] == $total_issue[$total_issuee]['issue name']){
        
              $issuee++;
        
            }
        
          }?>
          ["<?php echo $issue_cat[$cat]['issue name'];?>",<?php echo $issuee; ?>,"#87CEEB"],
          
          <?php
        
          
        
        }
        
        ?>
        
      
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Issue Vs Frequency",
        // width: 1200,
        // height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("charts"));
      chart.draw(view, options);
  }
  </script>
