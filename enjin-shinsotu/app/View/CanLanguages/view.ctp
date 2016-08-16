<div class="canLanguages view">
<h2><?php echo __('Can Language'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($canLanguage['CanLanguage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Can Candidate'); ?></dt>
		<dd>
			<?php echo $this->Html->link($canLanguage['CanCandidate']['name'], array('controller' => 'can_candidates', 'action' => 'view', $canLanguage['CanCandidate']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Foreign Language'); ?></dt>
		<dd>
			<?php echo h($addForeignLanguage[$canLanguage['CanLanguage']['foreign_language_id']]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Foreign Language'); ?></dt>
		<dd>
			<?php echo h($canLanguage['CanLanguage']['foreign_language']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Level'); ?></dt>
		<dd>
			<?php echo h($addLevel[$canLanguage['CanLanguage']['level_id']]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Oversea Life'); ?></dt>
		<dd>
			<?php echo h($canLanguage['CanLanguage']['oversea_life']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($canLanguage['CanLanguage']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($canLanguage['CanLanguage']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($canLanguage['CanLanguage']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
