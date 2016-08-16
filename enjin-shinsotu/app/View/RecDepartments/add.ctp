<div class="recDepartments form">
<?php echo $this->Form->create('RecDepartment'); ?>
	<fieldset>
		<legend><?php echo __('Add Rec Department'); ?></legend>
	<?php
		echo $this->Form->input('rec_company_id');
		echo $this->Form->input('department_name');
		echo $this->Form->input('parent_id');
		echo $this->Form->input('hr_flag',array('type' => 'checkbox'));
		echo $this->Form->input('fac_manager_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
