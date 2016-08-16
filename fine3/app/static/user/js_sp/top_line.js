$(function() {
	var startX,endX;
	var window_state = 0;
    var winWidth = window.innerWidth;
    var current_window;
    function start(){
        startX = event.touches[0].pageX;
    }
    function move(e){
        endX = event.touches[0].pageX;
    }
    function end(e){
        if(endX - startX > 180){
		$(".second_window").css("display","none");
//		.animate({
//    			left: (winWidth ) + "px"
//    		}, 1000)
    		
		$("#third_window").fadeIn("slow");
//    		.animate({
//    			left: 0
//    		},1000);
       }
    }

	$(".go_first").click(function(){

		$("#third_window").css("display","block");

		setTimeout(function () {

			animateTarget($("#" + current_window), winWidth, function () {

				$("#" + current_window).css("display","none");
			});

			animateTarget($("#third_window"), 0);

		}, 1);

	});


	function animateTarget($obj, value, callback) {

    	var param = {
					    '-webkit-transition':'left 300ms linear'
					    //,'-webkit-transform':'translate3d(0, 0, 0)'
					    //,'-webkit-transform-style':'preserve-3d'
					};

		if( navigator.userAgent.search(/Android 4.0/) == -1 ) {
			//param['-webkit-transform'] = 'translate3d(0, 0, 0)';
		}

    	var reset = {
						'-webkit-transition':''
						//,'-webkit-transform':''
						//,'-webkit-transform-style':''
					};

    	$obj.css(param);



		$obj.css('left', value + 'px').one("webkitTransitionEnd", function (){

			$(this).css(reset);

			if (callback) {
				callback();
			}
		});
	}

	$(".listChilds").css("display","none");
	$(".hasChilds > *").click(function() {
		var checked2 = $(this).attr("id");
		//���������a������������
		var a_ob = $(this).find("a");
		//���������a���ID���
		var a_id = $(this).find("a").attr("id");
		$("#Small"+a_id).slideToggle("slow");
		if($(this).find("a").is(".iconOpen")) {
			$(this).find("a").removeClass("iconOpen").addClass("iconClose");
		}else{
			$(this).find("a").removeClass("iconClose").addClass("iconOpen");
		}

	});
	$(".BigCheckBox").click(function() {
		var checked3 = $(this).attr("id");
		if(this.checked){
			$("#Small"+checked3 + " input").attr("checked","checked");
			$("#Small"+checked3 + " a ").css("background-color","yellow");
		}else{
			$("#Small"+checked3 + " input").removeAttr('checked');
			$("#Small"+checked3 + " a ").css("background-color","white");
		}
	});
	$("#selectarea :input").click(function() {

		//���������������������
		var chk_item_exist = false;
		$("#selectarea :input").each(function() {
			var checked = $(this).attr("checked");
			if(checked=="checked"){
				chk_item_exist = true;
				return false;
			}
		});
		if(chk_item_exist == true){
			$("#chbox_btn").show("slow");
		}else{
			$("#chbox_btn").hide("slow");
		}
	});

	if(window_state==0){

		$("#third_window .arrow").click(function() {

			var id = $(this).attr("id");

			$("#fourth_window" + id).css("display","block");

			current_window = "fourth_window" + id;

//			setTimeout(function () {

//				animateTarget($("#third_window"), -winWidth, function () {

					$("#third_window").css("display","none");
//				});

//				animateTarget($("#fourth_window" + id), 0);

//			}, 1);
		});
	}

	$(".area_cd_tab").click(function() {
		location.href='p_' + $(this).prev().val();
	});
});
