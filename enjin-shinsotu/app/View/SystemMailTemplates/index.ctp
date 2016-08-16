<div class="systemMailTemplates index">
	<h2><?php echo __('System Mail Templates'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('template'); ?></th>
			<th><?php echo $this->Paginator->sort('subject'); ?></th>
			<th><?php echo $this->Paginator->sort('body'); ?></th>
			<th><?php echo $this->Paginator->sort('ev_event_id'); ?></th>
			<th><?php echo $this->Paginator->sort('job_vote_id'); ?></th>
			<th><?php echo $this->Paginator->sort('screening_stage_id'); ?></th>
			<th><?php echo $this->Paginator->sort('purpose_id'); ?></th>
			<th><?php echo $this->Paginator->sort('rec_company_id'); ?></th>
			<th><?php echo $this->Paginator->sort('rec_recruiter_id'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($systemMailTemplates as $systemMailTemplate): ?>
	<tr>
		<td><?php echo h($systemMailTemplate['SystemMailTemplate']['id']); ?>&nbsp;</td>
		<td><?php echo h($systemMailTemplate['SystemMailTemplate']['template']); ?>&nbsp;</td>
		<td><?php echo h($systemMailTemplate['SystemMailTemplate']['subject']); ?>&nbsp;</td>
		<td><?php echo h($systemMailTemplate['SystemMailTemplate']['body']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($systemMailTemplate['EvEvent']['name'], array('controller' => 'ev_events', 'action' => 'view', $systemMailTemplate['EvEvent']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($systemMailTemplate['JobVote']['title'], array('controller' => 'job_votes', 'action' => 'view', $systemMailTemplate['JobVote']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($systemMailTemplate['ScreeningStage']['name'], array('controller' => 'screening_stages', 'action' => 'view', $systemMailTemplate['ScreeningStage']['id'])); ?>
		</td>
		<td>
			<?php echo h($purpose[$systemMailTemplate['SystemMailTemplate']['purpose_id']]); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($systemMailTemplate['RecCompany']['company_name'], array('controller' => 'rec_companies', 'action' => 'view', $systemMailTemplate['RecCompany']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($systemMailTemplate['RecRecruiter']['name'], array('controller' => 'rec_recruiters', 'action' => 'view', $systemMailTemplate['RecRecruiter']['id'])); ?>
		</td>
		<td><?php echo h($selStatus[$systemMailTemplate['SystemMailTemplate']['status']]); ?>&nbsp;</td>
		<td><?php echo h($systemMailTemplate['SystemMailTemplate']['created']); ?>&nbsp;</td>
		<td><?php echo h($systemMailTemplate['SystemMailTemplate']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $systemMailTemplate['SystemMailTemplate']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $systemMailTemplate['SystemMailTemplate']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $systemMailTemplate['SystemMailTemplate']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $systemMailTemplate['SystemMailTemplate']['id']))); ?>
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
