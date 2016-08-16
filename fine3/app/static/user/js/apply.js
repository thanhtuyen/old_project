function apply_post(post_data){
    var result = 9
    $.post(BASE_URL+"user/ajax/apply_for_job",post_data,function(res){result= res;},"json");
    return result;
}

function apply_for_job(target_job,type){
    var post_data = {};
    post_data[CSRF_NAME] = CSRF_VALUE;
    post_data["job_id"] = target_job.data("job_id");
    post_data["type"] = type;
    $("#loading_layer").removeClass("display_none");
    $.ajax({
        type: "POST",
        url : BASE_URL+"user/ajax/apply_for_job",
        dataType : "json",
        data: post_data,
        success: function(response) {
            if(response["code"] === 0){
                $(location).attr("href",BASE_URL+"server_error");
            }else{
                if(response["result"] === 1){
                    $("." + type + "_job_"+target_job.data("job_id")).addClass("display_none");
                    $("." + type + "_finished_job_"+target_job.data("job_id")).removeClass("display_none");
                    if(response["type"] === "apply"){
                        ga('set','dimension1','login');
                        ga('send','pageview','/detail_'+post_data["job_id"]);
                    }
                }else if(response["result"] === 2){
                    $(location).attr("href",BASE_URL+"signup/"+response["type"]);
                }else{
                    $(location).attr("href",BASE_URL+"server_error");
                }
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown){
            /*$(location).attr("href",BASE_URL+"server_error");*/
        },
        complete:function(data){$("#loading_layer").addClass("display_none");}


    });
}