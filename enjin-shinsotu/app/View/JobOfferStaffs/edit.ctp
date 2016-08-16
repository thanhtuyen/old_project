<div class="jobOfferStaffs form">
<?php echo $this->Form->create('JobOfferStaff'); ?>
	<fieldset>
		<legend><?php echo __('Edit Job Offer Staff'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('job_votes_id');
		echo $this->Form->input('rec_recruiter_id');
		echo $this->Form->input('rec_recruiter_id', array('label' => 'Last Modified Recruiter'));
		echo $this->Form->input('status', array( 'options' => $status ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
