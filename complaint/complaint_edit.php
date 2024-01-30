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
$complaint_id = $_GET['complaint_id'];

$query = "SELECT complaint_record.complaint_record_id, complaint_record.student_reg_no,complaint_record.complain_text,mode_of_complaint.mode_id,mode_of_complaint.mode_name,
complaint_record.complaint_received, complaint_category.complaint_category_id, complaint_category.complaint_category_name,
complaint_sub_category.complaint_sub_category_id,complaint_sub_category.complaint_sub_category_name, complaint_record.resolution,complaint_record.issue_at,
complaint_status.complaint_status_id,complaint_status.complaint_status_name,complaint_record.currentdate,user.user_name FROM `complaint_record` 
 LEFT JOIN mode_of_complaint ON complaint_record.mode_of_complaint = mode_of_complaint.mode_id 
 LEFT JOIN complaint_category on complaint_record.complaint_category = complaint_category.complaint_category_id 
 LEFT JOIN complaint_sub_category ON complaint_record.complaint_sub_category = complaint_sub_category.complaint_sub_category_id 
 LEFT JOIN complaint_status ON complaint_record.status = complaint_status.complaint_status_id 
 LEFT JOIN user ON complaint_record.updated_by = user.user_id WHERE complaint_record.complaint_record_id = '$complaint_id'";

$run = mysqli_query($connect,$query);
while($data_total_complaints = mysqli_fetch_assoc($run)){
$complaint_detail[] = array("complaint id"=>$data_total_complaints['complaint_record_id'],"Student Reg No" => $data_total_complaints['student_reg_no'],"Complaint Text" => $data_total_complaints['complain_text'],"Mode Id" => $data_total_complaints['mode_id'],
"Mode Name" => $data_total_complaints['mode_name'], "Complaint Received" => $data_total_complaints['complaint_received'],"complaint category id" => $data_total_complaints['complaint_category_id'],"Complaint Category Name" => $data_total_complaints['complaint_category_name'],
"complaint sub category id" => $data_total_complaints['complaint_sub_category_id'],"Complaint Sub Category Name" => $data_total_complaints['complaint_sub_category_name'],"Resolution" => $data_total_complaints['resolution'],"Issue At" => $data_total_complaints['issue_at'],
"complaint status id" => $data_total_complaints['complaint_status_id'],"Complaint Status Name" => $data_total_complaints['complaint_status_name'], "Current Date" => $data_total_complaints['current_date'],
"User Name" => $data_total_complaints['user_name']);
}
$array_count_total_issue = count($complaint_detail);


?>

<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style>
input[type=text],[type=number],[type=datetime-local],textarea, select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 5px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.form_layout{
    width: 80%;
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
  position: relative;
  left: 10%;
}
</style>

</head>
<body>
    <?php include('complaint_navbar.php'); 
    include('complaint_functions.php');
    
    ?>

<h3 style="text-align:center;">Edit Complaint Details</h3>

<div class="form_layout">
  <form id="complaint_form">
    <label for="fname">Student Registration No.</label>
    <input type="number" id="student_reg_no" name="firstname" value="<?php echo $complaint_detail[0]['Student Reg No']; ?>" required>
    <input type="hidden" value="<?php echo $complaint_detail[0]['complaint id']; ?>" id="complaint_id">
    <label for="lname">Complaint Text</label>
   <textarea rows="6" cols="78" id="complaint_txt" required><?php echo $complaint_detail[0]['Complaint Text']; ?></textarea>

    <label for="country">Mode Of Complaint</label>
    <select id="mode_of_complaint" name="country" required>
      <option value="<?php echo $complaint_detail[0]['Mode Id']; ?>"><?php echo $complaint_detail[0]['Mode Name']; ?></option>
      <?php 
      $run_for_modes = fetch_all_data_from_mode_of_complaint();
      while($data_for_modes = mysqli_fetch_assoc($run_for_modes)){
        $modes_data[] = array("Mode Id" => $data_for_modes['mode_id'], "Mode Name" => $data_for_modes['mode_name']);
      }
      $modes_array_count = count($modes_data);
      for($modes = 0; $modes < $modes_array_count; $modes++){?>
      <option value="<?php echo $modes_data[$modes]['Mode Id'];?>"><?php echo $modes_data[$modes]['Mode Name']?></option>
      <?php

      }

      ?>
      
    </select>
    
    <label>Date And Time Complaint Received</label>
    <input type="datetime-local" name="date" id="datetime" value="<?php echo $complaint_detail[0]['Complaint Received'];?>">
    
    <label for="country">Complaint Category</label><br>
     <select id="complain_cat" name="country" required>
      <option value="<?php echo $complaint_detail[0]['complaint category id'];?>"><?php echo $complaint_detail[0]['Complaint Category Name'];?></option>
      <?php 
      $run_complaint_category = fetch_all_data_from_complaint_category();
      while($data_complaint_category = mysqli_fetch_assoc($run_complaint_category)){

        $array_complaint_category[] = array("ID" => $data_complaint_category['complaint_category_id'], "Name" => $data_complaint_category['complaint_category_name']);

      }
      echo "<pre>";
      print_r($array_complaint_category);
      
      $complaint_cat_count = count($array_complaint_category);
      for($cat = 0; $cat < $complaint_cat_count; $cat++){?>
      
      <option value="<?php echo $array_complaint_category[$cat]['ID']; ?>"><?php echo $array_complaint_category[$cat]['Name']; ?></option>
      
      <?php

      }
      ?>
      
    </select>
     <label for="country">Complaint Sub Category</label><br>
     <select id="somplaint_sub_cat" name="country">
      <option value="<?php echo $complaint_detail[0]['complaint sub category id'];?>"><?php echo $complaint_detail[0]['Complaint Sub Category Name'];?></option>
     
    </select>
    <label for="lname">Action Taken</label>
   <textarea rows="6" cols="78" placeholder="Resolution" id="resolution" required><?php echo $complaint_detail[0]['Resolution']; ?></textarea>
   <label>Issue At</label>
    <select id="issue_at_end" required>
        <option value="<?php echo $complaint_detail[0]['Issue At']; ?>"><?php echo $complaint_detail[0]['Issue At']; ?></option>
        <option>Our end</option>
        <option>Student End</option>
<option>General Enquiry</option>
    </select>
   <label for="country">Status Of Complaint</label><br>
     <select name="country" id="status_of_complaint" required>
      <option value="<?php echo $complaint_detail[0]['complaint status id']; ?>"><?php echo $complaint_detail[0]['Complaint Status Name']; ?></option>
      <?php 
      $run_status = status_of_complaint();
      while($data_status = mysqli_fetch_assoc($run_status)){

        $complaint_status[] = array("complaint status id" => $data_status['complaint_status_id'], "complaint status name" => $data_status['complaint_status_name']);

      }
      $complaint_status_count = count($complaint_status);
      for($status = 0; $status < $complaint_status_count; $status++){?>
      
      <option value="<?php echo $complaint_status[$status]['complaint status id']; ?>"><?php echo $complaint_status[$status]['complaint status name']?></option>
      
      <?php

      }
      
      ?>
     
    </select>
   
     
    <input type="submit" value="Update">
  </form>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$("#complain_cat").on("change",function(){
    var cato = $(this).val();
    console.log(cato);
    $.ajax({
        url:"load_complaint_sub_cal.php",
        type:"POST",
        data:{cat_id:cato},
        success:function(data){

            $('#somplaint_sub_cat').html(data);


        }
    })
})

$("#complaint_form").submit(function(e){
    e.preventDefault();
   var student_reg = $("#student_reg_no").val();
   var complaint_id = $("#complaint_id").val();
   var complaint_txt = $("#complaint_txt").val();
   var mode_of_complaint = $("#mode_of_complaint").val();
   var datetime = $("#datetime").val();
   var complain_cat = $("#complain_cat").val();
   var somplaint_sub_cat = $("#somplaint_sub_cat").val();
   var resolution = $("#resolution").val();
   var issue_at_end = $("#issue_at_end").val();
   var status_of_complaint = $("#status_of_complaint").val();

   //console.log(student_reg);
   //console.log(complaint_id);
   //console.log(complaint_txt);
   //console.log(mode_of_complaint);
   //console.log(datetime);
   //console.log(complain_cat);
   //console.log(somplaint_sub_cat);
   //console.log(resolution);
   //console.log(issue_at_end);
   //console.log(status_of_complaint);
   

  $.ajax({
    url:"update_complaint.php",
    type:"POST",
    data:{student_reg:student_reg,complaint_id:complaint_id,complaint_txt:complaint_txt,mode_of_complaint:mode_of_complaint,datetime:datetime,complain_cat:complain_cat,somplaint_sub_cat:somplaint_sub_cat,resolution:resolution,issue_at_end:issue_at_end,status_of_complaint:status_of_complaint},
    success:function(data){
     if(data == 1){
        alert("Complaint Updated");
        location.replace("index.php");
     }else{
        alert("Complaint Not updated");
     }
    }
  })
   
});


})
</script>

