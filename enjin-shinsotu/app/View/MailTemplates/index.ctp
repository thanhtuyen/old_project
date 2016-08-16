 <?php echo $this->Html->css('enjin/email'); ?>
 <style>.btn-primary{color:#fff !important;}</style>
 <div class="row wrapper border-bottom white-bg page-heading">
 	<div class="col-lg-10">
 		<h2>テンプレート</h2>
 	</div>
 </div>
 <div class="wrapper wrapper-content row animated fadeInRight clearfix">
 	<!-- content -->   

 			<div class="col-lg-12">

 				<div class="ibox">
 					<div class="ibox-title">
 						<h5>テンプレート一覧</h5>

 					</div>
 					<div class="ibox-content bg-gray clearfix form-edit2 p-sm">

            <?php echo $this->Form->create('Filter',array(
              'class'=>'',
              'type'=>'get',
              'url' => array('controller' => 'mailTemplates', 'action' => 'index')
              ))?>

              <div class="form-group clearfix">
                <div class="pull-left col-sm">
                  <label class="pull-left p-xs">用途</label>
                  <?php echo $this->Form->input('purpose', array( 
                    'options' => $purpose,
                    'class'=>'form-control ct-select2 pull-left',
                    'label'=> false, 
                    'div'=>false,
                    'required'=>false,
                    'empty'=>__('用途'),
                    'default' => $rq_purpose
                    )); ?>
                  </div>
                  <div class="col-sm-4">
                    <?php echo $this->Form->input('selectName', array( 
                      'options' => $selectName,
                      'class'=>'form-control ct-select2',
                      'label'=> false, 
                      'div'=>false,
                      'required'=>false,
                      'empty'=> __('選択してください'),
                      'default' => $rq_selectName
                      )); ?>
                    </div>

                  </div>

                  <div class="form-group clearfix">
                    <div class="col-sm-4 row">
                      <label class="pull-left p-xs">作成日</label>
                      <div class="data_1">

                        <div class="input-group date">
                          <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </span>
                          <?php  echo $this->Form->input('from',array(
                            'class'=>'form-control ct-select1',
                            'label'=>false,
                            'div'=>false,
                            'required'=>false,
                            'default'=> $from
                            )); ?>
                          </div>

                        </div>
                      </div>
                      <div class="col-sm-4 row">
                        <label class="pull-left p-xs">から</label>
                        <div class="data_1">
                          <div class="input-group date">
                            <span class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </span>
                            <?php  echo $this->Form->input('to',array(
                              'class'=>'form-control',
                              'label'=>false,
                              'div'=>false,
                              'required'=>false,
                              'default' => $to
                              )); ?>
                            </div>
                          </div>
                        </div>
                        <label class="pull-left p-xs">まで</label>
                      </div>


                      <div class="from_calen">
                        <?php echo $this->Form->button(__('検索'),array(
                          'class'=>'btn btn-primary btn-sm mr-right30',
                          'div'=>false
                          ));?>
                          <?php echo $this->HTML->link(__('クリア'),array('action'=>'index'),array('class'=>'text-29bbef'));?>

                        </div>

                        <?php echo $this->Form->end();?>
                      </div>
                       <!------------table-------------->  
                    <div class="ibox-content bg-white clearfix p-sm">
                     
                     <!--pagination-->
                      <div class="text-right clearfix">
                        <div class="pull-left hover-button">
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

                    <?php if(!empty($mailTemplates)):?>

                     <table class="table table-striped table-bordered tbl-data">
                      <thead>
                       <tr>
                        <!-- <th><input type="checkbox" class="i-checks"></th> -->
                        <th>テンプレートID</th>                        
                        <th width="20%">テンプレート名</th>
                        <th>用途</th>
                        <th>対象</th>
                        <th>作成日時</th>
                        <th width="20%">タイトル</th> 
                        <th>操作</th> 
                      </tr>
                    </thead>
                    <tbody>

                     <?php 

                     foreach($mailTemplates as $mailTemplate): 
                      switch($mailTemplate['MailTemplate']['purpose_id']){
                  case 0://EvEvent
                  $target = @$selectEvEventData[$mailTemplate['MailTemplate']['ev_event_id']];
                  break;
                  case 1://JobVote
                  $target = @$selectJobVoteData[$mailTemplate['MailTemplate']['job_vote_id']];
                  break;
                  case 2://ScreeningStage
                  $target = @$selectScreeningStageData[$mailTemplate['MailTemplate']['screening_stage_id']];
                  break;
                  case 3:
                  $target = @$selectRefererCompanyData[$mailTemplate['MailTemplate']['rec_company_id']];
                  break;
                  default:
                  $target = '';
                }

                ?>

                <tr> 
                  <!-- <td><input type="checkbox" class="i-checks"></td> -->                                
                  <td><a class="text-navy"><?php echo $this->HTML->link(h($mailTemplate['MailTemplate']['id']),array('action' => 'view',$mailTemplate['MailTemplate']['id'])); ?></a></td> 
                  <td><a class="text-navy"><?php echo $this->HTML->link(h($mailTemplate['MailTemplate']['template']),array('action' => 'view',$mailTemplate['MailTemplate']['id'])); ?></a></td>
                  <td><?php echo h($purpose[$mailTemplate['MailTemplate']['purpose_id']]); ?></td>
                  <td><?php echo h($target); ?></td>
                  <td><?php echo h($mailTemplate['MailTemplate']['created']); ?></td>
                  <td><?php echo h($mailTemplate['MailTemplate']['subject']); ?></td>
                  <td class="actions">
                    <?php echo $this->Html->link(__('詳細'), array('action' => 'view', $mailTemplate['MailTemplate']['id']),array('class'=>'btn btn-primary btn-xs')); ?>
                  <?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $mailTemplate['MailTemplate']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $mailTemplate['MailTemplate']['id']),'class'=>'btn btn-default btn-xs cl-white')); ?>
                </td>

              </tr>

            <?php endforeach;?>

          </tbody>
          <thead>
            <tr>

              <!-- <th><input type="checkbox" class="i-checks"></th> -->
              <th>テンプレートID</th>                        
              <th>テンプレート名</th>
              <th>用途</th>
              <th>対象</th>
              <th>作成日時</th>
              <th>タイトル</th> 
              <th>操作</th>
            </tr>
          </thead>
        </table>

      <?php endif;?>

      <!--pagination-->
            <div class="text-right clearfix">
              <div class="pull-left hover-button">
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
<!-- Clock picker -->
<?php echo $this->Html->script('plugins/clockpicker/clockpicker.js'); ?>

<!-- Image cropper -->
<?php echo $this->Html->script('plugins/cropper/cropper.min.js'); ?>

<!-- Date range use moment.js same as full calendar plugin -->
<?php echo $this->Html->script('plugins/fullcalendar/moment.min.js'); ?>
<!-- Date range picker -->
<?php echo $this->Html->script('plugins/daterangepicker/daterangepicker.js'); ?>
<script>


 $(document).ready(function() {

  function loadTargetByPurposeId(purposeId, targetDiv, selectedName){

   var api_url = '';
   var obj_name = '';
   var obj_key = '';
   var obj_value = '';

   switch(purposeId){
    case '0':
    api_url = 'ev_events/api_list';
    obj_name = 'EvEvent';
    obj_key = 'id';
    obj_value = 'name';
    break;
    case '1':
    case '3':
    api_url = 'job_votes/api_list';
    obj_name = 'JobVote';
    obj_key = 'id';
    obj_value = 'title';
    break;
    case '2':
    case '4':
    api_url = 'screening_stages/api_list';
    obj_name = 'ScreeningStage';
    obj_key = 'id';
    obj_value = 'name';
    break;
  }

  if(api_url){
    api_url = "<?php echo $this->webroot;?>"+api_url;
  }

  $.ajax({
    type:'GET',
    url: api_url,
    success: function(data){

     var str = '';
     str+="<option value=''>選択してください</option>";
     if((data instanceof Array) && api_url != ''){
      $.each(data,function(k,v){
       selected = (v[obj_name][obj_key] == selectedName)?'selected':'';
       str+="<option "+selected+" value='"+v[obj_name][obj_key]+"'>"+v[obj_name][obj_value]+"</option>";
     });
    }

    $(targetDiv).html(str);
  }
});
                  }//end function

                  loadTargetByPurposeId('<?php echo $rq_purpose ?>','#FilterSelectName','<?php echo $rq_selectName ?>');

                  $('#FilterPurpose').change(function(){

                  	var cur_id = $(this).val();
                  	loadTargetByPurposeId(cur_id,'#FilterSelectName',0);

                  });

                  $('.mrm > tr th:last').replaceWith("<th>操作</th>");

                  $('#data_1 .input-group.date').datepicker({
                  	todayBtn: "linked",
                  	keyboardNavigation: false,
                  	forceParse: false,
                  	calendarWeeks: true,
                  	autoclose: true
                  });

                  $('.clockpicker').clockpicker();

                  $('input[name="daterange"]').daterangepicker();

                  $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

                  $('#reportrange').daterangepicker({
                  	format: 'MM/DD/YYYY',
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
                  	$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                  });

        /* initialize the external events
        -----------------------------------------------------------------*/

        $('#external-events div.external-event').each(function() {

            // store data so the calendar knows to render an event upon drop
            $(this).data('event', {
                title: $.trim($(this).text()), // use the element's text as the event title
                stick: true // maintain when user navigates (see docs on the renderEvent method)
              });

            // make the event draggable using jQuery UI
            $(this).draggable({
            	zIndex: 1111999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
              });
          });  
      });

</script>