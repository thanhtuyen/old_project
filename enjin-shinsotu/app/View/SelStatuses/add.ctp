<div class="selStatuses form">
<?php echo $this->Form->create('SelStatus'); ?>
	<fieldset>
		<legend><?php echo __('Add Sel Status'); ?></legend>
	<?php
		echo $this->Form->input('job_vote_id');
		echo $this->Form->input('can_candidate_id');
		echo $this->Form->input('screening_stage_id');
		echo $this->Form->input('select_status_id', array( 'options' => $selectJudgmentType ));
		echo $this->Form->input('select_option_id', array( 'options' => $selectOption ));
		echo $this->Form->input('comment');
		echo $this->Form->input('status', array( 'options' => $selStatus ));
		echo $this->Form->input('visited_info');
		echo $this->Form->input('annual_income');
		echo $this->Form->input('start_date');
		echo $this->Form->input('end_date');
		echo $this->Form->input('influx_propriety');
		echo $this->Form->input('candidate_propriety');
		echo $this->Form->input('last_modified_type', array( 'options' => $lastModifiedType ));
		echo $this->Form->input('rec_recruiter_id');
		echo $this->Form->input('inf_staff_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
