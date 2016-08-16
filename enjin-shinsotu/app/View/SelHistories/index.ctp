<div class="row wrapper border-bottom white-bg page-heading">
 	<div class="col-lg-10">
 		<h2>選考管理｜選考履歴一覧</h2>
 	</div>
 </div>
<div class="wrapper wrapper-content row animated fadeInRight clearfix">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>選考履歴サマリ</h5>
				<div class="ibox-tools">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
				</div>
			</div>
			<div class="ibox-content">
				<h5>求人票名を 表示</h5>
				<div class="table-responsive">

					<?php echo $this->Element('summary'); ?>

				</div>
			</div>
		</div>

		<div class="ibox float-e-margins no-margin-bottom">
			<div class="ibox-title">
				<h5>選考履歴一覧</h5>
				<div class="ibox-tools">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
				</div>
			</div>

			<div class="ibox-content fr-cl">
				<?php echo $this->Form->create('SelHistory',array("type"=>"get")); 
				$data = $this->request->query;

				$date_option = array(
					"type"=>"date",
					"dateFormat"=>"YMD",
					"monthNames"=>false,
					"label"=>"開始日",
					"required"=>false
					);
					?>
					<div class="form-group">
						<label class="linear_inline">求人票選択</label>
						<?php echo $this->Form->input('job_vote_id',array(
							"label"=>false, 
							"required"=>false, 
							'value'=>$data["job_vote_id"],
							'class' => 'form-control ct-select1'
							));?>
						</div>

						<div class="clear"></div>

						<div class="form-group">
							<div class="col-lg-4 row">
								<label class="linear_inline">選考段階</label>
								<?php echo $this->Form->input('screening_stage_id',array(
									"label"=>false, 
									"required"=>false, 
									'value'=>$data["screening_stage_id"],
									'class' => 'form-control ct-select2'
									));?>
								</div>

								<div class="col-lg-5 row">
									<label class="linear_inline">選考ステータス</label>
									<?php echo $this->Form->input('select_status_id',array(
										"options" => $selectJudgmentType,
										"label"=>false, 
										"required"=>false, 
										'value'=>$data["select_status_id"],
										'class' => 'form-control ct-select2'
										));?>
									</div>

									<div class="col-lg-4 row">
										<label class="linear_inline">流入元企業 </label>
										<?php echo $this->Form->input('referer_company_id',array(
											"options" => $refererCompanies,
											"label"=>false, 
											"required"=>false, 
											'value'=>$data["referer_company_id"],
											'class' => 'form-control ct-select2'
											));?>
										</div>
									</div>

									<div class="clear"></div>


									<div class="form-group clearfix">
										<div class="col-sm-4 row">
											<label class="pull-left p-xs">開催期間</label>
											<div class="data_1">

												<div class="input-group date">
													<span class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</span>
													<?php echo $this->Form->input('start_date',array(
														'required'=>false,
														'label'=>false,
														'class'=>'form-control',
														'div' => false,
														'type' => 'text',
														'value' => $data['start_date']
														)); ?>
													</div>

												</div>
											</div>
											<div class="col-sm-4 row">
												<label class="pull-left p-xs">から</label>
												<div class="data_1">
													<div class="input-group date">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<?php echo $this->Form->input('end_date',array(
															'required'=>false,
															'label'=>false,
															'class'=>'form-control',
															'div' => false,
															'type' => 'text',
															'value' => $data['end_date']
															)); ?>
														</div>
													</div>
												</div>
												<label class="pull-left p-xs">まで</label>
											</div>


											<div class="from_calen">
												<?php echo $this->Form->button(__('検索'),array(
													'class' => 'btn btn-primary btn-sm mr-right30',
													'div'=> false,
													'type'=>'submit'
													));?>
													<?php echo $this->Html->link(__('クリア'), array('action' => 'index'),array('class'=>'text-29bbef')); ?>
												</div>
												<?php echo $this->Form->end();?>
												<!---------------------->
											</div>
										</div>

										<div class="ibox-content mrb20">
											<div class="row">

												<div class="col-lg-6">
																<div class="btn-group">
																	<select class="btn btn-white linked h-30 w-100">
																		<option value>チェックのみ</option>
																		<option value=1>すべて</option>
																	</select>        
																</div>

																<button type="button" class="btn btn-sm btn-white mailIco" data-toggle="modal" data-target="#selTmpl">
																<i class="fa fa-envelope-o"></i>
																</button>
																<button type="submit" class="btn btn-sm btn-white" onclick="window.print();">
																	<i class="fa fa-print"></i>
																</button>
																<div class="btn-group">
																	<?php echo $this->Form->input('propriety', array( 
																							'options'=>$change_status_history ,
																							'label'=>false,
																							'div'=>false,
																							'empty'=> "",
																							'class'=>'form-control pull-left btn h-30',
																							'value'=>$change_status_history) ); ?>
																</div>
															</div>
												<div class="col-lg-6">

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
		<div class="col-lg-12 table-responsive">
		<table class="table table-striped table-bordered tbl-data">
			<thead>
				<tr>
					<th class="fix-padding-right td-small-ss">
						<input type="checkbox" class="i-checks">
					</th>
					<th class="td-small">ID</th>
					<th class="td-medium">候補者名</th>
					<th class="td-small">選考段階</th>
					<th class="td-large">選考ステータス</th>
					<th class="td-small">選考開始予定日時</th>
					<th class="td-small">選考開始予定日時</th>
					<th class="td-small-s">面接官数</th>
					<th class="td-small">流入元</th>
					<th class="td-small"> 流入元への公開</th>
					<th class="td-small">公開候補者への公開</th>
					<th class="td-medium">操作</th>
				</tr>
			</thead>

			<tbody>
				<?php 
				if(!empty($selHistories)):
					$kkey = 0;
				foreach ($selHistories as $selHistory): ?>

				<tr role="row" class="odd">
					<td>
						<input type="checkbox" class="i-checks cbItem" value="<?php echo $selHistory['SelHistory']['id']?>">
					</td>
					<td class="sorting_1"><?php echo $this->Html->link($selHistory['CanCandidate']['id'], array('controller'=>'CanCandidates','action' => 'view', $selHistory['CanCandidate']['id'])); ?></td>
					<td class=""><?php echo $this->Html->link($selHistory['CanCandidate']['name'], array('controller'=>'CanCandidates','action' => 'view', $selHistory['CanCandidate']['id'])); ?></td>

					<td><?php echo h($selHistory['ScreeningStage']['name']); ?></td>
					<td>
						<?php $options = $this->Enjin->getSelectStatus( $stage_array, $selHistory['ScreeningStage']['id'], $selHistory['SelHistory']['select_status_id']); 
						    echo $this->Form->Input('select_status_id',array( 'options'=>$options ,'label'=>false,'div'=>false), array('class'=>"btn btn-primary btn-xs" ));
						?>
					</td>

					<td><?php echo $this->Enjin->getDateTime($selHistory['SelHistory']['start_date']); ?>&nbsp;</td>
					<td><?php echo $this->Enjin->getDateTime($selHistory['SelHistory']['end_date']); ?>&nbsp;0</td>
					<td class=""><?php echo $this->Html->link(count($selHistory['SelRecruiterHistory']), array('action' => 'edit', $selHistory['SelHistory']['id'])); ?></td>

					<td><?php echo $this->Html->link( $selHistory['CanCandidate']['RefererCompany']['name'] , array('controller'=>'RefererCompanies', 'action' => 'edit', $selHistory['CanCandidate']['RefererCompany']['id'])); ?></td>
					<td>
						<?php
							$influx_propriety    = ($selHistory['SelHistory']['influx_propriety'] === 0)? 1 : 0;
							$candidate_propriety = ($selHistory['SelHistory']['candidate_propriety'] === 0)? 1 : 0;

						?>
						<div class="switch">
							<div class="onoffswitch">
								<?php echo $this->Form->input( 'influx_propriety',array( 
									"type"=>"checkbox" ,
									'checked'=> ($selHistory['SelHistory']['influx_propriety'] == 0 ),
									'label'=>false,
									'div'=>false,
									'class'=>'onoffswitch-checkbox',
									'id' => $kkey)); ?>
									<label class="onoffswitch-label" for="<?php echo $kkey;?>">
										<span class="onoffswitch-inner"></span>
										<span class="onoffswitch-switch"></span>
									</label>
								</div>
							</div>
						</td>
						<td>
							<div class="switch">
								<div class="onoffswitch">
									<?php echo $this->Form->input( 'candidate_propriety',array( 
										"type"=>"checkbox" ,
										'checked'=>($selHistory['SelHistory']['candidate_propriety'] == 0 ),
										'label'=>false,
										'div' => false,
										'class'=>'onoffswitch-checkbox',
										'id' => 't'.$kkey)); ?>
										<label class="onoffswitch-label" for="<?php echo 't'.$kkey?>">
											<span class="onoffswitch-inner"></span>
											<span class="onoffswitch-switch"></span>
										</label>
									</div>
								</div>
							</td>
							<td class = "hover-button">
								<?php echo $this->Html->link(__('詳 細'), array(
									'action' => 'edit',
									$selHistory['SelHistory']['id']),array(
									'class' => 'btn btn-primary btn-xs cl-white',
									)); ?>
								<?php if($selHistory['SelHistory']['screening_stage_id'] != $firstData['screeningStages']):?>
								<?php echo $this->Form->postLink(__('削 除'), array('action' => 'delete', $selHistory['SelHistory']['id']), array(
									'confirm' => __('Are you sure you want to delete # %s?', 
									$selHistory['SelHistory']['id']),'class'=>'btn btn-default btn-xs cl-white')); ?>
								<?php endif; ?>
								</td>
							</tr>
							<?php 
							$kkey++;
							endforeach;
							endif;
							?>
						</tbody>
						<thead>
							<tr>
								<th class="fix-padding-right td-small-ss">
									<input type="checkbox" class="i-checks">
								</th>
								<th class="td-small">ID</th>
								<th class="td-medium">候補者名</th>
								<th class="td-small">選考段階</th>
								<th class="td-large">選考ステータス</th>
								<th class="td-small">選考開始予定日時</th>
								<th class="td-small">選考開始予定日時</th>
								<th class="td-small-s">面接官数</th>
								<th class="td-small">流入元</th>
								<th class="td-small"> 流入元への公開</th>
								<th class="td-small">公開候補者への公開</th>
								<th class="td-medium">操作</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="col-lg-6">
					<div class="btn-group">
						<select class="btn btn-white linked h-30 w-100">
							<option value>チェックのみ</option>
							<option value=1>すべて</option>
						</select>        
					</div>

					<button type="button" class="btn btn-sm btn-white mailIco" data-toggle="modal" data-target="#selTmpl">
					<i class="fa fa-envelope-o"></i>
					</button>
					<button type="submit" class="btn btn-sm btn-white" onclick="window.print();">
						<i class="fa fa-print"></i>
					</button>
					<div class="btn-group">
						<?php echo $this->Form->input('propriety', array( 
												'options'=>$change_status_history ,
												'label'=>false,
												'div'=>false,
												'empty'=> "",
												'class'=>'form-control pull-left btn h-30',
												'value'=>$change_status_history) ); ?>
					</div>
				</div>
				<div class="col-lg-6">

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
															<!-- end action table -->
														</div>
													</div>
												</div>
											</div>

<div class="modal inmodal" id="selTmpl" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content animated fadeIn">
      <div class="modal-header">
        <h4 class="modal-title">Template selection</h4>
        <small class="font-bold">Select an email template then send email to selected data</small>
      </div>
      <div class="modal-body">
        
        <table class="table table-bordered">
          <thead>
            <tr>
              <th></th>
              <th>Template</th>
            </tr>
          </thead>
          <tbody>
            <?php $idx=1;
            foreach($mailtmp as $key => $row){?>
              <tr>
                <td><div class='i-checks'>
                    <label>
                      <input class='' type="radio" value="<?php echo $key?>" name="emailTmpl">
                    </label>
                  </div>
                </td>
                <td><?php echo $row?></td>
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>

        <div id="ajaxReport"></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="mailBtn">Send Now</button>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
    var data,webroot='<?php echo $this->webroot?>';

	//checkbox group
	$('.table-responsive th .iCheck-helper').click(function(){
		if($(this).prev()[0].checked)
			$('.table-responsive .i-checks').iCheck('check');
		else
			$('.table-responsive .i-checks').iCheck('uncheck');
	});
    //match selectbox
    $('.linked').change(function(){
        var tmp = 1 - $('.linked').index(this);
        $('.linked')[tmp].value=$(this).val();
      });
    //send mail
    $('.mailIco').click(function (){
        data=[];//clean data befor send
        $("#ajaxReport").html('');//clean report

        if(!$('.linked')[0].value)//only selected, pour data
        $('.cbItem').each(function (){if(this.checked) data.push(this.value)});
        console.log( data);
      });
    $("#mailBtn").click(function (){
        if($('.linked')[0].value){//all follow search options
          $.post(webroot+'MlSendHistories/send_search_by_candidate',
            {"mail_template_id" : $("input[name=emailTmpl]:checked").val()},
            function (res){
              if(typeof res.code == 'undefined')
              return false;
              $("#ajaxReport").append("All emails were sent.");
            }).fail(function (res) {
              $("#ajaxReport").append("Fail to send the emails.");
            });

          return false;
        }

        sendMail();
      });

    function sendMail(){
      $.post(webroot+'MlSendHistories/send_simple',
        {"can_candidate_ids" : data, "mail_template_id" : $("input[name=emailTmpl]:checked").val()},
        function (res){
          if(typeof res.code == 'undefined')
          return false;
          $("#ajaxReport").append("An email was sent to #" +data+ "<br>");
        }).fail(function (res) {
          $("#ajaxReport").append("Fail to send email to #" +data+ "<br>");
        });
    }

});
</script>
											<?php 
											return;
											echo $this->Enjin->getSummary( $summaryData );

											?>
											<div class="selHistories index">

												<?php echo $this->Enjin->getSummary( $summaryData ); ?>

												<fieldset style="border:dashed 1px; padding:0px;">
													<?php echo $this->Form->create('SelHistory',array("type"=>"get")); ?>
													<legend>選考履歴検索</legend>
													<?php
													$data = $this->request->query;

													$date_option = array(
														"type"=>"date",
														"dateFormat"=>"YMD",
														"monthNames"=>false,
														"label"=>"開始日",
														"required"=>false
														);
													echo $this->Form->input('job_vote_id',array("label"=>"求人票", "required"=>false, 'value'=>$data["job_vote_id"] ));
													echo $this->Form->input('screening_stage_id',array("label"=>"選考段階", "required"=>false, 'value'=>$data["screening_stage_id"]));
													echo $this->Form->input('select_status_id', array( 'options' => $selectJudgmentType ,"label"=>"選考ステータス", "required"=>false, 'value'=>$data["select_status_id"]));
													echo $this->Form->input('referer_company_id', array( 'options' => $refererCompanies ,"label"=>"流入元企業", "required"=>false, 'value'=>$data["referer_company_id"]));

													$date_option["selected"] = $data["start_date"];
													echo $this->Form->input('start_date',$date_option );

													$date_option["label"] = "終了日";
													$date_option["selected"] = $data["end_date"];

													echo $this->Form->input('end_date',$date_option);

													echo $this->Form->input('influx_propriety', array(  'options'=> $open_propriety,"label"=>"流入元企業への選考ステータス公開", "required"=>false,'value'=>$data['influx_propriety']));
													echo $this->Form->input('candidate_propriety', array( 'options'=> $open_propriety,"label"=>"候補者への選考ステータス公開", "required"=>false,'value'=>$data['candidate_propriety']));


													echo $this->Form->end("検索");

													?>

												</fieldset>

												<h2><?php echo h($jobVotesName); ?></h2>
												<?php echo $this->Form->create('MlSendHistories', array( 'type' => 'post', 'url' => array('controller' => 'ml_send_histories','action' => 'send_simple'))); ?>
												<?php echo $this->form->input(false, array("name"=>"target_person", "options"=>$check_select)); ?>
												<?php echo $this->form->input(false, array("name"=>"mail_template_id", "options"=>$mailtmp)); ?>


												<table cellpadding="0" cellspacing="0">
													<thead>
														<tr>
															<th><?php echo $this->Form->input(false,array("type"=>"checkbox")); ?>
																<th>候補者ID</th>
																<th>候補者名</th>
																<th>選考段階</th>
																<th>選考ステータス</th>
																<th>開始日時</th>
																<th>終了日時</th>
																<th>面接官数</th>
																<th>流入元</th>
																<th>流入元企業への選考ステータス公開</th>
																<th>候補者への選考ステータス公開</th>
																<th class="actions">Actions</th>
															</tr>
														</thead>
														<tbody>
															<?php foreach ($selHistories as $selHistory): ?>
																<tr>
																	<td><?php echo $this->Form->input( 'sel_history_id.', array( "type"=>"checkbox" , 'label'=>false, 'value' => $selHistory['SelHistory']['id'],'hiddenField' => false)); ?>
																		<td>
																			<?php echo $this->Html->link($selHistory['CanCandidate']['id'], array('controller'=>'CanCandidates','action' => 'index', $selHistory['CanCandidate']['id'])); ?>
																		</td>
																		<td>
																			<?php echo $this->Html->link($selHistory['CanCandidate']['name'], array('controller'=>'CanCandidates','action' => 'index', $selHistory['CanCandidate']['id'])); ?>
																		</td>
																		<td>
																			<?php echo h($selHistory['ScreeningStage']['name']); ?>
																		</td>
																		<td>
																			<?php $options = $this->Enjin->getSelectStatus( $stage_array, $selHistory['ScreeningStage']['id'], $selHistory['SelHistory']['select_status_id']); ?>
																			<?php echo $this->Form->input("select_status_id[{$selHistory['SelHistory']['id']}]",array("options"=>$options, 'label'=>false, 'value'=>$selHistory['SelHistory']['select_status_id'])); ?>
																		</td>
																		<td><?php echo $this->Enjin->getDateTime($selHistory['SelHistory']['start_date']); ?>&nbsp;</td>
																		<td><?php echo $this->Enjin->getDateTime($selHistory['SelHistory']['end_date']); ?>&nbsp;</td>
																		<td><?php echo $this->Html->link(count($selHistory['SelRecruiterHistory']), array('action' => 'edit', $selHistory['SelHistory']['id'])); ?></td>

																		<td><?php echo $this->Html->link( $selHistory['CanCandidate']['RefererCompany']['name'] , array('controller'=>'RefererCompanies', 'action' => 'edit', $selHistory['CanCandidate']['RefererCompany']['id'])); ?>

																			<td><?php echo $this->Form->input( 'influx_propriety',array( "type"=>"checkbox" , 'label'=>false)); ?>
																				<td><?php echo $this->Form->input( 'candidate_propriety',array( "type"=>"checkbox" , 'label'=>false)); ?>
																					<td class="actions">
																						<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $selHistory['SelHistory']['id'])); ?>
																						<?php if ( $this->Enjin->isSelHistoryDelete( $stage_array, $selHistory['ScreeningStage']['id'] )): ?>
																							<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $selHistory['SelHistory']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $selHistory['SelHistory']['id']))); ?>
																						<?php endif; ?>
																					</td>
																				</tr>
																			<?php endforeach; ?>
																		</tbody>
																	</table>

																	<?php echo $this->Form->end('メールを送信'); ?>

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
