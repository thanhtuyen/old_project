<div class="recRecruiters form">
<?php echo $this->Form->create('RecRecruiter'); ?>
	<fieldset>
		<legend><?php echo __('Add Rec Recruiter'); ?></legend>
	<?php
		echo $this->Form->input('last_name');
		echo $this->Form->input('first_name');
		echo $this->Form->input('focal_point_type', array( 'options' => $focalPointType ));
		echo $this->Form->input('mail');
		echo $this->Form->input('password');
		echo $this->Form->input('rec_department_id');
		echo $this->Form->input('face_photo');
		echo $this->Form->input('tel');
		echo $this->Form->input('approval_flag');
		echo $this->Form->input('status', array( 'options' => $status ));
		echo $this->Form->input('fac_manager_id');
		echo $this->Form->input('last_login_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
