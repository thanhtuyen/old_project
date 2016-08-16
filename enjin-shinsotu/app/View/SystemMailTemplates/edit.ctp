<div class="systemMailTemplates form">
<?php echo $this->Form->create('SystemMailTemplate'); ?>
	<fieldset>
		<legend><?php echo __('Edit System Mail Template'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('template');
		echo $this->Form->input('subject');
		echo $this->Form->input('body');
		echo $this->Form->input('ev_event_id');
		echo $this->Form->input('job_vote_id');
		echo $this->Form->input('screening_stage_id');
		echo $this->Form->input('purpose_id', array( 'options' => $purpose ));
		echo $this->Form->input('rec_recruiter_id');
		echo $this->Form->input('status', array( 'options' => $selStatus ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
