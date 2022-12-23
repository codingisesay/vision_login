<?php
include('testing_session.php');

?>

  
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Times", { role: "style" } ],
        <?php 
        include('testing_functions.php');
        //$from_date = '2022-08-20';
        //$to_date = '2022-09-20';
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];
        include('../database_connection.php');
        $query = "SELECT * FROM issue_during_class";
        
        $run_issue = mysqli_query($connect,$query);
        $row_issue = mysqli_num_rows($run_issue);
        
        for($i=1;$i<=$row_issue;$i++){
          $data_issue= mysqli_fetch_assoc($run_issue);
          
          $run = issue_data($from_date,$to_date);
          $row = mysqli_num_rows($run);
          $issue = 0;
          for($j=1;$j<=$row;$j++){
            $data = mysqli_fetch_assoc($run);
        
            if($data_issue['issue_name'] == $data['issue_name']){
        
            $issue++;
        
            }
          }?>
          
          ["<?php echo $data_issue['issue_name'];?>",<?php  echo $issue ?>, "#7BBAF2"],
          
          <?php
        
        //echo $issue.$data_issue['issue_name']."<br>";  
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
        title: "Issue Vs Frequency",
        width: 900,
        height: 550,
        bar: {groupWidth: "80%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById('charts'));
      chart.draw(view, options);
  }
  </script>
  
