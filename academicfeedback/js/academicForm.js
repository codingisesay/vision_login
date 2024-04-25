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

    var dictation = $("#dictationinclass").val();
    console.log(dictation);

    if(dictation == "Yes"){
        $("#chunk").show();
        $("#noofpag").show();
        $("#dictationinclasschunk").attr('required',true);
        $("#Approximatelypages").attr('required',true);
    }else{
        $("#chunk").hide();
        $("#noofpag").hide(); 
        $("#dictationinclasschunk").attr("required", false);
        $("#Approximatelypages").attr("required", false);  
    }

    $("#dictationinclass_td").on("change",function(){
        var dictation = $("#dictationinclass").val();
        console.log(dictation);

        if(dictation == "Yes"){
            $("#chunk").show();
            $("#noofpag").show();
            $("#dictationinclasschunk").attr('required',true);
            $("#Approximatelypages").attr('required',true);
        }else{
            $("#chunk").hide();
            $("#noofpag").hide(); 
            $("#dictationinclasschunk").attr("required", false);
            $("#Approximatelypages").attr("required", false);  
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
            // $("#videoremoveportioncomment").attr('required', true);

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

    $("#facultymeetexpectation_id").on("change",function(){
        var facultymeetexpectation = $("#facultymeetexpectation").val();
        if(facultymeetexpectation == "No"){

            $("#differencedonecomment").show();
            $("#differencedonecomment").attr("required", true);

        }else if(facultymeetexpectation == "Yes"){
            $("#differencedonecomment").hide();
            $("#differencedonecomment").attr("required", false);
        }else{
            $("#differencedonecomment").hide();
        }
        
    })

    $("#facultymeetexpectation_id").on("change",function(){
        var facultymeetexpectation = $("#facultymeetexpectation").val();
        
        if(facultymeetexpectation == "No"){

            $("#whatDifferencedone").show();

        }else{
            $("#whatDifferencedone").hide();
        }

    })

    $("#linkwithcurrentaffair_id").on("change",function(){
        var linkwithcurrentaffair = $("#linkwithcurrentaffair").val();
        if(linkwithcurrentaffair == "Applicable"){

            $(".displaynone").show();

        }else{
            $(".displaynone").hide();
        }

    })

    $("#hanoutinclass_td").on("change",function(){
        var hanoutinclass = $("#hanoutinclass").val();
        console.log(hanoutinclass);
        if(hanoutinclass == "Yes"){

            $("#sent_to_class_support").show();
            $("#handoutToTechteam").attr("required", true);

        }else{
            $("#sent_to_class_support").hide();
            $("#handoutToTechteam").attr("required", false);
        }

    })

    

    $("#atAnyPoint").on("change",function(){
        // var val = $("#atAnyPoint").val();
        if ($("#atAnyPoint").is(
            ":checked")) {
            $("#atAnyPointcomment").show();
        } else {
            $("#atAnyPointcomment").hide();
        }

           

    })

    $("#issueHighlighted").on("change",function(){
        // var val = $("#atAnyPoint").val();
        if ($("#issueHighlighted").is(
            ":checked")) {
            $("#issueHighlightedcomment").show();
        } else {
            $("#issueHighlightedcomment").hide();
        }

           

    })

    $("#anyOtherFeedback").on("change",function(){
        // var val = $("#atAnyPoint").val();
        if ($("#anyOtherFeedback").is(
            ":checked")) {
            $("#anyOtherFeedbackcomment").show();
        } else {
            $("#anyOtherFeedbackcomment").hide();
        }

           

    })
//For update page
    var resionfordelay = $("#resionfordelay").val();
    var classendeatlyremark = $("#classendeatlyremark").val();
    var videoSynopsis = $("#videoSynopsis").val();
    var synopsisPrevious = $("#synopsisPrevious").val();
    var queryNotReplied = $("#queryNotReplied").val();
    var QuestionPrompter = $("#QuestionPrompter").val();
    var specificissuehighlight = $("#specificissuehighlight").val();
    var managementtechnicalissue = $("#managementtechnicalissue").val();
    var videoremoveportion = $("#videoremoveportion").val();
    var hanoutinclass = $("#hanoutinclass").val();

    

    // var atAnyPoint = $("#atAnyPoint").val();
    // var issueHighlighted = $("#issueHighlighted").val();
    // var anyOtherFeedback = $("#anyOtherFeedback").val();
    var facultymeetexpectation = $("#facultymeetexpectation").val();

    var linkwithcurrentaffair = $("#linkwithcurrentaffair").val();
    if(linkwithcurrentaffair == "Applicable"){

        $(".displaynone").show();

    }else{
        $(".displaynone").hide();
    }

    if ($("#atAnyPoint").is(
        ":checked")) {
        $("#atAnyPointcomment").show();
    } else {
        $("#atAnyPointcomment").hide();
    }

    if ($("#issueHighlighted").is(
        ":checked")) {
        $("#issueHighlightedcomment").show();
    } else {
        $("#issueHighlightedcomment").hide();
    }


    if ($("#anyOtherFeedback").is(
        ":checked")) {
        $("#anyOtherFeedbackcomment").show();
    } else {
        $("#anyOtherFeedbackcomment").hide();
    }

    if(hanoutinclass == 'Yes'){

        $("#sent_to_class_support").show();

    }else{
        $("#sent_to_class_support").hide(); 
    }

    if(facultymeetexpectation == 'No'){

        $("#whatDifferencedone").show();

    }else{
        $("#whatDifferencedone").hide(); 
    }


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

    $.ajax({

    })
$("#usr").on('change',function(){
    var start = $("#usr").val();
    console.log(start);
})
    
    
})