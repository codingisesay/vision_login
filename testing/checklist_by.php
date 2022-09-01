<?php 
include('testing_session.php');

?>
<?php      $from_date = $_POST['from_date']." "."00:00:00";
           $to_date = $_POST['to_date']." "."23:59:59";
           $select_catogray = $_POST['select_catogray'];
           $load_data = $_POST['load_data'];
           //$venue_name_data = $_POST['venue_name_data'];

            if($select_catogray == "batch" OR $select_catogray == "venue"){

                $q="SELECT `checklist_record`.*, `user`.`user_name` FROM `checklist_record` LEFT JOIN `user` ON `checklist_record`.`testing_mamber` = `user`.`user_id` WHERE checklist_record.testing_started_at >= '$from_date' && checklist_record.testing_started_at <= '$to_date' && $select_catogray LIKE '%$load_data%'";

                $run_query_batch = mysqli_query($connect,$q);
                $output="";
                if(mysqli_num_rows($run_query_batch) > 0){
                    $output ='<table id="example" class="table table-striped table-bordered nowrap" style="width:100%" border="1">
                    <tr>
            <th>Class/Diss. Id</th>
			<th>Date</th>
            <th>Checklist Type</th>
            <th>Batch/Test Code</th>
           
			<th>Venue</th>
            
            
            <th>No. of Interruption</th>
            <th>Time Lost</th>
            <th>Check Full Detail</th>
           
            </tr>';
               
            while($data = mysqli_fetch_assoc($run_query_batch)){
                $checklist_id = $data['checklist_id'];
                $qury="SELECT * FROM issue_during_testing_remark WHERE checklist_id = '$checklist_id'";
                $run_remark = mysqli_query($connect,$qury);
                $row_remark = mysqli_num_rows($run_remark);
                
                $total_time_lost = 0;
                 for($i=1; $i <= $row_remark; $i++){
                    $issue_data = mysqli_fetch_assoc($run_remark);
                    //x += y
                    
                $total_time_lost += $issue_data['time_lost_during_class'];
				
                }
                $output.="<tr>
                <td>{$data['class_id_from_lecture_list']}</td>";
				$date = $data['class_date'];
                $newDate = date("d/m/Y", strtotime($date)); 
				$output.="<td>{$newDate}</td>
                 <td>{$data['checklist_type']}</td>";
                 $str_batch = $data['batch'];
                 $str = str_replace(",","<br>*","$str_batch");

                 $output.="<td>*{$str}</td>
                 <td>{$data['venue']}</td>
                 
                 
                 <td>{$row_remark}</td>
                 <td>{$total_time_lost} Mins</td>
                
                 <td><button class='view_detail_checklist' data-class_id='{$data['class_id_from_lecture_list']}'style='padding:5px;background-color:#1c3961; color:white;'>View</button></td>
               
                </tr>";
            }
            $output.="</table>";
            $output.="<a href='download_checklist_report.php?from_date={$from_date}&to_date={$to_date}&select_catogray={$select_catogray}&load_data={$load_data}'><button style='width:100%; padding:5px; background-color: #1c3961;color: white;font-weight: bold;
                border: none; margin:5px;'>Download Excel</button></a>";
           mysqli_close($connect);
            echo $output;
			
        }else{
    mysqli_close($connect);
    echo"Record Not Found";
	
    
}
}



            ?>
