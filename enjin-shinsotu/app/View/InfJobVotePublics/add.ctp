<div class="infJobVotePublics form">
<?php echo $this->Form->create('InfJobVotePublic'); ?>
	<fieldset>
		<legend><?php echo __('Add Inf Job Vote Public'); ?></legend>
	<?php
		echo $this->Form->input('job_vote_id');
		echo $this->Form->input('referer_company_id');
		echo $this->Form->input('inf_contract_id');
		echo $this->Form->input('start_date');
		echo $this->Form->input('rec_recruiter_id');
		echo $this->Form->input('status', array( 'options' => $jobVoteStatus ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
