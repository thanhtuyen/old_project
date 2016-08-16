$(function(){
    var form_id = $('form');

    // 再読み込み時
	form_id.find(":checked").each(function(){
		var isl = $(this).attr("id");
        form_id.find('li').has("label[for="+isl+"]").addClass('active');
	});

    // チェックボックスにチェックが入った時
	form_id.find(":checkbox").click(function() {
		var isl = $(this).attr("id");
        var chk = $(this).attr("checked");
        var typ = 'checkbox';
        backgroundChange(isl,chk,typ);
    });

     // radioにチェックが入った時
	form_id.find(":radio").click(function() {
		var isl = $(this).attr("id");
        var chk = $(this).attr("checked");
        var typ = 'radio';
        backgroundChange(isl,chk,typ);
    });

    // リセット動作
    form_id.find(":reset").click(function() {
        form_id.find('li').removeClass('active');
    });

    function backgroundChange(isl,chk,typ) {
		if(chk == "checked" && typ == 'checkbox') {
			return form_id.find('li').has('input:'+typ).has("label[for="+isl+"]").addClass('active');
        }else if(chk == "checked" && typ == 'radio'){
            return form_id.find('li').has('input:'+typ).removeClass('active').has("label[for="+isl+"]").addClass('active');
        }else{
			return form_id.find('li').has('input:'+typ).has("label[for="+isl+"]").removeClass('active');
		}
    }

});


/*
オンタップ時演出スクリプト
ページを読み込んだ時点でイベントを登録します
*/
$(document).ready(function() {

	//ここで、タッチイベントを登録したいクラス指定します
    $("#search ul li,.btn a,.btn input").live({ "touchstart mousedown": function() {
			//liveでイベントを登録(マウスダウンと、タッチスタート)

			//ボタンがdisabled(無効化)状態の場合は、処理を中断
            if ($(this).attr("disabled") == "disabled") {
                return;
            }

			//押下時のクラスをセット
            $(this).addClass("touch-active");

        }, "touchmove touchend mouseup": function() {

			//クラスを除去
            $(this).removeClass("touch-active");
        }
    });
});

/*
オンタップ時演出スクリプト
ページを読み込んだ時点でイベントを登録します
*/
$(document).ready(function() {

	//ここで、タッチイベントを登録したいクラス指定します
    $(".list,#top_contents li.image,#top_contents li.text,.more,#ranking ol li, footer ul li,.list_nav div.link_box,.list li div.link_box,.scout_mail li,.list .form_radio_label,.list .form_checkbox_label,dd.arrow p,.ranking_copy,.detail_copyC,.detail_copyB,.detail_copyA,p.tel_number,#mypage li").live({ "touchstart mousedown": function() {
			//liveでイベントを登録(マウスダウンと、タッチスタート)

			//ボタンがdisabled(無効化)状態の場合は、処理を中断
            if ($(this).attr("disabled") == "disabled") {
                return;
            }

			//押下時のクラスをセット
            $(this).addClass("touch-active2");

        }, "touchmove touchend mouseup": function() {

			//クラスを除去
            $(this).removeClass("touch-active2");
        }
    });
});

/*
クリア・リセットボタンの動作
*/
$(function(){
	$("#clear").click(function(){
		if(confirm("全内容を削除します。よろしいですか？")){
			$('input,textarea').not('input[type="radio"],input[type="checkbox"],:hidden, :button, :submit,:reset').val('');
			$('input[type="text"]').val('');
			$('input[type="radio"], input[type="checkbox"], select').removeAttr('checked').removeAttr('selected');
			$(this).closest("form").find("textarea,:text,select").val("").end().find(":checked").prop("checked",false);
			$('html,body').animate({ scrollTop: 0 }, '1');
			return true;
		}else{
			return false;
		}
	});
	$("#reset").click(function(){
		if(confirm("全内容を変更前に戻します。よろしいですか？")){
			$('html,body').animate({ scrollTop: 0 }, '1');
			return true;
		}else{
			return false;
		}
	});
});