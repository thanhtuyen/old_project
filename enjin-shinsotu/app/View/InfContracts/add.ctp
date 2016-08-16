<script>
    $(document).ready(function(){
        $( "#clear" ).click(function() {
            $( "#reset_data" ).click();
        });
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
    });
</script>
<?php $url = '/RefererCompanies/detail/'.$id; ?>
<?php echo $this->element( 'back_nav',  array('text' => __('流入元契約　　新規登録'),'url'=>$url) );?>

<div class="row wrapper wrapper-content animated fadeInRight title-button pd-bottom-none">
    <div class = "clear10"></div>
    <div class="margin-top-15 col-lg-8">
        <div class = "ibox">
            <div class="ibox-title">
                <h5>流入先契約情報</h5>
            </div>
            <?php echo $this->Form->create('InfContract',array('class'=>'form-horizontal form-edit')); ?>
            <?php echo $this->Form->input( 'referer_company_id', array( 'type'=>'hidden' , 'value'=>$id )); ?>
            <div class="ibox-content clearfix p-sm">
                <div class="table-border">
                        <div class="form-group"><label class="col-sm-4 control-label">流入元企業</label>
                            <div class="col-sm-8"><?php echo $wRefererCompany['RefererCompany']['name']; ?></div>
                        </div>
                        <div class = "clear10"></div>
                        <div class="form-group"><label class="col-sm-4 control-label">タイトル</label>
                            <div class="col-sm-8">
                               <?php echo $this->Form->input('title',array('class'=>'form-control','placeholder'=>'例：固定契約','label'=>false)); ?>
                            </div>
                        </div>
                        <div class = "clear10"></div>
                        <div class="form-group" id="data_1"><label class="col-sm-4 control-label">契約開始日</label>
                            <div class="col-sm-8">
                                <div class="input-group date">
                                      <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </span>
                                    <?php echo $this->Form->input('start_contract_date',array('type' => 'text','class'=>'form-control','label' =>false,'div'=>false)); ?>
                                </div>
                            </div>
                        </div>
                        <div class = "clear10"></div>
                        <div class="form-group" id="data_2"><label class="col-sm-4 control-label">契約開始日</label>
                            <div class="col-sm-8">
                                <div class="input-group date">
                                      <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </span>
                                    <?php echo $this->Form->input('end_contract_date',array('type' => 'text','class'=>'form-control','label' =>false,'div'=>false)); ?>
                                </div>
                            </div>
                        </div>
                        <div class = "clear10"></div>
                        <div class="form-group"><label class="col-sm-4 control-label">契約タイプ</label>
                            <div class="col-sm-8">
                                <?php echo $this->Form->input('contract_type', array( 'options' => $contractType,'class'=>'form-control','label'=>false)); ?>
                            </div>
                        </div>
                        <div class = "clear10"></div>
                        <div class="form-group"><label class="col-sm-4 control-label">金額・割合</label>
                            <div class="col-sm-8">
                                <?php echo $this->Form->input('money',array('type'=>'number','class'=>'form-control','placeholder'=>'','label'=>false)); ?>
                            </div>
                        </div>
                </div>
                <div class = "clear15"></div>
                <p class = "btn-clear">
                    <a class="text-center text-navy" href="<?php echo $this->Html->url(array('controller' => 'RefererCompanies','action' => 'index'))?>">キャンセル</a>
                    
                    <?php echo $this->Form->submit('登録',array('class'=>'btn btn-primary w-95 h-34','div'=>false)); ?>
                </p>
            </div>
            <?php echo $this->Form->end();?>
        </div>
    </div>
    <!-- ---------------end contents------------ -->
</div>

<?php echo $this->element('b_back_nav')?>
<?php return; ?>
<div class="infContracts form">
<?php echo $this->Form->create('InfContract'); ?>
	<fieldset>
		<legend><?php echo __('Add Inf Contract'); ?></legend>
	<?php
		echo $this->Form->input('referer_company_id');
		echo $this->Form->input('title');
		echo $this->Form->input('start_contract_date');
		echo $this->Form->input('end_contract_date');
		echo $this->Form->input('contract_type', array( 'options' => $contractType ));
		echo $this->Form->input('income_ratio');
		echo $this->Form->input('fixed_unit_price');
		echo $this->Form->input('unlimited_fixed_annual');
		echo $this->Form->input('status', array( 'options' => $infStatus ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
