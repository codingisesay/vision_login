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
            <label>Select Venue:</label>
    <select id='load_data'>
      <option>Select Any One</option>";
      while($batch_data = mysqli_fetch_assoc($run_report)){
        $output.="<option>{$batch_data['venue_name']}</option>";
      }
      
    $output.="</select>";

        }
        echo $output;
		
           ?>