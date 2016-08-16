
//デバッグモード

//デバッグモードの場合は、catchした内容をalertにて表示。

var isDebug		=	true;



//-------------------------------------------------------
//iconOpenというクラスのボタンを押されると、引数にある
//-------------------------------------------------------
function iconOpen(FormName,ElementName,OnOff){
	objForm=eval('document.'+FormName);
	for(i=0;i<objForm.length;i++){
		if(objForm.elements[i].name==ElementName){
			objForm.elements[i].checked=OnOff;
		}
	}
}

//-------------------------------------------------------
//読み込み前に実行
//-------------------------------------------------------
$(document).ready(function(){
	try{
		//アドレスバーを非表示にする
		setTimeout("scrollTo(0,1)", 100);





	}catch(e){
		//デバッグ用
		//alert(e);
	}
});

/*
オンタップ時演出スクリプト
ページを読み込んだ時点でイベントを登録します
*/
$(document).ready(function() {

	//ここで、タッチイベントを登録したいクラス指定します
    $(".touchable,#sub_global p,#globalNavi ul li,#search ul li,.btn a,.btn input,.oubo a,.oubo2 a,input.top_free_btn,.social_btn li,.back").live({ "touchstart mousedown": function() {
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
    $(".touchable2,.list,.top_footer_nav li,#top_contents li.image,#top_contents li.text,#attention li.image,#attention li.text,.more,#ranking ol li, footer ul li,.list_nav div.link_box,.list li div.link_box,.scout_mail li,.list .form_radio_label,.list .form_checkbox_label,dd.arrow p,.ranking_copy,.detail_copyC,.detail_copyB,.detail_copyA,p.tel_number,#mypage ul li,#top li,#sort li,.list li.arrow,.list li.arrow,.top_back,.present_aboout,.condition_btn p,.extra .clip,.send_work,.page_top p,.login_reminder p,h5.application_login,#search_regist_btn a, #kanren p,#relation li").live({ "touchstart mousedown": function() {
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