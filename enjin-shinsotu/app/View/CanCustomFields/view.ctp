<div class="canCustomFields view">
<h2><?php echo __('Can Custom Field'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($canCustomField['CanCustomField']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($canCustomField['CanCustomField']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($canCustomField['CanCustomField']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Field Name'); ?></dt>
		<dd>
			<?php echo h($canCustomField['CanCustomField']['field_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rec Company'); ?></dt>
		<dd>
			<?php echo $this->Html->link($canCustomField['RecCompany']['company_name'], array('controller' => 'rec_companies', 'action' => 'view', $canCustomField['RecCompany']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rec Recruiter'); ?></dt>
		<dd>
			<?php echo $this->Html->link($canCustomField['RecRecruiter']['name'], array('controller' => 'rec_recruiters', 'action' => 'view', $canCustomField['RecRecruiter']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($canCustomField['CanCustomField']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($canCustomField['CanCustomField']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Related Can Custom Attributes'); ?></h3>
	<?php if (!empty($canCustomField['CanCustomAttribute'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Can Candidate Id'); ?></th>
		<th><?php echo __('Can Custom Field Id'); ?></th>
		<th><?php echo __('Value'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Rec Recruiter Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($canCustomField['CanCustomAttribute'] as $canCustomAttribute): ?>
		<tr>
			<td><?php echo $canCustomAttribute['id']; ?></td>
			<td><?php echo $canCustomAttribute['can_candidate_id']; ?></td>
			<td><?php echo $canCustomAttribute['can_custom_field_id']; ?></td>
			<td><?php echo $canCustomAttribute['value']; ?></td>
			<td><?php echo $canCustomAttribute['status']; ?></td>
			<td><?php echo $canCustomAttribute['rec_recruiter_id']; ?></td>
			<td><?php echo $canCustomAttribute['created']; ?></td>
			<td><?php echo $canCustomAttribute['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'can_custom_attributes', 'action' => 'view', $canCustomAttribute['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'can_custom_attributes', 'action' => 'edit', $canCustomAttribute['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'can_custom_attributes', 'action' => 'delete', $canCustomAttribute['id']), array(), __('Are you sure you want to delete # %s?', $canCustomAttribute['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
