<div class="canNotices index">
	<h2><?php echo __('Can Notices'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('can_candidate_id'); ?></th>
			<th><?php echo $this->Paginator->sort('notice'); ?></th>
			<th><?php echo $this->Paginator->sort('register_type'); ?></th>
			<th><?php echo $this->Paginator->sort('rec_recruiter_id'); ?></th>
			<th><?php echo $this->Paginator->sort('inf_staff_id'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($canNotices as $canNotice): ?>
	<tr>
		<td><?php echo h($canNotice['CanNotice']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($canNotice['CanCandidate']['id'], array('controller' => 'can_candidates', 'action' => 'view', $canNotice['CanCandidate']['id'])); ?>
		</td>
		<td><?php echo h($canNotice['CanNotice']['notice']); ?>&nbsp;</td>
		<td><?php echo h($canNotice['CanNotice']['register_type']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($canNotice['RecRecruiter']['id'], array('controller' => 'rec_recruiters', 'action' => 'view', $canNotice['RecRecruiter']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($canNotice['InfStaff']['id'], array('controller' => 'inf_staffs', 'action' => 'view', $canNotice['InfStaff']['id'])); ?>
		</td>
		<td><?php echo h($canNotice['CanNotice']['status']); ?>&nbsp;</td>
		<td><?php echo h($canNotice['CanNotice']['created']); ?>&nbsp;</td>
		<td><?php echo h($canNotice['CanNotice']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $canNotice['CanNotice']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $canNotice['CanNotice']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $canNotice['CanNotice']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $canNotice['CanNotice']['id']))); ?>
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
