var ua = navigator.userAgent;
if (ua.indexOf('iPhone') != -1 || ua.indexOf('iPad') != -1 || ua.indexOf('iPod') != -1 || ua.indexOf('Android') != -1)
{//iPhone, iPad, iPod, Android
	document.write('<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">');
	document.write('<link rel="stylesheet" href="'+STATIC_URL+'css/style_sp.css" media="screen, tv, projection">');
	document.write('<link rel="stylesheet" href="'+STATIC_URL+'css/formStyle_sp.css" media="screen, tv, projection">');
}


else if (navigator.appVersion.indexOf("Mac") !=-1){
	document.write('<link rel="stylesheet" href="'+STATIC_URL+'css/style_mac.css" media="screen, tv, projection">');
	document.write('<link rel="stylesheet" href="'+STATIC_URL+'css/formStyle.css" media="screen, tv, projection">');
	document.write('<script src='+STATIC_URL+'js/css_browser_selector.js” type=”text/javascript”></script>');
}

else {
	document.write('<link rel="stylesheet" href="'+STATIC_URL+'css/style.css" media="screen, tv, projection">');
	document.write('<link rel="stylesheet" href="'+STATIC_URL+'css/formStyle.css" media="screen, tv, projection">');
}

document.write('<link rel="stylesheet" href="'+STATIC_URL+'css/icomoon.css" media="screen, tv, projection">');