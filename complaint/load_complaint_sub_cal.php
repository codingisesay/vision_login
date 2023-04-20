<?php 
include('../database_connection.php');
$cat_id = $_POST['cat_id'];
$query = "SELECT complaint_sub_category.complaint_sub_category_id,complaint_sub_category.complaint_sub_category_name, complaint_category.complaint_category_name from complaint_sub_category LEFT JOIN complaint_category ON complaint_category.complaint_category_id = complaint_sub_category.complaint_category_id WHERE complaint_category.complaint_category_id = '$cat_id'";
$run = mysqli_query($connect,$query);
while($data = mysqli_fetch_assoc($run)){

    $complaint_cat[] = array("complaint sub category id" => $data['complaint_sub_category_id'],"complaint sub category name" => $data['complaint_sub_category_name']);

}

$complaint_complaint_count = count($complaint_cat);

for($i = 0; $i < $complaint_complaint_count; $i++){?>

<option value="<?php echo  $complaint_cat[$i]['complaint sub category id']; ?>"><?php echo $complaint_cat[$i]['complaint sub category name']; ?></option>

<?php 

}

?>