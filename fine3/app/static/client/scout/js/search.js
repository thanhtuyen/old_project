function getParameterByName(name) {
    var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
}


jQuery(document).ready(function(){
	$ = jQuery;

	//select a province
	jQuery('select[name="nursery_id"]').change(function(){
		var id = parseInt(jQuery(this).val());
		var jobList =jQuery('select[name="job_id"]');
		jQuery('select[name="job_id"]').html('<option value="">選択してください</option>');
		if(id > 0){
			var jobs = jobData[id];
			$.each( jobs, function( key, job ) {
				  $( jobList).append( '<option  value="' + job.job_id + '" >' + job.title + '</option>' );
			});
		}
	});

	//select a province
	jQuery('select[name="province_id"]').change(function(){
		var id = parseInt(jQuery(this).val());
		var cityList = $('ul#cityList');
		jQuery(cityList).empty();
		if(id > 0){
			var cities = cityData[id];
			$.each( cities, function( key, city ) {
				  $( cityList).append( '<li><label><input  name="area_id[]" value="' + city.area_id + '" type="checkbox" > ' + city.name + '</label></li>' );
			});
		}
	});

	 jQuery( "input.date" ).datepicker(
			 {
				 "dateFormat": "yy-mm-dd",
				 "regional":"jp",
					 changeMonth: true,
				      changeYear: true
			 }
	 );

	//Submit one to confirm scout
	 jQuery('a.confirm-one').click(function(event){
			event.preventDefault();
			var error = false;

			jQuery('input[name="user_id[]"]').prop('checked', false);

			var tr = jQuery(this).parents('tr');
			jQuery(tr).find('input[name="user_id[]"]').prop('checked', true);


			jQuery('#confirm-scout').submit();

			return false;
	 });

	 /*jQuery('#confirm-scout').submit(function(){
		 $(this).append('<input type="hidden"');

		 var job_id =getParameterByName("job_id");

		 console.log(job_id);

		 return false;
	 });*/

	 //Submit all to confirm scout
	 jQuery('a.confirm').click(function(event){
			event.preventDefault();
			var error = false;

			var form = jQuery(this).parents('form');
			var user_id = jQuery(form).find('input[name="user_id[]"]:checked').val();

			if(user_id === undefined){
				setRequiredInvalid ( jQuery(form).find('a.scout'));

			}else{
				jQuery('#confirm-scout').submit();
			}


			return false;
	 });

	 jQuery('input.checkAllUsers').click(function(event){



		 	if(jQuery(this).attr('checked')){
		 		jQuery('input[name="user_id[]"]').prop('checked', false);
		 		jQuery(this).attr('checked', null);
		 	}else{
		 		jQuery('input[name="user_id[]"]').prop('checked', true);
		 		jQuery(this).attr('checked', 'checked');
		 	}
	 });

	 //remove error message
	 jQuery('input[name="user_id[]"]').click(function(){
		 var form = jQuery(this).parents('form');
		 setRequiredValid ( jQuery(form).find('a.scout'));
	 });

	jQuery('a.submit').click(function(event){
		event.preventDefault();
		var error = false;
		var action = jQuery(this).attr('href');

		var form = jQuery(this).parents('form');

		//check form data valid
		var fields = jQuery(form).find('select.required');
		jQuery(fields).each(function( index, obj ) {
			if(validateRequired(obj)){
				setRequiredValid(obj);
			}else{
				error = true;

				setRequiredInvalid(obj);
			}
		});
		if(error){
			return false;
		}


		jQuery(form).submit();
		return false;
	});

	jQuery('input.required, textarea.required, select.required').blur(function(event){
		event.preventDefault();
		if(validateRequired(this)){
			setRequiredValid(this);
		}else{
			setRequiredInvalid(this);
		}
	});

	function validateRequired(obj){
		if(jQuery(obj).val().length ==0){
			return false;
		}
		return true;
	}

	function setRequiredInvalid(obj){
		var message = jQuery(obj).parent().find('div.message div');
		var text  = jQuery(message).attr('data');
		jQuery(message).text(text);
		jQuery(message).addClass('error');
	}


	function setRequiredValid(obj){
		var message = jQuery(obj).parent().find('div.message div');
			jQuery(message).text('');
			jQuery(message).removeClass('error');
			jQuery(message).addClass('success');

	}

});