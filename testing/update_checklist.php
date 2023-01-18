<?php 
include('testing_session.php');
mysqli_close($connect);

?>
            <head>
                <link rel="stylesheet" href="css/update_checklist.css">
            </head>
            <body>
                <?php include('testing_navbar.php'); ?>
                <div class="search_update_checklist">
                    
                    <label>Enter Class ID</label>
                    <input type="number" id="input_class_id" value="<?php echo $_GET['class_id']?>">
                    <button type="submit" id="select_update">Submit</button>
                    <button type="submit" id="issue_during_class">Issue During Class</button>
                    
                </div>
                <div>
                <table id="update_record">
                    
                   
                    
                    
                </table>
                
                
                
            </div>
            
            <script type="text/javascript" src="js/jquery.js"></script>
            <script>
                $(document).ready(function(){
                    $("#select_update").on("click",function(){
                       var input_class_id  = $("#input_class_id").val();
                   $.ajax({
                    url:"load_update_form.php",
                    type:"POST",
                    data:{class_id:input_class_id},
                    success:function(data){
                        $("#update_record").html(data);

                    }
                   })

                    })
                    $(document).on("click",".update-btn",function(){

                        var checklist_id = $(this).data("checklist_id");
                        var element=this;
                        var start_time = $("#start_time").val();
						if(start_time !== ""){
							$.ajax({
                            url:"update_starting_time.php",
                            type:"POST",
                            data:{id:checklist_id,starting_time:start_time},
                            success:function(data){

                                if(data == 1){
                                    alert("Class Starting Time Updated");
                                    $(element).closest("tr").fadeOut();
                                }
                            
}
                            
                        })
							
							
						}else{
							alert("Please Select Class Starting Time");
						}
                        
                    })

                    $(document).on("click",".class_end_btn",function(){
                        var checklist_id = $(this).data("checklist_id");
                        var element=this;
                        var end_time_data = $("#end_time").val();
						if(end_time_data !== ""){
							   $.ajax({
                            url:"update_end_time.php",
                            type:"POST",
                            data:{id:checklist_id,end_time:end_time_data},
                            success:function(data){
                                if(data == 1){
                                    alert("End Time Updated");
                                    $(element).closest("tr").fadeOut();
                                }
                                }
                                
                              
                        })
							
						}else{
							alert("Please Select Class End Time");
						}
                     

                    })

                    $(document).on("click",".event_post_update_btn",function(){
                        var checklist_id = $(this).data("checklist_id");
                        var element=this;
                        var select_event_post = $("#select_event_post").val();
                        var event_post_remark = $("#event_post_remark").val();
                        
                        $.ajax({
                            url:"event_post_update.php",
                            type:"POST",
                            data:{id:checklist_id,select_eventpost:select_event_post,event_postremark:event_post_remark},
                            success:function(data){
								

                                if(data == 1){

                                
                                    alert("Event Post update");
                                    $(element).closest("tr").fadeOut();
                                }
                                }

                            
                        })

                    })
                    $(document).on("click",".recorded_video_uploaded-btn",function(){
                        var checklist_id = $(this).data("checklist_id");
                        var element=this;
                        var recorded_video_uploaded = $("#recorded_video_uploaded").val();
                        var recorded_video_upload_time = $("#recorded_video_upload_time").val();
                        var recorded_video_remark = $("#recorded_video_remark").val();
                        
                        
                       $.ajax({
                        url:"uploaded_video_update.php",
                        type:"POST",
                        data:{id:checklist_id,recorded_video_status:recorded_video_uploaded,recorded_video_time:recorded_video_upload_time,recorded_remark:recorded_video_remark},
                        success:function(data){

                            if(data == 1){

                            
                                alert("Recorded Video status Updated");
                                $(element).closest("tr").fadeOut();
                            }
                            }
                            
                       })

                    })

                    

                   $("#issue_during_class").on("click",function(){

                    var class_id = $("#input_class_id").val();
                    if(class_id !== ""){
                        $.ajax({
                        url:"load_issue_during_class.php",
                        type:"POST",
                        data:{class_id_from_admin:class_id},
                        success:function(data){
                        $("#update_record").html(data);


                        }
                    })

                    }else{ 

                     alert("Please Enter Class ID");
                    }
                   
                   })
               

                   $(document).on("click",".update_during_class",function(){
                    var checklist_id = $(this).data("checklist_id");
                    var element=this;
                    var issue_start_time = $("#issue_start_time").val();
                    var select_issue_type = $("#select_issue_type").val();
                   var issue_detail_textarea = $("#issue_detail_textarea").val();
                   var issue_end_time = $("#issue_end_time").val();
                   var live_class_effect = $("#live_class_effect").val();
				   if(issue_start_time !== "" && select_issue_type !== "" && issue_detail_textarea !== "" && issue_end_time !== "" && live_class_effect!== ""){
					   
					      $.ajax({
                    url:"update_during_class_table.php",
                    type:"POST",
                    data:{id:checklist_id,issue_start:issue_start_time,select_issue:select_issue_type,issue_detail:issue_detail_textarea,issue_end:issue_end_time,live_class_effect:live_class_effect},
                    success:function(data){
                    if(data == 1){
                        alert("Issue During Class updated");
                        window.location.replace("generate_report.php");


                    }

                    }
                   })
					   
				   }else{
					   
					   alert("All Field Are Required");
					   
				   }
                

                   })


                })

            </script>



            <script type="text/javascript">
                function display_event_post_remark(){
                var select_event_post =  document.getElementById('select_event_post').value;
                if(select_event_post == "No"){
                    document.getElementById("event_post_remark").style.display = "block";
                }else{

                    document.getElementById("event_post_remark").style.display = "none";

                }
            }

            function recorded_video_update(){
               var recorded_video_uploaded = document.getElementById('recorded_video_uploaded').value;
               if(recorded_video_uploaded == "Uploaded"){

                document.getElementById("recorded_video_upload_time").style.display = "block";
                document.getElementById("recorded_video_remark").style.display = "none";

               }else if(recorded_video_uploaded == "Not Uploaded"){

               document.getElementById("recorded_video_remark").style.display = "block";
               document.getElementById("recorded_video_upload_time").style.display = "none";

               }else{

                document.getElementById("recorded_video_remark").style.display = "none";
               document.getElementById("recorded_video_upload_time").style.display = "none";

               }
            }

            function issue_during_class(){
                var issue_data = document.getElementById('select_issue').value;
                if(issue_data !== ''){

                    document.getElementById('select_issue_remark').style.display = "block";

                }
            }


            </script>

            </body>