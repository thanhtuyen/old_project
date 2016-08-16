<div class="canCustomFields form">
<?php echo $this->Form->create('CanCustomField'); ?>
	<fieldset>
		<legend><?php echo __('Edit Can Custom Field'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('field_name');
		echo $this->Form->input('rec_recruiter_id');
		echo $this->Form->input('type', array( 'options' => $customType ));
		echo $this->Form->input('status', array( 'options' => $selStatus ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
