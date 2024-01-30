<?php
session_start();

include('../testing/testing_functions.php');
if(!isset($_SESSION['admin_id'])){
	
	header('location:index.php');


}

	?>
	<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
		<link rel="stylesheet" href="admin css/admin_home.css">
		<link rel="stylesheet" href="chosen/chosen.min.css">
		
	</head>
	<body>
		
		<div id="side_btns" class="container-fluid" style="padding-top:10px;">
		    <button type="button" class="btn btn-info" id="create_checklist">Create Checklist</button>
			<button type="button" class="btn btn-info" id="create_offline_checklist">Offline Checklist</button>
			<button type="button" class="btn btn-info" id="inser_venue">Insert Venue</button>
			<button type="button" class="btn btn-info" id="inser_batch">Insert Batch</button>
			<button type="button" class="btn btn-info" id="insert_subject">Subject</button>
			<button type="button" class="btn btn-info" id="insert_faculty">Faculty</button>
			<button type="button" class="btn btn-info" id="insert_batch_coordinator">Batch Coordinator</button>
			<button type="button" class="btn btn-info" id="insert_camera_man">Camera Man</button>
			<button type="button" class="btn btn-info" id="insert_lnternet_line">Internet Line</button>
			<button type="button" class="btn btn-info" id="insert_tech_support_person">Tech Person</button>
			<a href="delete_checklist.php" type="button" class="btn btn-danger">Delete</a>
			<a href="admin_logout.php" type="button" class="btn btn-info">LogOut</a>
			<!-- <button type="submit" id="create_checklist">Create Checklist</button> -->
			
			<!-- <button type="submit" id="create_offline_checklist">Offline Checklist</button> -->
			
			
			<!-- <button type="submit" id="inser_venue">Insert Venue</button> -->
			
			<!-- <button type="submit" id="inser_batch">Insert Batch</button> -->
			
			<!-- <button type="submit" id="insert_subject">Subject</button> -->
			
			<!-- <button type="submit" id="insert_faculty">Faculty</button> -->
			<!-- <button type="submit" id="insert_batch_coordinator">Batch Coordinator</button> -->
			<!-- <button type="button" class="btn btn-info">Button</button>
			<button type="submit" id="insert_camera_man">Camera Man</button>
			<button type="submit" id="insert_lnternet_line">Internet Line</button>
			<button type="submit" id="insert_tech_support_person">Tech Person</button>
			<a href="deleteChecklist.php">Delete</a>
			<button type="submit"><a href="admin_logout.php" style="color: white; text-decoration:none">LogOut</a></button> -->
			
		</div><br>
		<div id="show_data" class="container">
       <table id="t1" border="1px" width="100%" cellspacing="0">

       </table>
		<script type="text/javascript" src="admin_js/jquery.js"></script>

        <script src="chosen/chosen.jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				function cerate_checklist_form(){
					$.ajax({
						url:"add_checklist.php",
						type:"POST",
						success:function(data){
							$("#t1").html(data);
							$('#select_batch').chosen();

						}
					})
				}
				cerate_checklist_form();

               $("#create_checklist").on("click",function(){

               	cerate_checklist_form();

               })

				$(document).on("click",".insert_btn",function(){
					var class_date = $("#class_date").val();

					var select_checklist_type = $("#select_checklist_type").val();

					var class_id = $("#class_id").val();

					var testing_mamber = $("#testing_mamber").val();

					var monitor_mamber = $("#monitor_mamber").val();

					if(select_checklist_type == "Class"){

						var select_batch = $("#select_batch").val();
					    var batch = select_batch.toString();

					}else if(select_checklist_type == "Discussion"){

                        var batch = $("#input_test_code_name").val();

					}

					var select_time_slot = $("#select_time_slot").val();

					var select_venue = $("#select_venue").val();

					if(class_date != "" & select_checklist_type != "" & class_id != "" & testing_mamber != "" & monitor_mamber != "" &select_batch != "" & batch != "" & select_time_slot != "" & select_venue != ""){
				
					$.ajax({
						url:"create_checklist.php",
						type:"POST",
						data:{class_date:class_date,select_checklist_type:select_checklist_type,class_id:class_id,testing_mamber:testing_mamber,monitor_mamber:monitor_mamber,batch:batch,select_time_slot:select_time_slot,select_venue:select_venue},
						success:function(data){
							if(data == 1){
								alert("Checklist Created!");
								cerate_checklist_form();

							}else if(data == 0){
								alert('This class ID is already Created');
								cerate_checklist_form();
							}



						}
					})
				}else{

                 alert("All field are required");

				}
				})

				$("#create_offline_checklist").on("click",function(){

					$.ajax({
						url:"addOfflineChecklist.php",
						type:"POST",
						success:function(data){
							$("#t1").html(data);
							$('#offline_select_batch').chosen();
						}
					})

				})

				$(document).on("click",".offline_insert_btn",function(){

				    var offline_class_date = $("#offline_class_date").val();
					var offline_class_id = $("#offline_class_id").val();
					var offline_select_batch = $("#offline_select_batch").val();

                    var batch = offline_select_batch.toString();

					var offline_subject_name = $("#offline_subject_name").val();
					var offline_class_number = $("#offline_subject_number").val();
					var offline_coordinator_name = $('#offline_coordinator_name').val();
					var offline_faculty_name = $('#offline_faculty_name').val();
					var offline_time_slot = $('#offline_time_slot').val();
					var offline_class_time = $("#offline_class_time").val();
					var offline_select_venue = $("#offline_select_venue").val();

					if(offline_class_date != "" && offline_class_id != "" && offline_select_batch != "" && batch != "" && offline_subject_name != "" && offline_class_number != "" && offline_coordinator_name != "" && offline_faculty_name != "" && offline_time_slot != "" && offline_class_time != "" && offline_select_venue != ""){

					$.ajax({
						url:"insert_offline_checklist.php",
						type:"POST",
						data:{offline_class_date:offline_class_date,offline_class_id:offline_class_id,batch:batch,offline_subject_name:offline_subject_name,
							offline_class_number:offline_class_number,offline_coordinator_name:offline_coordinator_name,offline_faculty_name:offline_faculty_name,offline_time_slot:offline_time_slot,
							offline_class_time:offline_class_time,offline_select_venue:offline_select_venue},
						success:function(data){

							if(data == 1){
								alert("Offline Checklist Created!");
								cerate_checklist_form();
							}else{
								alert('This class ID is already Created');
								cerate_checklist_form();
							}

						}

					})
				}else{

					alert("All field are required");

				}
					
					

					// console.log(offline_class_date);
					// console.log(offline_class_id);
					// console.log(batch);
					// console.log(offline_subject_name);
					// console.log(offline_class_number);
					// console.log(offline_coordinator_name);
					// console.log(offline_faculty_name);
					// console.log(offline_time_slot);
					// console.log(offline_class_time);
					// console.log(offline_select_venue);


				})

				$("#inser_venue").on("click",function(){
					$.ajax({
						url:"load_inser_venue_form.php",
						type:"POST",
						success:function(data){
							$("#t1").html(data);

						}
					})

				})
				$(document).on("click",".insert_venue",function(){
					var venue = $("#venue").val();
					//console.log(venue);
					$.ajax({
					url:"insert_venue.php",
					type:"POST",
					data:{venue:venue},
					success:function(data){
						if(data == 1){
							alert("Venue Updated!");
							cerate_checklist_form();

						}
					}

					})
					
				})


                    $("#inser_batch").on("click",function(){
					$.ajax({
						url:"load_inser_batch_form.php",
						type:"POST",
						success:function(data){
							$("#t1").html(data);

						}
					})

				})
				$(document).on("click",".insert_batch",function(){
					var batch = $("#batch").val();
					var batch_code = $("#batch_code").val();
					var batchSCode = $("#batchSCode").val();
					var batchTime = $("#batchTime").val();
					var batch_year = $("#batch_year").val();
					var offline_student = $("#offline_student").val();
					var online_student = $("#online_student").val();

					if(batch != "" && batch_code != "" && batchSCode != "" && batchTime != "" && batch_year != "" && offline_student != ""){
					
					$.ajax({
					url:"insert_batch.php",
					type:"POST",
					data:{batch:batch,batch_code:batch_code,batchSCode:batchSCode,batchTime:batchTime,batch_year:batch_year,offline_student:offline_student,online_student:online_student},
					success:function(data){
						if(data == 1){
							alert("batch Updated!");
							cerate_checklist_form();

						}else{
							alert("Batch Not Inserted");
						}
					}

					})
				}else{

					alert("All field are required");

				}
				})


				$("#insert_subject").on("click",function(){
					$.ajax({
						url:"load_inser_subject_form.php",
						type:"POST",
						success:function(data){
							$("#t1").html(data);

						}
					})


				})
				$(document).on("click",".insert_subject",function(){
					var subject = $("#subject").val();
					$.ajax({
						url:"insert_subject.php",
						type:"POST",
						data:{subject:subject},
						success:function(data){
							if(data == 1){
								alert("Subject Updated!!");
								cerate_checklist_form();

							}
						}
					})
				})

					$("#insert_faculty").on("click",function(){
					$.ajax({
						url:"load_inser_faculty_form.php",
						type:"POST",
						success:function(data){
							$("#t1").html(data);

						}
					})


				})
				$(document).on("click",".insert_faculty",function(){
					var faculty = $("#faculty").val();
					$.ajax({
						url:"insert_faculty.php",
						type:"POST",
						data:{faculty:faculty},
						success:function(data){
							if(data == 1){
								alert("faculty Updated!!");
								cerate_checklist_form();

							}
						}
					})
				})

				$("#insert_batch_coordinator").on("click",function(){
					$.ajax({
						url:"load_inser_batch_coordinator_form.php",
						type:"POST",
						success:function(data){
							$("#t1").html(data);

						}
					})


				})
				$(document).on("click",".insert_batch_coordinator",function(){
					var batch_coordinator = $("#batch_coordinator").val();
					if(batch_coordinator != ""){
					$.ajax({
						url:"insert_batch_coordinator.php",
						type:"POST",
						data:{batch_coordinator:batch_coordinator},
						success:function(data){
							if(data == 1){
								alert("Batch Coordinator Inserted!!");
								cerate_checklist_form();

							}else{
								alert("No Inserted");
							}
						}
					})
				}else{
					alert("Please Fill the Name first");
				}
				})


              $("#insert_camera_man").on("click",function(){
					$.ajax({
						url:"load_inser_camera_man_form.php",
						type:"POST",
						success:function(data){
							$("#t1").html(data);

						}
					})


				})
				$(document).on("click",".insert_camera_man",function(){
					var camera_man = $("#camera_man").val();
					$.ajax({
						url:"insert_camera_man.php",
						type:"POST",
						data:{camera_man:camera_man},
						success:function(data){
							if(data == 1){
								alert("Camera Man Updated!!");
								cerate_checklist_form();

							}
						}
					})
				})


                    $("#insert_lnternet_line").on("click",function(){
					$.ajax({
						url:"load_inser_internet_line_form.php",
						type:"POST",
						success:function(data){
							$("#t1").html(data);

						}
					})


				})

				$(document).on("click",".insert_internet_btn",function(){
					var Internet_line = $("#Internet_line").val();
					$.ajax({
						url:"insert_Internet_line.php",
						type:"POST",
						data:{Internet_line:Internet_line},
						success:function(data){
							if(data == 1){
								alert("Internet Line Updated!!");
								cerate_checklist_form();

							}
						}
					})
				})

				$("#insert_tech_support_person").on("click",function(){
					$.ajax({
						url:"load_tech_support_person_form.php",
						type:"POST",
						success:function(data){

							$("#t1").html(data);

						}
					})
				})
				$(document).on("click",".insert_tech_person",function(){
					var tech_person = $("#tech_person").val();
					$.ajax({
						url:"insert_tech_person.php",
						type:"POST",
						data:{tech_person:tech_person},
						success:function(data){
							if(data == 1){
								alert("Tech Person Updated!!");
								cerate_checklist_form();
							}
						}
					})
				})


	       



			})
		</script>
		<script type="text/javascript">
			function display_disscussion(){
				var select_checklist_type = document.getElementById('select_checklist_type').value;
				if(select_checklist_type == 'Discussion'){
					document.getElementById('classid').innerHTML = "Test ID";
					document.getElementById('batch_name').innerHTML = "Enter Test Code Subject";
					document.getElementById('test_code_name').style.display = "block";
					document.getElementById('select_batch_td').style.display = "none";
				}else if(select_checklist_type == 'Class'){
					document.getElementById('classid').innerHTML = "Class Id";
					document.getElementById('batch_name').innerHTML = "Batch";
					document.getElementById('test_code_name').style.display = "none";
					document.getElementById('select_batch_td').style.display = "block";
				}
			}
			
		</script>


	</body>