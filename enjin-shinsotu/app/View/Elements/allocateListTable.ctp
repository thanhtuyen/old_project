<table class="table table-striped">
					<tbody>
						<tr>
							<th>流入元</th>
							<?php $select_status_count = count( $select_status_id ); ?>
							<?php foreach( $screening_stages as $scr_key => $screening_stage ): ?>
								<th colspan="<?php echo $select_status_count ?>"><?php echo $screening_stage ?></th>
							<?php endforeach; ?>               
							<th>割当</th>
							<th>メール送信</th>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<?php foreach( $screening_stages as $scr_key => $screening_stage ): ?>
								<?php foreach ($select_status_id as $key => $value): ?>
								<td><?php echo $value ?></td>
								<?php endforeach; ?>
							<?php endforeach; ?>

							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>

						<?php foreach( $AllocateList as $allc_key => $allc_val ): ?>
						<?php if( $allc_key == 'name' ) continue; ?>
							<?php foreach( $allc_val as $key => $val ): ?>
							<?php if( $key == 'name' || $key == 'allocation'  )  continue; ?>
						<tr>
							<td><?php echo $val['name'] ?></td>

						
						<?php foreach( $screening_stages as $scr_key => $screening_stage ): ?>
							<?php foreach ($select_status_id as $ky => $value): ?>
								<?php if( !empty( $val[$scr_key][$ky] ) ): ?>
									<td><?php echo $val[$scr_key][$ky] ?></td>
								<?php elseif( $val['allocation'] != 2 ): ?>
									<td>0</td>
								<?php else: ?>
									<td>‐</td>
								<?php endif; ?>
							<?php endforeach; ?>
						<?php endforeach; ?>

							<?php if( $val['allocation'] != 2 ): ?>
								 <td id="refBtn<?php echo $key ?>" >済</td> 
							<?php else: ?>
								<td id="refBtn<?php echo $key ?>"><button class="btn btn-primary btn-xs AddSelRefererCompany" data-id="<?php echo $key ?>" >割り当てる</button></td>
							<?php endif; ?>
							<td>
								<div class="i-checks"><label> <input type="checkbox" value="" > <i></i></label></div>
							</td>
						</tr>
							<?php endforeach; ?>
						<?php endforeach; ?>

						
			</tbody>
		</table>