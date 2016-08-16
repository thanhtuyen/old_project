<div class="evSchedules view">
<h2><?php echo __('Ev Schedule'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($evSchedule['EvSchedule']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ev Event'); ?></dt>
		<dd>
			<?php echo $this->Html->link($evSchedule['EvEvent']['name'], array('controller' => 'ev_events', 'action' => 'view', $evSchedule['EvEvent']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Holding Date'); ?></dt>
		<dd>
			<?php echo h($evSchedule['EvSchedule']['holding_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Date'); ?></dt>
		<dd>
			<?php echo h($evSchedule['EvSchedule']['end_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Individual Theme'); ?></dt>
		<dd>
			<?php echo h($evSchedule['EvSchedule']['individual_theme']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Capacity'); ?></dt>
		<dd>
			<?php echo h($evSchedule['EvSchedule']['capacity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Wanted Deadline'); ?></dt>
		<dd>
			<?php echo h($evSchedule['EvSchedule']['wanted_deadline']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Venue'); ?></dt>
		<dd>
			<?php echo h($evSchedule['EvSchedule']['venue']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Day Content'); ?></dt>
		<dd>
			<?php echo h($evSchedule['EvSchedule']['day_content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Holding Cost'); ?></dt>
		<dd>
			<?php echo h($evSchedule['EvSchedule']['holding_cost']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($evSchedule['EvSchedule']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($evSchedule['EvSchedule']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($evSchedule['EvSchedule']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div>
	<?php echo $this->Html->link(__('印刷'), array('controller' => 'pdfs', 'action' => 'pdfs_event', $evSchedule['EvSchedule']['id'])); ?>
</div>

<div class="related">
	<h3><?php echo __('Related Ev Histories'); ?></h3>
	<?php if (!empty($evSchedule['EvHistory'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Can Candidate Id'); ?></th>
		<th><?php echo __('Ev Schedule Id'); ?></th>
		<th><?php echo __('After Score'); ?></th>
		<th><?php echo __('After Comment'); ?></th>
		<th><?php echo __('Rec Recruiter Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($evSchedule['EvHistory'] as $evHistory): ?>
		<tr>
			<td><?php echo $evHistory['id']; ?></td>
			<td><?php echo $evHistory['can_candidate_id']; ?></td>
			<td><?php echo $evHistory['ev_schedule_id']; ?></td>
			<td><?php echo $evHistory['after_score']; ?></td>
			<td><?php echo $evHistory['after_comment']; ?></td>
			<td><?php echo $evHistory['rec_recruiter_id']; ?></td>
			<td><?php echo $evHistory['status']; ?></td>
			<td><?php echo $evHistory['created']; ?></td>
			<td><?php echo $evHistory['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'ev_histories', 'action' => 'view', $evHistory['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'ev_histories', 'action' => 'edit', $evHistory['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'ev_histories', 'action' => 'delete', $evHistory['id']), array(), __('Are you sure you want to delete # %s?', $evHistory['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
