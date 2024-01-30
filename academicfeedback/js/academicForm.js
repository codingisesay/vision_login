$(document).ready(function(){
    $("#videoSynopsis_td").on("change",function(){
        var videoSynopsis = $("#videoSynopsis").val();
        if(videoSynopsis == "Yes"){

            $("#videoSynopsiscomment").hide();
            $("#videoSynopsiscomment").attr("required", false);

        }else if(videoSynopsis == "No"){
            $("#videoSynopsiscomment").show();
            $("#videoSynopsiscomment").attr("required",true);
        }else{
            $("#videoSynopsiscomment").hide();
        }
        
    })

    $("#synopsisPrevious_td").on("change",function(){
        var synopsisPrevious = $("#synopsisPrevious").val();
        if(synopsisPrevious == "Yes"){

            $("#synopsisPreviouscomment").hide();
            $("#synopsisPreviouscomment").attr('required',false);

        }else if(synopsisPrevious == "No"){
            $("#synopsisPreviouscomment").show();
            $("#synopsisPreviouscomment").attr('required', true);
        }else{
            $("#synopsisPreviouscomment").hide();
        }
        
    })

    $("#queryNotReplied_id").on("change",function(){
        var queryNotReplied = $("#queryNotReplied").val();
        if(queryNotReplied == "Yes"){

            $("#queryNotRepliedcomment").show();
            $("#queryNotRepliedcomment").attr('required',true);

        }else if(queryNotReplied == "No"){
            $("#queryNotRepliedcomment").hide();
            $("#queryNotRepliedcomment").attr('required',false);
        }else{
            $("#queryNotRepliedcomment").hide();
        }
        
    })

    $("#QuestionPrompter_tr").on("change",function(){
        var QuestionPrompter = $("#QuestionPrompter").val();
        if(QuestionPrompter == "Yes"){

            $("#QuestionPromptercomment").show();
            $("#QuestionPromptercomment").attr('required',true);

        }else if(QuestionPrompter == "No"){
            $("#QuestionPromptercomment").hide();
            $("#QuestionPromptercomment").attr('required',false);
        }else{
            $("#QuestionPromptercomment").hide();
        }
        
    })

    $("#videoremoveportion_td").on("change",function(){
        var videoremoveportion = $("#videoremoveportion").val();
        if(videoremoveportion == "Yes"){

            $("#videoremoveportioncomment").show();
            $("#videoremoveportioncomment").attr('required', true);

        }else if(videoremoveportion == "No"){
            $("#videoremoveportioncomment").hide();
            $("#videoremoveportioncomment").attr('required', false);
        }else{
            $("#videoremoveportioncomment").hide();
        }
        
    })

    $("#specificissuehighlight_tr").on("change",function(){
        var specificissuehighlight = $("#specificissuehighlight").val();
        if(specificissuehighlight == "Yes"){

            $("#specificissuehighlightcomment").show();
            $("#specificissuehighlightcomment").attr('required', true);

        }else if(specificissuehighlight == "No"){
            $("#specificissuehighlightcomment").hide();
            $("#specificissuehighlightcomment").attr('required', false);
        }else{
            $("#specificissuehighlightcomment").hide();
        }
        
    })

    $("#managementtechnicalissue_tr").on("change",function(){
        var managementtechnicalissue = $("#managementtechnicalissue").val();
        if(managementtechnicalissue == "Yes"){

            $("#managementtechnicalissuecomment").show();
            $("#managementtechnicalissuecomment").attr('required',true);

        }else if(managementtechnicalissue == "No"){
            $("#managementtechnicalissuecomment").hide();
            $("#managementtechnicalissuecomment").attr('required',false);
        }else{
            $("#managementtechnicalissuecomment").hide();
        }
        
    })
    
    $("#resionfordelay_td").on("change",function(){
        var resionfordelay = $("#resionfordelay").val();
        if(resionfordelay == "Yes"){

            $("#resionfordelaycomment").show();
            $("#resionfordelaycomment").attr("required", true);

        }else if(resionfordelay == "No"){
            $("#resionfordelaycomment").hide();
            $("#resionfordelaycomment").attr("required", false);
        }else{
            $("#resionfordelaycomment").hide();
        }
        
    })

    $("#classendeatlyremark_id").on("change",function(){
        var classendeatlyremark = $("#classendeatlyremark").val();
        if(classendeatlyremark == "Yes"){

            $("#classendeatlyremarkcomment").show();
            $("#classendeatlyremarkcomment").attr("required", true);

        }else if(classendeatlyremark == "No"){
            $("#classendeatlyremarkcomment").hide();
            $("#classendeatlyremarkcomment").attr("required", false);
        }else{
            $("#classendeatlyremarkcomment").hide();
        }
        
    })

    var resionfordelay = $("#resionfordelay").val();
    var classendeatlyremark = $("#classendeatlyremark").val();
    var videoSynopsis = $("#videoSynopsis").val();
    var synopsisPrevious = $("#synopsisPrevious").val();
    var queryNotReplied = $("#queryNotReplied").val();
    var QuestionPrompter = $("#QuestionPrompter").val();
    var specificissuehighlight = $("#specificissuehighlight").val();
    var managementtechnicalissue = $("#managementtechnicalissue").val();
    var videoremoveportion = $("#videoremoveportion").val();

    
    
    
    
    

    

    
    
    if(resionfordelay == "Yes"){

        $("#resionfordelaycomment").show();

    }

    if(classendeatlyremark == "Yes"){

        $("#classendeatlyremarkcomment").show();

    }
    if(videoSynopsis == "No"){

        $("#videoSynopsiscomment").show();

    }

    if(synopsisPrevious == "No"){

        $("#synopsisPreviouscomment").show();

    }

    if(queryNotReplied == "Yes"){

        $("#queryNotRepliedcomment").show();

    }

    if(QuestionPrompter == "Yes"){

        $("#QuestionPromptercomment").show();

    }

    if(specificissuehighlight == "Yes"){

        $("#specificissuehighlightcomment").show();

    }

    if(managementtechnicalissue == "Yes"){

        $("#managementtechnicalissuecomment").show();

    }

    if(videoremoveportion == "Yes"){

        $("#videoremoveportioncomment").show();

    }

    

    
    
})