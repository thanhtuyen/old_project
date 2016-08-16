<div class="purposes view">
<h2><?php echo __('Purpose'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($purpose['Purpose']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($purpose['Purpose']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($purpose['Purpose']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($purpose['Purpose']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($purpose['Purpose']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Related Mail Templates'); ?></h3>
	<?php if (!empty($purpose['MailTemplate'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Template'); ?></th>
		<th><?php echo __('Subject'); ?></th>
		<th><?php echo __('Body'); ?></th>
		<th><?php echo __('Ev Event Id'); ?></th>
		<th><?php echo __('Job Voke Id'); ?></th>
		<th><?php echo __('Screening Stage Id'); ?></th>
		<th><?php echo __('Purpose Id'); ?></th>
		<th><?php echo __('Rec Company Id'); ?></th>
		<th><?php echo __('Rec Recruiter Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($purpose['MailTemplate'] as $mailTemplate): ?>
		<tr>
			<td><?php echo $mailTemplate['id']; ?></td>
			<td><?php echo $mailTemplate['template']; ?></td>
			<td><?php echo $mailTemplate['subject']; ?></td>
			<td><?php echo $mailTemplate['body']; ?></td>
			<td><?php echo $mailTemplate['ev_event_id']; ?></td>
			<td><?php echo $mailTemplate['job_voke_id']; ?></td>
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
	<?php if (!empty($purpose['SystemMailTemplate'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Template'); ?></th>
		<th><?php echo __('Subject'); ?></th>
		<th><?php echo __('Body'); ?></th>
		<th><?php echo __('Ev Event Id'); ?></th>
		<th><?php echo __('Job Voke Id'); ?></th>
		<th><?php echo __('Screening Stage Id'); ?></th>
		<th><?php echo __('Purpose Id'); ?></th>
		<th><?php echo __('Rec Company Id'); ?></th>
		<th><?php echo __('Rec Recruiter Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($purpose['SystemMailTemplate'] as $systemMailTemplate): ?>
		<tr>
			<td><?php echo $systemMailTemplate['id']; ?></td>
			<td><?php echo $systemMailTemplate['template']; ?></td>
			<td><?php echo $systemMailTemplate['subject']; ?></td>
			<td><?php echo $systemMailTemplate['body']; ?></td>
			<td><?php echo $systemMailTemplate['ev_event_id']; ?></td>
			<td><?php echo $systemMailTemplate['job_voke_id']; ?></td>
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
