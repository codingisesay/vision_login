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
            $output = "<div class='load-update'>";
            $output.="
            <div class='h3'>Class Id : 
            {$data['class_id_from_lecture_list']}</div>";

           if($data['class_started'] == ''){
            $output.="<div class='row' style='display:block;'>";

            }else if($data['class_started'] !== ''){

                $output.="<div class='row' style='display:none;'>";
            }
            
            $output.="<div class='col-12 col-md-6 my-2'>Class Started at:</div>
            <div class='col-12 col-md-6 my-2'><input class='form-control' type='time' id='start_time' value={$data['class_started']} style='width:80%;'></div>
            <div class='col-12 my-2'><button class='update-btn btn btn-primary button-color' data-checklist_id='{$data['checklist_id']}'>Update</button></div>
            </div>";
            if($data['class_end_at'] == ''){
                $output.="<div class='row' style='display:block;'>";
            }else if($data['class_end_at'] !== ''){
                $output.="<div class='row' style='display:none;'>";
            }

            $output.="<div class='col-12 col-md-6 my-2'>Class End At:</div>
            <div class='col-12 col-md-6 my-2'><input type='time' class='form-control' id='end_time' value={$data['class_end_at']} style='width:80%;'></div>
            <div class='col-12 my-2'><button class='class_end_btn btn btn-primary button-color' data-checklist_id='{$data['checklist_id']}'>Update</button></div>
            </div>";
            if($data['event_post_update'] == ''){
                $output.="<div class='row' style='display:block;'>";
            }else if($data['event_post_update'] !== ''){
                $output.="<div class='row' style='display:none;'>";
            }
            
            $output.="<div class='col-12 col-md-6 my-2'>Event Post Update After Live class:</div>
            <div class='col-12 col-md-6 my-2'><select class='form-control' id='select_event_post' onclick='display_event_post_remark();' style='width:80%;'>
            <option>Select Any One</option>
            <option>Yes</option>
            <option>No</option>
            </select><textarea placeholder='Remark' rows='2' cols='38' class='form-control' id='event_post_remark' style='display:none; margin-top:10px;'></textarea></div>
            <div class='col-12 my-2'><button class='event_post_update_btn btn btn-primary button-color' data-checklist_id='{$data['checklist_id']}'>Update</button></div>
            </div>";
            if($data['recorded_video_uploaded'] == ''){
                $output.="<div class='row' style='display:block;'>";
            }else if($data['recorded_video_uploaded'] !== ''){
                $output.="<div class='row' style='display:none;'>";

            }

            $output.="<div class='col-12 col-md-6 my-2'>Recorded Video Uploaded:</div>
            <div class='col-12 col-md-6 my-2'><select id='recorded_video_uploaded' class='form-control' onclick='recorded_video_update();' style='width:80%;'>
            <option>Select Any One</option>
            <option>Uploaded</option>
            <option>Not Uploaded</option>
            </select><input type='datetime-local' class='form-control' style='margin-top:10px; display:none;' id='recorded_video_upload_time'><textarea class='form-control' placeholder='Remark' rows='2' cols='38' id='recorded_video_remark' style='display:none; margin-top:10px;'>
            </textarea></div>
            <div class='col-12 my-2'><button class='recorded_video_uploaded-btn btn btn-primary button-color' data-checklist_id='{$data['checklist_id']}'>Update</button></div>
            </div>
            </div>";
            echo $output;
			

        }else{

            echo "No record Found!!";
			

        }
?>


        