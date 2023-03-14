<?php 
include('testing_session.php');

?>


            <?php 
            $class_id = $_POST['class_id_from_admin'];
            $query_for_checklist_id = "SELECT checklist_id,class_id_from_lecture_list,batch FROM checklist_record WHERE class_id_from_lecture_list='$class_id'";
            $run_query = mysqli_query($connect,$query_for_checklist_id);
            $row_query = mysqli_num_rows($run_query);
            $data = mysqli_fetch_assoc($run_query);
            //$checklist_id = $data_query['checklist_id'];
            $output = "";
            if($row_query > 0){
               $output ="
               <table border='1px' cellspacing='0'>
               <tr>
               <th colspan='2'>Class Id : 
               {$data['class_id_from_lecture_list']}</th>
               </tr>";
               $str_batch = $data['batch'];
               $bat = str_replace(",","<br>*","$str_batch");
               $output.="<tr>
               <th colspan='2'>Batch:<br> *{$bat}</th>
               </tr>
               <tr>
               <td>Issue Starting Time</td>
               <td><input type='time' id='issue_start_time'></td>
               </tr>
               <tr>
               <td>Select Issue Type</td>
               <td><select id='select_issue_type'>
               <option>Select Any One</option>";
                $qu="SELECT * FROM issue_during_class ORDER BY issue_name ASC";
               $run_qu = mysqli_query($connect,$qu);
			   mysqli_close($connect);
                while($data_qu = mysqli_fetch_assoc($run_qu)){
                  $output.="<option value='{$data_qu['issue_id']}'>{$data_qu['issue_name']}</option>";
                }
               $output.="</select></td>
               </tr>
               <tr>
               <td>Issue Detail</td>
               <td><textarea id='issue_detail_textarea'></textarea></td>
               </tr>
               <tr>
               <td>Issue End Time</td>
               <td><input type='time' id='issue_end_time' ></td>
               </tr>
               <tr>
               <td>Live class Stop?</td>
               <td>
               <select id='live_class_effect'>
               <option value=''>Select Any One</option>
               <option value='Yes'>Yes</option>
               <option value='No'>No</option>
               
               </select>
               </td>
               </tr>
               <tr>
               <th colspan='2'><button class='update_during_class' data-checklist_id='{$data['checklist_id']}'>Update</button></th>
               </tr>
            
               </table>
               ";
			   
               echo $output;
			   

            }
            

           ?>