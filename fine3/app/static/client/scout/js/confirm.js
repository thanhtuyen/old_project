
jQuery(document).ready(function(){
	$ = jQuery;
	jQuery('a.submit').click(function(event){
		event.preventDefault();
		var error = false;

		if(jQuery(this).parents('form').find('td.user_id').length > 0){
			event.preventDefault();
			var error = false;
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
		}

		return false;
	});

	//delete user in the scout confirm list
	 jQuery('a.delete-user').click(function(event){
			event.preventDefault();
			var error = false;

			var user_id = $(this).attr('data-id');


			//console.log(user_id);

			var tr = jQuery(this).parents('tr');


			var form = jQuery(this).parents('form');

			var formData = $(form).serialize();

			data =  formData + '&user_id=' + user_id;



			deleteUser(data);

			jQuery(tr).remove();
			return false;
	 });

	 function deleteUser(data){
		 	var deleteUrl = '/client/scout/delete';
		    $.post(deleteUrl, data, function(result){
		       console.log(result);
		    });
	 }


	 //submit


	 jQuery('input.required, select.required').blur(function(event){
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