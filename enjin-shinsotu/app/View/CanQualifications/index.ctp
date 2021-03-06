<div class="canQualifications index">
	<h2><?php echo __('Can Qualifications'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('can_candidate_id'); ?></th>
			<th><?php echo $this->Paginator->sort('qualification_id'); ?></th>
			<th><?php echo $this->Paginator->sort('qualification'); ?></th>
			<th><?php echo $this->Paginator->sort('score'); ?></th>
			<th><?php echo $this->Paginator->sort('acquisition_date'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($canQualifications as $canQualification): ?>
	<tr>
		<td><?php echo h($canQualification['CanQualification']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($canQualification['CanCandidate']['name'], array('controller' => 'can_candidates', 'action' => 'view', $canQualification['CanCandidate']['id'])); ?>
		</td>
		<td><?php echo h($qualifications[$canQualification['CanQualification']['qualification_id']]); ?>&nbsp;</td>
		<td><?php echo h($canQualification['CanQualification']['qualification']); ?>&nbsp;</td>
		<td><?php echo h($canQualification['CanQualification']['score']); ?>&nbsp;</td>
		<td><?php echo h($canQualification['CanQualification']['acquisition_date']); ?>&nbsp;</td>
		<td><?php echo h($selStatus[$canQualification['CanQualification']['status']]); ?>&nbsp;</td>
		<td><?php echo h($canQualification['CanQualification']['created']); ?>&nbsp;</td>
		<td><?php echo h($canQualification['CanQualification']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $canQualification['CanQualification']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $canQualification['CanQualification']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $canQualification['CanQualification']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $canQualification['CanQualification']['id']))); ?>
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
