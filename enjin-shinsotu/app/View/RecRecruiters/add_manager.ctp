<?php
//tailored

//CSS
echo $this->Html->css('enjin/25_08_recruiters_details');

echo $this->element( 'back_nav', array('text' => __('採用担当者｜新規登録')) );?>

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
				<div class="col-lg-2">
					<div class="circle">
						<span>顔写真</span>
					</div>
				</div>
				<div class="col-lg-10">
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
						<label class="col-sm-4 control-label">所属会社</label>
						<div class="col-sm-8">
							<div class="">
								<div class="no-borders ver-mid btn-group btn-block">
								    <select name="rec_company_id" id="rec_company_id" 'class' => 'form-control'>
								    <?php foreach( $wRecCompany as $key => $val ): ?>
								        <option value="<?php echo $key ?>"><?php echo $val; ?></option>
								    <?php endforeach; ?>
								    </select>
								</div>
							</div>
						</div>
					</div>

					<div class="row form-group">
						<label class="col-sm-4 control-label">部署</label>
						<div class="col-sm-8">
							<div class="">
								<div class="no-borders ver-mid btn-group btn-block">
									<?php echo $this->Form->input('rec_department_id',
										array('label' => false, 'div' => false, 'class' => 'form-control','options'=>$listRecDepartment));?>
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
									array('type' => 'email', 'label' => false, 'div' => false, 'class' => 'form-control'))?>
							</div>
						</div>
					</div>
					<div class="row form-group">
						<label class="col-sm-4 control-label">パスワード</label>
						<div class="col-sm-8">
							<div>
								<?php
								echo $this->Form->input('password',
									array('label' => false, 'div' => false, 'class' => 'form-control'))?>
							</div>
						</div>
					</div>
					<div class="row form-group">
						<label class="col-sm-4 control-label">パスワード確認</label>
						<div class="col-sm-8">
							<div>
								<?php
								echo $this->Form->password('password1',
									array('label' => false, 'div' => false, 'class' => 'form-control'))?>
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
												'default' => 1
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

				</div> 
				<div class="col-lg-12">
					<div class="btn-clear">
						<?php
						echo $this->Html->link(__('キャンセル'), array('controller' => 'rec_recruiters', 'action' => 'index'), array('class'=>'text-navy'));
						?>
						<?php
						echo $this->Form->button(__('登録'), array('type' => 'submit', 'class' => 'btn btn-primary w-95'));?>
					</div>
				</div>
				<?php echo $this->Form->end(); ?>
			</div>    
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
    $('#rec_company_id').on( 'change', 
    
    function getRecDepartment(e){
    
        $.ajax( {
            type: "GET",
            url: "/RecDepartments/getDepartmentList/"+ $(e.target).val(),
            success: function ( data, status, xhr ){
                option = "";
                count = 0;
                $.each(data , function(k,v){
                    if ( count == 0 ){
                        option +='<option value="'+k+'" selected>'+v+'</option>';
                    }else{
                        option +='<option value="'+k+'">'+v+'</option>';
                    }
                    count++;
                });
                $("#RecRecruiterRecDepartmentId").html( option );
            }
        } );
    });
});

</script>
<?php echo $this->element('b_back_nav')?>
