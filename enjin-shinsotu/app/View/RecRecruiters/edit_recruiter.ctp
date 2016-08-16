<?php
//tailored
$recRecruiter = $recRecruiter['RecRecruiter'];

//CSS
echo $this->Html->css('enjin/25_08_recruiters_details');

//default image
if(empty($recRecruiter['face_photo']))
  $recRecruiter['face_photo'] = $this->webroot. 'img/bootstrap/icon_avatar.png';

echo $this->element( 'back_nav',	array('text' => __('採用担当者詳細｜%d %s', $recRecruiter['id'], $recRecruiter['name'])) );
?>

<div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">
	<div class="col-lg-8">
		<div class="ibox">
			<div class="ibox-title">
				<h5>採用担当者情報</h5>
			</div>

			<div class="ibox-content bg-white p-sm clearfix show-fr-input">
				<?php echo $this->Form->create('RecRecruiter', array(
						'type' => 'post',
						'class' => 'form-horizontal form-edit')); ?>
				<div class="col-lg-2 m-t-lg">
            <?php echo $this->Html->image($recRecruiter['face_photo'], array('class' => 'img-reponsive center-block', 'alt' => __('顔写真'), 'width' => '100%'))?>
          </div>
				<div class="col-lg-10">

					<div class="row form-group">
						<label class="col-sm-4 control-label">採用担当者ID</label>
						<div class="col-sm-8">
							<div class="form-control border-none"><?php echo $recRecruiter['id']?></div>
							<?php echo $this->Form->input('id');?>
						</div>
					</div>
					<div class="row form-group">
						<label class="col-sm-4 control-label">氏</label><?php
						//氏／夫人?>
						<div class="col-sm-8">
							<div class="">
								<?php echo $this->Form->input('last_name',
									array('label' => false, 'div' => false, 'class' => 'form-control'))?>
							</div>
						</div>
					</div>
					<div class="row form-group">
						<label class="col-sm-4 control-label">名</label>
						<div class="col-sm-8">
							<div class="">
								<?php
								echo $this->Form->input('first_name',
									array('label' => false, 'div' => false, 'class' => 'form-control'))?>
							</div>
						</div>
					</div>
					<div class="row form-group">
						<label class="col-sm-4 control-label">部署</label>
						<div class="col-sm-8">
							<div class="">
								<div class="no-borders ver-mid btn-group btn-block">
									<?php echo $this->Form->input('rec_department_id',
										array('label' => false, 'div' => false, 'class' => 'form-control'));?>
								</div>
							</div>
						</div>
					</div>
					<div class="row form-group">
						<label class="col-sm-4 control-label">採用者タイプ</label>
						<div class="col-sm-8">
							<div class="">
								<div class="no-borders ver-mid btn-group btn-block">
									<?php
									echo $this->Form->input('focal_point_type',
										array( 'options' => $focalPointType, 'label' => false, 'div' => false, 'class' => 'form-control' ));
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="row form-group">
						<label class="col-sm-4 control-label">メール</label>
						<div class="col-sm-8">
							<div class="">
								<?php
								echo $this->Form->input('mail',
									array('label' => false, 'div' => false, 'class' => 'form-control'))?>
							</div>
						</div>
					</div>
					<div class="row form-group">
						<label class="col-sm-4 control-label">パスワード</label>
						<div class="col-sm-8">
							<div class="form-control border-none">
								............
								<div class="pull-right hover-button">
									<?php
									echo $this->Html->link(__('変更'),
										array('controller' => 'rec_recruiters', 'action' => 'password', $recRecruiter['id']),
										array('class' => 'btn btn-primary btn-xs'))?><?php //変更?>
								</div>
							</div>
						</div>
					</div>
					<div class="row form-group">
						<label class="col-sm-4 control-label">電話</label>
						<div class="col-sm-8">
							<div class="">
								<?php
								echo $this->Form->input('tel',
									array('label' => false, 'div' => false, 'class' => 'form-control'))?>
							</div>
						</div>
					</div>
					<div class="row form-group">
						<label class="col-sm-4 control-label">決裁者フラグ</label>
						<div class="col-sm-8">
							<div class="form-control border-none">
								<div class="switch">
									<div class="onoffswitch">
										<?php echo $this->Form->checkbox('approval_flag',
											array(
												'hiddenField' => false,
												'class' => 'onoffswitch-checkbox',
												'id' => 'cb1',
												'checked' => $status[$recRecruiter['approval_flag']]
											))?>
										<label class="onoffswitch-label" for="cb1">
											<span class="onoffswitch-inner"></span>
											<span class="onoffswitch-switch"></span>
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row form-group">
						<label class="col-sm-4 control-label">最終ログイン</label>
						<div class="col-sm-8">
							<div class="form-control border-none">
								<?php echo $recRecruiter['last_login_date']?>
							</div>
						</div>
					</div>                      


				</div> 
				<div class="col-lg-12">
					<div class="txt-align btn-clear">
						<?php
						echo $this->Html->link(__('キャンセル'), array('controller' => 'rec_recruiters', 'action' => 'view/'.$recRecruiter['id']), array('class' => 'text-navy'));
						?>
						<?php
						echo $this->Form->button(__('変更'), array('type' => 'submit', 'class' => 'btn btn-primary w-95'));?>
					</div>
				</div>
				<?php echo $this->Form->end(); ?>
			</div>    
		</div>
	</div>
</div>

<?php echo $this->element('b_back_nav')?>
<?php
 
return;
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
