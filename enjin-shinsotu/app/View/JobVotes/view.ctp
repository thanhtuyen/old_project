<?php
//職種
$jobType = Configure::read('job_type')[$jobVote['JobVote']['jobtype_id']];
$this->start('single');
// echo $this->Html->css('test.css');
$this->end();
//debug($jobVote);
echo $this->element('back_nav', array('text' => __('求人票詳細｜ ID%d %s', $jobVote['JobVote']['id'], $jobVote['JobVote']['title'])))?>

<div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">
    <!-- content -->

    <div class='full-content'>
        <div class='col-lg-8'>
            <div class='ibox'>

                <div class="ibox-title">
                    <h5>求人票詳細</h5>

                    <div class="ibox-tools">
                        <button type='button' class='btn btn-primary btn-xs' onclick="window.location.href='<?php echo $this->Html->url(array("action" => "edit",$jobVote['JobVote']['id']));?>'"><?php echo __('編集');?></button>
                    </div>
                </div>
                <div class='ibox-content bg-white p-sm'>
                    <form method="get" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">タイトル</label>

                            <div class="col-sm-8">
                                <div class="form-control border-none"><?php echo $jobVote['JobVote']['title']; ?></div>
                            </div>
                        </div>

                        <!-- textarea -->
                        <div class="form-group"><label class="col-sm-4 control-label">募集要項</label>

                            <div class="col-sm-8">
                                <div class="form-control border-none mul-text"><?php echo $jobVote['JobVote']['requirement']; ?></div>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-4 control-label">職種タイプ</label>

                            <div class="col-sm-8">
                                <div class="form-control border-none"><?php echo $jobType; ?></div>
                            </div>
                        </div>

                        <!-- textarea -->
                        <div class="form-group"><label class="col-sm-4 control-label">待遇</label>

                            <div class="col-sm-8">
                                <div class="form-control border-none mul-text"><?php echo $jobVote['JobVote']['treatment']; ?></div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-4 control-label">応募資格</label>

                            <div class="col-sm-8">
                                <div class="form-control border-none"><?php echo $jobVote['JobVote']['qualification_require']; ?></div>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-4 control-label">募集人数</label>

                            <div class="col-sm-8">
                                <div class="form-control border-none"><?php echo $jobVote['JobVote']['wanted_person']; ?>人</div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-4 control-label">応募期限</label>

                            <div class="col-sm-8">
                                <div class="form-control border-none"><?php echo date('Y年m月d日', strtotime($jobVote['JobVote']['wanted_deadline'])); ?></div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-4 control-label">公開開始日時</label>

                            <div class="col-sm-8">
                                <div class="form-control border-none"><?php echo date('Y年m月d日', strtotime($jobVote['JobVote']['start_date'])); ?></div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-4 control-label">募集エリアID</label>

                            <div class="col-sm-8">
                                <div class="form-control border-none"><?php echo $recruitmentArea['RecruitmentArea']['area']; ?></div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-4 control-label">募集年度</label>

                            <div class="col-sm-8">
                                <div class="form-control border-none"><?php echo $jobVote['JobVote']['wanted_year']; ?>年</div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-4 control-label">リクナビID</label>

                            <div class="col-sm-8">
                                <div class="form-control border-none"><?php echo $jobVote['JobVote']['rikunavi_id']; ?></div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-4 control-label">最終更新担当者</label>
                            <?php if(!empty($recRecruiter)): ?>
                            <div class="col-sm-8">

                                <div class="form-control border-none">
                                    <?php echo $this->Html->link($recRecruiter['RecRecruiter']['name'], array('controller' =>                                    'RecRecruiters', 'action' => 'view', $recRecruiter['RecRecruiter']['id'])); ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
            <div class='ibox'>
<?php
//debug($jobVote['JobSelectTarget']);
?>
                <div class="ibox-title">
                    <h5>求人選考段階目標</h5>

                    <div class="ibox-tools">
                       <a href="<?php echo $this->webroot;?>JobSelectTargets/edit/<?php echo $jobVote['JobVote']['id']; ?>" class="btn btn-primary btn-xs">編集</a>
                    </div>
                </div>
                <div class='ibox-content bg-white p-sm'>
                    <table class="table table-bordered no-margin-bottom">
                        <thead>
                        <tr class=''>
                            <th class=''>段階</th>
                            <th class=''>目標値</th>
                            <th class=''>達成期限年月日</th>
                        </tr>
                        </thead>
                        <tbody>
<?php
    foreach($jobVote['JobSelectTarget'] as $jobSelect):
        $judgmentType = Configure::read('select_judgment_type')[$jobSelect['screening_stage_id']];
?>
                        <tr>
                            <td class="table-button-tdleft"><?php echo $judgmentType; ?></td>
                            <td class="table-button-tdleft"><?php echo $jobSelect['target_number']; ?></td>
                            <td class="table-button-tdleft"><?php echo date('Y年m月d日', strtotime($jobSelect['attain_deadline_date'])); ?></td>
                        </tr>
<?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
<?php
// debug($jobVote['JobOfferStaff']);
?>
            <div class="ibox">
                <div class="ibox-title">
                    <h5>求人担当者登録</h5>

                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content clearfix p-sm">

                    <div class=''>
                        <div class="table-border">
                            <table class="table table-bordered no-margin-bottom" id="jobOfferStaffBox">
                                <thead>
                                <tr>
                                    <th>求人担当者名</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
<?php if(!empty($jobVote['JobOfferStaff'])): ?>
<?php   foreach($jobVote['JobOfferStaff'] as $staff): ?>

                                <tr>
                                    <td>
                                        <?php echo $this->Html->link($staff['name'], array('controller' =>                                    'RecRecruiters', 'action' => 'view', $staff['rec_recruiter_id'])); ?>
                                    </td>
                                    <td class="table-button-tdright">
                                        <button class="full-width btn btn-default btn-xs rec-recuruit-delete" data-id="<?php echo $staff['id']; ?>">削除</button>
                                    </td>
                                </tr>

<?php   endforeach; ?>
<?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class='ibox-content clearfix bg-sl-btn pd-9'>
                    <table class='table no-margin-bottom'>
                        <tbody>

                        <tr>
                            <td class='no-borders ver-mid full-width'>
                                <?php
                                    echo $this->Form->input('selRecruiter', array(
                                        'empty'    => '採用担当者選択',
                                        'type'     => 'select',
                                        'options'  => $recruiterLists,
                                        'class'    => 'btn full-width',
                                        'label'    => false,
                                        'div'      => false,
                                        'error'    => false,
                                        'required' => true,
                                        'id' => 'selRecruiter'
                                    ));
                                ?>
                            </td>
                            <td class='no-borders ver-mid'>
                                <button class="full-width btn btn-primary btn-sm" id="AddSelRecruiter">追加</button>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="ibox ">
<?php
//debug($jobVote['EvEvent']);
?>
                <div class="ibox-title">
                    <h5>イベント登録</h5>

                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content clearfix p-sm">

                    <div class=''>
                        <div class="table-border">
                            <table class="table table-bordered no-margin-bottom" id="EvEventBox">
                                <thead>
                                <tr>
                                    <th>登録イベント名</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
<?php if(!empty($jobVote['EvEvent'])): ?>
<?php   foreach($jobVote['EvEvent'] as $event): ?>

                                <tr>
                                    <td>
                                        <?php echo $this->Html->link($event['name'], array('controller' => 'EvHistories', 'action' => 'view', $event['id'])); ?>
                                    </td>
                                    <td class="table-button-tdright">
                                        <button class="full-width btn btn-default btn-xs event-delete" data-id="<?php echo $event['id']; ?>">削除</button>
                                    </td>
                                </tr>
<?php   endforeach; ?>
<?php endif; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class='ibox-content clearfix bg-sl-btn pd-9'>
                    <table class='table no-margin-bottom'>
                        <tbody>
                        <tr>
                            <td class='no-borders ver-mid full-width'>
                                <?php
                                    echo $this->Form->input('selRecruiter', array(
                                        'empty'    => 'イベント選択',
                                        'type'     => 'select',
                                        'options'  => $eventLists,
                                        'class'    => 'btn full-width',
                                        'label'    => false,
                                        'div'      => false,
                                        'error'    => false,
                                        'required' => true,
                                        'id' => 'selEvent'
                                    ));
                                ?>
                            </td>

                            <td class='no-borders ver-mid'>
                                <a href="<?php echo $this->webroot;?>EvEvents/add" class="full-width btn btn-primary btn-sm" style="color: #fff;" target="_blank">日程追加</a>
                            </td>
                            <td class='no-borders ver-mid'>
                                <button class="full-width btn btn-primary btn-sm" id="AddSelEvent">追加</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="ibox ">
<?php
//debug($jobVote['InfJobVotePublic']);
?>
                <div class="ibox-title">
                    <h5>求人票公開先流入元企業</h5>
                    <div class="ibox-tools">
                        <a href="<?php echo $this->webroot;?>referer_companies/add" class="btn btn-primary btn-xs">新規追加</a>
                    </div>
                </div>
                <div class="ibox-content clearfix p-sm">
                    <div class=''>
                        <div class="table-border">
                            <table class="table table-bordered no-margin-bottom" id="infJobVotePublicBox">
                                <thead>
                                <tr>
                                    <th>求人票公開先流入元企業名</th>
                                    <th>状況</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
<?php if(!empty($jobVote['InfJobVotePublic'])): ?>
<?php   foreach($jobVote['InfJobVotePublic'] as $data): ?>
                                <tr>
                                    <td><?php echo h($data['RefererCompany']['name']); ?></td>
                                    <td><?php echo Configure::read('job_vote_status')[h($data['status'])]; ?></td>
                                    <td></td>
                                </tr>
<?php   endforeach; ?>
<?php endif; ?>
                                </tbody>
                                <tfoot>
                                <tr>

                                    <td class='no-borders ver-mid btn-group btn-block'>
                                    <?php
                                        echo $this->Form->input('selRefererCompany', array(
                                            'empty'    => '流入元企業選択',
                                            'type'     => 'select',
                                            'options'  => $recCompanies,
                                            'class'    => 'btn btn-white btn-sm  btn-block',
                                            'label'    => false,
                                            'div'      => false,
                                            'error'    => false,
                                            'required' => true,
                                            'id' => 'selRefererCompany'
                                        ));
                                    ?>
                                    </td>
                                    <td class='w-95'>
                                    <?php
                                        echo $this->Form->input('selRefererStatus', array(
                                            'empty'    => '状況選択',
                                            'type'     => 'select',
                                            'options'  => Configure::read('job_vote_status'),
                                            'class'    => 'btn btn-white btn-sm  btn-block',
                                            'label'    => false,
                                            'div'      => false,
                                            'error'    => false,
                                            'required' => true,
                                            'id' => 'selRefererStatus'
                                        ));
                                    ?>
                                    </td>


                                    <td class="ver-mid">
                                        <button class="full-width btn btn-primary btn-xs" id="AddSelRefererCompany">更新</button>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>


            </div>


        </div>
    </div>


</div>

<?php echo $this->element('b_back_nav')?>
<script id="RecRecruiterTmpl" type="text/x-jquery-tmpl">
<tr>
    <td><a class='text-navy' href="">${name}</a></td>
    <td class="table-button-tdright">
        <button class="full-width btn btn-default btn-xs rec-recuruit-delete" data-id="${id}">削除</button>
    </td>
</tr>
</script>

<script id="EventTmpl" type="text/x-jquery-tmpl">
<tr>
    <td><a class='text-navy' href="">${name}</a></td>
    <td class="table-button-tdright">
        <button class="full-width btn btn-default btn-xs event-delete" data-id="${id}">削除</button>
    </td>
</tr>
</script>

<script id="InfJobVotePublicsTmpl" type="text/x-jquery-tmpl">
<tr>
    <td>${name}</td>
    <td>${status}</td>
    <td></td>
</tr>
</script>

<script id="EvEventTmpl" type="text/x-jquery-tmpl">
<tr>
    <td><a class='text-navy' href="">${name}</a></td>
    <td class="table-button-tdright">
        <button class="full-width btn btn-default btn-xs event-delete" data-id="${id}">削除</button>
    </td>
</tr>
</script>

<script id="EventSelectTmpl" type="text/x-jquery-tmpl">
<option value="${id}">${name}</option>
</script>


<script>
$("#AddSelRecruiter").on('click',function(){
    if($('#selRecruiter').val() == ''){
        alert('採用担当者を選択してください。');
        return;
    }
    var _url          = '<?php echo $this->webroot;?>JobOfferStaffs/api_add/';
    var _recruiter_id = $('#selRecruiter').val();
    var _vote_id      = '<?php echo $jobVote['JobVote']['id']; ?>';
    var _data         = 'job_vote_id='+_vote_id+'&rec_recruiter_id='+_recruiter_id+'&last_modified_recruiter_id='+_recruiter_id;

    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: _url,
        data: _data,
        success: function(res){
            if(res.status) {
                if(res.data) {
                    $("#RecRecruiterTmpl").tmpl(res.data).appendTo("#jobOfferStaffBox").find('tbody tr');
                }
            }else{
                if(res.data.error.length != 0) {
                    if(res.data.error == 'exits') {
                        alert('登録済みです。');
                    }
                }
            }
        }
    });

    return false;
});
$(document).on('click',".rec-recuruit-delete",function(){
    if($(this).data('id').length != 0) {
        var _id = $(this).data('id');
        var _target = $(this).parent().parent();
        if (confirm('削除しますか？')) {
            var _url  = '<?php echo $this->webroot;?>JobOfferStaffs/api_delete/?id='+_id;
            $.ajax({
                type: "GET",
                dataType: "JSON",
                url: _url,
                success: function(res){
                    console.log(res);
                    if(res.status) {
                        _target.remove();
                    }
                },
                error: function(e) {
                }
            });
        }else{
            return false;
        }
    }

    return false;
});


$("#AddSelEvent").on('click',function(){
    if($('#selEvent').val() == ''){
        alert('イベントを選択してください。');
        return;
    }
    var _url          = '<?php echo $this->webroot;?>EvEvents/api_add/';
    var _event_id     = $('#selEvent').val();
    var _vote_id      = '<?php echo $jobVote['JobVote']['id']; ?>';
    var _data         = 'id='+_event_id+'&job_vote_id='+_vote_id;

    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: _url,
        data: _data,
        success: function(res){
            if(res.status) {
                if(res.data) {
                    $("#EvEventTmpl").tmpl(res.data).appendTo("#EvEventBox").find('tbody tr').data('id', res.data.ev_history_id);
                    getEventLists(<?php echo $jobVote['JobVote']['id']; ?>);
                }
            }else{
                if(res.data.error.length != 0) {
                    if(res.data.error == 'exits') {
                        alert('登録済みです。');
                    }
                }
            }
        },
        error: function(res) {
            console.log("ERROR");
        }
    });

    return false;
});

$(document).on('click',".event-delete",function(){
    if($(this).data('id').length != 0) {
        var _id = $(this).data('id');
        var _target = $(this).parent().parent();
        if (confirm('削除しますか？')) {
            var _url  = '<?php echo $this->webroot;?>EvEvents/api_delete/?id='+_id+'&job_vote_id=0';
            $.ajax({
                type: "GET",
                dataType: "JSON",
                url: _url,
                success: function(res){
                    if(res.status) {
                        _target.remove();
                        getEventLists();
                    }
                },
                error: function(e) {
                }
            });
        }else{
            return false;
        }
    }

    return false;
});



$("#AddSelRefererCompany").on('click',function(){
    if($('#selRefererCompany').val() == ''){
        alert('流入元企業を選択してください。');
        return;
    }
    if($('#selRefererStatus').val() == ''){
        alert('状況を選択してください。');
        return;
    }
    var _url                    = '<?php echo $this->webroot;?>InfJobVotePublics/api_add/';
    var _referer_company_id     = $('#selRefererCompany').val();
    var _referer_company_status = $('#selRefererStatus').val();
    var _job_vote_id            = '<?php echo $jobVote['JobVote']['id']; ?>';
    var _data                   = 'referer_company_id='+_referer_company_id+'&status='+_referer_company_status+'&job_vote_id='+_job_vote_id;
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: _url,
        data: _data,
        success: function(res){
            if(res.status) {
                if(res.data) {
                    $("#InfJobVotePublicsTmpl").tmpl(res.data).appendTo("#infJobVotePublicBox").find('tbody tr')
                }
            }else{
                if(res.data.error.length != 0) {
                    if(res.data.error == 'exits') {
                        alert('登録済みです。');
                    }
                }
            }
        },
        error: function(e){
            // console.log("ERROR");
            // console.log(e);
        }
    });

    return false;
});



function getEventLists() {
    var _url = '<?php echo $this->webroot;?>EvEvents/api_list';
    console.log(_url);
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: _url,
        success: function(res, status, xhr){
            if(xhr.status == 200) {
                $("#selEvent option:not(:first)").remove();
                $.each(res,function(e){
                  $("#EventSelectTmpl").tmpl(res[e]['EvEvent']).appendTo("#selEvent");
                });
            }else{
                $("#selEvent option:not(:first)").remove();
            }
        },
        error: function(e){
            // console.log("ERROR");
            // console.log(e);
        }
    });
}

</script>