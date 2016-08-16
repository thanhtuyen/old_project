$(function() {
	//¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿
	$('.top_tab h2').click(function() {

		//.index()¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿
		//index¿¿¿¿¿¿¿¿¿¿¿¿
		var index = $('.top_tab h2').index(this);

		//¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿
		$('.top_searchbox .top_searchbox_inner').css('display','none');

		//¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿
		$('.top_searchbox .top_searchbox_inner').eq(index).css('display','block');

		//¿¿¿¿¿¿¿¿¿¿¿¿¿select¿¿¿¿
		$('.top_tab h2').removeClass('select');

		//¿¿¿¿¿¿¿¿¿¿¿¿¿¿¿select¿¿¿¿¿¿
		$(this).addClass('select')
	});
});
