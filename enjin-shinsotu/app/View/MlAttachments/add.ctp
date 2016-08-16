<div class="mlAttachments form">
<?php echo $this->Form->create('MlAttachment'); ?>
	<fieldset>
		<legend><?php echo __('Add Ml Attachment'); ?></legend>
	<?php
		echo $this->Form->input('mail_template_id');
		echo $this->Form->input('file_name');
		echo $this->Form->input('extension');
		echo $this->Form->input('binary_data');
		echo $this->Form->input('status', array( 'options' => $status ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
