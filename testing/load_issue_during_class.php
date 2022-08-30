<?php 
include('testing_session.php');

?>


            <?php 
            $class_id = $_POST['class_id_from_admin'];
            $query_for_checklist_id = "SELECT checklist_id,class_id_from_lecture_list FROM checklist_record WHERE class_id_from_lecture_list='$class_id'";
            $run_query = mysqli_query($connect,$query_for_checklist_id);
            $row_query = mysqli_num_rows($run_query);
            $data = mysqli_fetch_assoc($run_query);
            //$checklist_id = $data_query['checklist_id'];
            $output = "";
            if($row_query > 0){
               $output ="
               <div class='row text-center'>
                <div class='col-12 h3 text-start'>
                  Class Id : {$data['class_id_from_lecture_list']}
                </div>
               <div class='col-12 col-md-6 my-2 text-start'>Issue Starting Time</div>
               <div class='col-12 col-md-6 my-2'><input class='form-control' type='time' id='issue_start_time'></div>
               <div class='col-12 col-md-6 my-2 text-start'>Select Issue Type</div>
               <div class='col-12 col-md-6 my-2'>
               <select class='form-control' id='select_issue_type'>
               <option>Select Any One</option>";
                $qu="SELECT * FROM issue_during_class ORDER BY issue_name ASC";
               $run_qu = mysqli_query($connect,$qu);
			   mysqli_close($connect);
                while($data_qu = mysqli_fetch_assoc($run_qu)){
                  $output.="<option value='{$data_qu['issue_id']}'>{$data_qu['issue_name']}</option>";
                }
               $output.="</select>
               </div>
               <div class='col-12 col-md-6 my-2 text-start'>Issue Detail</div>
               <div class='col-12 col-md-6 my-2'><textarea class='form-control' id='issue_detail_textarea'></textarea></div>
               <div class='col-12 col-md-6 my-2 text-start'>Issue End Time</div>
               <div class='col-12 col-md-6 my-2'><input class='form-control' type='time' id='issue_end_time' ></div>
               <br>
               <div class='col-12 my-3'>
                  <button class='update_during_class btn-primary btn button-color' data-checklist_id='{$data['checklist_id']}'>Update</button>
               </div>
            
               </div>
               ";
			   
               echo $output;
			   

            }
            

           ?>