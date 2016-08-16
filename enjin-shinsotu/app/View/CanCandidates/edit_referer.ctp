<div class="canCandidates form">
<?php echo $this->Form->create('CanCandidate'); ?>
	<fieldset>
		<legend><?php echo __('Edit Can Candidate'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('last_name');
		echo $this->Form->input('last_name_kana');
		echo $this->Form->input('last_name_en');
		echo $this->Form->input('mid_name');
		echo $this->Form->input('mid_name_en');
		echo $this->Form->input('first_name');
		echo $this->Form->input('first_name_kana');
		echo $this->Form->input('first_name_en');
		echo $this->Form->input('face_photo');
		echo $this->Form->input('mail_address');
		echo $this->Form->input('unique_id',array('type' => 'text','required' => false,));
		echo $this->Form->input('tel');
		echo $this->Form->input('extension_number');
		echo $this->Form->input('direct_extension');
		echo $this->Form->input('cell_number');
		echo $this->Form->input('cell_mail');
		echo $this->Form->input('country_id');
		echo $this->Form->input('post_code');
		echo $this->Form->input('prefecture_id');
		echo $this->Form->input('residence');
		echo $this->Form->input('home_country_id');
		echo $this->Form->input('home_post_code');
		echo $this->Form->input('home_prefecture_id');
		echo $this->Form->input('home_residence');
		echo $this->Form->input('home_tel');
		echo $this->Form->input('birthday');
		echo $this->Form->input('sex', array( 'options' => $sex ));
		echo $this->Form->input('membership');
		echo $this->Form->input('referer_company_id');
		echo $this->Form->input('inf_contract_id',array('empty' => ''));
		echo $this->Form->input('join_possible_date');
		echo $this->Form->input('mynavi_id',array('type' => 'text'));
		echo $this->Form->input('rikunavi_id',array('type' => 'text'));
		echo $this->Form->input('bar_code_id',array('type' => 'text'));
		echo $this->Form->input('remark');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
