<?php 
include('../session.php');

?>
<?php 
$handoutID = $_REQUEST['handoutid'];
$queryForHandout = "SELECT * FROM handout WHERE handout_id = '$handoutID'";
$runForHandout = mysqli_query($connect,$queryForHandout);
$data = mysqli_fetch_assoc($runForHandout);
// echo "<pre>";
// print_r($data);
$handoutPath = $data['handoutPath'];
$query = "DELETE FROM handout WHERE handout_id ='$handoutID'";
$run = mysqli_query($connect,$query);
if($run){

    unlink($handoutPath);

}
mysqli_close($connect);
if($run){?>

<script>
alert("Handout Deleted!!");
location.replace('index.php');


</script>

<?php

}else{?>

    <script>
    alert("Handout Not Deleted!!");
    location.replace('index.php');
    
    
    </script>
    
    <?php

}

?>