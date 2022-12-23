    function display_discussion_form(){
        var checklist_form = document.getElementById("checklist_form").value;
        if(checklist_form == "classes"){
        
        var pr = document.getElementsByClassName("Discussion_disable");
        for(i = 0; i < pr.length; i++) {
        pr[i].style.display = '';
       }
       
    }else if(checklist_form == "discussion"){

        var pr = document.getElementsByClassName("Discussion_disable");
        for(i = 0; i < pr.length; i++) {
        pr[i].style.display = 'none';
       }
    }

    }



    function camera_focous_remark(){
    var Camera_Focous = document.getElementById("Camera_Focous").value;
      
       if(Camera_Focous == "Incorrect"){
        
        document.getElementById("Camera_Focous_incorrect_remark").style.display = "block";
      }else{
        document.getElementById("Camera_Focous_incorrect_remark").style.display = "none";
      }

    }


        function Camera_Battery_remark(){
        var Camera_Battery = document.getElementById("Camera_Battery").value;
        if(Camera_Battery == "Charger Not Pluged"){

            document.getElementById("Camera_Battery_incorrect_remark").style.display = "block";
            
        }else{
            document.getElementById("Camera_Battery_incorrect_remark").style.display = "none";
        }

    }

    function Memory_Card_remark(){
       var memory_card = document.getElementById("Memory_Card").value;
       if (memory_card == "Inserted") {
        document.getElementById("memory_card_remark").style.display ="block";
        document.getElementById("memory_card_remark").placeholder = "Enter Time duration of available recoding";
       }else if(memory_card == "Not Inserted"){
        document.getElementById("memory_card_remark").style.display ="block";
        document.getElementById("memory_card_remark").placeholder ="Remark";

       }else{
        document.getElementById("memory_card_remark").style.display ="none";
       }
    }

    function Audio_Live_remark(){
        var audio_live = document.getElementById("Audio_Live").value;
        if(audio_live == "Checked"){

            document.getElementById("audio_live_remark").style.display = "block";
            document.getElementById("audio_live_remark").placeholder = "Enter Audio Level";

        }else if(audio_live == "Unchecked"){
             document.getElementById("audio_live_remark").style.display ="block";
             document.getElementById("audio_live_remark").placeholder ="Remark";
        }else{
            document.getElementById("audio_live_remark").style.display ="none";
        }
    }

    function Remote_System(){
        var remote_system = document.getElementById("Remote_System_Laptop").value;
        if(remote_system == "Not Connected"){

        document.getElementById("remote_system_remark").style.display = "block";

        }else{

            document.getElementById("remote_system_remark").style.display = "none";

        }
    }

    function Remote_SystemIpad(){
        var Remote_I_pad = document.getElementById("Remote_System_I_pad").value;
        if(Remote_I_pad == "Not Connected"){
          document.getElementById("remote_system_i_pad_remark").style.display = "block";
        }
        else{
            document.getElementById("remote_system_i_pad_remark").style.display = "none";
        }
    }

    function Conved_To_BatchCoo(){
        var Conved_To_Batch_Coo = document.getElementById("Conved_To_Batch_Coo").value;
        if(Conved_To_Batch_Coo == "no"){
          document.getElementById("Conved_To_Batch_Coo_remark").style.display = "block";
        }else{
            document.getElementById("Conved_To_Batch_Coo_remark").style.display = "none";
        }
    }

    function Handout_mark(){
        var handout_remark = document.getElementById("Handout_remark").value;
        if(handout_remark == "Uploaded"){
    document.getElementById("handout_remark").style.display = "block";
    document.getElementById("handout_remark").placeholder = "Enter Handout Name";
        }else if(handout_remark == "Not Uploaded"){
           document.getElementById("handout_remark").style.display = "block";
    document.getElementById("handout_remark").placeholder = "Remark"; 
        }else{
             document.getElementById("handout_remark").style.display = "none";
        }
    }

    function Next_Class(){
        var Next_Class_Update = document.getElementById("Next_Class_Update").value;
        if(Next_Class_Update == "no"){

    document.getElementById("next_class_remark").style.display = "block";

        }else{
            document.getElementById("next_class_remark").style.display = "none";
        }
    }

    function query_testing_check(){
        var query_testing = document.getElementById("query_testing").value;
        if(query_testing == "Not Tested"){

            document.getElementById("query_testing_remark").style.display = "block";

        }else{

          document.getElementById("query_testing_remark").style.display = "none";

        }
    }

    function Event_Post(){
        var Event_Post_Update = document.getElementById("Event_Post_Update").value;
        if(Event_Post_Update == "no"){
         document.getElementById("Event_Post_Update_remark").style.display="block";
        }else{
            document.getElementById("Event_Post_Update_remark").style.display="none";
        }
    }



    function internet_spd(){
        var internet_speed = document.getElementById("internetline").value;
        if(internet_speed !== " "){
          document.getElementById("internet_speed").style.display = "block";
          document.getElementById("internet_speed").placeholder = "Enter internet Speed";
        }else{
          document.getElementById("internet_speed").style.display = "none";
        }
    }

    function board_merker_digital_pen(){
        var meker_pen = document.getElementById("marker_pen").value;
        if(meker_pen == "Unchecked"){
            document.getElementById("board_pen_marker_remark").style.display = "block";
        }else{
            document.getElementById("board_pen_marker_remark").style.display = "none";
        }
    }

    function disply_synopsis(){
        var synopsis = document.getElementById("pre_synopsis").value;
        if(synopsis == "No"){
            document.getElementById("display_synopsis_remark").style.display = "block";

        }else{
            document.getElementById("display_synopsis_remark").style.display = "none";

        }
    }
