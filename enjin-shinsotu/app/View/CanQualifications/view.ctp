<div class="canQualifications view">
<h2><?php echo __('Can Qualification'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($canQualification['CanQualification']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Can Candidate'); ?></dt>
		<dd>
			<?php echo $this->Html->link($canQualification['CanCandidate']['name'], array('controller' => 'can_candidates', 'action' => 'view', $canQualification['CanCandidate']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Qualification'); ?></dt>
		<dd>
			<?php echo h($qualifications[$canQualification['CanQualification']['qualification_id']]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Qualification'); ?></dt>
		<dd>
			<?php echo h($canQualification['CanQualification']['qualification']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Score'); ?></dt>
		<dd>
			<?php echo h($canQualification['CanQualification']['score']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Acquisition Date'); ?></dt>
		<dd>
			<?php echo h($canQualification['CanQualification']['acquisition_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($selStatus[$canQualification['CanQualification']['status']]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($canQualification['CanQualification']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($canQualification['CanQualification']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
