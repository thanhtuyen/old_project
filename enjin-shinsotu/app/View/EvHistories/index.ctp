<div class="evHistories index">
	<h2><?php echo __('Ev Histories'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('can_candidate_id'); ?></th>
			<th><?php echo $this->Paginator->sort('ev_schedule_id'); ?></th>
			<th><?php echo $this->Paginator->sort('after_score'); ?></th>
			<th><?php echo $this->Paginator->sort('after_comment'); ?></th>
			<th><?php echo $this->Paginator->sort('rec_recruiter_id'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($evHistories as $evHistory): ?>
	<tr>
		<td><?php echo h($evHistory['EvHistory']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($evHistory['CanCandidate']['id'], array('controller' => 'can_candidates', 'action' => 'view', $evHistory['CanCandidate']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($evHistory['EvSchedule']['id'], array('controller' => 'ev_schedules', 'action' => 'view', $evHistory['EvSchedule']['id'])); ?>
		</td>
		<td><?php echo h($evHistory['EvHistory']['after_score']); ?>&nbsp;</td>
		<td><?php echo h($evHistory['EvHistory']['after_comment']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($evHistory['RecRecruiter']['id'], array('controller' => 'rec_recruiters', 'action' => 'view', $evHistory['RecRecruiter']['id'])); ?>
		</td>
		<td><?php echo h($evHistory['EvHistory']['status']); ?>&nbsp;</td>
		<td><?php echo h($evHistory['EvHistory']['created']); ?>&nbsp;</td>
		<td><?php echo h($evHistory['EvHistory']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $evHistory['EvHistory']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $evHistory['EvHistory']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $evHistory['EvHistory']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $evHistory['EvHistory']['id']))); ?>
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
