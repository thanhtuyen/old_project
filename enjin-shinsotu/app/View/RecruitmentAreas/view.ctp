<div class="recruitmentAreas view">
<h2><?php echo __('Recruitment Area'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($recruitmentArea['RecruitmentArea']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Area'); ?></dt>
		<dd>
			<?php echo h($recruitmentArea['RecruitmentArea']['area']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rec Company'); ?></dt>
		<dd>
			<?php echo $this->Html->link($recruitmentArea['RecCompany']['company_name'], array('controller' => 'rec_companies', 'action' => 'view', $recruitmentArea['RecCompany']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($recruitmentArea['RecruitmentArea']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($recruitmentArea['RecruitmentArea']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($recruitmentArea['RecruitmentArea']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Related Job Votes'); ?></h3>
	<?php if (!empty($recruitmentArea['JobVote'])): ?>
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
	<?php foreach ($recruitmentArea['JobVote'] as $jobVote): ?>
		<tr>
			<td><?php echo $jobVote['id']; ?></td>
			<td><?php echo $jobVote['title']; ?></td>
			<td><?php echo $jobVote['rec_department_id']; ?></td>
			<td><?php echo $jobVote['requirement']; ?></td>
			<td><?php echo $jobVote['jobtype_id']; ?></td>
			<td><?php echo $jobVote['treatment']; ?></td>
			<td><?php echo $jobVote['qualification_require']; ?></td>
			<td><?php echo $jobVote['wanted_person']; ?></td>
			<td><?php echo $jobVote['wanted_deadline']; ?></td>
			<td><?php echo $jobVote['start_salary']; ?></td>
			<td><?php echo $jobVote['start_date']; ?></td>
			<td><?php echo $jobVote['recruitment_area_id']; ?></td>
			<td><?php echo $jobVote['wanted_year']; ?></td>
			<td><?php echo $jobVote['status']; ?></td>
			<td><?php echo $jobVote['rikunavi_id']; ?></td>
			<td><?php echo $jobVote['mynavi_id']; ?></td>
			<td><?php echo $jobVote['rec_recruiter_id']; ?></td>
			<td><?php echo $jobVote['created']; ?></td>
			<td><?php echo $jobVote['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'job_votes', 'action' => 'view', $jobVote['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'job_votes', 'action' => 'edit', $jobVote['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'job_votes', 'action' => 'delete', $jobVote['id']), array(), __('Are you sure you want to delete # %s?', $jobVote['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
