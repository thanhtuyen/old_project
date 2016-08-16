<div class="qualifications form">
<?php echo $this->Form->create('Qualification'); ?>
	<fieldset>
		<legend><?php echo __('Edit Qualification'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('status', array( 'options' => $selStatus ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
