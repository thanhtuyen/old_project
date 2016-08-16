<div class="canLanguages form">
<?php echo $this->Form->create('CanLanguage'); ?>
	<fieldset>
		<legend><?php echo __('Add Can Language'); ?></legend>
	<?php
		echo $this->Form->input('can_candidate_id');
		echo $this->Form->input('foreign_language_id', array( 'options' => $addForeignLanguage ));
		echo $this->Form->input('foreign_language');
		echo $this->Form->input('level_id', array( 'options' => $addLevel ));
		echo $this->Form->input('oversea_life');
		echo $this->Form->input('status', array( 'options' => $selStatus ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
