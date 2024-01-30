<?php 
function AllClassInDate($today){
    include("../database_connection.php");
    $query = "SELECT checklist_record.checklist_id,checklist_record.class_date,checklist_record.class_id_from_lecture_list,
    checklist_record.batch_coordinator,checklist_record.time_slot,checklist_record.checklist_type,checklist_record.faculty,checklist_record.venue,checklist_record.batch,checklist_record.subject,
    attendance_assignment_record.att_ass_id,attendance_assignment_record.attendance,
    attendance_assignment_record.response,attendance_assignment_record.assignment 
    FROM checklist_record LEFT JOIN attendance_assignment_record 
    ON checklist_record.checklist_id =  attendance_assignment_record.checklist_id 
    WHERE checklist_record.class_date = '$today'";
    $runFordatechecklist = mysqli_query($connect,$query);
    // mysqli_close($connect);
    while($dataFordatechecklist = mysqli_fetch_assoc($runFordatechecklist)){

        $dateChecklistData[] = array("checklist id" => $dataFordatechecklist['checklist_id'],"class date"=>$dataFordatechecklist['class_date'],
        "checklist_type"=>$dataFordatechecklist['checklist_type'], "class_id_from_lecture_list"=>$dataFordatechecklist['class_id_from_lecture_list'],
        "batch_coordinator"=>$dataFordatechecklist['batch_coordinator'],"time_slot"=>$dataFordatechecklist['time_slot'],"faculty"=>$dataFordatechecklist['faculty'],
        "venue"=>$dataFordatechecklist['venue'],"batch"=>$dataFordatechecklist['batch'],"subject"=>$dataFordatechecklist['subject'],
        "att_ass_id"=>$dataFordatechecklist['att_ass_id'],"attendance"=>$dataFordatechecklist['attendance'],"response"=>$dataFordatechecklist['response'],"assignment"=>$dataFordatechecklist['assignment']);
    
    }

    return $dateChecklistData;

}

function fetchUserNameById($userId){
    include("../database_connection.php");
    $query = "SELECT * FROM user WHERE user_id = '$userId'";
    $run = mysqli_query($connect,$query);
    $data = mysqli_fetch_assoc($run);
    return $data['user_name'];

}

function classDetailsFromClassID($classID){
    include("../database_connection.php");
    $query = "SELECT checklist_record.checklist_id,checklist_record.class_date,checklist_record.class_id_from_lecture_list,
    checklist_record.batch_coordinator,checklist_record.time_slot,checklist_record.checklist_type,checklist_record.faculty,checklist_record.venue,checklist_record.batch,checklist_record.subject,
    attendance_assignment_record.att_ass_id,attendance_assignment_record.attendance,
    attendance_assignment_record.response,attendance_assignment_record.assignment 
    FROM checklist_record LEFT JOIN attendance_assignment_record 
    ON checklist_record.checklist_id =  attendance_assignment_record.checklist_id 
    WHERE checklist_record.class_id_from_lecture_list = '$classID'";
    $run = mysqli_query($connect,$query);
    while($data = mysqli_fetch_assoc($run)){

        $classDetails[] = array("checklist id" => $data['checklist_id'],"class date"=>$data['class_date'],
        "checklist_type"=>$data['checklist_type'], "class_id_from_lecture_list"=>$data['class_id_from_lecture_list'],
        "batch_coordinator"=>$data['batch_coordinator'],"time_slot"=>$data['time_slot'],"faculty"=>$data['faculty'],
        "venue"=>$data['venue'],"batch"=>$data['batch'],"subject"=>$data['subject'],
        "att_ass_id"=>$data['att_ass_id'],"attendance"=>$data['attendance'],"response"=>$data['response'],"assignment"=>$data['assignment']);

    }

    return $classDetails;


}
function insertStatus($checklist_id){
    include("../database_connection.php");
    $query = "SELECT * from academic_feedback_record WHERE checklist_id = '$checklist_id'";
    $run = mysqli_query($connect,$query);
    return mysqli_num_rows($run);
mysqli_close($connect); 
}

function fetchDataFromAcadmicData($checklist_id){
    include("../database_connection.php");
    $query = "SELECT `academic_feedback_record`.*,`academic_feedback_record_remark`.* FROM `academic_feedback_record` LEFT JOIN academic_feedback_record_remark ON academic_feedback_record.checklist_id = academic_feedback_record_remark.checklist_id WHERE academic_feedback_record.checklist_id = '$checklist_id'";
    $run = mysqli_query($connect,$query);
    while($data = mysqli_fetch_assoc($run)){

     $acadmicFeebackData[] = array("Feedback ID" => $data['academic_feedback_record_id'],"class_start_time" => $data['class_start_time'],"class_delay" => $data['class_delay'],
     "class_end_time" => $data['class_end_time'],"class_end_early" => $data['class_end_early'],"previous_class_VSASHP_uploaded" => $data['previous_class_VSASHP_uploaded'],
     "synopsis_shown_projector" => $data['synopsis_shown_projector'],"review_of_previous_class" => $data['review_of_previous_class'],"QA_related_to_previous_class" => $data['QA_related_to_previous_class'],
     "doubts_repeated_by_online_student" => $data['doubts_repeated_by_online_student'],"No_of_live_query" => $data['No_of_live_query'],"faculty_primarily_used_language" => $data['faculty_primarily_used_language'],
     "percentage_secondary_language" => $data['percentage_secondary_language'],"transition_from_one_topic_to_another" => $data['transition_from_one_topic_to_another'],"QA_related_to_class_UPSC" => $data['QA_related_to_class_UPSC'],
     "question_by_student_during_class" => $data['question_by_student_during_class'],"any_questions_not_replied_class" => $data['any_questions_not_replied_class'],"any_questions_not_replied_from_the_prompter" => $data['any_questions_not_replied_from_the_prompter'],
     "response_portal_in_the_class" => $data['response_portal_in_the_class'],"brief_review_after_completion" => $data['brief_review_after_completion'],"major_topics_covered" => $data['major_topics_covered'],
     "assignment_confirmed_with_faculty" => $data['assignment_confirmed_with_faculty'],"assignment_question_today_class" => $data['assignment_question_today_class'],"specific_issue_highlighted_by_students" => $data['specific_issue_highlighted_by_students'],
     "students_interact_with_faculty" => $data['students_interact_with_faculty'],"handout_provided" => $data['handout_provided'],"handout_provided_to_tech_team" => $data['handout_provided_to_tech_team'],
     "management_technical_issue" => $data['management_technical_issue'],"preparation_for_class" => $data['preparation_for_class'],"preparation_for_class_text" => $data['preparation_for_class_text'],
     "objective_of_class" => $data['objective_of_class'],"objective_of_class_text" => $data['objective_of_class_text'],"command_over_content" => $data['command_over_content'],
     "command_over_content_text" => $data['command_over_content_text'],"use_of_examples" => $data['use_of_examples'],"use_of_examples_text" => $data['use_of_examples_text'],
     "organization_of_content" => $data['organization_of_content'],"organization_of_content_text" => $data['organization_of_content_text'],"dictation_in_class" => $data['dictation_in_class'],
     "dictation_provided_in_big_chunks" => $data['dictation_provided_in_big_chunks'],"no_pages_dictated_in_class" => $data['no_pages_dictated_in_class'],"link_with_current_affairs" => $data['link_with_current_affairs'],
     "lecture_focussed_on" => $data['lecture_focussed_on'],"factual_errors_or_conceptual_lags" => $data['factual_errors_or_conceptual_lags'],"factual_errors_or_conceptual_lags_text" => $data['factual_errors_or_conceptual_lags_text'],
     "time_management" => $data['time_management'],"time_management_text" => $data['time_management_text'],"pace_of_the_class" => $data['pace_of_the_class'],
     "use_of_smart_board" => $data['use_of_smart_board'],"use_of_smart_board_text" => $data['use_of_smart_board_text'],"energy_level_and_communication" => $data['energy_level_and_communication'],
     "energy_level_and_communication_text" => $data['energy_level_and_communication_text'],"faculty_meet_your_expectations" => $data['faculty_meet_your_expectations'],"faculty_meet_your_expectations_text" => $data['faculty_meet_your_expectations_text'],
     "different_done_you" => $data['different_done_you'],"overall_rating_for_the_class" => $data['overall_rating_for_the_class'],"any_other_feedback" => $data['any_other_feedback'],
     "video_portion_removed" => $data['video_portion_removed'],"feedback_form_classroom_team" => $data['feedback_form_classroom_team'],"record_insert_time" => $data['record_insert_time'],
     "academic_feedback_record_remark_id" => $data['academic_feedback_record_remark_id'],"class_delay_remark" => $data['class_delay_remark'],"end_early_class_remark" => $data['end_early_class_remark'],
     "video_synopsis_uploaded_remark" => $data['video_synopsis_uploaded_remark'],"synopsis_previous_class_display_remark" => $data['synopsis_previous_class_display_remark'],"question_not_replied_by_faculty_remark" => $data['question_not_replied_by_faculty_remark'],
     "question_not_replied_by_faculty_prompter_remark" => $data['question_not_replied_by_faculty_prompter_remark'],"issue_highlight_by_student_remark" => $data['issue_highlight_by_student_remark'],"management_technical_issue_remark" => $data['management_technical_issue_remark'],
     "video_portion_need_to_cut_remark" => $data['video_portion_need_to_cut_remark'],"checklist_id" => $data['checklist_id']);
    }

    return $acadmicFeebackData;
}



?>