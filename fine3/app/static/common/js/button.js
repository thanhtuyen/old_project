$(document).ready(function(){
	$('button').click(function(){
	    var url = $(this).parents('a').first().prop('href');
	    if(url !=undefined ){
	    	document.location = url;
	    }

	});
});

function isIE(){
    var ms_ie = false;
    var ua = window.navigator.userAgent;
    var old_ie = ua.indexOf('MSIE ');
    var new_ie = ua.indexOf('Trident/');

    if ((old_ie > -1) || (new_ie > -1)) {
        ms_ie = true;
    }

    if ( ms_ie ) {
        //IE specific code goes here
    }
    return ms_ie;
}