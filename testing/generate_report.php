 <?php 
include('testing_session.php');
mysqli_close($connect);

?>
                <head>
                    <link rel="stylesheet" href="css/generate_report.css">

                </head>

               <body>
                <?php include('testing_navbar.php'); ?>
                <form action="raw_data.php" method="POST">
                <div class="select_date_for_report">
                <div class="from_date">
                <label>From Date : </label>
                <input type="date" name="from_date" class="date_input" id="from_date" required>
                </div>
                <div class="to_date">
                <label>To Date : </label>
                <input type="date" name="to_date" class="date_input" id="to_date" required>
                </div>
                <div class="submit_date">
                  <input type="submit" name="download_raw_data" value="Download Raw Data" class="submit_dates">
                  
                </div>
                </div>
</form>
                
                <div class="side_navbar">
                  <a href="#" id="class_timing_inst">Class Timing Vs Interruptions</a>
                  <a href="#" id="venue_vs_inst">Venue Vs Interruptions</a>
                  <a href="#" id="Issue_freq">Issue Vs Frequency</a>
                  
                  
                  
                </div>
                <div id="charts">
                

                </div>
               
                <script type="text/javascript" src="js/jquery.js"></script>
                <script type="text/javascript">
                 $(document).ready(function(){
                  $("#class_timing_inst").on("click",function(){
                    var from_date = $("#from_date").val();
                    var to_date = $("#to_date").val();
                  
                    $.ajax({
                      url: "report_pie_chart.php",
                      type: "POST",
                      data:{from_date:from_date,to_date:to_date},
                      success: function(data){
                        $("#charts").html(data);
                        //console.log(data);

                      }
                    })
                  })
                  $('#Issue_freq').on("click",function(){
                    var from_date = $("#from_date").val();
                    var to_date = $("#to_date").val();

                    $.ajax({
                      url: "report_issue_frequency.php",
                      type: "POST",
                      data:{from_date:from_date,to_date:to_date},
                      success: function(data){
                        $("#charts").html(data);
                        //console.log(data);

                      }
                    })
                  })
                  $("#venue_vs_inst").on("click",function(){

                    var from_date = $("#from_date").val();
                    var to_date = $("#to_date").val();
                    $.ajax({
                      url: "report_venue_inst.php",
                      type: "POST",
                      data:{from_date:from_date,to_date:to_date},
                      success: function(data){
                        $("#charts").html(data);
                        //console.log(data);

                      }
                    })

                  })                  

                 })
                </script>
               </body>