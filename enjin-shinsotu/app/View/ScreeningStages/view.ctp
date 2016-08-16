<div class="screeningStages view">
<h2><?php echo __('Screening Stage'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($screeningStage['ScreeningStage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($screeningStage['ScreeningStage']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order'); ?></dt>
		<dd>
			<?php echo h($screeningStage['ScreeningStage']['order']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Select Flag'); ?></dt>
		<dd>
			<?php echo h($screeningStage['ScreeningStage']['last_select_flag']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Select Overview'); ?></dt>
		<dd>
			<?php echo h($screeningStage['ScreeningStage']['select_overview']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rec Company'); ?></dt>
		<dd>
			<?php echo $this->Html->link($screeningStage['RecCompany']['id'], array('controller' => 'rec_companies', 'action' => 'view', $screeningStage['RecCompany']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rec Recruiter'); ?></dt>
		<dd>
			<?php echo $this->Html->link($screeningStage['RecRecruiter']['id'], array('controller' => 'rec_recruiters', 'action' => 'view', $screeningStage['RecRecruiter']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($screeningStage['ScreeningStage']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($screeningStage['ScreeningStage']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($screeningStage['ScreeningStage']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Related Ev Events'); ?></h3>
	<?php if (!empty($screeningStage['EvEvent'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Rec Company Id'); ?></th>
		<th><?php echo __('Job Vote Id'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Screening Stage Id'); ?></th>
		<th><?php echo __('Screening Stage Type'); ?></th>
		<th><?php echo __('Target Select Id'); ?></th>
		<th><?php echo __('Contents'); ?></th>
		<th><?php echo __('Rikunavi Id'); ?></th>
		<th><?php echo __('Mynavi Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($screeningStage['EvEvent'] as $evEvent): ?>
		<tr>
			<td><?php echo $evEvent['id']; ?></td>
			<td><?php echo $evEvent['name']; ?></td>
			<td><?php echo $evEvent['rec_company_id']; ?></td>
			<td><?php echo $evEvent['job_vote_id']; ?></td>
			<td><?php echo $evEvent['type']; ?></td>
			<td><?php echo $evEvent['screening_stage_id']; ?></td>
			<td><?php echo $evEvent['screening_stage_type']; ?></td>
			<td><?php echo $evEvent['target_select_id']; ?></td>
			<td><?php echo $evEvent['contents']; ?></td>
			<td><?php echo $evEvent['rikunavi_id']; ?></td>
			<td><?php echo $evEvent['mynavi_id']; ?></td>
			<td><?php echo $evEvent['status']; ?></td>
			<td><?php echo $evEvent['created']; ?></td>
			<td><?php echo $evEvent['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'ev_events', 'action' => 'view', $evEvent['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'ev_events', 'action' => 'edit', $evEvent['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'ev_events', 'action' => 'delete', $evEvent['id']), array(), __('Are you sure you want to delete # %s?', $evEvent['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Job Select Targets'); ?></h3>
	<?php if (!empty($screeningStage['JobSelectTarget'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Job Vote Id'); ?></th>
		<th><?php echo __('Attain Deadline Date'); ?></th>
		<th><?php echo __('Screening Stage Id'); ?></th>
		<th><?php echo __('Target Select Id'); ?></th>
		<th><?php echo __('Select Judgment Type'); ?></th>
		<th><?php echo __('Target Number'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Rec Recruiter Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($screeningStage['JobSelectTarget'] as $jobSelectTarget): ?>
		<tr>
			<td><?php echo $jobSelectTarget['id']; ?></td>
			<td><?php echo $jobSelectTarget['job_vote_id']; ?></td>
			<td><?php echo $jobSelectTarget['attain_deadline_date']; ?></td>
			<td><?php echo $jobSelectTarget['screening_stage_id']; ?></td>
			<td><?php echo $jobSelectTarget['target_select_id']; ?></td>
			<td><?php echo $jobSelectTarget['select_judgment_type']; ?></td>
			<td><?php echo $jobSelectTarget['target_number']; ?></td>
			<td><?php echo $jobSelectTarget['status']; ?></td>
			<td><?php echo $jobSelectTarget['rec_recruiter_id']; ?></td>
			<td><?php echo $jobSelectTarget['created']; ?></td>
			<td><?php echo $jobSelectTarget['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'job_select_targets', 'action' => 'view', $jobSelectTarget['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'job_select_targets', 'action' => 'edit', $jobSelectTarget['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'job_select_targets', 'action' => 'delete', $jobSelectTarget['id']), array(), __('Are you sure you want to delete # %s?', $jobSelectTarget['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Mail Templates'); ?></h3>
	<?php if (!empty($screeningStage['MailTemplate'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Template'); ?></th>
		<th><?php echo __('Subject'); ?></th>
		<th><?php echo __('Body'); ?></th>
		<th><?php echo __('Ev Event Id'); ?></th>
		<th><?php echo __('Job Vote Id'); ?></th>
		<th><?php echo __('Screening Stage Id'); ?></th>
		<th><?php echo __('Purpose Id'); ?></th>
		<th><?php echo __('Rec Company Id'); ?></th>
		<th><?php echo __('Rec Recruiter Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($screeningStage['MailTemplate'] as $mailTemplate): ?>
		<tr>
			<td><?php echo $mailTemplate['id']; ?></td>
			<td><?php echo $mailTemplate['template']; ?></td>
			<td><?php echo $mailTemplate['subject']; ?></td>
			<td><?php echo $mailTemplate['body']; ?></td>
			<td><?php echo $mailTemplate['ev_event_id']; ?></td>
			<td><?php echo $mailTemplate['job_vote_id']; ?></td>
			<td><?php echo $mailTemplate['screening_stage_id']; ?></td>
			<td><?php echo $mailTemplate['purpose_id']; ?></td>
			<td><?php echo $mailTemplate['rec_company_id']; ?></td>
			<td><?php echo $mailTemplate['rec_recruiter_id']; ?></td>
			<td><?php echo $mailTemplate['status']; ?></td>
			<td><?php echo $mailTemplate['created']; ?></td>
			<td><?php echo $mailTemplate['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'mail_templates', 'action' => 'view', $mailTemplate['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'mail_templates', 'action' => 'edit', $mailTemplate['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'mail_templates', 'action' => 'delete', $mailTemplate['id']), array(), __('Are you sure you want to delete # %s?', $mailTemplate['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Sel Histories'); ?></h3>
	<?php if (!empty($screeningStage['SelHistory'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
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
	<?php foreach ($screeningStage['SelHistory'] as $selHistory): ?>
		<tr>
			<td><?php echo $selHistory['id']; ?></td>
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
	<h3><?php echo __('Related System Mail Templates'); ?></h3>
	<?php if (!empty($screeningStage['SystemMailTemplate'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Template'); ?></th>
		<th><?php echo __('Subject'); ?></th>
		<th><?php echo __('Body'); ?></th>
		<th><?php echo __('Ev Event Id'); ?></th>
		<th><?php echo __('Job Vote Id'); ?></th>
		<th><?php echo __('Screening Stage Id'); ?></th>
		<th><?php echo __('Purpose Id'); ?></th>
		<th><?php echo __('Rec Company Id'); ?></th>
		<th><?php echo __('Rec Recruiter Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($screeningStage['SystemMailTemplate'] as $systemMailTemplate): ?>
		<tr>
			<td><?php echo $systemMailTemplate['id']; ?></td>
			<td><?php echo $systemMailTemplate['template']; ?></td>
			<td><?php echo $systemMailTemplate['subject']; ?></td>
			<td><?php echo $systemMailTemplate['body']; ?></td>
			<td><?php echo $systemMailTemplate['ev_event_id']; ?></td>
			<td><?php echo $systemMailTemplate['job_vote_id']; ?></td>
			<td><?php echo $systemMailTemplate['screening_stage_id']; ?></td>
			<td><?php echo $systemMailTemplate['purpose_id']; ?></td>
			<td><?php echo $systemMailTemplate['rec_company_id']; ?></td>
			<td><?php echo $systemMailTemplate['rec_recruiter_id']; ?></td>
			<td><?php echo $systemMailTemplate['status']; ?></td>
			<td><?php echo $systemMailTemplate['created']; ?></td>
			<td><?php echo $systemMailTemplate['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'system_mail_templates', 'action' => 'view', $systemMailTemplate['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'system_mail_templates', 'action' => 'edit', $systemMailTemplate['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'system_mail_templates', 'action' => 'delete', $systemMailTemplate['id']), array(), __('Are you sure you want to delete # %s?', $systemMailTemplate['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
