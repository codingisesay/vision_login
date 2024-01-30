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
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<?php 
include('complaint_navbar.php');
$act_pen = array("Active","Pending");
$act_pen_count = count($act_pen);
$query = "SELECT complaint_record.complaint_record_id, complaint_record.student_reg_no,complaint_record.complain_text,mode_of_complaint.mode_name,
complaint_record.complaint_received, complaint_category.complaint_category_name,
 complaint_sub_category.complaint_sub_category_name, complaint_record.resolution,complaint_record.issue_at,
 complaint_status.complaint_status_name,complaint_record.currentdate,user.user_name FROM `complaint_record` 
 LEFT JOIN mode_of_complaint ON complaint_record.mode_of_complaint = mode_of_complaint.mode_id 
 LEFT JOIN complaint_category on complaint_record.complaint_category = complaint_category.complaint_category_id 
 LEFT JOIN complaint_sub_category ON complaint_record.complaint_sub_category = complaint_sub_category.complaint_sub_category_id 
 LEFT JOIN complaint_status ON complaint_record.status = complaint_status.complaint_status_id 
 LEFT JOIN user ON complaint_record.updated_by = user.user_id WHERE status = '1' OR status = '2'";
$run = mysqli_query($connect,$query);
while($data_total_complaints = mysqli_fetch_assoc($run)){
$total_act_pen[] = array("complaint id"=>$data_total_complaints['complaint_record_id'],"Student Reg No" => $data_total_complaints['student_reg_no'],"Complaint Text" => $data_total_complaints['complain_text'],
"Mode Name" => $data_total_complaints['mode_name'], "Complaint Received" => $data_total_complaints['complaint_received'],"Complaint Category Name" => $data_total_complaints['complaint_category_name'],
"Complaint Sub Category Name" => $data_total_complaints['complaint_sub_category_name'],"Resolution" => $data_total_complaints['resolution'],"Issue At" => $data_total_complaints['issue_at'],
"Complaint Status Name" => $data_total_complaints['complaint_status_name'], "Current Date" => $data_total_complaints['currentdate'],
"User Name" => $data_total_complaints['user_name']);
}
$array_count_total_issue = count($total_act_pen);
//$row = mysqli_num_rows($run);
for($i = 0; $i < $act_pen_count; $i++){?>
<div class="container-fluid">
  
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>"><?php echo $act_pen[$i]; ?></a>
        </h4>
      </div>
      <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse in">
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
                  <th>Update</th>
                  
              </tr>
              <?php 
              for($col = 0; $col < $array_count_total_issue; $col++){
                if($act_pen[$i] == $total_act_pen[$col]['Complaint Status Name']){?>
                       <tr>
                         <td><?php echo $total_act_pen[$col]['Student Reg No']?></td>
                         <td><?php echo $total_act_pen[$col]['Complaint Text']?></td>
                         <td><?php echo str_replace("T"," ",$total_act_pen[$col]['Complaint Received']);?></td>
                         
                         <td><?php echo $total_act_pen[$col]['Current Date']?></td>
                         <td><?php echo $total_act_pen[$col]['Complaint Category Name']?></td>
                         <td><?php echo $total_act_pen[$col]['Complaint Sub Category Name']?></td>
                         <td><?php echo $total_act_pen[$col]['Resolution']?></td>
                         <td><?php echo $total_act_pen[$col]['Complaint Status Name']?></td>
                         <td><?php echo $total_act_pen[$col]['User Name']?></td>
                         <td><a href="complaint_edit.php?complaint_id=<?php echo $total_act_pen[$col]['complaint id'];?>" class="btn btn-primary">Edit</a></td>
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


    