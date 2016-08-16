<div class="jobtypes form">
<?php echo $this->Form->create('Jobtype'); ?>
	<fieldset>
		<legend><?php echo __('Add Jobtype'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('status', array( 'options' => $status ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
