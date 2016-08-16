<?php
//tailored
//*
$recRecruiter = $recRecruiter['RecRecruiter'];
//CSS
echo $this->Html->css('enjin/25_08_recruiters_details');

echo $this->element( 'back_nav', array('text' => __('採用担当者詳細｜%d %s', $recRecruiter['id'], $recRecruiter['name']), 'noBtn' => true) );?>

<div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">
	<div class="col-lg-8">
		<div class="ibox">
			<div class="ibox-title">
				<h5>パスワード変更</h5>
			</div>

			<div class="ibox-content bg-white p-sm clearfix fr-child">
				<div class="col-lg-12">
					<?php echo $this->Form->create('RecRecruiter', array(
							'type' => 'post',
							'class' => 'form-horizontal form-edit')); ?>
                    <?php echo $this->Form->input('id',array('type'=>'hidden', 'value'=>$recRecruiter['id'] ) ); ?>
					<div class="row form-group">
						<label class="col-sm-4 control-label">現在のパスワード</label>
						<div class="col-sm-8">
							<?php
							//input:現在のパスワード
							echo $this->Form->input('password', array('type' => 'password' ,'label' => false, 'div' => false, 'class' => 'form-control','default'=>'' ))?>
						</div>
					</div>
					<div class="row form-group">
						<label class="col-sm-4 control-label">新しいパスワード</label>
						<div class="col-sm-8">
							<div class="">
								<?php
								//input:新しいパスワード
								echo $this->Form->password('password1', array('type'=>'password', 'label' => false, 'div' => false, 'class' => 'form-control','default'=>''))?>
							</div>
						</div>
					</div>
					<div class="row form-group">
						<label class="col-sm-4 control-label">新しいパスワード（確認）</label>
						<div class="col-sm-8">
							<?php
							//input:新しいパスワード（確認）
							echo $this->Form->password('password2', array('type'=>'password','label' => false, 'div' => false, 'class' => 'form-control','default'=>''))?>
						</div>
					</div>

					<div class="tb-footer btn-clear">
						<?php
						echo $this->Html->link(__('キャンセル'), array('controller' => 'rec_recruiters', 'action' => 'edit/'.$recRecruiter['id']), array('class' => 'text-navy'));
						?><?php //キャンセル?>
						<?php
						echo $this->Form->button(__('変更'), array('type' => 'submit', 'class' => 'btn btn-primary w-95'));?><?php //変更?>
					</div>
					<?php echo $this->Form->end(); ?>
				</div>
			</div> 
		</div>
	</div>
</div>

<?php echo $this->element('b_back_nav')?>
<?php
return;
//*/
//original?>
<div class="recRecruiters form">
	<?php echo $this->Form->create('RecRecruiter'); ?>
	<fieldset>
		<legend><?php echo __('Edit Rec Recruiter'); ?></legend>
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('last_name');
		echo $this->Form->input('first_name');
		echo $this->Form->input('focal_point_type', array( 'options' => $focalPointType ));
		echo $this->Form->input('mail');
		echo $this->Form->input('password');
		echo $this->Form->input('rec_department_id');
		echo $this->Form->input('face_photo');
		echo $this->Form->input('tel');
		echo $this->Form->input('approval_flag');
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>
