<?php
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
<html>
    <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
                    
    <link rel="stylesheet" href="css/complaint_dashboard.css">
    </head>
    <body>
    <?php include('complaint_navbar.php'); ?>
    <?php include('complaint_functions.php'); ?>
    <form action="download_complaint_raw_data.php" method="POST">
    <div class="input_date">
        <div class="input_date_sub_div"><label>From Date:</label>
         <input type="date" id="from_date" name="to_date" required>
         </div>
        <div class="input_date_sub_div"><label>To Date:</label>
         <input type="date" id="to_date" name="from_date" required></div>
        <div class="input_date_sub_div"><input type="submit" name="submit" value="Download Raw Data" id="download_raw_data_button"></div>
    </div></form>
    <div class="side_navbar">
    <a href="#" id="pie_coplaints">Complaints Percentage</a><br><br>
        <a href="#" id="total_coplaints">Total Complaints</a><br><br>
        
        

        <lable>Sub Category Wise</lable>
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
        </select><br><br>
        <lable>Complaint Sub Category</lable>
        <select>
            <option>Select Any One</option>
        </select><br><br>
    </div>
    <div id="columnchart_values"></div>
    <div id="load_table"></div>
    </body>
    <script type="text/javascript" src="js/jquery.js"></script>
                <script type="text/javascript">
                    $(document).ready(function(){
                    $("#total_coplaints").on('click',function(){
                        var from_date = $("#from_date").val();
                        var to_date = $("#to_date").val();
                        //console.log(from_date);
                        //console.log(to_date);
                        $.ajax({
                            url:"load_total_complaint.php",
                            type:"POST",
                            data:{from_date:from_date,to_date:to_date},
                            success:function(data){
                                $('#columnchart_values').html(data);

                            }
                        })
                        $.ajax({
                            url:"load_table_data_total.php",
                            type:"POST",
                            data:{from_date:from_date,to_date:to_date},
                            success:function(data){
                                $('#load_table').html(data);
                                $('#load_table').show();

                            }

                        })
                    })
                    $("#pie_coplaints").on("click",function(){
                        //alert("Akash");
                        var from_date = $("#from_date").val();
                        var to_date = $("#to_date").val();
                        $.ajax({
                            url:"load_pie_chart_complaint.php",
                            type:"POST",
                            data:{from_date:from_date,to_date:to_date},
                            success:function(data){

                                $('#columnchart_values').html(data);
                                $('#load_table').hide();

                            }
                        })
                    })
                    $("#sub_cat").on("change",function(){
                        var from_date = $("#from_date").val();
                        var to_date = $("#to_date").val();
                        var sub_cat = $("#sub_cat").val();
                        //console.log(from_date);
                        //console.log(to_date);
                        //console.log(sub_cat); 
                        $.ajax({
                            url:"complaint_sub_cat.php",
                            type:"POST",
                            data:{from_date:from_date,to_date:to_date,sub_cat:sub_cat},
                            success:function(data){
                                $('#columnchart_values').html(data);

                            }
                        })
                        $.ajax({
                            url:"load_table_complaint_sub_cat.php",
                            type:"POST",
                            data:{from_date:from_date,to_date:to_date,sub_cat:sub_cat},
                            success:function(data){
                                $('#load_table').html(data);
                                $('#load_table').show();


                            }

                        })
                    })
                    })
                </script>
</html>

