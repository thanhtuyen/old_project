						
						<h5>　　イベント評価後スコア別　　候補者x選考履歴リストアップ</h5>
						<div class="ibox-content">
							<div class="row">
								<div class="col-md-3">
									<label for="">イベント</label><br>
									<?php echo $this->Form->input('evEvent_id', array( 
										'options' => $evEvents,
										'class'=>'btn btn-white btn-sm toast-bottom-full-width select_width block5',
										'id' => 'ev_event',
										'label'=>false, 
										'div'=>false,
										'default' => (isset($ev_event)) ? $ev_event : $ev_first )
										);?>
									</div>
									<div class="col-md-3">
										<label for="">評価</label><br>
										<?php echo $this->Form->input('evEvent_id', array( 
											'options' => $evHistory,
											'class'=>'btn btn-white btn-sm toast-bottom-full-width select_width block5',
											'id' => 'after_score',
											'label'=>false, 
											'div'=>false,
										'default' => (isset($after_score)) ? $after_score : 0  )
											);?>
										</div>
										<div class="col-md-6">
											<label for="">選考履歴</label><br>
											<?php echo $this->Form->input('selHistory', array( 
												'options' => array(__('No'),__('Yes')),
												'class'=>'btn btn-white btn-sm toast-bottom-full-width block5',
												'id' => 'sel_check',
												'label'=>false, 
												'div'=>false,
										'default' => (isset($sel_check)) ? $sel_check : 0 )
												);?>
											</div>
										</div>

										<div class="row">
											<div class="col-md-2">
												<select class="btn btn-white btn-sm toast-bottom-full-width">
													<option value="1">チェックのみ</option>
													<option value="2">すべて</option>
												</select>
											</div>
											<div class="col-md-2">
												<button  class="btn btn-primary btn-xs" type="submit">メール</button>
											</div>
										</div>

										<div class="table-responsive">
											<table class="table table-striped">
												<tbody>
													<tr>
														<th>
														</th>
														<th>候補者名</th>               
														<th>評価</th>
														<th>選考履歴</th>
													</tr>
													<?php foreach( $evScore as $score_key => $score_val ): ?>
														<?php foreach( $score_val as $key => $val ): ?>
															<?php if( $key == 'name' ) continue; ?>
														
															<tr>
															<td>
																<div class="i-checks"><label> <input type="checkbox" value="" > <i></i></label></div>
															</td>
															<td><?php echo $score_val['name'] ?></td>
															<td><?php echo $evHistory[ $val['after_score'] ] ?></td>
															<td><?php echo $screening_stages[ $val['screening_stage_id'] ] ?>　｜　<?php echo $select_status_id[ $val['select_status'] ] ?></td>
														</tr>	

														<?php endforeach; ?>
													<?php endforeach; ?>
													
												</tbody>
											</table>
										</div>
										</div>
									