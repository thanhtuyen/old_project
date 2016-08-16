<div class="selStatuses view">
<h2><?php echo __('Sel Status'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($selStatus['SelStatus']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Job Vote'); ?></dt>
		<dd>
			<?php echo $this->Html->link($selStatus['JobVote']['title'], array('controller' => 'job_votes', 'action' => 'view', $selStatus['JobVote']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Can Candidate'); ?></dt>
		<dd>
			<?php echo $this->Html->link($selStatus['CanCandidate']['id'], array('controller' => 'can_candidates', 'action' => 'view', $selStatus['CanCandidate']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Screening Stage'); ?></dt>
		<dd>
			<?php echo $this->Html->link($selStatus['ScreeningStage']['name'], array('controller' => 'screening_stages', 'action' => 'view', $selStatus['ScreeningStage']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Select Status Id'); ?></dt>
		<dd>
			<?php echo h($selStatus['SelStatus']['select_status_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Select Option Id'); ?></dt>
		<dd>
			<?php echo h($selStatus['SelStatus']['select_option_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($selStatus['SelStatus']['comment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($selStatus['SelStatus']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Visited Info'); ?></dt>
		<dd>
			<?php echo h($selStatus['SelStatus']['visited_info']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Annual Income'); ?></dt>
		<dd>
			<?php echo h($selStatus['SelStatus']['annual_income']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Date'); ?></dt>
		<dd>
			<?php echo h($selStatus['SelStatus']['start_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Date'); ?></dt>
		<dd>
			<?php echo h($selStatus['SelStatus']['end_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Influx Propriety'); ?></dt>
		<dd>
			<?php echo h($selStatus['SelStatus']['influx_propriety']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Candidate Propriety'); ?></dt>
		<dd>
			<?php echo h($selStatus['SelStatus']['candidate_propriety']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Modified Type'); ?></dt>
		<dd>
			<?php echo h($selStatus['SelStatus']['last_modified_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rec Recruiter'); ?></dt>
		<dd>
			<?php echo $this->Html->link($selStatus['RecRecruiter']['id'], array('controller' => 'rec_recruiters', 'action' => 'view', $selStatus['RecRecruiter']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Inf Staff'); ?></dt>
		<dd>
			<?php echo $this->Html->link($selStatus['InfStaff']['id'], array('controller' => 'inf_staffs', 'action' => 'view', $selStatus['InfStaff']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($selStatus['SelStatus']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($selStatus['SelStatus']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Related Can Documents'); ?></h3>
	<?php if (!empty($selStatus['CanDocument'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Can Candidate Id'); ?></th>
		<th><?php echo __('Ev History Id'); ?></th>
		<th><?php echo __('Sel Status Id'); ?></th>
		<th><?php echo __('Sel History Id'); ?></th>
		<th><?php echo __('File Name'); ?></th>
		<th><?php echo __('Extension'); ?></th>
		<th><?php echo __('Binary Data'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($selStatus['CanDocument'] as $canDocument): ?>
		<tr>
			<td><?php echo $canDocument['id']; ?></td>
			<td><?php echo $canDocument['can_candidate_id']; ?></td>
			<td><?php echo $canDocument['ev_history_id']; ?></td>
			<td><?php echo $canDocument['sel_status_id']; ?></td>
			<td><?php echo $canDocument['sel_history_id']; ?></td>
			<td><?php echo $canDocument['file_name']; ?></td>
			<td><?php echo $canDocument['extension']; ?></td>
			<td><?php echo $canDocument['binary_data']; ?></td>
			<td><?php echo $canDocument['status']; ?></td>
			<td><?php echo $canDocument['created']; ?></td>
			<td><?php echo $canDocument['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'can_documents', 'action' => 'view', $canDocument['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'can_documents', 'action' => 'edit', $canDocument['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'can_documents', 'action' => 'delete', $canDocument['id']), array(), __('Are you sure you want to delete # %s?', $canDocument['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Sel Histories'); ?></h3>
	<?php if (!empty($selStatus['SelHistory'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Sel Status Id'); ?></th>
		<th><?php echo __('Job Vote Id'); ?></th>
		<th><?php echo __('Can Candidate Id'); ?></th>
		<th><?php echo __('Screening Stage Id'); ?></th>
		<th><?php echo __('Select Status Id'); ?></th>
		<th><?php echo __('Select Option Id'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Visited Info'); ?></th>
		<th><?php echo __('Annual Income'); ?></th>
		<th><?php echo __('Start Date'); ?></th>
		<th><?php echo __('End Date'); ?></th>
		<th><?php echo __('Influx Propriety'); ?></th>
		<th><?php echo __('Candidate Propriety'); ?></th>
		<th><?php echo __('Last Modified Type'); ?></th>
		<th><?php echo __('Rec Recruiter Id'); ?></th>
		<th><?php echo __('Inf Staff Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($selStatus['SelHistory'] as $selHistory): ?>
		<tr>
			<td><?php echo $selHistory['id']; ?></td>
			<td><?php echo $selHistory['sel_status_id']; ?></td>
			<td><?php echo $selHistory['job_vote_id']; ?></td>
			<td><?php echo $selHistory['can_candidate_id']; ?></td>
			<td><?php echo $selHistory['screening_stage_id']; ?></td>
			<td><?php echo $selHistory['select_status_id']; ?></td>
			<td><?php echo $selHistory['select_option_id']; ?></td>
			<td><?php echo $selHistory['comment']; ?></td>
			<td><?php echo $selHistory['status']; ?></td>
			<td><?php echo $selHistory['visited_info']; ?></td>
			<td><?php echo $selHistory['annual_income']; ?></td>
			<td><?php echo $selHistory['start_date']; ?></td>
			<td><?php echo $selHistory['end_date']; ?></td>
			<td><?php echo $selHistory['influx_propriety']; ?></td>
			<td><?php echo $selHistory['candidate_propriety']; ?></td>
			<td><?php echo $selHistory['last_modified_type']; ?></td>
			<td><?php echo $selHistory['rec_recruiter_id']; ?></td>
			<td><?php echo $selHistory['inf_staff_id']; ?></td>
			<td><?php echo $selHistory['created']; ?></td>
			<td><?php echo $selHistory['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'sel_histories', 'action' => 'view', $selHistory['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'sel_histories', 'action' => 'edit', $selHistory['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'sel_histories', 'action' => 'delete', $selHistory['id']), array(), __('Are you sure you want to delete # %s?', $selHistory['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Sel Recruiter Histories'); ?></h3>
	<?php if (!empty($selStatus['SelRecruiterHistory'])): ?>
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
	<?php foreach ($selStatus['SelRecruiterHistory'] as $selRecruiterHistory): ?>
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

</div>
