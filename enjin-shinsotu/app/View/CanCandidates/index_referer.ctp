<div class="canCandidates index">
	<h2><?php echo __('Can Candidates'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('last_name'); ?></th>
			<th><?php echo $this->Paginator->sort('first_name'); ?></th>
			<th><?php echo $this->Paginator->sort('mail_address'); ?></th>
			<th><?php echo $this->Paginator->sort('tel'); ?></th>
			<th><?php echo $this->Paginator->sort('post_code'); ?></th>
			<th><?php echo $this->Paginator->sort('prefecture_id'); ?></th>
			<th><?php echo $this->Paginator->sort('residence'); ?></th>
			<th><?php echo $this->Paginator->sort('birthday'); ?></th>
			<th><?php echo $this->Paginator->sort('sex'); ?></th>
			<th><?php echo $this->Paginator->sort('referer_company_id'); ?></th>
			<th><?php echo $this->Paginator->sort('mynavi_id'); ?></th>
			<th><?php echo $this->Paginator->sort('rikunavi_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($canCandidates as $canCandidate): ?>
	<tr>
		<td><?php echo h($canCandidate['CanCandidate']['id']); ?>&nbsp;</td>
		<td><?php echo h($canCandidate['CanCandidate']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($canCandidate['CanCandidate']['first_name']); ?>&nbsp;</td>
		<td><?php echo h($canCandidate['CanCandidate']['mail_address']); ?>&nbsp;</td>
		<td><?php echo h($canCandidate['CanCandidate']['tel']); ?>&nbsp;</td>
		<td><?php echo h($canCandidate['CanCandidate']['post_code']); ?>&nbsp;</td>
		<td>
			<?php echo h($canCandidate['Prefecture']['name']); ?>
		</td>
		<td><?php echo h($canCandidate['CanCandidate']['residence']); ?>&nbsp;</td>
		<td><?php echo h($canCandidate['CanCandidate']['birthday']); ?>&nbsp;</td>
		<td><?php echo $this->enjin->getSexName($canCandidate['CanCandidate']['sex']); ?>&nbsp;</td>
		<td>
			<?php echo h($canCandidate['RefererCompany']['name']); ?>
		</td>
		<td><?php echo h($canCandidate['CanCandidate']['mynavi_id']); ?>&nbsp;</td>
		<td><?php echo h($canCandidate['CanCandidate']['rikunavi_id']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $canCandidate['CanCandidate']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $canCandidate['CanCandidate']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $canCandidate['CanCandidate']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $canCandidate['CanCandidate']['id']))); ?>
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
