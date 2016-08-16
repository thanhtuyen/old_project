<div class="recruitmentAreas form">
<?php echo $this->Form->create('RecruitmentArea'); ?>
	<fieldset>
		<legend><?php echo __('Add Recruitment Area'); ?></legend>
	<?php
		echo $this->Form->input('area');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
