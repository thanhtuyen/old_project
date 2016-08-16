<div class="purposes index">
	<h2><?php echo __('Purposes'); ?></h2>
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
	<?php foreach ($purposes as $purpose): ?>
	<tr>
		<td><?php echo h($purpose['Purpose']['id']); ?>&nbsp;</td>
		<td><?php echo h($purpose['Purpose']['name']); ?>&nbsp;</td>
		<td><?php echo h($purpose['Purpose']['status']); ?>&nbsp;</td>
		<td><?php echo h($purpose['Purpose']['created']); ?>&nbsp;</td>
		<td><?php echo h($purpose['Purpose']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $purpose['Purpose']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $purpose['Purpose']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $purpose['Purpose']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $purpose['Purpose']['id']))); ?>
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
