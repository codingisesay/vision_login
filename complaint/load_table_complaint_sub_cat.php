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
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
//$sub_cat = $_POST['sub_cat'];
$sub_cat = $_POST['sub_cat'];
$run_for_id = fetch_cat_by_id($sub_cat);
$data_for_id = mysqli_fetch_assoc($run_for_id);
$cat_id = $data_for_id['complaint_category_id'];

$run_total_complaint = fetch_complaint_data_from_to_date($from_date,$to_date);
while($data_total_complaints = mysqli_fetch_assoc($run_total_complaint)){
    $total_complaint[] = array("Student Reg No" => $data_total_complaints['student_reg_no'],"Complaint Text" => $data_total_complaints['complain_text'],
"Mode Name" => $data_total_complaints['mode_name'], "Complaint Received" => $data_total_complaints['complaint_received'],"Complaint Category Name" => $data_total_complaints['complaint_category_name'],
"Complaint Sub Category Name" => $data_total_complaints['complaint_sub_category_name'],"Resolution" => $data_total_complaints['resolution'],"Issue At" => $data_total_complaints['issue_at'],
"Complaint Status Name" => $data_total_complaints['complaint_status_name'], "Current Date" => $data_total_complaints['currentdate'],
"User Name" => $data_total_complaints['user_name']);
}
$array_count_total_issue = count($total_complaint);
//echo "<pre>";
//print_r($total_complaint);
for($total = 0; $total < $array_count_total_issue; $total++){
    if($sub_cat == $total_complaint[$total]['Complaint Category Name']){

        $cat_complaint[] = array("Student Reg No" => $total_complaint[$total]['Student Reg No'],"Complaint Text" => $total_complaint[$total]['Complaint Text'],
        "Mode Name" => $total_complaint[$total]['Mode Name'], "Complaint Received" => $total_complaint[$total]['Complaint Received'],"Complaint Category Name" => $total_complaint[$total]['Complaint Category Name'],
        "Complaint Sub Category Name" => $total_complaint[$total]['Complaint Sub Category Name'],"Resolution" => $total_complaint[$total]['Resolution'],"Issue At" => $total_complaint[$total]['Issue At'],
        "Complaint Status Name" => $total_complaint[$total]['Complaint Status Name'], "Current Date" => $total_complaint[$total]['Current Date'], 
        "User Name" => $total_complaint[$total]['User Name']);
        

    }
    

}
$total_cat = count($cat_complaint);

//echo "<pre>";
//print_r($cat_complaint);

$run_sub_cat = fetch_category_by_sub_cat($cat_id);
while($data_sub_cat = mysqli_fetch_assoc($run_sub_cat)){

    $sub_cat_by_cat_id[] = array("id" => $data_sub_cat['complaint_sub_category_id'],"Sub Cat Name" => $data_sub_cat['complaint_sub_category_name']);

}
$sub_count_cat = count($sub_cat_by_cat_id);
for($sub_cat = 0; $sub_cat < $sub_count_cat; $sub_cat++){?>
<div class="container-fluid">

<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $sub_cat; ?>"><?php echo $sub_cat_by_cat_id[$sub_cat]['Sub Cat Name']; ?></a>
      </h4>
    </div>
    <div id="collapse<?php echo $sub_cat; ?>" class="panel-collapse collapse">
      <div class="panel-body">
          <table class="table table-striped" border="1px solid black">
              <tr>
                  <th>Student Reg No.</th>
                  <th>Complaint Text</th>
                  <th>Received Date</th>
                  <th>Solved Date</th>
                  <th>Complaint Category</th>
                  <th>Complaint Sub Category</th>
                  <th>Resolution</th>
                  <th>Status</th>
                  <th>Update By</th>
                  
              </tr>
              <?php 
              for($data = 0; $data < $total_cat; $data++){
                if($sub_cat_by_cat_id[$sub_cat]['Sub Cat Name'] == $cat_complaint[$data]['Complaint Sub Category Name']){?>
                <tr>
                         <td><?php echo $cat_complaint[$data]['Student Reg No']?></td>
                         <td><?php echo $cat_complaint[$data]['Complaint Text']?></td>
                         <td><?php echo str_replace("T"," ",$cat_complaint[$data]['Complaint Received']);?></td>
                         
                         <td><?php echo $cat_complaint[$data]['Current Date']?></td>
                         <td><?php echo $cat_complaint[$data]['Complaint Category Name']?></td>
                         <td><?php echo $cat_complaint[$data]['Complaint Sub Category Name']?></td>
                         <td><?php echo $cat_complaint[$data]['Resolution']?></td>
                         <td><?php echo $cat_complaint[$data]['Complaint Status Name']?></td>
                         <td><?php echo $cat_complaint[$data]['User Name']?></td>
                     </tr>
                     <?php 

                }
                
                    
                     

}

?>
          </table>
      </div>
    </div>
  </div>
</div> 
</div>

  
<?php

}
//echo "<pre>";
//print_r($sub_cat_by_cat_id);

?>

