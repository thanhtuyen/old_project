<div class="canEducations form">
<?php echo $this->Form->create('CanEducation'); ?>
	<fieldset>
		<legend><?php echo __('Edit Can Education'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('can_candidate_id');
		echo $this->Form->input('school_id');
		echo $this->Form->input('school');
		echo $this->Form->input('undergraduate_id', array( 'options' => $undergraduateInitialData ));
		echo $this->Form->input('undergraduate');
		echo $this->Form->input('department');
		echo $this->Form->input('student_bunri_class_id', array( 'options' => $bunriClass ));
		echo $this->Form->input('manage_bunri_class_id', array( 'options' => $bunriClass ));
		echo $this->Form->input('seminar');
		echo $this->Form->input('major_theme');
		echo $this->Form->input('circle');
		echo $this->Form->input('admission_date');
		echo $this->Form->input('graduation_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
