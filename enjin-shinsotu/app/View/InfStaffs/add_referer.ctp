<div class="infStaffs form">
<?php echo $this->Form->create('InfStaff'); ?>
	<fieldset>
		<legend><?php echo __('Add Inf Staff'); ?></legend>
	<?php
		echo $this->Form->input('last_name');
		echo $this->Form->input('first_name');
		echo $this->Form->input('mail_address');
		echo $this->Form->input('unique_id',array('type' => 'text','required' => false,));
		echo $this->Form->input('password');
		echo $this->Form->input('tel');
		echo $this->Form->input('rec_recruiter_id');
		echo $this->Form->input('last_login_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
