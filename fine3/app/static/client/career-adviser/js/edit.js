jQuery(document).ready(function(){
	$ = jQuery;


	function checkUploadFileRequired(){
			var image_id = $('#image_id').val();
			if(image_id.length > 0){
				setRequiredValid($('#image'));
				return true;
			}

			if($('#image').val().length > 0){
				setRequiredValid($('#image'));
				return true;
			}

	        setRequiredInvalid($('#image'));
	        return false;
	}



	jQuery('a.submit').click(function(event){
		event.preventDefault();
		var error = false;
		var form = jQuery(this).parents('form');



		if(! checkUploadFileRequired()){
			error = true;
		}

		//check form data valid
		var fields = jQuery(form).find('input.required, textarea.required');
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
