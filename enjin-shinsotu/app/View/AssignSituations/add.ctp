<div class="assignSituations form">
<?php echo $this->Form->create('AssignSituation'); ?>
	<fieldset>
		<legend><?php echo __('Add Assign Situation'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('status', array( 'options' => $status ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>