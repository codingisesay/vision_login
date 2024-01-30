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
"Complaint Status Name" => $data_total_complaints['complaint_status_name'], "Current Date" => $data_total_complaints['currentdate'],
"User Name" => $data_total_complaints['user_name']);
}
$array_count_total_issue = count($total_complaint);
$run_com_cat = fetch_all_data_from_complaint_category();
while($data_com_cat = mysqli_fetch_assoc($run_com_cat)){

    $com_cat_array[] = array("ID" => $data_com_cat['complaint_category_id'], "Name" => $data_com_cat['complaint_category_name']);

}
$com_cat_array_count = count($com_cat_array);
for($cato = 0; $cato < $com_cat_array_count; $cato++){?>

<div class="container-fluid">

  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $cato; ?>"><?php echo $com_cat_array[$cato]['Name']; ?></a>
        </h4>
      </div>
      <div id="collapse<?php echo $cato; ?>" class="panel-collapse collapse">
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
                for($total = 0; $total < $array_count_total_issue; $total++){
                    if($com_cat_array[$cato]['Name'] == $total_complaint[$total]['Complaint Category Name']){
                        ?>
                        <tr>
                           <td><?php echo $total_complaint[$total]['Student Reg No'];?></td>
                           <td><?php echo $total_complaint[$total]['Complaint Text'];?></td>
                           <td><?php echo str_replace("T"," ",$total_complaint[$total]['Complaint Received']);?></td>
                           <td><?php echo $total_complaint[$total]['Current Date'];?></td>
                           <td><?php echo $total_complaint[$total]['Complaint Category Name'];?></td>
                           <td><?php echo $total_complaint[$total]['Complaint Sub Category Name'];?></td>
                           <td><?php echo $total_complaint[$total]['Resolution'];?></td>
                           <td><?php echo $total_complaint[$total]['Complaint Status Name']; ?></td>
                           <td><?php echo $total_complaint[$total]['User Name']; ?></td>
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




    

