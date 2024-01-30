<?php 
function fetch_all_data_from_mode_of_complaint(){
    include('../database_connection.php');
    $query = "SELECT * FROM mode_of_complaint";
    return $run = mysqli_query($connect,$query);
}
function fetch_all_data_from_complaint_category(){
    include('../database_connection.php');
    $query = "SELECT * FROM complaint_category";
    return $run = mysqli_query($connect,$query);
 
}
function status_of_complaint(){
    include('../database_connection.php');
    $query = "SELECT * FROM complaint_status";
    return $run = mysqli_query($connect,$query);

}
function fetch_complaint_data_from_to_date($from_date,$to_date){
    include('../database_connection.php');
    $query = "SELECT complaint_record.complaint_record_id,complaint_record.student_reg_no,complaint_record.complain_text,mode_of_complaint.mode_name,
     complaint_record.complaint_received, complaint_category.complaint_category_name,
      complaint_sub_category.complaint_sub_category_name, complaint_record.resolution,complaint_record.issue_at,
      complaint_status.complaint_status_name,complaint_record.currentdate,user.user_name FROM `complaint_record` 
      LEFT JOIN mode_of_complaint ON complaint_record.mode_of_complaint = mode_of_complaint.mode_id 
      LEFT JOIN complaint_category on complaint_record.complaint_category = complaint_category.complaint_category_id 
      LEFT JOIN complaint_sub_category ON complaint_record.complaint_sub_category = complaint_sub_category.complaint_sub_category_id 
      LEFT JOIN complaint_status ON complaint_record.status = complaint_status.complaint_status_id 
      LEFT JOIN user ON complaint_record.updated_by = user.user_id WHERE complaint_record.currentdate >= '$from_date 00:00:00' AND complaint_record.currentdate <='$to_date 23:59:59'";
      return mysqli_query($connect,$query);

}
function fetch_category_by_sub_cat($cat_id){
    include('../database_connection.php');
    $query = "SELECT * FROM complaint_sub_category WHERE complaint_category_id = '$cat_id'";
    return mysqli_query($connect,$query);

}
function fetch_cat_by_id($cat_name){
    include('../database_connection.php');
    $query = "SELECT * FROM complaint_category WHERE complaint_category_name = '$cat_name'";
    return mysqli_query($connect,$query);

}

function modeOfComplaints(){
    include('../database_connection.php');
    $query = "SELECT * FROM mode_of_complaint";
    return mysqli_query($connect,$query);
}

?>