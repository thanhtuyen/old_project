<div class="jobSelectTargets form">
<?php echo $this->Form->create('JobSelectTarget'); ?>
	<fieldset>
		<legend><?php echo __('Add Job Select Target'); ?></legend>
	<?php
		echo $this->Form->input('job_vote_id');
		echo $this->Form->input('attain_deadline_date');
		echo $this->Form->input('screening_stage_id');
		echo $this->Form->input('target_select_id', array( 'options' => $screeningStageType ));
		echo $this->Form->input('select_judgment_type', array( 'options' => $selectJudgmentType ));
		echo $this->Form->input('target_number');
		echo $this->Form->input('status', array( 'options' => $status ));
		echo $this->Form->input('rec_recruiter_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
