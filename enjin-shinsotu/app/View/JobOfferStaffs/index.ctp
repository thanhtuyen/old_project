<div class="jobOfferStaffs index">
	<h2><?php echo __('Job Offer Staffs'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('job_votes_id'); ?></th>
			<th><?php echo $this->Paginator->sort('rec_recruiter_id'); ?></th>
			<th><?php echo $this->Paginator->sort('last_modified_recruiter_id'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($jobOfferStaffs as $jobOfferStaff): ?>
	<tr>
		<td><?php echo h($jobOfferStaff['JobOfferStaff']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($jobOfferStaff['JobVote']['title'], array('controller' => 'job_votes', 'action' => 'view', $jobOfferStaff['JobVote']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($jobOfferStaff['RecRecruiter']['id'], array('controller' => 'rec_recruiters', 'action' => 'view', $jobOfferStaff['RecRecruiter']['id'])); ?>
		</td>
		<td><?php echo h($jobOfferStaff['JobOfferStaff']['last_modified_recruiter_id']); ?>&nbsp;</td>
		<td><?php echo h($jobOfferStaff['JobOfferStaff']['status']); ?>&nbsp;</td>
		<td><?php echo h($jobOfferStaff['JobOfferStaff']['created']); ?>&nbsp;</td>
		<td><?php echo h($jobOfferStaff['JobOfferStaff']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $jobOfferStaff['JobOfferStaff']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $jobOfferStaff['JobOfferStaff']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $jobOfferStaff['JobOfferStaff']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $jobOfferStaff['JobOfferStaff']['id']))); ?>
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
