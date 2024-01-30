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
$to = date("Y-m-d");
$from = date('Y-m-d', strtotime('-10 days'));
$datesArray = array(); 
  
// Use strtotime function 
$Variable1 = strtotime($from); 
$Variable2 = strtotime($to); 
  
// Use for loop to store dates into array 
// 86400 sec = 24 hrs = 60*60*24 = 1 day 
for ($currentDate = $Variable1; $currentDate <= $Variable2; $currentDate += (86400)) { 
                                      
$Store = date('Y-m-d', $currentDate); 
$datesArray[] = $Store; 
} 
  
// Display the dates in array format 
// echo "<pre>";
// print_r($datesArray); 

$datesCount = count($datesArray);
$runForComplaintData = fetch_complaint_data_from_to_date($from,$to);
while($dataForComplaint = mysqli_fetch_assoc($runForComplaintData)){

    $complaintData[] = array("complaint record id"=>$dataForComplaint['complaint_record_id'],"student reg no"=>$dataForComplaint['student_reg_no'],
    "complain text"=>$dataForComplaint['complain_text'],"mode_name"=>$dataForComplaint['mode_name'],"complaint_received"=>$dataForComplaint['complaint_received'],
    "complaint_category_name"=>$dataForComplaint['complaint_category_name'],"complaint_sub_category_name"=>$dataForComplaint['complaint_sub_category_name'],
    "resolution"=>$dataForComplaint['resolution'],"issue_at"=>$dataForComplaint['issue_at'],"complaint_status_name"=>$dataForComplaint['complaint_status_name'],
    "currentdate"=>$dataForComplaint['currentdate'],"user_name"=>$dataForComplaint['user_name']);

}
$complaintDataCount = count($complaintData);

// echo "<pre>";
// print_r($complaintData);

$runforComplaintCato = fetch_all_data_from_complaint_category();
while($dataforComplaintCato = mysqli_fetch_assoc($runforComplaintCato)){

    $complaintCato[] = array("complaint_category_name"=>$dataforComplaintCato['complaint_category_name']);

}
$complaintCatoCount = count($complaintCato);
// echo "<pre>";
// print_r($complaintCato);?>

<br><div class="container-fluid">
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Summary</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body">  <table class="table table-bordered">

        <thead>
        
      <tr style="background-color:blue; color:white;">
      <th>Category</th>
      <?php 
      for($tablehead = 0; $tablehead < $datesCount;$tablehead++){?>
      <th><?php echo $datesArray[$tablehead]; ?></th>
      
      <?php

      }
      
      ?>
      <th>Total</th>
      </tr>
    </thead>
    <tbody>

<?php

    for($complaintCat = 0; $complaintCat < $complaintCatoCount; $complaintCat++){?>
     <tr>
        <td><?php echo $complaintCato[$complaintCat]['complaint_category_name']; ?></td>
    
    <?php
    $totalIsscat = 0;
        for($dat = 0; $dat < $datesCount; $dat++){
            $issueCount = 0;
            for($totalComplaint = 0; $totalComplaint < $complaintDataCount; $totalComplaint++){
                $dataDate =  date("Y-m-d", strtotime($complaintData[$totalComplaint]['complaint_received']));
                if($complaintCato[$complaintCat]['complaint_category_name'] == $complaintData[$totalComplaint]['complaint_category_name'] && $datesArray[$dat] == $dataDate){
                    $issueCount++;
                }
                
            }
            $totalIsscat = $totalIsscat + $issueCount;
            ?>
            
            <td><?php echo $issueCount; ?></td>
            
            <?php
        }?>
        
        <td><?php echo $totalIsscat; ?></td>
        
        <?php
    
    }
    
    ?>
        </tr>
    </tbody>
  </table></div>
      </div>
    </div>


  </div> 
</div>