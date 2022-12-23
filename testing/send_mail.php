<?php 
include('testing_session.php');

?>       <head>
                <style>
                    table{
            width: 100%;
    border-spacing: 0px;
    background-color: white;
}

          table th {
      border: 1px solid black;
      border-collapse: collapse;
      font-weight: bold;
      padding: 10px;
      font-size: 16px;
      background-color:#1c3961;
      color: white;
    }


      table td {
      border: 1px solid black;
      border-collapse: collapse;
      font-weight: bold;
      padding: 10px;
      font-size: 16px;
    }
                </style>
            </head>
            <?php
            $date = $_GET['date'];
            
            
            $q="SELECT `checklist_record`.*, `user`.`user_name` FROM `checklist_record` LEFT JOIN `user` ON `checklist_record`.`testing_mamber` = `user`.`user_id` WHERE checklist_record.testing_started_at LIKE '%$date%'";
            $run_report = mysqli_query($connect,$q);
            $body="";
            if(mysqli_num_rows($run_report) > 0){
                $body='<table border="1px" width="100%" cellspacing="0">
            <tr>
            <th>Class/Diss. Id</th>
            <th>Checklist Type</th>
            <th>Batch/Test Code</th>
            <th>Class</th>
            <th>Testing Person</th>
            <th>Issue During Testing</th>
            <th>No. of Interruption</th>
            <th>Time Lost</th>
            <th>Event Post Update</th>
           
            </tr>';
            while($data = mysqli_fetch_assoc($run_report)){
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

                $body.="<tr>
                <td>{$data['class_id_from_lecture_list']}</td>
                 <td>{$data['checklist_type']}</td>";
				$str_batch = $data['batch']; 
                $str = str_replace(",","<br>*","$str_batch");
                 $body.="<td>*{$str}</td>
                 <td>{$data['subject']}</td>
                 <td>{$data['user_name']}</td>
                 <td>{$data['observation_during_testing']}</td>
                 <td>{$row_remark}</td>
                 <td>{$total_time_lost} Mins</td>
                 <td>{$data['event_post_update']}</td>";
            }
			mysqli_close($connect);
            echo $body.="</table>";
			$newDate = date("d/m/Y", strtotime($date));  
            $send_mail_to = "akash.vision@gmail.com";
            $mail_subject = "Live Streaming Report On"."-"."<b>".$newDate."</b>";
            //$send_mail_from = "akashsngh681681@gmail.com";
			$headers = [
			"MIME-Version: 1.0",
			"Content-type:text/html; charset=utf-8",
			"FROM:xyz@gmail.com",
			"Cc:xyz@gmail.com",
			"Bcc:xyz@gmail.com"
			
			];
			$headers = impload("\r\n",$headers);
			
			
            if(mail($send_mail_to, $mail_subject, $body, $headers)){?>
			<script>
			
			alert("Mail Sent Successfully");
			
			</script>
			
			<?php
				
			}else{?>
			<script>
			
			alert("Mail Not Send");
			
			</script>
			
			<?php
				
			}
            }

            ?>

            </body>