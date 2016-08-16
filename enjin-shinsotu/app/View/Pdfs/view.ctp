<div class="canEducations view">
<h2><?php echo __('Can Education'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($canEducation['CanEducation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Can Candidate'); ?></dt>
		<dd>
			<?php echo $this->Html->link($canEducation['CanCandidate']['id'], array('controller' => 'can_candidates', 'action' => 'view', $canEducation['CanCandidate']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('School'); ?></dt>
		<dd>
			<?php echo $this->Html->link($canEducation['School']['name'], array('controller' => 'schools', 'action' => 'view', $canEducation['School']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('School'); ?></dt>
		<dd>
			<?php echo h($canEducation['CanEducation']['school']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Undergraduate'); ?></dt>
		<dd>
			<?php echo $this->Html->link($canEducation['Undergraduate']['name'], array('controller' => 'undergraduates', 'action' => 'view', $canEducation['Undergraduate']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Undergraduate'); ?></dt>
		<dd>
			<?php echo h($canEducation['CanEducation']['undergraduate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Department'); ?></dt>
		<dd>
			<?php echo h($canEducation['CanEducation']['department']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Student Bunri Class'); ?></dt>
		<dd>
			<?php echo h($bunriClass[$canEducation['CanEducation']['student_bunri_class_id']]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Manage Bunri Class'); ?></dt>
		<dd>
			<?php echo h($bunriClass[$canEducation['CanEducation']['manage_bunri_class_id']]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Seminar'); ?></dt>
		<dd>
			<?php echo h($canEducation['CanEducation']['seminar']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Major Theme'); ?></dt>
		<dd>
			<?php echo h($canEducation['CanEducation']['major_theme']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Circle'); ?></dt>
		<dd>
			<?php echo h($canEducation['CanEducation']['circle']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Admission Date'); ?></dt>
		<dd>
			<?php echo h($canEducation['CanEducation']['admission_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Graduation Date'); ?></dt>
		<dd>
			<?php echo h($canEducation['CanEducation']['graduation_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($canEducation['CanEducation']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($canEducation['CanEducation']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
