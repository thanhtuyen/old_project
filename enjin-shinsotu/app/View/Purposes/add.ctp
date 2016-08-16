<div class="purposes form">
<?php echo $this->Form->create('Purpose'); ?>
	<fieldset>
		<legend><?php echo __('Add Purpose'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('status', array( 'options' => $status ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
