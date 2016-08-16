<div class="tab-content">
    <div id="tab-2" class="tab-pane active">
        <div class="panel-body">                            
          <div class="ibox-content" style="display: block;">
            <form method="get" class="form-horizontal">
              <div class="form-group"><label class="col-sm-4 control-label">開催日時</label>
                <div class="col-sm-8">
                  <div class="form-control border-none"><?php echo $holding_date; ?></div>
                </div>
              </div>    
              <div class="form-group"><label class="col-sm-4 control-label">終了日時</label>
                <div class="col-sm-8">
                  <div class="form-control border-none"><?php echo $end_date; ?></div>
                </div>
              </div>  
              <div class="form-group"><label class="col-sm-4 control-label">個別テーマ</label>
                <div class="col-sm-8">
                  <div class="form-control border-none"><?php echo $individual_theme ?></div>
                </div>
              </div>  
              <div class="form-group"><label class="col-sm-4 control-label">当日内容</label>
                <div class="col-sm-8">
                  <div class="form-control border-none h-auto">
                  <?php echo $this->Enjin->nl2brh( $day_content ); ?>
                  </div>
                </div>
              </div>  
              <div class="form-group"><label class="col-sm-4 control-label">定員数</label>
                <div class="col-sm-8">
                  <div class="form-control border-none"><?php echo $capacity; ?> 人</div>
                </div>
              </div>  
              <div class="form-group"><label class="col-sm-4 control-label">募集締切日</label>
                <div class="col-sm-8">
                  <div class="form-control border-none"><?php echo $wanted_deadline ?></div>
                </div>
              </div>  
              <div class="form-group"><label class="col-sm-4 control-label">開催場所</label>
                <div class="col-sm-8">
                  <div class="form-control border-none"><?php echo $venue; ?></div>
                </div>
              </div>      
              <div class="form-group"><label class="col-sm-4 control-label">開催費用</label>
                <div class="col-sm-8">
                  <div class="form-control border-none"><?php echo number_format($holding_cost); ?> 円</div>
                </div>
              </div>                                                                                
              <div class="btn-clear text-center">
                <?php echo $this->Html->link('編集', array('controller'=>'EvHistories','action' => 'edit', $ev_event_id , $id  ),array('class'=>'btn btn-primary btn-xs w-95')); ?>
              </div>
            </form>
          </div> 
        </div>
    </div>
</div>




