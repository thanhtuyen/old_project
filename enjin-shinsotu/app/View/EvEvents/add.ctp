<?php echo $this->Html->css('enjin/7_06_search.css'); ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>イベント登録
        </h2>
    </div>
</div>
<div class="wrapper wrapper-content row animated fadeInRight clearfix">

    <div class="plist-two-layout">
        <!--layout left-->
        <div class="col-lg-8 pd-bottom-none">
            <div class="ibox">

                <div class="ibox-title">
                    <h5>イベント情報</h5>

                </div>
                <div class="ibox-content bg-white">

                    <?php echo $this->Form->create('EvEvent',array('type'=>'post','class'=>'form-horizontal
                    form-edit')); ?>

                    <div class="form-group">
                        <label class="col-sm-4 control-label text-right">イベント名</label>

                        <div class="col-sm-8">
                            <?php echo $this->Form->input('name', array(
                            'class'=>'form-control',
                            'type'=>'text',
                            'label'=>false
                            )); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label text-right text-right">求人票</label>

                        <div class="col-sm-8">
                            <?php echo $this->Form->input('job_vote_id', array(
                            'options' => $jobVotes,
                            'class'=>'form-control',
                            'label'=>false
                            )); ?>

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-4 control-label text-right">イベント種別</label>

                        <div class="col-sm-8">

                            <?php echo $this->Form->input('type', array(
                            'options'=>$type,
                            'class'=>'form-control',
                            'label'=>false
                            )); ?>

                        </div>
                    </div>

                    <!-- textarea -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label text-right">ターゲット選考段階</label>

                        <div class="col-sm-8">

                            <?php echo $this->Form->input('screening_stage_id', array(
                            'options'=>$ScreeningStages,
                            'class'=>'form-control',
                            'label'=>false
                            )); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label text-right">ターゲット選考段階比較タイプ
                        </label>

                        <div class="col-sm-8">
                            <?php echo $this->Form->input('screening_stage_type', array(
                            'options' => $screeningStageType,
                            'class'=>'form-control',
                            'label'=>false ));
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label text-right">ターゲット選考ステータス （マスタ）</label>

                        <div class="col-sm-8">
                            <?php echo $this->Form->input('target_select_id', array(
                            'options' => $selectJudgmentType,
                            'class'=>'form-control',
                            'label'=>false ));
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label text-right">イベント内容</label>

                        <div class="col-sm-8">
                            <?php echo $this->Form->input('contents', array(
                            'class'=>'form-control',
                            'label'=>false
                            )); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label text-right">リクナビID</label>

                        <div class="col-sm-8">
                            <?php echo $this->Form->input('rikunavi_id', array(
                            'type'=>'text',
                            'class'=>'form-control',
                            'label'=>false
                            )); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label text-right">マイナビID</label>

                        <div class="col-sm-8">
                            <?php echo $this->Form->input('mynavi_id', array(
                            'type'=>'text',
                            'class'=>'form-control',
                            'label'=>false
                            )); ?>
                        </div>
                    </div>

                    <div class="btn-clear">
                        <a class='text-navy btn-reset' href="javascript:void(0)">クリア</a>

                        <?php echo $this->Form->submit(__('登録'),array(
                        'class'=>'btn w-95 btn-primary',
                        'div'=>false
                        ));?>

                    </div>

                    <?php echo $this->Form->end()?>

                </div>
            </div>
        </div>

        <!--layout right-->
        <div class="col-lg-4">
            <!--layout calender-->
            <div class="ibox">
                <div class="ibox-title">
                    <h5>求人担当者登録</h5>

                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>

                <div class="ibox-content bg-white">
                    <div class="txt-align txtremove">求人票未選択</div>
                    <table class="table subcontents-sb-1 table-bordered no-margin-bottom" id="detailPersonRegister">
                        <tbody>

                        </tbody>
                    </table>

               

                </div>

            </div>

        </div>
    </div>
   
</div>
<script id="RecRecruiterTmpl" type="text/x-jquery-tmpl">
    <tr>
        <th>求人票ID</th>
        <td><a class="text-navy" href="">${id}</a></td>
    </tr>

    <tr>
        <th>求人票タイトル</th>
        <td>${title}</td>
    </tr>
    <tr>
        <th>募集要項</th>
        <td>${requirement}</td>
    </tr>
    <tr>
        <th>職種タイプ</th>
        <td>${jobtype_id}</td>
    </tr>
    <tr>
        <th>初任給</th>
        <td>${start_salary}万円</td>
    </tr>
    <tr>
        <th>待遇</th>
        <td>${treatment}</td>
    </tr>
    <tr>
        <th>応募資格</th>
        <td>${qualification_require}</td>
    </tr>
    <tr>
        <th>募集人数</th>
        <td>${wanted_person}人</td>
    </tr>
    <tr>
        <th>募集期限</th>
        <td>${wanted_deadline}</td>
    </tr>
    <tr>
        <th>公開開始日時</th>
        <td>${start_date}</td>
    </tr>
    <tr>
        <th>募集エリア</th>
        <td>${recruitment_area_id}</td>
    </tr>

</script>

<script>
    $(document).ready(function () {
        $('#EvEventJobVoteId').on('change', function () {
            var _id = $(this).find('option:selected').val();
            if(_id=='')
            {
                $("#detailPersonRegister").find('tbody').html("");
                $(".txtremove").html("求人票未選択");
                return;
            }
            var _url = '<?php echo $this->webroot;?>JobVotes/api_get/' + _id;
            $.ajax({
                type: "GET",
                dataType: "JSON",
                url: _url,
                success: function (res) {
                    $("#detailPersonRegister").find('tbody').html("");
                    $(".txtremove").html("");
                    $("#RecRecruiterTmpl").tmpl(res).appendTo("#detailPersonRegister").find('tbody');
                    if($('.fa-chevron-down').length){
                        $('.collapse-link').click();
                    }
                },
                error: function (e) {
                }
            });
        });

    });

    $(function () {
        $('.btn-reset').click(function () {
            $('#EvEventAddForm')[0].reset();
        });
    });

</script>
