
<?php 
echo $this->Html->css('plugins/fullcalendar/fullcalendar.css');
echo $this->Html->css('bootstrap/dashboard_08'); 
?>
<div class="wrapper wrapper-content animated fadeInRight">
	<h2 class="page-heading">選考履歴サマリ</h2>
	<div class="ibox-content">
		

			<!--BLOCK 1-->
			<div class="table-responsive">
				<?php $judge_count = count( $select_judgment_type ); ?>
			<?php foreach( $summaryData['result'] as $res_key => $results ): ?>
		<h5><a href="/JobVotes/view/<?php echo $res_key ?>"><?php echo $jobVotes[ $res_key ]  ?></a></h5>

				<table class="table table-striped">
					<tbody>
						<tr>
							<th>選考段階</th>
							<?php 
								$scr_count = 0;
								foreach( $summaryData['screening_stage'] as $scr_key => $screening_stage ):
									$scr_count++;
									$summaryData['screening_stage'][$scr_key]['count'] = $scr_count;

								 ?>
								<th colspan="<?php echo $judge_count ?>"><?php echo $screening_stage['name']; ?></th> 
							<?php endforeach; ?>
						</tr>

						<?php 
							$first_flg = 0; 
							$scr_total = count( $summaryData['screening_stage'] );
							$target_count = 0;


							if( !empty( $summaryData['target'][$res_key] ) ) : 

								$target_count = count( $summaryData['target'][$res_key] );

							foreach( $summaryData['target'][$res_key] as $target_key => $target_val ): 

								$str = '';
								$today = date( 'y-m-d' );
								foreach ($target_val['date'] as $key => $value) {

									$date = date( 'y-m-d', strtotime( $key ) ); 
									$seconddiff = strtotime( $date ) - strtotime( $today ); 
 
								    // 日数に変換
								    $daydiff = $seconddiff / (60 * 60 * 24); 

								    if( $daydiff >= 0 && $daydiff <= 7 ) {
								    	$color = 'bg_pink';
								    } else if( $daydiff >= 0 && $daydiff <= 14 ) {
								    	$color = 'bg_lorange text-justify';
								    } else {
								    	$color = '';
								    }

									$str .= $key. 'までに'. 
											$target_val['name']. 
											$screening_stage_type[ $target_val['select_judgment_type'] ].'の'. 
											$select_judgment_type[ $target_val['target_select_id'] ]. 'を'. $value. '名' ; 

									$target_number[$target_key] = $value;

										

								}

								?>

								 <tr>
								<?php if( $first_flg == 0 ): ?>

									<th rowspan="<?php echo $target_count; ?>">目標</th>
								<?php endif; ?>

								<?php

								$total = 0;
								$count_ids = array();
								$str_color = '';
								switch ( $target_val['select_judgment_type'] ) {
									case '0': //以前
										$to = $summaryData['screening_stage'][$target_key]['count'];
										$to3 = $to * $judge_count;

										for ($i=0; $i <= $to ; $i++) { 
											foreach ($summaryData['screening_stage'] as $key => $value) {
												if( $value['count'] == $i ) { 
													$count_ids[$i] = $key;
												}else if( empty( $count_ids[$i] ) ) {
													$count_ids[$i] = 0;

												}

											}
											
										}


										for ($i=0; $i <= $to ; $i++) { 
										    if( !empty( $results[ $count_ids[$i] ][ $target_val['target_select_id'] ] ) )
											$total += $results[ $count_ids[$i] ][ $target_val['target_select_id'] ];
											
										}

										
										if( $total < $target_number[$target_key] ) {
											$str_color = 'color_red';
										} else {
											$color = '';
										}


										$str = $str. ' 現在<span class="'.$str_color.'">'.$total.'</span>名<br/>';

										echo '<td colspan="'.$to3.'" class="'.$color.'">'. $str. '</td>';
										for ($i=$to; $i < $scr_total ; $i++) { 
											echo '<td colspan="'.$judge_count.'">&nbsp;</td>';				

										}
										break;

									case '1': //以降
										$to = $scr_total - $summaryData['screening_stage'][$target_key]['count'] + 1;
										
										$to3 = $to * $judge_count;

										for ($i=$to; $i <= $scr_total ; $i++) { 
											foreach ($summaryData['screening_stage'] as $key => $value) {
												if( $value['count'] == $i ) { 
													$count_ids[$i] = $key;
												}else if( empty( $count_ids[$i] ) ) {
													$count_ids[$i] = 0;

												}

											}
										}

										$j = $scr_total-$to-1;
										for ($i=$j; $i <= $scr_total ; $i++) { 

											if( !empty( $results[ $count_ids[$i] ][ $target_val['target_select_id'] ] ) )
											$total += $results[ $count_ids[$i] ][ $target_val['target_select_id'] ];
										}

										if( $total < $target_number[$target_key] ) {
											$str_color = 'color_red';
										} else {
											$color = '';
										}

										if( $total < $target_number[$target_key] ) {
											$str_color = 'color_red';
										} else {
											$color = '';
										}

										$str = $str. ' 現在<span class="'.$str_color.'">'.$total.'</span>名<br/>';

										for ($i=$to; $i < $scr_total ; $i++) { 
											echo '<td colspan="'.$judge_count.'">&nbsp;</td>';				

										}
										echo '<td colspan="'.$to3.'" class="'.$color.'">'. $str. '</td>';

										break;

									case '2': //限定
										$to = $summaryData['screening_stage'][$target_key]['count'];

										for ($i=1; $i <= $scr_total ; $i++) { 
											if( $i == $to) {
												echo '<td colspan="'.$judge_count.'" class="'.$color.'">'. $str. '</td>';

											} else {
												echo '<td colspan="'.$judge_count.'">&nbsp;</td>';				

											}


											foreach ($summaryData['screening_stage'] as $key => $value) {
												if( $value['count'] == $to ) { 
													$count_ids[$to] = $key;
												}

											}

											 
											if( !empty( $results[ $count_ids[$to] ][ $target_val['target_select_id'] ] ) )
											$total += $results[ $count_ids[$to] ][ $target_val['target_select_id'] ];
											

											if( $total < $target_number[$target_key] ) {
												$str_color = 'color_red';
											} else {
												$color = '';
											}

											if( $total < $target_number[$target_key] ) {
												$str_color = 'color_red';
											} else {
												$color = '';
											}

											$str = $str. ' 現在<span class="'.$str_color.'">'.$total.'</span>名<br/>';

										}

										break;
									
									default:
										# code...
										break;
							}

						?>
						 
							</tr>
														
						<?php $first_flg = 1 ?>
						<?php endforeach; ?>
						<?php else: ?>
							<th rowspan="<?php echo $target_count; ?>">目標</th>
							<?php foreach( $summaryData['screening_stage'] as $scr_stg ):	 ?>
								<td colspan="<?php echo $judge_count ?>"></td> 
							<?php endforeach; ?>

						<?php endif; ?>
						

							<tr class="text-nowrap">
								<th rowspan="2">実数</th>
								<?php foreach ( $summaryData['screening_stage'] as $screening_stage ): ?>
									<?php foreach ( $select_judgment_type as $judge_key => $judge_val ): ?>
										<td><?php echo $judge_val ?></td>
									<?php endforeach; ?>
								<?php endforeach; ?>
							</tr>
							<tr>
								<?php foreach ( $summaryData['screening_stage'] as $scr_key => $screening_stage ): ?>

								<?php 
						            $crear = 0;
						            $no_crear = 0;
						            $other = 0;

						            if( !empty( $results[ $scr_key ] ) ) {

						                foreach ($results[ $scr_key ] as $key => $val) {
						                    if( $key == 5 ) {
						                        $crear += $val;
						                    } else if( $key == 6 ) {
						                        $no_crear += $val;
						                    } else {
						                        $other += $val;
						                    }
						                }
						            }
					            ?>
					            <?php foreach ( $select_judgment_type as $judge_key => $judge_val ): ?>
					            	<?php if( !empty( $results[$scr_key][$judge_key] ) ): ?>
										<td><a href="/SelHistories/index?job_vote_id=<?php echo $res_key ?>&screening_stage_id=<?php echo $scr_key ?>&select_status_id=<?php echo $judge_key ?>&start_date=&end_date="><?php echo $results[$scr_key][$judge_key]; ?></a></td>		
									<?php else: ?>
										<td><a href="/SelHistories/index?job_vote_id=<?php echo $res_key ?>&screening_stage_id=<?php echo $scr_key ?>&select_status_id=<?php echo $judge_key ?>&start_date=&end_date=">0</a></td>
									<?php endif; ?>
									<?php endforeach; ?>
								<?php endforeach; ?>

							</tr>

						</tbody>
					</table>

				<?php endforeach; ?>

				</div>
			</div>
			<!--#BLOCK 1-->
			<div id="block2_3">
			<?php echo  $this->element('attr');  ?>
			</div>
			<!--BLOCK 4-->
			<h5>選考履歴と採用担当者選考履歴と候補者情報のリスト</h5>
			<div class="ibox-content">
				

								<?php foreach( $histCand as $hist_key => $hist_val ): ?>
								<?php if( $hist_key == 'past' ) continue; ?>
					<div class="table-responsive">
						<table class="table table-striped">
							<tbody>
								<tbody>
									<tr>
										<th>候補者名</th>
										<th>選考段階</th>               
										<th colspan="2">面接予定日</th>
									<?php foreach( $screening_stages as $scr_key => $screening_stage ): ?>
											<?php $scr_ids[] = $scr_key; ?>
											<th><?php echo $screening_stage ?>評価</th>
									<?php endforeach; ?>
										<th>評価</th>
									</tr>

										<?php foreach( $hist_val as $key => $val ): ?>
									<?php if( $hist_key == 'past' ) continue; ?>
									<tr>

										<?php if( $key == 'name' ) continue; ?>

									<?php if( $val['select_status'] < 3 ) {
										$str = '設定中';
									} else if( $val['select_status'] == 3 ) {
										$str = '設定済';
									} else {
										$str = '';
									} 


									if( $val['select_status'] < 5 ) {
										$score_str = '未評価';
									} else if( $val['select_status'] == 5 ){
										$score_str = '合格';
									} else if( $val['select_status'] == 6 ) {
										$score_str = '不合格';
									} else {
										$score_str = '';
									}

									?>
									
										<td><?php echo $val['name'] ?></td>
										<td><?php echo $screening_stages[ $val['screening_stage_id'] ] ?>　｜　<?php echo $str ?></td>
										<td><?php echo $val['start_date'] ?> </td>
										<td>

											<?php foreach( $val['recruiter'] as $rec_key => $rec_val ): ?>
												<?php echo $rec_val['name']; ?>
												<?php echo $assign_situation[ $rec_val['assign_situation_id'] ]; ?><br>

											<?php endforeach; ?>
										</td>

									<?php foreach( $screening_stages as $scr_key => $screening_stage ): ?>

										<?php if( empty( $histCand['past'][$hist_key][$key][$scr_key] ) ): ?>
											<td></td>
										<?php 
											continue;
											endif; 
										?>
										<?php if( !in_array( $scr_key, $scr_ids ) ) continue; ?>

										<?php $past_val = $histCand['past'][$hist_key][$key][$scr_key]; ?>
											<td>
												<?php if( isset( $past_val['select_status_id'] ) ) echo $select_status_id[$past_val['select_status_id']] ?>&nbsp;
												<?php if( isset( $select_option[ $past_val['select_option_id'] ] ) ) echo $past_val['select_option_id'] ?>
												<?php if( isset( $past_val['comment'] ) ) echo $past_val['comment'] ?>&nbsp;

											</td>
									<?php endforeach; ?>										
									
										<td><?php echo $score_str; ?></td>
									</tr>
								<?php endforeach; ?>
									
								</tbody>
							</table>
								
						</div>
								<?php endforeach; ?>
						<!--#BLOCK 4-->

						<div id="block5">
							<?php echo $this->element('HistCandidateByEvScore') ?>
						</div>

										<!--BLOCK 6-->
										<h5>採用担当者別　　最終選考通過率リスト</h5>
										<div class="ibox-content">
											<div class="row">
												<div class="col-md-7">
													<div class="table-responsive">
														<table class="table table-striped">
															<tbody>
																<tr>
																	<th>面接官</th>               
																	<th>選考通過</th>
																	<th>不合格者</th>
																	<th>最終選考通過率</th>
																	<th>内定辞退</th>
																</tr>
																<?php foreach( $LastSelRate as $rate_key => $rate_val ): ?>
																<?php $rate = number_format( $rate_val['pass_count']/$rate_val['all_count'] * 100, 1 );  ?>
																<tr>
																	<td><?php echo $rate_val['name'] ?></td>
																	<td><?php echo $rate_val['all_count'] ?></td>
																	<td><?php echo $rate_val['pass_count'] ?></td>
																	<td><span><?php echo $rate_val['pass_count'] ?></span>／<?php echo $rate_val['all_count'] ?>　<?php echo $rate ?>％</td>
																	<td><span><?php echo $rate_val['cancel_count'] ?></span>／<?php echo $rate_val['pass_count'] ?></td>
																</tr>
																<?php endforeach; ?>
															</tbody>
														</table>
													</div>
												</div>
												<div class="col-md-5 h31-c">
												<?php foreach( $LastSelRate as $rate_key => $rate_val ): ?>
													<div class="mt5">
														<label for="">最終選考通過率グラフ</label><br>
														<div class="col-md-4 color_text">
															<?php echo $rate_val['name'] ?>
														</div>
														<div class="col-md-8">
															<div class="progress bg_dgrey m0">
																<div style="width: <?php echo $rate ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo $rate ?>" role="progressbar" class="progress-bar bg_grey">
																	<span class="sr-only"><?php echo $rate ?>% Complete</span>
																</div>
															</div>
														</div>
													</div>

												<?php endforeach; ?>
												</div>
											</div>
										</div>
										<!--#BLOCK 6-->


										<!--BLOCK 7-->
										<h5>イベント参加履歴リスト</h5>
										<div class="ibox-content">
											

												<div class="table-responsive">
															<?php foreach( $EvHistList as $evHist_key => $evHist_val ): ?>
													<table class="table table-striped">
														<tbody>
															<tr>
																<th>イベント</th>
																<th>日程</th>               
																<th>開催場所</th>
																<th>予約中</th>
																<th>参加申込済</th>
																<th>キャンセル</th>
																<th>欠席</th>
															</tr>
																	<?php foreach( $evHist_val as $key => $val ): ?>
																	<?php if( $key == 'name' ) continue; ?>
																	<?php foreach( $val as $ky => $vl ): ?>
																	<?php if( $ky == 'name' ) continue; ?>
																<tr>
																	<td rowspan="3" class="bg_white va-m"><?php echo $evHist_val['name'] ?></td>
																	<td><?php echo $ky; ?></td>
																	<td><?php echo $vl['venue'] ?></td>
																	<td><?php echo $vl['reserve_count'] ?></td>
																	<td><?php echo $vl['regist_count'] ?></td>
																	<td><?php echo $vl['cancel_count'] ?></td>
																	<td><?php echo $vl['absence_count'] ?></td>
																</tr>
																	<?php endforeach; ?>
																	<?php endforeach; ?>
															
														</tbody>
													</table>
															<?php endforeach; ?>
												</div>
											</div>
												<!--#BLOCK 7-->
												<div id='block7'>
												<?php echo $this->element('lastSelRate'); ?>
												</div>
														<!-------------------------->
														<div class="">イベントカレンダー</div>
														<div class="ibox-content">
															<div class="row">

																<div id="calendar"></div>
															</div>
														</div>
														<!-------------------------->
														<h5>定員割れイベント開催日程リスト&アラート</h5>
														<div class="ibox-content">
															<div class="table-responsive">
																<table class="table table-striped">
																	<tbody>
																		<tr>
																			<th>イベント名</th>
																			<th>開催日</th>
																			<th>応募締切日</th>
																			<th>定員</th>
																			<th>申込数</th>
																			<th>ターゲット</th>
																			<th>ターゲットステータス</th>
																		</tr>
																		<?php foreach( $CapCrackSchedule as $Cap_key => $Cap_val ): ?>
																			<?php foreach( $Cap_val as $key => $val ): ?>
																			<?php if( $key == 'name' ) continue; ?>
																			
																			<?php
																			  $class = ''; 
																			  if( $val['capacity'] >= $val['count'] ) {
																				$class = 'bg_white color_red';
																			  } 
																			?>
																				<tr>
																					<td><?php echo $Cap_val['name'] ?></td>
																					<td><?php echo $val['holding_date'] ?></td>
																					<td><?php echo $val['wanted_deadline'] ?></td>
																					<td><?php echo $val['capacity'] ?></td>
																					<th class="<?php echo $class ?>"><?php echo $val['count'] ?></td>
																					<td><?php echo $val['screening_stage_name'] ?><?php echo $screening_stage_type[ $val['screening_stage_type'] ] ?></td>
																					<td><?php echo $select_status_id[ $val['target_select_id'] ] ?></td>
																				</tr>	
																			<?php endforeach; ?>
																		<?php endforeach; ?>
																	</tbody>
																</table>
															</div>
														</div>
														<!-------------------------->
														<h5>媒体別 申込数と採用率</h5>
														<div class="ibox-content">
															<div class="row">
																<div class="col-md-2 b">流入元</div>
																<div class="col-md-1 b">申込数</div>
																<div class="col-md-1 b">採用数</div>
																<div class="col-md-1 b">採用率</div>
																<div class="col-md-7"></div>
															</div>

														<?php 
															$total = 0;
															$total_props = 0;
															$total_rate = 0;
															foreach($RefNumberOfApp as $refNumber_key => $refNumber_val ) {
																$total += $refNumber_val['total'];
																$total_props += $refNumber_val['prosp_count'];


															}

															if( $total != 0 ) {
																$total_rate = $total_props / $total;
															} 															 
														?>

															<div class="row">
																<div class="col-md-2">トータル</div>
																<div class="col-md-1 color_blue"><?php echo $total ?></div>
																<div class="col-md-1 color_blue"><?php echo $total_props ?></div>
																<div class="col-md-1 color_blue"><?php echo $total_rate ?>%</div>
																<div class="col-md-7">
																	<div class="progress bg_dgrey -xs">
																		<div style="width: <?php echo $total_rate ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo $total_rate ?>" role="progressbar" class="progress-bar bg_grey">
																			<span class="sr-only"><?php echo $total_rate ?>% Complete</span>
																		</div>
																	</div>
																</div>
															</div>

															<?php foreach($RefNumberOfApp as $refNumber_key => $refNumber_val ):  ?>
																<div class="row">
																	<div class="col-md-2"><?php echo $refNumber_val['name'] ?>マイナビ</div>
																	<div class="col-md-1 color_blue"><?php echo $refNumber_val['total'] ?></div>
																	<div class="col-md-1 color_blue"><?php echo $refNumber_val['prosp_count'] ?></div>
																	<div class="col-md-1 color_blue"><?php echo $refNumber_val['rate'] ?>%</div>
																	<div class="col-md-7">
																		<div class="progress bg_dgrey -xs">
																			<div style="width: <?php echo $refNumber_val['rate'] ?>%" aria-valuemax="25" aria-valuemin="0" aria-valuenow="<?php echo $refNumber_val['rate'] ?>" role="progressbar" class="progress-bar bg_grey">
																				<span class="sr-only"><?php echo $refNumber_val['rate'] ?>% Complete</span>
																			</div>
																		</div>
																	</div>
																</div>
															<?php endforeach; ?>

														</div>
														<!-------------------------->
														<h5>求人票別採用コスト</h5>
														<div class="ibox-content">
															<div class="table-responsive">
																<table class="table table-striped">
																	<tbody>
																		<tr>
																			<th>求人票</th>
																			<th>内定数</th>
																			<th>固定契約</th>
																			<th>年収割合契約</th>
																			<th>年間契約</th>
																			<th>イベント開催費用</th>
																			<th>トータル</th>
																		</tr>
																		<?php foreach( $RecruitCost as $cost_key => $cost_val ): ?>
																		<?php 
																			$count = 0;
																			if( $cost_val['count1'] != 0 ) {
																				$count += $cost_val['fixed_unit_price'];

																			}
																			if( $cost_val['count2'] != 0 ) {
																				$count += $cost_val['unlimited_fixed_annual'];
																				
																			}
																			if( $cost_val['count3'] != 0 ) {
																				$count += $cost_val['income_ratio'];
																				
																			}
																			$count += $cost_val['holding_cost'];


																		 ?>
																		<tr>
																			<td><?php echo $cost_val['name'] ?></td>
																			<td><?php echo $cost_val['count'] ?></td>
																			<td><?php echo $cost_val['unlimited_fixed_annual'] ?>
																				(<?php echo $cost_val['count2'] ?>)</td>
																			<td><?php echo $cost_val['income_ratio'] ?>
																				(<?php echo $cost_val['count3'] ?>)</td>
																			<td><?php echo $cost_val['fixed_unit_price'] ?>
																				(<?php echo $cost_val['count1'] ?>)</td>
																			<td><?php echo $cost_val['holding_cost'] ?></td>
																			<td><?php echo $count ?></td>
																		</tr>
																		<?php endforeach; ?>
															</tbody>
														</table>
													</div>
													<!-------------------------->
													<?php echo $this->element('allocateList'); ?>
											<!-------------------------->

										</div>

										<!-- Custom and plugin javascript -->
										<?php echo $this->Html->script('inspinia.js'); ?>
										<?php echo $this->Html->script('plugins/pace/pace.min.js'); ?>

										<!-- iCheck -->
										<?php echo $this->Html->script('plugins/iCheck/icheck.min.js'); ?>

										<!-- Peity -->
										<?php echo $this->Html->script('plugins/peity/jquery.peity.min.js'); ?>
										<!-- Calendar -->
										<?php echo $this->Html->script('plugins/fullcalendar/moment.min.js'); ?>
										<?php echo $this->Html->script('plugins/fullcalendar/fullcalendar.min.js'); ?>
										<?php echo $this->Html->script('plugins/fullcalendar/lang-all.js'); ?>
										<script>
											$(document).ready(function(){
    //checkbox group
    $('.cbgroup').click(function(){
    	var tmp=this.checked;
    	$(this).parents("table").find("input[type=checkbox]").each(function(){
    		$(this).prop("checked", tmp);
    	});
    });
	//progress adjustment
	$('.progress').each(function (){
		var tmp=$(this).children(0).attr("aria-valuemax");
		if(tmp > 0)
			$(this).width(tmp+"%");
	});

        /* initialize the calendar
        -----------------------------------------------------------------*/
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $('#calendar').fullCalendar({
        	header: {
        		left: 'prev,next today',
        		center: 'title',
        		right: ''
        	},
        	lang: 'ja',
        	editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function() {
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },
            events: [
            <?php $count = count( $evCalender ) ?>
            <?php foreach( $evCalender as $calender_key => $calender_val ): ?>
		        <?php foreach( $calender_val['EvSchedule'] as $key => $val ): ?>
		        <?php $holding_date = date_parse( $val['holding_date'] ); ?>
		        <?php $end_date = date_parse( $val['end_date'] ); ?>
            {

            	title: <?php echo "'".$calender_val['EvEvent']['name']."'" ?>,
            	start: new Date( <?php echo $holding_date['year'] ?>, <?php echo $holding_date['month'] ?>, <?php echo $holding_date['day'] ?>,
            	                 <?php echo $holding_date['hour'] ?>, <?php echo $holding_date['minute'] ?>, <?php echo $holding_date['second'] ?>), 
            	end: new Date(<?php echo $end_date['year'] ?>, <?php echo $end_date['month'] ?>, <?php echo $end_date['day'] ?>,
            	                 <?php echo $end_date['hour'] ?>, <?php echo $end_date['minute'] ?>, <?php echo $end_date['second'] ?>),
            	<?php if( $holding_date['year'] == $end_date['year'] && 
            			  $holding_date['month'] == $end_date['month'] && 
            			  $holding_date['day'] == $end_date['day'] ): ?>
            	allDay: false,
            	<?php endif; ?>
            	url: '/EvHistories/edit/<?php echo $val["id"] ?>'

            },

	            <?php endforeach; ?>
            <?php endforeach; ?>
           
            ]
        });
});
</script>

<script>
//候補者属性表取得API  can_attr
$(document).on('change','#can_attr',function(){
    if($('#can_attr').val() == ''){

    }

    var _url = '<?php echo $this->webroot;?>CanCandidates/getAttributeStats/' + $('#can_attr option:selected').val();
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: _url,
        success: function(res){
            if(res) {  
                    
                    $('div#block2_3 *').remove();
                    $('div#block2_3').append(res.html);

            }
        }
    });
});

$(document).on('change','.block5',function(){

    var _url = '<?php echo $this->webroot;?>sel_histories/getHistCandidateByEvScoreAPI?ev_event='+ $('#ev_event option:selected').val() +'&after_score='+ $('#after_score option:selected').val()+'&sel_check=' + $('#sel_check option:selected').val();
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: _url,
        success: function(res){
            if(res) {  
                    console.log(res.html);
                    $('div#block5 *').remove();
                    $('div#block5').append(res.html);

            }
        }
    });
});


$(document).on('change','#ev_event8',function(){
    if($('#ev_event8').val() == ''){
        $('#rec_recruiter > option').remove();
        $('#rec_recruiter').append($('<option>').html('select').val(''));

        return;
    }
    var _url = '<?php echo $this->webroot;?>EvSchedules/listsAPI/' + $('#ev_event8 option:selected').val();
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: _url,
        success: function(res){
            if(res) {  
                    $('#ev_schedule8 > option').remove();
                    $.each(res, function(i, val) {
                       $('#ev_schedule8').append($('<option>').html(val).val(i));
                    });

            }
        }
    });
});


$(document).on('change','#ev_event8',function(){

    var _url = '<?php echo $this->webroot;?>EvEvents/getDetailAPI/'+ $('#ev_event8 option:selected').val();
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: _url,
        success: function(res){
            if(res) {  
                    $('div#eventDetail *').remove();
                    $('div#eventDetail').append(res.html);

            }
        }
    });

        var _url = '<?php echo $this->webroot;?>EvSchedules/getScheduleCandidateAPI/'+ $('#ev_schedule8 option:selected').val();
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: _url,
        success: function(res){
            if(res) {  
                    console.log(res.html);
                    $('div#eventList8 *').remove();
                    $('div#eventList8').append(res.html);

            }
        }
    });

});

$(document).on('change','#ev_schedule8',function(){

    var _url = '<?php echo $this->webroot;?>EvSchedules/getScheduleCandidateAPI/'+ $('#ev_schedule8 option:selected').val();
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: _url,
        success: function(res){
            if(res) {  
                    console.log(res.html);
                    $('div#eventList8 *').remove();
                    $('div#eventList8').append(res.html);

            }
        }
    });
});


$(document).on('change','#jobVote12',function(){

    var _url = '<?php echo $this->webroot;?>RefererCompanies/getAllocateListAPI/'+ $('#jobVote12 option:selected').val();
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: _url,
        success: function(res){
            if(res) {  
                    $('div#block12 *').remove();
                    $('div#block12').append(res.html);






            }
        }
    });
});
$(".AddSelRefererCompany").on('click',function(){
    
    var _url                    = '<?php echo $this->webroot;?>InfJobVotePublics/api_add/';
    var _referer_company_id     = $(this).data('id');
    var _referer_company_status = 0;
    var _job_vote_id            = $('#jobVote12').val();
    var _data                   = 'referer_company_id='+_referer_company_id+'&status='+_referer_company_status+'&job_vote_id='+_job_vote_id;
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: _url,
        data: _data,
        success: function(res){
            if(res.status) {
                if(res.data) {
                    $("#refBtn" + _referer_company_id + " button" ).remove();
                    $("#refBtn" + _referer_company_id ).text('済');

                }
            }else{
                if(res.data.error.length != 0) {
                    if(res.data.error == 'exits') {
                        alert('登録済みです。');
                    }
                }
            }
        },
        error: function(e){
            // console.log("ERROR");
            // console.log(e);
        }
    });

    return false;
});

</script>

