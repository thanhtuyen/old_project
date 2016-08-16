/* スムーススクロール
-----------------------------------------------*/
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

/* leanModal
-----------------------------------------------*/
$(function() {
    $( 'a[rel*=leanModal]').leanModal({
        top: 100,                     // モーダルウィンドウの縦位置を指定
        overlay : 0.5,               // 背面の透明度 
        closeButton: ".modal_close"  // 閉じるボタンのCSS classを指定
    });
}); 