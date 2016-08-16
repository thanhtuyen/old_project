<div class="mlAttachments index">
	<h2><?php echo __('Ml Attachments'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('mail_template_id'); ?></th>
			<th><?php echo $this->Paginator->sort('file_name'); ?></th>
			<th><?php echo $this->Paginator->sort('extension'); ?></th>
			<th><?php echo $this->Paginator->sort('binary_data'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($mlAttachments as $mlAttachment): ?>
	<tr>
		<td><?php echo h($mlAttachment['MlAttachment']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($mlAttachment['MailTemplate']['id'], array('controller' => 'mail_templates', 'action' => 'view', $mlAttachment['MailTemplate']['id'])); ?>
		</td>
		<td><?php echo h($mlAttachment['MlAttachment']['file_name']); ?>&nbsp;</td>
		<td><?php echo h($mlAttachment['MlAttachment']['extension']); ?>&nbsp;</td>
		<td><?php echo h($mlAttachment['MlAttachment']['binary_data']); ?>&nbsp;</td>
		<td><?php echo h($mlAttachment['MlAttachment']['status']); ?>&nbsp;</td>
		<td><?php echo h($mlAttachment['MlAttachment']['created']); ?>&nbsp;</td>
		<td><?php echo h($mlAttachment['MlAttachment']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $mlAttachment['MlAttachment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $mlAttachment['MlAttachment']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $mlAttachment['MlAttachment']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $mlAttachment['MlAttachment']['id']))); ?>
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
