<div class="canDocuments index">
	<h2><?php echo __('Can Documents'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('can_candidate_id'); ?></th>
			<th><?php echo $this->Paginator->sort('ev_history_id'); ?></th>
			<th><?php echo $this->Paginator->sort('sel_history_id'); ?></th>
			<th><?php echo $this->Paginator->sort('file_name'); ?></th>
			<th><?php echo $this->Paginator->sort('extension'); ?></th>
			<th><?php echo $this->Paginator->sort('binary_data'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($canDocuments as $canDocument): ?>
	<tr>
		<td><?php echo h($canDocument['CanDocument']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($canDocument['CanCandidate']['id'], array('controller' => 'can_candidates', 'action' => 'view', $canDocument['CanCandidate']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($canDocument['EvHistory']['id'], array('controller' => 'ev_histories', 'action' => 'view', $canDocument['EvHistory']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($canDocument['SelHistory']['id'], array('controller' => 'sel_histories', 'action' => 'view', $canDocument['SelHistory']['id'])); ?>
		</td>
		<td><?php echo h($canDocument['CanDocument']['file_name']); ?>&nbsp;</td>
		<td><?php echo h($canDocument['CanDocument']['extension']); ?>&nbsp;</td>
		<td><?php echo h($canDocument['CanDocument']['binary_data']); ?>&nbsp;</td>
		<td><?php echo h($canDocument['CanDocument']['status']); ?>&nbsp;</td>
		<td><?php echo h($canDocument['CanDocument']['created']); ?>&nbsp;</td>
		<td><?php echo h($canDocument['CanDocument']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $canDocument['CanDocument']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $canDocument['CanDocument']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $canDocument['CanDocument']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $canDocument['CanDocument']['id']))); ?>
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
