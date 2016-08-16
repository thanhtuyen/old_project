<div class="recDepartments form">
<?php echo $this->Form->create('RecDepartment'); ?>
	<fieldset>
		<legend><?php echo __('Edit Rec Department'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('department_name');
		echo $this->Form->input('parent_id');
		echo $this->Form->input('hr_flag',array('type' => 'checkbox'));
		echo $this->Form->input('fac_manager_id');
		echo $this->Form->input('status', array( 'options' => $status ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('RecDepartment.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('RecDepartment.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Rec Departments'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Rec Departments'), array('controller' => 'rec_departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Rec Department'), array('controller' => 'rec_departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rec Companies'), array('controller' => 'rec_companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rec Company'), array('controller' => 'rec_companies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fac Managers'), array('controller' => 'fac_managers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fac Manager'), array('controller' => 'fac_managers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Job Vokes'), array('controller' => 'job_vokes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Job Voke'), array('controller' => 'job_vokes', 'action' => 'add')); ?> </li>
	</ul>
</div>
