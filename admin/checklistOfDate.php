<!-- <head>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head> -->
<?php
session_start();
include('../database_connection.php');
include('../testing/testing_functions.php');
if(!isset($_SESSION['admin_id'])){
	header('location:index.php');

}
?>
<?php 
$selectedDate = trim($_POST['selecteddate']);

$query="SELECT * FROM checklist_record WHERE class_date = '$selectedDate'";

$run = mysqli_query($connect,$query);
while($data = mysqli_fetch_assoc($run)){

    $classes[] = array("checklist id" => $data['checklist_id'],"class_date" => $data['class_date'],"testing_mamber" => $data['testing_mamber'],
    "monitor_by" => $data['monitor_by'],"time_slot" => $data['time_slot'],"class_id_from_lecture_list" => $data['class_id_from_lecture_list'],
"venue" => $data['venue'],"venue" => $data['venue'],"batch" => $data['batch'],
"subject" => $data['subject'],"faculty" => $data['faculty']); 

}
// echo "<pre>";
// print_r($classes);
$classCount = count($classes);

?>

<div class="container-fluid">

  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Class On Date: <?php echo $selectedDate;?></a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body">
        <table class="table" border="1">
    <thead>
      <tr>
        <th>Class ID</th>
        <th>Testing Member</th>
        <th>Monitor Member</th>
        <th>Batch</th>
        <th>Time Slot</th>
        <th>Venue</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        <?php 
        function userNameById($userID){
            include('../database_connection.php');
            $q = "SELECT user_name FROM user WHERE user_id = '$userID'";
            $runForUserName = mysqli_query($connect,$q);
            $dataForUserName = mysqli_fetch_assoc($runForUserName);
            return $userName = $dataForUserName['user_name'];


        }
        for($cls = 0; $cls < $classCount;$cls++){?>
              <tr>
        <td><?php echo $classes[$cls]['class_id_from_lecture_list']; ?></td>
        <td><?php 
        echo userNameById($classes[$cls]['testing_mamber']); ?></td>
        <td><?php 
        echo userNameById($classes[$cls]['monitor_by']);
         ?></td>
        <td><?php 
        $batch_str = $classes[$cls]['batch'];
       $str =  str_replace(",","<br>*","$batch_str");
       echo "*".$str;
         ?></td>
        <td><?php echo $classes[$cls]['time_slot']; ?></td>
        <td><?php echo $classes[$cls]['venue']; ?></td>
        <td><a href="deleteChecklistFinal.php?checklist_id=<?php echo $classes[$cls]['checklist id'];?>" class="btn btn-danger">Delete</a></td>
      </tr>
        
        <?php

        }
        
        ?> 
      <!-- <tr>
        <td></td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><a href="deleteChecklistFinal.php" class="btn btn-danger">Delete</a></td>
      </tr> -->
    </tbody>
  </table>
        </div>
      </div>
    </div>
   
  </div> 
</div>