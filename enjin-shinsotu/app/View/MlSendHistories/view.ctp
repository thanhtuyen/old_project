<div class="mlSendHistories view">
<h2><?php echo __('Ml Send History'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($mlSendHistory['MlSendHistory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Send Mail Address'); ?></dt>
		<dd>
			<?php echo h($mlSendHistory['MlSendHistory']['send_mail_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Can Candidate'); ?></dt>
		<dd>
			<?php echo $this->Html->link($mlSendHistory['CanCandidate']['id'], array('controller' => 'can_candidates', 'action' => 'view', $mlSendHistory['CanCandidate']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Inf Staff'); ?></dt>
		<dd>
			<?php echo $this->Html->link($mlSendHistory['InfStaff']['id'], array('controller' => 'inf_staffs', 'action' => 'view', $mlSendHistory['InfStaff']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rec Recruiter'); ?></dt>
		<dd>
			<?php echo $this->Html->link($mlSendHistory['RecRecruiter']['id'], array('controller' => 'rec_recruiters', 'action' => 'view', $mlSendHistory['RecRecruiter']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mail Template'); ?></dt>
		<dd>
			<?php echo $this->Html->link($mlSendHistory['MailTemplate']['id'], array('controller' => 'mail_templates', 'action' => 'view', $mlSendHistory['MailTemplate']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('System Mail Template'); ?></dt>
		<dd>
			<?php echo $this->Html->link($mlSendHistory['SystemMailTemplate']['id'], array('controller' => 'system_mail_templates', 'action' => 'view', $mlSendHistory['SystemMailTemplate']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Send Recruiter Id'); ?></dt>
		<dd>
			<?php echo h($mlSendHistory['MlSendHistory']['send_recruiter_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Send Result'); ?></dt>
		<dd>
			<?php echo h($mlSendHistory['MlSendHistory']['send_result']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Send Date'); ?></dt>
		<dd>
			<?php echo h($mlSendHistory['MlSendHistory']['send_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($mlSendHistory['MlSendHistory']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($mlSendHistory['MlSendHistory']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
