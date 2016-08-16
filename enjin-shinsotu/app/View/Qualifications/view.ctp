<div class="qualifications view">
<h2><?php echo __('Qualification'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($qualification['Qualification']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($qualification['Qualification']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($qualification['Qualification']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($qualification['Qualification']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($qualification['Qualification']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Related Can Qualifications'); ?></h3>
	<?php if (!empty($qualification['CanQualification'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Can Candidate Id'); ?></th>
		<th><?php echo __('Qualification Id'); ?></th>
		<th><?php echo __('Qualification'); ?></th>
		<th><?php echo __('Score'); ?></th>
		<th><?php echo __('Acquisition Date'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($qualification['CanQualification'] as $canQualification): ?>
		<tr>
			<td><?php echo $canQualification['id']; ?></td>
			<td><?php echo $canQualification['can_candidate_id']; ?></td>
			<td><?php echo $canQualification['qualification_id']; ?></td>
			<td><?php echo $canQualification['qualification']; ?></td>
			<td><?php echo $canQualification['score']; ?></td>
			<td><?php echo $canQualification['acquisition_date']; ?></td>
			<td><?php echo $canQualification['status']; ?></td>
			<td><?php echo $canQualification['created']; ?></td>
			<td><?php echo $canQualification['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'can_qualifications', 'action' => 'view', $canQualification['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'can_qualifications', 'action' => 'edit', $canQualification['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'can_qualifications', 'action' => 'delete', $canQualification['id']), array(), __('Are you sure you want to delete # %s?', $canQualification['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
