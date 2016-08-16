<div class="mlSendHistories form">
<?php echo $this->Form->create('MlSendHistory'); ?>
	<fieldset>
		<legend><?php echo __('Add Ml Send History'); ?></legend>
	<?php
		echo $this->Form->input('send_mail_address');
		echo $this->Form->input('can_candidate_id');
		echo $this->Form->input('inf_staff_id');
		echo $this->Form->input('rec_recruiter_id');
		echo $this->Form->input('mail_template_id');
		echo $this->Form->input('system_mail_template_id');
		echo $this->Form->input('send_recruiter_id');
		echo $this->Form->input('send_result');
		echo $this->Form->input('send_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
