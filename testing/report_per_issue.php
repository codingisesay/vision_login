<?php 
error_reporting(0);
include('testing_session.php');


?>
<head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Month", "Issue", { role: "style" } ],
        <?php
        include('testing_functions.php');
        //$from_date = '2022-08-01';
        //$to_date = '2022-09-30';
        $from_date = $_POST['from_date'];
        $newfrom_date = date("d-m-Y", strtotime($from_date)); 
        $to_date = $_POST['to_date'];
        $newto_date = date("d-m-Y", strtotime($to_date));
        $selected_cat = $_POST['selected_cat'];
        //$selected_cat = "Internet Issue";
        
        
        $year = array("01"=>"January","02"=>"February","03"=>"March","04"=>"April","05"=>"May","06"=>"June","07"=>"July","08"=>"August","09"=>"September","10"=>"October","11"=>"November","12"=>"December");
        
        $run_issue = issue_data($from_date,$to_date);
        while($data_issue = mysqli_fetch_assoc($run_issue)){
          if($selected_cat == $data_issue['issue_name']){
            $issue_data[] = $data_issue['class_date'];
          }
            
        
        }
        $issue_count = count($issue_data);
        foreach($year as $key => $value){
        $month = 0;
            for($i=0; $i<$issue_count;$i++){
        
                $date = $issue_data[$i];
        
                if($key == $date[5].$date[6]){
        
                    $month++;
            
                }
            
            }
        
            if($month != 0){?>
            
            ["<?php echo $value; ?>",<?php echo $month; ?>,"#7BBAF2"],
            
            <?php
                
            }else{?>
            ["<?php echo $value; ?>",<?php echo $month; ?>,"#7BBAF2"],
            
            <?php
              
            }
        
        
        }
        
        
        ?>
        
        
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "<?php echo $selected_cat." from ".$newfrom_date." to ".$newto_date; ?>",
        // width: 1200,
        // height: 280,
        bar: {groupWidth: "80%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("charts"));
      chart.draw(view, options);
  }
  </script>
</head>
