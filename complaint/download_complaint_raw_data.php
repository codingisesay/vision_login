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
// $from_date = "2023-12-22";
// $to_date = "2023-12-20";

$run = fetch_complaint_data_from_to_date($from_date,$to_date,);


while($data = mysqli_fetch_assoc($run)){

    $complaint_record[] = array("Student registraion No" => $data['student_reg_no'],"Complaint Text" => $data['complain_text'],"resolution" =>$data['resolution'],
"Date" => $data['currentdate'], "Issue at" => $data['issue_at'],"complaint category name" => $data['complaint_category_name'],"complaint sub category name" => $data['complaint_sub_category_name'],
"Mode Name" => $data['mode_name'],"complaint status name" => $data['complaint_status_name'],"user name" => $data['user_name']); 

}

$complaint_count = count($complaint_record);

ob_clean();   
    header("Content-Disposition: attachment; filename=complaint_raw_data.xls"); 
    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
//echo "<pre>";
//print_r($complaint_record);
//echo "<pre>";

?>
<table border="1" style="margin-top: 2%;">
    <tr style="background-color:#87CEEB; color:white;">
        <th>Date</th>
        <th>Student registraion No</th>
        <th>Complaint Text</th>
        <th>Complaint Category</th>
        <th>Complaint Sub Category</th>
        <th>Resolution</th>
        <th>Mode Name</th>
        <th>Complaint Status Name</th>
        <th>Issue at</th>
        <th>Updated By</th>
</tr>
<?php 
for($i=0; $i < $complaint_count; $i++){?>
<tr>
    <td><?php echo $complaint_record[$i]['Date']; ?></td>
    <td><?php echo $complaint_record[$i]['Student registraion No']; ?></td>
    <td><?php echo $complaint_record[$i]['Complaint Text']; ?></td>
    <td><?php echo $complaint_record[$i]['complaint category name']; ?></td>
    <td><?php echo $complaint_record[$i]['complaint sub category name']; ?></td>
    <td><?php echo $complaint_record[$i]['resolution']; ?></td>
    <td><?php echo $complaint_record[$i]['Mode Name']; ?></td>
    <td><?php echo $complaint_record[$i]['complaint status name']; ?></td>
    <td><?php echo $complaint_record[$i]['Issue at']; ?></td>
    <td><?php echo $complaint_record[$i]['user name']; ?></td>
</tr>


<?php

}

?>
</table>




