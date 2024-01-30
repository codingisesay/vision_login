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

<head>
   
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php 
include('attendance_function.php');
include('attendance_navbar.php');

$today = date("Y-m-d");
//$today = '2023-05-18';
$run_for_today_class = load_all_checklist_date($today);
while($data_for_today_class = mysqli_fetch_assoc($run_for_today_class)){

    $today_class[] = array("checklist Id" => $data_for_today_class['checklist_id'],"class date" => $data_for_today_class['class_date'],
"class id" => $data_for_today_class['class_id_from_lecture_list'],"Coordinator Name" => $data_for_today_class['batch_coordinator'],"Batch" => $data_for_today_class['batch'],
"subject" => $data_for_today_class['subject'],"AttAssId" => $data_for_today_class['att_ass_id'],"Attendance" => $data_for_today_class['attendance'],
"Response" => $data_for_today_class['response'],"Assignment" => $data_for_today_class['assignment']);


}
$today_class_count = count($today_class);
$run_for_user_name = fetch_user_name_by_id($user_id);
while($data_for_user_name = mysqli_fetch_assoc($run_for_user_name)){

  $userName[] = array("User Name" => $data_for_user_name['user_name']);

}
$user_count = count($userName);

//echo "<pre>";
//print_r($today_class);

?>
<form>
  <br>
<div class="container-fluid">
  <div class="row">

    <div class="col-sm-6"><input type="date" id="input_date" class="form-control" style="width:500px;display:inline; margin-right:5px;"><button type="button" id="DateSubmit" class="btn btn-info">Submit</button></div>

</div>
    
  </div>
</div>
<br>
<div class="container-fluid">
  
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Today Assignment And Attendance Record</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body"><table class="table table-bordered" id="myTable">
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
    for($total = 0; $total < $today_class_count; $total++){
      if($userName[0]['User Name'] == $today_class[$total]['Coordinator Name']){
      ?>
    
    <tr>
    <td style="display:none;"><?php echo $today_class[$total]['checklist Id'];?></td>
        <td><?php echo $today_class[$total]['class id']; ?></td>
        <td style="display:none;"><?php echo $user_id; ?></td>
        <td><?php 
            $orgDate = $today_class[$total]['class date'];  
            echo $newDate = date("d-m-Y", strtotime($orgDate));  
             
         ?></td>
        <td><?php echo $res = preg_replace('/[0-9-]+/', '', $today_class[$total]['Coordinator Name']); ?></td>
        <td><?php echo "*".str_replace(",","<br>*",$today_class[$total]['Batch']); ?></td>
        <td><?php echo $today_class[$total]['subject']; ?></td>
        <td><input type="number" class="attandance" value="<?php echo $today_class[$total]['Attendance']; ?>" ></td>
        <td><input type="number" id="response" value="<?php echo $today_class[$total]['Response']; ?>" ></td>
        <td><input type="number" id="assignment" value="<?php echo $today_class[$total]['Assignment']; ?>" ></td>
        <?php 
        if($today_class[$total]['Attendance'] == "" && $today_class[$total]['Response'] == "" && $today_class[$total]['Assignment'] == ""){?>
        
        <td><button type="button" class="insertA btn btn-primary" id="ins_btn" data-checklis_id ="<?php echo $today_class[$total]['checklist Id'];?>" data-atten="<?php echo $today_class[$total]['Attendance'];?>">Insert</button></td>
        
        <?php

        }else{?>
        
        <td><button type="button" class="updateA btn btn-primary" id="upt_btn" data-checklist_id ="<?php echo $today_class[$total]['checklist Id'];?>">Update</button></td>
        
        <?php

        }
        
        ?>
        
      
      </tr>
    
    
    <?php 

}
  }
    
    ?>
  </tbody>
  </table></div>
      </div>
    </div>
    
  </div> 
</div>
</form>
<div id="preDate">

</div>
</body>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    
    $("#myTable").on("click",".insertA",function(){
      
      var currentRow=$(this).closest("tr"); 

      var chechlistId=currentRow.find("td:eq(0)").text(); // get current row 1st TD value
         var col2=currentRow.find("td:eq(1)").text(); // get current row 2nd TD
         var userID = currentRow.find("td:eq(2)").text(); // get current row 3rd TD
         var col3=currentRow.find("td:eq(3)").text(); // get current row 4th TD
         var col4=currentRow.find("td:eq(4)").text();
         var col5=currentRow.find("td:eq(5)").text();
         var col6=currentRow.find("td:eq(6)").text();
         var atten=currentRow.find("td:eq(7) input").val();
         var response=currentRow.find("td:eq(8) input").val();
         var assignment=currentRow.find("td:eq(9) input").val();
         //var data=chechlistId+"\n"+col2+"\n"+col3+"\n"+col4+"\n"+col5+"\n"+col6+"\n"+atten+"\n"+response+"\n"+assignment;
         
         //alert(data);

         if(atten == "" || response == "" || assignment == ""){
           alert("All Inputs are Required");
         }else{
          $.ajax({
        url:"inserAttResAss.php",
        type:"POST",
        data:{chechlistId:chechlistId,userID:userID,atten:atten,response:response,assignment:assignment},
        success:function(data){
          if(data == 1){

            alert("Record Inserted!!");
            location.replace("index.php");

          }else{
            alert("Record Not Inserted");
            location.replace("../index.php");
          }

        }
      })
         }


    })

    $("#myTable").on("click",".updateA",function(){
      var currentRow=$(this).closest("tr"); 

      var chechlistId=currentRow.find("td:eq(0)").text(); // get current row 1st TD value
         var col2=currentRow.find("td:eq(1)").text(); // get current row 2nd TD
         var userID = currentRow.find("td:eq(2)").text(); // get current row 3rd TD
         var col3=currentRow.find("td:eq(3)").text(); // get current row 4th TD
         var col4=currentRow.find("td:eq(4)").text();
         var col5=currentRow.find("td:eq(5)").text();
         var col6=currentRow.find("td:eq(6)").text();
         var atten=currentRow.find("td:eq(7) input").val();
         var response=currentRow.find("td:eq(8) input").val();
         var assignment=currentRow.find("td:eq(9) input").val();
         //var data=chechlistId+"\n"+col2+"\n"+col3+"\n"+col4+"\n"+col5+"\n"+col6+"\n"+atten+"\n"+response+"\n"+assignment;
         
        // alert(data);

      //console.log(chechlistId);
      //console.log(atten);
      //console.log(response);
      //console.log(assignment);
      $.ajax({
       url:"UptAttResAss.php",
        type:"POST",
        data:{chechlistId:chechlistId,userID:userID,atten:atten,response:response,assignment:assignment},
        success:function(data){
          if(data == 1){

            alert("Record Updated!!");
            location.replace("index.php");

          }else{
            alert("Record Not Updated");
            location.replace("../index.php");
          }

        }
      })

    })

    $("#DateSubmit").on("click",function(){

      var previous_date = $("#input_date").val();
      $.ajax({
        url:"loadForPreDateForm.php",
        type:"POST",
        data:{previous_date:previous_date},
        success:function(data){
        $("#preDate").html(data);
        }
      })
      //console.log(previous_date);

    })

    $(document).on("click",".pre_insert",function(){
      var currentRow=$(this).closest("tr");

      var chechlistId=currentRow.find("td:eq(0)").text(); // get current row 1st TD value
         var col2=currentRow.find("td:eq(1)").text(); // get current row 2nd TD
         var userID = currentRow.find("td:eq(2)").text(); // get current row 3rd TD
         var col3=currentRow.find("td:eq(3)").text(); // get current row 4th TD
         var col4=currentRow.find("td:eq(4)").text();
         var col5=currentRow.find("td:eq(5)").text();
         var col6=currentRow.find("td:eq(6)").text();
         var atten=currentRow.find("td:eq(7) input").val();
         var response=currentRow.find("td:eq(8) input").val();
         var assignment=currentRow.find("td:eq(9) input").val();
         //var data=chechlistId+"\n"+col2+"\n"+col3+"\n"+col4+"\n"+col5+"\n"+col6+"\n"+atten+"\n"+response+"\n"+assignment;
         
         //alert(data);
         if(atten == "" || response == "" || assignment == ""){
           alert("All Inputs are Required");
         }else{
          $.ajax({
        url:"inserAttResAss.php",
        type:"POST",
        data:{chechlistId:chechlistId,userID:userID,atten:atten,response:response,assignment:assignment},
        success:function(data){
          if(data == 1){

            alert("Record Inserted!!");
            location.replace("index.php");

          }else{
            alert("Record Not Inserted");
            location.replace("../index.php");
          }

        }
      })
         }


    })

    $(document).on("click",".pre_update",function(){
      var currentRow=$(this).closest("tr"); 

      var chechlistId=currentRow.find("td:eq(0)").text(); // get current row 1st TD value
         var col2=currentRow.find("td:eq(1)").text(); // get current row 2nd TD
         var userID = currentRow.find("td:eq(2)").text(); // get current row 3rd TD
         var col3=currentRow.find("td:eq(3)").text(); // get current row 4th TD
         var col4=currentRow.find("td:eq(4)").text();
         var col5=currentRow.find("td:eq(5)").text();
         var col6=currentRow.find("td:eq(6)").text();
         var atten=currentRow.find("td:eq(7) input").val();
         var response=currentRow.find("td:eq(8) input").val();
         var assignment=currentRow.find("td:eq(9) input").val();
         //var data=chechlistId+"\n"+col2+"\n"+col3+"\n"+col4+"\n"+col5+"\n"+col6+"\n"+atten+"\n"+response+"\n"+assignment;
         
        //alert(data);
      $.ajax({
       url:"UptAttResAss.php",
        type:"POST",
        data:{chechlistId:chechlistId,userID:userID,atten:atten,response:response,assignment:assignment},
        success:function(data){
          if(data == 1){

            alert("Record Updated!!");
            location.replace("index.php");

          }else{
            alert("Record Not Updated");
            location.replace("../index.php");
          }

        }
      })

    })



    })


</script>