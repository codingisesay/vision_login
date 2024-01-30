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
$to = date("Y-m-d");
$from = date('Y-m-d', strtotime('-10 days'));
$datesArray = array(); 
  
// Use strtotime function 
$Variable1 = strtotime($from); 
$Variable2 = strtotime($to); 
  
// Use for loop to store dates into array 
// 86400 sec = 24 hrs = 60*60*24 = 1 day 
for ($currentDate = $Variable1; $currentDate <= $Variable2; $currentDate += (86400)) { 
                                      
$Store = date('Y-m-d', $currentDate); 
$datesArray[] = $Store; 
} 
  
// Display the dates in array format 
// echo "<pre>";
// print_r($datesArray); 

$datesCount = count($datesArray);
$runForComplaintData = fetch_complaint_data_from_to_date($from,$to);
while($dataForComplaint = mysqli_fetch_assoc($runForComplaintData)){

    $complaintData[] = array("complaint record id"=>$dataForComplaint['complaint_record_id'],"student reg no"=>$dataForComplaint['student_reg_no'],
    "complain text"=>$dataForComplaint['complain_text'],"mode_name"=>$dataForComplaint['mode_name'],"complaint_received"=>$dataForComplaint['complaint_received'],
    "complaint_category_name"=>$dataForComplaint['complaint_category_name'],"complaint_sub_category_name"=>$dataForComplaint['complaint_sub_category_name'],
    "resolution"=>$dataForComplaint['resolution'],"issue_at"=>$dataForComplaint['issue_at'],"complaint_status_name"=>$dataForComplaint['complaint_status_name'],
    "currentdate"=>$dataForComplaint['currentdate'],"user_name"=>$dataForComplaint['user_name']);

}
$complaintDataCount = count($complaintData);

// echo "<pre>";
// print_r($complaintData);

$runforComplaintCato = fetch_all_data_from_complaint_category();
while($dataforComplaintCato = mysqli_fetch_assoc($runforComplaintCato)){

    $complaintCato[] = array("complaint_category_name"=>$dataforComplaintCato['complaint_category_name']);

}
$complaintCatoCount = count($complaintCato);
// echo "<pre>";
// print_r($complaintCato);



?>


<script>
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "Last Ten Days Complaints Record",
		fontFamily: "arial black",
		fontColor: "#695A42"
	},
	axisX: {
		// interval: 1,
		// intervalType: "year"
        valueFormatString: "DD-MMM"
	},
	axisY:{
		valueFormatString:"",
		gridColor: "#B6B1A8",
		tickColor: "#B6B1A8"
	},
	toolTip: {
		shared: true,
		// content: toolTipContent
	},
    data: [
    <?php 
    for($complaintCat = 0; $complaintCat < $complaintCatoCount; $complaintCat++){?>
    {
		type: "stackedColumn",
		showInLegend: true,
		// color: "#696661",
		name: "<?php echo $complaintCato[$complaintCat]['complaint_category_name']; ?>",
        dataPoints: [
    
    <?php
    
        for($dat = 0; $dat < $datesCount; $dat++){
            $issueCount = 0;
            for($totalComplaint = 0; $totalComplaint < $complaintDataCount; $totalComplaint++){
                $dataDate =  date("Y-m-d", strtotime($complaintData[$totalComplaint]['complaint_received']));
                if($complaintCato[$complaintCat]['complaint_category_name'] == $complaintData[$totalComplaint]['complaint_category_name'] && $datesArray[$dat] == $dataDate){
                    $issueCount++;
                }
        
            }?>
            

                { y: <?php echo $issueCount; ?>, x: new Date("<?php echo $datesArray[$dat];?>"),indexLabel:"<?php echo $issueCount; ?>"},
            
            <?php
    
            //  $complaintCato[$complaintCat]['complaint_category_name']." : ".$datesArray[$dat]." : ".$issueCount."<br>";
    
        }?>

        ]
    },

        <?php
    
    }
    
    ?>
    ]	

});
chart.render();
document.getElementById("exportChart").addEventListener("click",function(){
    	chart.exportChart({format: "jpg"});
    }); 

function toolTipContent(e) {
	var str = "";
	var total = 0;
	var str2, str3;
	for (var i = 0; i < e.entries.length; i++){
		var  str1 = "<span style= \"color:"+e.entries[i].dataSeries.color + "\"> "+e.entries[i].dataSeries.name+"</span>: <strong>"+e.entries[i].dataPoint.y+"</strong><br/>";
		total = e.entries[i].dataPoint.y + total;
		str = str.concat(str1);
	}
	str2 = "<span style = \"color:DodgerBlue;\"><strong>"+(e.entries[0].dataPoint.x).getFullYear()+"</strong></span><br/>";
	total = Math.round(total * 100) / 100;
	str3 = "<span style = \"color:Tomato\">Total:</span><strong> "+total+"</strong><br/>";
	return (str2.concat(str)).concat(str3);
}

</script>
