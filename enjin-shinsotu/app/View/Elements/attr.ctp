
			<!--#BLOCK 2-->
			<h5>候補者属性別x選考履歴&イベント統計情報</h5>
			<div class="ibox-content BLOCK2_3">
			<?php $judge_count = count( $select_judgment_type ); ?>
				<label for="">候補者属性</label><br>
					<?php echo $this->Form->input('evEvent_id', array( 
						'options' => array( '語学', '学歴', '資格', 'カスタム' ),
						'class'=>'btn btn-white btn-sm toast-bottom-full-width select_width',
						'id' => 'can_attr',
						'label'=>false, 
						'div'=>false )
						);?>
				

					<?php foreach( $attr_stats['job_votes'] as $job_key => $job_val ):  ?>
					<div class="table-responsive">
						<h5><?php echo $jobVotes[ $job_key ]  ?></h5>
						<table class="table table-striped attr_job_tbl">
							<tbody>
								<tr>
							<th>選考段階</th>
							<?php 
									$scr_count = 0;
									foreach( $screening_stages as $scr_key => $screening_stage ):
										$scr_count++;
										$summaryData['screening_stage'][$scr_key]['count'] = $scr_count;

								 ?>
								<th colspan="<?php echo $judge_count ?>"><?php echo $screening_stage; ?></th> 
							<?php endforeach; ?>
						</tr>
								<tr>
									<th>ステータス</th>
									<?php foreach ( $screening_stages as $screening_stage ): ?>
									<?php foreach ( $select_judgment_type as $judge_key => $judge_val ): ?>
										<td><?php echo $judge_val ?></td>
									<?php endforeach; ?>
								<?php endforeach; ?>


								</tr>
								<?php foreach( $language as $key => $value ): ?>
									<tr>
										<th><?php echo $value; ?></th>
										<?php foreach( $screening_stages as $scr_key => $screening_stage ): ?>
										<?php foreach ( $select_judgment_type as $judge_key => $judge_val ): ?>

											<?php if( empty( $attr_stats['job_votes'][$job_key][$key][$scr_key][$judge_key] ) ): ?>
												<td>0</td>
											<?php else: ?>
												<td><?php echo $attr_stats['job_votes'][$job_key][$key][$scr_key][$judge_key] ?></td>
											<?php endif; ?>
											

										<?php endforeach; ?>
										<?php endforeach; ?>
									</tr>
								<?php endforeach; ?>
								
							</tbody>
						</table>
					</div>
					<?php endforeach; ?>
					<!--#BLOCK 2-->

					<!--BLOCK 3-->
						<?php foreach( $attr_stats['events'] as $event_key => $event_val ): ?>
					<div class="table-responsive">
						
						<?php $job_array = array(); ?>
						<?php foreach ($event_val as $key => $value) {
							$job_array[] = $key;
						} ?>
						<table class="table table-striped attr_ev_tbl">
							<tbody>

								<tr>
								<?php if( !empty( $evEvents[ $event_key ] ) ): ?>
									<th><h5><?php echo $evEvents[ $event_key ]  ?></h5></th>
								<?php else: ?>
									<th><h5>イベント参加なし</h5></th>
								<?php endif; ?>
								<th>イベントと選考に<br>参加</th>
								<th>イベントのみ<br>参加</th>
								<th>選考のみ<br>参加</th>
								<th>どちらも<br>不参加</th>
							</tr>
							<?php foreach( $language as $key => $value ): ?>
								<tr class="bg_grey">
									<th><?php echo $value ?></th>
										
										<?php 
								            $yes = 0;
								            $ev_only = 0;
								            $sel_only = 0;
								            $no = 0;

								            foreach ($job_array as $job_val) {

									            if( !empty( $attr_stats['events'][$event_key][$job_val][ $key ] ) ) {

									            $val =  $attr_stats['events'][$event_key][$job_val][ $key ];
									                	$ev = $event_key;
									                	$job = $job_val;


									                	if( $ev != 0 && $job != 0 ) {
									                		$yes += $val;

									                	} else if( $ev == 0 && $job != 0 ) {
												            $sel_only += $val;

									                	} else if( $ev != 0 && $job == 0 ) {
												            $ev_only += $val;

									                	}else if($ev == 0 && $job == 0) {
												            $no += $val;

									                	}


									            } 
								            }

						            ?>
						            <td><?php echo $yes  ?></td>
						            <td><?php echo $ev_only ?></td>
						            <td><?php echo $sel_only ?></td>
						            <td><?php echo $no ?></td>


								</tr>
								<?php endforeach; ?>
						</tbody>
					</table>
				</div>
				<?php endforeach; ?>
			</div>
			<!--#BLOCK 3-->