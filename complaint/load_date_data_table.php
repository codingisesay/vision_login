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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<?php 
include('complaint_functions.php');
//$input_date = $_POST['date_input'];
//$input_date = "";
$date=date_create($_POST['date_input']);
$from_date = date_format($date,"Y-m-d")." "."00:00:00";
$to_date = date_format($date,"Y-m-d")." "."23:59:59";

$run_date = fetch_complaint_data_from_to_date($from_date,$to_date);

while($data_total_complaints = mysqli_fetch_assoc($run_date)){
 
    $total_complaint[] = array("Student Reg No" => $data_total_complaints['student_reg_no'],"Complaint Text" => $data_total_complaints['complain_text'],
    "Mode Name" => $data_total_complaints['mode_name'], "Complaint Received" => $data_total_complaints['complaint_received'],"Complaint Category Name" => $data_total_complaints['complaint_category_name'],
    "Complaint Sub Category Name" => $data_total_complaints['complaint_sub_category_name'],"Resolution" => $data_total_complaints['resolution'],"Issue At" => $data_total_complaints['issue_at'],
    "Complaint Status Name" => $data_total_complaints['complaint_status_name'], "Current Date" => substr_replace($data_total_complaints['currentdate'],"",-9),
    "User Name" => $data_total_complaints['user_name']);
    
            }

            $run_cat = fetch_all_data_from_complaint_category();
            while($data_cat = mysqli_fetch_assoc($run_cat)){
    
                $cat_data_array[] = array("Category Name" =>$data_cat['complaint_category_name']);
    
            }

            //echo "<pre>";
            //print_r($cat_data_array);

            $total_count = count($total_complaint);
            $cat_type = count($cat_data_array);

            for($cat = 0; $cat < $cat_type; $cat++){?>
            
<div class="container-fluid">
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $cat; ?>"><?php echo $cat_data_array[$cat]['Category Name'];?></a>
        </h4>
      </div>
      <div id="collapse<?php echo $cat; ?>" class="panel-collapse collapse">
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
              for($total = 0; $total < $total_count; $total++){
                if($cat_data_array[$cat]['Category Name'] == $total_complaint[$total]['Complaint Category Name']){?>
                <tr>
                         <td><?php echo $total_complaint[$total]['Student Reg No']?></td>
                         <td><?php echo $total_complaint[$total]['Complaint Text']?></td>
                         <td><?php echo str_replace("T"," ",$total_complaint[$total]['Complaint Received']);?></td>
                         
                         <td><?php echo $total_complaint[$total]['Current Date']?></td>
                         <td><?php echo $total_complaint[$total]['Complaint Category Name']?></td>
                         <td><?php echo $total_complaint[$total]['Complaint Sub Category Name']?></td>
                         <td><?php echo $total_complaint[$total]['Resolution']?></td>
                         <td><?php echo $total_complaint[$total]['Complaint Status Name']?></td>
                         <td><?php echo $total_complaint[$total]['User Name']?></td>
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
