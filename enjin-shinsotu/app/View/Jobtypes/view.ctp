<div class="jobtypes view">
<h2><?php echo __('Jobtype'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($jobtype['Jobtype']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($jobtype['Jobtype']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($jobtype['Jobtype']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($jobtype['Jobtype']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($jobtype['Jobtype']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Related Job Vokes'); ?></h3>
	<?php if (!empty($jobtype['JobVoke'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Rec Department Id'); ?></th>
		<th><?php echo __('Requirement'); ?></th>
		<th><?php echo __('Jobtype Id'); ?></th>
		<th><?php echo __('Treatment'); ?></th>
		<th><?php echo __('Qualification Require'); ?></th>
		<th><?php echo __('Wanted Person'); ?></th>
		<th><?php echo __('Wanted Deadline'); ?></th>
		<th><?php echo __('Start Salary'); ?></th>
		<th><?php echo __('Start Date'); ?></th>
		<th><?php echo __('Recruitment Area Id'); ?></th>
		<th><?php echo __('Wanted Year'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Rikunavi Id'); ?></th>
		<th><?php echo __('Mynavi Id'); ?></th>
		<th><?php echo __('Rec Recruiter Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($jobtype['JobVoke'] as $jobVoke): ?>
		<tr>
			<td><?php echo $jobVoke['id']; ?></td>
			<td><?php echo $jobVoke['title']; ?></td>
			<td><?php echo $jobVoke['rec_department_id']; ?></td>
			<td><?php echo $jobVoke['requirement']; ?></td>
			<td><?php echo $jobVoke['jobtype_id']; ?></td>
			<td><?php echo $jobVoke['treatment']; ?></td>
			<td><?php echo $jobVoke['qualification_require']; ?></td>
			<td><?php echo $jobVoke['wanted_person']; ?></td>
			<td><?php echo $jobVoke['wanted_deadline']; ?></td>
			<td><?php echo $jobVoke['start_salary']; ?></td>
			<td><?php echo $jobVoke['start_date']; ?></td>
			<td><?php echo $jobVoke['recruitment_area_id']; ?></td>
			<td><?php echo $jobVoke['wanted_year']; ?></td>
			<td><?php echo $jobVoke['status']; ?></td>
			<td><?php echo $jobVoke['rikunavi_id']; ?></td>
			<td><?php echo $jobVoke['mynavi_id']; ?></td>
			<td><?php echo $jobVoke['rec_recruiter_id']; ?></td>
			<td><?php echo $jobVoke['created']; ?></td>
			<td><?php echo $jobVoke['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'job_vokes', 'action' => 'view', $jobVoke['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'job_vokes', 'action' => 'edit', $jobVoke['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'job_vokes', 'action' => 'delete', $jobVoke['id']), array(), __('Are you sure you want to delete # %s?', $jobVoke['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
