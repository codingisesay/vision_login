<?php 
include('../session.php');

?>
<?php 
include('academicfeedbackFunction.php');

if(isset($_FILES['handoutfile'])){

   $classId = $_REQUEST['classId'];
   $checklistId = $_REQUEST['checklist_id'];


    $fileName = $classId.$checklistId.$_FILES['handoutfile']['name'];
    $fileSize = $_FILES['handoutfile']['size'];
    $fileTmp = $_FILES['handoutfile']['tmp_name'];
    $fileType = $_FILES['handoutfile']['type'];

    $query = "INSERT INTO `handout` (`handoutName`, `handoutPath`, `checklist_id`)
               VALUES ('$fileName', 'handout/$fileName', '$checklistId')";
     $runforentry = mysqli_query($connect,$query);

     if($runforentry){

        $run = move_uploaded_file($fileTmp,"handout/".$fileName);

    if($run){?>
    
    <script>
        alert("Handout Uploaded");
        location.replace("index.php");
    </script>
    
    <?php
         
    }else{
        ?>
    
        <script>
            alert("Handout Not Uploaded");
            location.replace("index.php");
        </script>
        
        <?php

    }

     }else{

        echo "Error: " . $runforentry . "<br>" . mysqli_error($connect);

     }

    

}





?>