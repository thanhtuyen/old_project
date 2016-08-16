<div class="foreignLanguages view">
<h2><?php echo __('Foreign Language'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($foreignLanguage['ForeignLanguage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($foreignLanguage['ForeignLanguage']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($foreignLanguage['ForeignLanguage']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($foreignLanguage['ForeignLanguage']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($foreignLanguage['ForeignLanguage']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Related Can Languages'); ?></h3>
	<?php if (!empty($foreignLanguage['CanLanguage'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Can Candidate Id'); ?></th>
		<th><?php echo __('Foreign Language Id'); ?></th>
		<th><?php echo __('Foreign Language'); ?></th>
		<th><?php echo __('Level Id'); ?></th>
		<th><?php echo __('Oversea Life'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($foreignLanguage['CanLanguage'] as $canLanguage): ?>
		<tr>
			<td><?php echo $canLanguage['id']; ?></td>
			<td><?php echo $canLanguage['can_candidate_id']; ?></td>
			<td><?php echo $canLanguage['foreign_language_id']; ?></td>
			<td><?php echo $canLanguage['foreign_language']; ?></td>
			<td><?php echo $canLanguage['level_id']; ?></td>
			<td><?php echo $canLanguage['oversea_life']; ?></td>
			<td><?php echo $canLanguage['status']; ?></td>
			<td><?php echo $canLanguage['created']; ?></td>
			<td><?php echo $canLanguage['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'can_languages', 'action' => 'view', $canLanguage['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'can_languages', 'action' => 'edit', $canLanguage['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'can_languages', 'action' => 'delete', $canLanguage['id']), array(), __('Are you sure you want to delete # %s?', $canLanguage['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
