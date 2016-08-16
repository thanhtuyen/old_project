<style>.btn{color:#fff !important;text-decoration: none !important}</style>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>自社情報</h2>
	</div>
</div>
<div class="wrapper wrapper-content row animated fadeInRight clearfix">
	<div class='full-content'>

		<div class='col-lg-8'>

			<div class='ibox'>

				<?php if(!empty($RecCompany)): extract($RecCompany); ?>

					<div class="ibox-title">
						<h5>自社情報</h5>
						<div class="ibox-tools">
							<?php echo $this->Html->link(__('編集'), array('controller'=>'RecCompanies','action' => 'edit', $RecCompany['id']),array('class'=>'btn btn-primary btn-xs')); ?>                               
						</div>
					</div>
					<div class='ibox-content bg-white p-sm'>

						<form method="get" class="form-horizontal">
							<div class="form-group"><label class="col-sm-4 control-label">ユーザー企業ID</label>
								<div class="col-sm-8">
									<div class="form-control border-none"><?php echo $RecCompany['id'] ?></div>
								</div>
							</div>
							<div class="form-group"><label class="col-sm-4 control-label">企業名</label>
								<div class="col-sm-8">
									<div class="form-control border-none"><?php echo $RecCompany['company_name'] ?></div>
								</div>
							</div>
							<div class="form-group"><label class="col-sm-4 control-label">都道府県</label>
								<div class="col-sm-8">
									<div class="form-control border-none"><?php echo $Prefecture['name'] ?></div>
								</div>
							</div>
							<div class="form-group"><label class="col-sm-4 control-label">市区町村</label>
								<div class="col-sm-8">
									<div class="form-control border-none"><?php echo $City['name'] ?></div>
								</div>
							</div>                    
							<div class="form-group"><label class="col-sm-4 control-label">備考</label>
								<div class="col-sm-8">
									<div class="form-control border-none"><?php echo $RecCompany['remark'] ?></div>
								</div>
							</div>
							<div class="form-group"><label class="col-sm-4 control-label">設立年月日</label>
								<div class="col-sm-8">
									<div class="form-control border-none"><?php echo $RecCompany['establish_date'] ?></div>
								</div>
							</div>
							<div class="form-group"><label class="col-sm-4 control-label">代表電話番号</label>
								<div class="col-sm-8">
									<div class="form-control border-none"><?php echo $RecCompany['represent_tel'] ?></div>
								</div>
							</div>
							<div class="form-group"><label class="col-sm-4 control-label">代表メールアドレス</label>
								<div class="col-sm-8">
									<div class="form-control border-none text-navy"><?php echo $RecCompany['represent_mail'] ?></div>
								</div>
							</div>
							<div class="form-group"><label class="col-sm-4 control-label">従業員数</label>
								<div class="col-sm-8">
									<div class="form-control border-none"><?php echo number_format($RecCompany['employee'])?>人</div>
								</div>
							</div>
							<div class="form-group"><label class="col-sm-4 control-label">売上高</label>
								<div class="col-sm-8">
									<div class="form-control border-none"><?php echo number_format($RecCompany['figure'])?>円</div>
								</div>
							</div>
							<div class="form-group"><label class="col-sm-4 control-label">業種</label>
								<div class="col-sm-8">
									<div class="form-control border-none"><?php echo $this->Enjin->getBusinessName($RecCompany['business_id']);?></div>
								</div>
							</div>
							<div class="form-group"><label class="col-sm-4 control-label">平均年収</label>
								<div class="col-sm-8">
									<div class="form-control border-none"><?php echo number_format($RecCompany['average_salary'])?>円</div>
								</div>
							</div>
							<div class="form-group"><label class="col-sm-4 control-label">平均年齢</label>
								<div class="col-sm-8">
									<div class="form-control border-none"><?php echo $RecCompany['average_age']?>歳</div>
								</div>
							</div>
							<div class="form-group"><label class="col-sm-4 control-label">市場</label>
								<div class="col-sm-8">
									<div class="form-control border-none"><?php echo $this->Enjin->getMarketName($RecCompany['market_id']); ?></div>
								</div>
							</div>                       
						</form>

					</div>

				<?php endif;?>
			</div>
		</div>

		<!--table 2 content-->
		<div class="col-lg-4">

			<div class="ibox">
				<div class="ibox-title">
					<h5>部署一覧</h5>

				</div>
				<div class="ibox-content clearfix p-sm table-border">

					<?php if(!empty($RecDepartments)): ?>
						<div class="oxa">
							<table class="table table-bordered no-margin-bottom">
								<thead>
									<tr>
										<th>部署名</th>
										<th class='w-33per'>親部署</th>
										<th class='w-27per'>人事部フラグ</th>
										<td>操作</td>
									</tr>
								</thead>
								<tbody>
									<?php foreach($RecDepartments as $RecDepartment):?>

										<tr>
											<td><?php echo h($RecDepartment['RecDepartment']['department_name'])?></td>
											<?php if ( empty( $RecDepartment['RecDepartment']['parent_name'] ) ): ?>
												<td>&nbsp;</td>
											<?php else: ?>
												<td><?php echo h($RecDepartment['RecDepartment']['parent_name'])?></td>
											<?php endif; ?>
											<td><?php echo h($RecDepartment['RecDepartment']['hr_flag']?'はい':'いいえ')?></td>
											<td class="table-button-tdright">
												<?php
												echo $this->Html->link(__('削除'),
													'',
													array('class' => 'btn btn-default btn-xs depDel',
														'data-path' => 'RecDepartments/api_delete/'.$RecDepartment['RecDepartment']['id']
														)
													);
													?>
												</td>
											</tr>
										<?php endforeach;?>
										<tr>
											<?php echo $this->Form->create('RecDepartment',array('action'=>'add')); ?>
											<td>
												<?php echo $this->Form->input('department_name', array('placeholder'=>'部署名','label'=>false,'class'=>'form-control')); ?>
											</td>
											<td class='no-borders ver-mid btn-group btn-block'>
												<?php echo $this->Form->input('parent_id',array("options"=>$parentRecDepartments,'class'=>'form-control','label'=>false,'div'=>false,'empty'=>'')); ?>
											</td>                                        
											<td class="">
												<?php echo $this->Form->input('hr_flag',array("options"=>array('いいえ','はい'),'class'=>'form-control','label'=>false,'div'=>false,'empty'=>'')); ?>    
											</td>                                
											<td class="table-button-tdright vcenter">
												<?php echo $this->Form->submit(__('追加'),array(
													'class'=>'btn btn-primary btn-xs',
													'div'=>false
													));?>
												</td>
												<?php echo $this->Form->end();?>
											</tr>                               
										</tbody>
									</table>
								</div>
							<?php endif;?>

						</div>                         
					</div>

				</div>
			</div> 

			<div class='col-lg-12'>
				<div class="ibox">

					<div class="ibox-title">
						<h5>採用担当一覧</h5>                  
					</div>
					<div class="ibox-content bg-white clearfix p-sm">

						<!--pagination-->
						<div class="text-right clearfix">
							<div class="pull-left">
							<?php echo $this->Html->link(__('新規追加'), array(
								'controller' => 'RecRecruiters',
								'action' => 'add'),array(
								'class' => 'btn btn-primary btn-sm'
								)); ?>
							</div>
							<div class="bottom_pagination1 pull-right">
								<ul class="pagination m-t-none">
									<?php
									echo $this->Paginator->prev('Prev', array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'paginate_button previous disabled'));
									echo $this->Paginator->numbers(array('separator' => '','tag'=>'li','class'=>'paginate_button','currentClass'=>'paginate_button active','currentTag'=>'a'));
									echo $this->Paginator->next('Next', array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'paginate_button next disabled'));
									?>  
								</ul>
							</div>
							<span class="sp-text-pg pull-right"><?php echo $this->Paginator->counter("{:count} 件中 {:start}-{:end} 件表示")?>&nbsp;&nbsp;</span>
						</div>
						<!--pagination-->

							<?php if(!empty($RecRecruiters)):?>

								<table class="table table-striped table-bordered tbl-data">
									<thead>
										<tr>
											<th>ID</th>                              
											<th>氏名</th>
											<th>部署</th>
											<th>採用者タイプ</th>
											<th>メール</th>
											<th>電話</th> 
											<th>決裁者フラグ</th> 
											<th>最終ログイン日</th>
											<th>操作</th>             
										</tr>
									</thead>
									<tbody>
										<?php foreach($RecRecruiters as $RecRecruiter): ?>
											<tr>                                    
												<td ><a class='text-navy'><?php echo $this->HTML->link(h($RecRecruiter['RecRecruiter']['id']),array('controller'=>'RecRecruiters','action'=>'view',$RecRecruiter['RecRecruiter']['id'])); ?></a></td>                              
												<td ><a class='text-navy'><?php echo $this->HTML->link(h($RecRecruiter['RecRecruiter']['name']),array('controller'=>'RecRecruiters','action'=>'view',$RecRecruiter['RecRecruiter']['id'])); ?></a></td>
												<td ><?php echo h($RecRecruiter['RecDepartment']['department_name']); ?></td>
												<td ><?php echo $this->Enjin->getFocalPointTypeName(
													$RecRecruiter['RecRecruiter']['focal_point_type']
													); ?></td>
													<td ><a class='text-navy'><?php echo h($RecRecruiter['RecRecruiter']['mail']); ?></a></td>
													<td ><?php echo h($RecRecruiter['RecRecruiter']['tel']); ?></td>  
													<td >
														<div>
															<input type="checkbox" class="i-checks" <?php echo $RecRecruiter['RecRecruiter']['approval_flag']?'checked':'' ?> name="input[]">
														</div>
													</td>  
													<td ><?php echo $this->Time->format('Y/m/d',$RecRecruiter['RecRecruiter']['last_login_date'])?></td>
													<td class="table-button-tdright">
														<?php echo $this->Html->link(__('詳細'), array(
															'controller' => 'RecRecruiters',
															'action' => 'view',
															$RecRecruiter['RecRecruiter']['id']),array(
															'class' => 'btn btn-primary btn-xs'
															)); ?>
														<?php
														echo $this->Html->link(__('削除'),
															'',
															array('class' => 'btn btn-default btn-xs recDel',
																'data-path' => 'RecRecruiters/api_delete/'.$RecRecruiter['RecRecruiter']['id']
																)
															);
															?>
														</td>           
													</tr>
												<?php endforeach;?>

												</tbody>
													<thead>
														<tr>
															<th>ID</th>                              
															<th>氏名</th>
															<th>部署</th>
															<th>採用者タイプ</th>
															<th>メール</th>
															<th>電話</th> 
															<th>決裁者フラグ</th> 
															<th>最終ログイン日</th>
															<th>操作</th>             
														</tr>
													</thead>
												</table>

											<?php endif;?>

												<!--pagination-->
												<div class="text-right clearfix">
													<div class="pull-left">
													<?php echo $this->Html->link(__('新規追加'), array(
														'controller' => 'RecRecruiters',
														'action' => 'add'),array(
														'class' => 'btn btn-primary btn-sm'
														)); ?>
													</div>
													<div class="bottom_pagination1 pull-right">
														<ul class="pagination m-t-none">
															<?php
															echo $this->Paginator->prev('Prev', array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'paginate_button previous disabled'));
															echo $this->Paginator->numbers(array('separator' => '','tag'=>'li','class'=>'paginate_button','currentClass'=>'paginate_button active','currentTag'=>'a'));
															echo $this->Paginator->next('Next', array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'paginate_button next disabled'));
															?>  
														</ul>
													</div>
													<span class="sp-text-pg pull-right"><?php echo $this->Paginator->counter("{:count} 件中 {:start}-{:end} 件表示")?>&nbsp;&nbsp;</span>
												</div>
												<!--pagination-->

											</div>
										</div>
									</div>


								</div>
								<script>
									$( document ).ready(function() {
	function apiCall(path, data, success){//Could this be used global?
		$.post('<?php echo $this->webroot?>'+path, data, success);
	}

	$('.depDel, .recDel').click(function (){
		if(!confirm('Are you sure you want to delete this record?'))
			return false;

		var tmp=$(this);
		apiCall(tmp.data('path'), null, function(res){
			if(!res.code)
				tmp.parents('tr:first').remove();
		});
		return false;
	});

});
								</script>
								<?php return;?>

								<?php var_dump( $RecCompany['RecCompany'] ); ?>
								<?php var_dump( $RecDepartments ); //array RecDepartment ?>
								<?php var_dump( $RecRecruiter ); //array  RecRecruiter ?>

								<div class="recDepartments index">
									<h2><?php echo __('Rec Departments'); ?></h2>
									<table cellpadding="0" cellspacing="0">
										<thead>
											<tr>
												<th><?php echo $this->Paginator->sort('id'); ?></th>
												<th><?php echo $this->Paginator->sort('department_name'); ?></th>
												<th><?php echo $this->Paginator->sort('parent_id'); ?></th>
												<th><?php echo $this->Paginator->sort('rec_company_id'); ?></th>
												<th><?php echo $this->Paginator->sort('hr_flag'); ?></th>
												<th class="actions"><?php echo __('Actions'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($recDepartments as $recDepartment): ?>
												<tr>
													<td><?php echo h($recDepartment['RecDepartment']['id']); ?>&nbsp;</td>
													<td><?php echo h($recDepartment['RecDepartment']['department_name']); ?>&nbsp;</td>
													<td>
														<?php if ( empty( $recDepartment['RecDepartment']['parent_id']  ) ): ?>
															-
														<?php else: ?>
															<?php echo h($recDepartment['RecDepartment']['department_name']); ?>
														<?php endif; ?>
													</td>
													<td>
														<?php echo $this->Html->link($recDepartment['RecCompany']['company_name'], array('controller' => 'rec_companies', 'action' => 'view', $recDepartment['RecCompany']['id'])); ?>
													</td>
													<td>
														<?php if ( $recDepartment['RecDepartment']['hr_flag'] == 1  ): ?>
															人事
														<?php else: ?>
															-
														<?php endif; ?>
													</td>
													<td class="actions">
														<?php echo $this->Html->link(__('View'), array('action' => 'view', $recDepartment['RecDepartment']['id'])); ?>
														<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $recDepartment['RecDepartment']['id'])); ?>
														<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $recDepartment['RecDepartment']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $recDepartment['RecDepartment']['id']))); ?>
													</td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
									<p>
										<?php
										echo $this->Paginator->counter(array(
											'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
											));
											?>	</p>
											<div class="paging">
												<?php
												echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
												echo $this->Paginator->numbers(array('separator' => ''));
												echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
												?>
											</div>
										</div>
