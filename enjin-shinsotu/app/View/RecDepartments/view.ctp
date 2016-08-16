<div class="recDepartments view">
<h2><?php echo __('Rec Department'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($recDepartment['RecDepartment']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Department Name'); ?></dt>
		<dd>
			<?php echo h($recDepartment['RecDepartment']['department_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Rec Department'); ?></dt>
		<dd>
			<?php echo $this->Html->link($recDepartment['RecDepartment']['parent_id'], array('controller' => 'rec_departments', 'action' => 'view', $recDepartment['RecDepartment']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rec Company'); ?></dt>
		<dd>
			<?php echo $this->Html->link($recDepartment['RecCompany']['id'], array('controller' => 'rec_companies', 'action' => 'view', $recDepartment['RecCompany']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hr Flag'); ?></dt>
		<dd>
			<?php echo h($recDepartment['RecDepartment']['hr_flag']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fac Manager'); ?></dt>
		<dd>
			<?php echo $this->Html->link($recDepartment['FacManager']['id'], array('controller' => 'fac_managers', 'action' => 'view', $recDepartment['FacManager']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($recDepartment['RecDepartment']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($recDepartment['RecDepartment']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($recDepartment['RecDepartment']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
