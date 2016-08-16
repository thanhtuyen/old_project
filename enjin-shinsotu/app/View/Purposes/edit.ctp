<div class="purposes form">
<?php echo $this->Form->create('Purpose'); ?>
	<fieldset>
		<legend><?php echo __('Edit Purpose'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('status', array( 'options' => $status ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
