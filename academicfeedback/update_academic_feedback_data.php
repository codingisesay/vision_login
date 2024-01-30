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
$specificissuehighlight = trim(mysqli_real_escape_string($connect,$_REQUEST['specificissuehighlight']));
$studentinterectfaculty = trim(mysqli_real_escape_string($connect,$_REQUEST['studentinterectfaculty']));
$hanoutinclass = trim(mysqli_real_escape_string($connect,$_REQUEST['hanoutinclass']));
$handoutToTechteam = trim(mysqli_real_escape_string($connect,$_REQUEST['handoutToTechteam']));
$managementtechnicalissue = trim(mysqli_real_escape_string($connect,$_REQUEST['managementtechnicalissue']));
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
$LinkwithCurrentAffairs = trim(mysqli_real_escape_string($connect,$_REQUEST['LinkwithCurrentAffairs']));
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
$facultymeetyourexpectationscomment = trim(mysqli_real_escape_string($connect,$_REQUEST['facultymeetyourexpectationscomment']));
$differencedonecomment = trim(mysqli_real_escape_string($connect,$_REQUEST['differencedonecomment']));
$ratingofclass = trim(mysqli_real_escape_string($connect,$_REQUEST['ratingofclass']));
$otherfeedbackcomment = trim(mysqli_real_escape_string($connect,$_REQUEST['otherfeedbackcomment']));
$videoremoveportion = trim(mysqli_real_escape_string($connect,$_REQUEST['videoremoveportion']));
$feedbackforclassroomteam = trim(mysqli_real_escape_string($connect,$_REQUEST['feedbackforclassroomteam']));


$resionfordelaycomment = trim(mysqli_real_escape_string($connect,$_REQUEST['resionfordelaycomment']));
$classendeatlyremarkcomment = trim(mysqli_real_escape_string($connect,$_REQUEST['classendeatlyremarkcomment']));
$videoSynopsiscomment = trim(mysqli_real_escape_string($connect,$_REQUEST['videoSynopsiscomment']));
$synopsisPreviouscomment = trim(mysqli_real_escape_string($connect,$_REQUEST['synopsisPreviouscomment']));
$queryNotRepliedcomment = trim(mysqli_real_escape_string($connect,$_REQUEST['queryNotRepliedcomment']));
$QuestionPromptercomment = trim(mysqli_real_escape_string($connect,$_REQUEST['QuestionPromptercomment']));
$specificissuehighlightcomment = trim(mysqli_real_escape_string($connect,$_REQUEST['specificissuehighlightcomment']));
$managementtechnicalissuecomment = trim(mysqli_real_escape_string($connect,$_REQUEST['managementtechnicalissuecomment']));
$videoremoveportioncomment = trim(mysqli_real_escape_string($connect,$_REQUEST['videoremoveportioncomment']));

?>