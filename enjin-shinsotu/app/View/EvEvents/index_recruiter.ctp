<?php echo $this->Html->css('enjin/management_event_calender.css'); ?>
<?php echo $this->Html->css('bootstrap/demo.css'); ?>

<div class="row wrapper border-bottom white-bg page-heading">
                            <div class="col-lg-10">
                              <h2>イベントカレンダー</h2>
                            </div>
                          </div>
    <!--start content-->
<div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">
    <div class='col-lg-12'>
    <div class='ibox'>
        <div class='ibox-title'><h5>イベントカレンダー</h5></div>
        <div class='ibox-content bg-white p-sm'>      
            <div class="fc fc-ltr fc-unthemed">
                            <div class="fc-toolbar">
                            <div class="fc-left">
                                <div class="fc-button-group">
                                    <button type="button" class="fc-prev-button fc-button fc-state-default fc-corner-left" onclick="location.href='<?php echo $this->html->url(array('controller' => 'EvEvents', 'action' => 'index')).'/?year='.($prevDates['year']).'&month='.($prevDates['month']);?>'">
                                        <span class="fc-icon fc-icon-left-single-arrow"></span>
                                    </button>
                                    <button type="button" class="fc-next-button fc-button fc-state-default fc-corner-right" onclick="location.href='<?php echo $this->html->url(array('controller' => 'EvEvents', 'action' => 'index')).'/?year='.($nextDates['year']).'&month='.($nextDates['month']);?>'">
                                        <span class="fc-icon fc-icon-right-single-arrow"></span>
                                    </button>
                                </div>
                                <button type="button" class="fc-today-button fc-button fc-state-default fc-corner-left fc-corner-right" onclick="location.href='<?php echo $this->html->url(array('controller' => 'EvEvents', 'action' => 'index'));?>'">今月</button>
                            </div>
                            <div class="fc-center"><h2><?php echo date('Y/m',mktime(0, 0, 0, $targetDates['month'], 1, $targetDates['year']))?></h2></div>
                        </div>
                    </div>
            <?php $evHisStatus = $this->Enjin->getEvHistoryStatus(); ?>
                    
            <table class='table table-bordered no-margin-bottom subcontents-sb-1'>
                

                <tbody>
                    <tr>
                        <th>日</th>
                        <th>曜日</th>
                        <th>イベント名</th>
                        <th>開始時刻</th>
                        <th>終了時刻</th>
                        <th>定員数</th>
                        <th>申し込み数</th>
                        <?php foreach( $evHisStatus as $key => $val ): ?>
                        <th><?php echo $val; ?></th>
                        <?php endforeach; ?>
                    </tr>
                    <?php for( $i= 1; $i<= $last_day; $i++ ): ?>
                        <?php if ( !isset( $event[$i] ) ): ?>
                            <tr>
                                <td><?php echo h($i);?>&nbsp;</td>
                                <td><?php echo $this->Enjin->getWeekDay(date('w',mktime(0, 0, 0, $targetDates['month'], $i, $targetDates['year']))); ?>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        <?php else: ?>
                            <?php $counter = 0; ?>
                            <?php foreach( $event[$i] as $row ):?>
                                <?php if ( $counter != 0 ): ?>
                                <td></td>
                                <td></td>
                                <?php else: ?>
                                <td><?php echo h($i);?>&nbsp;</td>
                                <td><?php echo $this->Enjin->getWeekDay(date('w',mktime(0, 0, 0, $targetDates['month'], $i, $targetDates['year']))); ?>&nbsp;</td>
                                <?php endif; ?>
                                <td><?php echo $this->Html->link($row['EvEvent']['name'], array('controller' => 'EvHistories', 'action' => 'edit', $row['EvEvent']['id'],$row['EvSchedule']['id'])); ?></td>
                                <td><?php echo $this->Enjin->getTime( $row['EvSchedule']['holding_date'] ); ?></td>
                                <td><?php echo $this->Enjin->getTime( $row['EvSchedule']['end_date'] ); ?></td>
                                <td><?php echo h( $row['EvSchedule']['capacity']); ?></td>
                                <td><?php echo $this->Enjin->getEvStatStatusTotal( $row['EvStat'] ); ?>
                                <?php if ( !isset( $row['EvStat'] )): ?>
                                    <?php foreach( $evHisStatus as $key => $val ): ?>
                                    <td>&nbsp;</td>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <?php foreach( $evHisStatus as $key => $val ): ?>
                                        <td><?php echo $this->Enjin->getEvStatStatus( $row['EvStat'], $key ); ?></td>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tr>
                                <?php $counter++; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endfor; ?>
                </tbody>
                    <tr>
                        <th>日</th>
                        <th>曜日</th>
                        <th>イベント名</th>
                        <th>開始時刻</th>
                        <th>終了時刻</th>
                        <th>定員数</th>
                        <th>申し込み数</th>
                        <?php foreach( $evHisStatus as $key => $val ): ?>
                        <th><?php echo $val; ?></th>
                        <?php endforeach; ?>
                    </tr>
            </table>
             <div class="fc fc-ltr fc-unthemed mrt15">
                            <div class="fc-toolbar">
                            <div class="fc-left">
                                <div class="fc-button-group">
                                    <button type="button" class="fc-prev-button fc-button fc-state-default fc-corner-left" onclick="location.href='<?php echo $this->html->url(array('controller' => 'ev_events', 'action' => 'index')).'/?year='.($prevDates['year']).'&month='.($prevDates['month']);?>'">
                                        <span class="fc-icon fc-icon-left-single-arrow"></span>
                                    </button>
                                    <button type="button" class="fc-next-button fc-button fc-state-default fc-corner-right" onclick="location.href='<?php echo $this->html->url(array('controller' => 'ev_events', 'action' => 'index')).'/?year='.($nextDates['year']).'&month='.($nextDates['month']);?>'">
                                        <span class="fc-icon fc-icon-right-single-arrow"></span>
                                    </button>
                                </div>
                                <button type="button" class="fc-today-button fc-button fc-state-default fc-corner-left fc-corner-right" onclick="location.href='<?php echo $this->html->url(array('controller' => 'ev_events', 'action' => 'index'));?>'">今日</button>
                            </div>
                            <div class="fc-center"><h2><?php echo date('Y/m',mktime(0, 0, 0, $targetDates['month'], 1, $targetDates['year']))?></h2></div>
                        </div>
                    </div>
        </div>      
    </div>

    
    <div class='ibox clearfix'>
    <?php if(!empty($nonEvSchedules)):?>
        <div class="ibox-title">
                                    <h5>開催日時未定イベント</h5>                                    
                                  </div>
                                  <div class='ibox-content bg-white p-sm'>
                                    <table class='table table-bordered no-margin-bottom'>
                                        <thead>
                      <tr class="">
                        <th class="col-lg-3">イベント名</th>
                        <th class="col-lg-3">ターゲット選考段階名</th>
                        <th class="col-lg-3">ターゲット選考段階比較タイプ</th>
                        <th class="col-lg-3">求人票のタイトル</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($nonEvSchedules as $row ): ?>
                      <tr>
                        <td class="col-lg-3"><?php echo $this->Html->link($row['EvEvent']['name'], array('controller' => 'EvHistories', 'action' => 'add', $row['EvEvent']['id'])); ?></td>
                        <td class="col-lg-3"><?php echo $row['ScreeningStage']['name'] ?></td>
                        <td class="col-lg-3"></td>
                        <td class="col-lg-3"><?php echo $row['JobVote']['title'] ?></td>
                      </tr>
                    <?php endforeach;?>
                    </tbody>
                    <thead>
                     <tr class=" t-first">
                      <th class="col-lg-3">イベント名</th>
                      <th class="col-lg-3">ターゲット選考段階名</th>
                      <th class="col-lg-3">ターゲット選考段階比較タイプ</th>
                      <th class="col-lg-3">求人票のタイトル</th>
                    </tr>
                  </thead>
                                    </table>    
                                  </div><br><br>
                                  <?php endif;?>
    </div>

    </div>

   
    </div>
