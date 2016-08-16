<div class="evPersonnels form">
<?php echo $this->Form->create('EvPersonnel'); ?>
	<fieldset>
		<legend><?php echo __('Add Ev Personnel'); ?></legend>
	<?php
		echo $this->Form->input('ev_event_id');
		echo $this->Form->input('rec_recruiter_id');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
