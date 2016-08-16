<div class="businesses form">
<?php echo $this->Form->create('Business'); ?>
	<fieldset>
		<legend><?php echo __('Add Business'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('status', array( 'options' => $status ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
