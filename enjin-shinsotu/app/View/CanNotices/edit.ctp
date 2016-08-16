<div class="canNotices form">
<?php echo $this->Form->create('CanNotice'); ?>
	<fieldset>
		<legend><?php echo __('Edit Can Notice'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('can_candidate_id');
		echo $this->Form->input('notice');
		echo $this->Form->input('register_type', array( 'options' => $registerType ));
		echo $this->Form->input('rec_recruiter_id');
		echo $this->Form->input('inf_staff_id');
		echo $this->Form->input('status', array( 'options' => $selStatus ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
