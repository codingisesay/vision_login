<?php 
include('../session.php');
?>
<?php 
$faculty = $_REQUEST['faculty'];
$from = $_REQUEST['from'];
$to = $_REQUEST['to'];

$queryForSubject = "SELECT checklist_record.subject FROM checklist_record WHERE faculty = '$faculty' AND checklist_record.class_date between '$from' and '$to'";
$runForSubject = mysqli_query($connect,$queryForSubject);
while($dataForSubject = mysqli_fetch_assoc($runForSubject)){

    $subjects[] = array("Subject"=>preg_replace('/[0-9-]+/', '',$dataForSubject['subject']));

}

$subjectUnique = array_unique($subjects,SORT_REGULAR);
$subjectUnique_reindex = array_values($subjectUnique);
$subjectUnique_reindexCount = count($subjectUnique_reindex);

// echo "<pre>";
// print_r($subjectUnique_reindexCount);


?>


<label>Subject</label>
<select style="width: 100%; height:6%;" id="selectSubject">
<?php 
for($sub = 0; $sub < $subjectUnique_reindexCount; $sub++){?>

<option value="<?php echo $subjectUnique_reindex[$sub]['Subject']; ?>"><?php echo $subjectUnique_reindex[$sub]['Subject']; ?></option>

<?php

}

?>
  
</select>