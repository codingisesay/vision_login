<?php
include('testing_session.php');

$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
//$from_date = '2022-08-20';
//$to_date = '2022-09-20';

include('testing_functions.php');
//all class from dates
$run_all_data = all_class_from_date($from_date,$to_date);
$row_all = mysqli_num_rows($run_all_data);
$gmmr=0;
$iapl=0;
$gtb=0;
$rn=0;
$mn=0;
$rp=0;
while($data = mysqli_fetch_assoc($run_all_data)){
    if($data['venue'] == "GMMR-HALL-01" ||$data['venue'] == "GMMR-HALL-02" || $data['venue'] == "GMMR-HALL-03" || $data['venue'] == "GMMR-HALL-04" || $data['venue'] == "GMMR-HALL-05"){
        $gmmr++;
    }
    if($data['venue'] == "IAPL Hall 01" || $data['venue'] == "IAPL hall 02" || $data['venue'] == "IAPL Hall 03" || $data['venue'] == "IAPL Hall 04" || $data['venue'] == "IAPL Hall 05"){

        $iapl++;

    }
    if($data['venue'] == "GTBNAGAR1" || $data['venue'] == "GTBNAGAR2"){
        $gtb++;

    }
    if($data['venue'] == "RN1" || $data['venue'] == "RN2"){
        $rn++;

    }
    if($data['venue'] == "MN01" || $data['venue'] == "MN02"){
        $mn++;

    }
    if($data['venue'] == "RP01" || $data['venue'] == "RP02"){

        $rp++;

    }

}

$gmmr;
$iapl;
$gtb;
$rn;
$mn;
$rp;
 

//Issue in classes from dates
$gmmr_issue=0;
$iapl_issue=0;
$gtb_issue=0;
$rn_issue=0;
$mn_issue=0;
$rp_issue=0;

$run_issue = issue_data($from_date,$to_date);
$row_issue = mysqli_num_rows($run_issue);

while($data_issue = mysqli_fetch_assoc($run_issue)){
    $venue[$data['venue']] = $data['venue'] + 1;

    if($data_issue['venue'] == "GMMR-HALL-01" ||$data_issue['venue'] == "GMMR-HALL-02" || $data_issue['venue'] == "GMMR-HALL-03" || $data_issue['venue'] == "GMMR-HALL-04" || $data_issue['venue'] == "GMMR-HALL-05"){
        $gmmr_issue++;
    }
    if($data_issue['venue'] == "IAPL Hall 01" || $data_issue['venue'] == "IAPL hall 02" || $data_issue['venue'] == "IAPL Hall 03" || $data_issue['venue'] == "IAPL Hall 04" || $data_issue['venue'] == "IAPL Hall 05"){

        $iapl_issue++;

    }
    if($data_issue['venue'] == "GTBNAGAR1" || $data_issue['venue'] == "GTBNAGAR2"){
        $gtb_issue++;

    }
    if($data_issue['venue'] == "RN1" || $data_issue['venue'] == "RN2"){
        $rn_issue++;

    }
    if($data_issue['venue'] == "MN01" || $data_issue['venue'] == "MN02"){
        $mn_issue++;

    }
    if($data_issue['venue'] == "RP01" || $data_issue['venue'] == "RP02" || $data_issue['venue'] == "RP1"){
        $rp_issue++;

    }



}
$gmmr_issue;
$iapl_issue;
$gtb_issue;
$rn_issue;
$mn_issue;
$rp_issue;

//issue percent in gmmr
$gmmr_issue_percentage = round(($gmmr_issue*100)/$gmmr);

//Issue percent in iapl
$iapl_issue_percentage = round(($iapl_issue*100)/$iapl);

//issue percentage in rp
$rp_issue_percentage = round(($rp_issue*100)/$rp);

//issue percenage in rn
$rn_issue_percentage = round(($rn_issue*100)/$rn);

//issue percentage in mn

$mn_issue_percentage = round(($mn_issue*100)/$mn);

//issue percentage in gtbn
$gtb_issue_percentage = round(($gtb_issue*100)/$gtb);

//3155


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
