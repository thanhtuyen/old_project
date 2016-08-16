<div class="assignSituations view">
<h2><?php echo __('Assign Situation'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($assignSituation['AssignSituation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($assignSituation['AssignSituation']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($assignSituation['AssignSituation']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($assignSituation['AssignSituation']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($assignSituation['AssignSituation']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Related Sel Recruiter Histories'); ?></h3>
	<?php if (!empty($assignSituation['SelRecruiterHistory'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Sel Status Id'); ?></th>
		<th><?php echo __('Sel History Id'); ?></th>
		<th><?php echo __('Assign Situation Id'); ?></th>
		<th><?php echo __('Evaluation Rank'); ?></th>
		<th><?php echo __('Evaluation Score'); ?></th>
		<th><?php echo __('Evaluation Comment'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($assignSituation['SelRecruiterHistory'] as $selRecruiterHistory): ?>
		<tr>
			<td><?php echo $selRecruiterHistory['id']; ?></td>
			<td><?php echo $selRecruiterHistory['sel_status_id']; ?></td>
			<td><?php echo $selRecruiterHistory['sel_history_id']; ?></td>
			<td><?php echo $selRecruiterHistory['assign_situation_id']; ?></td>
			<td><?php echo $selRecruiterHistory['evaluation_rank']; ?></td>
			<td><?php echo $selRecruiterHistory['evaluation_score']; ?></td>
			<td><?php echo $selRecruiterHistory['evaluation_comment']; ?></td>
			<td><?php echo $selRecruiterHistory['status']; ?></td>
			<td><?php echo $selRecruiterHistory['created']; ?></td>
			<td><?php echo $selRecruiterHistory['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'sel_recruiter_histories', 'action' => 'view', $selRecruiterHistory['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'sel_recruiter_histories', 'action' => 'edit', $selRecruiterHistory['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'sel_recruiter_histories', 'action' => 'delete', $selRecruiterHistory['id']), array(), __('Are you sure you want to delete # %s?', $selRecruiterHistory['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Sel Recruiter History'), array('controller' => 'sel_recruiter_histories', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
