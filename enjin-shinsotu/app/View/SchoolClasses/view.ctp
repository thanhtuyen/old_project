<div class="schoolClasses view">
<h2><?php echo __('School Class'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($schoolClass['SchoolClass']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($schoolClass['SchoolClass']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($schoolClass['SchoolClass']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($schoolClass['SchoolClass']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($schoolClass['SchoolClass']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Related School Initial Data'); ?></h3>
	<?php if (!empty($schoolClass['SchoolInitialData'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('School Class Id'); ?></th>
		<th><?php echo __('Public Private Class Id'); ?></th>
		<th><?php echo __('School Rank'); ?></th>
		<th><?php echo __('Prefecture Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($schoolClass['SchoolInitialData'] as $schoolInitialData): ?>
		<tr>
			<td><?php echo $schoolInitialData['id']; ?></td>
			<td><?php echo $schoolInitialData['name']; ?></td>
			<td><?php echo $schoolInitialData['school_class_id']; ?></td>
			<td><?php echo $schoolInitialData['public_private_class_id']; ?></td>
			<td><?php echo $schoolInitialData['school_rank']; ?></td>
			<td><?php echo $schoolInitialData['prefecture_id']; ?></td>
			<td><?php echo $schoolInitialData['status']; ?></td>
			<td><?php echo $schoolInitialData['created']; ?></td>
			<td><?php echo $schoolInitialData['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'school_initial_data', 'action' => 'view', $schoolInitialData['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'school_initial_data', 'action' => 'edit', $schoolInitialData['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'school_initial_data', 'action' => 'delete', $schoolInitialData['id']), array(), __('Are you sure you want to delete # %s?', $schoolInitialData['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Schools'); ?></h3>
	<?php if (!empty($schoolClass['School'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Rec Company Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('School Class Id'); ?></th>
		<th><?php echo __('Public Private Class Id'); ?></th>
		<th><?php echo __('School Rank'); ?></th>
		<th><?php echo __('Prefecture Id'); ?></th>
		<th><?php echo __('Rec Recruiter Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($schoolClass['School'] as $school): ?>
		<tr>
			<td><?php echo $school['id']; ?></td>
			<td><?php echo $school['rec_company_id']; ?></td>
			<td><?php echo $school['name']; ?></td>
			<td><?php echo $school['school_class_id']; ?></td>
			<td><?php echo $school['public_private_class_id']; ?></td>
			<td><?php echo $school['school_rank']; ?></td>
			<td><?php echo $school['prefecture_id']; ?></td>
			<td><?php echo $school['rec_recruiter_id']; ?></td>
			<td><?php echo $school['status']; ?></td>
			<td><?php echo $school['created']; ?></td>
			<td><?php echo $school['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'schools', 'action' => 'view', $school['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'schools', 'action' => 'edit', $school['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'schools', 'action' => 'delete', $school['id']), array(), __('Are you sure you want to delete # %s?', $school['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
