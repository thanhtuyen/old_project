/* �X���[�X�X�N���[��
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
        top: 100,                     // ���[�_���E�B���h�E�̏c�ʒu���w��
        overlay : 0.5,               // �w�ʂ̓����x 
        closeButton: ".modal_close"  // ����{�^����CSS class���w��
    });
}); 