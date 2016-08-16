<div class="jobtypes form">
<?php echo $this->Form->create('Jobtype'); ?>
	<fieldset>
		<legend><?php echo __('Edit Jobtype'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('status', array( 'options' => $status ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
