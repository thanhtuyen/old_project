<div class="prefectures form">
<?php echo $this->Form->create('Prefecture'); ?>
	<fieldset>
		<legend><?php echo __('Edit Prefecture'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('iso_id');
		echo $this->Form->input('status', array( 'options' => $status ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
