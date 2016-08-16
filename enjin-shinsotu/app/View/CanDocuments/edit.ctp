<div class="canDocuments form">
<?php echo $this->Form->create('CanDocument'); ?>
	<fieldset>
		<legend><?php echo __('Edit Can Document'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('can_candidate_id');
		echo $this->Form->input('ev_history_id');
		echo $this->Form->input('sel_history_id');
		echo $this->Form->input('file_name');
		echo $this->Form->input('extension');
		echo $this->Form->input('binary_data');
		echo $this->Form->input('status', array( 'options' => $docStatus ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
