<div class="evEvents view">
<h2><?php echo __('Ev Event'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($evEvent['EvEvent']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($evEvent['EvEvent']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rec Company'); ?></dt>
		<dd>
			<?php echo $this->Html->link($evEvent['RecCompany']['company_name'], array('controller' => 'rec_companies', 'action' => 'view', $evEvent['RecCompany']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Job Vote'); ?></dt>
		<dd>
			<?php echo $this->Html->link($evEvent['JobVote']['title'], array('controller' => 'job_votes', 'action' => 'view', $evEvent['JobVote']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($type[$evEvent['EvEvent']['type']]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Screening Stage'); ?></dt>
		<dd>
			<?php echo $this->Html->link($evEvent['ScreeningStage']['name'], array('controller' => 'screening_stages', 'action' => 'view', $evEvent['ScreeningStage']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Screening Stage Type'); ?></dt>
		<dd>
			<?php echo h($screeningStageType[$evEvent['EvEvent']['screening_stage_type']]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Target Select Id'); ?></dt>
		<dd>
			<?php echo h($selectJudgmentType[$evEvent['EvEvent']['target_select_id']]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contents'); ?></dt>
		<dd>
			<?php echo h($evEvent['EvEvent']['contents']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rikunavi Id'); ?></dt>
		<dd>
			<?php echo h($evEvent['EvEvent']['rikunavi_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mynavi Id'); ?></dt>
		<dd>
			<?php echo h($evEvent['EvEvent']['mynavi_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($evStatus[$evEvent['EvEvent']['status']]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($evEvent['EvEvent']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($evEvent['EvEvent']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Related Ev Personnels'); ?></h3>
	<?php if (!empty($evEvent['EvPersonnel'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Ev Event Id'); ?></th>
		<th><?php echo __('Rec Recruiter Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($evEvent['EvPersonnel'] as $evPersonnel): ?>
		<tr>
			<td><?php echo $evPersonnel['id']; ?></td>
			<td><?php echo $evPersonnel['ev_event_id']; ?></td>
			<td><?php echo $evPersonnel['rec_recruiter_id']; ?></td>
			<td><?php echo $evPersonnel['status']; ?></td>
			<td><?php echo $evPersonnel['created']; ?></td>
			<td><?php echo $evPersonnel['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'ev_personnels', 'action' => 'view', $evPersonnel['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'ev_personnels', 'action' => 'edit', $evPersonnel['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'ev_personnels', 'action' => 'delete', $evPersonnel['id']), array(), __('Are you sure you want to delete # %s?', $evPersonnel['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Ev Schedules'); ?></h3>
	<?php if (!empty($evEvent['EvSchedule'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Ev Event Id'); ?></th>
		<th><?php echo __('Holding Date'); ?></th>
		<th><?php echo __('End Date'); ?></th>
		<th><?php echo __('Individual Theme'); ?></th>
		<th><?php echo __('Capacity'); ?></th>
		<th><?php echo __('Wanted Deadline'); ?></th>
		<th><?php echo __('Venue'); ?></th>
		<th><?php echo __('Day Content'); ?></th>
		<th><?php echo __('Holding Cost'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($evEvent['EvSchedule'] as $evSchedule): ?>
		<tr>
			<td><?php echo $evSchedule['id']; ?></td>
			<td><?php echo $evSchedule['ev_event_id']; ?></td>
			<td><?php echo $evSchedule['holding_date']; ?></td>
			<td><?php echo $evSchedule['end_date']; ?></td>
			<td><?php echo $evSchedule['individual_theme']; ?></td>
			<td><?php echo $evSchedule['capacity']; ?></td>
			<td><?php echo $evSchedule['wanted_deadline']; ?></td>
			<td><?php echo $evSchedule['venue']; ?></td>
			<td><?php echo $evSchedule['day_content']; ?></td>
			<td><?php echo $evSchedule['holding_cost']; ?></td>
			<td><?php echo $evSchedule['status']; ?></td>
			<td><?php echo $evSchedule['created']; ?></td>
			<td><?php echo $evSchedule['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'ev_schedules', 'action' => 'view', $evSchedule['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'ev_schedules', 'action' => 'edit', $evSchedule['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'ev_schedules', 'action' => 'delete', $evSchedule['id']), array(), __('Are you sure you want to delete # %s?', $evSchedule['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Mail Templates'); ?></h3>
	<?php if (!empty($evEvent['MailTemplate'])): ?>
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
	<?php foreach ($evEvent['MailTemplate'] as $mailTemplate): ?>
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
	<h3><?php echo __('Related System Mail Templates'); ?></h3>
	<?php if (!empty($evEvent['SystemMailTemplate'])): ?>
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
	<?php foreach ($evEvent['SystemMailTemplate'] as $systemMailTemplate): ?>
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
