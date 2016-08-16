<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>求人票登録</h2>
    </div>
</div>
<div class="wrapper wrapper-content row animated fadeInRight clearfix">
    <!-- content -->
    <div class='full-content'>
        <div class='col-lg-8'>
            <div class='ibox'>
                <div class="ibox-title">
                    <h5>求人表詳細</h5>
                </div>
                <!-- form add -->
                <div class="ibox-content bg-white p-sm pd-bottom-none pd-right-none" id="jobVoteRegister">
                    <?php echo $this->Form->create('JobVote',array('class'=>'form-horizontal form-edit')); ?>
                    <?php echo $this->Form->input('rec_recruiter_id',array('type'=>'hidden','class' => 'form-control','label' =>false,'value'=>$userInfo['id'])); ?>

                        <div class="form-group"><label class="col-sm-4 control-label">タイトル</label>
                            <div class="col-sm-8">
                                <?php echo $this->Form->input('title',array('class' => 'form-control','label' =>false,'placeholder'=>'タイトル入力'));?>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-4 control-label">部署</label>
                            <div class="col-sm-8">
                                <?php echo $this->Form->input('rec_department_id',array('class' => 'form-control','label' =>false));?>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-4 control-label">募集要項</label>
                            <div class="col-sm-8">
                                <?php echo $this->Form->textarea('requirement',array('class'=>'form-control','label' =>false,'placeholder'=>'募集要項入力')); ?>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-4 control-label">職種タイプ</label>
                            <div class="col-sm-8">
                                <?php echo $this->Form->input('jobtype_id',array('options' => $jobType,'class' => 'form-control','label' =>false,'placeholder'=>'タイトル入力'));?>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-4 control-label">初任給</label>
                            <div class="col-sm-8">
                                <?php echo $this->Form->input('start_salary',array('type'=>'number','class' => 'form-control','label' =>false,'placeholder'=>'タイトル入力'));?>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-4 control-label">待遇</label>
                            <div class="col-sm-8">
                                <?php echo $this->Form->textarea('treatment',array('class'=>'form-control','label' =>false,'placeholder'=>'待遇')); ?>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-4 control-label">応募資格</label>
                            <div class="col-sm-8">
                                <?php echo $this->Form->textarea('qualification_require',array('class'=>'form-control','label' =>false,'placeholder'=>'応募資格')); ?>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-4 control-label">募集人数</label>
                            <div class="col-sm-8">
                                <div class="" id="data_3">
                                    <?php echo $this->Form->input('wanted_person',array('class'=>'form-control text-right w-95','label' =>false,'div'=>false,'default'=>0)); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-4 control-label">応募期限</label>
                            <div class="padding-lf30 col-sm-8">
                                <div class="row f_left" id="data_1">
                                    <div class="input-group date">
                                      <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </span>
                                        <?php echo $this->Form->input('wanted_deadline1',array('type' => 'text','class'=>'form-control','label' =>false,'div'=>false)); ?>
                                        <?php echo $this->Form->input('wanted_deadline',array('type'=>'hidden','class' => 'form-control','label' =>false)); ?>
                                    </div>
                                </div>

                                <div class="input-group clockpicker f_right_calendar" data-autoclose="true">

                                    <span class="input-group-addon">
                                      <span class="fa fa-clock-o"></span>
                                    </span>
                                    <input type="text" name="wanted_deadline_time" class="form-control" value="09:30" >
                                </div>
                                <div class="clear"></div>
                                <!--clock-->
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-4 control-label">公開開始日時</label>
                            <div class="padding-lf30 col-sm-8">
                                <div class="form-group f_left" id="data_2">
                                    <div class="input-group date">
                                      <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </span>
                                        <?php echo $this->Form->input('start_date1',array('type' => 'text','class'=>'form-control','label' =>false,'div'=>false)); ?>
                                        <?php echo $this->Form->input('start_date',array('type'=>'hidden','class' => 'form-control','label' =>false)); ?>
                                    </div>
                                </div>

                                <div class="input-group clockpicker f_right_calendar" data-autoclose="true">

                                    <span class="input-group-addon">
                                      <span class="fa fa-clock-o"></span>
                                    </span>
                                    <input type="text" name="start_date_time" class="form-control" value="09:30" >
                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="form-group"><label class="col-sm-4 control-label">募集エリアID</label>
                                <div class="padding-lf35 col-sm-8 row">
                                    <?php echo $this->Form->input('recruitment_area_id',array('class' => 'form-control','label' =>false));?>
                                </div>
                            </div>

                            <div class="form-group"><label class="col-sm-4 control-label">募集年度</label>
                                <div class="col-sm-8">
                                    <?php
                                        if (isset($wanted_year)) {
                                            $year='';
                                        ?>
                                            <?php foreach ($wanted_year as $wy): ?>
                                                <?php
                                                 if(!empty($wy))
                                                 {
                                                    $year=$wy;
                                                 }?>
                                            <?php endforeach;?>
                                            <?php echo $this->Form->input('wanted_year',array('class' => 'form-control','label' =>false,'default'=>$year, 'options' => $wanted_year)); ?>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="form-group"><label class="col-sm-4 control-label">リクナビID</label>
                                <div class="padding-lf35 col-sm-8 row">
                                    <?php echo $this->Form->input('rikunavi_id',array('type' => 'text','class' => 'form-control','label' =>false,'placeholder'=>'ID入力'));?>
                                </div>
                            </div>

                            <div class="form-group"><label class="col-sm-4 control-label">マイナビID</label>
                                <div class="padding-lf35 col-sm-8 row">
                                    <?php echo $this->Form->input('mynavi_id',array('type' => 'text','class' => 'form-control','label' =>false,'placeholder'=>'ID入力'));?>
                                </div>
                            </div>

                            <div class="btn-clear">
                                <a class="text-navy btn-reset" href="javascript:void(0)">クリア</a>
                                <?php echo $this->Form->submit('登録',array('class'=>'btn btn-primary w-95 h-34','div'=>false)); ?>
                            </div>
                     <?php echo $this->Form->end(); ?>
                </div>
                <!-- end form add -->
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: 'yyyy/mm/dd'
        });

        $('#data_2 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: 'yyyy/mm/dd'
        });

        $('input[name="daterange"]').daterangepicker();
        $('.clockpicker').clockpicker();
        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

        $('#reportrange').daterangepicker({
            format: 'YYYY/MM/DD',
            startDate: moment().subtract(29, 'days'),
            endDate: moment(),
            minDate: '01/01/2012',
            maxDate: '12/31/2015',
            dateLimit: {days: 60},
            showDropdowns: true,
            showWeekNumbers: true,
            timePicker: false,
            timePickerIncrement: 1,
            timePicker12Hour: true,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            opens: 'right',
            drops: 'down',
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-primary',
            cancelClass: 'btn-default',
            separator: ' to ',
            locale: {
                applyLabel: 'Submit',
                cancelLabel: 'Cancel',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            }
        }, function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
            $('#reportrange span').html(start.format('YYYY, MMMM D') + ' - ' + end.format('YYYY, MMMM D'));
        });

        $(function () {
            $('.btn-reset').click(function () {
                $('#JobVoteAddForm')[0].reset();
            });
        });
    });
</script>
<?php return; ?>
<div class="jobVotes form">
<?php echo $this->Form->create('JobVote'); ?>
<fieldset>
<legend><?php echo __('Add Job Vote'); ?></legend>
<?php
echo $this->Form->input('title');
echo $this->Form->input('rec_department_id');
echo $this->Form->input('requirement');
echo $this->Form->input('jobtype_id', array( 'options' => $jobType ));
echo $this->Form->input('treatment');
echo $this->Form->input('qualification_require');
echo $this->Form->input('wanted_person');
echo $this->Form->input('wanted_deadline');
echo $this->Form->input('start_salary');
echo $this->Form->input('start_date');
echo $this->Form->input('recruitment_area_id');
echo $this->Form->input('wanted_year');
echo $this->Form->input('status', array( 'options' => $jobStatus ));
echo $this->Form->input('rikunavi_id',array('type' => 'text'));
echo $this->Form->input('mynavi_id',array('type' => 'text'));
?>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
