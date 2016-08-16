/*common constants*/
var BASE_URL   = $("#common_js").data("base_url");
var CSRF_NAME  = $("#common_js").data("csrf_name");
var CSRF_VALUE = $("#common_js").data("csrf_value");

$(function(){
    $('a[href^=#]').click(function(){
    var speed = 700;
    var href= $(this).attr("href");
    var target = $(href == "#" || href == "" ? 'html' : href);
    var position = target.offset().top;
    $("html, body").animate({scrollTop:position}, speed, "swing");
        return false;
    });
});


/*check mail style*/
function mail_style_valid(mail){if(mail.match(/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/)){return true;}else{return false;}}