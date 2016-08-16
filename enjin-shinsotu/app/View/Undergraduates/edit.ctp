<div class="undergraduates form">
<?php echo $this->Form->create('Undergraduate'); ?>
	<fieldset>
		<legend><?php echo __('Edit Undergraduate'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('rec_recruiter_id');
		echo $this->Form->input('status', array( 'options' => $status ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
