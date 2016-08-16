<div class="jobSelectTargets index">
	<h2><?php echo __('Job Select Targets'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('job_vote_id'); ?></th>
			<th><?php echo $this->Paginator->sort('attain_deadline_date'); ?></th>
			<th><?php echo $this->Paginator->sort('screening_stage_id'); ?></th>
			<th><?php echo $this->Paginator->sort('target_select_id'); ?></th>
			<th><?php echo $this->Paginator->sort('select_judgment_type'); ?></th>
			<th><?php echo $this->Paginator->sort('target_number'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('rec_recruiter_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($jobSelectTargets as $jobSelectTarget): ?>
	<tr>
		<td><?php echo h($jobSelectTarget['JobSelectTarget']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($jobSelectTarget['JobVote']['title'], array('controller' => 'job_votes', 'action' => 'view', $jobSelectTarget['JobVote']['id'])); ?>
		</td>
		<td><?php echo h($jobSelectTarget['JobSelectTarget']['attain_deadline_date']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($jobSelectTarget['ScreeningStage']['name'], array('controller' => 'screening_stages', 'action' => 'view', $jobSelectTarget['ScreeningStage']['id'])); ?>
		</td>
		<td><?php echo h($jobSelectTarget['JobSelectTarget']['target_select_id']); ?>&nbsp;</td>
		<td><?php echo h($jobSelectTarget['JobSelectTarget']['select_judgment_type']); ?>&nbsp;</td>
		<td><?php echo h($jobSelectTarget['JobSelectTarget']['target_number']); ?>&nbsp;</td>
		<td><?php echo h($jobSelectTarget['JobSelectTarget']['status']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($jobSelectTarget['RecRecruiter']['name'], array('controller' => 'rec_recruiters', 'action' => 'view', $jobSelectTarget['RecRecruiter']['id'])); ?>
		</td>
		<td><?php echo h($jobSelectTarget['JobSelectTarget']['created']); ?>&nbsp;</td>
		<td><?php echo h($jobSelectTarget['JobSelectTarget']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $jobSelectTarget['JobSelectTarget']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $jobSelectTarget['JobSelectTarget']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $jobSelectTarget['JobSelectTarget']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $jobSelectTarget['JobSelectTarget']['id']))); ?>
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
