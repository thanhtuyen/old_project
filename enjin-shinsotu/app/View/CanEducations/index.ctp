<div class="canEducations index">
	<h2><?php echo __('Can Educations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('can_candidate_id'); ?></th>
			<th><?php echo $this->Paginator->sort('school_id'); ?></th>
			<th><?php echo $this->Paginator->sort('school'); ?></th>
			<th><?php echo $this->Paginator->sort('undergraduate_id'); ?></th>
			<th><?php echo $this->Paginator->sort('undergraduate'); ?></th>
			<th><?php echo $this->Paginator->sort('department'); ?></th>
			<th><?php echo $this->Paginator->sort('student_bunri_class_id'); ?></th>
			<th><?php echo $this->Paginator->sort('manage_bunri_class_id'); ?></th>
			<th><?php echo $this->Paginator->sort('seminar'); ?></th>
			<th><?php echo $this->Paginator->sort('major_theme'); ?></th>
			<th><?php echo $this->Paginator->sort('circle'); ?></th>
			<th><?php echo $this->Paginator->sort('admission_date'); ?></th>
			<th><?php echo $this->Paginator->sort('graduation_date'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($canEducations as $canEducation): ?>
	<tr>
		<td><?php echo h($canEducation['CanEducation']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($canEducation['CanCandidate']['id'], array('controller' => 'can_candidates', 'action' => 'view', $canEducation['CanCandidate']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($canEducation['School']['name'], array('controller' => 'schools', 'action' => 'view', $canEducation['School']['id'])); ?>
		</td>
		<td><?php echo h($canEducation['CanEducation']['school']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($canEducation['Undergraduate']['name'], array('controller' => 'undergraduates', 'action' => 'view', $canEducation['Undergraduate']['id'])); ?>
		</td>
		<td><?php echo h($canEducation['CanEducation']['undergraduate']); ?>&nbsp;</td>
		<td><?php echo h($canEducation['CanEducation']['department']); ?>&nbsp;</td>
		<td><?php echo h($bunriClass[$canEducation['CanEducation']['student_bunri_class_id']]); ?>&nbsp;</td>
		<td><?php echo h($bunriClass[$canEducation['CanEducation']['manage_bunri_class_id']]); ?>&nbsp;</td>
		<td><?php echo h($canEducation['CanEducation']['seminar']); ?>&nbsp;</td>
		<td><?php echo h($canEducation['CanEducation']['major_theme']); ?>&nbsp;</td>
		<td><?php echo h($canEducation['CanEducation']['circle']); ?>&nbsp;</td>
		<td><?php echo h($canEducation['CanEducation']['admission_date']); ?>&nbsp;</td>
		<td><?php echo h($canEducation['CanEducation']['graduation_date']); ?>&nbsp;</td>
		<td><?php echo h($canEducation['CanEducation']['created']); ?>&nbsp;</td>
		<td><?php echo h($canEducation['CanEducation']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $canEducation['CanEducation']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $canEducation['CanEducation']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $canEducation['CanEducation']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $canEducation['CanEducation']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
