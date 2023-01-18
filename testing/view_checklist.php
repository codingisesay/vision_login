<?php 
include('testing_session.php');
include('testing_functions.php');
mysqli_close($connect);
$run = user_permission($user_id);
$data_user_role = mysqli_fetch_assoc($run);
 $user_role = $data_user_role['user_role'];

 if($user_role == 3){

  $display = "block";

 }else{
  $display = "none";
 }

?>
<head>
  <link rel="stylesheet" href="css/view_checklist.css">
</head>
<?php include("testing_navbar.php"); ?>
<body>
  <div id="form_main_div">
  <div class="box1">
<label>Select Date: </label>
<input type="date" id="input_date">
<button id="sub_date">Submit</button>
  </div>
  <div class="box2" style="display: <?php echo $display;?>;">
  <label>Search: </label>
<input type="text" placeholder="Search.." id="search_term">
  </div>
 
  
  </div>

  <div class="display_report">
  <table class="display_table">
                                
  </table>

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
      function load_data(){

$.ajax({
    url:"load_tested_data.php",
    type:"POST",
    success:function(data){
        //console.log(data);
        $(".display_table").html(data);
    }
})

}
load_data();

$("#sub_date").on("click",function(){
  var date = $("#input_date").val();
  $.ajax({
    url:"load_tested_data_by_date.php",
    type:"POST",
    data:{date:date},
    success:function(data){

      $(".display_table").html(data);
    }
  })

})

$("#search_term").on("keyup",function(){
                    var selected_dated = $("#input_date").val();
                    var search_key = $(this).val();
                    //console.log(search_key);
                    //console.log(selected_dated);
                    $.ajax({
                        url:"live_search_for_report.php",
                        type:"POST",
                        data:{search_key:search_key,selected_dated:selected_dated},
                        success:function(data){

                            $('.display_table').html(data);

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



     
    })
  </script>
</body>

 