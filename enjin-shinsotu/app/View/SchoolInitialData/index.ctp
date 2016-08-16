<div class="schoolInitialData index">
	<h2><?php echo __('School Initial Data'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('school_class_id'); ?></th>
			<th><?php echo $this->Paginator->sort('public_private_class_id'); ?></th>
			<th><?php echo $this->Paginator->sort('school_rank'); ?></th>
			<th><?php echo $this->Paginator->sort('country_id'); ?></th>
			<th><?php echo $this->Paginator->sort('prefecture_id'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($schoolInitialData as $schoolInitialData): ?>
	<tr>
		<td><?php echo h($schoolInitialData['SchoolInitialData']['id']); ?>&nbsp;</td>
		<td><?php echo h($schoolInitialData['SchoolInitialData']['name']); ?>&nbsp;</td>
		<td><?php echo h($schoolClass[$schoolInitialData['SchoolInitialData']['school_class_id']]); ?>&nbsp;</td>
		<td><?php echo h($publicPrivateClass[$schoolInitialData['SchoolInitialData']['public_private_class_id']]); ?>&nbsp;</td>
		<td><?php echo h($schoolRank[$schoolInitialData['SchoolInitialData']['school_rank']]); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($schoolInitialData['Country']['name'], array('controller' => 'countries', 'action' => 'view', $schoolInitialData['Country']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($schoolInitialData['Prefecture']['name'], array('controller' => 'prefectures', 'action' => 'view', $schoolInitialData['Prefecture']['id'])); ?>
		</td>
		<td><?php echo h($status[$schoolInitialData['SchoolInitialData']['status']]); ?>&nbsp;</td>
		<td><?php echo h($schoolInitialData['SchoolInitialData']['created']); ?>&nbsp;</td>
		<td><?php echo h($schoolInitialData['SchoolInitialData']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $schoolInitialData['SchoolInitialData']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $schoolInitialData['SchoolInitialData']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $schoolInitialData['SchoolInitialData']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $schoolInitialData['SchoolInitialData']['id']))); ?>
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
