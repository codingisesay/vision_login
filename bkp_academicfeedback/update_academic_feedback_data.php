<?php 
include('../session.php');
include('academicfeedbackFunction.php');


?>
<?php
$checklist_id = trim($_POST['checklistid']);

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

$specificissuehighlight = trim(mysqli_real_escape_string($connect,$_REQUEST['issueHighlighted']));
if($specificissuehighlight == ""){

    $specificissuehighlight = 'No';

 }



$studentinterectfaculty = trim(mysqli_real_escape_string($connect,$_REQUEST['studentinterectfaculty']));
$hanoutinclass = trim(mysqli_real_escape_string($connect,$_REQUEST['hanoutinclass']));
$handoutToTechteam = trim(mysqli_real_escape_string($connect,$_REQUEST['handoutToTechteam']));

$managementtechnicalissue = trim(mysqli_real_escape_string($connect,$_REQUEST['atAnyPoint']));

if($managementtechnicalissue == ""){

    $managementtechnicalissue = 'No';

 }


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
$LinkwithCurrentAffairsrating = trim(mysqli_real_escape_string($connect,$_REQUEST['LinkwithCurrentAffairs']));
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
$facultymeetyourexpectations = trim(mysqli_real_escape_string($connect,$_REQUEST['facultymeetyourexpectations']));
$ratingofclass = trim(mysqli_real_escape_string($connect,$_REQUEST['ratingofclass']));

$anyOtherFeedback = trim(mysqli_real_escape_string($connect,$_REQUEST['anyOtherFeedback']));

if($anyOtherFeedback == ""){

    $anyOtherFeedback = 'No';

 }



$videoremoveportion = trim(mysqli_real_escape_string($connect,$_REQUEST['videoremoveportion']));
$feedbackforclassroomteam = trim(mysqli_real_escape_string($connect,$_REQUEST['feedbackforclassroomteam']));


$resionfordelaycomment = trim(mysqli_real_escape_string($connect,$_REQUEST['resionfordelaycomment']));
$classendeatlyremarkcomment = trim(mysqli_real_escape_string($connect,$_REQUEST['classendeatlyremarkcomment']));
$videoSynopsiscomment = trim(mysqli_real_escape_string($connect,$_REQUEST['videoSynopsiscomment']));
$synopsisPreviouscomment = trim(mysqli_real_escape_string($connect,$_REQUEST['synopsisPreviouscomment']));
$queryNotRepliedcomment = trim(mysqli_real_escape_string($connect,$_REQUEST['queryNotRepliedcomment']));
$QuestionPromptercomment = trim(mysqli_real_escape_string($connect,$_REQUEST['QuestionPromptercomment']));
$differencedonecomment = trim(mysqli_real_escape_string($connect,$_REQUEST['differencedonecomment']));
$specificissuehighlightcomment = trim(mysqli_real_escape_string($connect,$_REQUEST['issueHighlightedcomment']));
$managementtechnicalissuecomment = trim(mysqli_real_escape_string($connect,$_REQUEST['atAnyPointcomment']));
$anyOtherFeedbackcomment = trim(mysqli_real_escape_string($connect,$_REQUEST['anyOtherFeedbackcomment']));
$videoremoveportioncomment = trim(mysqli_real_escape_string($connect,$_REQUEST['videoremoveportioncomment']));

$query = "UPDATE academic_feedback_record
SET class_start_time = '$ClassStartTime', class_delay = '$ResionForDelay', class_end_time = '$ClassEndTime',class_end_early = '$classendeatlyremark',previous_class_VSASHP_uploaded = '$videoSynopsis',
synopsis_shown_projector = '$synopsisPrevious', review_of_previous_class = '$briefReview', QA_related_to_previous_class = '$QAPreviousClass', doubts_repeated_by_online_student = '$doubtsRephrasedRepeated',
No_of_live_query = '$numberOfLiveQuery', faculty_primarily_used_language = '$useHindiEnglish', percentage_secondary_language = '$percenatgeofSecondaryLanguage', transition_from_one_topic_to_another = '$transitionOfTopic',
QA_related_to_class_UPSC = '$QARelatedToUPSC', question_by_student_during_class = '$questionAskedByStudent',any_questions_not_replied_class = '$queryNotReplied', any_questions_not_replied_from_the_prompter = '$QuestionPrompter',
response_portal_in_the_class = '$responseportalinclass', brief_review_after_completion = '$aftercompletionofclass', major_topics_covered = '$majortopiccomment', assignment_confirmed_with_faculty = '$assignmentQuestionwithfaculty',
assignment_question_today_class = '$assignmentquestioncomment',specific_issue_highlighted_by_students = '$specificissuehighlight', students_interact_with_faculty = '$studentinterectfaculty', handout_provided = '$hanoutinclass',handout_provided_to_tech_team = '$handoutToTechteam',
management_technical_issue = '$managementtechnicalissue', preparation_for_class = '$Preparationfortheclass', preparation_for_class_text = '$Preparationfortheclasscomment',objective_of_class = '$Objectiveofclas',objective_of_class_text = '$Objectiveofclascomment', command_over_content = '$Commandoverthecontent',
command_over_content_text = '$Commandoverthecontentcomment', use_of_examples = '$UseofExamples',use_of_examples_text = '$UseofExamplescomment', organization_of_content = '$Organizationofcontent',organization_of_content_text = '$Organizationofcontentcomment', dictation_in_class = '$dictationinclass', dictation_provided_in_big_chunks = '$dictationinclasschunk',
no_pages_dictated_in_class = '$Approximatelypages', linkwithcurrentaffair = '$linkwithcurrentaffair',link_with_current_affairs = '$LinkwithCurrentAffairsrating',lecture_focussed_on = '$lectureFocussed',factual_errors_or_conceptual_lags = '$Factualerrors',factual_errors_or_conceptual_lags_text = '$Factualerrorscomment',time_management = '$TimeManagement',time_management_text = '$TimeManagementcomment',pace_of_the_class = '$Paceoftheclas',
use_of_smart_board = '$UseofSmartBoard',use_of_smart_board_text = '$UseofSmartBoardcomment',energy_level_and_communication = '$Energylevel',energy_level_and_communication_text = '$Energylevelcomment',faculty_meet_your_expectations = '$facultymeetyourexpectations', 
overall_rating_for_the_class = '$ratingofclass',any_other_feedback = '$anyOtherFeedback',video_portion_removed = '$videoremoveportion',feedback_form_classroom_team = '$feedbackforclassroomteam' WHERE checklist_id = '$checklist_id'";

$runForacademic_feedback_record = mysqli_query($connect,$query);

$queryForfeedbackid = "SELECT academic_feedback_record_id FROM academic_feedback_record WHERE checklist_id = '$checklist_id'";
          $run = mysqli_query($connect,$queryForfeedbackid);
          $data = mysqli_fetch_assoc($run);
          $academic_feedback_record_id = $data['academic_feedback_record_id'];

if($runForacademic_feedback_record){
    $queryForCheckInserOrUpdate = "SELECT * FROM academic_feedback_record_remark WHERE checklist_id = '$checklist_id'";
    $runForCheckInserOrUpdate = mysqli_query($connect,$queryForCheckInserOrUpdate);
    $rowForCheckInserOrUpdate = mysqli_num_rows($runForCheckInserOrUpdate);
    if($rowForCheckInserOrUpdate == 1){
        $queryUpdate = "UPDATE academic_feedback_record_remark
        SET class_delay_remark = '$resionfordelaycomment',end_early_class_remark = '$classendeatlyremarkcomment',video_synopsis_uploaded_remark = '$videoSynopsiscomment',synopsis_previous_class_display_remark = '$synopsisPreviouscomment',
        question_not_replied_by_faculty_remark = '$queryNotRepliedcomment',question_not_replied_by_faculty_prompter_remark = '$QuestionPromptercomment',different_done_you = '$differencedonecomment',issue_highlight_by_student_remark = '$specificissuehighlightcomment',management_technical_issue_remark = '$managementtechnicalissuecomment',
        any_other_feedback_comment = '$anyOtherFeedbackcomment', video_portion_need_to_cut_remark = '$videoremoveportioncomment',academic_feedback_record_id = '$academic_feedback_record_id' WHERE checklist_id = '$checklist_id'";
        $runForUpdateRemark = mysqli_query($connect,$queryUpdate);?>
        <script>

alert("Record Updated !!!");
location.replace("index.php");

 </script>
        
        <?php

    }else{
        if($resionfordelaycomment != "" || $classendeatlyremarkcomment != "" || $videoSynopsiscomment != "" || $synopsisPreviouscomment != "" || $queryNotRepliedcomment != "" || $QuestionPromptercomment != "" ||$differencedonecomment !="" || $specificissuehighlightcomment != "" || $managementtechnicalissuecomment != "" ||$anyOtherFeedbackcomment != ""|| $videoremoveportioncomment != ""){

            $queryRemark = "INSERT INTO `academic_feedback_record_remark` (`class_delay_remark`, `end_early_class_remark`, `video_synopsis_uploaded_remark`, `synopsis_previous_class_display_remark`, `question_not_replied_by_faculty_remark`, `question_not_replied_by_faculty_prompter_remark`, different_done_you,`issue_highlight_by_student_remark`, `management_technical_issue_remark`,any_other_feedback_comment, `video_portion_need_to_cut_remark`, `academic_feedback_record_id`, `checklist_id`)
            VALUES ('$resionfordelaycomment', '$classendeatlyremarkcomment', '$videoSynopsiscomment', '$synopsisPreviouscomment', '$queryNotRepliedcomment', '$QuestionPromptercomment','$differencedonecomment', '$specificissuehighlightcomment', '$managementtechnicalissuecomment','$anyOtherFeedbackcomment', '$videoremoveportioncomment','$academic_feedback_record_id','$checklist_id')";

            $runForRemark = mysqli_query($connect,$queryRemark);
            if($runForRemark){?>
            
            <script>

               alert("Record Updated !!!");
               location.replace("index.php");

                </script>
            
            <?php

            }else{
                ?>
            
            <script>

               alert("Record Updated !!!");
               location.replace("index.php");

                </script>
            
            <?php

            }

        }else{?><script>

            alert("Record Updated !!!");
            location.replace("index.php");

             </script>
         
         <?php

        }

}
}else{
    echo "Error: " . $runForacademic_feedback_record . "<br>" . mysqli_error($connect);
}
?>

