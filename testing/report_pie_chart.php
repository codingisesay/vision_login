<?php 
include('testing_session.php');


$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];

include('../database_connection.php');
  $query = "Select checklist_record.checklist_id, checklist_record.class_date, checklist_record.venue,
   checklist_record.batch, checklist_record.time_slot, user.user_name,issue_during_class.issue_name,
   issue_during_testing_remark.issue_start_time,issue_during_testing_remark.issue_end_time,
   issue_during_testing_remark.observation,issue_during_testing_remark.time_lost_during_class from checklist_record
    inner join user on checklist_record.testing_mamber = user.user_id inner join issue_during_testing_remark on 
    checklist_record.checklist_id = issue_during_testing_remark.checklist_id 
    inner join issue_during_class on issue_during_testing_remark.issue_id = issue_during_class.issue_id 
    where checklist_record.class_date between '$from_date' and '$to_date'  ORDER BY checklist_id ASC";



    $run = mysqli_query($connect,$query);
    mysqli_close($connect);
    $row =  mysqli_num_rows($run);
    $i=0;
    $j=0;
    $k=0;
     while($data = mysqli_fetch_assoc($run)){
       if($data['time_slot'] == "09 am - 12 pm"){

        
        $i++;

       }
       if($data['time_slot'] == "01 pm - 04 pm"){

     
        $j++;

       }

       if($data['time_slot'] == "05 pm - 08 pm"){

        $k++;

       }
      

     }
      $i."<br>";
      $j."<br>";
      $k."<br>";

?>

<head>
        <link rel="stylesheet" href="css/generate_report.css">

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['TIME', 'DATA'],
          ['09AM - 12PM',     <?php echo $i; ?>],
          ['01PM - 04PM',      <?php echo $j; ?>],
          ['05PM - 08PM',  <?php echo $k; ?>],
         
        ]);

        var options = {
          title: 'Class Timing Vs Interruptions',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('charts'));
        chart.draw(data, options);
      }
    </script>



                </head>
                <body>
                   


                </body>
                