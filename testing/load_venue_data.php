<?php 
include('testing_session.php');

?>
        <?php
        $selected_catogry = $_POST['selected_catogry'];
        $q="SELECT * FROM venues ORDER BY venue_name ASC";
        $run_report = mysqli_query($connect,$q);
		mysqli_close($connect);
        $output="";
        if(mysqli_num_rows($run_report) > 0){

            $output="
            <div class='col-4'>Select Venue:</div>
            <div class='col-8'>
            
    <select id='load_data' class='form-control'>
      <option>Select Any One</option>";
      while($batch_data = mysqli_fetch_assoc($run_report)){
        $output.="<option>{$batch_data['venue_name']}</option>";
      }
      
    $output.="</select>
    </div>";

        }
        echo $output;
		
           ?>