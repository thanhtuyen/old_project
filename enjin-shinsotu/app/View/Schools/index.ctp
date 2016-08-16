<style>.btn-primary,.btn-default{color:#fff !important}</style>
<div class="row wrapper border-bottom white-bg page-heading">
 	<div class="col-lg-10">
 		<h2>学校マスタ</h2>
 	</div>
 </div>
<div class="wrapper wrapper-content row animated fadeInRight clearfix no-margin-bottom">
	<div class="col-lg-12">

		<div class="ibox  no-margin-bottom">
			<div class="ibox-title">
				<h5>学校マスタ一覧</h5>
				<div class="ibox-tools">
					<?php echo $this->Html->link(__('新規追加'), array('action' => 'add'),array('class'=>'btn btn-primary btn-xs')); ?>
				</div>
			</div>

			<!-- action form -->
			<div class="ibox-content bg-gray clearfix form-edit2 p-sm">
				
				<?php echo $this->Form->create('School',array(
						'class'=>'',
						'type'=>'get',
						'url' => array('controller' => 'schools', 'action' => 'index')
						))?>

					<div class="clear"></div>
					<div class="form-group">
						<div class="pull-left row m-r-md">
							<label class="pull-left p-xs">学校区分</label>

							<?php echo $this->Form->input('school_class_id', array( 
							'options' => $schoolClass,
							'class'=>'form-control ct-select2',
							'label'=> false, 
							'div'=>false,
							'required'=>false,
							'empty' => '',
							'default' => (isset($school_class_id)) ? $school_class_id : '' )
							); ?>

						</div>
						<div class="pull-left row m-r-md ">
							<label class="pull-left p-xs">国公立区立区分</label>

							<?php echo $this->Form->input('public_private_class_id', array( 
							'options' => $publicPrivateClass,
							'class'=>'form-control ct-select2',
							'label'=> false, 
							'empty' => '',
							'div'=>false,
							'required'=>false,
							'default' => (isset($public_private_class_id)) ? $public_private_class_id : '' )
							);?>

						</div>
						<div class="pull-left row">
							<label class="pull-left p-xs">学校名</label>
							<?php  echo $this->Form->input('name',array(
								'class'=>'form-control ct-select2',
								'label'=>false,
								'div'=>false,
								'required'=>false,
								'default' => (isset($name)) ? $name : ''
								)); ?>
						</div>
					</div>
					<div class="clear"></div>
					<div class="from_calen">
						<?php echo $this->Form->submit(__('検索'),array(
						'class'=>'btn btn-primary w-95 mr-right30',
						'div'=>false
						));?>
						<?php echo $this->HTML->link(__('クリア'),array('action'=>'index'),array('class'=>'text-29bbef'));?>
					</div>
				<?php echo $this->Form->end();?>
			</div>
			<!-- end form action -->

		</div>
		<div class="ibox-content">

			<!--pagination-->
			<div class="text-right clearfix">
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

			<!-- table -->
			<div class="table-responsive">
				<table class="table table-striped table-bordered tbl-data">
					<thead>
						<tr>
							<th>id</th>
								<th>学校名</th>
								<th>学校区分</th>
								<th>国公立区立区分</th>
								<th>学校ランク</th>
								<th>国</th>
								<th>都道府県</th>
								<th class="actions"><?php echo __('操作'); ?></th>
						</tr>
					</thead>
					<tbody>
								<?php foreach ($schools as $school): ?>
									<tr>
										<td><?php echo h($school['School']['id']); ?>&nbsp;</td>
										<td><?php echo $this->Html->link(h($school['School']['name']), array('action' => 'edit', $school['School']['id'])); ?>&nbsp;</td>
										<td><?php echo h($schoolClass[$school['School']['school_class_id']]); ?>&nbsp;</td>
										<td><?php echo h($publicPrivateClass[$school['School']['public_private_class_id']]); ?>&nbsp;</td>
										<td><?php echo h($schoolRank[$school['School']['school_rank']]); ?>&nbsp;</td>
										<td><?php echo $school['Country']['name']; ?></td>
										<td><?php echo $school['Prefecture']['name']; ?></td>
										<td class="actions">
											<?php echo $this->Html->link(__('詳細'), array('action' => 'view', $school['School']['id']),array('class'=>'btn btn-primary btn-xs')); ?>
											<?php echo $this->Html->link(__('編集'), array('action' => 'edit', $school['School']['id']),array('class'=>'btn btn-primary btn-xs')); ?>
											<?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $school['School']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $school['School']['id']),'class'=>'btn btn-default btn-xs')); ?>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
					<thead>
						<tr>
							<th>id</th>
							<th>学校名</th>
							<th>学校区分</th>
							<th>国公立区立区分</th>
							<th>学校ランク</th>
							<th>国</th>
							<th>都道府県</th>
							<th><?php echo __('操作'); ?></th>
						</tr>
					</thead>
				</table>
			</div>
			<!-- end table -->

			<!--pagination-->
			<div class="text-right clearfix">
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

<?php return;?>

<div class="wrapper wrapper-content row animated fadeInRight clearfix">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-content">

				<div class="schools index">

					<h2><?php echo __('Schools'); ?></h2>
					<?php echo $this->Html->link(__('Add'), array('action' => 'add'),array('class'=>'btn btn-default')); ?>

					<?php echo $this->Form->create('School',array(
						'class'=>'form-inline',
						'type'=>'get',
						'url' => array('controller' => 'schools', 'action' => 'index')
						))?>

					<?php echo $this->Form->input('school_class_id', array( 
						'options' => $schoolClass,
						'class'=>'form-control',
						'label'=> __('Class School'), 
						'div'=>false,
						'required'=>false,
						'empty' => __('Select'),
						'default' => (isset($school_class_id)) ? $school_class_id : '' )
						);?>
					<?php echo $this->Form->input('public_private_class_id', array( 
						'options' => $publicPrivateClass,
						'class'=>'form-control',
						'label'=> __('Public Private Class'), 
						'empty' => __('Select'),
						'div'=>false,
						'required'=>false,
						'default' => (isset($public_private_class_id)) ? $public_private_class_id : '' )
						);?>
					<?php  echo $this->Form->input('name',array(
						'class'=>'form-control',
						'div'=>false,
						'required'=>false,
						'default' => (isset($name)) ? $name : ''
						)); ?>

					<?php echo $this->Form->submit(__('Search'),array(
						'class'=>'form-control',
						'div'=>false
						));?>

						<?php echo $this->Form->end();?>

						<br>
						<table cellpadding="0" cellspacing="0">
							<thead>
								<tr>
									<th><?php echo $this->Paginator->sort('id'); ?></th>
									<th><?php echo $this->Paginator->sort('rec_company_id'); ?></th>
									<th><?php echo $this->Paginator->sort('name'); ?></th>
									<th><?php echo $this->Paginator->sort('school_class_id'); ?></th>
									<th><?php echo $this->Paginator->sort('public_private_class_id'); ?></th>
									<th><?php echo $this->Paginator->sort('school_rank'); ?></th>
									<th><?php echo $this->Paginator->sort('country_id'); ?></th>
									<th><?php echo $this->Paginator->sort('prefecture_id'); ?></th>
									<th><?php echo $this->Paginator->sort('rec_recruiter_id'); ?></th>
									<th><?php echo $this->Paginator->sort('status'); ?></th>
									<th><?php echo $this->Paginator->sort('created'); ?></th>
									<th><?php echo $this->Paginator->sort('modified'); ?></th>
									<th class="actions"><?php echo __('Actions'); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($schools as $school): ?>
									<tr>
										<td><?php echo h($school['School']['id']); ?>&nbsp;</td>
										<td>
											<?php echo $this->Html->link($school['RecCompany']['id'], array('controller' => 'rec_companies', 'action' => 'view', $school['RecCompany']['id'])); ?>
										</td>
										<td><?php echo $this->Html->link(h($school['School']['name']), array('action' => 'edit', $school['School']['id'])); ?>&nbsp;</td>
										<td><?php echo h($schoolClass[$school['School']['school_class_id']]); ?>&nbsp;</td>
										<td><?php echo h($publicPrivateClass[$school['School']['public_private_class_id']]); ?>&nbsp;</td>
										<td><?php echo h($schoolRank[$school['School']['school_rank']]); ?>&nbsp;</td>
										<td>
											<?php echo $this->Html->link($school['Country']['name'], array('controller' => 'countries', 'action' => 'view', $school['Country']['id'])); ?>
										</td>
										<td>
											<?php echo $this->Html->link($school['Prefecture']['name'], array('controller' => 'prefectures', 'action' => 'view', $school['Prefecture']['id'])); ?>
										</td>
										<td>
											<?php echo $this->Html->link($school['RecRecruiter']['id'], array('controller' => 'rec_recruiters', 'action' => 'view', $school['RecRecruiter']['id'])); ?>
										</td>
										<td><?php echo h($selStatus[$school['School']['status']]); ?>&nbsp;</td>
										<td><?php echo h($school['School']['created']); ?>&nbsp;</td>
										<td><?php echo h($school['School']['modified']); ?>&nbsp;</td>
										<td class="actions">
											<?php echo $this->Html->link(__('View'), array('action' => 'view', $school['School']['id'])); ?>
											<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $school['School']['id'])); ?>
											<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $school['School']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $school['School']['id']))); ?>
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

						</div>
					</div>
				</div>
			</div>

