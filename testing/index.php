<?php
include 'testing_session.php';
mysqli_close($connect);

?>

<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/testing_home.css">
</head>

<body>
    <?php include 'testing_navbar.php';?>
<div class="container-lg">
    <div class="p-2 row">
        <div class="p-2 col-12 col-md-12 col-lg-6 text-center">
            <lable id="select">Select Date &nbsp;</lable>
            <input type="date" class="input-box" id="date">
            <spam class="text-center">
                <button class="btn-primary btn p-0" id="submit_date">Submit</button>
</spam>
        </div>
        <div class="p-2 col-12 col-md-12 col-lg-6 text-center">
            <label>Search &nbsp;</label>
            <input type="text" class="input-box" id="search_term" placeholder="Search">
        </div>
    </div>

    <div id="show_data" class="table-overflow">



    </div>
</div>




    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        function load_data() {

            $.ajax({
                url: "load_testing_data.php",
                type: "POST",
                success: function(data) {
                    //console.log(data);
                    $("#show_data").html(data);
                }
            })

        }
        load_data();

        $("#submit_date").on("click", function() {
            var date = $("#date").val();
            //console.log(date);
            $.ajax({
                url: "load_checklist_by_date.php",
                type: "POST",
                data: {
                    date: date
                },
                success: function(data) {

                    $("#show_data").html(data);

                }
            })

        })

        $("#search_term").on("keyup", function() {
            var selected_dated = $("#date").val();
            var search_key = $(this).val();
            console.log(search_key);
            console.log(selected_dated);
            $.ajax({
                url: "live_search.php",
                type: "POST",
                data: {
                    search_key: search_key,
                    selected_dated: selected_dated
                },
                success: function(data) {

                    $('#show_data').html(data);

                }
            })
        })



    })
    $(document).ready(function () {
        $('#example').DataTable();
    })
    </script>

</body>

</html>