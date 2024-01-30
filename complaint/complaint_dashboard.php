<?php
error_reporting(0);
session_start();
include('../database_connection.php');
include('../functions.php');
$device_cookie=$_COOKIE['PHPSESSID'];
$user_id=$_SESSION['id'];
$row_of_specific_device = specific_device_from_login_log($device_cookie,$user_id);
mysqli_num_rows($row_of_specific_device);
$data = mysqli_fetch_assoc($row_of_specific_device);

if(!isset($_SESSION['id']) || !isset($_COOKIE['PHPSESSID']) || $data['session_status'] == "inactive"){

         page_redirect('../index.php');
}
?>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>   
  <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script> 
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>            
    <link rel="stylesheet" href="css/complaint_dashboard.css">
    </head>
    <body>
    <?php include('complaint_navbar.php'); ?>
    <?php include('complaint_functions.php'); ?><br>
    <form action="download_complaint_raw_data.php" method="POST">
    <div class="container-fluid">
<div class="row">
  <div class="col-sm-3">
  <label>From:</label>
  <input type="date" id="from_date" name="from_date" required> 
  </div>
  <div class="col-sm-3">
  <div class="input_date_sub_div"><label>To:</label>

         <input type="date" id="to_date" name="to_date" required></div>

  </div>
  <div class="col-sm-3">
  <label>Sub Category Wise</label>
  <select id="sub_cat">
            <option>Select Any One</option>
            <?php 
            $run_for_complaint_cat = fetch_all_data_from_complaint_category();
            while($data_for_complaint_cat = mysqli_fetch_assoc($run_for_complaint_cat)){
             
             $complaint_cat[] = array("Complaint Cat Id" => $data_for_complaint_cat['complaint_category_id'], "Complaint Cat Name" => $data_for_complaint_cat['complaint_category_name']);

            }
            $complaint_cat_count = count($complaint_cat);

            for($i = 0; $i < $complaint_cat_count; $i++){?>
            
            <option><?php echo $complaint_cat[$i]['Complaint Cat Name']?></option>
            
            <?php

            }

            ?>
        </select>

  </div>
  <!-- <div class="col-sm-3">
  <label>Platform Wise</label>
  <select id="sub_cat">
            <option>Select Any One</option>
            <?php 
            // $run_for_mode_complaint = fetch_all_data_from_mode_of_complaint();
            // while($data_for_mode_complaint = mysqli_fetch_assoc($run_for_mode_complaint)){
             
            //  $complaint_mode[] = array("mode_id" => $data_for_mode_complaint['mode_id'], "mode_name" => $data_for_mode_complaint['mode_name']);

            // }
            // $complaint_mode_count = count($complaint_mode);

            // for($i = 0; $i < $complaint_mode_count; $i++){?>
            
            <option><?php //echo $complaint_mode[$i]['mode_name']?></option>
            
            <?php

            // }

            ?>
        </select>

  </div> -->
</div>
</div><br>


<div class="container-fluid">
  <button type="button" id="pie_coplaints" class="btn btn-success">Complaints Percentage</button>
  <button type="button" id="total_coplaints" class="btn btn-success">Total Complaints</button>
  <button type="button" id="issue_at_end" class="btn btn-success">Issue At</button>
  <button type="button" id="ModeOfComplaints" class="btn btn-success">Mode Of Complaints</button>
  <button type="submit" class="btn btn-success" id="download_raw_data_button">Download Raw Data</button>
</div>
</form>
<div class="container-fluid">
    <div id="chartContainer" style="height: 500px; width: 100%;">
    
</div><br>
<button id="exportChart" class="btn btn-success">Download Graph</button>
</div><br>
    <div id="load_table"></div>
    <div id="dashboard_collaps"></div>
    </body>
    <script type="text/javascript" src="js/jquery.js"></script>
                <script type="text/javascript">
                    $(document).ready(function(){
                        function dasboard_graph_table(){
                        $.ajax({
						url:"load_dasboard_graph.php",
						type:"POST",
						success:function(data){
							$("#chartContainer").html(data);
                            $.ajax({
                                url:"load_dasboard_table.php",
                                type:"POST",
                                success:function(data){
                                    $("#load_table").html(data);

                                }
                            })
							
						}
					})

                        }
                        dasboard_graph_table();

                        $("#pie_coplaints").on("click",function(){
                        //alert("Akash");
                        var from_date = $("#from_date").val();
                        var to_date = $("#to_date").val();
                        // console.log(from_date);
                        // console.log(to_date);

                         if(from_date != "" && to_date != ""){

                         
                        $.ajax({
                            url:"load_pie_chart_complaint.php",
                            type:"POST",
                            data:{from_date:from_date,to_date:to_date},
                            success:function(data){

                                $('#chartContainer').html(data);
                                $('#load_table').hide();
                               

                            }
                        })
                    }else{
                        alert("Please Select The Date First");
                    }
                    })


                    $("#total_coplaints").on('click',function(){
                        var from_date = $("#from_date").val();
                        var to_date = $("#to_date").val();
                        //console.log(from_date);
                        //console.log(to_date);
                        if(from_date != "" && to_date != ""){

                        
                        $.ajax({
                            url:"load_total_complaint.php",
                            type:"POST",
                            data:{from_date:from_date,to_date:to_date},
                            success:function(data){
                                $('#chartContainer').html(data);

                            }
                        })
                        $.ajax({
                            url:"load_table_data_total.php",
                            type:"POST",
                            data:{from_date:from_date,to_date:to_date},
                            success:function(data){
                                $('#load_table').html(data);
                                $('#load_table').show();
                                $('#ten_day_record').hide();
                                $('#s_table').hide();
                                $('#dashboard_collaps').hide();

                            }

                        })
                    }else{
                        alert("Please Select The Date First");  
                    }
                    })
            
                    $("#issue_at_end").on("click",function(){
                        var from_date = $("#from_date").val();
                        var to_date = $("#to_date").val();
                        if(from_date != "" && to_date != ""){
                        $.ajax({
                            url:"load_issue_at_end.php",
                            type:"POST",
                            data:{from_date:from_date,to_date:to_date},
                            success:function(data){
                                $('#chartContainer').html(data);
                            }
                        })
                        $.ajax({
                            url:"load_table_issue_at_end.php",
                            type:"POST",
                            data:{from_date:from_date,to_date:to_date},
                            success:function(data){
                                $('#load_table').html(data);
                                $('#load_table').show();
                                $('#ten_day_record').hide();
                                $('#s_table').hide();
                                $('#dashboard_collaps').hide();
                            }
                        })
                    }else{
                        alert("Please Select The Date First");
                    }

                    })
                    $("#sub_cat").on("change",function(){
                        var from_date = $("#from_date").val();
                        var to_date = $("#to_date").val();
                        var sub_cat = $("#sub_cat").val();
                        //console.log(from_date);
                        //console.log(to_date);
                        //console.log(sub_cat); 
                        if(from_date != "" && to_date != ""){
                        $.ajax({
                            url:"complaint_sub_cat.php",
                            type:"POST",
                            data:{from_date:from_date,to_date:to_date,sub_cat:sub_cat},
                            success:function(data){
                                $('#chartContainer').html(data);

                            }
                        })
                        $.ajax({
                            url:"load_table_complaint_sub_cat.php",
                            type:"POST",
                            data:{from_date:from_date,to_date:to_date,sub_cat:sub_cat},
                            success:function(data){
                                $('#load_table').html(data);
                                // $('#load_table').show();
                              


                            }

                        })
                    }else{
                        alert("Please Select The Date First");
                    }
                    })
                  $(".issue_date_pass").on("click",function(e){
                    e.preventDefault;
                    var date_input = $(this).text();
                    //console.log(date_input);
                    $.ajax({
                        url:"load_date_data_table.php",
                        type:"POST",
                        data:{date_input:date_input},
                        success:function(data){

                            $('#dashboard_collaps').html(data);
                        }
                    })

                  })

                  $("#ModeOfComplaints").on("click",function(){
                        var from_date = $("#from_date").val();
                        var to_date = $("#to_date").val();
                        // var sub_cat = $("#sub_cat").val();
                        //console.log(from_date);
                        //console.log(to_date);
                        //console.log(sub_cat); 
                        if(from_date != "" && to_date != ""){
                        $.ajax({
                            url:"loadModeOfComplaintGraph.php",
                            type:"POST",
                            data:{from_date:from_date,to_date:to_date},
                            success:function(data){
                                $('#chartContainer').html(data);

                            }
                        })
                        $.ajax({
                            url:"loadModeOfComplaintTable.php",
                            type:"POST",
                            data:{from_date:from_date,to_date:to_date},
                            success:function(data){
                                $('#load_table').html(data);
                                // $('#load_table').show();
                              


                            }

                        })
                    }else{
                        alert("Please Select The Date First");
                    }
                    })
                   




                    })

                    </script>
                