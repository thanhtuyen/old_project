<div class="markets form">
<?php echo $this->Form->create('Market'); ?>
	<fieldset>
		<legend><?php echo __('Add Market'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('status', array( 'options' => $status ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
