jQuery(document).ready(function() {
	$ = jQuery;

	jQuery('input.checkAllTemplates').click(function(event) {

		if (jQuery(this).attr('checked')) {
			jQuery('input[name="template_id[]"]').prop('checked', false);
			jQuery(this).attr('checked', null);
		} else {
			jQuery('input[name="template_id[]"]').prop('checked', true);
			jQuery(this).attr('checked', 'checked');
		}
	});

	jQuery('a.submit').click(function(event) {
		event.preventDefault();
		var error = false;

		var form = jQuery(this).parents('form');

		// check form data valid
		var n = $("input[name='template_id[]']:checked").length;

		if (n == 0) {
			setRequiredInvalid($(this).parent('div'));
		} else {
			setRequiredValid($(this).parent('div'));
			jQuery(form).submit();

		}

		console.log(n);
		return false;
	});

	// delete user in the scout confirm list
	jQuery('a.delete-template').click(function(event) {
		event.preventDefault();
		var error = false;

		var template_id = $(this).attr('data-id');

		// console.log(user_id);

		var tr = jQuery(this).parents('tr');

		var form = jQuery(this).parents('form');

		var formData = $(form).serialize();

		data = formData + '&template_id=' + template_id;

		deleteTemplate(data);

		jQuery(tr).remove();
		return false;
	});

	function deleteTemplate(data) {
		var deleteUrl = '/client/scout/delete_template';
		$.post(deleteUrl, data, function(result) {
			console.log(result);
		});
	}

	// submit

	function validateRequired(obj) {
		if (jQuery(obj).val().length == 0) {
			return false;
		}
		return true;
	}

	function setRequiredInvalid(obj) {
		var message = jQuery(obj).parent().find('div.message div');
		var text = jQuery(message).attr('data');
		jQuery(message).text(text);
		jQuery(message).addClass('error');
	}

	function setRequiredValid(obj) {
		var message = jQuery(obj).parent().find('div.message div');
		jQuery(message).text('');
		jQuery(message).removeClass('error');
		jQuery(message).addClass('success');

	}

});
