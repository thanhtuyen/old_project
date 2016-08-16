<!-- <div class="col-lg-10"><h2>イベント一覧</h2></div>
</div>

<div class="row wrapper wrapper-content animated fadeInRight title-button pd-bottom-none">


<div class="margin-top-20 wrapper wrapper-content row animated fadeInRight clearfix">
<div class="col-lg-12">

<div class="ibox  no-margin-bottom">
  <div class="ibox-title">
   <h5>イベント一覧</h5>
 </div>
 <div class="ibox-content bg-gray clearfix form-edit2 p-sm">

               



    <div class="clear"></div>
    <div>
      <div class="content-fr clearfix">
        <div class="col-lg-12 clearfix margin-top20">
          <div class="fix-size-row ">
            <label>開催期間</label>
            <div class="form-group data_1" id="">
              <div class="input-group date">
                <span class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </span>
	              
              </div>
            </div>
          </div>
          <div class="fix-size-row1">
            <label><p>から</p></label>
            <div class="form-group data_1" id="">
              <div class="input-group date">
                <span class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </span>
	             
              </div>
            </div>
          </div>
          <div style = "width:260px" class="fix-size-row2">
            <label><p>まで</p></label>                              
            <div>
              <label>
               

                <label>
                </div>
                <div class = "padding-top6">日程未設定イベントを表示する </div>
              </div>
            </div>
            <div class="col-lg-12 clearfix">
              <div class="fix-size-row3 margin-bottom20">
                <div style = "float:left"><label class="label-padding-right15">イベント種別</label></div>
                <div style = "float:left; width: 150px;">
                
                
                
                </div>
              </div>
              <div class="fix-size-row4 margin-bottom20">
                <div style = "float:left"><label class="label-padding-right15">求人票</label></div>
                <div style = "float:left;width: 150px;">

              

                </div>
              </div>
              <div class="fix-size-row3 margin-bottom20">
                <div style = "float:left"><label class="label-padding-right15">選考段階</label></div>
                <div style = "float:left;width: 150px;">
                
              

                </div>
              </div>
            </div>
            <div class="col-lg-12 clearfix">
              <div class="fix-size-row5 margin-bottom20">
                <div style = "float:left"><label class="label-padding-right15">マイナビID</label></div>
                <div  style = "float:left;width: 150px;">
               
                </div>
              </div>
              <div class="fix-size-row5 margin-bottom20">
                <div style = "float:left"><label class="label-padding-right15">リクナビID</label></div>
                <div  style = "float:left;width: 150px;">
               
                </div>
              </div>
              
            </div>
          </div>


          <div class="from_calen">
            <button type="sbumit" class="btn btn-primary btn-sm">検索</button>
            <button type="reset" class="btn btn-primary btn-sm">クリア</button>
            
          </div>
              
      </div>
    </div>
    <div class="ibox-content">

      <div class="table-responsive">
        <table class="table table-center white-tb-th table-striped table-bordered table-center-th-td">
          <thead>
            <tr class = "bg-white">
              <th>イベントID</th>                             
              <th>イベント名</th>                             
              <th>求人票</th>                             
              <th>開始日時</th>
              <th>終了日時</th>                             
              <th>イベント種別</th>                             
              <th>選考段階</th>
              <th>定員数</th>                             
              <th>申込数</th>                             
              <th>予約中</th>  
              <th>申込済</th>  
              <th>候補者 キャンセ ル</th>                             
              <th>主催者 キャンセ ル</th>                             
              <th>参加済</th>  
              <th>無断欠席</th>                             
              <th>イベント 担当者</th>                                                         
            </tr>
          </thead>
          <tbody>
          
          </tfoot>
        </table>
      </div>


    </div>

  </div>

</div> -->

<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10"><h2>イベント一覧</h2></div>
</div>

<div class="wrapper wrapper-content row animated fadeInRight clearfix"> <!-- --thiv div content and footer-- -->

  <!-- start contents -->  
  <div class="">
    <div class="col-lg-12">

      <div class="ibox">
        <div class="ibox-title">
         <h5>イベント一覧</h5>
         <div class="ibox-tools">
           <button type="button" class="btn btn-primary btn-xs">編集</button>                       
         </div>
       </div>
       <div class="ibox-content bg-gray clearfix form-edit2 p-sm">



           <?php echo $this->Form->create('EvEvents',array(
                        'class'=>'',
                        'type'=>'get',
                        'url' => array('controller' => 'EvEvents', 'action' => 'search')
                        ))?>
                        
          <div class='form-group'>
            <div class='col-lg-3 p-r-none'>
              <label class='pull-left sch-mdev-30 p-xs'>開催期間</label>
              <div class="data_1" id="">
                <div class="input-group date">
                  <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </span>
                  <?php echo $this->Form->input('year_month_day_from', array( 'type'=>'text' ,'label'=>false,'div'=>false,'class'=>'form-control', 'style'=>'copacity:0;' ,'value'=>$data['year_month_day_from']) ); ?>
                </div>
              </div>
            </div>
        
            <div class='col-lg-3 row'>
              <label class='pull-left p-xs'>から</label>
              <div class="data_1" id="">
                <div class="input-group date">
                  <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </span>
                   <?php echo $this->Form->input('year_month_day_to', array( 'type'=>'text' ,'label'=>false,'div'=>false,'class'=>'form-control', 'style'=>'copacity:0;' ,'value'=>$data['year_month_day_to']) ); ?>
                </div>
              </div>             
            </div>
            <label class='pull-left p-xs'>まで</label>
            <div class='col-lg-4 row'>
              <div class='p-xxs'>
                <label class='lb-inl'>
                  
                <?php echo $this->Form->input('chk_non_sch', array( 'type'=>'checkbox' ,'label'=>false,'div'=>false,'class'=>'i-checks', 'style'=>'copacity:0;' ,'value'=>1 , "default"=>$data['chk_non_sch']) ); ?>
           
                </label>
                <label class='p-xxs'>日程未設定イベントを表示する</label>        
              </div>
            </div>
            
          </div>


          <div class="form-group">
            <div class="pull-left row m-r-md">
              <label class="pull-left p-xs">イベント種別</label>

              <?php echo $this->Form->input('evnt_type', array( 'options'=>$event_types ,'label'=>false,'div'=>false,'class'=>'form-control ct-select2' ,'default'=>$data['evnt_type']) ); ?>
            </div>
            <div class="pull-left row m-r-md ">
              <label class="pull-left p-xs">求人票</label>

              <?php echo $this->Form->input('jobVotes', array( 'options'=>$jobVotes ,'label'=>false,'div'=>false,'class'=>'form-control ct-select2','default'=>$data['jobVotes']) ); ?>
            </div>
            <div class="pull-left row">
              <label class="pull-left p-xs">選考段階</label>
              <?php echo $this->Form->input('ScreeningStages', array( 'options'=>$ScreeningStages ,'label'=>false,'div'=>false,'class'=>'form-control ct-select2','default'=>$data['ScreeningStages']) ); ?>
            </div>
          </div>

          <div class="form-group">

            <div class="pull-left row m-r-md">
              <label class="pull-left p-xs">マイナビID</label>

              <?php echo $this->Form->input('mynavi_id', array( 'type'=>'text','label'=>false,'div'=>false,'class'=>'form-control ct-select2','default'=>$data['mynavi_id']) ); ?>
            </div>
            <div class="pull-left row m-r-md ">
              <label class="pull-left p-xs">リクナビID</label>

              <?php echo $this->Form->input('rikunavi_id', array( 'type'=>'text','label'=>false,'div'=>false,'class'=>'form-control ct-select2','default'=>$data['rikunavi_id']) ); ?>
            </div>
          
          </div>

            <div class='clearfix'></div>

          <div class="from_calen">
            <button type="submit" class="btn btn-primary w-95">検索</button>
            <a type="" class="text-navy">クリア</a>
          </div>
            <?php echo $this->Form->End(); ?>
        </form>
      </div>

    <div class="ibox-content">

<!-- 
      
        <div class='row'>
          <div class="col-lg-6">
            <div class="btn-group">
              <select class="form-control pull-left btn h-30 ">
                <option>チェックのみ1</option>
                <option>チェックのみ1</option>
                <option>チェックのみ1</option>
              </select>         
            </div>

            <button type="button" class="btn btn-sm btn-white">
              <i class="fa fa-envelope-o"></i>
            </button>
            <button type="submit" class="btn btn-sm btn-white">
              <i class="fa fa-print"></i>
            </button>

            <div class="btn-group">
              <select class="form-control pull-left btn h-30 w-100 ">
                <option>その他</option>
                <option>その他</option>
                <option>その他</option>
              </select>  
            </div>

         
          </div>
        </div> -->
    
      <div class='table-responsive'>
      <table class="table table-striped table-bordered table-hover dataTables-example tb1">
        <thead>
          <tr>
            <th class="wpnw">イベントID</th>                             
              <th class="wpnw">イベント名</th>                             
              <th class="wpnw">求人票</th>                             
              <th class="wpnw">開始日時</th>
              <th class="wpnw">終了日時</th>                             
              <th class="wpnw">イベント種別</th>                             
              <th class="wpnw">選考段階</th>
              <th class="wpnw">定員数</th>                             
              <th class="wpnw">申込数</th>                             
              <th class="wpnw">予約中</th>  
              <th class="wpnw">申込済</th>  
              <th class="wpnw">候補者 キャンセ ル</th>                             
              <th class="wpnw">主催者 キャンセ ル</th>                             
              <th class="wpnw">参加済</th>  
              <th class="wpnw">無断欠席</th>                             
              <th class="wpnw">イベント 担当者</th>                                                       
          </tr>
        </thead>
        <tbody>
          <?php foreach( $evEvents as $event ): ?>
            <tr>
              <?php if ( empty( $event['EvSchedule']['id'] ) ): ?>
              <td class='button_cen'><?php echo $this->html->link($event['EvEvent']['id'],array('controller'=>'EvHistories','action'=>'add', $event['EvEvent']['id'] )); ?></td>
              <td class='button_cen'><?php echo $this->html->link($event['EvEvent']['name'],array('controller'=>'EvHistories','action'=>'add', $event['EvEvent']['id'] )); ?></td>
              <?php else: ?>
              <td class='button_cen'><?php echo $this->html->link($event['EvEvent']['id'],array('controller'=>'EvHistories','action'=>'edit', $event['EvEvent']['id'] )); ?></td>
              <td class='button_cen'><?php echo $this->html->link($event['EvEvent']['name'],array('controller'=>'EvHistories','action'=>'edit', $event['EvEvent']['id'] )); ?></td>
              <?php endif; ?>
              <td class='button_cen'>
              <?php if ( empty( $event['JobVote']['id'] ) ): ?>
              &nbsp;
              <?php else: ?>
              <?php echo $this->html->link($event['JobVote']['title'],array('controller'=>'JobVotes','action'=>'edit', $event['JobVote']['id'] )); ?>
              <?php endif; ?>
              </td>
              <?php echo $this->Enjin->getEventListScheduleBlock( $event['EvSchedule'] ); ?>
              <td class='button_cen'><?php echo $this->Enjin->getTypeName( $event['EvEvent']['type']); ?></td>
              <td class='button_cen'><?php echo h( $event['ScreeningStage']['name'] ); ?></td>
              <?php echo $this->Enjin->getCapacity( $event['EvSchedule'] ); ?>
              <td class='button_cen'>
              
              <?php if ( empty( $event['EvSchedule']['id'] ) ): ?>
              <?php echo $this->html->link( $this->Enjin->getEvStatStatusTotal($event['EvStat']),array('controller'=>'EvHistories','action'=>'add', $event['EvEvent']['id'] )); ?>
              <?php else: ?>
              <?php echo $this->html->link( $this->Enjin->getEvStatStatusTotal($event['EvStat']),array('controller'=>'EvHistories','action'=>'edit', $event['EvEvent']['id'] )); ?>
              <?php endif; ?>
              </td>
              <?php $conf = $this->Enjin->getEvHistoryStatus(); ?>
              <?php foreach( $conf as $key => $val ): ?>
                <td class='button_cen'><?php echo $this->Enjin->getEvStatStatus( $event['EvStat'], $key ); ?>
              <?php endforeach; ?>
              <td class='button_cen'><?php echo $this->html->link($event['EvPersonnel'],array('controller'=>'EvHistories','action'=>'edit', $event['EvEvent']['id'] )); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
        <tfoot>
          <tr>
            <th>イベントID</th>                             
              <th>イベント名</th>                             
              <th>求人票</th>                             
              <th>開始日時</th>
              <th>終了日時</th>                             
              <th>イベント種別</th>                             
              <th>選考段階</th>
              <th>定員数</th>                             
              <th>申込数</th>                             
              <th>予約中</th>  
              <th>申込済</th>  
              <th>候補者 キャンセ ル</th>                             
              <th>主催者 キャンセ ル</th>                             
              <th>参加済</th>  
              <th>無断欠席</th>                             
              <th>イベント 担当者</th>           
          </tr>
        </tfoot>
      </table>
    </div>
    <div class='row'>
        <div class="col-lg-6">
         <!--  <div class="btn-group">
            <select class="form-control pull-left btn h-30 ">
              <option>チェックのみ1</option>
              <option>チェックのみ1</option>
              <option>チェックのみ1</option>
            </select>         
          </div>

          <button type="button" class="btn btn-sm btn-white">
            <i class="fa fa-envelope-o"></i>
          </button>
          <button type="submit" class="btn btn-sm btn-white">
            <i class="fa fa-print"></i>
          </button>

          <div class="btn-group">
            <select class="form-control pull-left btn h-30 w-100 ">
              <option>その他</option>
              <option>その他</option>
              <option>その他</option>
            </select>  
          </div> -->

          <!------------pagination--------------> 
        </div>
        <div class="col-lg-6">
          <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
            <ul class="pagination">
              <li class="paginate_button previous disabled" aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_previous">
                <a href="#">Previous</a>
              </li>
              <li class="paginate_button active" aria-controls="DataTables_Table_0" tabindex="0">
                <a href="#">1</a>
              </li>
              <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0">
                <a href="#">2</a>
              </li><li class="paginate_button next" aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_next">
              <a href="#">Next</a>
            </li>
          </ul>
        </div>
      </div>
    </div> 
      </div>
                               
  </div>
  <!-- end table -->

</div>

</div>

</div>

<!-- ------------end contents--------------- --> 
