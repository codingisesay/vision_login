<?php 
include('../database_connection.php');
$todayDate = date("Y-m-d"); 

// $todayDate = '2023-10-19';

$query = "SELECT checklist_record.checklist_id,checklist_record.class_date,checklist_record.class_id_from_lecture_list,
checklist_record.batch_coordinator,checklist_record.time_slot,checklist_record.checklist_type,checklist_record.faculty,checklist_record.venue,checklist_record.batch,checklist_record.subject,
    attendance_assignment_record.att_ass_id,attendance_assignment_record.attendance,
    attendance_assignment_record.response,attendance_assignment_record.assignment,user.user_mail_id
    FROM checklist_record LEFT JOIN attendance_assignment_record ON checklist_record.checklist_id =  attendance_assignment_record.checklist_id 
    LEFT JOIN user ON checklist_record.batch_coordinator = user.user_name WHERE checklist_record.class_date = '$todayDate'
    AND (checklist_record.checklist_type = 'Class' OR checklist_record.checklist_type = 'Offline')";

$run_for_today_class = mysqli_query($connect,$query);


    while($data_for_today_class = mysqli_fetch_assoc($run_for_today_class)){

        $today_class[] = array("checklist Id" => $data_for_today_class['checklist_id'],"checklist_type" => $data_for_today_class['checklist_type'], "class date" => $data_for_today_class['class_date'],
    "class id" => $data_for_today_class['class_id_from_lecture_list'],"Coordinator Name" => $data_for_today_class['batch_coordinator'],"Batch" => $data_for_today_class['batch'],
    "subject" => $data_for_today_class['subject'],"Batch Coo MailID" =>$data_for_today_class['user_mail_id'],"AttAssId" => $data_for_today_class['att_ass_id'],"Attendance" => $data_for_today_class['attendance'],
    "Response" => $data_for_today_class['response'],"Assignment" => $data_for_today_class['assignment']);
    
    
    }

$totalClassCount = count($today_class);


for($totalClassouter = 0; $totalClassouter < $totalClassCount; $totalClassouter++){
 if($today_class[$totalClassouter]['Attendance'] == "" && $today_class[$totalClassouter]['Coordinator Name'] != ""){

    $notFilledAttandance[] = array("checklist Id" => $today_class[$totalClassouter]['checklist Id'],"checklist_type" => $today_class[$totalClassouter]['checklist_type'],
    "class date" => $today_class[$totalClassouter]['class date'],
    "class id" => $today_class[$totalClassouter]['class id'],"Coordinator Name" => $today_class[$totalClassouter]['Coordinator Name'],
    "Batch" => $today_class[$totalClassouter]['Batch'],
    "subject" => $today_class[$totalClassouter]['subject'],"Batch Coo MailID" => $today_class[$totalClassouter]['Batch Coo MailID'],
    "AttAssId" => $today_class[$totalClassouter]['AttAssId'],
    "Attendance" => $today_class[$totalClassouter]['Attendance'],
    "Response" => $today_class[$totalClassouter]['Response'],"Assignment" => $today_class[$totalClassouter]['Assignment']);

 }

}

$mailcount = count($notFilledAttandance);
for($mail = 0; $mail < $mailcount; $mail++){
    $mailID = trim($notFilledAttandance[$mail]['Batch Coo MailID'],"");
   $to ="$mailID";
   $subject = "Filling Attendance Details";

   $userName = preg_replace('/[0-9-]+/', '', $notFilledAttandance[$mail]['Coordinator Name']);

   $message ="Dear $userName, Today you have attend ".$notFilledAttandance[$mail]['Batch']." Please fill today Batch Attendance";
      $header = [
        "MIME-Version: 1.0",
        "Content-type: text/plain; charset=utf-8",
        "From : classtechsupport@visionias.in",
        "Cc : pushpak.roy@visionias.in,ksdwivedi@visionias.in",
        "Bcc : akash.visionias@gmail.com"
      ];

     $header = implode("\r\n",$header);

   

    if(mail($to,$subject,$message,$header)){

        echo "Mail Sent";

    }else{

        echo "Mail Not Sent";

    }

}

?>