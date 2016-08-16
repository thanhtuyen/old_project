<div class="studentBunriClasses view">
<h2><?php echo __('Student Bunri Class'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($studentBunriClass['StudentBunriClass']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($studentBunriClass['StudentBunriClass']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($studentBunriClass['StudentBunriClass']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($studentBunriClass['StudentBunriClass']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($studentBunriClass['StudentBunriClass']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Related Can Educations'); ?></h3>
	<?php if (!empty($studentBunriClass['CanEducation'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Can Candidate Id'); ?></th>
		<th><?php echo __('School Id'); ?></th>
		<th><?php echo __('School'); ?></th>
		<th><?php echo __('Undergraduate Id'); ?></th>
		<th><?php echo __('Undergraduate'); ?></th>
		<th><?php echo __('Department'); ?></th>
		<th><?php echo __('Student Bunri Class Id'); ?></th>
		<th><?php echo __('Manage Bunri Class Id'); ?></th>
		<th><?php echo __('Seminar'); ?></th>
		<th><?php echo __('Major Theme'); ?></th>
		<th><?php echo __('Circle'); ?></th>
		<th><?php echo __('Admission Date'); ?></th>
		<th><?php echo __('Graduation Date'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($studentBunriClass['CanEducation'] as $canEducation): ?>
		<tr>
			<td><?php echo $canEducation['id']; ?></td>
			<td><?php echo $canEducation['can_candidate_id']; ?></td>
			<td><?php echo $canEducation['school_id']; ?></td>
			<td><?php echo $canEducation['school']; ?></td>
			<td><?php echo $canEducation['undergraduate_id']; ?></td>
			<td><?php echo $canEducation['undergraduate']; ?></td>
			<td><?php echo $canEducation['department']; ?></td>
			<td><?php echo $canEducation['student_bunri_class_id']; ?></td>
			<td><?php echo $canEducation['manage_bunri_class_id']; ?></td>
			<td><?php echo $canEducation['seminar']; ?></td>
			<td><?php echo $canEducation['major_theme']; ?></td>
			<td><?php echo $canEducation['circle']; ?></td>
			<td><?php echo $canEducation['admission_date']; ?></td>
			<td><?php echo $canEducation['graduation_date']; ?></td>
			<td><?php echo $canEducation['created']; ?></td>
			<td><?php echo $canEducation['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'can_educations', 'action' => 'view', $canEducation['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'can_educations', 'action' => 'edit', $canEducation['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'can_educations', 'action' => 'delete', $canEducation['id']), array(), __('Are you sure you want to delete # %s?', $canEducation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
