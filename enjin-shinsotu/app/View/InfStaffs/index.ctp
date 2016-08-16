<div class="infStaffs index">
	<h2><?php echo __('Inf Staffs'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('last_name'); ?></th>
			<th><?php echo $this->Paginator->sort('first_name'); ?></th>
			<th><?php echo $this->Paginator->sort('mail_address'); ?></th>
			<th><?php echo $this->Paginator->sort('unique_id'); ?></th>
			<th><?php echo $this->Paginator->sort('password'); ?></th>
			<th><?php echo $this->Paginator->sort('referer_company_id'); ?></th>
			<th><?php echo $this->Paginator->sort('tel'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('rec_recruiter_id'); ?></th>
			<th><?php echo $this->Paginator->sort('last_login_date'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($infStaffs as $infStaff): ?>
	<tr>
		<td><?php echo h($infStaff['InfStaff']['id']); ?>&nbsp;</td>
		<td><?php echo h($infStaff['InfStaff']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($infStaff['InfStaff']['first_name']); ?>&nbsp;</td>
		<td><?php echo h($infStaff['InfStaff']['mail_address']); ?>&nbsp;</td>
		<td><?php echo h($infStaff['InfStaff']['unique_id']); ?>&nbsp;</td>
		<td><?php echo h($infStaff['InfStaff']['password']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($infStaff['RefererCompany']['name'], array('controller' => 'referer_companies', 'action' => 'view', $infStaff['RefererCompany']['id'])); ?>
		</td>
		<td><?php echo h($infStaff['InfStaff']['tel']); ?>&nbsp;</td>
		<td><?php echo h($status[$infStaff['InfStaff']['status']]); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($infStaff['RecRecruiter']['name'], array('controller' => 'rec_recruiters', 'action' => 'view', $infStaff['RecRecruiter']['id'])); ?>
		</td>
		<td><?php echo h($infStaff['InfStaff']['last_login_date']); ?>&nbsp;</td>
		<td><?php echo h($infStaff['InfStaff']['created']); ?>&nbsp;</td>
		<td><?php echo h($infStaff['InfStaff']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $infStaff['InfStaff']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $infStaff['InfStaff']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $infStaff['InfStaff']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $infStaff['InfStaff']['id']))); ?>
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
