<h5>求人票別　　流入元企業割当リスト</h5>
		<div class="ibox-content">
			<div class="row">
				<div class="col-md-3">
					<label for="">求人票</label><br>
						<?php echo $this->Form->input('ev_event_id', array( 
							'options' => $evEvents,
							'class'=>'btn btn-white btn-sm toast-bottom-full-width',
							'label'=>false, 
							'div'=>false,
							'id' => 'jobVote12' )
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
			<div id='block12'>
				<?php echo $this->element('allocateListTable') ?>
			</div>
	</div>


	<div class="row mt10">
		<div class="col-md-2">
			<select class="btn btn-white btn-sm toast-bottom-full-width">
				<option value="1">チェックのみ</option>
				<option value="2">すべて</option>
			</select>
		</div>
		<div class="col-md-10">
			<button  class="btn btn-primary btn-xs" type="submit">メール</button>
		</div>
	</div>
</div>