/* signup common validations */

var error,error_position;
var page_trans_flg = false;

$(".form_submit").on("click",function(){
    error = false;
    error_position = 100000;
    mail();
    password();
    passconf()
    name();
    kana();
    zip1();
    zip2();
    address_pref();
    address_city();
    address_detail();
    tel();
    license();

    if(error){
        $('html,body').animate({ scrollTop: error_position - 40 }, 'fast');
    }else{
        $("#area_id").val($("option","#address_city").eq($("#address_city")[0].selectedIndex).data("city_area_id"));
        page_trans_flg = true;
        $("#register_form").submit();
    }
});

$(".lp_submit").on("click",function(){

    error = false;
    error_position = 100000;
    mail();
    name();
    kana();
    zip1();
    zip2();
    address_pref();
    address_city();
    tel();
    license();

    if(error){
        $('html,body').animate({ scrollTop: error_position - 40 }, 'fast');
    }else{
        $("#area_id").val($("option","#address_city").eq($("#address_city")[0].selectedIndex).data("city_area_id"));
        page_trans_flg = true;
        $("#register_form").submit();
    }
});

$('.registered_login').on('click',function(){page_trans_flg = true;});
$(window).on("beforeunload",function(){if(!page_trans_flg)return "他のページに移動すると入力内容は消去されます。";});
$('#mail').on('blur',function(){if($('#domain_candidate').css('display') == 'none'){mail();}});
$('#password').on('change',function(){password();});
$('#passconf').on('change',function(){passconf();});
$('#name').on('change',function(){name();common_input_check('#kana');});
$('#kana').on('change',function(){kana();});
$('#zip1').on('change',function(){zip1();});
$('#zip2').on('change',function(){zip2();ccs();common_input_check('#address_pref');common_input_check('#address_city');});
$('#address_pref').on('change',function(){address_pref();});
$('#address_city').on('change',function(){address_city();});
$('#address_detail').on('change',function(){address_detail();});
$('#tel').on('keyup',function(){tel();});
$('#tel').on('change',function(){tel();});

function mail(){
    var mail = $('#mail').val();
    if(mail_style_valid(mail)){
        $("#mail_err").addClass("display_none");
        $("#mail_check_length").addClass("display_none");
        result = mail_check(mail);
        if(mail.length > 255) {
            $("#mail_err").addClass("display_none");
            $("#mail_exist").addClass("display_none");
            $("#mail_check_length").removeClass("display_none");
            $("#mail").addClass("form_pink");
            set_error_position($("#mail").position().top);
            error = true;
        }else  {
            if(result === 0){
                $("#mail_exist").addClass("display_none");
                $("#mail").removeClass("form_pink");
            }else if (result === 1){
                $("#mail_exist").removeClass("display_none");
                $("#mail").addClass("form_pink");
                set_error_position($("#mail").position().top);
                error = true;
            }else if (result === 8){
                console.log('処理中にエラーが発生しました')
                $(location).attr("href",BASE_URL+"server_error");
            }else if (result === 9){
                console.log('通信エラーが発生しました');
                $(location).attr("href",BASE_URL+"server_error");
            }
        }

    }else{
        $("#mail_err").removeClass("display_none");
        $("#mail_exist").addClass("display_none");
        $("#mail_check_length").addClass("display_none");
        $("#mail").addClass("form_pink");
        set_error_position($("#mail").position().top);
        error = true;
    }
}

function password(){
    var password = $('#password').val();
    if(password.length > 255){
        $("#password_err").addClass("display_none");
        $("#password_xss_err").addClass("display_none");
        $("#password_check_length").removeClass("display_none");
        $("#password").addClass("form_pink");
        $("#passconf").addClass("form_pink");
        set_error_position($("#password").position().top);
        error = true;
    }else if(!password.match(/^[a-z0-9\-\$\@\#\!\%\^\*\&\'\:\(\)\+\?\;\"\=\,\]\~\<\>\|\{\}\[\]]{6,32}$/)){
        $("#password_xss_err").addClass("display_none");
        $("#password_check_length").addClass("display_none");
        $("#password_err").removeClass("display_none");
        $("#password").addClass("form_pink");
        $("#passconf").addClass("form_pink");
        set_error_position($("#password").position().top);
        error = true;
    }else if(password.match(/\<[a-zA-Z0-9]+\>/)){
        $("#password_err").addClass("display_none");
        $("#password_check_length").addClass("display_none");
        $("#password_xss_err").removeClass("display_none");
        $("#password").addClass("form_pink");
        $("#passconf").addClass("form_pink");
        set_error_position($("#password").position().top);
        error = true;
    }else{
        $("#password_err").addClass("display_none");
        $("#password_xss_err").addClass("display_none");
        $("#password_check_length").addClass("display_none");
        $("#password").removeClass("form_pink");
    }
}

function passconf(){

    var password = $("#password").val();
    var passconf = $("#passconf").val();
    if(passconf === ""){
        $("#passconf_incorrect").addClass("display_none");
        $("#passconf_err").removeClass("display_none");
        $("#passconf_check_length").addClass("display_none");
        $("#passconf").addClass("form_pink");
        set_error_position($("#password").position().top);
        error = true;
    }else if(passconf.length > 255){
        $("#passconf_incorrect").addClass("display_none");
        $("#passconf_err").addClass("display_none");
        $("#passconf_check_length").removeClass("display_none");
        $("#passconf").addClass("form_pink");
        set_error_position($("#password").position().top);
        error = true;
    }else if(passconf !== password){
        $("#passconf_err").addClass("display_none");
        $("#passconf_check_length").addClass("display_none");
        $("#passconf_incorrect").removeClass("display_none");
        $("#passconf").addClass("form_pink");
        set_error_position($("#password").position().top);
        error = true;
    }else{
        $("#passconf_err").addClass("display_none");
        $("#passconf_incorrect").addClass("display_none");
        $("#passconf_check_length").addClass("display_none");
        $("#password").removeClass("form_pink");
        $("#passconf").removeClass("form_pink");
    }
}

function name(check_type){
    var name = $("#name").val();
    if( !$("#name").val().match(/^[^\x01-\x7E]+$/)){
        $("#name_err").removeClass("display_none");
        $("#name_check_length").addClass("display_none");
        $("#name").addClass("form_pink");
        set_error_position($("#name").position().top);
        error = true;
    }else if(name.length > 255){
        $("#name_err").addClass("display_none");
        $("#name_check_length").removeClass("display_none");
        $("#name").addClass("form_pink");
        set_error_position($("#name").position().top);
        error = true;
    }else{
        $("#name_err").addClass("display_none");
        $("#name_check_length").addClass("display_none");
        $("#name").removeClass("form_pink");
    }
}

function kana(){
    var kana = $("#kana").val();
    if( !$("#kana").val().match(/^[ァ-ン　]+$/)){
        $("#kana_err").removeClass("display_none");
        $("#kana_check_length").addClass("display_none");
        $("#kana").addClass("form_pink");
        set_error_position($("#name").position().top);
        error = true;
    }else if(kana.length > 255){
        $("#kana_err").addClass("display_none");
        $("#kana_check_length").removeClass("display_none");
        $("#name").addClass("form_pink");
        set_error_position($("#name").position().top);
        error = true;
    }else{
        $("#kana_err").addClass("display_none");
        $("#kana_check_length").addClass("display_none");
        $("#kana").removeClass("form_pink");
    }
}

function zip1(){
    if( !$("#zip1").val().match(/^[0-9]{3}$/)){
        $("#zip_err").removeClass("display_none");
        $("#zip1").addClass("form_pink");
        set_error_position($("#address").position().top);
        error = true;
    }else{
        $("#zip_err").addClass("display_none");
        $("#zip1").removeClass("form_pink");
    }
}

function zip2(){
    if( !$("#zip2").val().match(/^[0-9]{4}$/)){
        $("#zip_err").removeClass("display_none");
        $("#zip2").addClass("form_pink");
        set_error_position($("#address").position().top);
        error = true;
    }else{
        $("#zip_err").addClass("display_none");
        $("#zip2").removeClass("form_pink");
    }
}

function address_pref(){
    common_valid("#address_pref",'address');
}

function address_city(){
    common_valid("#address_city",'address');
}

function address_detail(){
    var address_detail = $("#address_detail").val();
//    if(!$("#address_detail").val().match(/^([^\x01-\x7E]|[0-9\-])+$/)){
//        $("#address_detail_err").removeClass("display_none");
//        $("#address_detail_check_length").addClass("display_none");
//        $("#address_detail").addClass("form_pink");
//        set_error_position($("#address").position().top);
//        error = true;
//    }else
    if(address_detail.length > 255){
        $("#address_detail_err").addClass("display_none");
        $("#address_detail_check_length").removeClass("display_none");
        $("#address_detail").addClass("form_pink");
        set_error_position($("#address").position().top);
        error = true;
    }else{
        $("#address_detail_err").addClass("display_none");
        $("#address_detail_check_length").addClass("display_none");
        $("#address_detail").removeClass("form_pink");
    }
}

function tel(){
    var tel = $('#tel').val();
    if( tel === '' ){
        $("#tel_num_err").addClass("display_none");
        $("#tel_err").removeClass("display_none");
        $("#tel").addClass("form_pink");
        set_error_position($("#tel").position().top);
        error = true;
    }else{
        if( !tel.match(/^[0-9]+$/)){
            $("#tel_err").addClass("display_none");
            $("#tel_num_err").removeClass("display_none");
            $("#tel").addClass("form_pink");
            set_error_position($("#tel").position().top);
            error = true;
        }else if( tel.length !== 10 && tel.length !== 11){
            $("#tel_num_err").addClass("display_none");
            $("#tel_err").removeClass("display_none");
            $("#tel").addClass("form_pink");
            set_error_position($("#tel").position().top);
            error = true;
        }else{
            $("#tel_err").addClass("display_none");
            $("#tel_num_err").addClass("display_none");
            $("#tel").removeClass("form_pink");
        }
    }
}

function license(){

    var area = $('.license:checked').map(function(){return $(this).val();}).get();

    if(area == ""){
        $("#license_err").removeClass("display_none");
        $("#license").addClass("form_pink");
        set_error_position($("#license").position().top);
        error = true;
    }else{
        $("#license_err").addClass("display_none");
        $("#license").removeClass("form_pink");
    }
}

function mail_check(mail){
    var result = 9;
    var connection_success = false;
    var connection = 0;
    var connection_limit = 3;
    var post_data = {};
    post_data[CSRF_NAME] = CSRF_VALUE;
    post_data['mail'] = mail;
    post_data['type'] = "signup";
    while(connection < connection_limit){
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'user/ajax/same_mail_search',
            async: false,
            dataType: 'json',
            data: post_data,
            success: function(res) {
                connection_success = true
                if(res["code"] === 1){
                    result = res["result"];
                }else if(res["code"] === 0){
                    result = 8;
                }
            },
            error: function(){
                console.log('AJAX CONNECTION ERROR ('+connection+')')
            }
        });
        ++connection;
        if(connection_success){break;}
    }
    return result;
}

function common_valid(id){
    var value = $(id).val();
    if(value === ""){
        $(id+"_err").removeClass("display_none");
        $(id).addClass("form_pink");
        set_error_position($(id).position().top);
        error = true;
    }else{
        $(id+"_err").addClass("display_none");
        $(id).removeClass("form_pink");
    }
}

function common_input_check(id){
    if($(id).val() === ''){
        $(id).addClass('form_pink');
    }else{
        $(id).removeClass('form_pink');
        $(id+'_err').addClass('display_none');
    }
}

function set_error_position(tmp_error_position){
    if(tmp_error_position != null && error_position > tmp_error_position)error_position = tmp_error_position;
}