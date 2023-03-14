<?php
session_start();

include('../testing/testing_functions.php');
if(!isset($_SESSION['admin_id'])){
	
	header('location:index.php');


}

	?>
	<head>
		<link rel="stylesheet" href="admin css/admin_home.css">
		<link rel="stylesheet" href="chosen/chosen.min.css">
		
	</head>
	<body>
		<div id="side_btns">
			<button type="submit" id="create_checklist">Create Checklist</button>
			<button type="submit" id="inser_venue">Insert Venue</button>
			<button type="submit" id="inser_batch">Insert Batch</button>
			<button type="submit" id="insert_subject">Subject</button>
			<button type="submit" id="insert_faculty">Faculty</button>
			<button type="submit" id="insert_batch_coordinator">Batch Coordinator</button>
			<button type="submit" id="insert_camera_man">Camera Man</button>
			<button type="submit" id="insert_lnternet_line">Internet Line</button>
			<button type="submit" id="insert_tech_support_person">Tech Person</button>
			<button type="submit"><a href="admin_logout.php" style="color: white; text-decoration:none">LogOut</a></button>
			
		</div>
		<div id="show_data">
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
					
					$.ajax({
					url:"insert_batch.php",
					type:"POST",
					data:{batch:batch,batch_code:batch_code},
					success:function(data){
						if(data == 1){
							alert("batch Updated!");
							cerate_checklist_form();

						}
					}

					})
					
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
					$.ajax({
						url:"insert_batch_coordinator.php",
						type:"POST",
						data:{batch_coordinator:batch_coordinator},
						success:function(data){
							if(data == 1){
								alert("Batch Coordinator Updated!!");
								cerate_checklist_form();

							}
						}
					})
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