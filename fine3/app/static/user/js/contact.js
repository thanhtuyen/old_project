jQuery(document).ready(function(){
	jQuery('a.submit').click(function(event){
		event.preventDefault();
		var error = false;
		var action = jQuery(this).attr('href');
		
		var form = jQuery(this).parents('form');
		
		//jQuery(form).attr('action', action);
		
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
		
		//check email data valid
		var emailField = jQuery(form).find('input[type="email"]');
		if(! isEmail(emailField.val())){			
			setRequiredInvalid(emailField);
			return false;
		}

		jQuery(form).submit();
		return false;
	});
	
	jQuery('input.required, textarea.required').blur(function(event){
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
		jQuery(message).text(jQuery(message).attr('data'));
		jQuery(message).addClass('error');
	}
	
	
	function setRequiredValid(obj){
		var message = jQuery(obj).parent().find('div.message div');
			jQuery(message).text('');
			jQuery(message).removeClass('error');
			jQuery(message).addClass('success');

	}

	function isEmail(email) { 
	    return /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i.test(email);
	}
});