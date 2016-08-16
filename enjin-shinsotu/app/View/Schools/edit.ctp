<?php echo $this->element('back_nav', array('text' => '学校マスタ編集'))?>
<div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">
	<!-- content -->

	<div class='full-content'>
		<div class='col-lg-8'>
			<div class='ibox'>

				<div class="ibox-title">
					<h5><?php echo h($this->request->data['School']['name']); ?></h5>
				</div>
				<div class='ibox-content bg-white p-sm'>
					
					<?php echo $this->Form->create('School', array('type'=>'post', 'class'=>'form-horizontal form-edit')); ?>

					<div class="form-group"><label class="col-sm-4 control-label">学校名</label>
						<div class="col-sm-8">
							<?php echo $this->Form->input('name', array('label'=>false, 'class'=>'form-control')); ?>
						</div>
					</div>

					<div class="form-group"><label class="col-sm-4 control-label">学校区分</label>
						<div class="col-sm-8">
							<?php echo $this->Form->input('school_class_id', array('options' => $schoolClass, 'class'=>'form-control', 'label'=>false)); ?>
						</div>
					</div>


					<div class="form-group"><label class="col-sm-4 control-label">国公立区立区分</label>
						<div class="col-sm-8">
							<?php echo $this->Form->input('public_private_class_id', array('options' => $publicPrivateClass, 'class'=>'form-control', 'label'=>false )); ?>
						</div>
					</div>

					<div class="form-group"><label class="col-sm-4 control-label">学校ランク</label>
						<div class="col-sm-8">
							<?php echo $this->Form->input('school_rank', array( 'options' => $schoolRank, 'class'=>'form-control', 'label'=>false )); ?>
						</div>
					</div>

					<div class="form-group"><label class="col-sm-4 control-label">国</label>
						<div class="col-sm-8">
							<?php echo $this->Form->input('country_id', array('class'=>'form-control', 'label'=>false )); ?>
						</div>
					</div>

					<div class="form-group"><label class="col-sm-4 control-label">都道府県</label>
						<div class="col-sm-8">
							<?php echo $this->Form->input('prefecture_id', array('class'=>'form-control', 'label'=>false )); ?> 
						</div>
					</div>     

					<div class="form-group"><label class="col-sm-4 control-label">採用担当者</label>
						<div class="col-sm-8">
							<?php echo $this->Form->input('rec_recruiter_id', array('class'=>'form-control', 'label'=>false )); ?>
						</div>
					</div>     

					<div class='button_cen element-detail-box '>
						<?php echo $this->Form->submit(__('登録'),array(
						'class'=>'btn btn-primary btn-sm',
						'div'=>false
						));?>
					</div>

					<?php $this->Form->end();?>

				</div>
			</div>
		</div>
	</div>
</div>

