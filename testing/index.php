<?php 
include('testing_session.php');
mysqli_close($connect);
include('testing_functions.php');
$run = user_permission($user_id);
$data_user_role = mysqli_fetch_assoc($run);
 $user_role = $data_user_role['user_role'];

 if($user_role == 3){

  $display = "block";

 }else{
  $display = "none";
 }
?>


<html>
<head>
    <link rel="stylesheet" href="css/testing_home.css">
    <link rel="stylesheet" href="css/generate_report.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
</head>
<body>
    <?php include('testing_navbar.php');?>

<div id="date_for_update">
    <div>
    <lable id="select">Select Date</lable>
    <input type="date" id="date">
    <button id="submit_date">Submit</button>
</div>
<div style="display:<?php echo $display; ?>;" id="serach_option">
    <label>Search</label>
    <input type="text" id="search_term" placeholder="Search">
</div>
</div>

<div id="show_data">
    


</div>

  
           

           <script type="text/javascript" src="js/jquery.js"></script>
           <script type="text/javascript">
            $(document).ready(function(){
                function load_data(){

                    $.ajax({
                        url:"load_testing_data.php",
                        type:"POST",
                        success:function(data){
                            //console.log(data);
                            $("#show_data").html(data);
                        }
                    })

                }
                load_data();

                $("#submit_date").on("click",function(){
                    var date = $("#date").val();
                    //console.log(date);
                    $.ajax({
                        url:"load_checklist_by_date.php",
                        type:"POST",
                        data:{date:date},
                        success:function(data){

                             $("#show_data").html(data);

                        }
                    })

                })

                $("#search_term").on("keyup",function(){
                    var selected_dated = $("#date").val();
                    var search_key = $(this).val();
                    console.log(search_key);
                    console.log(selected_dated);
                    $.ajax({
                        url:"live_search.php",
                        type:"POST",
                        data:{search_key:search_key,selected_dated:selected_dated},
                        success:function(data){

                            $('#show_data').html(data);

                        }
                    })
                })

            })
               

           </script>

</body>
</html>