<div class="companies form">
<?php echo $this->Form->create('rec_recruiters'); ?>
	<fieldset>
		<legend><?php echo __('Interviewers login'); ?></legend>
	<?php
		echo $this->Form->input('mail');
		echo $this->Form->input('password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
