function login_valid(){
    var error = false;

    $("#mail_not_exist_err").addClass("display_none");
    $("#mail_not_confirm_err").addClass("display_none");

    var mail = $("#mail").val();
    if(mail !== ""){
        if(!mail_style_valid(mail)){
            $("#mail_err").removeClass("display_none");
            error = true;
        }else{
            $("#mail_err").addClass("display_none");
        }
    }else{
        $("#mail_err").removeClass("display_none");
        error = true;
    }

    var password = $("#password").val();
    if(password === "" || password.match(/\<[a-zA-Z0-9]+\>/)){
        $("#password_err").removeClass("display_none");
        error = true;
    }else{
        $("#password_err").addClass("display_none");
    }

    if(!error){

        var connection_success = false;
        var connection = 0;
        var connection_limit = 3;

        var post_data = {};
        post_data[CSRF_NAME] = CSRF_VALUE;
        post_data["mail"] = mail;
        post_data["password"] = password;
        post_data["unique"] = true;

        while(connection < connection_limit){
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: BASE_URL+"user/ajax/check_user_exist",
                data: post_data,
                success:function(data){
                    connection_success = true;
                    if(data["code"] === 0){
                        $(location).attr("href",BASE_URL+"server_error");
                    }else{
                        if(typeof(data["result"][0]) === "undefined"){
                            $("#mail_err").addClass("display_none");
                            $("#password_err").addClass("display_none");
                            $("#mail_not_exist_err").removeClass("display_none");
                            $("#mail_not_confirm_err").addClass("display_none");
                        }else if(data["result"][0]["status"] === "0"){
                            $("#mail_err").addClass("display_none");
                            $("#password_err").addClass("display_none");
                            $("#mail_not_exist_err").addClass("display_none");
                            $("#mail_not_confirm_err").removeClass("display_none");
                        }else{
                            $("#user_id").val(data["result"][0]["user_id"]);
                            $("#login_form").submit();
                        }
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown){
                    console.log('AJAX CONNECTION ERROR ('+connection+')')
                }
            });
            ++connection;
            if(connection_success){break;}
        }
    }
}