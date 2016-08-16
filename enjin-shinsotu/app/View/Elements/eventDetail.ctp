<div class="col-md-3">
	<div class="b">イベント名</div>
	<div><?php echo $eventDetail['EvEvent']['name'] ?></div>
	<br>
	<div class="b">開催日時</div>
	<div>開始：
		<?php if( isset( $eventDetail['EvSchedule']['holding_date'] ) ) ?>
		<?php echo $eventDetail['EvSchedule']['holding_date'] ?></div>
		
		<?php if( isset( $eventDetail['EvSchedule']['end_date'] ) ) ?>
	<div>終了：<?php echo $eventDetail['EvSchedule']['end_date'] ?></div>
	<br>
	<div class="b">開催場所</div>
	<div><?php echo $eventDetail['EvSchedule']['venue'] ?></div>
</div>