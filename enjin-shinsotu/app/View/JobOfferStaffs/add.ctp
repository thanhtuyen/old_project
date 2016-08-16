<div class="jobOfferStaffs form">
<?php echo $this->Form->create('JobOfferStaff'); ?>
	<fieldset>
		<legend><?php echo __('Add Job Offer Staff'); ?></legend>
	<?php
		echo $this->Form->input('job_vote_id');
		echo $this->Form->input('rec_recruiter_id');
		echo $this->Form->input('rec_recruiter_id', array('label' => 'Last Modified Recruiter'));
		echo $this->Form->input('status', array( 'options' => $status ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
