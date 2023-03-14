<?php 
include('testing_session.php');

?>
        <?php
        $class_id = $_POST['class_id'];
        $query = "SELECT * FROM checklist_record WHERE class_id_from_lecture_list = '$class_id'";
        $run = mysqli_query($connect,$query);
        $rows = mysqli_num_rows($run);
        $data = mysqli_fetch_assoc($run);
		mysqli_close($connect);
             
        $output="";
        if($rows > 0){
            $output = "<table border='1px' cellspacing='0'>";
            $output.="<tr>
            <th>Class Id : 
            {$data['class_id_from_lecture_list']}</th>
            </tr>";
            $str_batch = $data['batch'];
            $bat = str_replace(",","<br>*","$str_batch");
            $output.="<tr>
            <th>Batch:<br> *{$bat}</th>
            <tr>";

           if($data['class_started'] == ''){
            $output.="<tr style='display:block;'>";

            }else if($data['class_started'] !== ''){

                $output.="<tr style='display:none;'>";
            }
            
            $output.="<td>Class Started at:</td>
            <td><input type='time' id='start_time' value={$data['class_started']} style='width:80%;'></td>
            <td><button class='update-btn' data-checklist_id='{$data['checklist_id']}'>Update</button></td>
        </tr>";
            if($data['class_end_at'] == ''){
                $output.="<tr style='display:block;'>";
            }else if($data['class_end_at'] !== ''){
                $output.="<tr style='display:none;'>";
            }

            $output.="<td>Class End At:</td>
            <td><input type='time' id='end_time' value={$data['class_end_at']} style='width:80%;'></td>
            <td><button class='class_end_btn' data-checklist_id='{$data['checklist_id']}'>Update</button></td>
            </tr>";
            if($data['event_post_update'] == ''){
                $output.="<tr style='display:block;'>";
            }else if($data['event_post_update'] !== ''){
                $output.="<tr style='display:none;'>";
            }
            
            $output.="<td>Event Post Update After Live class:</td>
            <td><select id='select_event_post' onclick='display_event_post_remark();' style='width:80%;'>
            <option>Select Any One</option>
            <option>Yes</option>
            <option>No</option>
            </select><textarea placeholder='Remark' rows='2' cols='38' id='event_post_remark' style='display:none; margin-top:10px;'></textarea></td>
            <td><button class='event_post_update_btn' data-checklist_id='{$data['checklist_id']}'>Update</button></td>
            </tr>";
            if($data['recorded_video_uploaded'] == ''){
                $output.="<tr style='display:block;'>";
            }else if($data['recorded_video_uploaded'] !== ''){
                $output.="<tr style='display:none;'>";

            }

            $output.="<td>Recorded Video Uploaded:</td>
            <td><select id='recorded_video_uploaded' onclick='recorded_video_update();' style='width:80%;'>
            <option>Select Any One</option>
            <option>Uploaded</option>
            <option>Not Uploaded</option>
            </select><input type='datetime-local' style='margin-top:10px; display:none;' id='recorded_video_upload_time'><textarea placeholder='Remark' rows='2' cols='38' id='recorded_video_remark' style='display:none; margin-top:10px;'>
            </textarea></td>
            <td><button class='recorded_video_uploaded-btn' data-checklist_id='{$data['checklist_id']}'>Update</button></td>
            </tr>
            </table>";
            echo $output;
			

        }else{

            echo "No record Found!!";
			

        }
?>


        