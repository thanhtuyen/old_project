z<div class="evSchedules index">
	<h2><?php echo __('Ev Schedules'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('ev_event_id'); ?></th>
			<th><?php echo $this->Paginator->sort('holding_date'); ?></th>
			<th><?php echo $this->Paginator->sort('end_date'); ?></th>
			<th><?php echo $this->Paginator->sort('individual_theme'); ?></th>
			<th><?php echo $this->Paginator->sort('capacity'); ?></th>
			<th><?php echo $this->Paginator->sort('wanted_deadline'); ?></th>
			<th><?php echo $this->Paginator->sort('venue'); ?></th>
			<th><?php echo $this->Paginator->sort('day_content'); ?></th>
			<th><?php echo $this->Paginator->sort('holding_cost'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($evSchedules as $evSchedule): ?>
	<tr>
		<td><?php echo h($evSchedule['EvSchedule']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($evSchedule['EvEvent']['name'], array('controller' => 'ev_events', 'action' => 'view', $evSchedule['EvEvent']['id'])); ?>
		</td>
		<td><?php echo h($evSchedule['EvSchedule']['holding_date']); ?>&nbsp;</td>
		<td><?php echo h($evSchedule['EvSchedule']['end_date']); ?>&nbsp;</td>
		<td><?php echo h($evSchedule['EvSchedule']['individual_theme']); ?>&nbsp;</td>
		<td><?php echo h($evSchedule['EvSchedule']['capacity']); ?>&nbsp;</td>
		<td><?php echo h($evSchedule['EvSchedule']['wanted_deadline']); ?>&nbsp;</td>
		<td><?php echo h($evSchedule['EvSchedule']['venue']); ?>&nbsp;</td>
		<td><?php echo h($evSchedule['EvSchedule']['day_content']); ?>&nbsp;</td>
		<td><?php echo h($evSchedule['EvSchedule']['holding_cost']); ?>&nbsp;</td>
		<td><?php echo h($evSchedule['EvSchedule']['status']); ?>&nbsp;</td>
		<td><?php echo h($evSchedule['EvSchedule']['created']); ?>&nbsp;</td>
		<td><?php echo h($evSchedule['EvSchedule']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $evSchedule['EvSchedule']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $evSchedule['EvSchedule']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $evSchedule['EvSchedule']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $evSchedule['EvSchedule']['id']))); ?>
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
