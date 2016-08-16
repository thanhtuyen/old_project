<?php echo $this->element('back_nav', array('text' => __('求人票登録'), 'noBtn' => true))?>

<div class="wrapper wrapper-content row animated fadeInRight clearfix">
    <!-- content -->
    <div class='full-content'>
        <div class='col-lg-12'>
            <div class='ibox'>
                <div class='ibox-title'>
                    <h5>求人票一覧</h5>
                </div>
                <div class="ibox-content">

                     <!--pagination-->
                      <div class="text-right clearfix">
                        <div class="pull-left">
                        <?php echo $this->Html->link(__('新規作成'), array('action' => 'add'),array('class'=>'btn btn-primary btn-sm')); ?>
                        </div>
                        <div class="bottom_pagination1 pull-right">
                          <ul class="pagination m-t-none">
                            <?php
                            echo $this->Paginator->prev('Prev', array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'paginate_button previous disabled'));
                            echo $this->Paginator->numbers(array('separator' => '','tag'=>'li','class'=>'paginate_button','currentClass'=>'paginate_button active','currentTag'=>'a'));
                            echo $this->Paginator->next('Next', array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'paginate_button next disabled'));
                            ?>  
                          </ul>
                        </div>
                        <span class="sp-text-pg pull-right"><?php echo $this->Paginator->counter("{:count} 件中 {:start}-{:end} 件表示")?>&nbsp;&nbsp;</span>
                      </div>
                      <!--pagination-->

                    <div class="table-responsive">
                        <table class="table table-center table-striped table-bordered tbl-data">
                            <thead>
                            <tr>
                                <th class='wsnw'>求人票ID</th>
                                <th class='wsnw'>求人票タイトル</th>
                                <th class='wsnw'>求人担当者</th>
                                <th class='wsnw'>イベント名</th>
                                <th class='wsnw'>職種</th>
                                <th class='wsnw'>募集エリア</th>
                                <th class='wsnw'>募集人数</th>
                                <?php foreach ($screeningStages as $screeningStage): ?>
                                <th class='wsnw'><?php echo h($screeningStage); ?></th>
                                <?php endforeach; ?>
                                <th class='wsnw'>募集期限</th>
                                <th class='wsnw'>公開開始日時</th>
                                <th class='wsnw mw92'>ステータス</th>
                                <th class='wsnw'>登録日</th>
                                <th class='wsnw'>最終更新日</th>
                                <th class='wsnw'>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($jobVotes as $jobVote): ?>
                            <tr class="gradeX forum-info">
                                <td>
                                    <?php echo $this->Html->link($jobVote['JobVote']['id'], array('controller' =>
                                    'JobVotes', 'action' => 'view', $jobVote['JobVote']['id'])); ?>
                                </td>
                                <td>
                                    <?php echo $this->Html->link($jobVote['JobVote']['title'], array('controller' =>
                                    'JobVotes', 'action' => 'view', $jobVote['JobVote']['id'])); ?>
                                </td>
                                <td>
                                    <?php foreach ($jobVote['JobOfferStaff'] as $jobofferstaff): ?>
                                    <?php echo $this->Html->link($jobofferstaff['RecRecruiter']['last_name'].' '.$jobofferstaff['RecRecruiter']['first_name'], array('controller' =>
                                    'RecRecruiters', 'action' => 'view', $jobofferstaff['RecRecruiter']['id'])); ?><br />
                                    <?php endforeach; ?>
                                </td>
                                <td>
                                    <?php
                                        foreach($jobVote['EvEvent'] as $event)
                                        {
                                        ?>
                                            <?php
                                            $date = new DateTime($event['created']);
                                            echo $this->Html->link($event['name'].' '.$date->format('Y/m/d'), array('controller' =>
                                             'EvHistories', 'action' => 'view', $event['id'])); ?><br />
                                        <?php
                                        }
                                     ?>
                                </td>
                                <td><?php echo h($jobType[$jobVote['JobVote']['jobtype_id']]); ?></td>
                                <td><?php echo h($jobVote['RecruitmentArea']['area']); ?></td>
                                <td><?php echo h($jobVote['JobVote']['wanted_person']); ?></td>
                                <?php
                                    //create new array sum count from
                                    $numexist[]=array();
                                    $arraynew_selstat=array();
                                    foreach($jobVote['SelStat'] as $selstat ): ?>
                                <?php
                                        $jobvote_id=$selstat['job_vote_id'];
                                        $selstat=$selstat['screening_stage_id'];
                                        $count=0;
                                        if(!in_array($selstat,$numexist)){
                                            foreach($jobVote['SelStat'] as $st)
                                            {
                                                if($selstat==$st['screening_stage_id'])
                                                {
                                                    $count=$count+$st['count'];
                                                }
                                            }
                                            array_push($numexist,$selstat);
                                            $arraynew_selstat[]=array('job_vote_id'=>$jobvote_id,'screening_stage_id'=>$selstat,'count'=>$count);
                                }
                                ?>
                                <?php endforeach; ?>
                                <?php foreach ($screeningStages as $key=>$value):?>
                                <?php
                                    $bl=false;
                                    $count=0;
                                    $job_vote_id=0;
                                    $screening_stage_id=0;
                                    $screening_stage_id_null_exist_count=$key;
                                    foreach($arraynew_selstat as $s):?>
                                <?php
                                        if($s['screening_stage_id']==$key)
                                        {
                                            $count= $s['count'];
                                            $job_vote_id=$s['job_vote_id'];
                                            $screening_stage_id=$s['screening_stage_id'];
                                            $bl=true;
                                        }
                                ?>
                                <?php endforeach;?>
                                <?php if($bl){ ?>
                                <td>
                                    <?php echo $this->Html->link($count, array('controller' =>
                                    'SelHistories', 'action' => 'index?job_vote_id='.$job_vote_id.'&screening_stage_id='.$screening_stage_id)); ?>
                                </td>
                                <?php }else{ ?>
                                <td>
                                    <?php echo $this->Html->link('0', array('controller' =>
                                    'SelHistories', 'action' => 'index?job_vote_id='.$job_vote_id.'&screening_stage_id='.$screening_stage_id_null_exist_count)); ?>
                                </td>
                                <?php } ?>
                                <?php endforeach; ?>
                                <td>
                                    <?php
                                        $date = new DateTime($jobVote['JobVote']['wanted_deadline']);
                                        echo $date->format('Y/m/d');
                                    ?>
                                </td>
                                <td>
                                    <?php
                                      $date = new DateTime($jobVote['JobVote']['start_date']);
                                      echo $date->format('Y/m/d');
                                     ?>
                                </td>
                                <td>
                                    <?php echo $this->Form->input('status', array('type'=>'select', 'label'=>false, 'class'=>'form-control select-w75 status', 'data-id'=>$jobVote['JobVote']['id'] , 'options'=>$status, 'default'=>$jobVote['JobVote']['status'])); ?>
                                </td>
                                <td>
                                    <?php
                                      $date = new DateTime($jobVote['JobVote']['created']);
                                      echo $date->format('Y/m/d');
                                    ?>
                                </td>
                                <td>
                                    <?php
                                      $date = new DateTime($jobVote['JobVote']['modified']);
                                      echo $date->format('Y/m/d');
                                     ?>
                                </td>
                                <td class='hover-button'>
                                    <?php
                                        echo $this->Html->link(
                                    '詳細',
                                    array(
                                    'controller' => 'JobVotes',
                                    'action' => 'view',
                                    $jobVote['JobVote']['id'],
                                    'full_base' => true,
                                    ),
                                    array(
                                    'class'=>'btn btn-primary btn-xs cl-white'
                                    )
                                    );
                                    ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <thead>
                            <tr>
                                <th class=''>求人票ID</th>
                                <th class=''>求人票タイトル</th>
                                <th class=''>求人担当者</th>
                                <th class=''>イベント名</th>
                                <th class=''>職種</th>
                                <th class=''>募集エリア</th>
                                <th class=''>募集人数</th>
                                <?php foreach ($screeningStages as $screeningStage): ?>
                                <th class=''>
                                    <?php echo h($screeningStage); ?>
                                </th>
                                <?php endforeach; ?>
                                <th class=''>募集期限</th>
                                <th class=''>公開開始日時</th>
                                <th class='w-10per'>ステータス</th>
                                <th class=''>登録日</th>
                                <th class=''>最終更新日</th>
                                <th class=''>操作</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    
                    <!--pagination-->
                      <div class="text-right clearfix mrt10">
                        <div class="pull-left">
                        <?php echo $this->Html->link(__('新規作成'), array('action' => 'add'),array('class'=>'btn btn-primary btn-sm')); ?>
                        </div>
                        <div class="bottom_pagination1 pull-right">
                          <ul class="pagination m-t-none">
                            <?php
                            echo $this->Paginator->prev('Prev', array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'paginate_button previous disabled'));
                            echo $this->Paginator->numbers(array('separator' => '','tag'=>'li','class'=>'paginate_button','currentClass'=>'paginate_button active','currentTag'=>'a'));
                            echo $this->Paginator->next('Next', array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'paginate_button next disabled'));
                            ?>  
                          </ul>
                        </div>
                        <span class="sp-text-pg pull-right"><?php echo $this->Paginator->counter("{:count} 件中 {:start}-{:end} 件表示")?>&nbsp;&nbsp;</span>
                      </div>
                      <!--pagination-->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.status').change(function(){
        var id=$(this).data('id');
        var status= $(this).find('option:selected').val();
        var _url = '<?php echo $this->webroot;?>JobVotes/api_status';
       // var abc=$(this);
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: _url,
            data:("id="+id+"&status="+status),
            success: function(res){
                if(res.code==0) {
                  //  abc.parents('tbody > tr').remove();
                }
            }
        });
    });
</script>
<?php return; ?>
<div class="jobVotes index">
    <h2><?php echo __('Job Votes'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('title'); ?></th>
            <th><?php echo $this->Paginator->sort('rec_department_id'); ?></th>
            <th><?php echo $this->Paginator->sort('jobtype_id'); ?></th>
            <th><?php echo $this->Paginator->sort('wanted_person'); ?></th>
            <th><?php echo $this->Paginator->sort('wanted_deadline'); ?></th>
            <th><?php echo $this->Paginator->sort('start_salary'); ?></th>
            <th><?php echo $this->Paginator->sort('start_date'); ?></th>
            <th><?php echo $this->Paginator->sort('recruitment_area_id'); ?></th>
            <th><?php echo $this->Paginator->sort('wanted_year'); ?></th>
            <th><?php echo $this->Paginator->sort('rikunavi_id'); ?></th>
            <th><?php echo $this->Paginator->sort('mynavi_id'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($jobVotes as $jobVote): ?>
        <tr>
            <td><?php echo h($jobVote['JobVote']['id']); ?>&nbsp;</td>
            <td><?php echo h($jobVote['JobVote']['title']); ?>&nbsp;</td>
            <td>
                <?php echo $this->Html->link($jobVote['RecDepartment']['department_name'], array('controller' =>
                'rec_departments', 'action' => 'view', $jobVote['RecDepartment']['id'])); ?>
            </td>
            <td><?php echo $this->Enjin->getJobTypeName($jobVote['JobVote']['jobtype_id']); ?>&nbsp;</td>
            <td><?php echo h($jobVote['JobVote']['wanted_person']); ?>&nbsp;</td>
            <td><?php echo h($jobVote['JobVote']['wanted_deadline']); ?>&nbsp;</td>
            <td><?php echo h($jobVote['JobVote']['start_salary']); ?>&nbsp;</td>
            <td><?php echo h($jobVote['JobVote']['start_date']); ?>&nbsp;</td>
            <td><?php echo h($jobVote['RecruitmentArea']['area']); ?></td>
            <td><?php echo h($jobVote['JobVote']['wanted_year']); ?>&nbsp;</td>
            <td><?php echo h($jobVote['JobVote']['rikunavi_id']); ?>&nbsp;</td>
            <td><?php echo h($jobVote['JobVote']['mynavi_id']); ?>&nbsp;</td>
            <td class="actions">
                <?php echo $this->Html->link(__('View'), array('action' => 'view', $jobVote['JobVote']['id'])); ?>
                <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $jobVote['JobVote']['id'])); ?>
                <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $jobVote['JobVote']['id']),
                array('confirm' => __('Are you sure you want to delete # %s?', $jobVote['JobVote']['id']))); ?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <p>
        <?php
	echo $this->Paginator->counter(array(
        'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record
        {:start}, ending on {:end}')
        ));
        ?> </p>

    <div class="paging">
        <?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
    </div>
</div>
