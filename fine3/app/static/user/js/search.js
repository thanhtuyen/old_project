var select = { select_pref : "" , select_city : "" , select_job : "" , select_nursery : "" , select_employee : "" , select_tag : "" };
var select_str = "";

select_pref();
select_city();
common_search_selecter("select_job");
common_search_selecter("select_nursery");
common_search_selecter("select_employee");
common_search_selecter("select_tag");

if(select_str.length >= 24){
    $(".search_cond_word_detail").attr('data-tooltip',"検索条件詳細：<br>"+select_str);
    $(".search_cond_word").text(select_str.substr(0,22) + "...");
}else if(select_str.length === 0){
    $(".search_cond_word").text("全検索");
}else{
    $(".search_cond_word").text(select_str);
}

$("#job_search_submit").on("click",function(){
    var pref = select["select_pref"] === "" ? "" :select["select_pref"] * 1000;
    var get_params = "pref="+ pref +"&city="+select["select_city"]+"&job="+select["select_job"]+"&nursery="+select["select_nursery"]+"&employee="+select["select_employee"]+"&tag="+select["select_tag"];
    $(location).attr("href",BASE_URL+"search?"+get_params);
});

$("#select_pref").change(function(){
    $(".select_area_list").removeClass("error_txt");
    $(".select_city").prop('checked', false);
    select["select_city"] = "";
    select_pref();
    get_job_count();
});
$(".select_city").on("click",function(){
    select_city();
    get_job_count();
});
$(".select_job").on("click",function(){
    common_search_selecter("select_job");
    get_job_count();
});
$(".select_nursery").on("click",function(){
    common_search_selecter("select_nursery");
    get_job_count();
});
$(".select_employee").on("click",function(){
    common_search_selecter("select_employee");
    get_job_count();
});
$(".select_tag").on("click",function(){
    common_search_selecter("select_tag");
    get_job_count();
});

$(".apply_btn").on("click",function(e){apply_for_job($(this),"apply");});

$(".bookmark_btn").on("click",function(e){apply_for_job($(this),"bookmark");});

$(".accordion").map(function() {
    var accordion = $(this);
    accordion.find(".toggle").click(function(){
        $("p.search_txt").removeClass("display_none");
        var accordion_inbox = $(this).next("div.accordion_inbox");
        if(accordion_inbox.css("display") === "none" ){
            accordion.find("div.accordion_inbox").slideUp().find(".toggle.open").removeClass("open");
            $(this).parent().children("p.search_txt").addClass("display_none");
        }
        accordion_inbox.slideToggle().toggleClass("open");
    });
});

$('.light_m').darkTooltip({size:"medium"});

function select_pref(){
    select["select_pref"] = $("#select_pref").val();
    var pref_str = $("#select_pref option:selected").text();
    if(select["select_pref"] === ""){
        $("#city_selecter").addClass("display_none");
    }else{
        $("#city_selecter").removeClass("display_none");
        select_str = pref_str;
    }
    $("[class^=relate_pref_]").addClass("display_none");
    $(".relate_pref_" + select["select_pref"]).removeClass("display_none");
    $(".select_area_list").html(pref_str);
}

function select_city(){
    var select_city_list = "";
    select["select_city"] = "";
    $(".select_city:checked").map(function(){
        if(select_city_list === ""){
            select["select_city"] = $(this).val();
            select_city_list = $(this).parent("label").text();
        }else{
            select["select_city"] += ","+$(this).val();
            select_city_list += " , " + $(this).parent("label").text();
        }
    });
    if(select_city_list !== ""){
        select_str = select_city_list;
        select_city_list = "：《 "+select_city_list+" 》";
    }
    $(".select_area_list").html($("#select_pref option:selected").text() + select_city_list);
}

function common_search_selecter(selecter){
    var common_list = "";
    select[selecter] = "";
    $("."+selecter+":checked").map(function(){
        if(common_list === ""){
            select[selecter] = $(this).val();
            common_list = $(this).parent("label").text();
        }else{
            select[selecter] += ","+$(this).val();
            common_list += " , " + $(this).parent("label").text();
        }
    });
    if(common_list === ""){
        common_list = "未選択";
    }else{
        select_str = select_str + " , "+common_list;
    }
    $("."+selecter+"_list").html(common_list);
}

function get_job_count(){
    $.ajax({
        type: "POST",
        url : BASE_URL+"user/ajax/get_job_count",
        dataType : "json",
        data: {
            select: select,
            CSRF_TOKEN_NAME: CSRF_TOKEN_VALUE
        },
        success: function(res) {
            $(".job_all_count").html(res);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            /*alert(XMLHttpRequest+textStatus+errorThrown)*/
        }
    });
}