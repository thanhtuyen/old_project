<div class="evEvents index">
	<h2><?php echo __('Ev Events'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('rec_company_id'); ?></th>
			<th><?php echo $this->Paginator->sort('job_vote_id'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('screening_stage_id'); ?></th>
			<th><?php echo $this->Paginator->sort('screening_stage_type'); ?></th>
			<th><?php echo $this->Paginator->sort('target_select_id'); ?></th>
			<th><?php echo $this->Paginator->sort('contents'); ?></th>
			<th><?php echo $this->Paginator->sort('rikunavi_id'); ?></th>
			<th><?php echo $this->Paginator->sort('mynavi_id'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($evEvents as $evEvent): ?>
	<tr>
		<td><?php echo h($evEvent['EvEvent']['id']); ?>&nbsp;</td>
		<td><?php echo h($evEvent['EvEvent']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($evEvent['RecCompany']['company_name'], array('controller' => 'rec_companies', 'action' => 'view', $evEvent['RecCompany']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($evEvent['JobVote']['title'], array('controller' => 'job_votes', 'action' => 'view', $evEvent['JobVote']['id'])); ?>
		</td>
		<td><?php echo h($type[$evEvent['EvEvent']['type']]); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($evEvent['ScreeningStage']['name'], array('controller' => 'screening_stages', 'action' => 'view', $evEvent['ScreeningStage']['id'])); ?>
		</td>
		<td><?php echo h($screeningStageType[$evEvent['EvEvent']['screening_stage_type']]); ?>&nbsp;</td>
		<td><?php echo h($selectJudgmentType[$evEvent['EvEvent']['target_select_id']]); ?>&nbsp;</td>
		<td><?php echo h($evEvent['EvEvent']['contents']); ?>&nbsp;</td>
		<td><?php echo h($evEvent['EvEvent']['rikunavi_id']); ?>&nbsp;</td>
		<td><?php echo h($evEvent['EvEvent']['mynavi_id']); ?>&nbsp;</td>
		<td><?php echo h($evStatus[$evEvent['EvEvent']['status']]); ?>&nbsp;</td>
		<td><?php echo h($evEvent['EvEvent']['created']); ?>&nbsp;</td>
		<td><?php echo h($evEvent['EvEvent']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $evEvent['EvEvent']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $evEvent['EvEvent']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $evEvent['EvEvent']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $evEvent['EvEvent']['id']))); ?>
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
