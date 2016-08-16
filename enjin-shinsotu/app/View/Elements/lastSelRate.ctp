<!--BLOCK 8-->
												<h5>イベントスケジュールと出欠簿</h5>
												<div class="ibox-content">
													<div class="row">
														<div class="col-md-3">
															<label for="">イベント</label><br>
															<?php echo $this->Form->input('evEvent_id', array( 
																'options' => $evEvents,
																'class'=>'btn btn-white btn-sm toast-bottom-full-width select_width',
																'label'=>false, 
																'div'=>false,
																'id' => 'ev_event8' )
																);?>
															</div>
															<div class="col-md-3">
																<label for="">開催日程</label><br>
																<?php echo $this->Form->input('evEvent_id', array( 
																	'options' => $evSchedule,
																	'class'=>'btn btn-white btn-sm toast-bottom-full-width select_width',
																	'label'=>false, 
																	'div'=>false,
																	'id' => 'ev_schedule8' )
																	);?>
																</div>
																<div class="mt23 col-md-6">
																	<label for="">&nbsp;</label>
																	<button  class="btn btn-primary btn-sm" type="submit">印刷</button>
																</div>
															</div>
															<div class="row">
																<div id='eventDetail'>
																<?php echo $this->element('eventDetail'); ?>
																</div>
																<div id="eventList8">
																	<?php echo $this->element('eventList8') ?>
																</div>
														</div>
														</div>
														<!--#BLOCK 8-->