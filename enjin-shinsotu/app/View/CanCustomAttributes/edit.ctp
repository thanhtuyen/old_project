<div class="canCustomAttributes form">
<?php echo $this->Form->create('CanCustomAttribute'); ?>
	<fieldset>
		<legend><?php echo __('Edit Can Custom Attribute'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('can_candidate_id');
		echo $this->Form->input('can_custom_field_id');
		echo $this->Form->input('value');
		echo $this->Form->input('status', array( 'options' => $selStatus ));
		echo $this->Form->input('rec_recruiter_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
