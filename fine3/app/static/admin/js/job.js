
$(document).ready(function(){
	$('.checkAll').click(function(){
		if( $(this).prop('checked') ){
			$('input[name="job_id[]"]').prop('checked', true);
			$('i.job').addClass('checked');
		}else{
			$('input[name="job_id[]"]').prop('checked', false);
			$('i.job').removeClass('checked');
		}

	});

	$('#deleteAll').click(function(){
		var result = confirm("チェックした求人を本当に削除しますか？");
		if(result){
			var jobs = $('input[name="job_id[]"]:checked');
			$.each( jobs, function( key, job ) {
				  var job_id = $(job).val();
				  var result =  deleteJob(job_id);
				  if(result){
					  $(job).parents('tr').remove();
				  }

			});
			window.location = window.location.href;
		}
		return false;
	});

	 function deleteJob(job_id){
		 	var post_data = {job_id: job_id};
		 	var ajaxUrl = deleteUrl + job_id;
		 	console.log(ajaxUrl);
		 	  var result;
		 	    $.ajax({
		 	        type: 'GET',
		 	        url: ajaxUrl,
		 	        async: false,
		 	        success: function(res) {
		 	        	result = true;
		 	        },
		 	        error: function(XMLHttpRequest, textStatus, errorThrown){
		 	            result = false;
		 	        }
		 	    });
		 return result;

	 }

});