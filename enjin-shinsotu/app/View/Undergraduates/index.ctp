<div class="undergraduates index">
	<h2><?php echo __('Undergraduates'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('rec_company_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('rec_recruiter_id'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($undergraduates as $undergraduate): ?>
	<tr>
		<td><?php echo h($undergraduate['Undergraduate']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($undergraduate['RecCompany']['id'], array('controller' => 'rec_companies', 'action' => 'view', $undergraduate['RecCompany']['id'])); ?>
		</td>
		<td><?php echo h($undergraduate['Undergraduate']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($undergraduate['RecRecruiter']['id'], array('controller' => 'rec_recruiters', 'action' => 'view', $undergraduate['RecRecruiter']['id'])); ?>
		</td>
		<td><?php echo h($undergraduate['Undergraduate']['status']); ?>&nbsp;</td>
		<td><?php echo h($undergraduate['Undergraduate']['created']); ?>&nbsp;</td>
		<td><?php echo h($undergraduate['Undergraduate']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $undergraduate['Undergraduate']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $undergraduate['Undergraduate']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $undergraduate['Undergraduate']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $undergraduate['Undergraduate']['id']))); ?>
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
