function apply_for_job(job_id){

    post_data[CSRF_NAME] = CSRF_VALUE;
    post_data['job_id'] = job_id;

    var result = 9

    $.post("{%$base_url%}user/ajax/apply_for_job",post_data,function(res){result = res;},"json");

    return result;
}