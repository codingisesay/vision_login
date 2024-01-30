<?php
error_reporting(0);
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
//$from_date = "2023-04-20";
//$to_date = "2023-04-24";
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
//$issue = $_POST['issue'];
$runForModeOfComplains = modeOfComplaints();
// $issue_at_end = array("Our end", "Student End", "General Enquiry");

while($dataForModeOfComplains =  mysqli_fetch_assoc($runForModeOfComplains)){

    $modeOfComplain[] = array("mode_id"=>$dataForModeOfComplains['mode_id'],"mode_name"=>$dataForModeOfComplains['mode_name']);


}

// echo "<pre>";
// print_r($modeOfComplain);

$modeOfComplaincount = count($modeOfComplain);

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

 ?>
<script>


var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Mode Of Complaints"
	},
	axisY: {
		title: ""
	},
	data: [{        
		type: "column",  
		showInLegend: true, 
		legendMarkerColor: "grey",
		legendText: "Mode",
		dataPoints: [      
			{ y: <?php echo $array_count_total_issue; ?>, label: "<?php echo 'Total'; ?>",indexLabel:"<?php echo $array_count_total_issue; ?>" },
            <?php 
            for($mode = 0; $mode < $modeOfComplaincount; $mode++){
                $modeIssue = 0;
                for($complaint = 0; $complaint < $array_count_total_issue; $complaint++){
                    if($modeOfComplain[$mode]['mode_name'] == $total_complaint[$complaint]['Mode Name']){
                        $modeIssue++;
                    }

                }
                
                $modeOfComplaintPercent = round($modeIssue*100/$array_count_total_issue);
                
                ?>
                { y: <?php echo $modeOfComplaintPercent; ?>,  label: "<?php echo $modeOfComplain[$mode]['mode_name']; ?>",indexLabel:"<?php echo $modeOfComplaintPercent."%"; ?>" },
                
                <?php
                

            }
            
            
            
            ?>
		
		]
	}]
});
chart.render();


</script>
