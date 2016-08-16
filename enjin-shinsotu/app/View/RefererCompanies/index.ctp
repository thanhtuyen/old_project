<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>エージェント管理</h2>
    </div>
</div>
<!---end title-->
<div class="wrapper wrapper-content row animated fadeInRight">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>流入元企業一覧</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <?php echo $this->Form->create('RefererCompanies',array(
                'type'=>'get',
                'url' => array('controller' => 'RefererCompanies', 'action' => 'index')
                ));
                ?>
                <!-- content -->
                <div class="ibox-content bg-gray clearfix form-edit2 p-sm">
                    <form>
                        <div class='form-group'>
                            <label class="col-lg-1 pull-left p-xs">企業名</label>
                            <div class="col-lg-3">
                                <?php
                                echo $this->Form->input('name',array('class' => 'form-control','div'=>false,'label' =>false,'placeholder'=>'', 'value'=>$param['name'] ));
                                ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <label class="col-lg-1 pull-left p-xs">都道府県</label>
                            <div class="col-lg-3">
                                <?php
                                echo $this->Form->input('prefectures', array('options' => $prefectures,'label'=>false,'class'=>'form-control','div'=>false, 'value'=>$param['prefectures'] ));
                                ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <div class="col-lg-4 row">
                                <label class="col-lg-3 pull-left p-xs">求人票</label>
                                <div class="col-lg-9">
                                    <?php
                                    echo $this->Form->input('jobvote', array('options' => $jobVote,'label'=>false,'class'=>'form-control mg-l-7','div'=>false, 'value'=>$param['jobvote'] ));
                                    ?>
                                </div>
                            </div>
                            <div class="col-lg-4 row">
                                <label class="col-lg-4 pull-left p-xs">流入元タイプ</label>
                                <div class="col-lg-8">
                                    <?php
                                    echo $this->Form->input('originaltype', array('options' => $originalType,'label'=>false,'class'=>'form-control','div'=>false, 'value'=>$param['originaltype'] ));
                                    ?>
                                </div>
                            </div>
                            <div class="col-lg-3 row">
                                <label class="col-lg-3 pull-left p-xs">契約</label>
                                <div class="col-lg-9">
                                    <?php
                                    echo $this->Form->input('status', array('options' => $status,'label'=>false,'class'=>'form-control','div'=>false, 'value'=>$param['status'] ));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>

                        <div class="from_calen">
                            <?php echo $this->Form->button(__('検索'),array(
                                'class' => 'btn btn-primary',
                                'div'=> false,
                                'type'=>'submit'
                                ));?>
                                <?php echo $this->Html->link(__('クリア'), array('action' => 'index'),array('class'=>'text-29bbef')); ?>
                            </div>

                        </form>
                
                    <?php echo $this->Form->end(); ?>
                </div>
                <!-- end ibox -->
                <!-- content -->
                <div class="ibox-content">
                    <div class="table-responsive">
                        <!--pagination-->
            <div class="text-right clearfix">
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

                        <table class="table table-striped table-bordered tbl-data">
                            <thead>
                                <tr>
                                    <th>流入元企業ID</th>
                                    <th>会社名</th>
                                    <th>都道府県</th>
                                    <th>市区町村</th>
                                    <th width="20%">求人票</th>
                                    <th>流入元タイプ</th>
                                    <th>契約数</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($refererCompanies as $referer): ?>
                                    <tr>
                                    <td>
                                            <?php echo $this->Html->link($referer['RefererCompany']['id'], array('controller' =>
                                            'RefererCompanies', 'action' => 'detail',$referer['RefererCompany']['id'])); ?><br />
                                        </td>
                                        <td>
                                            <?php echo $this->Html->link($referer['RefererCompany']['name'], array('controller' =>
                                            'RefererCompanies', 'action' => 'detail',$referer['RefererCompany']['id'])); ?><br />
                                        </td>
                                        <td><?php echo $referer['Prefecture']['name'];?></td>
                                        <td><?php echo $referer['City']['name'];?></td>
                                        <td >
                                            <?php foreach($referer['InfJobVotePublic'] as $info):?>
                                                <?php if ( !empty( $jobVote[$info['job_vote_id']]  )): ?>
                                                    <?php echo $this->Html->link( $jobVote[$info['job_vote_id']], array('controller' =>'JobVotes', 'action' => 'view', $info['job_vote_id'])); ?><br />
                                                <?php endif; ?>
                                            <?php endforeach;?>
                                        </td>
                                        <td><?php echo $originalType[$referer['RefererCompany']['influx_original_type']];?></td>
                                        <td><?php echo count($referer['InfContract']);?></td>
                                        <td class="table-button-tdright hover-button">
                                            <?php
                                            echo $this->Html->link(
                                                '詳細',
                                                array(
                                                    'controller' => 'RefererCompanies',
                                                    'action' => 'detail',
                                                    'full_base' => true,
                                                    $referer['RefererCompany']['id']
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
                                        <th>流入元企業ID</th>
                                        <th>会社名</th>
                                        <th>都道府県</th>
                                        <th>市区町村</th>
                                        <th>求人票</th>
                                        <th>流入元タイプ</th>
                                        <th>契約数</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                            </table>
                            <!--pagination-->
            <div class="text-right">
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
    </div>
</div>
</div>
</div>