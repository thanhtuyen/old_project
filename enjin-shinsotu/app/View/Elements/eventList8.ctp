
<div class="col-md-9">
	<div class="table-responsive">
		<table class="table table-striped">
			<tbody>
				<tr>
					<th>候補者名</th>
					<th>大学</th>               
					<th>メール</th>
					<th>電話</th>
					<th>ステータス</th>
				</tr>

				<?php if( !empty( $ScheduleCandidate ) ): ?>
				<?php foreach( $ScheduleCandidate as $SchCand_key => $SchCand_val ): ?>
				<tr>
					<td><?php echo $SchCand_val['name'] ?></td>
					<td>
						<?php foreach( $SchCand_val['school'] as $key => $val ): ?>
							<?php echo $val['name']; ?>
						<?php endforeach; ?> 
					</td>
					<td><?php echo $SchCand_val['mail_address'] ?></td>
					<td><?php echo $SchCand_val['tel'] ?></td>
					<td><?php echo $ev_history_status[ $SchCand_val['status'] ] ?></td>
				</tr>
				<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>
