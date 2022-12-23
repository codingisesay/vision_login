    function callremark(){
    view_camera_focus();
    view_camera_battery();
    view_audio();
    view_remote_laptop();
    view_remote_ipad();
    batch_convay();
    next_class_remrk();
    testing_remrk()

    }



    function view_camera_focus(){
        var camera_remark = document.getElementById('camera_remark').value;
    console.log(camera_remark);
    if(camera_remark == ""){

        document.getElementById('camera').style.display = "none";

    }else{

        document.getElementById('camera').style.display = "block";

    }

    }
    function view_camera_battery(){
        var camera_battery_remark = document.getElementById('camera_battery_remark').value;
    console.log(camera_battery_remark);
    if(camera_battery_remark == ""){

        document.getElementById('camera_charge').style.display = "none";

    }else{

        document.getElementById('camera_charge').style.display = "block";

    }

    }


    function view_audio(){
        var audio_remark = document.getElementById('audio_remark').value;
   
    if(audio_remark == ""){

        document.getElementById('audio').style.display = "none";

    }else{

        document.getElementById('audio').style.display = "block";

    }

    }

    function view_remote_laptop(){
        var remote_laptop_remark = document.getElementById('remote_laptop_remark').value;
    
    if(remote_laptop_remark == ""){

        document.getElementById('Laptop').style.display = "none";

    }else{

        document.getElementById('Laptop').style.display = "block";

    }
    }

    function view_remote_ipad(){
        var remote_ipad_remark = document.getElementById('remote_ipad_remark').value;
   
    if(remote_ipad_remark == ""){

        document.getElementById('remote_ipad').style.display = "none";

    }else{

        document.getElementById('remote_ipad').style.display = "inline";

    }
    }

    function batch_convay(){
           var batch_coo_remark = document.getElementById('batch_coo_remark').value;
   
    if(batch_coo_remark == ""){

        document.getElementById('Coordinator_convay').style.display = "none";

    }else{

        document.getElementById('Coordinator_convay').style.display = "block";

    }

    }

       function next_class_remrk(){
           var next_class_remark = document.getElementById('next_class_remark').value;
   
    if(next_class_remark == ""){

        document.getElementById('next_remark').style.display = "none";

    }else{

        document.getElementById('next_remark').style.display = "block";

    }

    }


       function testing_remrk(){
           var testing_qu_remark = document.getElementById('testing_qu_remark').value;
   
    if(testing_qu_remark == ""){

        document.getElementById('query_remark').style.display = "none";

    }else{

        document.getElementById('query_remark').style.display = "block";

    }

    }



