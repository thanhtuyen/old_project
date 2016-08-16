<div class="canCustomAttributes index">
	<h2><?php echo __('Can Custom Attributes'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('can_candidate_id'); ?></th>
			<th><?php echo $this->Paginator->sort('can_custom_field_id'); ?></th>
			<th><?php echo $this->Paginator->sort('value'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('rec_recruiter_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($canCustomAttributes as $canCustomAttribute): ?>
	<tr>
		<td><?php echo h($canCustomAttribute['CanCustomAttribute']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($canCustomAttribute['CanCandidate']['name'], array('controller' => 'can_candidates', 'action' => 'view', $canCustomAttribute['CanCandidate']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($canCustomAttribute['CanCustomField']['field_name'], array('controller' => 'can_custom_fields', 'action' => 'view', $canCustomAttribute['CanCustomField']['id'])); ?>
		</td>
		<td><?php echo h($canCustomAttribute['CanCustomAttribute']['value']); ?>&nbsp;</td>
		<td><?php echo h($canCustomAttribute['CanCustomAttribute']['status']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($canCustomAttribute['RecRecruiter']['name'], array('controller' => 'rec_recruiters', 'action' => 'view', $canCustomAttribute['RecRecruiter']['id'])); ?>
		</td>
		<td><?php echo h($canCustomAttribute['CanCustomAttribute']['created']); ?>&nbsp;</td>
		<td><?php echo h($canCustomAttribute['CanCustomAttribute']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $canCustomAttribute['CanCustomAttribute']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $canCustomAttribute['CanCustomAttribute']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $canCustomAttribute['CanCustomAttribute']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $canCustomAttribute['CanCustomAttribute']['id']))); ?>
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
