<?php 
include('testing_session.php');

?>
<?php 

   /*date_default_timezone_set('Asia/Kolkata'); 
    $date = date("Y-m-d");*/
    $date = $_POST['date'];
    $query_for_user_role = "SELECT user_role FROM user WHERE user_id = '$user_id'";
    $run_for_user_role = mysqli_query($connect,$query_for_user_role);
    $data__for_user_role = mysqli_fetch_assoc($run_for_user_role);

    $user_role = $data__for_user_role['user_role'];
    
     if($user_role == 1 || $user_role == 2 ){
     $q="SELECT user.user_name, checklist_record.checklist_id,checklist_record.testing_started_at,checklist_record.class_date,checklist_record.class_id_from_lecture_list, checklist_record.batch, checklist_record.time_slot,checklist_record.venue,checklist_record.checklist_type
         FROM user
         INNER JOIN checklist_record
         ON user.user_id = checklist_record.testing_mamber
         WHERE user.user_id = '$user_id' AND checklist_record.class_date = '$date' AND checklist_record.testing_started_at IS NOT NULL ORDER BY checklist_id ASC";
         $run = mysqli_query($connect,$q);
         $row = mysqli_num_rows($run);
         mysqli_close($connect);
         $output="";

         if($row > 0){
            $output="<table border='1' class='go_checklist_table'>
            <tr>
            <th>Class ID</th>
            <th>Date</th>
            <th>Testing Person</th>
            <th>Testing Type</th>
            <th>Batch</th>
            <th>Time Slot</th>
            <th>Venue</th>
            <th>View</th>
            <th>Download</th>
            </tr>";
            while($data = mysqli_fetch_assoc($run)){
            $output .= "<tr>
            <td>{$data['class_id_from_lecture_list']}</td>";
            $date = $data['class_date']; 
            $newDate = date("d/m/Y", strtotime($date));
            $output.="<td>{$newDate}</td>
            <td>{$data['user_name']}</td>
            <td>{$data['checklist_type']}</td>";
            $str_batch = $data['batch']; 
            $str = str_replace(",","<br>*","$str_batch");

           $output.="<td>*{$str}</td>
            <td>{$data['time_slot']}</td>
            <td>{$data['venue']}</td>
           ";

           $output.="<td><button class='view_detail_checklist' data-class_id='{$data['class_id_from_lecture_list']}'>View</button></td>";
         
           $output.="<td>
           <a href='download_excel.php?checklist_id={$data['checklist_id']}'><button>Download</button></td>";
       


            $output.="</tr>";

            }


         }else{
            $output.="<table border='1' class='go_checklist_table'>
            <tr>
            <th>Class ID</th>
            <th>Date</th>
            
            <th>Testing Type</th>
            <th>Batch</th>
            <th>Time Slot</th>
            <th>Venue</th>
            <th>View</th>
            <th>Download</th>
            </tr>
            <tr>
            <td>No Class Assigned Yet</td>
            </tr>
            ";

         }

         echo $output;

    }else if($user_role == 3){

        $q="SELECT user.user_name, checklist_record.checklist_id,checklist_record.testing_started_at,checklist_record.class_date,checklist_record.class_id_from_lecture_list, checklist_record.batch, checklist_record.time_slot,checklist_record.venue,checklist_record.checklist_type
         FROM user
         INNER JOIN checklist_record
         ON user.user_id = checklist_record.testing_mamber
         WHERE checklist_record.class_date = '$date' AND checklist_record.testing_started_at IS NOT NULL ORDER BY checklist_id ASC";
         $run = mysqli_query($connect,$q);
         $row = mysqli_num_rows($run);
         mysqli_close($connect);
         $output="";

         if($row > 0){
            $output="<table border='1' class='go_checklist_table'>
            <tr>
                <th>Class ID</th>
                <th>Date</th>
                <th>Testing Person</th>
                <th>Testing Type</th>
                <th>Batch</th>
                <th>Time Slot</th>
                <th>Venue</th>
                <th>View</th>
                <th>Download</th>
            </tr>";
            while($data = mysqli_fetch_assoc($run)){
            $output .= "<tr>
            <td>{$data['class_id_from_lecture_list']}</td>";
            $date = $data['class_date']; 
            $newDate = date("d/m/Y", strtotime($date));
            $output.="<td>{$newDate}</td>
            <td>{$data['user_name']}</td>
            <td>{$data['checklist_type']}</td>";
            $str_batch = $data['batch']; 
            $str = str_replace(",","<br>*","$str_batch");

           $output.="<td>*{$str}</td>
            <td>{$data['time_slot']}</td>
            <td>{$data['venue']}</td>
           ";

           $output.="<td><button class='view_detail_checklist' data-class_id='{$data['class_id_from_lecture_list']}'>View</button></td>";
         
                $output.="<td>
                <a href='download_excel.php?checklist_id={$data['checklist_id']}'><button>Download</button></td>";
            


            $output.="</tr>";

            }


         }else{
            $output.="<table border='1' class='go_checklist_table'>
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