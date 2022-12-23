<?php
include('testing_session.php');

//$from_date = $_POST['from_date'];
//$to_date = $_POST['to_date'];
$from_date = '2022-08-20';
$to_date = '2022-09-20';

include('testing_functions.php');
//all class from dates
$run_all_data = all_class_from_date($from_date,$to_date);
$row_all = mysqli_num_rows($run_all_data);

$total_class_at_venue = 0;

//All venue fron venue table
$venue = array();
$run_venue = all_data_from_venue();
while($data_venue = mysqli_fetch_assoc($run_venue)){

$venue[]=$data_venue['venue_name'];

}
$run_all_class = all_class_from_date($from_date,$to_date);

//All venue from one date to another date data

$all_class = array();
while($data_all_class = mysqli_fetch_assoc($run_all_class)){

    $all_class[]=$data_all_class['venue'];

}

$venue_count_from_table = count($venue);
$venue_all_classes = count($all_class);

for($venues=0;$venues<$venue_count_from_table;$venues++){
    
    $class_on_venue = 0;
 for($venue_all_class = 0; $venue_all_class<$venue_all_classes;$venue_all_class++){

    if(substr($venue[$venues], 0, 2) == substr($all_class[$venue_all_class],0,2)){

       $class_on_venue++;
        

    }   

 }
//Array, totall class in every venue
$no_issue[$venue[$venues]] = $class_on_venue;

}

//Removing dublicate venue
$total_number_of_class_at_venue = array_unique($no_issue);

//load issue row in all venue
$run_issue_data = issue_data($from_date,$to_date);
while($data_issue = mysqli_fetch_assoc($run_issue_data)){

    $issue_data[]=$data_issue['venue'];

}
$issue_total_row = count($issue_data);

//load issue per venue
for($venues=0;$venues<$venue_count_from_table;$venues++){
    $no_of_issue_on_venue = 0;
    for($issue=0;$issue<$issue_total_row;$issue++){

        if(substr($venue[$venues], 0, 2) == substr($issue_data[$issue],0,2)){

            $no_of_issue_on_venue++;

        }

    }

    //Array, issue class in every venue
$no_of_issuees[$venue[$venues]] = $no_of_issue_on_venue;
}
$total_number_of_issue_at_venue = array_unique($no_of_issuees);
foreach($total_number_of_class_at_venue as $key => $value){

    echo strtok($key," ").":".$value."<br>";

}
echo "<br>";
foreach($total_number_of_issue_at_venue as $keyy => $valuee){

    echo strtok($keyy," ").":".$valuee."<br>";

}





?>
<head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Percent", { role: "style" } ],
        ["GMMR", <?php echo $gmmr_issue_percentage; ?>, "#7BBAF2"],
        ["IAPL", <?php echo $iapl_issue_percentage; ?>, "#7BBAF2"],
        ["RP", <?php echo $rp_issue_percentage; ?>, "#7BBAF2"],
        ["RN", <?php echo $rn_issue_percentage; ?>, "#7BBAF2"],
        ["MN", <?php echo $mn_issue_percentage; ?>, "color: #7BBAF2"],
        ["GTB", <?php echo $gtb_issue_percentage; ?>, "color: #7BBAF2"]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Venue vs Interruptions (In Percentage)",
        width: 900,
        height: 550,
        bar: {groupWidth: "80%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("charts"));
      chart.draw(view, options);
  }
  </script>
</head>
<body>
    <div id="charts"></div>
</body>
