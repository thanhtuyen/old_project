<script>
        $(document).ready(function(){
           var elem = document.querySelector('.js-switch');
            var switchery = new Switchery(elem, { color: '#1AB394' });

            var elem_2 = document.querySelector('.js-switch_2');
            var switchery_2 = new Switchery(elem_2, { color: '#1AB394' });
        });
        

      


    </script>

<?php echo $this->element('back_nav', array('text' => __('選考履歴｜1234567　田中　太朗')))?>

<div class="wrapper wrapper-content animated fadeIn pd-bottom-none">
	<div class="row">
		<div class="col-lg-8">
			<div class="tabs-container">
				<!-- -----------galfkjhsadjfsd -->
				<ul class="nav nav-tabs">
					<li class=""><a data-toggle="tab" href="#tab-0">書類選考</a></li>
					<li class=""><a data-toggle="tab" href="#tab-1">1 次選考</a></li>
					<li class="active"><a data-toggle="tab" href="#tab-2">2次選考</a></li>
				</ul>
				<div class="tab-content">
					<!-- -----------tab-0--------- -->
					<!-- -----------tab-0--------- -->
					<div id="tab-0" class="tab-pane">
						<div class="panel-body">
							<div class="ibox-title">
								<h5>候補者情報</h5>
							</div>

							<div class="ibox-content">
								<form method="get" class="form-horizontal">
									<div class="form-group"><label class="col-sm-4 control-label">選考履歴ID</label>
										<div class="col-sm-8">1234567</div>
									</div>

									<div class="form-group"><label class="col-sm-4 control-label">候補者名</label>
										<div class="col-sm-8"><a href="#">田中　太朗</a>
										</div>
									</div>

									<div class="form-group"><label class="col-sm-4 control-label">候補者ID</label>
										<div class="col-sm-8">987654</div>
									</div>

									<div class="form-group"><label class="col-sm-4 control-label">選考段階名</label>
										<div class="col-sm-8">２次面接</div>
									</div>
									<div class="form-group"><label class="col-sm-4 control-label">選考ステータス</label>

										<div class="col-sm-8">
											<select class="form-control select-w100" name="agent_id">
												<option>不合格</option>
												<option>不合格</option>
												<option>その他</option>
											</select>
										</div>
									</div>

									<div class="form-group mbottom15"><label class="col-sm-4 control-label">選考終了予定日時</label>
										<div class="col-sm-8">
											<div class="col-sm-6">
												<div class='data_1' id="">
													<div class="input-group date">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" class="form-control ct-select1" value="03/04/2014">
													</div>
												</div>
												<!-- end id data_1-->
											</div>
											<div class="col-sm-6">
												<div class="input-group clockpicker" data-autoclose="true">
													<span class="input-group-addon">
														<span class="fa fa-clock-o"></span>
													</span>
													<input type="text" class="form-control" value="09:30" >
												</div><!-- end clock-->
											</div>
										</div>
									</div>
									<div class="form-group"><label class="col-sm-4 control-label">選考開始予定日時</label>
										<div class="col-sm-8">
											<div class="col-sm-6">
												<div class='data_1' id="">
													<div class="input-group date">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" class="form-control" value="03/04/2014">
													</div>
												</div>
												<!-- end id data_1-->
											</div>
											<div class="col-sm-6">
												<div class="input-group clockpicker" data-autoclose="true">
													<span class="input-group-addon">
														<span class="fa fa-clock-o"></span>
													</span>
													<input type="text" class="form-control" value="09:30" >
												</div><!-- end clock-->
											</div>
										</div>
									</div>
								</form>
								<!-- end table 2-->
							</div>  
							<!-- form 2 -->   
							<div class="ibox-content">
								<form method="get" class="form-horizontal">
									<div class="form-group"><label class="col-sm-4 control-label">求人票ID</label>
										<div class="col-sm-8">ABC123456</div>
									</div>
									<div class="form-group"><label class="col-sm-4 control-label">求人票タイトル</label>
										<div class="col-sm-8">求人票タイトル</div>
									</div>                                        
								</form>
							</div> 
							<!-- end form 2 -->
							<!-- form 3 -->   
							<div class="ibox-content">
								<form method="get" class="form-horizontal">
									<div class="form-group"><label class="col-sm-4 control-label">選考ステータスオプション</label>
										<div class="col-sm-8">オプション内容</div>
									</div>

									<div class="form-group"><label class="col-sm-4 control-label">掲示年収</label>
										<div class="col-sm-8">400万円</div>
									</div>

									<div class="form-group mbottom15"><label class="col-sm-4 control-label">コメント</label>
										<div class="col-sm-8">
											<textarea type="text" rows="6" class="form-control">選 考 履 歴 に 対 す る 、 コ メ ン ト ＆ メ モ</textarea>
										</div>
									</div>

									<div class="form-group"><label class="col-sm-4 control-label">訪問先情報</label>
										<div class="col-sm-8"><input type="text" class="form-control" value="訪問先情報"></div>
									</div>

									<div class="form-group"><label class="col-sm-4 control-label">流入元企業への 選考ステータスの公開可否</label>
										<div class="col-sm-8">
											<div class="switch">
												<div class="onoffswitch">
													<input type="checkbox" checked class="onoffswitch-checkbox" id="example2">
													<label class="onoffswitch-label" for="example2">
														<span class="onoffswitch-inner"></span>
														<span class="onoffswitch-switch"></span>
													</label>
												</div>
											</div>
										</div>
									</div>

									<div class="form-group"><label class="col-sm-4 control-label">流入元企業への 選考ステータスの公開可否</label>
										<div class="col-sm-8">
											<div class="switch">
												<div class="onoffswitch">
													<input type="checkbox" checked class="onoffswitch-checkbox" id="example1">
													<label class="onoffswitch-label" for="example1">
														<span class="onoffswitch-inner"></span>
														<span class="onoffswitch-switch"></span>
													</label>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group"><label class="col-sm-4 control-label">   最終更新者タイプ</label>
										<div class="col-sm-8">採用担当者</div>
									</div>
									<div class="form-group"><label class="col-sm-4 control-label">最終更新者採用担当者ID</label>
										<div class="col-sm-8"><a href="#">live1234</a></div>
									</div>
									<div class="form-group"><label class="col-sm-4 control-label">最終更新流入元担当者ID</label>
										<div class="col-sm-8"><a href="#">mynavi12345678</a></div>
									</div>
								</form>
							</div> 
							<!-- end form 3-->
							<div class="text-center mbottom15">
								<button class="btn btn-primary btn-sm">削除</button>
								<button class="btn btn-primary btn-sm">更新</button>
							</div>
						</div>

						<div class = "clear20"></div>
						<div>
							<div>
								<div class = "ibox">
									<div class="ibox-title">
										<h5>最終選考採用担当者</h5>
										<div class="ibox-tools">
											<a class="collapse-link">
												<i class="fa fa-chevron-up"></i>
											</a>
										</div>
									</div>
									<div class="ibox-content p-sm">
										<h5><p>面接官（（採用担当者））の登録</p></h5>
										<div>
											<div class="ibox-content bg-gray clearfix form-edit2 p-sm">
												<form method="get" class="form-horizontal">
													<!--to do start1-->
													<div>
														<div class = "float-lf col-lg-6"> 
															<div><label for="">部署名</label></div>

															<div>
																<select class="form-control">
																	<option>営 業 部</option>
																</select>
															</div>


															<div>
																<select class="form-control">
																	<option>営 業 ２ 課</option>
																</select>
															</div>

															<div>
																<select class="form-control">
																	<option>ソ リ ュ ー シ ョ ン 営 業 チ ー ム</option>
																</select>
															</div>
														</div>

														<div class = "col-lg-6">
															<div class = "margin-lf15"><label>採用担当者</label></div>
															<div >
																<div class = "col-lg-6">
																	<select class="form-control">
																		<option>ソ リ ュ ー シ ョ ン 営 業 チ ー ム</option>
																	</select>
																</div>

																<div class = "margin-top3 float-lf col-lg-6">
																	<button type="button" class="margin-lf10 btn btn-primary btn-sm">面接官に追加</button>
																</div>
															</div>
														</div>

													</div>
												</form>
												<div class = "clear10"></div>
											</div>
											<div class = "clear10"></div>
										</div>

										<h5><p>面接官（（採用担当者））選考履歴</p></h5>

										<table class="table table-bordered no-margin-bottom">
											<thead>
												<tr>
													<th>採用担当者名</th>
													<th>評価ランク</th>
													<th class = "col-lg-2">評価スコア</th>
													<th>評価コメント</th>
													<th>操作</th>
												</tr>
											</thead>
											<tbody>
												<tr >
													<td><a class = "text-navy" href="#">柏井 こたろー</a></td>
													<td>不合格</td>
													<td>50</td>
													<td>コメントコメント</td>
													<td></td>
												</tr>

												<tr class = "show-data">
													<td><a class = "text-navy" href="#">宮崎 範浩</a></td>
													<td> </td>
													<td></td>
													<td> </td>
													<td>
														<div class = "margin-lf10">
															<div class = "float-lf margin-right5"><button class="p4-show-fr-edit full-width btn btn-xs btn-primary show-data" id=''>評価入力</button></div>
															<div class = "float-lf"><button class="full-width btn btn-xs btn-primary">解除</button></div>
														</div>  
													</td>
												</tr>

												<tr class = "show-return hiden-return fr-hiden">
													<td><a class = "text-navy" href="#">宮崎 範浩</a></td>
													<td>
														<div>
															<select class="form-control select-w100" name="agent_id">
																<option>合格</option>
																<option>不合格</option>
																<option>その他</option>
															</select>
														</div>
													</td>
													<td><input type="number" class="form-control" value="75"></td>
													<td>
														<div><input type="text" class="form-control" value="text box"></div>
													</td>
													<td>
														<div class = "margin-lf10">
															<div class = "float-lf margin-right5"><button class="p4-save-edit full-width btn btn-xs btn-primary show-return hiden-return fr-hiden" id = "">更新</button></div>
															<div class = "float-lf"><button class="full-width btn btn-xs btn-primary">解除</button></div>
														</div>  
													</td>
												</tr>

												<tr class = "edit-return fr-hiden">
													<td><a class = "text-navy" href="#">宮崎 範浩</a></td>
													<td>合格</td>
													<td>75</td>
													<td> コメントコメント</td>
													<td>
														<div class = "margin-lf10">
															<div class = "float-lf"><button class="p4-edit-return full-width btn btn-xs btn-primary edit-return" id = "">修正</button></div>
														</div>  
													</td>
												</tr>

												<tr >
													<td><a class = "text-navy" href="#">宮崎 範浩</a></td>
													<td>合格</td>
													<td>75</td>
													<td>コメントコメント</td>
													<td>abc</td>
												</tr>

												<tr >
													<td><a class = "text-navy" href="#">土屋 則幸</a></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>

												<tr>
													<td><a class = "text-navy" href="#">三橋 和広</a></td>
													<td>合格</td>
													<td>74 </td>
													<td> コメントコメント</td>
													<td></td>
												</tr>

											</tbody>
										</table>                                      
										<!-- table -->
									</div>
								</div>
							</div>
						</div>                                  
					</div>
					<!-- --------tab-2-------- -->
					<div id="tab-2" class="tab-pane active">
						<div class="panel-body mrb20">

							<div class="ibox-title">
								<h5>候補者情報</h5>
							</div>

							<div class="ibox-content">
								<form method="get" class="form-horizontal form-edit">
									<div class=""><label class="col-sm-4 control-label">選考履歴ID</label>
										<div class="col-sm-8">
											<div class='form-control border-none'>1234567</div>
										</div>
									</div>

									<div class="form-group"><label class="col-sm-4 control-label">候補者名</label>
										<div class="col-sm-8">
											<div class='form-control border-none'>
												<a href="#">田中　太朗</a>
											</div>
										</div>
									</div>

									<div class=""><label class="col-sm-4 control-label">候補者ID</label>
										<div class="col-sm-8">
											<div class='form-control border-none'>98765</div>
										</div>
									</div>

									<div class=""><label class="col-sm-4 control-label">選考段階名</label>
										<div class="col-sm-8">
											<div class='form-control border-none'>2次面接</div>
										</div>
									</div>

									<div class="form-group"><label class="col-sm-4 control-label">選考ステータス</label>
										<div class="col-sm-4">
											<div class='col-sm-12'>
											<select class="form-control">
												<option>不合格</option>
												<option>不合格</option>
												<option>その他</option>
											</select>
											</div>
										</div>
									</div>

									<div class="form-group mbottom15"><label class="col-sm-4 control-label">選考終了予定日時</label>
										<div class="col-sm-8">
											<div class="col-sm-6">
												<div class="data_1" id="">
													<div class="input-group date">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" class="form-control ct-select1" value="03/04/2014">
													</div>
												</div>
												<!-- end id data_1-->
											</div>
											<div class="col-sm-6">
												<div class="input-group clockpicker" data-autoclose="true">
													<span class="input-group-addon">
														<span class="fa fa-clock-o"></span>
													</span>
													<input type="text" class="form-control" value="09:30">
												</div><!-- end clock-->
											</div>
										</div>
									</div>
									<div class="form-group"><label class="col-sm-4 control-label">選考開始予定日時</label>
										<div class="col-sm-8">
											<div class="col-sm-6">
												<div class="data_1" id="">
													<div class="input-group date">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" class="form-control" value="03/04/2014">
													</div>
												</div>
												<!-- end id data_1-->
											</div>
											<div class="col-sm-6">
												<div class="input-group clockpicker" data-autoclose="true">
													<span class="input-group-addon">
														<span class="fa fa-clock-o"></span>
													</span>
													<input type="text" class="form-control" value="09:30">
												</div><!-- end clock-->
											</div>
										</div>
									</div>
						
							
									<div class="form-group"><label class="col-sm-4 control-label">求人票ID</label>
										<div class="col-sm-8">
											<div class='form-control border-none'>ABC123456</div>
									</div>
									</div>
									<div class="form-group"><label class="col-sm-4 control-label">求人票タイトル</label>
										<div class="col-sm-8">
											<div class='form-control border-none'>求人票タイトル</div>
										</div>
									</div>
							
					
				
				
			
									<div class="form-group"><label class="col-sm-4 control-label">選考ステータスオプション</label>

										<div class="col-sm-8">
											<div class='form-control border-none'>オプション内容</div>
										</div>
									</div>

									<div class="form-group"><label class="col-sm-4 control-label">掲示年収</label>
										<div class="col-sm-8">
											<div class='form-control border-none'>400万円</div>
										</div>
									</div>

									<div class="form-group mbottom15"><label class="col-sm-4 control-label">コメント</label>
										<div class="col-sm-8">
											<div class='col-sm-12'>
											<textarea type="text" rows="6" class="form-control">選 考 履 歴 に 対 す る 、 コ メ ン ト ＆ メ モ</textarea>
											</div>
										</div>
									</div>

									<div class="form-group"><label class="col-sm-4 control-label">訪問先情報</label>
										<div class="col-sm-8">
											<div class='col-sm-12'>
												<input type="text" class="form-control" value="訪問先情報">
																						</div>
										</div>
									</div>


									<div class="form-group"><label class="col-sm-4 control-label">流入元企業への 選考ステータスの公開可否</label>
										<div class="col-sm-8">
										<div class='col-sm-12'>
								
													<input type="checkbox" checked="" class="js-switch_2" id="">	
							
								</div>
										</div>
									</div>

									<div class="form-group"><label class="col-sm-4 control-label">流入元企業への 選考ステータスの公開可否</label>
										<div class="col-sm-8">
											<div class='col-sm-12'>
											<input type="checkbox" checked="" class="js-switch" id="">
										</div>
										</div>
									</div>

									<div class="form-group"><label class="col-sm-4 control-label">   最終更新者タイプ</label>
										<div class="col-sm-8">
											<div class='form-control border-none'>採用担当者</div>
										</div>
									</div>

									<div class="form-group"><label class="col-sm-4 control-label">最終更新者採用担当者ID</label>
										<div class="col-sm-8">
											<div class='form-control border-none'><a href="#">live1234</a></div>
										</div>
									</div>

									<div class="form-group"><label class="col-sm-4 control-label">最終更新流入元担当者ID</label>
										<div class="col-sm-8">
											<div class='form-control border-none'>
												<a href="#">mynavi12345678</a>
											</div>
										</div>
									</div>
								</form>
							</div> 
							<!-- end form 3-->

							<div class="text-center mbottom15">
								<button class="btn btn-primary btn-sm">削除</button>
								<button class="btn btn-primary btn-sm">更新</button>
							</div>
						</div>
						<div>
							<div>
								<div class = "ibox">
									<div class="ibox-title">
										<h5>最終選考採用担当者</h5>
										<div class="ibox-tools">
											<a class="collapse-link">
												<i class="fa fa-chevron-up"></i>
											</a>
										</div>
									</div>
									<div class="ibox-content p-sm">
										<h3>面接官（（採用担当者））の登録</h3>
										<div>
											<div class="ibox-content bg-gray clearfix form-edit">

												<?php echo $this->Form->create('SelRecruiterHistories', array('class'=>'form-horizontal', 'type' => 'post', 'url' => array('controller' => 'sel_recruiter_histories','action' => 'add_simple'))); ?>

												<!--to do start1-->
												<div>
													<div class="col-lg-5"> 
														<div><label class='row'>部署名</label></div>

														<?php foreach($recDepartments as $parentId => $recDept): ?>
														<div class='form-group'>
															<?php $options = $recDept ?>
															<?php echo $this->Form->input("rec_department[{$parentId}]",array("options"=>$options, 'label'=>false, "class"=>'form-control')); ?>
														</div>
													<?php endforeach; ?>

												</div>

												<div class="col-lg-7">
													<div><label class='col-sm-6'>採用担当者</label></div>
													<div class='col-lg-8'>
														<?php echo $this->Form->input('rec_recruiter_id', array('label'=>false, 'class'=>'form-control')); ?>
														<?php echo $this->Form->hidden('sel_history_id', array('value' => $this->data['SelHistory']['id'])); ?>
													</div>
													<div class="col-lg-3">
														<button type="submit" class="btn btn-primary btn-sm">面接官に追加</button>
													</div>

												</div>

											</div>
										</form>
										<div class = "clear10"></div>
									</div>
									<div class = "clear10"></div>
								</div>

								<br>
								<h3>面接官（（採用担当者））選考履歴</h3>

								<table class="table table-bordered subcontents-sb-1">
									<thead>
										<tr>
											<th>採用担当者名</th>
											<th>評価ランク</th>
											<th>評価スコア</th>
											<th>評価コメント</th>
											<th class="actions">操作</th>
										</tr>
									</thead>

									<tbody>
										<?php foreach ($SelRecHistories as $SelRecHistory): ?>
										<?php echo $this->Form->create('SelRecruiterHistories', array( 'type' => 'post', 'url' => array('controller' => 'sel_recruiter_histories','action' => 'edit_simple'))); ?>
										<?php echo $this->Form->hidden('id', array('value' => $SelRecHistory['SelRecruiterHistory']['id'])); ?>
										<?php echo $this->Form->hidden('sel_history_id', array('value' => $this->data['SelHistory']['id'])); ?>
										<?php echo $this->Form->hidden('rec_recruiter_id', array('value' => $SelRecHistory['SelRecruiterHistory']['rec_recruiter_id'])); ?>
										<tr>
											<td>
												<?php echo $this->Html->link($SelRecHistory['RecRecruiter']['last_name']." ".$SelRecHistory['RecRecruiter']['first_name'], array('controller'=>'RecRecruiter','action' => 'index', $SelRecHistory['RecRecruiter']['id'])); ?>
											</td>
											<td>
												<?php $options = $evaluation_rank ?>
												<?php echo $this->Form->input("evaluation_rank",array('class'=>'form-control', "options"=>$options, 'label'=>false, 'value'=>$SelRecHistory['SelRecruiterHistory']['evaluation_rank'])); ?>
											</td>        
											<td><?php echo $this->Form->input( 'evaluation_score',array('class'=>'form-control', "type"=>"textbox" , 'label'=>false, 'value'=>$SelRecHistory['SelRecruiterHistory']['evaluation_score'])); ?>
											</td>
											<td><?php echo $this->Form->input( 'evaluation_comment',array('class'=>'form-control', "type"=>"textbox" , 'label'=>false, 'value'=>$SelRecHistory['SelRecruiterHistory']['evaluation_comment'])); ?>
											</td>
											<td class="hover-button actions-2bn">
												<div class='col-sm-6'>
												<?php $op = array('label'=>'更新', 'class'=>'btn btn-primary btn-xs pull-left row') ;?>
												<?php echo $this->Form->end($op); ?>
												</div>
												<div class=''>
												<?php echo $this->Form->postLink('解除', array('controller'=>'sel_recruiter_histories','action' => 'delete_simple', $SelRecHistory['SelRecruiterHistory']['id'], $this->data['SelHistory']['id']), array('class'=>'btn btn-default btn-xs cl-white', 'confirm' => __('Are you sure you want to delete # %s?', $SelRecHistory['SelRecruiterHistory']['id']))); ?>
												</div>
												<div class='clearfix'></div>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
								<!-- 
								<tbody>
									<tr >
										<td><a class = "text-navy" href="#">柏井 こたろー</a></td>
										<td>不合格</td>
										<td>50</td>
										<td>コメントコメント</td>
										<td></td>
									</tr>
									<tr class = "show-data">
										<td><a class = "text-navy" href="#">宮崎 範浩</a></td>
										<td> </td>
										<td></td>
										<td> </td>
										<td>
											<div class = "margin-lf10">
												<div class = "float-lf margin-right5"><button class="p4-show-fr-edit full-width btn btn-xs btn-primary show-data" id=''>評価入力</button></div>
												<div class = "float-lf"><button class="full-width btn btn-xs btn-primary">解除</button></div>
											</div>  
										</td>
									</tr>



									<tr class = "show-return hiden-return fr-hiden">
										<td><a class = "text-navy" href="#">宮崎 範浩</a></td>
										<td>
											<div>
												<select class="form-control select-w100" name="agent_id">
													<option>合格</option>
													<option>不合格</option>
													<option>その他</option>
												</select>
											</div>
										</td>
										<td><input type="number" class="form-control" value="75"></td>
										<td>
											<div><input type="text" class="form-control" value="text box"></div>
										</td>
										<td>
											<div class = "margin-lf10">
												<div class = "float-lf margin-right5"><button class="p4-save-edit full-width btn btn-xs btn-primary show-return hiden-return fr-hiden" id = "">更新</button></div>
												<div class = "float-lf"><button class="full-width btn btn-xs btn-primary">解除</button></div>
											</div>  
										</td>
									</tr>

									<tr class = "edit-return fr-hiden">
										<td><a class = "text-navy" href="#">宮崎 範浩</a></td>
										<td>合格</td>
										<td>75</td>
										<td> コメントコメント</td>
										<td>
											<div class = "margin-lf10">
												<div class = "float-lf"><button class="p4-edit-return full-width btn btn-xs btn-primary edit-return" id = "">修正</button></div>
											</div>  
										</td>
									</tr>

									<tr >
										<td><a class = "text-navy" href="#">宮崎 範浩</a></td>
										<td>合格</td>
										<td>75</td>
										<td>コメントコメント</td>
										<td>abc</td>
									</tr>

									<tr >
										<td><a class = "text-navy" href="#">土屋 則幸</a></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>

									<tr>
										<td><a class = "text-navy" href="#">三橋 和広</a></td>
										<td>合格</td>
										<td>74 </td>
										<td> コメントコメント</td>
										<td></td>
									</tr>

								</tbody>
							-->
						</table>                                      
						<!-- table -->
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- -----end tab-2------ -->


</div>
<!-- -----end tab-0----- -->
</div>
</div>
<div class="col-lg-4">
	<!--ibox 1-->
	<div class="ibox">
		<div class="ibox-title">
			<h5>求人票情報</h5>

			<div class="ibox-tools">
				<a class="collapse-link">
					<i class="fa fa-chevron-up"></i>
				</a>
			</div>
		</div>
		<div class="ibox-content clearfix" style="display: block;">

			<table class="table table-bordered no-margin-bottom subcontents-sb-1">
				<tbody>
					<tr>
						<th>求人票ID</th>
						<td>ABC123456</td>
					</tr>      
					<tr>
						<th>求人票タイトル</th>
						<td>求人票タイトル</td>
					</tr>   
					<tr>
						<th>募集要項</th>
						<td>仕事の内容を掲載</td>
					</tr>   
					<tr>
						<th>職種タイプ</th>
						<td>営業</td>
					</tr>   
					<tr>
						<th>初任給</th>
						<td>24万円</td>
					</tr>   
					<tr>
						<th>待遇</th>
						<td>待遇内容を掲載</td>
					</tr>   
					<tr>
						<th>応募資格</th>
						<td>応募資格を掲載</td>
					</tr>   
					<tr>
						<th>募集人数</th>
						<td>10人</td>
					</tr>   
					<tr>
						<th>募集期限</th>
						<td>仕事の内容を掲載</td>
					</tr>   
					<tr>
						<th>公開開始日時</th>
						<td>YYYY/MM/DD</td>
					</tr>   
					<tr>
						<th>募集エリア</th>
						<td>yyyy /mm /dd hh:mm</td>
					</tr>               
				</tbody>
			</table>

		</form>
	</div>
	<!--end table 1-->
</div>
<!--end ibox 1-->


<!--ibox 2-->
<div class="ibox">
	<div class="ibox-title">
		<h5>自社情報</h5>

		<div class="ibox-tools">
			<a class="collapse-link">
				<i class="fa fa-chevron-up"></i>
			</a>
		</div>
	</div>
	<div class="ibox-content clearfix" style="display: block;">

		<table class="table table-bordered no-margin-bottom subcontents-sb-1">
			<tbody>
				<tr>
					<th>求人票ID</th>
					<td>株式会社ネオネオ</td>
				</tr>      
				<tr>
					<th>都道府県</th>
					<td>東京都</td>
				</tr>    
				<tr>
					<th>市区町村</th>
					<td>新宿区</td>
				</tr>    
				<tr>
					<th>契約期間</th>
					<td>2017/11/30</td>
				</tr>    
				<tr>
					<th>設立年月日</th>
					<td>2000年11月</td>
				</tr>    
				<tr>
					<th>従業員数</th>
					<td>200人</td>
				</tr>    
				<tr>
					<th>売上高</th>
					<td>100,000,000円</td>
				</tr>    
				<tr>
					<th>業種</th>
					<td>IT・通信・インターネット</td>
				</tr>    
				<tr>
					<th>市場</th>
					<td></td>
				</tr>    
				<tr>
					<th>備考</th>
					<td></td>
				</tr>                                       
			</tbody>
		</table>




	</div>

</div>
<!--end ibox 2-->
<!--end table 2-->
</div>
</div>

</div>
<div class = "clear20"></div>


<!-- -------------end content------------- -->
<!-- -------------end content------------- -->
<!-- -------------end content------------- -->
<!-- -------------end content------------- -->
<!-- -------------end content------------- -->
<?php echo $this->element('b_back_nav')?>












































<div class="selHistories form">
	<?php echo $this->Form->create('SelHistory'); ?>
	<fieldset>
		<legend><?php echo __('Edit Sel History'); ?></legend>
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('job_vote_id');
		echo $this->Form->input('can_candidate_id');
		echo $this->Form->input('screening_stage_id');
		echo $this->Form->input('select_status_id', array( 'options' => $selectJudgmentType ));
		echo $this->Form->input('select_option_id', array( 'options' => $selectOption ));
		echo $this->Form->input('comment');
		echo $this->Form->input('status', array( 'options' => $status ));
		echo $this->Form->input('visited_info');
		echo $this->Form->input('annual_income');
		echo $this->Form->input('start_date');
		echo $this->Form->input('end_date');
		echo $this->Form->input('influx_propriety');
		echo $this->Form->input('candidate_propriety');
		echo $this->Form->input('last_modified_type', array( 'options' => $lastModifiedType ));
		echo $this->Form->input('rec_recruiter_id');
		echo $this->Form->input('inf_staff_id');
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>



	<fieldset style="border:dashed 1px; padding:10px;margin-top:50px">
		<legend><?php echo h("最終選考採用担当者"); ?></legend>

		<h3><?php echo h("面接官（採用担当者）の登録"); ?></h3>



		<h3><?php echo h("面接官（採用担当者）選考履歴"); ?></h3>
		<table cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th>採用担当者名</th>
					<th>評価ランク</th>
					<th>評価スコア</th>
					<th>評価コメント</th>
					<th class="actions">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($SelRecHistories as $SelRecHistory): ?>
				<?php echo $this->Form->create('SelRecruiterHistories', array( 'type' => 'post', 'url' => array('controller' => 'sel_recruiter_histories','action' => 'edit_simple'))); ?>
				<?php echo $this->Form->hidden('id', array('value' => $SelRecHistory['SelRecruiterHistory']['id'])); ?>
				<?php echo $this->Form->hidden('sel_history_id', array('value' => $this->data['SelHistory']['id'])); ?>
				<?php echo $this->Form->hidden('rec_recruiter_id', array('value' => $SelRecHistory['SelRecruiterHistory']['rec_recruiter_id'])); ?>
				<tr>
					<td>
						<?php echo $this->Html->link($SelRecHistory['RecRecruiter']['last_name']." ".$SelRecHistory['RecRecruiter']['first_name'], array('controller'=>'RecRecruiter','action' => 'index', $SelRecHistory['RecRecruiter']['id'])); ?>
					</td>
					<td>
						<?php $options = $evaluation_rank ?>
						<?php echo $this->Form->input("evaluation_rank",array("options"=>$options, 'label'=>false, 'value'=>$SelRecHistory['SelRecruiterHistory']['evaluation_rank'])); ?>
					</td>        
					<td><?php echo $this->Form->input( 'evaluation_score',array( "type"=>"textbox" , 'label'=>false, 'value'=>$SelRecHistory['SelRecruiterHistory']['evaluation_score'])); ?>
					</td>
					<td><?php echo $this->Form->input( 'evaluation_comment',array( "type"=>"textbox" , 'label'=>false, 'value'=>$SelRecHistory['SelRecruiterHistory']['evaluation_comment'])); ?>
					</td>
					<td class="actions">
						<?php echo $this->Form->end('更新'); ?>
						<?php echo $this->Form->postLink('解除', array('controller'=>'sel_recruiter_histories','action' => 'delete_simple', $SelRecHistory['SelRecruiterHistory']['id'], $this->data['SelHistory']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $SelRecHistory['SelRecruiterHistory']['id']))); ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>


</fieldset>
</div>

