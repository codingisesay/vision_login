<?php 
include('testing_session.php');

?>
<?php 
$search_key = $_POST['search_key'];
$selected_dated = $_POST['selected_dated'];

 $q="SELECT `checklist_record`.*, `user`.`user_name` FROM `checklist_record` LEFT JOIN `user` ON
  `checklist_record`.`testing_mamber` = `user`.`user_id` WHERE user.user_name LIKE '%$search_key%' 
  AND checklist_record.class_date LIKE '%$selected_dated%'";
        $run_report = mysqli_query($connect,$q);
        $output="";
        if(mysqli_num_rows($run_report) > 0){
            $output='<table border="1px" width="100%" cellspacing="0">
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
           
            </tr>';
            while($data = mysqli_fetch_assoc($run_report)){
                $output.="<tr>
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
    

            $output.="</table>";
        }
            mysqli_close($connect);
            echo $output;
        
        
?>