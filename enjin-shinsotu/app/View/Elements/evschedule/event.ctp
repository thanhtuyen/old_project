<div class="ibox">
<div class="ibox-title">
  <h5>イベント情報</h5>
  <!-- action change url -->
  <div class="ibox-tools">
      <?php echo $this->Html->link('編集', array('controller'=>'EvEvents','action' => 'edit',$EvEvent['id']),array('class'=>'btn btn-primary btn-xs')); ?>
  </div>
  <!-- end action -->
</div>
<div class="ibox-content bg-white p-sm">
  <form method="get" class="form-horizontal">
    <div class="form-group">
      <label class="col-sm-4 control-label">イベント名</label>
      <div class="col-sm-8">
        <div class="form-control border-none"><?php echo $EvEvent["name"] ?></div>
      </div>
    </div>
    <div class="form-group"><label class="col-sm-4 control-label">求人票ID</label>
      <div class="col-sm-8">
        <div class="form-control border-none"><?php echo $EvEvent["job_vote_id"] ?></div>     
      </div>               
    </div>
    <div class="form-group"><label class="col-sm-4 control-label">イベント種別</label>
      <div class="col-sm-8">
        <div class="form-control border-none"><?php echo $this->Enjin->getTypeName($EvEvent["type"]); ?></div>
      </div>
    </div>
    <div class="form-group"><label class="col-sm-4 control-label">ターゲット選考段階ID</label>
      <div class="col-sm-8">
        <div class="form-control border-none"><?php echo $ScreeningStage["name"] ?></div>
      </div>
    </div>
    <div class="form-group"><label class="col-sm-4 control-label">ターゲット選考段階比較タイプ</label>
      <div class="col-sm-8">
        <div class="form-control border-none"><?php echo $this->Enjin->getScreeningStageTypeName($EvEvent["screening_stage_type"]) ?></div>
      </div> 
    </div>
    <div class="form-group"><label class="col-sm-4 control-label">ターゲット選考ステータス （（マスタ））</label>
      <div class="col-sm-8">
        <div class="form-control border-none"><?php echo $this->Enjin->getSelStatusName( $EvEvent["status"] ) ?></div>
      </div>
    </div>
    <div class="form-group"><label class="col-sm-4 control-label">イベント内容</label>
      <div class="col-sm-8">
        <div class="form-control border-none"><?php echo $EvEvent["contents"] ?></div>                                
      </div>
    </div>
    <div class="form-group"><label class="col-sm-4 control-label">リクナビID</label>
      <div class="col-sm-8">
        <div class="form-control border-none"><?php echo $EvEvent["rikunavi_id"] ?></div>                                
      </div>
    </div>
    <div class="form-group"><label class="col-sm-4 control-label">マイナビID</label>
      <div class="col-sm-8">
        <div class="form-control border-none"><?php echo $EvEvent["mynavi_id"] ?></div>                                
      </div>
    </div>
  </form>                                        
</div>
</div>
