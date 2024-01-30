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
//$from_date = "2023-04-20";
//$to_date = "2023-04-24";
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
//$issue = $_POST['issue'];

$issue_at_end = array("Our end", "Student End", "General Enquiry");

$issue_end_count = count($issue_at_end);

$run_total_complaint = fetch_complaint_data_from_to_date($from_date,$to_date);
while($data_total_complaints = mysqli_fetch_assoc($run_total_complaint)){
    $total_complaint[] = array("Student Reg No" => $data_total_complaints['student_reg_no'],"Complaint Text" => $data_total_complaints['complain_text'],
"Mode Name" => $data_total_complaints['mode_name'], "Complaint Received" => $data_total_complaints['complaint_received'],"Complaint Category Name" => $data_total_complaints['complaint_category_name'],
"Complaint Sub Category Name" => $data_total_complaints['complaint_sub_category_name'],"Resolution" => $data_total_complaints['resolution'],"Issue At" => $data_total_complaints['issue_at'],
"Complaint Status Name" => $data_total_complaints['complaint_status_name'], "Current Date" => $data_total_complaints['currentdate'],
"User Name" => $data_total_complaints['user_name']);
}
$array_count_total_issue = count($total_complaint);


?>
<?php 
for($issue = 0; $issue < $issue_end_count; $issue++){?>
<div class="container-fluid">

<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $issue; ?>"><?php echo $issue_at_end[$issue]; ?></a>
      </h4>
    </div>
    <div id="collapse<?php echo $issue; ?>" class="panel-collapse collapse">
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
              for($com = 0; $com < $array_count_total_issue; $com++){
                if($issue_at_end[$issue] == $total_complaint[$com]['Issue At']){?>
                 <tr>
                         <td><?php echo $total_complaint[$com]['Student Reg No']?></td>
                         <td><?php echo $total_complaint[$com]['Complaint Text']?></td>
                         <td><?php echo str_replace("T"," ",$total_complaint[$com]['Complaint Received']);?></td>
                         
                         <td><?php echo $total_complaint[$com]['Current Date']?></td>
                         <td><?php echo $total_complaint[$com]['Complaint Category Name']?></td>
                         <td><?php echo $total_complaint[$com]['Complaint Sub Category Name']?></td>
                         <td><?php echo $total_complaint[$com]['Resolution']?></td>
                         <td><?php echo $total_complaint[$com]['Complaint Status Name']?></td>
                         <td><?php echo $total_complaint[$com]['User Name']?></td>
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


?>

