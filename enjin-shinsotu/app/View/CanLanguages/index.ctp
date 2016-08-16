<div class="canLanguages index">
	<h2><?php echo __('Can Languages'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('can_candidate_id'); ?></th>
			<th><?php echo $this->Paginator->sort('foreign_language_id'); ?></th>
			<th><?php echo $this->Paginator->sort('foreign_language'); ?></th>
			<th><?php echo $this->Paginator->sort('level_id'); ?></th>
			<th><?php echo $this->Paginator->sort('oversea_life'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($canLanguages as $canLanguage): ?>
	<tr>
		<td><?php echo h($canLanguage['CanLanguage']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($canLanguage['CanCandidate']['name'], array('controller' => 'can_candidates', 'action' => 'view', $canLanguage['CanCandidate']['id'])); ?>
		</td>
		<td><?php echo h($addForeignLanguage[$canLanguage['CanLanguage']['foreign_language_id']]); ?>&nbsp;</td>
		<td><?php echo h($canLanguage['CanLanguage']['foreign_language']); ?>&nbsp;</td>
		<td><?php echo h($addLevel[$canLanguage['CanLanguage']['level_id']]); ?>&nbsp;</td>
		<td><?php echo h($canLanguage['CanLanguage']['oversea_life']); ?>&nbsp;</td>
		<td><?php echo h($canLanguage['CanLanguage']['status']); ?>&nbsp;</td>
		<td><?php echo h($canLanguage['CanLanguage']['created']); ?>&nbsp;</td>
		<td><?php echo h($canLanguage['CanLanguage']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $canLanguage['CanLanguage']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $canLanguage['CanLanguage']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $canLanguage['CanLanguage']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $canLanguage['CanLanguage']['id']))); ?>
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
