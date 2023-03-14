 <?php 
include('testing_session.php');
//include('testing_functions.php');


?>

                <head>
                    <link rel="stylesheet" href="css/generate_report.css">
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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
                  <lable>Select Issue Category</lable>
                  <select style="position:relative; left:30px; width:70%; height:30px;" id="select_issue_cat">
                    <option>Select Any One</option>
                    <?php 
                   
                    include('testing_functions.php');
                    $run = all_issue_category();
                    while($data = mysqli_fetch_assoc($run)){?>
                    <option id="issue_type"><?php echo $data['issue_name'];?></option>
                    
                    <?php

                    }
                    
                    ?>
                    
                  </select><br><br>
                  
                  <lable>Issue By Class Room</lable>
                  <select style="position:relative; left:30px; width:70%; height:30px;" id="select_classroom">
                    <option>Select Any One</option>
                    <?php 
                    $run_venue = all_data_from_venue();
                    while($data_venue = mysqli_fetch_assoc($run_venue)){?>
                    <option id="classroom"><?php echo $data_venue['venue_name'];?></option>
                    
                    <?php

                    }
                    
                    ?>
                  </select><br><br>
                  <lable>Issue By Venue</lable>
                  <select style="position:relative; left:30px; width:70%; height:30px;" id="select_cen">
                  <option>Select any One</option>
                  <?php
                  $run_for_center = fetch_center_name();
                  while($data_center = mysqli_fetch_assoc($run_for_center)){?>
                  <option id="center_name"><?php echo $data_center['center_name'];?></option>
                  <?php

                  }
            
                  ?>
                </select>
                </div>
                
                <div id="charts">
                

                </div>
                <div id="load_table">

                  </div>


            <div id="load_report_per_issue_table">
           
            </div>
            <div class="load_table_data" id="load_issue_by_classroom_table">
            <h1>issue_by_classroom</h1>
            </div>

            <div id="model">
    <div id="model-form">
        <div id="close-btn">X</div>
        
    <table id="record_table">

    </table>



    </div>


    </div>

                <script type="text/javascript" src="js/jquery.js"></script>
                <script type="text/javascript">
                 $(document).ready(function(){
                  $("#class_timing_inst").on("click",function(){
                    //e.preventDefault();
                    var from_date = $("#from_date").val();
                    var to_date = $("#to_date").val();
                  
                    $.ajax({
                      url: "report_pie_chart.php",
                      type: "POST",
                      data:{from_date:from_date,to_date:to_date},
                      success: function(data){
                        //console.log(data);
                        $("#charts").html(data);
                    

                        $.ajax({
                          url:"load_table_report_pie_chart.php",
                          type:"POST",
                          data:{from_date:from_date,to_date:to_date},
                          success:function(data){
                            $("#load_table").html(data);
                          }
                        })
                        

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
                   
                      $.ajax({
                        url:"load_table_report_venue_inst.php",
                        type:"POST",
                        data:{from_date:from_date,to_date:to_date},
                        success:function(data){
                          $("#load_table").html(data);



                        }
                      })

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
                        $.ajax({
                          url:"load_table_report_issue_frequency.php",
                          type:"POST",
                          data:{from_date:from_date,to_date:to_date},
                          success:function(data){
                            $("#load_table").html(data);

                          }
                        })

                      }
                    })
                  })
        
                  $("#select_issue_cat").change(function(){
                    var from_date = $("#from_date").val();
                    var to_date = $("#to_date").val();
                    var selected_cat = $(this).val();
                    //console.log(from_date);
                    //console.log(to_date);
                    //console.log(selected_cat);
                    $.ajax({
                      url:"report_per_issue.php",
                      type:"POST",
                      data:{from_date:from_date,to_date:to_date,selected_cat:selected_cat},
                      success:function(data){
                        $("#charts").html(data);
                        $.ajax({
                          url:"load_table_report_per_issue.php",
                          type:"POST",
                          data:{from_date:from_date,to_date:to_date,selected_cat:selected_cat},
                          success:function(data){
                            $("#load_table").html(data);

                          }
                        })
                      }
                    })


                  })

                  $("#select_classroom").change(function(){
                    var from_date = $("#from_date").val();
                    var to_date = $("#to_date").val();
                    var cls = $(this).val();
                   
                    $.ajax({
                      url:"issue_by_classroom.php",
                      type:"POST",
                      data:{from_date:from_date,to_date:to_date,cls:cls},
                      success:function(data){
                        $("#charts").html(data);
                        $.ajax({
                          url:"load_table_issue_by_classroom.php",
                          type:"POST",
                          data:{from_date:from_date,to_date:to_date,cls:cls},
                          success:function(data){
                            $("#load_table").html(data);

                          }
                        })
                      }
                    })


                  })

                  $("#select_cen").change(function(){
                    var from_date = $("#from_date").val();
                    var to_date = $("#to_date").val();
                    var center_name = $(this).val();
                    $.ajax({
                      url:"issue_by_venue_graph.php",
                      type:"POST",
                      data:{from_date:from_date,to_date:to_date,center_name:center_name},
                      success:function(data){
                        $("#charts").html(data);
                        $.ajax({
                          url:"load_table_issue_by_venue_graph.php",
                          type:"POST",
                          data:{from_date:from_date,to_date:to_date,center_name:center_name},
                          success:function(data){
                            $("#load_table").html(data);
                          }
                        })

                      }
                    })

                  })


                  $(document).on("click",".view_details",function(){
            $("#model").show();
            var class_id=$(this).data("class_id");
            //console.log(class_id);
            $.ajax({
                                        url:"view_detail_checklist.php",
                                        type:"POST",
                                        data:{class_id:class_id},
                                        success:function(data){
                                            $("#model-form table").html(data);

                                            var board_remark_td = $("#board_remark_td").html();

                                            var synopsis_display_remark_td = $("#synopsis_display_remark_td").html();
                                            var remote_system_ipad_remark = $("#remote_system_ipad_remark_td").html();
              
              var camera_focus_remark = $("#camera_focus_remark_td").html();
              var camera_battery_remark = $("#camera_battery_remark_td").html();
              var remote_system_laptop = $("#remote_system_laptop_td").html();
              var batch_coordinator_convey_remark = $("#batch_coordinator_convey_remark_td").html();

              var handout_remark = $("#handout_remark_td").html();

              var next_class_update_remark = $("#next_class_update_remark_td").html();
              //console.log(next_class_update_remark);
              var testing_query_remark = $("#testing_query_remark_td").html();
              var event_post_update_remark = $("#event_post_update_remark_td").html();
              var recorded_video_uploaded_remark = $("#recorded_video_uploaded_remark_td").html();

              if(board_remark_td == ""){

              $("#board_remark_tr").css("display","none");

              }

              if(synopsis_display_remark_td == ""){
                $("#synopsis_display_remark_tr").css("display","none");

              }

               if(remote_system_ipad_remark == ""){

                    $("#remote_system_ipad_remark_tr").css("display","none");

                  }


                  if(camera_focus_remark == ""){
                    $("#camera_focus_remark_tr").hide();
                  }

                  if(camera_battery_remark == ""){
                    $("#camera_battery_remark_tr").hide();
                  }
                  if(remote_system_laptop == ""){
                    $("#remote_system_laptop_tr").hide();

                  }
                  if(batch_coordinator_convey_remark == ""){
                    $("#batch_coordinator_convey_remark_tr").hide();
                  }


                   if(handout_remark == ""){
                    $("#handout_remark_tr").hide();
                }

                  if(next_class_update_remark == ""){
                    $("#next_class_update_remark_tr").hide();
                  }
                  if(testing_query_remark == ""){
                    $("#testing_query_remark_tr").hide();
                  }
                  if(event_post_update_remark == ""){
                    $("#event_post_update_remark_tr").hide();

                  }
                  if(recorded_video_uploaded_remark == ""){
                    $("#recorded_video_uploaded_remark_tr").hide()
                  }
              
                                        }
                                    })  
        })

        $("#close-btn").on("click",function(){
                                $("#model").hide();
                })
                 })
                </script>
               </body>