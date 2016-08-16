/* signup common validations */

var error,error_position;

kana_autocomplete($("#name"),$("#kana"),"katakana");

$('select#birth_year').change(function(){date_formatting();});
$('select#birth_month').change(function(){date_formatting();});


$('#zip1').on('change', function(){
    changeCityList();
});

if($('#zip2').length){
    $("#zip1").jpostal({postcode:["#zip1","#zip2"],address:{"#address_pref":"%3","#address_city":"%4","#address_detail":"%5"}});

}else{
    $("#zip1").jpostal({postcode:["#zip1"],address:{"#address_pref":"%3","#address_city":"%4","#address_detail":"%5"}});
}


function changeCityList(){
    var province = $('#address_pref').val();
    var post_data = {};
    var html = '';
    var option;

    if(province != ''){
        post_data[CSRF_NAME] = CSRF_VALUE;
        post_data['province_name'] = province;
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'user/ajax/getCityByProvinceName',
            async: false,
            dataType: 'json',
            data: post_data,
            success: function(res) {
                if(res["code"] === 1){
                    $('#address_city option').addClass('display_none');
                    $.each(res["result"], function(index, item){
                        option = $('#address_city option[value='+item.name+']');
                        option.removeClass('display_none');
                        if(index==0){
                            $('#address_city').val(option.val());
                        }

                    });
                  //html += '<option data-pref_id="'+item.area_id+'" value="'+item.name+'">'+item.name+'</option>';
                    //$('#address_city').html(html);

                }else if(res["code"] === 0){
                    result = 8;
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                result = 9;
            }
        });
    }

}


$('#address_pref').on('change', function(){
    changeCityList();
});

$(".form_submit").on("click",function(){

    err = false;

    error_position = 100000;

    mail();
    password();
    passconf();
    name();
    kana();
    birthday();
    gender();
    zip();
    address_pref();
    address_city();
    address_detail();
    tel();
    license();
    employee()

    if(err){
        $('html,body').animate({ scrollTop: error_position - 30 }, 'fast');
    }else{
        $("#area_id").val($("option","#address_city").eq($("#address_city")[0].selectedIndex).data("city_area_id"));
        $("#register_form").submit();
    }
});

function set_error_position(tmp_error_position){
    if(tmp_error_position != null && error_position > tmp_error_position)error_position = tmp_error_position;
}

function mail(){
    var mail = $("#mail").val();

    if(mail !== "" && mail_style_valid(mail)){

        $("#mail_err").addClass("display_none");
        result = mail_check(mail);

        if(result === 0){
            $("#mail_exist").addClass("display_none");
            return;
        }else if (result === 1){
            $("#mail_exist").removeClass("display_none");
            set_error_position($("#mail").position().top);
            err = true;
            return;
        }else if (result === 8){
            /*$(location).attr("href",BASE_URL+"server_error");*/
        }else if (result === 9){
            /*$(location).attr("href",BASE_URL+"server_error");*/
        }
    }else{
        $("#mail_err").removeClass("display_none");
        $("#mail_exist").addClass("display_none");
        set_error_position($("#mail").position().top);
        err = true;
    }

}

function password(){
    var password = $("#password").val();

    if(!password.match(/^[a-z0-9]{8,250}$/)){
        $("#password_err").removeClass("display_none");
        set_error_position($("#password").position().top);
        err = true;
    }else{
        $("#password_err").addClass("display_none");
    }
}

function passconf(){
    var password = $("#password").val();
    var passconf = $("#passconf").val();
    if(passconf === ""){
        $("#passconf_incorrect").addClass("display_none");
        $("#passconf_err").removeClass("display_none");
        set_error_position($("#password").position().top);
        err = true;
    }else if(passconf !== password){
        $("#passconf_err").addClass("display_none");
        $("#passconf_incorrect").removeClass("display_none");
        set_error_position($("#password").position().top);
        err = true;
    }else{
        $("#passconf_err").addClass("display_none");
        $("#passconf_incorrect").addClass("display_none");
    }
}

function name(){
    common_valid("#name");
}

function kana(){
    common_valid("#kana");
}

function birthday(){
    if($('select#birth_year').val() === "" || $('select#birth_month').val() === "" || $('select#birth_day').val() === ""){
        $("#birth_err").removeClass("display_none");
        set_error_position($("#birth_year").position().top);
        err = true;
    }else{
        $("#birth_err").addClass("display_none");
    }
}

function gender(){
    if($("[name=gender]:checked").val() === void 0){
        $("#gender_err").removeClass("display_none");
        set_error_position($("[name=gender]").position().top);
        err = true;
    }else{
        $("#gender_err").addClass("display_none");
    }
}

function zip(){
    if($("#zip2").length){
        if( !$("#zip1").val().match(/^[0-9]{3}$/) || !$("#zip2").val().match(/^[0-9]{4}$/)){
            $("#zip_err").removeClass("display_none");
            set_error_position($("#zip1").position().top);
            err = true;
        }else{
            $("#zip_err").addClass("display_none");
        }
    }else{
        if( !$("#zip1").val().match(/^[0-9]{7}$/)){
            $("#zip_err").removeClass("display_none");
            set_error_position($("#zip1").position().top);
            err = true;
        }else{
            $("#zip_err").addClass("display_none");
        }
    }

}

function address_pref(){
    common_valid("#address_pref");
}

function address_city(){
    common_valid("#address_city");
}

function address_detail(){
    common_valid("#address_detail");
}

function tel(){
    if( !$("#tel").val().match(/^[0-9]{10,11}$/)){
        $("#tel_err").removeClass("display_none");
        set_error_position($("#tel").position().top);
        err = true;
    }else{
        $("#tel_err").addClass("display_none");
    }
}

function license(){

    var area = $('.license:checked').map(function(){return $(this).val();}).get();

    if(area == ""){
        $("#license_err").removeClass("display_none");
        set_error_position($(".license").position().top);
        err = true;
    }else{
        $("#license_err").addClass("display_none");
    }
}

function employee(){
    common_valid("#employee");
}

function mail_check(mail){

    var result;
    var post_data = {};
    post_data[CSRF_NAME] = CSRF_VALUE;
    post_data['mail'] = mail;
    post_data['type'] = "update";
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'user/ajax/same_mail_search',
        async: false,
        dataType: 'json',
        data: post_data,
        success: function(res) {
            alert(res["code"]);
            if(res["code"] === 1){
                result = res["result"];
            }else if(res["code"] === 0){
                result = 8;
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown){
            result = 9;
        }
    });
    return result;
}

function common_valid(id){
    var value = $(id).val();
    if(value === ""){
        $(id+"_err").removeClass("display_none");
        set_error_position($(id).position().top);
        err = true;
    }else{
        $(id+"_err").addClass("display_none");
    }
}

function kana_autocomplete(name_form,kana_form,type) {

    var kana_list = new RegExp('[^ 　ぁあ-んー]', 'g');
    var kana_small = new RegExp('[ぁぃぅぇぉっゃゅょ]', 'g');
    var timer = null;
    var convert_flg = true;
    var input;

    _reset();

    name_form.focus(function(){
        kana_str = kana_form.val();
        nama_str = name_form.val();
        convert_flg = false;
        var self = this;
        timer = setInterval(_check_val, 30);
    });

    function _check_val() {
        var new_input, new_values;
        new_input = name_form.val()
        if (new_input == '') {
            _reset();
            _set_kana_val();
        } else {
            new_input = _reset_str(new_input);
            if (input == new_input) {
                return;
            } else {
                input = new_input;
                if (!convert_flg) {
                    new_values = new_input.replace(kana_list, '').split('');
                    _check_convert(new_values);
                    _set_kana_val(new_values);
                }
            }
        }
    };

    function _check_convert(new_values) {
        if (!convert_flg) {
            if (Math.abs(values.length - new_values.length) > 1) {
                var tmp_values = new_values.join('').replace(kana_small, '').split('');
                if (Math.abs(values.length - tmp_values.length) > 1) {
                    kana_str = kana_str + values.join('');
                    convert_flg = true;
                    values = [];
                }
            } else {
                if (values.length == input.length && values.join('') != input) {
                    kana_str = kana_str + values.join('');
                    convert_flg = true;
                    values = [];
                }
            }
        }
    };


    function _reset_str(new_input) {
        if (new_input.match(nama_str)) {
            return new_input.replace(nama_str, '');
        } else {
            var i, name_arr, input_arr;
            name_arr = nama_str.split('');
            input_arr = new_input.split('');
            for (i = 0; i < name_arr.length; i++) {
                if (name_arr[i] == input_arr[i]) {
                    input_arr[i] = '';
                }
            }
            return input_arr.join('');
        }
    };

    function _set_kana_val(new_values) {
        if (!convert_flg) {
            if (new_values) {
                values = new_values;
            }
            if(type === "katakana"){
                var _val = _convert_katakana(kana_str + values.join(''));
            }else{
                var _val = kana_str + values.join('');
            }
            kana_form.val(_val);
        }
    };

    function _convert_katakana(src){
        var c, i, str;
        str = new String;
        for (i = 0; i < src.length; i++) {
            c = src.charCodeAt(i);
            if (((c >= 12353 && c <= 12435) || c == 12445 || c == 12446)) {
                str += String.fromCharCode(c + 96);
            } else {
                str += src.charAt(i);
            }
        }
        return str;
    }
    function _reset() {
        kana_str = '';
        convert_flg = false;
        nama_str = '';
        input = '';
        values = [];
    };
};


function date_formatting(){
    var birth_year = $("#birth_year").val();
    var birth_month = $("#birth_month").val();
    if(birth_year !== ""&&birth_month !== ""){
        $('#birth_day').empty();
        if (2 == birth_month && (0 == birth_year % 400 || (0 == birth_year % 4 && 0 != birth_year % 100))) {
          var last = 29;
        }else{
          var last = new Array(31,28,31,30,31,30,31,31,30,31,30,31)[birth_month - 1];
        }
        for (var i = 1; i <= last; i++){
            $('#birth_day').append('<option value="' + i + '">' + i + '</option>');
        }
    }
}