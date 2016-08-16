<div class="screeningStages form">
<?php echo $this->Form->create('ScreeningStage'); ?>
	<fieldset>
		<legend><?php echo __('Add Screening Stage'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('order');
		echo $this->Form->input('last_select_flag');
		echo $this->Form->input('select_overview');
		echo $this->Form->input('rec_recruiter_id');
		echo $this->Form->input('status', array( 'options' => $status ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
