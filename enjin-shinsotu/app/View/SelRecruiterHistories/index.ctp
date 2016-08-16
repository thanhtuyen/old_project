<div class="selRecruiterHistories index">
	<h2><?php echo __('Sel Recruiter Histories'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('sel_history_id'); ?></th>
			<th><?php echo $this->Paginator->sort('rec_recruiter_id'); ?></th>
			<th><?php echo $this->Paginator->sort('assign_situation_id'); ?></th>
			<th><?php echo $this->Paginator->sort('evaluation_rank'); ?></th>
			<th><?php echo $this->Paginator->sort('evaluation_score'); ?></th>
			<th><?php echo $this->Paginator->sort('evaluation_comment'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($selRecruiterHistories as $selRecruiterHistory): ?>
	<tr>
		<td><?php echo h($selRecruiterHistory['SelRecruiterHistory']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($selRecruiterHistory['SelHistory']['id'], array('controller' => 'sel_histories', 'action' => 'view', $selRecruiterHistory['SelHistory']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($selRecruiterHistory['RecRecruiter']['last_name'].$selRecruiterHistory['RecRecruiter']['first_name'], array('controller' => 'rec_recruiters', 'action' => 'view', $selRecruiterHistory['RecRecruiter']['id'])); ?>
		</td>
		<td><?php echo h($assingSituations[$selRecruiterHistory['SelRecruiterHistory']['assign_situation_id']]); ?>&nbsp;</td>
		<td><?php echo h($selRecruiterHistory['SelRecruiterHistory']['evaluation_rank']); ?>&nbsp;</td>
		<td><?php echo h($selRecruiterHistory['SelRecruiterHistory']['evaluation_score']); ?>&nbsp;</td>
		<td><?php echo h($selRecruiterHistory['SelRecruiterHistory']['evaluation_comment']); ?>&nbsp;</td>
		<td><?php echo h($selRecruiterHistory['SelRecruiterHistory']['status']); ?>&nbsp;</td>
		<td><?php echo h($selRecruiterHistory['SelRecruiterHistory']['created']); ?>&nbsp;</td>
		<td><?php echo h($selRecruiterHistory['SelRecruiterHistory']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $selRecruiterHistory['SelRecruiterHistory']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $selRecruiterHistory['SelRecruiterHistory']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $selRecruiterHistory['SelRecruiterHistory']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $selRecruiterHistory['SelRecruiterHistory']['id']))); ?>
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
