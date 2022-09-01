 <?php 
include('testing_session.php');
mysqli_close($connect);

?>
                <head>
                    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
                    <link rel="stylesheet" href="css/generate_report.css">
                </head>

               <body>
                <?php include('testing_navbar.php'); ?>
                <div class="container">
                  <div class="row mb-2 mb-4">
                    <div class="col-12 col-md-6">
                      <div class="row">
                        <div class="col-12 my-2">Select Date For Report:</div>
                        <div class="col-8">
                          <input type="date" class="select_date form-control" id="date_select">
                        </div>
                        <div class="col-4">
                          <button type="submit" class="submit_date form-control btn btn-primary button-color" id="input_select_date">Submit</button>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="row">
                        <div class="col-12 my-2">Search</div>
                        <div class="col-12">
                          <input type="text" id="search_term" class="form-control" placeholder="Search">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="display_report">
                    <div class="display_table table-overflow">
                        
</div>
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
                                $("#input_select_date").on("click",function(){
                                    var date = $("#date_select").val();
                                    
                                   $.ajax({
                                        url:"load_report.php",
                                        type:"POST",
                                        data:{select_date:date},
                                        success:function(data){
                                            $(".display_table").html(data);

                                        }
                                    })

                                })
                                $(document).on("click",".view_detail_checklist",function(){
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



                    $("#search_term").on("keyup",function(){
                    var selected_dated = $("#date_select").val();
                    var search_key = $(this).val();
                    console.log(search_key);
                    console.log(selected_dated);
                    $.ajax({
                        url:"live_search_for_report.php",
                        type:"POST",
                        data:{search_key:search_key,selected_dated:selected_dated},
                        success:function(data){

                            $('.display_report').html(data);

                        }
                    })
                })





                            })

                            $(document).ready(function () {
                                $('#example').DataTable();
                            })
                        </script>
                      
               </body>