<?php 
include('testing_session.php');
include('testing_functions.php');

?>
<?php 

   date_default_timezone_set('Asia/Kolkata'); 
    $date = date("Y-m-d");

    $query_for_user_role = "SELECT user_role FROM user WHERE user_id = '$user_id'";
    $run_for_user_role = mysqli_query($connect,$query_for_user_role);
    $data__for_user_role = mysqli_fetch_assoc($run_for_user_role);

    $user_role = $data__for_user_role['user_role'];
    
    if($user_role == 1 || $user_role == 2 ){
     $q="SELECT user.user_name, checklist_record.checklist_id,checklist_record.monitor_by,checklist_record.testing_started_at,checklist_record.class_date,checklist_record.class_id_from_lecture_list, checklist_record.batch, checklist_record.time_slot,checklist_record.venue,checklist_record.checklist_type
         FROM user
         INNER JOIN checklist_record
         ON user.user_id = checklist_record.testing_mamber
         WHERE (user.user_id = '$user_id' OR checklist_record.monitor_by = '$user_id') AND checklist_record.class_date = '$date' ORDER BY checklist_id ASC";
         $run = mysqli_query($connect,$q);
         $row = mysqli_num_rows($run);
		 //mysqli_close($connect);
         while($data = mysqli_fetch_assoc($run)){
            $testing_data[] = array("checklist id"=>$data['checklist_id'],"Class ID" => $data['class_id_from_lecture_list'],"Date" => $data['class_date'],"Testing Person" => $data['user_name'],
        "Monitor By" => fetch_user_name_by_id($data['monitor_by']),"Testing Type" => $data['checklist_type'],"Batch" => $data['batch'],"Time Slot" => $data['time_slot'],"Venue" => $data['venue'],"class started" => $data['testing_started_at']);
         }

         $testing_data_count = count($testing_data);

         $time_slot_array = array("09 am - 12 pm","01 pm - 04 pm","05 pm - 08 pm");

         $count_time_slot_array = count($time_slot_array);

         if($row > 0){
            for($slt = 0; $slt < $count_time_slot_array; $slt++){?>
                   <div class="container-fluid">
         
         <div class="panel-group" id="accordion">
           <div class="panel panel-default">
             <div class="panel-heading">
               <h4 class="panel-title">
                 <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $slt; ?>">Time Slot : (<?php echo $time_slot_array[$slt]; ?>)</a>
               </h4>
             </div>
             <div id="collapse<?php echo $slt; ?>" class="panel-collapse collapse in">
               <div class="panel-body">
               <table class="table table-striped">
      <thead class="table_heading">
        <tr>
          <td>Class ID</td>
          <td>Date</td>
          <td>Testing Person</td>
          <td>Monitor By</td>
          <td>Testing Type</td>
          <td>Batch</td>
          <td>Time Slot</td>
          <td>Venue</td>
          <td>Checklist Form</td>
          <td style="display:none">Edit Form</td>
        </tr>
        </thead>
        <?php 
        for($cls_data = 0; $cls_data < $testing_data_count; $cls_data++){
            if($time_slot_array[$slt] == $testing_data[$cls_data]['Time Slot']){?>
        <tbody>
          <td><?php echo $testing_data[$cls_data]['Class ID']; ?></td>
          <td><?php echo $testing_data[$cls_data]['Date']; ?></td>
          <td><?php echo $testing_data[$cls_data]['Testing Person']; ?></td>
          <td><?php echo $testing_data[$cls_data]['Monitor By']; ?></td>
          <td><?php echo $testing_data[$cls_data]['Testing Type']; ?></td>
          <?php 
          $batch_str = $testing_data[$cls_data]['Batch'];
          $str = str_replace(",","<br>*","$batch_str");
          ?>
          <td>*<?php echo $str; ?></td>
          <td><?php echo $testing_data[$cls_data]['Time Slot']; ?></td>
          <td><?php echo $testing_data[$cls_data]['Venue']; ?></td>
          <?php
          if($testing_data[$cls_data]['class started'] == ""){?>
           <td><a href="checklist_form.php?checklist_id=<?php echo $testing_data[$cls_data]['checklist id'];?>&checklist_type=<?php echo $testing_data[$cls_data]['Testing Type'];?>"><button class="btn btn-primary">Checklist Form</button></a></td>
          <?php

          }else{?>
          <td><a href='update_checklist.php?class_id=<?php echo $testing_data[$cls_data]['Class ID'];?>'><button class="btn btn-success">Update Form</button><a/></td>
          <?php

          }
         
          
          ?>
          

        </tbody>
        
            
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


            }?>
       
            
            <?php
            }else{?>
                <table class="table table-striped">
                    <thead class="table_heading">
                      <tr>
                        <td>Class ID</td>
                        <td>Date</td>
                        <td>Testing Person</td>
                        <td>Monitor By</td>
                        <td>Testing Type</td>
                        <td>Batch</td>
                        <td>Time Slot</td>
                        <td>Venue</td>
                        <td>Checklist Form</td>
                        <td style="display:none">Edit Form</td>
                      </tr>
                      </thead>
                      <tbody>
                        <td colspan="9">No Class Assigned</td>
                      </tbody>
                <?php
                    
                }
        }elseif($user_role == 3){
            $q="SELECT user.user_name, checklist_record.checklist_id,checklist_record.monitor_by,checklist_record.testing_started_at,checklist_record.class_date,checklist_record.class_id_from_lecture_list, checklist_record.batch, checklist_record.time_slot,checklist_record.venue,checklist_record.checklist_type
            FROM user
            INNER JOIN checklist_record
            ON user.user_id = checklist_record.testing_mamber
            WHERE checklist_record.class_date = '$date' ORDER BY checklist_id ASC";
            $run = mysqli_query($connect,$q);
            $row = mysqli_num_rows($run);
            //mysqli_close($connect);
            while($data = mysqli_fetch_assoc($run)){
               $testing_data[] = array("checklist id"=>$data['checklist_id'],"Class ID" => $data['class_id_from_lecture_list'],"Date" => $data['class_date'],"Testing Person" => $data['user_name'],
           "Monitor By" => fetch_user_name_by_id($data['monitor_by']),"Testing Type" => $data['checklist_type'],"Batch" => $data['batch'],"Time Slot" => $data['time_slot'],"Venue" => $data['venue'],"class started" => $data['testing_started_at']);
            }
            $testing_data_count = count($testing_data);

            $time_slot_array = array("09 am - 12 pm","01 pm - 04 pm","05 pm - 08 pm");
   
            $count_time_slot_array = count($time_slot_array);
   
            if($row > 0){
               for($slt = 0; $slt < $count_time_slot_array; $slt++){?>
                      <div class="container-fluid">
            
            <div class="panel-group" id="accordion">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $slt; ?>">Time Slot : (<?php echo $time_slot_array[$slt]; ?>)</a>
                  </h4>
                </div>
                <div id="collapse<?php echo $slt; ?>" class="panel-collapse collapse in">
                  <div class="panel-body">
                  <table class="table table-striped">
         <thead class="table_heading">
           <tr>
             <td>Class ID</td>
             <td>Date</td>
             <td>Testing Person</td>
             <td>Monitor By</td>
             <td>Testing Type</td>
             <td>Batch</td>
             <td>Time Slot</td>
             <td>Venue</td>
             <td>Checklist Form</td>
             <td>Edit Form</td>
           </tr>
           </thead>
           <?php 
           for($cls_data = 0; $cls_data < $testing_data_count; $cls_data++){
               if($time_slot_array[$slt] == $testing_data[$cls_data]['Time Slot']){?>
           <tbody>
             <td><?php echo $testing_data[$cls_data]['Class ID']; ?></td>       
             <td><?php echo $testing_data[$cls_data]['Date']; ?></td>
             <td><?php echo $testing_data[$cls_data]['Testing Person']; ?></td>
             <td><?php echo $testing_data[$cls_data]['Monitor By']; ?></td>
             <td><?php echo $testing_data[$cls_data]['Testing Type']; ?></td>
             <?php 
          $batch_str = $testing_data[$cls_data]['Batch'];
          $str = str_replace(",","<br>*","$batch_str");
          ?>
          <td>*<?php echo $str; ?></td>
             <td><?php echo $testing_data[$cls_data]['Time Slot']; ?></td>
             <td><?php echo $testing_data[$cls_data]['Venue']; ?></td>
             <?php
             if($testing_data[$cls_data]['class started'] == ""){?>
              <td><a href="checklist_form.php?checklist_id=<?php echo $testing_data[$cls_data]['checklist id'];?>&checklist_type=<?php echo $testing_data[$cls_data]['Testing Type'];?>"><button class="btn btn-primary">Checklist Form</button></a></td>
             <?php
   
             }else{?>
             <td><a href='update_checklist.php?class_id=<?php echo $testing_data[$cls_data]['Class ID'];?>'><button class="btn btn-success">Update Form</button><a/></td>
             <?php
   
             }?>
             <td><a href="edit_checklist.php?checklist_id =<?php echo $testing_data[$cls_data]['checklist id'];?>&class_id=<?php echo $testing_data[$cls_data]['Class ID'];?>"><button class='edit_btn'>Edit</button></a></td>
             <?php
             
            
             
             ?>
             
   
           </tbody>
           
               
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
   
   
               }?>
          
               
               <?php
               }else{?>
                <table class="table table-striped">
                    <thead class="table_heading">
                      <tr>
                        <td>Class ID</td>
                        <td>Date</td>
                        <td>Testing Person</td>
                        <td>Monitor By</td>
                        <td>Testing Type</td>
                        <td>Batch</td>
                        <td>Time Slot</td>
                        <td>Venue</td>
                        <td>Checklist Form</td>
                        <td style="display:none">Edit Form</td>
                      </tr>
                      </thead>
                      <tbody>
                        <td colspan="9">No Class Assigned</td>
                      </tbody>
                <?php
                    
                }
        

        }
              
?>