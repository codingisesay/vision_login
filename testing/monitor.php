<?php 

include('testing_session.php');
include('testing_functions.php');
?>
<head>
                    <link rel="stylesheet" href="css/monitor.css">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

               <body>

                <?php include('testing_navbar.php'); ?>
                <?php 
                include('../database_connection.php');
                $current_date = date("Y-m-d");
                //$current_date = "2022-08-20";
                $new_date_format = date("d-m-Y", strtotime($current_date));
                //$query="SELECT * FROM checklist_record WHERE class_date = '$current_date'";
                $query = "SELECT checklist_record.*,user.user_name from checklist_record LEFT JOIN user on checklist_record.testing_mamber = user.user_id
                 WHERE checklist_record.class_date = '$current_date'";
                $run = mysqli_query($connect,$query);
                $row = mysqli_num_rows($run);
                 while($data = mysqli_fetch_assoc($run)){

            $date_class[] = array("Class Id" =>$data['class_id_from_lecture_list'],"Date"=>$data['class_date'],"Checklist Type" => $data['checklist_type'],
            "Venue" => $data['venue'],"Batch" => $data['batch'],"Testing Strated" => $data['testing_started_at'],"Time Slot" =>$data['time_slot'],"class End" =>$data['class_end_at'],
            "user name" => $data['user_name'],"subject" => $data['subject'],"submit_checklist" => $data['submit_checklist_time'],"live_started_at"=>$data['live_started_at'],"Monitor_By"=>$data['monitor_by']);
           

            //$date_class[] = array($data['class_id_from_lecture_list'],$data['class_date'],$data['checklist_type'],$data['venue'],$data['batch'],$data['testing_started_at'],$data['time_slot']);

           
                 }   
                 $array_count = count($date_class);
                 $morning_count = 0;
                 $afternoon_slot = 0;
                 $eveing_slot = 0;
                 for($rw=0;$rw<$array_count;$rw++){

                    for($col=0;$col<1;$col++){
 
                     if($date_class[$rw]['Time Slot'] == "09 am - 12 pm"){
                        $morning_count++;
                     }elseif($date_class[$rw]['Time Slot'] == "01 pm - 04 pm"){
                        $afternoon_slot++;
                     }elseif($date_class[$rw]['Time Slot'] == "05 pm - 08 pm"){
                        $eveing_slot++;
                     }
                    }
                }
                
        
                           
                ?>
                

<div class="container-fluid">
  <h2>Total Classes : <?php echo $row; ?> <br>Date: <?php echo $new_date_format;?></h2>

  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Morning Slot (09 am - 12 pm) (<?php echo "No of class".":".$morning_count; ?>)</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body">
            <table class="table table-striped">
                <tr id="head">
                    <td>Class ID</td>
                    <td>Testing Person</td>
                    <td>Monitor By</td>
                    <td>Batch</td>
                    <td>Subject</td>
                    <td>Venue</td>
                    <td>Live Started</td>
                    <td>Class End</td>
                </tr>
                <tr>
                    <?php 
                    
                    for($rw=0;$rw<$array_count;$rw++){

                        for($col=0;$col<1;$col++){
     
                         if($date_class[$rw]['Time Slot'] == "09 am - 12 pm"){?>
                         
                    <td><a  style="cursor: pointer; text-decoration: none;" class='view_detail_checklist' data-class_id="<?php echo $date_class[$rw]['Class Id']?>"><?php echo $date_class[$rw]['Class Id'];?></a>
                     </td>
                    <td><?php echo $date_class[$rw]['user name']; ?></td>

                    <td><?php echo fetch_user_name_by_id($date_class[$rw]['Monitor_By']);?></td>
                    <td><?php 
                    $str_batch = str_replace(",","<br>*",$date_class[$rw]['Batch']);
                    
                    echo "*".$str_batch; ?></td>
                    <td ><?php echo $date_class[$rw]['subject']; ?></td>
                    <td ><?php echo $date_class[$rw]['Venue']; ?></td>
                     <?php
                     if($date_class[$rw]['Testing Strated'] == '' && $date_class[$rw]['class End'] == ''){?>
                     <td style="background-color:red;"><?php echo $date_class[$rw]['live_started_at']; ?></td>
                    <td style="background-color:red;"><?php echo $date_class[$rw]['class End']; ?></td>
                     
                     <?php

                     }elseif($date_class[$rw]['Testing Strated'] != '' && $date_class[$rw]['class End'] == ''){?>
                     <td style="background-color:lightgreen;"><?php echo $date_class[$rw]['live_started_at']; ?></td>
                    <td style="background-color:red;"><?php echo $date_class[$rw]['class End']; ?></td>
                     
                     <?php
                        
                        
                     }elseif($date_class[$rw]['Testing Strated'] != '' && $date_class[$rw]['class End'] != ''){?>
                     <td style="background-color:red;"><?php echo $date_class[$rw]['live_started_at']; ?></td>
                    <td style="background-color:lightgreen;"><?php echo $date_class[$rw]['class End']; ?></td>
                     
                     <?php

                     }
                     
                     ?>

                    </tr>
                         <?php
     
                         }
     
                        }
     
                        
     
                      }
                    
                    
                    ?>
                    
                
                
            </table>
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Afternoon Slot (01 pm - 04 pm) (<?php echo "No of class".":".$afternoon_slot; ?>)</a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body"><table class="table table-striped">
                <tr id="head">
                <td>Class ID</td>
                    <td>Testing Person</td>
                    <td>Monitor By</td>
                    <td>Batch</td>
                    <td>Subject</td>
                    <td>Venue</td>
                    <td>Live Started</td>
                    <td>Class End</td>
                </tr>
                <tr>
                <?php 
                    
                    for($rw=0;$rw<$array_count;$rw++){

                        for($col=0;$col<1;$col++){
     
                         if($date_class[$rw]['Time Slot'] == "01 pm - 04 pm"){?>
                         
                         <td><a  style="cursor: pointer; text-decoration: none;" class='view_detail_checklist' data-class_id="<?php echo $date_class[$rw]['Class Id']?>"><?php echo $date_class[$rw]['Class Id'];?></a>
                     </td>
                    <td><?php echo $date_class[$rw]['user name']; ?></td>
                    <td><?php echo fetch_user_name_by_id($date_class[$rw]['Monitor_By']);?></td>
                    <td><?php 
                    $str_batch = str_replace(",","<br>*",$date_class[$rw]['Batch']);
                    
                    echo "*".$str_batch; ?></td>
                    <td><?php echo $date_class[$rw]['subject']; ?></td>
                    <td><?php echo $date_class[$rw]['Venue']; ?></td>
                     <?php
                     if($date_class[$rw]['Testing Strated'] == '' && $date_class[$rw]['class End'] == ''){?>
                        <td style="background-color:red;"><?php echo $date_class[$rw]['live_started_at']; ?></td>
                       <td style="background-color:red;"><?php echo $date_class[$rw]['class End']; ?></td>
                        
                        <?php
   
                        }elseif($date_class[$rw]['Testing Strated'] != '' && $date_class[$rw]['class End'] == ''){?>
                        <td style="background-color:lightgreen;"><?php echo $date_class[$rw]['live_started_at']; ?></td>
                       <td style="background-color:red;"><?php echo $date_class[$rw]['class End']; ?></td>
                        
                        <?php
                           
                           
                        }elseif($date_class[$rw]['Testing Strated'] != '' && $date_class[$rw]['class End'] != ''){?>
                        <td style="background-color:red;"><?php echo $date_class[$rw]['live_started_at']; ?></td>
                       <td style="background-color:lightgreen;"><?php echo $date_class[$rw]['class End']; ?></td>
                     
                     <?php

                     }
                     
                     ?>

                    </tr>
                         <?php
     
                         }
     
                        }
     
                        
     
                      }
                    
                    
                    ?>
                    
                
                
            </table>
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Evening Slot (05 pm - 08 pm) (<?php echo "No of class".":".$eveing_slot; ?>)</a>
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body"><table class="table table-striped">
                <tr id="head">
                <td>Class ID</td>
                    <td>Testing Person</td>
                    <td>Monitor By</td>
                    <td>Batch</td>
                    <td>Subject</td>
                    <td>Venue</td>
                    <td>Live Started</td>
                    <td>Class End</td>
                </tr>
                <tr>
                <?php 
                    
                    for($rw=0;$rw<$array_count;$rw++){

                        for($col=0;$col<1;$col++){
     
                         if($date_class[$rw]['Time Slot'] == "05 pm - 08 pm"){?>
                         
                         <td><a  style="cursor: pointer; text-decoration: none;" class='view_detail_checklist' data-class_id="<?php echo $date_class[$rw]['Class Id']?>"><?php echo $date_class[$rw]['Class Id'];?></a>
                     </td>
                    <td><?php echo $date_class[$rw]['user name']; ?></td>
                    <td><?php echo fetch_user_name_by_id($date_class[$rw]['Monitor_By']);?></td>
                    <td><?php 
                    $str_batch = str_replace(",","<br>*",$date_class[$rw]['Batch']);
                    
                    echo "*".$str_batch; ?></td>
                    <td><?php echo $date_class[$rw]['subject']; ?></td>
                    <td><?php echo $date_class[$rw]['Venue']; ?></td>
                     <?php
                     if($date_class[$rw]['Testing Strated'] == '' && $date_class[$rw]['class End'] == ''){?>
                        <td style="background-color:red;"><?php echo $date_class[$rw]['live_started_at']; ?></td>
                       <td style="background-color:red;"><?php echo $date_class[$rw]['class End']; ?></td>
                        
                        <?php
   
                        }elseif($date_class[$rw]['Testing Strated'] != '' && $date_class[$rw]['class End'] == ''){?>
                        <td style="background-color:lightgreen;"><?php echo $date_class[$rw]['live_started_at']; ?></td>
                       <td style="background-color:red;"><?php echo $date_class[$rw]['class End']; ?></td>
                        
                        <?php
                           
                           
                        }elseif($date_class[$rw]['Testing Strated'] != '' && $date_class[$rw]['class End'] != ''){?>
                        <td style="background-color:red;"><?php echo $date_class[$rw]['live_started_at']; ?></td>
                       <td style="background-color:lightgreen;"><?php echo $date_class[$rw]['class End']; ?></td>
                     
                     <?php

                     }
                     
                     ?>

                    </tr>
                         <?php
     
                         }
     
                        }
     
                        
     
                      }
                    
                    
                    ?>
                    
                
                
            </table>
        </div>
      </div>
    </div>
  </div> 
</div>

<div id="model">
    <div id="model-form">
        <div id="close-btn">X</div>
        
    <table id="record_table">

    </table>



    </div>


    </div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on("click",".view_detail_checklist",function(){
            $("#model").show();
            var class_id=$(this).data("class_id");
            //console.log(class_id);
            $.ajax({
                                        url:"view_detail_checklist.php",
                                        type:"POST",
                                        data:{class_id:class_id},
                                        success:function(data){
                                            $("#model-form table").html(data);

                                            var board_remark_td = $("#board_remark_td").html();

                                            var synopsis_display_remark_td = $("#synopsis_display_remark_td").html();
                                            var remote_system_ipad_remark = $("#remote_system_ipad_remark_td").html();
              
              var camera_focus_remark = $("#camera_focus_remark_td").html();
              var camera_battery_remark = $("#camera_battery_remark_td").html();
              var remote_system_laptop = $("#remote_system_laptop_td").html();
              var batch_coordinator_convey_remark = $("#batch_coordinator_convey_remark_td").html();

              var handout_remark = $("#handout_remark_td").html();

              var next_class_update_remark = $("#next_class_update_remark_td").html();
              //console.log(next_class_update_remark);
              var testing_query_remark = $("#testing_query_remark_td").html();
              var event_post_update_remark = $("#event_post_update_remark_td").html();
              var recorded_video_uploaded_remark = $("#recorded_video_uploaded_remark_td").html();

              if(board_remark_td == ""){

              $("#board_remark_tr").css("display","none");

              }

              if(synopsis_display_remark_td == ""){
                $("#synopsis_display_remark_tr").css("display","none");

              }

               if(remote_system_ipad_remark == ""){

                    $("#remote_system_ipad_remark_tr").css("display","none");

                  }


                  if(camera_focus_remark == ""){
                    $("#camera_focus_remark_tr").hide();
                  }

                  if(camera_battery_remark == ""){
                    $("#camera_battery_remark_tr").hide();
                  }
                  if(remote_system_laptop == ""){
                    $("#remote_system_laptop_tr").hide();

                  }
                  if(batch_coordinator_convey_remark == ""){
                    $("#batch_coordinator_convey_remark_tr").hide();
                  }


                   if(handout_remark == ""){
                    $("#handout_remark_tr").hide();
                }

                  if(next_class_update_remark == ""){
                    $("#next_class_update_remark_tr").hide();
                  }
                  if(testing_query_remark == ""){
                    $("#testing_query_remark_tr").hide();
                  }
                  if(event_post_update_remark == ""){
                    $("#event_post_update_remark_tr").hide();

                  }
                  if(recorded_video_uploaded_remark == ""){
                    $("#recorded_video_uploaded_remark_tr").hide()
                  }
                          

                                            

                                        }
                                    })
            
            
            
            
        })
        $("#close-btn").on("click",function(){
                                $("#model").hide();
                })



     
    })
</script>
   
</body>


               