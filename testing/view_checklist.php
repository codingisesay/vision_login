<?php 
include('testing_session.php');
mysqli_close($connect);

?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/view_checklist.css">
</head>
<?php include("testing_navbar.php"); ?>

<body>
    <div id="form_main_div" class="container">
        <div class="form_box box1 row">
            <div class="col-4">From:</div>
            <div class="col-8">
              <input type="date" class="form-control" id="from_date">
            </div>
        </div>

        <div class="form_box box2 row">
            <div class="col-4">To:</div>
            <div class="col-8">
              <input type="date" id="to_date" class="form-control">
            </div>
        </div>

        <div class="form_box box3 row">
            <div class="col-4">Select Category:</div>
            <div class="col-8">
              <select id="select_catogray" class="form-control">
                  <option>Select Any One</option>
                  <option value="batch">Batch</option>
                  <option value="venue">Venue</option>
              </select>
            </div>
        </div>

        <div class="form_box box4 row">

        </div>

        <div class="form_box box5 row mb-4">
          <div class="col-12">
            <button id="search_btn" class="btn btn-primary button-color">Search</button>
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
    $(document).ready(function() {
        $("#select_catogray").on("click", function() {

            var selected_catogry = $(this).val();

            if (selected_catogry == "batch") {

                $.ajax({
                    url: "load_batch_data.php",
                    type: "POST",
                    data: {
                        selected_catogry: selected_catogry
                    },
                    success: function(data) {
                        $(".box4").html(data);

                    }
                })



            } else if (selected_catogry == "venue") {

                $.ajax({
                    url: "load_venue_data.php",
                    type: "POST",
                    data: {
                        selected_catogry: selected_catogry
                    },
                    success: function(data) {
                        $(".box4").html(data);

                    }
                })


            }



        })
        $("#search_btn").on("click", function() {
            var from_date = $("#from_date").val();
            var to_date = $("#to_date").val();
            var select_catogray = $("#select_catogray").val();
            var load_data = $("#load_data").val();


            $.ajax({
                url: "checklist_by.php",
                type: "POST",
                data: {
                    from_date: from_date,
                    to_date: to_date,
                    select_catogray: select_catogray,
                    load_data: load_data
                },
                success: function(data) {
                    $(".display_table").html(data);



                }
            })

        })

        $(document).on("click", ".view_detail_checklist", function() {
            $("#model").show();
            var class_id = $(this).data("class_id");
            //console.log(class_id);
            $.ajax({
                url: "view_detail_checklist.php",
                type: "POST",
                data: {
                    class_id: class_id
                },
                success: function(data) {
                    $("#model-form table").html(data);

                    var board_remark_td = $("#board_remark_td").html();

                    var synopsis_display_remark_td = $("#synopsis_display_remark_td")
                .html();
                    var remote_system_ipad_remark = $("#remote_system_ipad_remark_td")
                    .html();

                    var camera_focus_remark = $("#camera_focus_remark_td").html();
                    var camera_battery_remark = $("#camera_battery_remark_td").html();
                    var remote_system_laptop = $("#remote_system_laptop_td").html();
                    var batch_coordinator_convey_remark = $(
                        "#batch_coordinator_convey_remark_td").html();

                    var handout_remark = $("#handout_remark_td").html();

                    var next_class_update_remark = $("#next_class_update_remark_td").html();
                    //console.log(next_class_update_remark);
                    var testing_query_remark = $("#testing_query_remark_td").html();
                    var event_post_update_remark = $("#event_post_update_remark_td").html();
                    var recorded_video_uploaded_remark = $(
                        "#recorded_video_uploaded_remark_td").html();

                    if (board_remark_td == "") {

                        $("#board_remark_tr").css("display", "none");

                    }

                    if (synopsis_display_remark_td == "") {
                        $("#synopsis_display_remark_tr").css("display", "none");

                    }

                    if (remote_system_ipad_remark == "") {

                        $("#remote_system_ipad_remark_tr").css("display", "none");

                    }


                    if (camera_focus_remark == "") {
                        $("#camera_focus_remark_tr").hide();
                    }

                    if (camera_battery_remark == "") {
                        $("#camera_battery_remark_tr").hide();
                    }
                    if (remote_system_laptop == "") {
                        $("#remote_system_laptop_tr").hide();

                    }
                    if (batch_coordinator_convey_remark == "") {
                        $("#batch_coordinator_convey_remark_tr").hide();
                    }


                    if (handout_remark == "") {
                        $("#handout_remark_tr").hide();
                    }

                    if (next_class_update_remark == "") {
                        $("#next_class_update_remark_tr").hide();
                    }
                    if (testing_query_remark == "") {
                        $("#testing_query_remark_tr").hide();
                    }
                    if (event_post_update_remark == "") {
                        $("#event_post_update_remark_tr").hide();

                    }
                    if (recorded_video_uploaded_remark == "") {
                        $("#recorded_video_uploaded_remark_tr").hide()
                    }




                }
            })
        })


        $("#close-btn").on("click", function() {
            $("#model").hide();
        })




    })
    </script>
</body>