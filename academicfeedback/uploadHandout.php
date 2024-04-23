<?php 
include('../session.php');

?>
<?php 
include('academicfeedbackFunction.php');
include('academicfeedbackNavBar.php');
$classId = $_REQUEST['class_id'];
$checklist_id = $_REQUEST['checklist_id'];

$handoutdata = fetchhandout($checklist_id);
$handoutdatacount = count($handoutdata);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h2>Class Id: <?php echo $classId; ?></h2>
  <p></p>
  <form action="uploadscript.php" method="POST" enctype="multipart/form-data">
    <p>Custom file:</p>
    <div class="custom-file mb-3">
        <input type="hidden" name="classId" value="<?php echo $classId; ?>">
        <input type="hidden" name="checklist_id" value="<?php echo $checklist_id; ?>">
      <input type="file" class="custom-file-input" id="customFile" name="handoutfile" required>
      <label class="custom-file-label" for="customFile">Choose file</label>
    </div>

  
    <div class="mt-3">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
</div>
<br>
<br>
<div class="container">

  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Uploaded Handouts</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body"><table class="table table-bordered">
    <thead>
      
      <tr>
        <th>Class ID</th>
        <th>Handout Link</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
    <?php 
        for($hand = 0; $hand < $handoutdatacount; $hand++){?>
        
        <tr>
        <td><?php echo $classId; ?></td>
        <td><a href="handout/<?php echo $handoutdata[$hand]['handoutName'];?>" download="<?php echo $handoutdata[$hand]['handoutName'];?>"><?php echo preg_replace("/[0-9-]+/","",$handoutdata[$hand]['handoutName']); ?></a></td>
        <td><a href="deletehandout.php?handoutid=<?php echo $handoutdata[$hand]['handout_id']; ?>"><button type="button" class="btn btn-danger">Delete</button></a></td>
      </tr>
        <?php

        }
        
        
        ?>
      
    </tbody>
  </table></div>
      </div>
    </div>
  </div> 
</div>



<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>

</body>
</html>
