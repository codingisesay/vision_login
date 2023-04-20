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
$to_date = $_POST['to_date'];
$from_date = $_POST['from_date'];

$query="SELECT complaint_record.student_reg_no,complaint_record.complain_text,complaint_record.resolution,
complaint_record.current_date,complaint_record.issue_at,complaint_category.complaint_category_name,
complaint_sub_category.complaint_sub_category_name,mode_of_complaint.mode_name,complaint_status.complaint_status_name,
user.user_name FROM complaint_record 
LEFT JOIN complaint_category ON complaint_record.complaint_category = complaint_category.complaint_category_id 
LEFT JOIN complaint_sub_category ON complaint_record.complaint_sub_category = complaint_sub_category.complaint_sub_category_id 
LEFT JOIN mode_of_complaint ON complaint_record.mode_of_complaint = mode_of_complaint.mode_id 
LEFT JOIN complaint_status ON complaint_record.status = complaint_status.complaint_status_id 
LEFT JOIN user ON complaint_record.updated_by = user.user_id WHERE complaint_record.current_date between '$to_date' and '$from_date'  ORDER BY complaint_record.complaint_record_id ASC";

$run = mysqli_query($connect,$query);
while($data = mysqli_fetch_assoc($run)){

    $complaint_record[] = array("Student registraion No" => $data['student_reg_no'],"Complaint Text" => $data['complain_text'],"resolution" =>$data['resolution'],
"Date" => $data['current_date'], "Issue at" => $data['issue_at'],"complaint category name" => $data['complaint_category_name'],"complaint sub category name" => $data['complaint_sub_category_name'],
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




