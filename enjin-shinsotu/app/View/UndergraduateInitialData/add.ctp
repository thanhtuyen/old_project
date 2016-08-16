<div class="undergraduateInitialData form">
<?php echo $this->Form->create('UndergraduateInitialData'); ?>
	<fieldset>
		<legend><?php echo __('Add Undergraduate Initial Data'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('status', array( 'options' => $status ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
