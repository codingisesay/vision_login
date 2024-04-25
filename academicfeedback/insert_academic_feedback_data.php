<?php 
include('../session.php');
include('academicfeedbackFunction.php');

?>
<?php 
   // $queryacademic_feedback_record = "INSERT INTO `academic_feedback_record` (`1class_start_time`, `2class_delay`, `3class_end_time`, `4class_end_early`, `5previous_class_VSASHP_uploaded`, `6synopsis_shown_projector`, `7review_of_previous_class`, `8QA_related_to_previous_class`, `9doubts_repeated_by_online_student`, `10No_of_live_query`, `11faculty_primarily_used_language`, `12percentage_secondary_language`, `13transition_from_one_topic_to_another`, `14QA_related_to_class_UPSC`, `15question_by_student_during_class`, `16any_questions_not_replied_class`, `17any_questions_not_replied_from_the_prompter`, `18response_portal_in_the_class`, `19brief_review_after_completion`, `20major_topics_covered`, `21assignment_confirmed_with_faculty`, `22assignment_question_today_class`, `23specific_issue_highlighted_by_students`, `24students_interact_with_faculty`, `25handout_provided`, `26handout_provided_to_tech_team`, `27management_technical_issue`, `28preparation_for_class`, `29preparation_for_class_text`, `30objective_of_class`, `31objective_of_class_text`, `32command_over_content`, `33command_over_content_text`, `34use_of_examples`, `35use_of_examples_text`, `36organization_of_content`, `37organization_of_content_text`, `38dictation_in_class`, `39dictation_provided_in_big_chunks`, `40no_pages_dictated_in_class`, `41linkwithcurrentaffair`, `42link_with_current_affairs`, `43lecture_focussed_on`, `44factual_errors_or_conceptual_lags`, `45factual_errors_or_conceptual_lags_text`, `46time_management`, `47time_management_text`, `48pace_of_the_class`, `49use_of_smart_board`, `50use_of_smart_board_text`, `51energy_level_and_communication`, `52energy_level_and_communication_text`, `53faculty_meet_your_expectations`, `54overall_rating_for_the_class`, `55any_other_feedback`, `56video_portion_removed`, `57feedback_form_classroom_team`, `58checklist_id`, `59insertedDateTime`)
   // VALUES ('1$ClassStartTime', '2$ResionForDelay', '3$ClassEndTime', '4$classendeatlyremark', '5$videoSynopsis', '6$synopsisPrevious', '7$briefReview', '8$QAPreviousClass', '9$doubtsRephrasedRepeated', '10$numberOfLiveQuery', '11$hanoutinclass', '12$handoutToTechteam', 13NULL, 14NULL, 15NULL, 16NULL, 17NULL, 18NULL, 19NULL, 20NULL, 21NULL, 22NULL, '23No', 24NULL, 25NULL, 26NULL, '27No', 28NULL, 29NULL, 30NULL, 31NULL, 32NULL, 33NULL, 34NULL, 35NULL, 36NULL, 37NULL, 38NULL, 39NULL, 40NULL, 41NULL, 42NULL, 43NULL, 44NULL, 45NULL, 46NULL, 47NULL, 48NULL, 49NULL, 50NULL, 51NULL, 52NULL, 53NULL, 54NULL, '55No', 56NULL, 57NULL, '58$checklist_id', 59CURRENT_TIMESTAMP)";


   // $queryRemark = "INSERT INTO `academic_feedback_record_remark` (`1class_delay_remark`, `2end_early_class_remark`, `3video_synopsis_uploaded_remark`, `4synopsis_previous_class_display_remark`, `5question_not_replied_by_faculty_remark`, `6question_not_replied_by_faculty_prompter_remark`, `7different_done_you`, `8issue_highlight_by_student_remark`, `9management_technical_issue_remark`, `10any_other_feedback_comment`, `11video_portion_need_to_cut_remark`, `12academic_feedback_record_id`, `13checklist_id`)
   // VALUES ('1$resionfordelaycomment', '2$classendeatlyremarkcomment', '3$videoSynopsiscomment', '4$synopsisPreviouscomment', 5NULL, 6NULL, 7NULL, 8NULL, 9NULL, 10NULL, 11NULL, '12$academic_feedback_record_id', '13$checklist_id')";
 $checklist_id = trim($_POST['checklistid']);
 $section = $_POST['section'];

//sestion1 variable
 $ClassStartTime = trim(mysqli_real_escape_string($connect,$_REQUEST['ClassStartTime']));
 $ResionForDelay = trim(mysqli_real_escape_string($connect,$_REQUEST['resionfordelay']));
 $ClassEndTime = trim(mysqli_real_escape_string($connect,$_REQUEST['ClassEndTime']));
 $classendeatlyremark = trim(mysqli_real_escape_string($connect,$_REQUEST['classendeatlyremark']));
 $videoSynopsis = trim(mysqli_real_escape_string($connect,$_REQUEST['videoSynopsis']));
 $synopsisPrevious = trim(mysqli_real_escape_string($connect,$_REQUEST['synopsisPrevious']));
 $briefReview = trim(mysqli_real_escape_string($connect,$_REQUEST['briefReview']));
 $QAPreviousClass = trim(mysqli_real_escape_string($connect,$_REQUEST['QAPreviousClass']));
 $doubtsRephrasedRepeated = trim(mysqli_real_escape_string($connect,$_REQUEST['doubtsRephrasedRepeated']));
 $numberOfLiveQuery = trim(mysqli_real_escape_string($connect,$_REQUEST['numberOfLiveQuery']));
 $hanoutinclass = trim(mysqli_real_escape_string($connect,$_REQUEST['hanoutinclass']));
 $handoutToTechteam = trim(mysqli_real_escape_string($connect,$_REQUEST['handoutToTechteam']));
 
 //section2 variable
 $useHindiEnglish = trim(mysqli_real_escape_string($connect,$_REQUEST['useHindiEnglish']));
 $percenatgeofSecondaryLanguage = trim(mysqli_real_escape_string($connect,$_REQUEST['percenatgeofSecondaryLanguage']));
 $transitionOfTopic = trim(mysqli_real_escape_string($connect,$_REQUEST['transitionOfTopic']));
 $QARelatedToUPSC = trim(mysqli_real_escape_string($connect,$_REQUEST['QARelatedToUPSC']));
 $questionAskedByStudent = trim(mysqli_real_escape_string($connect,$_REQUEST['questionAskedByStudent']));
 $queryNotReplied = trim(mysqli_real_escape_string($connect,$_REQUEST['queryNotReplied']));
 $QuestionPrompter = trim(mysqli_real_escape_string($connect,$_REQUEST['QuestionPrompter']));
 $responseportalinclass = trim(mysqli_real_escape_string($connect,$_REQUEST['responseportalinclass']));
 $aftercompletionofclass = trim(mysqli_real_escape_string($connect,$_REQUEST['aftercompletionofclass']));
 $majortopiccomment = trim(mysqli_real_escape_string($connect,$_REQUEST['majortopiccomment']));
 $assignmentQuestionwithfaculty = trim(mysqli_real_escape_string($connect,$_REQUEST['assignmentQuestionwithfaculty']));
 $assignmentquestioncomment = trim(mysqli_real_escape_string($connect,$_REQUEST['assignmentquestioncomment']));
 $studentinterectfaculty = trim(mysqli_real_escape_string($connect,$_REQUEST['studentinterectfaculty']));


 //section3


 $Preparationfortheclass = trim(mysqli_real_escape_string($connect,$_REQUEST['Preparationfortheclass']));
 $Preparationfortheclasscomment = trim(mysqli_real_escape_string($connect,$_REQUEST['Preparationfortheclasscomment']));
 $Objectiveofclas = trim(mysqli_real_escape_string($connect,$_REQUEST['Objectiveofclas']));
 $Objectiveofclascomment = trim(mysqli_real_escape_string($connect,$_REQUEST['Objectiveofclascomment']));
 $Commandoverthecontent = trim(mysqli_real_escape_string($connect,$_REQUEST['Commandoverthecontent']));
 $Commandoverthecontentcomment = trim(mysqli_real_escape_string($connect,$_REQUEST['Commandoverthecontentcomment']));
 $UseofExamples = trim(mysqli_real_escape_string($connect,$_REQUEST['UseofExamples']));
 $UseofExamplescomment = trim(mysqli_real_escape_string($connect,$_REQUEST['UseofExamplescomment']));
 $Organizationofcontent = trim(mysqli_real_escape_string($connect,$_REQUEST['Organizationofcontent']));
 $Organizationofcontentcomment = trim(mysqli_real_escape_string($connect,$_REQUEST['Organizationofcontentcomment']));
 $dictationinclass = trim(mysqli_real_escape_string($connect,$_REQUEST['dictationinclass']));
 $dictationinclasschunk = trim(mysqli_real_escape_string($connect,$_REQUEST['dictationinclasschunk']));
 $Approximatelypages = trim(mysqli_real_escape_string($connect,$_REQUEST['Approximatelypages']));
 $linkwithcurrentaffair = trim(mysqli_real_escape_string($connect,$_REQUEST['linkwithcurrentaffair']));
 $LinkwithCurrentAffairsrating = trim(mysqli_real_escape_string($connect,$_REQUEST['LinkwithCurrentAffairsrating']));
 $lectureFocussed = trim(mysqli_real_escape_string($connect,$_REQUEST['lectureFocussed']));
 $Factualerrors = trim(mysqli_real_escape_string($connect,$_REQUEST['Factualerrors']));
 $Factualerrorscomment = trim(mysqli_real_escape_string($connect,$_REQUEST['Factualerrorscomment']));
 $TimeManagement = trim(mysqli_real_escape_string($connect,$_REQUEST['TimeManagement']));
 $TimeManagementcomment = trim(mysqli_real_escape_string($connect,$_REQUEST['TimeManagementcomment']));
 $Paceoftheclas = trim(mysqli_real_escape_string($connect,$_REQUEST['Paceoftheclas']));
 $UseofSmartBoard = trim(mysqli_real_escape_string($connect,$_REQUEST['UseofSmartBoard']));
 $UseofSmartBoardcomment = trim(mysqli_real_escape_string($connect,$_REQUEST['UseofSmartBoardcomment']));
 $Energylevel = trim(mysqli_real_escape_string($connect,$_REQUEST['Energylevel']));
 $Energylevelcomment = trim(mysqli_real_escape_string($connect,$_REQUEST['Energylevelcomment']));

 //section4

 $facultymeetyourexpectations = trim(mysqli_real_escape_string($connect,$_REQUEST['facultymeetyourexpectations']));
 $ratingofclass = trim(mysqli_real_escape_string($connect,$_REQUEST['ratingofclass']));

 $specificissuehighlight = trim(mysqli_real_escape_string($connect,$_REQUEST['issueHighlighted']));
 if($specificissuehighlight == ""){

    $specificissuehighlight = 'No';

 }

 $managementtechnicalissue = trim(mysqli_real_escape_string($connect,$_REQUEST['atAnyPoint']));
 if($managementtechnicalissue == ""){

    $managementtechnicalissue = 'No';

 }
 $anyOtherFeedback = trim(mysqli_real_escape_string($connect,$_REQUEST['anyOtherFeedback']));
if($anyOtherFeedback == ""){

    $anyOtherFeedback = 'No';

 }


 $videoremoveportion = trim(mysqli_real_escape_string($connect,$_REQUEST['videoremoveportion']));
 $feedbackforclassroomteam = trim(mysqli_real_escape_string($connect,$_REQUEST['feedbackforclassroomteam']));



//remark table variable
//section1
 $resionfordelaycomment = trim(mysqli_real_escape_string($connect,$_REQUEST['resionfordelaycomment']));
 $classendeatlyremarkcomment = trim(mysqli_real_escape_string($connect,$_REQUEST['classendeatlyremarkcomment']));
 $videoSynopsiscomment = trim(mysqli_real_escape_string($connect,$_REQUEST['videoSynopsiscomment']));
 $synopsisPreviouscomment = trim(mysqli_real_escape_string($connect,$_REQUEST['synopsisPreviouscomment']));

//section2
 $queryNotRepliedcomment = trim(mysqli_real_escape_string($connect,$_REQUEST['queryNotRepliedcomment']));
 $QuestionPromptercomment = trim(mysqli_real_escape_string($connect,$_REQUEST['QuestionPromptercomment']));

//section4
 $differencedonecomment = trim(mysqli_real_escape_string($connect,$_REQUEST['differencedonecomment']));
 $specificissuehighlightcomment = trim(mysqli_real_escape_string($connect,$_REQUEST['issueHighlightedcomment']));
 $managementtechnicalissuecomment = trim(mysqli_real_escape_string($connect,$_REQUEST['atAnyPointcomment']));
 $anyOtherFeedbackcomment = trim(mysqli_real_escape_string($connect,$_REQUEST['anyOtherFeedbackcomment']));

//
$Controversial_Remark = trim(mysqli_real_escape_string($connect,$_REQUEST['Controversial_Remark']));
$Irrelevant_Avoidable_deviations = trim(mysqli_real_escape_string($connect,$_REQUEST['Irrelevant_Avoidable_deviations']));
$Behaviour_Issue = trim(mysqli_real_escape_string($connect,$_REQUEST['Behaviour_Issue']));
$Loose_Comments = trim(mysqli_real_escape_string($connect,$_REQUEST['Loose_Comments']));
$others = trim(mysqli_real_escape_string($connect,$_REQUEST['others']));

$videoremoveportioncomment = $Controversial_Remark.",".$Irrelevant_Avoidable_deviations.",".$Behaviour_Issue.",".$Loose_Comments.",".$others;


//  $videoremoveportioncomment = trim(mysqli_real_escape_string($connect,$_REQUEST['videoremoveportioncomment']));



if($section == 'section1'){
   $insertStatus = insertStatus($checklist_id);
if($insertStatus == 0){
   $queryacademic_feedback_record = "INSERT INTO `academic_feedback_record` (`class_start_time`, `class_delay`, `class_end_time`, `class_end_early`, `previous_class_VSASHP_uploaded`, `synopsis_shown_projector`, `review_of_previous_class`, `QA_related_to_previous_class`, `doubts_repeated_by_online_student`, `No_of_live_query`, `faculty_primarily_used_language`, `percentage_secondary_language`, `transition_from_one_topic_to_another`, `QA_related_to_class_UPSC`, `question_by_student_during_class`, `any_questions_not_replied_class`, `any_questions_not_replied_from_the_prompter`, `response_portal_in_the_class`, `brief_review_after_completion`, `major_topics_covered`, `assignment_confirmed_with_faculty`, `assignment_question_today_class`, `specific_issue_highlighted_by_students`, `students_interact_with_faculty`, `handout_provided`, `handout_provided_to_tech_team`, `management_technical_issue`, `preparation_for_class`, `preparation_for_class_text`, `objective_of_class`, `objective_of_class_text`, `command_over_content`, `command_over_content_text`, `use_of_examples`, `use_of_examples_text`, `organization_of_content`, `organization_of_content_text`, `dictation_in_class`, `dictation_provided_in_big_chunks`, `no_pages_dictated_in_class`, `linkwithcurrentaffair`, `link_with_current_affairs`, `lecture_focussed_on`, `factual_errors_or_conceptual_lags`, `factual_errors_or_conceptual_lags_text`, `time_management`, `time_management_text`, `pace_of_the_class`, `use_of_smart_board`, `use_of_smart_board_text`, `energy_level_and_communication`, `energy_level_and_communication_text`, `faculty_meet_your_expectations`, `overall_rating_for_the_class`, `any_other_feedback`, `video_portion_removed`, `feedback_form_classroom_team`, `checklist_id`, `insertedDateTime`)
   VALUES ('$ClassStartTime', '$ResionForDelay', '$ClassEndTime', '$classendeatlyremark', '$videoSynopsis', '$synopsisPrevious', '$briefReview', '$QAPreviousClass', '$doubtsRephrasedRepeated', '$numberOfLiveQuery', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'No', NULL, '$hanoutinclass', '$handoutToTechteam', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'No', NULL, NULL, '$checklist_id', CURRENT_TIMESTAMP)";


       $runacademic_feedback_record = mysqli_query($connect,$queryacademic_feedback_record);
        if($runacademic_feedback_record){

         $query = "SELECT academic_feedback_record_id FROM academic_feedback_record WHERE checklist_id = '$checklist_id'";
         $run = mysqli_query($connect,$query);
         $data = mysqli_fetch_assoc($run);
         $academic_feedback_record_id = $data['academic_feedback_record_id'];
   
        $queryRemark = "INSERT INTO `academic_feedback_record_remark` (`class_delay_remark`, `end_early_class_remark`, `video_synopsis_uploaded_remark`, `synopsis_previous_class_display_remark`, `question_not_replied_by_faculty_remark`, `question_not_replied_by_faculty_prompter_remark`, `different_done_you`, `issue_highlight_by_student_remark`, `management_technical_issue_remark`, `any_other_feedback_comment`, `video_portion_need_to_cut_remark`, `academic_feedback_record_id`, `checklist_id`)
                                             VALUES ('$resionfordelaycomment', '$classendeatlyremarkcomment', '$videoSynopsiscomment', '$synopsisPreviouscomment', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$academic_feedback_record_id', '$checklist_id')";


               $runForRemark = mysqli_query($connect,$queryRemark);?>
               
               <script>

              alert("Record Saved !!!");
              history.back();
              // $section = 'section2';
             

               </script>
               
               <?php
        }else{

           echo "Errorrr: " . $query . "<br>" . mysqli_error($connect);
           

        }
}else{

   $queryUpdateSectionOne = "UPDATE academic_feedback_record SET
   `class_start_time`= '$ClassStartTime',
    `class_delay`='$ResionForDelay',
     `class_end_time`='$ClassEndTime',
      `class_end_early`='$classendeatlyremark',
       `previous_class_VSASHP_uploaded`='$videoSynopsis',
        `synopsis_shown_projector`='$synopsisPrevious',
         `review_of_previous_class`='$briefReview',
          `QA_related_to_previous_class`='$QAPreviousClass',
           `doubts_repeated_by_online_student`='$doubtsRephrasedRepeated',
            `No_of_live_query`='$numberOfLiveQuery',
            handout_provided = '$hanoutinclass',
            handout_provided_to_tech_team = '$handoutToTechteam' WHERE checklist_id = '$checklist_id'";

$runUpdateSectionOne = mysqli_query($connect,$queryUpdateSectionOne);

if($runUpdateSectionOne){
   $queryUpdateSectionOneRemark = "UPDATE academic_feedback_record_remark SET
   `class_delay_remark`='$resionfordelaycomment',
    `end_early_class_remark`='$classendeatlyremarkcomment',
     `video_synopsis_uploaded_remark`='$videoSynopsiscomment',
      `synopsis_previous_class_display_remark`='$synopsisPreviouscomment' WHERE checklist_id = '$checklist_id'";
      $runUpdateSectionOneRemark = mysqli_query($connect,$queryUpdateSectionOneRemark);
      if($runUpdateSectionOneRemark){?>
      <script>
         alert('Record Saved!!');
         history.back();
      </script>
      
      <?php

      }
}

}
  

}else if($section == 'section2'){
   $insertStatus = insertStatus($checklist_id);
   if($insertStatus == 0){
         $queryacademic_feedback_record = "INSERT INTO `academic_feedback_record` (`class_start_time`, `class_delay`, `class_end_time`, `class_end_early`, `previous_class_VSASHP_uploaded`, `synopsis_shown_projector`, `review_of_previous_class`, `QA_related_to_previous_class`, `doubts_repeated_by_online_student`, `No_of_live_query`, `faculty_primarily_used_language`, `percentage_secondary_language`, `transition_from_one_topic_to_another`, `QA_related_to_class_UPSC`, `question_by_student_during_class`, `any_questions_not_replied_class`, `any_questions_not_replied_from_the_prompter`, `response_portal_in_the_class`, `brief_review_after_completion`, `major_topics_covered`, `assignment_confirmed_with_faculty`, `assignment_question_today_class`, `specific_issue_highlighted_by_students`, `students_interact_with_faculty`, `handout_provided`, `handout_provided_to_tech_team`, `management_technical_issue`, `preparation_for_class`, `preparation_for_class_text`, `objective_of_class`, `objective_of_class_text`, `command_over_content`, `command_over_content_text`, `use_of_examples`, `use_of_examples_text`, `organization_of_content`, `organization_of_content_text`, `dictation_in_class`, `dictation_provided_in_big_chunks`, `no_pages_dictated_in_class`, `linkwithcurrentaffair`, `link_with_current_affairs`, `lecture_focussed_on`, `factual_errors_or_conceptual_lags`, `factual_errors_or_conceptual_lags_text`, `time_management`, `time_management_text`, `pace_of_the_class`, `use_of_smart_board`, `use_of_smart_board_text`, `energy_level_and_communication`, `energy_level_and_communication_text`, `faculty_meet_your_expectations`, `overall_rating_for_the_class`, `any_other_feedback`, `video_portion_removed`, `feedback_form_classroom_team`, `checklist_id`, `insertedDateTime`)
           VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$useHindiEnglish', '$percenatgeofSecondaryLanguage', '$transitionOfTopic', '$QARelatedToUPSC', '$questionAskedByStudent', '$queryNotReplied', '$QuestionPrompter', '$responseportalinclass', '$aftercompletionofclass', '$majortopiccomment', '$assignmentQuestionwithfaculty', '$assignmentquestioncomment', 'No', '$studentinterectfaculty', NULL, NULL, 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'No', NULL, NULL, '$checklist_id', CURRENT_TIMESTAMP)";
          $runAcadmicFeedbackRecord =  mysqli_query($connect,$queryacademic_feedback_record);

           if($runAcadmicFeedbackRecord){

            $query = "SELECT academic_feedback_record_id FROM academic_feedback_record WHERE checklist_id = '$checklist_id'";
            $run = mysqli_query($connect,$query);
              $data = mysqli_fetch_assoc($run);
               $academic_feedback_record_id = $data['academic_feedback_record_id'];
               $queryRemark = "INSERT INTO `academic_feedback_record_remark` (`class_delay_remark`, `end_early_class_remark`, `video_synopsis_uploaded_remark`, `synopsis_previous_class_display_remark`, `question_not_replied_by_faculty_remark`, `question_not_replied_by_faculty_prompter_remark`, `different_done_you`, `issue_highlight_by_student_remark`, `management_technical_issue_remark`, `any_other_feedback_comment`, `video_portion_need_to_cut_remark`, `academic_feedback_record_id`, `checklist_id`)
                VALUES (NULL, NULL, NULL, NULL, '$queryNotRepliedcomment', '$QuestionPromptercomment', NULL, NULL, NULL, NULL, NULL, '$academic_feedback_record_id', '$checklist_id')";
               $runForRemark = mysqli_query($connect,$queryRemark);?>
                 <script>
                                                                                          
             alert("Record Saved !!!");
              history.back();
               // $section = 'section2';
                                                                                                       
       </script>
<?php
}
   }else{
      
   $queryUpdateSectionOne = "UPDATE academic_feedback_record SET
 `faculty_primarily_used_language`='$useHindiEnglish',
  `percentage_secondary_language`='$percenatgeofSecondaryLanguage',
   `transition_from_one_topic_to_another`='$transitionOfTopic',
    `QA_related_to_class_UPSC`='$QARelatedToUPSC',
     `question_by_student_during_class`='$questionAskedByStudent',
      `any_questions_not_replied_class`='$queryNotReplied',
       `any_questions_not_replied_from_the_prompter`='$QuestionPrompter',
        `response_portal_in_the_class`='$responseportalinclass',
         `brief_review_after_completion`='$aftercompletionofclass',
          `major_topics_covered`='$majortopiccomment',
           `assignment_confirmed_with_faculty`='$assignmentQuestionwithfaculty',
            `assignment_question_today_class`='$assignmentquestioncomment',
              `students_interact_with_faculty`='$studentinterectfaculty' WHERE checklist_id = '$checklist_id'";

$runUpdateSectionOne = mysqli_query($connect,$queryUpdateSectionOne);

if($runUpdateSectionOne){
   $queryUpdateSectionOneRemark = "UPDATE academic_feedback_record_remark SET
 `question_not_replied_by_faculty_remark`='$queryNotRepliedcomment',
  `question_not_replied_by_faculty_prompter_remark`='$QuestionPromptercomment' WHERE checklist_id = '$checklist_id'";
      $runUpdateSectionOneRemark = mysqli_query($connect,$queryUpdateSectionOneRemark);
      if($runUpdateSectionOneRemark){?>
      <script>
         alert('Record Saved!!');
         history.back();
      </script>
      
      <?php

      }
}
   }


}else if($section == 'section3'){

   $insertStatus = insertStatus($checklist_id);
   if($insertStatus == 0){
    $queryacademic_feedback_record = "INSERT INTO `academic_feedback_record` (`class_start_time`, `class_delay`, `class_end_time`, `class_end_early`, `previous_class_VSASHP_uploaded`, `synopsis_shown_projector`, `review_of_previous_class`, `QA_related_to_previous_class`, `doubts_repeated_by_online_student`, `No_of_live_query`, `faculty_primarily_used_language`, `percentage_secondary_language`, `transition_from_one_topic_to_another`, `QA_related_to_class_UPSC`, `question_by_student_during_class`, `any_questions_not_replied_class`, `any_questions_not_replied_from_the_prompter`, `response_portal_in_the_class`, `brief_review_after_completion`, `major_topics_covered`, `assignment_confirmed_with_faculty`, `assignment_question_today_class`, `specific_issue_highlighted_by_students`, `students_interact_with_faculty`, `handout_provided`, `handout_provided_to_tech_team`, `management_technical_issue`, `preparation_for_class`, `preparation_for_class_text`, `objective_of_class`, `objective_of_class_text`, `command_over_content`, `command_over_content_text`, `use_of_examples`, `use_of_examples_text`, `organization_of_content`, `organization_of_content_text`, `dictation_in_class`, `dictation_provided_in_big_chunks`, `no_pages_dictated_in_class`, `linkwithcurrentaffair`, `link_with_current_affairs`, `lecture_focussed_on`, `factual_errors_or_conceptual_lags`, `factual_errors_or_conceptual_lags_text`, `time_management`, `time_management_text`, `pace_of_the_class`, `use_of_smart_board`, `use_of_smart_board_text`, `energy_level_and_communication`, `energy_level_and_communication_text`, `faculty_meet_your_expectations`, `overall_rating_for_the_class`, `any_other_feedback`, `video_portion_removed`, `feedback_form_classroom_team`, `checklist_id`, `insertedDateTime`)
    VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'No', NULL, NULL, NULL, 'No', '$Preparationfortheclass', '$Preparationfortheclasscomment', '$Objectiveofclas', '$Objectiveofclascomment', '$Commandoverthecontent', '$Commandoverthecontentcomment', '$UseofExamples', '$UseofExamplescomment', '$Organizationofcontent', '$Organizationofcontentcomment', '$dictationinclass', '$dictationinclasschunk', '$Approximatelypages', '$linkwithcurrentaffair', '$LinkwithCurrentAffairsrating', '$lectureFocussed', '$Factualerrors', '$Factualerrorscomment', '$TimeManagement', '$TimeManagementcomment', '$Paceoftheclas', '$UseofSmartBoard', '$UseofSmartBoardcomment', '$Energylevel', '$Energylevelcomment', NULL, NULL, 'No', NULL, NULL, '$checklist_id', CURRENT_TIMESTAMP)";
          $runAcadmicFeedbackRecord =  mysqli_query($connect,$queryacademic_feedback_record);

           if($runAcadmicFeedbackRecord){

            $query = "SELECT academic_feedback_record_id FROM academic_feedback_record WHERE checklist_id = '$checklist_id'";
            $run = mysqli_query($connect,$query);
              $data = mysqli_fetch_assoc($run);
               $academic_feedback_record_id = $data['academic_feedback_record_id'];
               $queryRemark = "INSERT INTO `academic_feedback_record_remark` (`class_delay_remark`, `end_early_class_remark`, `video_synopsis_uploaded_remark`, `synopsis_previous_class_display_remark`, `question_not_replied_by_faculty_remark`, `question_not_replied_by_faculty_prompter_remark`, `different_done_you`, `issue_highlight_by_student_remark`, `management_technical_issue_remark`, `any_other_feedback_comment`, `video_portion_need_to_cut_remark`, `academic_feedback_record_id`, `checklist_id`)
                VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$academic_feedback_record_id', '$checklist_id')";
               $runForRemark = mysqli_query($connect,$queryRemark);?>
                 <script>
                                                                                          
             alert("Record Saved !!!");
              history.back();
               // $section = 'section2';
                                                                                                       
       </script>
<?php
}
   }else{
      
   $queryUpdateSectionOne = "UPDATE academic_feedback_record SET
 `preparation_for_class`='$Preparationfortheclass',
  `preparation_for_class_text`='$Preparationfortheclasscomment',
   `objective_of_class`='$Objectiveofclas',
    `objective_of_class_text`='$Objectiveofclascomment', 
    `command_over_content`='$Commandoverthecontent',
     `command_over_content_text`='$Commandoverthecontentcomment',
      `use_of_examples`='$UseofExamples',
       `use_of_examples_text`='$UseofExamplescomment',
        `organization_of_content`='$Organizationofcontent',
         `organization_of_content_text`='$Organizationofcontentcomment',
          `dictation_in_class`='$dictationinclass',
           `dictation_provided_in_big_chunks`='$dictationinclasschunk',
            `no_pages_dictated_in_class`='$Approximatelypages',
             `linkwithcurrentaffair`='$linkwithcurrentaffair',
              `link_with_current_affairs`='$LinkwithCurrentAffairsrating',
               `lecture_focussed_on`='$lectureFocussed',
                `factual_errors_or_conceptual_lags`='$Factualerrors',
                 `factual_errors_or_conceptual_lags_text`='$Factualerrorscomment',
                  `time_management`='$TimeManagement',
                   `time_management_text`='$TimeManagementcomment',
                    `pace_of_the_class`='$Paceoftheclas',
                     `use_of_smart_board`='$UseofSmartBoard',
                      `use_of_smart_board_text`='$UseofSmartBoardcomment', 
                      `energy_level_and_communication`='$Energylevel',
                       `energy_level_and_communication_text`='$Energylevelcomment' WHERE checklist_id = '$checklist_id'";

$runUpdateSectionOne = mysqli_query($connect,$queryUpdateSectionOne);

if($runUpdateSectionOne)?>
      <script>
         alert('Record Saved!!');
         history.back();
      </script>
      
      <?php

      }

   

}else if($section == 'section4'){

   $insertStatus = insertStatus($checklist_id);
   if($insertStatus == 0){
      $queryacademic_feedback_record = "INSERT INTO `academic_feedback_record` (`class_start_time`, `class_delay`, `class_end_time`, `class_end_early`, `previous_class_VSASHP_uploaded`, `synopsis_shown_projector`, `review_of_previous_class`, `QA_related_to_previous_class`, `doubts_repeated_by_online_student`, `No_of_live_query`, `faculty_primarily_used_language`, `percentage_secondary_language`, `transition_from_one_topic_to_another`, `QA_related_to_class_UPSC`, `question_by_student_during_class`, `any_questions_not_replied_class`, `any_questions_not_replied_from_the_prompter`, `response_portal_in_the_class`, `brief_review_after_completion`, `major_topics_covered`, `assignment_confirmed_with_faculty`, `assignment_question_today_class`, `specific_issue_highlighted_by_students`, `students_interact_with_faculty`, `handout_provided`, `handout_provided_to_tech_team`, `management_technical_issue`, `preparation_for_class`, `preparation_for_class_text`, `objective_of_class`, `objective_of_class_text`, `command_over_content`, `command_over_content_text`, `use_of_examples`, `use_of_examples_text`, `organization_of_content`, `organization_of_content_text`, `dictation_in_class`, `dictation_provided_in_big_chunks`, `no_pages_dictated_in_class`, `linkwithcurrentaffair`, `link_with_current_affairs`, `lecture_focussed_on`, `factual_errors_or_conceptual_lags`, `factual_errors_or_conceptual_lags_text`, `time_management`, `time_management_text`, `pace_of_the_class`, `use_of_smart_board`, `use_of_smart_board_text`, `energy_level_and_communication`, `energy_level_and_communication_text`, `faculty_meet_your_expectations`, `overall_rating_for_the_class`, `any_other_feedback`, `video_portion_removed`, `feedback_form_classroom_team`, `checklist_id`, `insertedDateTime`)
      VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$specificissuehighlight', NULL, NULL, NULL, '$managementtechnicalissue', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$facultymeetyourexpectations', '$ratingofclass', '$anyOtherFeedback', '$videoremoveportion', '$feedbackforclassroomteam', '$checklist_id', CURRENT_TIMESTAMP)";
          $runAcadmicFeedbackRecord =  mysqli_query($connect,$queryacademic_feedback_record);

           if($runAcadmicFeedbackRecord){

            $query = "SELECT academic_feedback_record_id FROM academic_feedback_record WHERE checklist_id = '$checklist_id'";
            $run = mysqli_query($connect,$query);
              $data = mysqli_fetch_assoc($run);
               $academic_feedback_record_id = $data['academic_feedback_record_id'];
               $queryRemark = "INSERT INTO `academic_feedback_record_remark` (`class_delay_remark`, `end_early_class_remark`, `video_synopsis_uploaded_remark`, `synopsis_previous_class_display_remark`, `question_not_replied_by_faculty_remark`, `question_not_replied_by_faculty_prompter_remark`, `different_done_you`, `issue_highlight_by_student_remark`, `management_technical_issue_remark`, `any_other_feedback_comment`, `video_portion_need_to_cut_remark`, `academic_feedback_record_id`, `checklist_id`)
                VALUES (NULL, NULL, NULL, NULL, NULL, NULL,'$differencedonecomment', '$specificissuehighlightcomment', '$managementtechnicalissuecomment', '$anyOtherFeedbackcomment', '$videoremoveportioncomment', '$academic_feedback_record_id', '$checklist_id')";
               $runForRemark = mysqli_query($connect,$queryRemark);?>
                 <script>
                                                                                          
             alert("Record Saved !!!");
              history.back();
               // $section = 'section2';
                                                                                                       
       </script>
<?php
}
   }else{
      
   $queryUpdateSectionOne = "UPDATE academic_feedback_record SET
  `specific_issue_highlighted_by_students`='$specificissuehighlight',
  `management_technical_issue`='$managementtechnicalissue',
  `faculty_meet_your_expectations`='$facultymeetyourexpectations',
   `overall_rating_for_the_class`='$ratingofclass',
    `any_other_feedback`='$anyOtherFeedback',
     `video_portion_removed`='$videoremoveportion',
      `feedback_form_classroom_team`='$feedbackforclassroomteam'
  WHERE checklist_id = '$checklist_id'";

$runUpdateSectionOne = mysqli_query($connect,$queryUpdateSectionOne);

if($runUpdateSectionOne){
   $queryUpdateSectionOneRemark = "UPDATE academic_feedback_record_remark SET
   `different_done_you`='$differencedonecomment',
    `issue_highlight_by_student_remark`='$specificissuehighlightcomment',
     `management_technical_issue_remark`='$managementtechnicalissuecomment',
      `any_other_feedback_comment`='$anyOtherFeedbackcomment',
       `video_portion_need_to_cut_remark`='$videoremoveportioncomment'
  WHERE checklist_id = '$checklist_id'";
      $runUpdateSectionOneRemark = mysqli_query($connect,$queryUpdateSectionOneRemark);
      if($runUpdateSectionOneRemark){?>
      <script>
         alert('Record Saved!!');
         history.back();
      </script>
      
      <?php

      }
}
   }

}
        
?>
