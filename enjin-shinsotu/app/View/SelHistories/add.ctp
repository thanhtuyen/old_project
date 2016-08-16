<div class="selHistories form">
<?php echo $this->Form->create('SelHistory'); ?>
	<fieldset>
		<legend><?php echo __('Add Sel History'); ?></legend>
	<?php
		echo $this->Form->input('job_vote_id');
		echo $this->Form->input('can_candidate_id');
		echo $this->Form->input('screening_stage_id');
		echo $this->Form->input('select_status_id', array( 'options' => $selectJudgmentType ));
		echo $this->Form->input('select_option_id', array( 'options' => $selectOption ));
		echo $this->Form->input('comment');
		echo $this->Form->input('visited_info');
		echo $this->Form->input('annual_income');
		echo $this->Form->input('start_date');
		echo $this->Form->input('end_date');
		echo $this->Form->input('influx_propriety', array( 'type'=>'radio', 'options'=> $open_propriety));
		echo $this->Form->input('candidate_propriety', array( 'type'=>'radio', 'options'=> $open_propriety));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
