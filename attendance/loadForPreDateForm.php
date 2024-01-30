<?php
include('../session.php'); 
// error_reporting(0);
// ini_set('session.gc_maxlifetime', 2592000);
// //ini_set('session.save_path', '/var/lib/php/sessions');
// session_start();
// include('../database_connection.php');
// include('../functions.php');
// $device_cookie=$_COOKIE['PHPSESSID'];
// $user_id=$_SESSION['id'];
// $row_of_specific_device = specific_device_from_login_log($device_cookie,$user_id);
// mysqli_num_rows($row_of_specific_device);
// $data = mysqli_fetch_assoc($row_of_specific_device);

// if(!isset($_SESSION['id']) || !isset($_COOKIE['PHPSESSID']) || $data['session_status'] == "inactive"){

//     $q="UPDATE login_log
//         SET session_status='inactive'
//         WHERE device_cookie='$device_cookie' OR user_id = '$user_id'";
//         $result = mysqli_query($connect,$q);

//          page_redirect('../index.php');
// }
?>
<?php 
include('attendance_function.php');
$preDate = $_POST['previous_date'];
$run_for_pre_date = load_all_checklist_date($preDate);
while($data_for_pre_date = mysqli_fetch_assoc($run_for_pre_date)){

    $pre_date_class[] = array("checklist Id" => $data_for_pre_date['checklist_id'],"class date" => $data_for_pre_date['class_date'],
"class id" => $data_for_pre_date['class_id_from_lecture_list'],"Coordinator Name" => $data_for_pre_date['batch_coordinator'],"Batch" => $data_for_pre_date['batch'],
"subject" => $data_for_pre_date['subject'],"AttAssId" => $data_for_pre_date['att_ass_id'],"Attendance" => $data_for_pre_date['attendance'],
"Response" => $data_for_pre_date['response'],"Assignment" => $data_for_pre_date['assignment']);


}
$run_for_user_name = fetch_user_name_by_id($user_id);
while($data_for_user_name = mysqli_fetch_assoc($run_for_user_name)){

  $userName[] = array("User Name" => $data_for_user_name['user_name']);

}
//echo "<pre>";
//print_r($userName);

$pre_date_class_count = count($pre_date_class);

?>
<div class="container-fluid">
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Previous Date Record</a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse in">
        <div class="panel-body"><table class="table table-bordered" id="preTable">
    <thead style="background-color:#1c3961; color:white;">
      <tr>
        <th>Class Id</th>
        <th>Date</th>
        <th>Coordinator Name</th>
        <th>Batch</th>
        <th>Subject</th>
        <th>Attendance</th>
        <th>Response Portal</th>
        <th>Assignment</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
        <?php
    for($pre = 0; $pre < $pre_date_class_count; $pre++){
        if($userName[0]['User Name'] == $pre_date_class[$pre]['Coordinator Name']){?>
        <tr>
    <td style="display:none;"><?php echo $pre_date_class[$pre]['checklist Id'];?></td>
        <td><?php echo $pre_date_class[$pre]['class id']; ?></td>
        <td style="display:none;"><?php echo $user_id; ?></td>
        <td><?php 
            $orgDate = $pre_date_class[$pre]['class date'];  
            echo $newDate = date("d-m-Y", strtotime($orgDate));  
             
         ?></td>
        <td><?php echo $res = preg_replace('/[0-9-]+/', '', $pre_date_class[$pre]['Coordinator Name']); ?></td>
        <td><?php echo "*".str_replace(",","<br>*",$pre_date_class[$pre]['Batch']); ?></td>
        <td><?php echo $pre_date_class[$pre]['subject']; ?></td>
        <td><input type="number" class="attandance" value="<?php echo $pre_date_class[$pre]['Attendance']; ?>" ></td>
        <td><input type="number" id="response" value="<?php echo $pre_date_class[$pre]['Response']; ?>" ></td>
        <td><input type="number" id="assignment" value="<?php echo $pre_date_class[$pre]['Assignment']; ?>" ></td>
        <?php 
        if($pre_date_class[$pre]['Attendance'] == "" && $pre_date_class[$pre]['Response'] == "" && $pre_date_class[$pre]['Assignment'] == ""){?>
        
        <td><button type="button" class="pre_insert btn btn-primary" id="ins_btn" data-checklis_id ="<?php echo $pre_date_class[$pre]['checklist Id'];?>">Insert</button></td>
        
        <?php

        }else{?>
        
        <td><button type="button" class="pre_update btn btn-primary" id="upt_btn" data-checklist_id ="<?php echo $pre_date_class[$pre]['checklist Id'];?>">Update</button></td>
        
        <?php

        }
        
        ?>
        
      
      </tr>
        
        
        <?php

        }
        ?>
    
    
    <?php

    }
    ?>
    </tbody>
</div>
      </div>
    </div>
    
      
    </div>
   
  </div> 