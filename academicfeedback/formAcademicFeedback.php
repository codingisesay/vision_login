<?php 
include('../session.php');
include('academicfeedbackFunction.php');
?>
<head>
  <title>Academic Feedback</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
<style>
    .formcssradio{
        margin: 10px;
    }
    .radiosize{
        width: 25px;
        height: 25px;
        font-size: 25px;
    }
    td{
        font-weight: bolder;
    }
    .displaynone{
      display:none;
    }
</style>
</head>

<body>
    <?php 
    
    include('academicfeedbackNavBar.php');
    
    $classID = $_REQUEST['class_id'];
    $classDetails = classDetailsFromClassID($classID);
    $checklist_id = $classDetails[0]['checklist id'];
    // $data = FetchForFormSectionZone($checklist_id);
    $acadmicFeebackData = fetchDataFromAcadmicData($checklist_id);
    // $lenguageused = $data['faculty_primarily_used_language'];
    // $assignment_question_today_class = $data['assignment_question_today_class'];
    // $link_with_current_affairs = $data['link_with_current_affairs'];
    // $feedback_form_classroom_team = $data['feedback_form_classroom_team'];
    
    
    // echo "<pre>";
    // print_r($acadmicFeebackData);
    
    
    ?>
<div class="container-fluid" style="background-color: rgba(0,0,0,0.1);">
<button type="button" class="btn btn-lg btn-info collapsed" data-toggle="collapse" data-target="#demo" id="demoo">Class Information</button>
<button type="button" class="btn btn-lg btn-info collapsed" data-toggle="collapse" data-target="#demo1" id="demoo1">Basic Details</button>
<button type="button" class="btn btn-lg btn-info collapsed" data-toggle="collapse" data-target="#demo2" id="demoo2">Student Interaction</button>
<button type="button" class="btn btn-lg btn-info collapsed" data-toggle="collapse" data-target="#demo3" id="demoo3">Class Performance</button>
<button type="button" class="btn btn-lg btn-info collapsed" data-toggle="collapse" data-target="#demo4" id="demoo4">Your Feedback</button>
<div class="container" style="background-color: white;">

<div id="demo" class="collapse">
<form action="insert_academic_feedback_data.php" method="POST" enctype="multipart/form-data">
  <h2 style="text-align: center;">Academic Feedback Form</h2><br>
  <table class="table table-bordered">
    <tr style="display: none;">
      <td></td>
      <td><input type="hidden" name="checklistid" value="<?php echo $classDetails[0]['checklist id'];?>" ></td>
    </tr>

    <tr>
      <td>Class ID</td>
      <td><?php echo $classID;?></td>
    </tr>

    <tr>

        <td>Date</td>
        <td><?php $originalDate = $classDetails[0]['class date']; 
       echo $newDate = date("d-m-Y", strtotime($originalDate));
        ?></td>
    </tr>
    <tr>
        <td>Batch</td>
        <td><?php 
        echo str_replace(",","<br>",$classDetails[0]['batch']);
         
        
        ?></td>
    </tr>
    <tr>
        <td>Subject</td>
        <td><?php echo $classDetails[0]['subject']; ?></td>
    </tr>

    <tr>
        <td>Faculty</td>
        <td><?php echo $classDetails[0]['faculty'];?></td>
    </tr>
    <tr>
        <td>Coordinator</td>
        <td><?php echo preg_replace('/[0-9-]/',"",$classDetails[0]['batch_coordinator']); ?></td>
    </tr>
    <tr>
        <td>No of Students present in the class</td>
        <td><?php echo $classDetails[0]['attendance']; ?></td>
    </tr>
    <tr>
        <td>No of students active on response portal (max)</td>
        <td><?php echo $classDetails[0]['response']; ?></td>
    </tr>
  </table>
</form>
</div>

<div id="demo1" class="collapse">
  <form action="insert_academic_feedback_data.php" method="POST">
    <table class="table table-bordered">
      <h3 style="text-align: center;">Basic Details</h3>
      <tr style="display: none;">
      <td></td>
      <td><input type="hidden" name="checklistid" value="<?php echo $classDetails[0]['checklist id'];?>" ></td>
      <td><input type="hidden" name="section" value="section1" ></td>
    </tr>
    <tr>
        <td>Class Start Time</td>
        <td><input type="time" class="form-control" id="usr" name ="ClassStartTime" value="<?php echo $acadmicFeebackData[0]['class_start_time']; ?>" required></td>
    </tr>
    <tr>
        <td>Was the class Delay?</td>
        <td id="resionfordelay_td"> <select class="form-control" id="resionfordelay" name="resionfordelay" required>
            <option value="<?php echo $acadmicFeebackData[0]['class_delay']; ?>"><?php echo $acadmicFeebackData[0]['class_delay']; ?></option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select><br><textarea class="form-control" rows="5" id="resionfordelaycomment" name="resionfordelaycomment" placeholder="Reason for Delay" style="display:none;"><?php echo $acadmicFeebackData[0]['class_delay_remark']; ?></textarea></td>
    </tr>
    <tr>
        <td>Class End Time</td>
        <td><input type="time" class="form-control" id="usr" name="ClassEndTime" value="<?php echo $acadmicFeebackData[0]['class_end_time']; ?>" required></td>
    </tr>
    <tr>
        <td>Reasons for ending the class early,if applicable</td>
        <td id="classendeatlyremark_id"> <select class="form-control" id="classendeatlyremark" name="classendeatlyremark" required>
            <option value="<?php echo $acadmicFeebackData[0]['class_end_early']; ?>"><?php echo $acadmicFeebackData[0]['class_end_early']; ?></option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select><br> <textarea class="form-control" rows="5" id="classendeatlyremarkcomment" name="classendeatlyremarkcomment" placeholder="Please Write Here" style="display:none;"><?php echo $acadmicFeebackData[0]['end_early_class_remark']; ?></textarea></td>
    </tr>
    <tr>
        <td>Video/Synopsis/AQ/STQ/Handouts/PPTs <br> of that previous class correctly uploaded<br>
         (Irrespective of which batch coordinator attended that class)</td>
        <td id="videoSynopsis_td"> <select class="form-control" id="videoSynopsis" name="videoSynopsis" required>
            <option value="<?php echo $acadmicFeebackData[0]['previous_class_VSASHP_uploaded']; ?>"><?php echo $acadmicFeebackData[0]['previous_class_VSASHP_uploaded']; ?></option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select><br><textarea class="form-control" rows="5" id="videoSynopsiscomment" name="videoSynopsiscomment" placeholder="Write Reason Here" style="display:none;"><?php echo $acadmicFeebackData[0]['video_synopsis_uploaded_remark']; ?></textarea></td>
    </tr>
    <tr>
        <td>Synopsis of previous class was shown on projector before Faculty entered</td>
        <td id="synopsisPrevious_td"> <select class="form-control" id="synopsisPrevious" name="synopsisPrevious" required>
            <option value="<?php echo $acadmicFeebackData[0]['synopsis_shown_projector']; ?>"><?php echo $acadmicFeebackData[0]['synopsis_shown_projector']; ?></option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select><br><textarea class="form-control" rows="5" id="synopsisPreviouscomment" name="synopsisPreviouscomment" placeholder="Write Reason Here" style="display:none;"><?php echo $acadmicFeebackData[0]['synopsis_previous_class_display_remark']; ?></textarea></td>
    </tr>
    <tr>
        <td>Brief review of the previous class?</td>
        <td> <select class="form-control" id="briefReview" name="briefReview" required>
            <option value="<?php echo $acadmicFeebackData[0]['review_of_previous_class']; ?>"><?php echo $acadmicFeebackData[0]['review_of_previous_class']; ?></option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select></td>
    </tr>
    <tr>
        <td>Q/A related to previous class?</td>
        <td> <select class="form-control" id="QAPreviousClass" name="QAPreviousClass" required>
            <option value="<?php echo $acadmicFeebackData[0]['QA_related_to_previous_class']; ?>"><?php echo $acadmicFeebackData[0]['QA_related_to_previous_class']; ?></option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select></td>
    </tr>
    <tr>
        <td>Were doubts rephrased/repeated by faculty to the class for the online students?</td>
        <td> <select class="form-control" id="doubtsRephrasedRepeated" name="doubtsRephrasedRepeated" required>
            <option value="<?php echo $acadmicFeebackData[0]['doubts_repeated_by_online_student']; ?>"><?php echo $acadmicFeebackData[0]['doubts_repeated_by_online_student']; ?></option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            <option value="Very Few">Very Few</option>
        </select></td>
    </tr>

    <tr>
        <td>Number of LIVE Queries asked in the Class (approx.)</td>
        <td><input type="number" class="form-control" id="numberOfLiveQuery" name="numberOfLiveQuery" value="<?php echo $acadmicFeebackData[0]['No_of_live_query']; ?>"required></td>
    </tr>
    <tr>
        <td>Any handout Used/Provided in the class?</td>
        <td id="hanoutinclass_td"> <select class="form-control" id="hanoutinclass" name="hanoutinclass" required>
            <option value="<?php echo $acadmicFeebackData[0]['handout_provided']; ?>"><?php echo $acadmicFeebackData[0]['handout_provided']; ?></option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
          
        </select></td>
    </tr>

    <tr id="sent_to_class_support" style="display: none;">
        <td>A Handout provided in the class was sent to the tech team for uploading?</td>
        <td> <select class="form-control" id="handoutToTechteam" name="handoutToTechteam">
            <option value="<?php echo $acadmicFeebackData[0]['handout_provided_to_tech_team']; ?>"><?php echo $acadmicFeebackData[0]['handout_provided_to_tech_team']; ?></option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
          
        </select></td>
    </tr>
    <tr>

<td><button type="submit" name="submit" class="btn btn-success"><?php echo $resone = ($acadmicFeebackData[0]['handout_provided']=="")?("Save"):("Update"); ?></button></td>
</tr>
    </table>
  </form>
</div>


<div id="demo2" class="collapse">
<form action="insert_academic_feedback_data.php" method="POST">
  <table class="table table-bordered">
  <h3 style="text-align: center;">Student Interaction</h3>

  <tr style="display: none;">
      <td></td>
      <td><input type="hidden" name="checklistid" value="<?php echo $classDetails[0]['checklist id'];?>" ></td>
      <td><input type="hidden" name="section" value="section2" ></td>
    </tr>
    <tr>
        <td>Did the faculty primarily use Hindi/English<br> (as per the medium) for teaching and communication?</td>
        <td> <select class="form-control" id="useHindiEnglish" name="useHindiEnglish" required>
            <option value="<?php echo $acadmicFeebackData[0]['faculty_primarily_used_language']; ?>"><?php echo $acadmicFeebackData[0]['faculty_primarily_used_language']; ?></option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
        </select></td>
    </tr>
    <tr>
        <td>What percentage of time in the class the faculty used a secondary language?</td>
        <td><input type="number" class="form-control" id="percenatgeofSecondaryLanguage" name="percenatgeofSecondaryLanguage" value="<?php echo $acadmicFeebackData[0]['percentage_secondary_language']; ?>" required></td>
    </tr>
    <tr>
        <td>Transition from one topic to another was smooth and appropriate <br>time was given to the students to grasp before moving on to another topic?</td>
        <td> <select class="form-control" id="transitionOfTopic" name="transitionOfTopic" required>
            <option value="<?php echo $acadmicFeebackData[0]['transition_from_one_topic_to_another']; ?>"><?php echo $acadmicFeebackData[0]['transition_from_one_topic_to_another']; ?></option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
        </select></td>
    </tr>
    <tr>
        <td>Q/A related to class (including UPSC relevance)</td>
        <td> <select class="form-control" id="QARelatedToUPSC" name="QARelatedToUPSC" required>
            <option value="<?php echo $acadmicFeebackData[0]['QA_related_to_class_UPSC']; ?>"><?php echo $acadmicFeebackData[0]['QA_related_to_class_UPSC']; ?></option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
        </select></td>
    </tr>
    <tr>
        <td>Were questions asked by students during class?</td>
        <td> <select class="form-control" id="questionAskedByStudent" name="questionAskedByStudent" required>
            <option value="<?php echo $acadmicFeebackData[0]['question_by_student_during_class']; ?>"><?php echo $acadmicFeebackData[0]['question_by_student_during_class']; ?></option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
        </select></td>
    </tr>
    <tr>
        <td>Were there any questions not replied in the class (ignored or postponed)?</td>
        <td id="queryNotReplied_id"> <select class="form-control" id="queryNotReplied" name="queryNotReplied" required>
            <option value="<?php echo $acadmicFeebackData[0]['any_questions_not_replied_class']; ?>"><?php echo $acadmicFeebackData[0]['any_questions_not_replied_class']; ?></option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
        </select><br><textarea class="form-control" rows="5" id="queryNotRepliedcomment" name="queryNotRepliedcomment" style="display:none;" placeholder="Please list down the queries here"><?php echo $acadmicFeebackData[0]['question_not_replied_by_faculty_remark']; ?></textarea></td>
    </tr>
    <tr>
        <td>Were there any questions not replied from the prompter (ignored or postponed)?</td>
        <td id="QuestionPrompter_tr"> <select class="form-control" id="QuestionPrompter" name="QuestionPrompter" required>
            <option value="<?php echo $acadmicFeebackData[0]['any_questions_not_replied_from_the_prompter']; ?>"><?php echo $acadmicFeebackData[0]['any_questions_not_replied_from_the_prompter']; ?></option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
        </select><br><textarea class="form-control" rows="5" id="QuestionPromptercomment" name="QuestionPromptercomment" style="display:none;" placeholder="Please list down the queries here"><?php echo $acadmicFeebackData[0]['question_not_replied_by_faculty_prompter_remark']; ?></textarea></td>
    </tr>

    <tr>
        <td>Response Portal in the class?</td>
        <td> <select class="form-control" id="responseportalinclass" name="responseportalinclass" required>
            <option value="<?php echo $acadmicFeebackData[0]['response_portal_in_the_class']; ?>"><?php echo $acadmicFeebackData[0]['response_portal_in_the_class']; ?></option>
            <option value="Faculty took questions directly from the portal">Faculty took questions directly from the portal</option>
            <option value="Faculty used portal only for taking response">Faculty used portal only for taking response</option>
            <option value="Faculty kept the response portal off">Faculty kept the response portal off</option>
            <option value="Faculty ignored the response portal">Faculty ignored the response portal</option>
            <option value="Faculty used the response portal for both queries and responses">Faculty used the response portal for both queries and responses</option>

        </select></td>
    </tr>

    <tr>
        <td>After completion of class, a brief review of the class taken</td>
        <td> <select class="form-control" id="aftercompletionofclass" name="aftercompletionofclass" required>
            <option value="<?php echo $acadmicFeebackData[0]['brief_review_after_completion']; ?>"><?php echo $acadmicFeebackData[0]['brief_review_after_completion']; ?></option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
            
        </select></td>
    </tr>
    <tr>
        <td>Major Topics Covered Today</td>
        <td> <textarea class="form-control" rows="5" id="majortopiccomment" name="majortopiccomment" placeholder="Please Write Here" required><?php echo $acadmicFeebackData[0]['major_topics_covered']; ?></textarea></td>
    </tr>
    <tr>
        <td>Was assignment of class confirmed with faculty?</td>
        <td> <select class="form-control" id="assignmentQuestionwithfaculty" name="assignmentQuestionwithfaculty" required>
            <option value="<?php echo $acadmicFeebackData[0]['assignment_confirmed_with_faculty']; ?>"><?php echo $acadmicFeebackData[0]['assignment_confirmed_with_faculty']; ?></option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            <option value="Taken from pool of questions">Taken from pool of questions</option>
          
        </select></td>
    </tr>
    <tr>
        <td>What question was given as assignment question in today's class<br> (Write the whole questions here)</td>
        <td> <textarea class="form-control" rows="5" id="assignmentquestioncomment" name="assignmentquestioncomment" placeholder="Please Write Here" required><?php echo $acadmicFeebackData[0]['assignment_question_today_class']; ?></textarea></td>
    </tr>
    <tr>
        <td>Did students interact with faculty after the class?</td>
        <td> <select class="form-control" id="studentinterectfaculty" name="studentinterectfaculty" required>
            <option value="<?php echo $acadmicFeebackData[0]['students_interact_with_faculty']; ?>"><?php echo $acadmicFeebackData[0]['students_interact_with_faculty']; ?></option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
          
        </select></td>
    </tr>
    <tr>

    <td><button type="submit" name="submit" class="btn btn-success"><?php echo $restwo = ($acadmicFeebackData[0]['assignment_question_today_class']=="")?("Save"):("Update"); ?></button></td>
    </tr>
  </table>
</form>
</div>

<div id="demo3" class="collapse">
  <form action="insert_academic_feedback_data.php" method="POST">
<table class="table table-bordered">
<h3 style="text-align: center;">Class Performance</h3>
<tr style="display: none;">
      <td></td>
      <td><input type="hidden" name="checklistid" value="<?php echo $classDetails[0]['checklist id'];?>" ></td>
      <td><input type="hidden" name="section" value="section3" ></td>
    </tr>

    <tr>
      <?php 
      $preparation_for_classRating = $acadmicFeebackData[0]['preparation_for_class']; ?>
      
        <td>Preparation for the class <p>(Was the faculty prepared well for the class)</p></td>
        <td> <div class="form-check formcssradio"  style="display:inline;">
      <label class="form-check-label" for="radio1">
        <input type="radio" class="form-check-input radiosize" id="radio1" name="Preparationfortheclass" value="1" <?php echo $pre = ($preparation_for_classRating == 1)?("checked"):("");?>> 1
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio2">
        <input type="radio" class="form-check-input radiosize" id="radio2" name="Preparationfortheclass" value="2" <?php echo $pre = ($preparation_for_classRating == 2)?("checked"):("");?>> 2
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio3">
        <input type="radio" class="form-check-input radiosize" id="radio3" name="Preparationfortheclass" value="3" <?php echo $pre = ($preparation_for_classRating == 3)?("checked"):("");?>> 3
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio4">
        <input type="radio" class="form-check-input radiosize" id="radio4" name="Preparationfortheclass" value="4" <?php echo $pre = ($preparation_for_classRating == 4)?("checked"):("");?>> 4
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio5">
        <input type="radio" class="form-check-input radiosize" id="radio5" name="Preparationfortheclass" value="5" <?php echo $pre = ($preparation_for_classRating == 5)?("checked"):("");?>> 5
      </label>
    </div>
            
        <textarea class="form-control" rows="5" id="Preparationfortheclasscomment" name="Preparationfortheclasscomment" placeholder="Preparation for the class" required><?php echo $acadmicFeebackData[0]['preparation_for_class_text']; ?></textarea></td>
    </tr>
    <tr>
      <?php 
      $objective_of_classRating = $acadmicFeebackData[0]['objective_of_class'];
      
      
      ?>
        <td>Objective of class​ -<br> Did the faculty clearly state the objective of the class to the students?</td>
        <td> <div class="form-check formcssradio"  style="display:inline;">
      <label class="form-check-label" for="radio1">
        <input type="radio" class="form-check-input radiosize" id="radio1" name="Objectiveofclas" value="1" <?php echo $obj = ($objective_of_classRating == 1)?("checked"):("");?>> 1
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio2">
        <input type="radio" class="form-check-input radiosize" id="radio2" name="Objectiveofclas" value="2" <?php echo $obj = ($objective_of_classRating == 2)?("checked"):("");?>> 2
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="Objectiveofclas" value="3" <?php echo $obj = ($objective_of_classRating == 3)?("checked"):("");?>> 3
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="Objectiveofclas" value="4" <?php echo $obj = ($objective_of_classRating == 4)?("checked"):("");?>> 4
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="Objectiveofclas" value="5" <?php echo $obj = ($objective_of_classRating == 5)?("checked"):("");?>> 5
      </label>
    </div>
            
        <textarea class="form-control" rows="5" id="Objectiveofclascomment" name="Objectiveofclascomment" placeholder="Objective of class​ - Did the faculty clearly state the objective of the class to the students?" required><?php echo $acadmicFeebackData[0]['objective_of_class_text']; ?></textarea></td>
    </tr>
    <tr>
      <?php 
      $command_over_contentRating = $acadmicFeebackData[0]['command_over_content'];
      
      
      
      ?>
    <td>Command over the content</td>
        <td> <div class="form-check formcssradio"  style="display:inline;">
      <label class="form-check-label" for="radio1">
        <input type="radio" class="form-check-input radiosize" id="radio1" name="Commandoverthecontent" value="1" <?php echo $com = ($command_over_contentRating == 1)?("checked"):("");?>> 1
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio2">
        <input type="radio" class="form-check-input radiosize" id="radio2" name="Commandoverthecontent" value="2" <?php echo $com = ($command_over_contentRating == 2)?("checked"):("");?>> 2
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="Commandoverthecontent" value="3" <?php echo $com = ($command_over_contentRating == 3)?("checked"):("");?>> 3
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="Commandoverthecontent" value="4" <?php echo $com = ($command_over_contentRating == 4)?("checked"):("");?>> 4
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="Commandoverthecontent" value="5" <?php echo $com = ($command_over_contentRating == 5)?("checked"):("");?>> 5
      </label>
    </div>
            
        <textarea class="form-control" rows="5" id="Commandoverthecontentcomment" name="Commandoverthecontentcomment" placeholder="Command over the content" required><?php echo $acadmicFeebackData[0]['command_over_content_text'];?></textarea></td>
    </tr>
    <tr>
      <?php 
      
      $use_of_examplesRating = $acadmicFeebackData[0]['use_of_examples'];
      
      ?>
    <td>Use of Examples<p>(Were simple and relatable examples given in the class)</p></td>
        <td> <div class="form-check formcssradio"  style="display:inline;">
      <label class="form-check-label" for="radio1">
        <input type="radio" class="form-check-input radiosize" id="radio1" name="UseofExamples" value="1" <?php echo $use = ($use_of_examplesRating == 1)?("checked"):("");?>> 1
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio2">
        <input type="radio" class="form-check-input radiosize" id="radio2" name="UseofExamples" value="2" <?php echo $use = ($use_of_examplesRating == 2)?("checked"):("");?>> 2
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="UseofExamples" value="3" <?php echo $use = ($use_of_examplesRating == 3)?("checked"):("");?>> 3
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="UseofExamples" value="4" <?php echo $use = ($use_of_examplesRating == 4)?("checked"):("");?>> 4
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="UseofExamples" value="5" <?php echo $use = ($use_of_examplesRating == 5)?("checked"):("");?>> 5
      </label>
    </div>
            
        <textarea class="form-control" rows="5" id="UseofExamplescomment" name="UseofExamplescomment" placeholder="Use of Examples" required><?php echo $acadmicFeebackData[0]['use_of_examples_text'];?></textarea></td>
    </tr>
    <tr>
      <?php 
      $organization_of_contentRating = $acadmicFeebackData[0]['organization_of_content'];
      
      ?>
    <td>Organization of content<p>(Was the class structured in a logical manner <br>that would have helped students to understand?)</p></td>
        <td> <div class="form-check formcssradio"  style="display:inline;">
      <label class="form-check-label" for="radio1">
        <input type="radio" class="form-check-input radiosize" id="radio1" name="Organizationofcontent" value="1" <?php echo $org = ($organization_of_contentRating == 1)?("checked"):("");?>> 1
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio2">
        <input type="radio" class="form-check-input radiosize" id="radio2" name="Organizationofcontent" value="2" <?php echo $org = ($organization_of_contentRating == 2)?("checked"):("");?>> 2
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="Organizationofcontent" value="3" <?php echo $org = ($organization_of_contentRating == 3)?("checked"):("");?>> 3
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="Organizationofcontent" value="4" <?php echo $org = ($organization_of_contentRating == 4)?("checked"):("");?>> 4
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="Organizationofcontent" value="5" <?php echo $org = ($organization_of_contentRating == 5)?("checked"):("");?>> 5
      </label>
    </div>
            
        <textarea class="form-control" rows="5" id="Organizationofcontentcomment" name="Organizationofcontentcomment" placeholder="Organization of content" required><?php echo $acadmicFeebackData[0]['organization_of_content_text']; ?></textarea></td>
    </tr>

    <tr>
        <td>Was dictation provided in the class?</td>
        <td id="dictationinclass_td"> <select class="form-control" id="dictationinclass" name="dictationinclass" required>
            <option value="<?php echo $acadmicFeebackData[0]['dictation_in_class']; ?>"><?php echo $acadmicFeebackData[0]['dictation_in_class']; ?></option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
          
        </select></td>
    </tr>
    <tr style="display: none;" id="chunk">
        <td>Was the dictation provided in big chunks or part wise along with the flow of class?</td>
        <td> <select class="form-control" id="dictationinclasschunk" name="dictationinclasschunk">
            <option value="<?php echo $acadmicFeebackData[0]['dictation_provided_in_big_chunks']; ?>"><?php echo $acadmicFeebackData[0]['dictation_provided_in_big_chunks']; ?></option>
            <option value="Very long dictation was provided in one stretch">Very long dictation was provided in one stretch</option>
            <option value="Short dictations were provided from time to time">Short dictations were provided from time to time</option>
            
          
        </select></td>
    </tr>
    <tr style="display: none;" id="noofpag">
        <td>Approximately how many pages were dictated in the class?</td>
        <td><input type="number" class="form-control" id="Approximatelypages" name="Approximatelypages" value="<?php echo $acadmicFeebackData[0]['no_pages_dictated_in_class']; ?>"></td>
    </tr>

    <tr>
    <td>Link with Current Affairs</td>
    <?php 
    $link_with_current_affairsRating = $acadmicFeebackData[0]['link_with_current_affairs'];
    
    
    ?>
        <td id="linkwithcurrentaffair_id">  <select class="form-control" id="linkwithcurrentaffair" name="linkwithcurrentaffair" required>
            <option value="<?php echo $acadmicFeebackData[0]['linkwithcurrentaffair']; ?>"><?php echo $acadmicFeebackData[0]['linkwithcurrentaffair']; ?></option>
            <option value="Applicable">Applicable</option>
            <option value="Not Applicable">Not Applicable</option>
            
          
        </select><div class="form-check formcssradio displaynone">
      <label class="form-check-label" for="radio1">
        <input type="radio" class="form-check-input radiosize" id="radio1" name="LinkwithCurrentAffairsrating" value="1" <?php echo $link = ($link_with_current_affairsRating == 1)?("checked"):("");?>> 1
      </label>
    </div>
    <div class="form-check formcssradio displaynone">
      <label class="form-check-label" for="radio2">
        <input type="radio" class="form-check-input radiosize" id="radio2" name="LinkwithCurrentAffairsrating" value="2" <?php echo $link = ($link_with_current_affairsRating == 2)?("checked"):("");?>> 2
      </label>
    </div>
    <div class="form-check formcssradio displaynone">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="LinkwithCurrentAffairsrating" value="3" <?php echo $link = ($link_with_current_affairsRating == 3)?("checked"):("");?>> 3
      </label>
    </div>
    <div class="form-check formcssradio displaynone">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="LinkwithCurrentAffairsrating" value="4" <?php echo $link = ($link_with_current_affairsRating == 4)?("checked"):("");?>> 4
      </label>
    </div>
    <div class="form-check formcssradio displaynone">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="LinkwithCurrentAffairsrating" value="5" <?php echo $link = ($link_with_current_affairsRating == 5)?("checked"):("");?>> 5
      </label>
    </div>
       
    </tr>
    <tr>
        <td>Was the lecture focussed on both prelims and mains exam?</td>
        <td> <select class="form-control" id="lectureFocussed" name="lectureFocussed" required>
            <option value="<?php echo $acadmicFeebackData[0]['lecture_focussed_on']; ?>"><?php echo $acadmicFeebackData[0]['lecture_focussed_on']; ?></option>
            <option value="Only Prelims">Only Prelims</option>
            <option value="Only Mains">Only Mains</option>
            <option value="Both - Prelims and Mains">Both - Prelims and Mains</option>
            
          
        </select></td>
    </tr>
    <tr>
        <td>Factual errors or conceptual lags</td>
        <td> <select class="form-control" id="Factualerrors" name="Factualerrors" required>
            <option value="<?php echo $acadmicFeebackData[0]['factual_errors_or_conceptual_lags']; ?>"><?php echo $acadmicFeebackData[0]['factual_errors_or_conceptual_lags']; ?></option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
          
        </select><br><textarea class="form-control" rows="5" id="Factualerrorscomment" name="Factualerrorscomment" placeholder="Factual errors or conceptual lags" required><?php echo $acadmicFeebackData[0]['factual_errors_or_conceptual_lags_text']; ?></textarea>
    </td>
    </tr>
    <tr>
      <?php 
       $time_managementRating = $acadmicFeebackData[0]['time_management'];
      
      ?>
    <td>Time Management​</td>
        <td> <div class="form-check formcssradio"  style="display:inline;">
      <label class="form-check-label" for="radio1">
        <input type="radio" class="form-check-input radiosize" id="radio1" name="TimeManagement" value="1" <?php echo $time = ($time_managementRating == 1)?("checked"):("");?>> 1
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio2">
        <input type="radio" class="form-check-input radiosize" id="radio2" name="TimeManagement" value="2" <?php echo $time = ($time_managementRating == 2)?("checked"):("");?>> 2
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="TimeManagement" value="3" <?php echo $time = ($time_managementRating == 3)?("checked"):("");?>> 3
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="TimeManagement" value="4" <?php echo $time = ($time_managementRating == 4)?("checked"):("");?>> 4
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="TimeManagement" value="5" <?php echo $time = ($time_managementRating == 5)?("checked"):("");?>> 5
      </label>
    </div><textarea class="form-control" rows="5" id="TimeManagementcomment" name="TimeManagementcomment" placeholder="Time Management" required><?php echo $acadmicFeebackData[0]['time_management_text']; ?></textarea></td>
       
    </tr>
    <tr>
      <?php 
      $pace_of_the_classRating = $acadmicFeebackData[0]['pace_of_the_class'];
      
      ?>
    <td>Pace of the class</td>
        <td> <div class="form-check formcssradio"  style="display:inline;">
      <label class="form-check-label" for="radio1">
        <input type="radio" class="form-check-input radiosize" id="radio1" name="Paceoftheclas" value="Optimal Speed" <?php echo $pace = ($pace_of_the_classRating == 'Optimal Speed')?("checked"):("");?>> Optimal Speed
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio2">
        <input type="radio" class="form-check-input radiosize" id="radio2" name="Paceoftheclas" value="Faster than required" <?php echo $pace = ($pace_of_the_classRating == 'Faster than required')?("checked"):("");?>> Faster than required
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="Paceoftheclas" value="Slower than required" <?php echo $pace = ($pace_of_the_classRating == 'Slower than required')?("checked"):("");?>> Slower than required
      </label>
    </div></td>
       
    </tr>
    <tr>
      <?php 
      
      $use_of_smart_boardRating = $acadmicFeebackData[0]['use_of_smart_board'];
      ?>
    <td>Use of Smart Board / PPT</td>
        <td> <div class="form-check formcssradio"  style="display:inline;">
      <label class="form-check-label" for="radio1">
        <input type="radio" class="form-check-input radiosize" id="radio1" name="UseofSmartBoard" value="1" <?php echo $board = ($use_of_smart_boardRating == 1)?("checked"):("");?>> 1
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio2">
        <input type="radio" class="form-check-input radiosize" id="radio2" name="UseofSmartBoard" value="2" <?php echo $board = ($use_of_smart_boardRating == 2)?("checked"):("");?>> 2
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="UseofSmartBoard" value="3" <?php echo $board = ($use_of_smart_boardRating == 3)?("checked"):("");?>> 3
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="UseofSmartBoard" value="4" <?php echo $board = ($use_of_smart_boardRating == 4)?("checked"):("");?>> 4
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="UseofSmartBoard" value="5" <?php echo $board = ($use_of_smart_boardRating == 5)?("checked"):("");?>> 5
      </label>
    </div><textarea class="form-control" rows="5" id="UseofSmartBoardcomment" name="UseofSmartBoardcomment" placeholder="Use of Smart Board / PPT" required><?php echo $acadmicFeebackData[0]['use_of_smart_board_text'];?></textarea></td>
       
    </tr>
    <tr>
      <?php 
      $energy_level_and_communicationRating = $acadmicFeebackData[0]['energy_level_and_communication'];
      
      ?>
    <td>Energy level and communication</td>
        <td> <div class="form-check formcssradio"  style="display:inline;">
      <label class="form-check-label" for="radio1">
        <input type="radio" class="form-check-input radiosize" id="radio1" name="Energylevel" value="1" <?php echo $energy = ($energy_level_and_communicationRating == 1)?("checked"):("");?>> 1
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio2">
        <input type="radio" class="form-check-input radiosize" id="radio2" name="Energylevel" value="2" <?php echo $energy = ($energy_level_and_communicationRating == 2)?("checked"):("");?>> 2
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="Energylevel" value="3" <?php echo $energy = ($energy_level_and_communicationRating == 3)?("checked"):("");?>> 3
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="Energylevel" value="4" <?php echo $energy = ($energy_level_and_communicationRating == 4)?("checked"):("");?>> 4
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="Energylevel" value="5" <?php echo $energy = ($energy_level_and_communicationRating == 5)?("checked"):("");?>> 5
      </label>
    </div><textarea class="form-control" rows="5" id="Energylevelcomment" name="Energylevelcomment" placeholder="Energy level and communication" required><?php echo $acadmicFeebackData[0]['energy_level_and_communication_text'];?></textarea></td>
       
    </tr>
    <tr>

    <td><button type="submit" name="submit" class="btn btn-success"><?php echo $resthree = ($acadmicFeebackData[0]['link_with_current_affairs']=="")?("Save"):("Update"); ?></button></td>
    </tr>
</table>
  </form>
</div>

<div id="demo4" class="collapse">
  <form action="insert_academic_feedback_data.php" method="POST">
    <table class="table table-bordered">
    <h3 style="text-align: center;">Your Feedback</h3>
    <tr style="display: none;">
      <td></td>
      <td><input type="hidden" name="checklistid" value="<?php echo $classDetails[0]['checklist id'];?>" ></td>
      <td><input type="hidden" name="section" value="section4" ></td>
    </tr>
  
    <tr>
    <td>Did the faculty meet your expectations?</td>
        <td id="facultymeetexpectation_id"><select class="form-control" id="facultymeetexpectation" name="facultymeetyourexpectations" required>
            <option value="<?php echo $acadmicFeebackData[0]['faculty_meet_your_expectations'];?>"><?php echo $acadmicFeebackData[0]['faculty_meet_your_expectations'];?></option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
          
        </select></td>
       
    </tr>

    <tr id="whatDifferencedone" style="display: none;">
        <td>What different you would have done?</td>
        <td> <textarea class="form-control" rows="5" id="differencedonecomment" name="differencedonecomment" placeholder="Please Write Here" ><?php echo $acadmicFeebackData[0]['different_done_you']; ?></textarea></td>
    </tr>
    <tr>
    <?php
    
    $overall_rating_for_the_classRating = $acadmicFeebackData[0]['overall_rating_for_the_class'];
    
    
    ?>
    <td>Overall Rating for the Class</td>
        <td> <div class="form-check formcssradio"  style="display:inline;">
      <label class="form-check-label" for="radio1">
        <input type="radio" class="form-check-input radiosize" id="radio1" name="ratingofclass" value="1" <?php echo $overall = ($overall_rating_for_the_classRating == 1)?("checked"):("");?>> 1
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio2">
        <input type="radio" class="form-check-input radiosize" id="radio2" name="ratingofclass" value="2" <?php echo $overall = ($overall_rating_for_the_classRating == 2)?("checked"):("");?>> 2
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="ratingofclass" value="3" <?php echo $overall = ($overall_rating_for_the_classRating == 3)?("checked"):("");?>> 3
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="ratingofclass" value="4" <?php echo $overall = ($overall_rating_for_the_classRating == 4)?("checked"):("");?>> 4
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="ratingofclass" value="5" <?php echo $overall = ($overall_rating_for_the_classRating == 5)?("checked"):("");?>> 5
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="ratingofclass" value="6" <?php echo $overall = ($overall_rating_for_the_classRating == 6)?("checked"):("");?>> 6
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="ratingofclass" value="7" <?php echo $overall = ($overall_rating_for_the_classRating == 7)?("checked"):("");?>> 7
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="ratingofclass" value="8" <?php echo $overall = ($overall_rating_for_the_classRating == 8)?("checked"):("");?>> 8
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="ratingofclass" value="9" <?php echo $overall = ($overall_rating_for_the_classRating == 9)?("checked"):("");?>> 9
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="ratingofclass" value="10" <?php echo $overall = ($overall_rating_for_the_classRating == 10)?("checked"):("");?>> 10
      </label>
    </div></td>
       
    </tr>
    <tr>
      <?php 
      $management_technical_issueStatus = $acadmicFeebackData[0]['management_technical_issue'];
      $specific_issue_highlighted_by_studentsStatus = $acadmicFeebackData[0]['specific_issue_highlighted_by_students'];
      $any_other_feedbackStatus = $acadmicFeebackData[0]['any_other_feedback'];
      
      ?>
        <td>feedback (Miscellaneous)</td>
        <td>
        <input type="checkbox" id="atAnyPoint" name="atAnyPoint" value="Yes" <?php echo $atAnyPo = ($management_technical_issueStatus =="Yes")?("checked"):(""); ?>> Any other points including any management/technical issue<br>
         
        <textarea class="form-control" rows="5" id="atAnyPointcomment" name="atAnyPointcomment" placeholder="Please Enter The details" style="display:none;"><?php echo $acadmicFeebackData[0]['management_technical_issue_remark']; ?></textarea><br>



        <input type="checkbox" id="issueHighlighted" name="issueHighlighted" value="Yes" <?php echo $highlight = ($specific_issue_highlighted_by_studentsStatus =="Yes")?("checked"):(""); ?>> Any Specific issue highlighted or request made by student in today's
        class regarding anything related to Vision IAS services 
    
            <br> <textarea class="form-control" rows="5" id="issueHighlightedcomment" name="issueHighlightedcomment" placeholder="Please Write Here" style="display:none;"><?php echo $acadmicFeebackData[0]['issue_highlight_by_student_remark']; ?></textarea><br>



            <input type="checkbox" id="anyOtherFeedback" name="anyOtherFeedback" value="Yes" <?php echo $anuother = ($any_other_feedbackStatus =="Yes")?("checked"):(""); ?>> Any other Feedback<br>
        
        <textarea class="form-control" rows="5" id="anyOtherFeedbackcomment" name="anyOtherFeedbackcomment" placeholder="Please Enter The details" style="display:none;"><?php echo $acadmicFeebackData[0]['any_other_feedback_comment'];?></textarea>
        </td>
    </tr>
    <tr>
        <td>Any Video Portion Needs to be removed?</td>
        <td id="videoremoveportion_td"> <select class="form-control" id="videoremoveportion" name="videoremoveportion" required>
            <option value="<?php echo $acadmicFeebackData[0]['video_portion_removed'];?>"><?php echo $acadmicFeebackData[0]['video_portion_removed'];?></option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
          
        </select><br>
        <?php 
        $videoremark = explode(",",$acadmicFeebackData[0]['video_portion_need_to_cut_remark']);
        // echo "<pre>";
        // print_r($videoremark); 
        ?>
        <div id="videoremoveportioncomment" style="display: none;">
        <input type="checkbox" class="" name="Controversial_Remark" value="Controversial Remark (Religious/Political etc)" <?php echo $Variable1 = ($videoremark[0]=="") ? ("") : ("checked"); ?>> Controversial Remark (Religious/Political etc)<br>
        <input type="checkbox" class="" name="Irrelevant_Avoidable_deviations" value="Irrelevant and Avoidable deviations" <?php echo $Variable2 = ($videoremark[1]=="") ? ("") : ("checked"); ?>> Irrelevant and Avoidable deviations<br>
        <input type="checkbox" class="" name="Behaviour_Issue" value="Behaviour Issue (With Student or staff etc)" <?php echo $Variable3 = ($videoremark[2]=="") ? ("") : ("checked"); ?>> Behaviour Issue (With Student,staff etc)<br>
        <input type="checkbox" class="" name="Loose_Comments" value="Loose Comments/Rearkes" <?php echo $Variable4 = ($videoremark[3]=="") ? ("") : ("checked"); ?>> Loose Comments/Rearkes<br>
        <input type="checkbox" class="" name="others" value="Others" <?php echo $Variable5 = ($videoremark[4]=="") ? ("") : ("checked"); ?>> Others<br>
        <!-- <textarea class="form-control" rows="5" class="videoremoveportioncomment" name="videoremoveportioncomment" placeholder="Please Enter The details"></textarea></div> -->
    </td>
    </tr>
    <tr>
        <td> Request for Feedback form sent to classroom team? (Only if it was the third class of the subject)</td>
        <td> <select class="form-control" id="feedbackforclassroomteam" name="feedbackforclassroomteam" required>
            <option value="<?php echo $acadmicFeebackData[0]['feedback_form_classroom_team'];?>"><?php echo $acadmicFeebackData[0]['feedback_form_classroom_team'];?></option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            <option value="NA (Not the third class)">NA (Not the third class)</option>
            
            
          
        </select>
    </td>
    </tr>
    <tr>

    <td><button type="submit" name="submit" class="btn btn-success"><?php echo $resfour = ($acadmicFeebackData[0]['feedback_form_classroom_team']=="")?("Save"):("Update"); ?></button></td>
    </tr>
   

  </table>
</div>
</div>
</div>
</form>
<script src="js/academicForm.js"></script>
<script>
$(document).ready(function(){
  $('#demoo').on("click",function(){
    $('#demo').toggle();
    $('#demo1').hide();
    $('#demo2').hide();
    $('#demo3').hide();
    $('#demo4').hide();

  })
  $("#demoo1").on("click",function(){
    $('#demo').hide();
    $('#demo1').toggle();
    $('#demo2').hide();
    $('#demo3').hide();
    $('#demo4').hide();
  })
  $("#demoo2").on("click",function(){
    $('#demo').hide();
    $('#demo1').hide();
    $('#demo2').toggle();
    $('#demo3').hide();
    $('#demo4').hide();
  })
  $("#demoo3").on("click",function(){
    $('#demo').hide();
    $('#demo1').hide();
    $('#demo2').hide();
    $('#demo3').toggle();
    $('#demo4').hide();
  })
  $("#demoo4").on("click",function(){
    $('#demo').hide();
    $('#demo1').hide();
    $('#demo2').hide();
    $('#demo3').hide();
    $('#demo4').toggle();
  })
})

</script>
</body>

