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
				