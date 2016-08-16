<div class="evSchedules form">
<?php echo $this->Form->create('EvSchedule'); ?>
	<fieldset>
		<legend><?php echo __('Add Ev Schedule'); ?></legend>
	<?php
		echo $this->Form->input('ev_event_id');
		echo $this->Form->input('holding_date');
		echo $this->Form->input('end_date');
		echo $this->Form->input('individual_theme');
		echo $this->Form->input('capacity');
		echo $this->Form->input('wanted_deadline');
		echo $this->Form->input('venue');
		echo $this->Form->input('day_content');
		echo $this->Form->input('holding_cost');
		echo $this->Form->input('status', array( 'options' => $evStatus ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
