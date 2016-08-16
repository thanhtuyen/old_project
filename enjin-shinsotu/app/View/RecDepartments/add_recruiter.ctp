<div class="recDepartments form">
<?php echo $this->Form->create('RecDepartment'); ?>
	<fieldset>
		<legend><?php echo __('Add Rec Department'); ?></legend>
	<?php
		echo $this->Form->input('department_name');
		echo $this->Form->input('parent_id',array("options"=>$parentRecDepartments));
		echo $this->Form->input('hr_flag',array('type' => 'checkbox'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
