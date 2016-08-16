<div class="undergraduateInitialData index">
	<h2><?php echo __('Undergraduate Initial Data'); ?></h2>
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
	<?php foreach ($undergraduateInitialData as $undergraduateInitialData): ?>
	<tr>
		<td><?php echo h($undergraduateInitialData['UndergraduateInitialData']['id']); ?>&nbsp;</td>
		<td><?php echo h($undergraduateInitialData['UndergraduateInitialData']['name']); ?>&nbsp;</td>
		<td><?php echo h($undergraduateInitialData['UndergraduateInitialData']['status']); ?>&nbsp;</td>
		<td><?php echo h($undergraduateInitialData['UndergraduateInitialData']['created']); ?>&nbsp;</td>
		<td><?php echo h($undergraduateInitialData['UndergraduateInitialData']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $undergraduateInitialData['UndergraduateInitialData']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $undergraduateInitialData['UndergraduateInitialData']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $undergraduateInitialData['UndergraduateInitialData']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $undergraduateInitialData['UndergraduateInitialData']['id']))); ?>
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
