<div class="selStatuses index">
	<h2><?php echo __('Sel Statuses'); ?></h2>

	<?php echo $this->Form->create('MlSendHistories', array( 'type' => 'post', 'url' => array('controller' => 'MlSendHistories','action' => 'send'))); ?>
	<?php
		echo $this->Form->input('templateId', array( 'options' => $templateList));
	?>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo 'send' ?></th>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('job_vote_id'); ?></th>
			<th><?php echo $this->Paginator->sort('can_candidate_id'); ?></th>
			<th><?php echo $this->Paginator->sort('screening_stage_id'); ?></th>
			<th><?php echo $this->Paginator->sort('select_status_id'); ?></th>
			<th><?php echo $this->Paginator->sort('select_option_id'); ?></th>
			<th><?php echo $this->Paginator->sort('comment'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('visited_info'); ?></th>
			<th><?php echo $this->Paginator->sort('annual_income'); ?></th>
			<th><?php echo $this->Paginator->sort('start_date'); ?></th>
			<th><?php echo $this->Paginator->sort('end_date'); ?></th>
			<th><?php echo $this->Paginator->sort('influx_propriety'); ?></th>
			<th><?php echo $this->Paginator->sort('candidate_propriety'); ?></th>
			<th><?php echo $this->Paginator->sort('last_modified_type'); ?></th>
			<th><?php echo $this->Paginator->sort('rec_recruiter_id'); ?></th>
			<th><?php echo $this->Paginator->sort('inf_staff_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>

	<tbody>
	<?php foreach ($selStatuses as $selStatus): ?>
	<tr>
		<td><?php echo $this->Form->input('sendIds.'.$selStatus['SelStatus']['id'], array('type' => 'checkbox', 'label' => false)); ?>&nbsp;</td>

		<td><?php echo h($selStatus['SelStatus']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($selStatus['JobVote']['title'], array('controller' => 'job_votes', 'action' => 'view', $selStatus['JobVote']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($selStatus['CanCandidate']['id'], array('controller' => 'can_candidates', 'action' => 'view', $selStatus['CanCandidate']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($selStatus['ScreeningStage']['name'], array('controller' => 'screening_stages', 'action' => 'view', $selStatus['ScreeningStage']['id'])); ?>
		</td>
		<td><?php echo h($selStatus['SelStatus']['select_status_id']); ?>&nbsp;</td>
		<td><?php echo h($selStatus['SelStatus']['select_option_id']); ?>&nbsp;</td>
		<td><?php echo h($selStatus['SelStatus']['comment']); ?>&nbsp;</td>
		<td><?php echo h($selStatus['SelStatus']['status']); ?>&nbsp;</td>
		<td><?php echo h($selStatus['SelStatus']['visited_info']); ?>&nbsp;</td>
		<td><?php echo h($selStatus['SelStatus']['annual_income']); ?>&nbsp;</td>
		<td><?php echo h($selStatus['SelStatus']['start_date']); ?>&nbsp;</td>
		<td><?php echo h($selStatus['SelStatus']['end_date']); ?>&nbsp;</td>
		<td><?php echo h($selStatus['SelStatus']['influx_propriety']); ?>&nbsp;</td>
		<td><?php echo h($selStatus['SelStatus']['candidate_propriety']); ?>&nbsp;</td>
		<td><?php echo h($selStatus['SelStatus']['last_modified_type']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($selStatus['RecRecruiter']['id'], array('controller' => 'rec_recruiters', 'action' => 'view', $selStatus['RecRecruiter']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($selStatus['InfStaff']['id'], array('controller' => 'inf_staffs', 'action' => 'view', $selStatus['InfStaff']['id'])); ?>
		</td>
		<td><?php echo h($selStatus['SelStatus']['created']); ?>&nbsp;</td>
		<td><?php echo h($selStatus['SelStatus']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $selStatus['SelStatus']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $selStatus['SelStatus']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $selStatus['SelStatus']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $selStatus['SelStatus']['id']))); ?>
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
	?>
	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
	<?php echo $this->Form->end(__('Send')); ?>
</div>
