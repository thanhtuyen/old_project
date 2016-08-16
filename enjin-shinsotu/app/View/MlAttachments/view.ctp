<div class="mlAttachments view">
<h2><?php echo __('Ml Attachment'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($mlAttachment['MlAttachment']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mail Template'); ?></dt>
		<dd>
			<?php echo $this->Html->link($mlAttachment['MailTemplate']['id'], array('controller' => 'mail_templates', 'action' => 'view', $mlAttachment['MailTemplate']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('File Name'); ?></dt>
		<dd>
			<?php echo h($mlAttachment['MlAttachment']['file_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Extension'); ?></dt>
		<dd>
			<?php echo h($mlAttachment['MlAttachment']['extension']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Binary Data'); ?></dt>
		<dd>
			<?php echo h($mlAttachment['MlAttachment']['binary_data']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($mlAttachment['MlAttachment']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($mlAttachment['MlAttachment']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($mlAttachment['MlAttachment']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
