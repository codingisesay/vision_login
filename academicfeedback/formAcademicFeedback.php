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
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
</style>
</head>

<body>
    <?php 
    
    include('academicfeedbackNavBar.php');
    
    $classID = $_REQUEST['class_id'];
    $classDetails = classDetailsFromClassID($classID);
    // echo "<pre>";
    // print_r($classDetails);
    
    
    ?>
<div class="container-fluid" style="background-color: rgba(0,0,0,0.1);">
<div class="container" style="background-color: white;">
<form action="insert_academic_feedback_data.php" method="POST">
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
    <!-- <tr>
        <td>Medium</td>
        <td>English</td>
    </tr> -->
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
    <tr>
        <td>Class Start Time</td>
        <td><input type="time" class="form-control" id="usr" name ="ClassStartTime" required></td>
    </tr>
    <tr>
        <td>Is class Delay?</td>
        <td id="resionfordelay_td"> <select class="form-control" id="resionfordelay" name="resionfordelay" required>
            <option value="">Select Any One</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select><br><textarea class="form-control" rows="5" id="resionfordelaycomment" name="resionfordelaycomment" placeholder="Reason for Delay" style="display:none;"></textarea></td>
    </tr>
    <!-- <tr>
        <td>Break Time</td>
        <td><input type="time" class="form-control" id="usr"></td>
    </tr>
    <tr>
        <td>Break Duration</td>
        <td><input type="text" class="form-control" id="usr"></td>
    </tr> -->
    <tr>
        <td>End Time</td>
        <td><input type="time" class="form-control" id="usr" name="ClassEndTime" required></td>
    </tr>
    <tr>
        <td>If the class ended early, reasons for the same</td>
        <td id="classendeatlyremark_id"> <select class="form-control" id="classendeatlyremark" name="classendeatlyremark" required>
            <option value="">Select Any One</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select><br> <textarea class="form-control" rows="5" id="classendeatlyremarkcomment" name="classendeatlyremarkcomment" placeholder="Please Write Here" style="display:none;"></textarea></td>
    </tr>
    <tr>
        <td>Video/Synopsis/AQ/STQ/Handouts/PPTs <br> of the previous class correctly uploaded<br>
         (Irrespective of which batch coordinator attended that class)</td>
        <td id="videoSynopsis_td"> <select class="form-control" id="videoSynopsis" name="videoSynopsis" required>
            <option value="">Select Any One</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select><br><textarea class="form-control" rows="5" id="videoSynopsiscomment" name="videoSynopsiscomment" placeholder="Write Reason Here" style="display:none;"></textarea></td>
    </tr>
    <tr>
        <td>Synopsis of previous class was shown on projector before Faculty entered</td>
        <td id="synopsisPrevious_td"> <select class="form-control" id="synopsisPrevious" name="synopsisPrevious" required>
            <option value="">Select Any One</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select><br><textarea class="form-control" rows="5" id="synopsisPreviouscomment" name="synopsisPreviouscomment" placeholder="Write Reason Here" style="display:none;"></textarea></td>
    </tr>
    <tr>
        <td>Brief review of the previous class?</td>
        <td> <select class="form-control" id="briefReview" name="briefReview" required>
            <option value="">Select Any One</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select></td>
    </tr>
    <tr>
        <td>Q/A related to previous class?</td>
        <td> <select class="form-control" id="QAPreviousClass" name="QAPreviousClass" required>
            <option value="">Select Any One</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select></td>
    </tr>
    <tr>
        <td>Were doubts rephrased/repeated to the class for the online students?</td>
        <td> <select class="form-control" id="doubtsRephrasedRepeated" name="doubtsRephrasedRepeated" required>
            <option value="">Select Any One</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            <option value="Very Few">Very Few</option>
        </select></td>
    </tr>
    <!-- <tr>
        <td>Was the class given chance to respond to student’s doubt?</td>
        <td> <select class="form-control">
            <option>Select Any One</option>
            <option>Yes</option>
            <option>No</option>
            <option>Very Few</option>
        </select></td>
    </tr> -->
    <tr>
        <td>Number of LIVE Queries asked in the Class (approx.)</td>
        <td><input type="number" class="form-control" id="numberOfLiveQuery" name="numberOfLiveQuery" required></td>
    </tr>
    <tr>
        <td>Did the faculty primarily used Hindi/English<br> (as per the medium) for teaching and communication</td>
        <td> <select class="form-control" id="useHindiEnglish" name="useHindiEnglish" required>
            <option value="">Select Any One</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
        </select></td>
    </tr>
    <tr>
        <td>What percentage of time in the class the faculty used a secondary language?</td>
        <td><input type="number" class="form-control" id="percenatgeofSecondaryLanguage" name="percenatgeofSecondaryLanguage" required></td>
    </tr>
    <tr>
        <td>Transition from one topic to another was smooth and appropriate <br>time was given to the students to grasp before moving on to another topic?</td>
        <td> <select class="form-control" id="transitionOfTopic" name="transitionOfTopic" required>
            <option value="">Select Any One</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
        </select></td>
    </tr>
    <tr>
        <td>Q/A related to class (including UPSC relevance)</td>
        <td> <select class="form-control" id="QARelatedToUPSC" name="QARelatedToUPSC" required>
            <option value="">Select Any One</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
        </select></td>
    </tr>
    <tr>
        <td>Were questions asked by students during class?</td>
        <td> <select class="form-control" id="questionAskedByStudent" name="questionAskedByStudent" required>
            <option value="">Select Any One</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
        </select></td>
    </tr>
    <tr>
        <td>Were there any questions not replied in the class (ignored or postponed)?</td>
        <td id="queryNotReplied_id"> <select class="form-control" id="queryNotReplied" name="queryNotReplied" required>
            <option value="">Select Any One</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
        </select><br><textarea class="form-control" rows="5" id="queryNotRepliedcomment" name="queryNotRepliedcomment" style="display:none;" placeholder="Please list down the queries here"></textarea></td>
    </tr>
    <tr>
        <td>Were there any questions not replied from the prompter (ignored or postponed)?</td>
        <td id="QuestionPrompter_tr"> <select class="form-control" id="QuestionPrompter" name="QuestionPrompter" required>
            <option value="">Select Any One</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
        </select><br><textarea class="form-control" rows="5" id="QuestionPromptercomment" name="QuestionPromptercomment" style="display:none;" placeholder="Please list down the queries here"></textarea></td>
    </tr>
    <tr>
        <td>Response Portal in the class?</td>
        <td> <select class="form-control" id="responseportalinclass" name="responseportalinclass" required>
            <option value="">Select Any One</option>
            <option value="Faculty took questions directly from the portal">Faculty took questions directly from the portal</option>
            <option value="Faculty used portal only for taking response">Faculty used portal only for taking response</option>
            <option value="Faculty kept the response portal off">Faculty kept the response portal off</option>
            <option value="Faculty ignored the response portal">Faculty ignored the response portal</option>

        </select></td>
    </tr>
    <!-- <tr>
        <td>Did the faculty take questions directly from the response portal?</td>
        <td> <select class="form-control">
            <option>Select Any One</option>
            <option>Yes</option>
            <option>No</option>
            <option>N/A</option>
            
        </select></td>
    </tr> -->
    <tr>
        <td>After completion of class, a brief review of the class taken</td>
        <td> <select class="form-control" id="aftercompletionofclass" name="aftercompletionofclass" required>
            <option value="">Select Any One</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
            
        </select></td>
    </tr>
    <tr>
        <td>Major Topics Covered Today</td>
        <td> <textarea class="form-control" rows="5" id="majortopiccomment" name="majortopiccomment" placeholder="Please Write Here" required></textarea></td>
    </tr>
    <tr>
        <td>Was assignment of class confirmed with faculty?</td>
        <td> <select class="form-control" id="assignmentQuestionwithfaculty" name="assignmentQuestionwithfaculty" required>
            <option value="">Select Any One</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            <option value="Taken from pool of questions">Taken from pool of questions</option>
          
        </select></td>
    </tr>
    <tr>
        <td>What question was given as assignment question in today's class<br> (Write the whole questions here)</td>
        <td> <textarea class="form-control" rows="5" id="assignmentquestioncomment" name="assignmentquestioncomment" placeholder="Please Write Here" required></textarea></td>
    </tr>
    <tr>
        <td>Any Specific Issue Highlighted by Students - Online/Offline regarding class today</td>
        <td id="specificissuehighlight_tr"><select class="form-control" id="specificissuehighlight" name="specificissuehighlight" required>
            <option value="">Select Any One</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option></select><br> <textarea class="form-control" rows="5" id="specificissuehighlightcomment" name="specificissuehighlightcomment" placeholder="Please Write Here" style="display: none;"></textarea></td>
    </tr>
    <tr>
        <td>Did students interact with faculty after the class?</td>
        <td> <select class="form-control" id="studentinterectfaculty" name="studentinterectfaculty" required>
            <option value="">Select Any One</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
          
        </select></td>
    </tr>
    <tr>
        <td>Any handout provided in the class?</td>
        <td> <select class="form-control" id="hanoutinclass" name="hanoutinclass" required>
            <option value="">Select Any One</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
          
        </select></td>
    </tr>
    <tr>
        <td>A Handout provided in the class was sent to the tech team for uploading?</td>
        <td> <select class="form-control" id="handoutToTechteam" name="handoutToTechteam" required>
            <option value="">Select Any One</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
          
        </select></td>
    </tr>
    <tr>
        <td>Any other points including any management/technical issue</td>
        <td id="managementtechnicalissue_tr"> <select class="form-control" id="managementtechnicalissue" name="managementtechnicalissue" required>
            <option value="">Select Any One</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
          
        </select><br><textarea class="form-control" rows="5" id="managementtechnicalissuecomment" name="managementtechnicalissuecomment" placeholder="Please Write Here" style="display:none;"></textarea></td>
    </tr>
    <!-- <tr>
        <td>Any other observation from the class that the management should be aware of</td>
        <td> <textarea class="form-control" rows="5" id="comment"></textarea></td>
    </tr> -->
    <tr>
        <td>Preparation for the class</td>
        <td> <div class="form-check formcssradio"  style="display:inline;">
      <label class="form-check-label" for="radio1">
        <input type="radio" class="form-check-input radiosize" id="radio1" name="Preparationfortheclass" value="1" checked> 1
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio2">
        <input type="radio" class="form-check-input radiosize" id="radio2" name="Preparationfortheclass" value="2"> 2
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio3">
        <input type="radio" class="form-check-input radiosize" id="radio3" name="Preparationfortheclass" value="3"> 3
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio4">
        <input type="radio" class="form-check-input radiosize" id="radio4" name="Preparationfortheclass" value="4"> 4
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio5">
        <input type="radio" class="form-check-input radiosize" id="radio5" name="Preparationfortheclass" value="5"> 5
      </label>
    </div>
            
        <textarea class="form-control" rows="5" id="Preparationfortheclasscomment" name="Preparationfortheclasscomment" placeholder="Preparation for the class" required></textarea></td>
    </tr>
    <tr>
        <td>Objective of class​ - Did the faculty clearly state the objective of the class to the students?</td>
        <td> <div class="form-check formcssradio"  style="display:inline;">
      <label class="form-check-label" for="radio1">
        <input type="radio" class="form-check-input radiosize" id="radio1" name="Objectiveofclas" value="1" checked> 1
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio2">
        <input type="radio" class="form-check-input radiosize" id="radio2" name="Objectiveofclas" value="2"> 2
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="Objectiveofclas" value="3"> 3
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="Objectiveofclas" value="4"> 4
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="Objectiveofclas" value="5"> 5
      </label>
    </div>
            
        <textarea class="form-control" rows="5" id="Objectiveofclascomment" name="Objectiveofclascomment" placeholder="Objective of class​ - Did the faculty clearly state the objective of the class to the students?" required></textarea></td>
    </tr>
    <tr>
    <td>Command over the content</td>
        <td> <div class="form-check formcssradio"  style="display:inline;">
      <label class="form-check-label" for="radio1">
        <input type="radio" class="form-check-input radiosize" id="radio1" name="Commandoverthecontent" value="1" checked> 1
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio2">
        <input type="radio" class="form-check-input radiosize" id="radio2" name="Commandoverthecontent" value="2"> 2
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="Commandoverthecontent" value="3"> 3
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="Commandoverthecontent" value="4"> 4
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="Commandoverthecontent" value="5"> 5
      </label>
    </div>
            
        <textarea class="form-control" rows="5" id="Commandoverthecontentcomment" name="Commandoverthecontentcomment" placeholder="Command over the content" required></textarea></td>
    </tr>
    <tr>
    <td>Use of Examples​</td>
        <td> <div class="form-check formcssradio"  style="display:inline;">
      <label class="form-check-label" for="radio1">
        <input type="radio" class="form-check-input radiosize" id="radio1" name="UseofExamples" value="1" checked> 1
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio2">
        <input type="radio" class="form-check-input radiosize" id="radio2" name="UseofExamples" value="2"> 2
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="UseofExamples" value="3"> 3
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="UseofExamples" value="4"> 4
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="UseofExamples" value="5"> 5
      </label>
    </div>
            
        <textarea class="form-control" rows="5" id="UseofExamplescomment" name="UseofExamplescomment" placeholder="Use of Examples" required></textarea></td>
    </tr>
    <tr>
    <td>Organization of content​</td>
        <td> <div class="form-check formcssradio"  style="display:inline;">
      <label class="form-check-label" for="radio1">
        <input type="radio" class="form-check-input radiosize" id="radio1" name="Organizationofcontent" value="1" checked> 1
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio2">
        <input type="radio" class="form-check-input radiosize" id="radio2" name="Organizationofcontent" value="2"> 2
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="Organizationofcontent" value="3"> 3
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="Organizationofcontent" value="4"> 4
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="Organizationofcontent" value="5"> 5
      </label>
    </div>
            
        <textarea class="form-control" rows="5" id="Organizationofcontentcomment" name="Organizationofcontentcomment" placeholder="Organization of content" required></textarea></td>
    </tr>
    <tr>
        <td>Was dictation provided in the class?</td>
        <td> <select class="form-control" id="dictationinclass" name="dictationinclass" required>
            <option value="">Select Any One</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
          
        </select></td>
    </tr>
    <tr>
        <td>Was the dictation provided in big chunks or part wise along with the flow of class?</td>
        <td> <select class="form-control" id="dictationinclasschunk" name="dictationinclasschunk" required>
            <option value="">Select Any One</option>
            <option value="Very long dictation was provided in one stretch">Very long dictation was provided in one stretch</option>
            <option value="Short dictations were provided from time to time">Short dictations were provided from time to time</option>
            
          
        </select></td>
    </tr>
    <tr>
        <td>Approximately how many pages were dictated in the class?</td>
        <td><input type="number" class="form-control" id="Approximatelypages" name="Approximatelypages" required></td>
    </tr>
    <tr>
    <td>Link with Current Affairs​​</td>
        <td> <div class="form-check formcssradio"  style="display:inline;">
      <label class="form-check-label" for="radio1">
        <input type="radio" class="form-check-input radiosize" id="radio1" name="LinkwithCurrentAffairs" value="1" checked> 1
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio2">
        <input type="radio" class="form-check-input radiosize" id="radio2" name="LinkwithCurrentAffairs" value="2"> 2
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="LinkwithCurrentAffairs" value="3"> 3
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="LinkwithCurrentAffairs" value="4"> 4
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="LinkwithCurrentAffairs" value="5"> 5
      </label>
    </div>
       
    </tr>
    <tr>
        <td>Was the lecture focussed on both prelims and mains exam?</td>
        <td> <select class="form-control" id="lectureFocussed" name="lectureFocussed" required>
            <option value="">Select Any One</option>
            <option value="Only Prelims">Only Prelims</option>
            <option value="Only Mains">Only Mains</option>
            <option value="Both - Prelims and Mains">Both - Prelims and Mains</option>
            
          
        </select></td>
    </tr>
    <tr>
        <td>Factual errors or conceptual lags</td>
        <td> <select class="form-control" id="Factualerrors" name="Factualerrors" required>
            <option value="">Select Any One</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
          
        </select><br><textarea class="form-control" rows="5" id="Factualerrorscomment" name="Factualerrorscomment" placeholder="Factual errors or conceptual lags" required></textarea>
    </td>
    </tr>
    <tr>
    <td>Time Management​</td>
        <td> <div class="form-check formcssradio"  style="display:inline;">
      <label class="form-check-label" for="radio1">
        <input type="radio" class="form-check-input radiosize" id="radio1" name="TimeManagement" value="1" checked> 1
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio2">
        <input type="radio" class="form-check-input radiosize" id="radio2" name="TimeManagement" value="2"> 2
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="TimeManagement" value="3"> 3
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="TimeManagement" value="4"> 4
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="TimeManagement" value="5"> 5
      </label>
    </div><textarea class="form-control" rows="5" id="TimeManagementcomment" name="TimeManagementcomment" placeholder="Time Management" required></textarea></td>
       
    </tr>
    <tr>
    <td>Pace of the class​</td>
        <td> <div class="form-check formcssradio"  style="display:inline;">
      <label class="form-check-label" for="radio1">
        <input type="radio" class="form-check-input radiosize" id="radio1" name="Paceoftheclas" value="Optimal Speed" checked> Optimal Speed
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio2">
        <input type="radio" class="form-check-input radiosize" id="radio2" name="Paceoftheclas" value="Faster than required"> Faster than required
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="Paceoftheclas" value="Slower than required"> Slower than required
      </label>
    </div></td>
       
    </tr>
    <tr>
    <td>Use of Smart Board / PPT​</td>
        <td> <div class="form-check formcssradio"  style="display:inline;">
      <label class="form-check-label" for="radio1">
        <input type="radio" class="form-check-input radiosize" id="radio1" name="UseofSmartBoard" value="1" checked> 1
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio2">
        <input type="radio" class="form-check-input radiosize" id="radio2" name="UseofSmartBoard" value="2"> 2
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="UseofSmartBoard" value="3"> 3
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="UseofSmartBoard" value="4"> 4
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="UseofSmartBoard" value="5"> 5
      </label>
    </div><textarea class="form-control" rows="5" id="UseofSmartBoardcomment" name="UseofSmartBoardcomment" placeholder="Use of Smart Board / PPT" required></textarea></td>
       
    </tr>
    <tr>
    <td>Energy level and communication​</td>
        <td> <div class="form-check formcssradio"  style="display:inline;">
      <label class="form-check-label" for="radio1">
        <input type="radio" class="form-check-input radiosize" id="radio1" name="Energylevel" value="1" checked> 1
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio2">
        <input type="radio" class="form-check-input radiosize" id="radio2" name="Energylevel" value="2"> 2
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="Energylevel" value="3"> 3
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="Energylevel" value="4"> 4
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="Energylevel" value="5"> 5
      </label>
    </div><textarea class="form-control" rows="5" id="Energylevelcomment" name="Energylevelcomment" placeholder="Energy level and communication" required></textarea></td>
       
    </tr>
    <tr>
    <td>Did the faculty meet your expectations?​</td>
        <td> <div class="form-check formcssradio"  style="display:inline;">
      <label class="form-check-label" for="radio1">
        <input type="radio" class="form-check-input radiosize" id="radio1" name="facultymeetyourexpectations" value="1" checked> 1
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio2">
        <input type="radio" class="form-check-input radiosize" id="radio2" name="facultymeetyourexpectations" value="2"> 2
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="facultymeetyourexpectations" value="3"> 3
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="facultymeetyourexpectations" value="4"> 4
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="facultymeetyourexpectations" value="5"> 5
      </label>
    </div><textarea class="form-control" rows="5" id="facultymeetyourexpectationscomment" name="facultymeetyourexpectationscomment" placeholder="faculty meet your expectations" required></textarea></td>
       
    </tr>

    <tr>
        <td>What different you would have done?</td>
        <td> <textarea class="form-control" rows="5" id="differencedonecomment" name="differencedonecomment" placeholder="Please Write Here" required></textarea></td>
    </tr>
    <tr>
    <td>Overall Rating for the Class</td>
        <td> <div class="form-check formcssradio"  style="display:inline;">
      <label class="form-check-label" for="radio1">
        <input type="radio" class="form-check-input radiosize" id="radio1" name="ratingofclass" value="1" checked> 1
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label" for="radio2">
        <input type="radio" class="form-check-input radiosize" id="radio2" name="ratingofclass" value="2"> 2
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="ratingofclass" value="3"> 3
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="ratingofclass" value="4"> 4
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="ratingofclass" value="5"> 5
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="ratingofclass" value="6"> 6
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="ratingofclass" value="7"> 7
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="ratingofclass" value="8"> 8
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="ratingofclass" value="9"> 9
      </label>
    </div>
    <div class="form-check formcssradio" style="display:inline;">
      <label class="form-check-label">
        <input type="radio" class="form-check-input radiosize" name="ratingofclass" value="10"> 10
      </label>
    </div></td>
       
    </tr>
    <tr>
        <td>Any other feedback</td>
        <td> <textarea class="form-control" rows="5" id="otherfeedbackcomment" name="otherfeedbackcomment" placeholder="Feedback" required></textarea></td>
    </tr>
    <tr>
        <td>Any Video Portion Needs to be removed?</td>
        <td id="videoremoveportion_td"> <select class="form-control" id="videoremoveportion" name="videoremoveportion" required>
            <option value="">Select Any One</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            
          
        </select><br><textarea class="form-control" rows="5" id="videoremoveportioncomment" name="videoremoveportioncomment" placeholder="Please Enter The details" style="display:none;"></textarea>
    </td>
    </tr>
    <tr>
        <td> Request for Feedback form sent to classroom team? (Only if it was the third class of the subject)</td>
        <td> <select class="form-control" id="feedbackforclassroomteam" name="feedbackforclassroomteam" required>
            <option value="">Select Any One</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            <option value="NA (Not the third class)">NA (Not the third class)</option>
            
            
          
        </select>
    </td>
    </tr>
    <tr>

    <td><button type="submit" name="submit" class="btn btn-success">Success</button></td>
    </tr>
   

  </table>
</div>
</div>

</form>
<script src="js/academicForm.js"></script>
</body>

