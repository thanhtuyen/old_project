$(function() {
	//真真真真真真真真真真真�
	$('.top_tab h2').click(function() {

		//.index()真真真真真真真真真真�
		//index真真真真真真
		var index = $('.top_tab h2').index(this);

		//真真真真真真真真�
		$('.top_searchbox .top_searchbox_inner').css('display','none');

		//真真真真真真真真真真真真真�
		$('.top_searchbox .top_searchbox_inner').eq(index).css('display','block');

		//真真真真真真�select真真
		$('.top_tab h2').removeClass('select');

		//真真真真真真真�select真真真
		$(this).addClass('select')
	});
});
