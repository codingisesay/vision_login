<?php
$server_name="localhost";
$user_name="akash";
$password="vision@123";
$database_name="akash";

$connect=mysqli_connect($server_name,$user_name,$password,$database_name) or die("Connection Fail");

?>

<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
        ["<?php echo $sub_cat;?>", <?php echo $total_cat; ?>, "red"],
        <?php 
        for($sub = 0; $sub < $total_cat; $sub++){?>

       ["<?php echo $sub_cat_by_cat_id[$sub]['Sub Cat Name']; ?>", <?php echo $total_cat; ?>, "#1c3961"],
        
        
        <?php

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
        title: "<?php echo $sub_cat; ?>",
        width: 1300,
        height: 350,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>
<div id="columnchart_values" style="width: 900px; height: 300px;"></div>
 
  