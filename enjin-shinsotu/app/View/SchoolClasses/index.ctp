<div class="schoolClasses index">
	<h2><?php echo __('School Classes'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($schoolClasses as $schoolClass): ?>
	<tr>
		<td><?php echo h($schoolClass['SchoolClass']['id']); ?>&nbsp;</td>
		<td><?php echo h($schoolClass['SchoolClass']['name']); ?>&nbsp;</td>
		<td><?php echo h($schoolClass['SchoolClass']['status']); ?>&nbsp;</td>
		<td><?php echo h($schoolClass['SchoolClass']['created']); ?>&nbsp;</td>
		<td><?php echo h($schoolClass['SchoolClass']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $schoolClass['SchoolClass']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $schoolClass['SchoolClass']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $schoolClass['SchoolClass']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $schoolClass['SchoolClass']['id']))); ?>
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
