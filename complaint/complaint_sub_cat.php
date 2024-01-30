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
<head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<?php 
include('complaint_functions.php');
//$from_date = "2023-04-20";
//$to_date = "2023-04-25";
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
$sub_cat = $_POST['sub_cat'];
//$sub_cat = "Website/App Related Issue";
//$sub_cat = "Handout Related Issue";


$run_for_id = fetch_cat_by_id($sub_cat);
$data_for_id = mysqli_fetch_assoc($run_for_id);
$cat_id = $data_for_id['complaint_category_id'];



$run_com_sub_cat = fetch_complaint_data_from_to_date($from_date,$to_date);

while($data_total_complaints = mysqli_fetch_assoc($run_com_sub_cat)){
    $total_complaint[] = array("Student Reg No" => $data_total_complaints['student_reg_no'],"Complaint Text" => $data_total_complaints['complain_text'],
"Mode Name" => $data_total_complaints['mode_name'], "Complaint Received" => $data_total_complaints['complaint_received'],"Complaint Category Name" => $data_total_complaints['complaint_category_name'],
"Complaint Sub Category Name" => $data_total_complaints['complaint_sub_category_name'],"Resolution" => $data_total_complaints['resolution'],"Issue At" => $data_total_complaints['issue_at'],
"Complaint Status Name" => $data_total_complaints['complaint_status_name'], "Current Date" => $data_total_complaints['currentdate'],
"User Name" => $data_total_complaints['user_name']);
}
$array_count_total_issue = count($total_complaint);


for($total = 0; $total < $array_count_total_issue; $total++){
    if(mysqli_real_escape_string($connect,$sub_cat) == $total_complaint[$total]['Complaint Category Name']){

        $cat_complaint[] = array("Student Reg No" => $total_complaint[$total]['Student Reg No'],"Complaint Text" => $total_complaint[$total]['Complaint Text'],
        "Mode Name" => $total_complaint[$total]['Mode Name'], "Complaint Received" => $total_complaint[$total]['Complaint Received'],"Complaint Category Name" => $total_complaint[$total]['Complaint Category Name'],
        "Complaint Sub Category Name" => $total_complaint[$total]['Complaint Sub Category Name'],"Resolution" => $total_complaint[$total]['Resolution'],"Issue At" => $total_complaint[$total]['Issue At'],
        "Complaint Status Name" => $total_complaint[$total]['Complaint Status Name'], "Current Date" => $total_complaint[$total]['Current Date'], 
        "User Name" => $total_complaint[$total]['User Name']);
        

    }
    

}


// echo "<pre>";
// print_r($cat_complaint);

$total_cat = count($cat_complaint);
$run_sub_cat = fetch_category_by_sub_cat($cat_id);
while($data_sub_cat = mysqli_fetch_assoc($run_sub_cat)){

    $sub_cat_by_cat_id[] = array("id" => $data_sub_cat['complaint_sub_category_id'],"Sub Cat Name" => $data_sub_cat['complaint_sub_category_name']);

}
$sub_count_cat = count($sub_cat_by_cat_id);

if($total_cat == 0){
echo "<h1>No Complaint In This Category</h1>";

}else{?>

<script>


var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Category Wise"
	},
	axisY: {
		title: ""
	},
	data: [{        
		type: "column",  
		showInLegend: true, 
		legendMarkerColor: "grey",
		legendText: "Complaint Category",
		dataPoints: [ 
    
      { y: <?php echo $total_cat; ?>, label: "<?php echo 'Total'; ?>",indexLabel:"<?php echo $total_cat; ?>" },
      <?php
              for($sub = 0; $sub < $sub_count_cat; $sub++){
                $sub_cat_count = 0;
                for($com = 0; $com < $total_cat; $com++){ 
                    if($sub_cat_by_cat_id[$sub]['Sub Cat Name'] == $cat_complaint[$com]['Complaint Sub Category Name']){
                        $sub_cat_count++;
    
                    }

                   
                }

                $catPercantage = round($sub_cat_count*100/$total_cat);
                // if($catPercantage == 0){
                //   continue;

                // }
                ?>
                    { y: <?php echo $catPercantage;  ?>, label: "<?php echo substr($sub_cat_by_cat_id[$sub]['Sub Cat Name'],0);?>",indexLabel:"<?php echo $catPercantage."%"; ?>" },
                     
                     <?php
               
    
            }
            ?>     
		]
	}]
});
chart.render();
<?php 
}
?>
</script>
