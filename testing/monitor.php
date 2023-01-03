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
                $query="SELECT * FROM checklist_record WHERE class_date = '$current_date'";
                $run = mysqli_query($connect,$query);
                $row = mysqli_num_rows($run);
                 while($data = mysqli_fetch_assoc($run)){

            $date_class[] = array("Class Id" =>$data['class_id_from_lecture_list'],"Date"=>$data['class_date'],"Checklist Type" => $data['checklist_type'],
            "Venue" => $data['venue'],"Batch" => $data['batch'],"Testing Strated" => $data['testing_started_at'],"Time Slot" =>$data['time_slot'],"class End" =>$data['class_end_at']);
           

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
                

<div class="container">
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
                    <td>Class_ID</td>
                    <td>Class Type</td>
                    <td>Batch</td>
                    <td>Venue</td>
                    <td>Live status</td>
                    <td>Class End</td>
                </tr>
                <tr>
                    <?php 
                    
                    for($rw=0;$rw<$array_count;$rw++){

                        for($col=0;$col<1;$col++){
     
                         if($date_class[$rw]['Time Slot'] == "09 am - 12 pm"){?>
                         
                    <td><?php echo $date_class[$rw]['Class Id']; ?></td>
                    <td><?php echo $date_class[$rw]['Checklist Type']; ?></td>
                    <td><?php 
                    $str_batch = str_replace(",","<br>*",$date_class[$rw]['Batch']);
                    
                    echo "*".$str_batch; ?></td>
                    <td><?php echo $date_class[$rw]['Venue']; ?></td>
                     <?php
                     if($date_class[$rw]['Testing Strated'] == '' && $date_class[$rw]['class End'] == ''){?>
                     <td><div class="not_live_light"></div></td>
                    <td><div class="not_live_light"></div></td>
                     
                     <?php

                     }elseif($date_class[$rw]['Testing Strated'] != '' && $date_class[$rw]['class End'] == ''){?>
                     <td><div class="live_light"></div></td>
                    <td><div class="not_live_light"></div></td>
                     
                     <?php
                        
                        
                     }elseif($date_class[$rw]['Testing Strated'] != '' && $date_class[$rw]['class End'] != ''){?>
                     <td><div class="not_live_light"></div></td>
                    <td><div class="live_light"></div></td>
                     
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
                    <td>Class_ID</td>
                    <td>Class Type</td>
                    <td>Batch</td>
                    <td>Venue</td>
                    <td>Live Streaming</td>
                    <td>Class End</td>
                </tr>
                <tr>
                <?php 
                    
                    for($rw=0;$rw<$array_count;$rw++){

                        for($col=0;$col<1;$col++){
     
                         if($date_class[$rw]['Time Slot'] == "01 pm - 04 pm"){?>
                         
                    <td><?php echo $date_class[$rw]['Class Id']; ?></td>
                    <td><?php echo $date_class[$rw]['Checklist Type']; ?></td>
                    <td><?php 
                    $str_batch = str_replace(",","<br>*",$date_class[$rw]['Batch']);
                    
                    echo "*".$str_batch; ?></td>
                    <td><?php echo $date_class[$rw]['Venue']; ?></td>
                    <?php
                     if($date_class[$rw]['Testing Strated'] == '' && $date_class[$rw]['class End'] == ''){?>
                     <td><div class="not_live_light"></div></td>
                    <td><div class="not_live_light"></div></td>
                     
                     <?php

                     }elseif($date_class[$rw]['Testing Strated'] != '' && $date_class[$rw]['class End'] == ''){?>
                     <td><div class="live_light"></div></td>
                    <td><div class="not_live_light"></div></td>
                     
                     <?php
                        
                        
                     }elseif($date_class[$rw]['Testing Strated'] != '' && $date_class[$rw]['class End'] != ''){?>
                     <td><div class="not_live_light"></div></td>
                    <td><div class="live_light"></div></td>
                     
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
                    <td>Class_ID</td>
                    <td>Class Type</td>
                    <td>Batch</td>
                    <td>Venue</td>
                    <td>Live Streaming</td>
                    <td>Class End</td>
                </tr>
                <tr>
                <?php 
                    
                    for($rw=0;$rw<$array_count;$rw++){

                        for($col=0;$col<1;$col++){
     
                         if($date_class[$rw]['Time Slot'] == "05 pm - 08 pm"){?>
                         
                    <td><?php echo $date_class[$rw]['Class Id']; ?></td>
                    <td><?php echo $date_class[$rw]['Checklist Type']; ?></td>
                    <td><?php 
                    $str_batch = str_replace(",","<br>*",$date_class[$rw]['Batch']);
                    
                    echo "*".$str_batch; ?></td>
                    <td><?php echo $date_class[$rw]['Venue']; ?></td>

                    <?php
                     if($date_class[$rw]['Testing Strated'] == '' && $date_class[$rw]['class End'] == ''){?>
                     <td><div class="not_live_light"></div></td>
                    <td><div class="not_live_light"></div></td>
                     
                     <?php

                     }elseif($date_class[$rw]['Testing Strated'] != '' && $date_class[$rw]['class End'] == ''){?>
                     <td><div class="live_light"></div></td>
                    <td><div class="not_live_light"></div></td>
                     
                     <?php
                        
                        
                     }elseif($date_class[$rw]['Testing Strated'] != '' && $date_class[$rw]['class End'] != ''){?>
                     <td><div class="not_live_light"></div></td>
                    <td><div class="live_light"></div></td>
                     
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
    
</body>


               