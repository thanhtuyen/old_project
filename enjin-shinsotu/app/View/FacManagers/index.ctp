<div class="facManagers index">
	<h2><?php echo __('Fac Managers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('last_name'); ?></th>
			<th><?php echo $this->Paginator->sort('first_name'); ?></th>
			<th><?php echo $this->Paginator->sort('mail'); ?></th>
			<th><?php echo $this->Paginator->sort('password'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('fac_manager_id'); ?></th>
			<th><?php echo $this->Paginator->sort('last_login_date'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($facManagers as $facManager): ?>
	<tr>
		<td><?php echo h($facManager['FacManager']['id']); ?>&nbsp;</td>
		<td><?php echo h($facManager['FacManager']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($facManager['FacManager']['first_name']); ?>&nbsp;</td>
		<td><?php echo h($facManager['FacManager']['mail']); ?>&nbsp;</td>
		<td><?php echo h($facManager['FacManager']['password']); ?>&nbsp;</td>
		<td><?php echo h($facManager['FacManager']['status']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($facManager['FacManager']['fac_manager_id'], array('controller' => 'fac_managers', 'action' => 'view', $facManager['FacManager']['fac_manager_id'])); ?>
		</td>
		<td><?php echo h($facManager['FacManager']['last_login_date']); ?>&nbsp;</td>
		<td><?php echo h($facManager['FacManager']['created']); ?>&nbsp;</td>
		<td><?php echo h($facManager['FacManager']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $facManager['FacManager']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $facManager['FacManager']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $facManager['FacManager']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $facManager['FacManager']['id']))); ?>
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
