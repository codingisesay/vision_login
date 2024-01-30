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
// $from_date = "2023-03-27";
// $to_date = "2023-04-10";
$run_total_complaint = fetch_complaint_data_from_to_date($from_date,$to_date);
while($data_total_complaints = mysqli_fetch_assoc($run_total_complaint)){
    $total_complaint[] = array("Student Reg No" => $data_total_complaints['student_reg_no'],"Complaint Text" => $data_total_complaints['complain_text'],
"Mode Name" => $data_total_complaints['mode_name'], "Complaint Received" => $data_total_complaints['complaint_received'],"Complaint Category Name" => $data_total_complaints['complaint_category_name'],
"Complaint Sub Category Name" => $data_total_complaints['complaint_sub_category_name'],"Resolution" => $data_total_complaints['resolution'],"Issue At" => $data_total_complaints['issue_at'],
"Complaint Status Name" => $data_total_complaints['complaint_status_name'], "Current Date" => $data_total_complaints['currentdate'],
"User Name" => $data_total_complaints['user_name']);
}
$array_count_total_issue = count($total_complaint);

// echo "<pre>";
// print_r($total_complaint);
$run_com_cat = fetch_all_data_from_complaint_category();
while($data_com_cat = mysqli_fetch_assoc($run_com_cat)){

    $com_cat_array[] = array("ID" => $data_com_cat['complaint_category_id'], "Name" => $data_com_cat['complaint_category_name']);

}
$com_cat_array_count = count($com_cat_array);

?>

<script>


var chart = new CanvasJS.Chart("chartContainer", {
	exportEnabled: true,
	animationEnabled: true,
	title:{
		text: "Complaints"
	},
	legend:{
		cursor: "pointer",
		itemclick: explodePie
	},
	data: [{
		type: "pie",
		showInLegend: true,
		toolTipContent: "{name}: <strong>{y}%</strong>",
		indexLabel: "{name} - {y}%",
		dataPoints: [<?php 
    
    for($cato = 0; $cato < $com_cat_array_count; $cato++){
      $countissue = 0;
      for($total = 0; $total < $array_count_total_issue; $total++){
          if($com_cat_array[$cato]['Name'] == $total_complaint[$total]['Complaint Category Name']){
              $countissue++;
          }
$issueinpercenatge = round($countissue *100/$array_count_total_issue);
      }?>

      { y: <?php echo $issueinpercenatge; ?>, name: "<?php echo $com_cat_array[$cato]['Name']; ?>" },
      <?php

    }
    
    
    
    ?>
			// { y: 26, name: "School Aid", exploded: true },
			
			// { y: 5, name: "Debt/Capital" },
			// { y: 3, name: "Elected Officials" },
			// { y: 7, name: "University" },
			// { y: 17, name: "Executive" },
			// { y: 22, name: "Other Local Assistance"}
		]
	}]
});
chart.render();


function explodePie (e) {
	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
	} else {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
	}
	e.chart.render();

}
</script>


