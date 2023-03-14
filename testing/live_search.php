<?php 
include('testing_session.php');
include('testing_functions.php');

?>
<?php 
date_default_timezone_set('Asia/Kolkata'); 
$current_date = date("Y-m-d");
$search_key = $_POST['search_key'];
$selected_dated = $_POST['selected_dated'];

if($selected_dated == ""){
$query = "SELECT user.user_name,checklist_record.testing_started_at,checklist_record.monitor_by,checklist_record.class_date,checklist_record.class_id_from_lecture_list, checklist_record.batch, checklist_record.time_slot,checklist_record.venue,checklist_record.checklist_type
         FROM user
         INNER JOIN checklist_record
         ON user.user_id = checklist_record.testing_mamber
         WHERE (checklist_record.class_id_from_lecture_list LIKE '%$search_key%' or user.user_name LIKE '%$search_key%' or checklist_record.venue LIKE '%$search_key%' or checklist_record.batch LIKE '%$search_key%')";
         $run = mysqli_query($connect,$query);
         $row = mysqli_num_rows($run);
         mysqli_close($connect);
         $output="";

         if($row > 0){
            $output="<table border='1' class='go_checklist_table' style='position: relative; left:5%;'>
            <tr>
                <th>Class ID</th>
                <th>Date</th>
                <th>Testing Person</th>
                <th>Monitor By</th>
                <th>Testing Type</th>
                <th>Batch</th>
                <th>Time Slot</th>
                <th>Venue</th>
                <th>Checklist Form</th>
                <th>Edit Form</th>
            </tr>";
            while($data = mysqli_fetch_assoc($run)){
            $output .= "<tr>
            <td>{$data['class_id_from_lecture_list']}</td>";
            $date = $data['class_date']; 
            $newDate = date("d/m/Y", strtotime($date));
            $output.="<td>{$newDate}</td>
            <td>{$data['user_name']}</td>";
            $monitor_name = fetch_user_name_by_id($data['monitor_by']);
            $output.="<td>{$monitor_name}</td>



            <td>{$data['checklist_type']}</td>";
            $str_batch = $data['batch']; 
            $str = str_replace(",","<br>*","$str_batch");

           $output.="<td>*{$str}</td>
            <td>{$data['time_slot']}</td>
            <td>{$data['venue']}</td>
           ";

            if($data['testing_started_at'] == ""){
                $output.="<td><a href='checklist_form.php?class_id={$data['class_id_from_lecture_list']}&checklist_type={$data['checklist_type']}' style='color:white; text-decoration: none;'><button class='checklist_form_button'>Checklist Form</button><a/></td></td>";
            }else{
                $output.="<td><a href='update_checklist.php?class_id={$data['class_id_from_lecture_list']}' style='color:white; text-decoration: none;'><button class='update_btn'>Update Form</button><a/></td>";
            }
            $output.="<td><a href='edit_checklist.php?class_id={$data['class_id_from_lecture_list']}&checklist_type={$data['checklist_type']}' style='color:white; text-decoration: none;'><button class='edit_btn'>Edit</button><a/></td>";



            $output.="</tr>";

            }


         }else{
            $output.="<table border='1' class='go_checklist_table' style='position: relative; left:5%;'>
            <tr>
                <th>Class ID</th>
                <th>Date</th>
                <th>Testing Type</th>
                <th>Batch</th>
                <th>Time Slot</th>
                <th>Venue</th>
                <th>Checklist Form</th>
            </tr>
            <tr>
            <td>No Class Assigned Yet</td>
            </tr>
            ";

         }

         echo $output;

     }else if($selected_dated != ""){

     	//$newDate = date("Y-m-d", strtotime($selected_dated)); 

      $query = "SELECT user.user_name,checklist_record.testing_started_at,checklist_record.monitor_by,checklist_record.monitor_by,checklist_record.class_date,checklist_record.class_id_from_lecture_list, checklist_record.batch, checklist_record.time_slot,checklist_record.venue,checklist_record.checklist_type
         FROM user
         INNER JOIN checklist_record
         ON user.user_id = checklist_record.testing_mamber
         WHERE (checklist_record.class_id_from_lecture_list LIKE '%$search_key%' or user.user_name LIKE '%$search_key%' or checklist_record.venue LIKE '%$search_key%' or checklist_record.batch LIKE '%$search_key%') AND checklist_record.class_date LIKE '%$selected_dated%'";
         $run = mysqli_query($connect,$query);
         $row = mysqli_num_rows($run);
         mysqli_close($connect);
         $output="";

         if($row > 0){
            $output="<table border='1' class='go_checklist_table' style='position: relative; left:5%;'>
            <tr>
                <th>Class ID</th>
                <th>Date</th>
                <th>Testing Person</th>
                <th>Monitor By</th>
                <th>Testing Type</th>
                <th>Batch</th>
                <th>Time Slot</th>
                <th>Venue</th>
                <th>Checklist Form</th>
                <th>Edit Form</th>
            </tr>";
            while($data = mysqli_fetch_assoc($run)){
            $output .= "<tr>
            <td>{$data['class_id_from_lecture_list']}</td>";
            $date = $data['class_date']; 
            $newDate = date("d/m/Y", strtotime($date));
            $output.="<td>{$newDate}</td>
            <td>{$data['user_name']}</td>";
            $monitor_name = fetch_user_name_by_id($data['monitor_by']);
            $output.="<td>{$monitor_name}</td>


            <td>{$data['checklist_type']}</td>";
            $str_batch = $data['batch']; 
            $str = str_replace(",","<br>*","$str_batch");

           $output.="<td>*{$str}</td>
            <td>{$data['time_slot']}</td>
            <td>{$data['venue']}</td>
           ";

            if($data['testing_started_at'] == ""){
                $output.="<td><a href='checklist_form.php?class_id={$data['class_id_from_lecture_list']}&checklist_type={$data['checklist_type']}' style='color:white; text-decoration: none;'><button class='checklist_form_button'>Checklist Form</button><a/></td></td>";
            }else{
                $output.="<td><a href='update_checklist.php?class_id={$data['class_id_from_lecture_list']}' style='color:white; text-decoration: none;'><button class='update_btn'>Update Form</button><a/></td>";
            }
            $output.="<td><a href='edit_checklist.php?class_id={$data['class_id_from_lecture_list']}&checklist_type={$data['checklist_type']}' style='color:white; text-decoration: none;'><button class='edit_btn'>Edit</button><a/></td>";



            $output.="</tr>";

            }


         }else{
            $output.="<table border='1' class='go_checklist_table' style='position: relative; left:5%;'>
            <tr>
                <th>Class ID</th>
                <th>Date</th>
                <th>Testing Type</th>
                <th>Batch</th>
                <th>Time Slot</th>
                <th>Venue</th>
                <th>Checklist Form</th>
            </tr>
            <tr>
            <td>No Class Assigned Yet</td>
            </tr>
            ";

         }

         echo $output;


     }

?>