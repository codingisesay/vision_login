<?php
session_start();
include('../database_connection.php');
include('../functions.php');
$device_cookie=$_COOKIE['PHPSESSID'];
$user_id=$_SESSION['id'];
$row_of_specific_device = specific_device_from_login_log($device_cookie,$user_id);
mysqli_num_rows($row_of_specific_device);
$data = mysqli_fetch_assoc($row_of_specific_device);

if(!isset($_SESSION['id']) || !isset($_COOKIE['PHPSESSID']) || $data['session_status'] == "inactive"){

         page_redirect('../index.php');
}
?>
<?php 
include('complaint_functions.php');
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
//$from_date = "2023-03-27";
//$to_date = "2023-04-10";
$run_total_complaint = fetch_complaint_data_from_to_date($from_date,$to_date);
while($data_total_complaints = mysqli_fetch_assoc($run_total_complaint)){
    $total_complaint[] = array("Student Reg No" => $data_total_complaints['student_reg_no'],"Complaint Text" => $data_total_complaints['complain_text'],
"Mode Name" => $data_total_complaints['mode_name'], "Complaint Received" => $data_total_complaints['complaint_received'],"Complaint Category Name" => $data_total_complaints['complaint_category_name'],
"Complaint Sub Category Name" => $data_total_complaints['complaint_sub_category_name'],"Resolution" => $data_total_complaints['resolution'],"Issue At" => $data_total_complaints['issue_at'],
"Complaint Status Name" => $data_total_complaints['complaint_status_name'], "Current Date" => $data_total_complaints['current_date'], "Current Date" =>$data_total_complaints['current_date'],
"User Name" => $data_total_complaints['user_name']);
}
$array_count_total_issue = count($total_complaint);
$run_com_cat = fetch_all_data_from_complaint_category();
while($data_com_cat = mysqli_fetch_assoc($run_com_cat)){

    $com_cat_array[] = array("ID" => $data_com_cat['complaint_category_id'], "Name" => $data_com_cat['complaint_category_name']);

}
$com_cat_array_count = count($com_cat_array);

?>

 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
        ["Total Issue", <?php echo $array_count_total_issue; ?>, "red"],
        <?php 
        
for($i = 0; $i < $com_cat_array_count; $i++){
    $complaint_count = 0;
    for($j = 0; $j < $array_count_total_issue; $j++){
        if($com_cat_array[$i]['Name'] == $total_complaint[$j]['Complaint Category Name']){
            $complaint_count++;
        }


    }?>
    
    ["<?php echo $com_cat_array[$i]['Name']; ?>", <?php echo $complaint_count; ?>, "#1c3961"],
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
        title: "Total Issue",
        width:1200,
        height:300,
        
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>
<div id="columnchart_values" style="width: 900px; height: 300px;"></div>


