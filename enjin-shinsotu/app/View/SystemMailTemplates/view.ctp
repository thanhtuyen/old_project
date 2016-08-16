<div class="systemMailTemplates view">
<h2><?php echo __('System Mail Template'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($systemMailTemplate['SystemMailTemplate']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Template'); ?></dt>
		<dd>
			<?php echo h($systemMailTemplate['SystemMailTemplate']['template']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subject'); ?></dt>
		<dd>
			<?php echo h($systemMailTemplate['SystemMailTemplate']['subject']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Body'); ?></dt>
		<dd>
			<?php echo h($systemMailTemplate['SystemMailTemplate']['body']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ev Event'); ?></dt>
		<dd>
			<?php echo $this->Html->link($systemMailTemplate['EvEvent']['name'], array('controller' => 'ev_events', 'action' => 'view', $systemMailTemplate['EvEvent']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Job Vote'); ?></dt>
		<dd>
			<?php echo $this->Html->link($systemMailTemplate['JobVote']['title'], array('controller' => 'job_votes', 'action' => 'view', $systemMailTemplate['JobVote']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Screening Stage'); ?></dt>
		<dd>
			<?php echo $this->Html->link($systemMailTemplate['ScreeningStage']['name'], array('controller' => 'screening_stages', 'action' => 'view', $systemMailTemplate['ScreeningStage']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Purpose'); ?></dt>
		<dd>
			<?php echo h($purpose[$systemMailTemplate['SystemMailTemplate']['purpose_id']]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rec Company'); ?></dt>
		<dd>
			<?php echo $this->Html->link($systemMailTemplate['RecCompany']['company_name'], array('controller' => 'rec_companies', 'action' => 'view', $systemMailTemplate['RecCompany']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rec Recruiter'); ?></dt>
		<dd>
			<?php echo $this->Html->link($systemMailTemplate['RecRecruiter']['name'], array('controller' => 'rec_recruiters', 'action' => 'view', $systemMailTemplate['RecRecruiter']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($selStatus[$systemMailTemplate['SystemMailTemplate']['status']]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($systemMailTemplate['SystemMailTemplate']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($systemMailTemplate['SystemMailTemplate']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Related Ml Send Histories'); ?></h3>
	<?php if (!empty($systemMailTemplate['MlSendHistory'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Send Mail Address'); ?></th>
		<th><?php echo __('Can Candidate Id'); ?></th>
		<th><?php echo __('Inf Staff Id'); ?></th>
		<th><?php echo __('Rec Recruiter Id'); ?></th>
		<th><?php echo __('Mail Template Id'); ?></th>
		<th><?php echo __('System Mail Template Id'); ?></th>
		<th><?php echo __('Send Recruiter Id'); ?></th>
		<th><?php echo __('Send Result'); ?></th>
		<th><?php echo __('Send Date'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($systemMailTemplate['MlSendHistory'] as $mlSendHistory): ?>
		<tr>
			<td><?php echo $mlSendHistory['id']; ?></td>
			<td><?php echo $mlSendHistory['send_mail_address']; ?></td>
			<td><?php echo $mlSendHistory['can_candidate_id']; ?></td>
			<td><?php echo $mlSendHistory['inf_staff_id']; ?></td>
			<td><?php echo $mlSendHistory['rec_recruiter_id']; ?></td>
			<td><?php echo $mlSendHistory['mail_template_id']; ?></td>
			<td><?php echo $mlSendHistory['system_mail_template_id']; ?></td>
			<td><?php echo $mlSendHistory['send_recruiter_id']; ?></td>
			<td><?php echo $mlSendHistory['send_result']; ?></td>
			<td><?php echo $mlSendHistory['send_date']; ?></td>
			<td><?php echo $mlSendHistory['created']; ?></td>
			<td><?php echo $mlSendHistory['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'ml_send_histories', 'action' => 'view', $mlSendHistory['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'ml_send_histories', 'action' => 'edit', $mlSendHistory['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'ml_send_histories', 'action' => 'delete', $mlSendHistory['id']), array(), __('Are you sure you want to delete # %s?', $mlSendHistory['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
