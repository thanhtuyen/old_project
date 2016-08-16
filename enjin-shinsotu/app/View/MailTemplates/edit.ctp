<?php echo $this->Html->css('enjin/email'); ?>
<?php echo $this->Form->create('MailTemplate',array('class'=>'form-horizontal')); ?>
<?php echo $this->element('back_nav', array('text' => __('テンプレート編集')))?>

  <div class="wrapper wrapper-content row animated fadeInRight clearfix">
    <!-- content -->   
    <div class='full-content'>


      <div class="col-lg-8">
        <div class="ibox ">
          <div class="ibox-title">
            <h5>テンプレート詳細</h5>
          </div>
          <div class="ibox-content clearfix p-sm">
            <div class="">
              <div class="table-border">
                <table class="table table-bordered no-margin-bottom tbl-th-f9">
                  <tr>
                    <th class='w-30per'>テンプレートID</th>
                    <td>
                      <?php echo h($this->request->data['MailTemplate']['id']); ?>
                      <?php echo $this->Form->input('id');?>
                    </td>
                  </tr>
                  <tr>
                    <th>テンプレート名</th>
                    <td><?php echo $this->Form->input('template',array(
                      'class'=>'form-control',
                      'label'=>false,
                      'div' => false
                      ));?></td>
                    </tr>
                    <tr>
                      <th>用途</th>
                      <td>
                        <?php echo $this->Form->input('purpose_id',array(
                          'options'=>$purpose,
                          'class'=>'form-control',
                          'label'=>false,
                          'default'=> $this->request->data['MailTemplate']['purpose_id'],
                          'div' => false,
                          'empty'=>__('用途')
                          ));?>
                        </td>
                      </tr>
                      <tr>
                        <th>対象</th>
                        <td>
                          <?php echo $this->Form->input('selectName',array(
                            'options'=> array(),
                            'class'=>'form-control',
                            'label'=>false,
                            'div' => false,
                            'empty'=> __('選択してください')
                            ));?>
                          </td>
                        </tr>
                      </table>



                    </div>
                  </div>

                </div>


              </div>

              <div class="ibox">
                <div class="ibox-content clearfix p-sm">
                  <div class=''>
                    <div class="table-border">
                      <table class="table table-bordered no-margin-bottom tbl-th-f9">
                        <tr>
                          <th>タイトル</th>
                          <td>
                            <?php echo $this->Form->input('subject',array(
                              'class' => 'form-control',
                              'label' => false,
                              'div' => false
                              ));?>
                            </td>
                          </tr>
                          <tr>
                            <th colspan="2"class="button_cen">内容</th>
                          </tr>
                          <tr>
                            <td colspan="2">
                              <div class="col-sm-12 replace-dest">
                                <?php echo $this->Form->input('body',array(
                                  'class'=>'form-control',
                                  'type' => 'textarea',
                                  'rows' => 15,
                                  'label' => false,
                                  'div' => false
                                  ));
                                  ?>
                                </div>
                              </td>
                            </tr>
                          </table>
                          <div class="col-lg-10 m-t-sm pull-right row text_right replace-src">
                            <?php echo $this->Form->input('replace_word',array(
                              'class'=> 'btn btn-white m-r-sm',
                              'style'=> 'height:30px',
                              'options' => $replaceWord,
                              'label' => false,
                              'div' => false
                              ));?>

                              <btn class="btn btn-primary replace-btn btn-sm">挿入</btn>
                            </div>
                          </div>
                        </div>

                        <div class="clear"></div>
                        <div class="text-center m-t-lg">
                         <a class="text-navy text-29bbef" href="#">キャンセル</a>
                         <?php echo $this->Form->submit('保存',array(
                          'class' => 'btn btn-primary m-l-lg w-95',
                          'div' => false
                          ));?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php echo $this->Form->end();?>

<?php echo $this->element('b_back_nav')?>

              <script>
                $(function(){

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
                      api_url = "<?php echo Router::url('/', true)?>"+api_url;
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

                  $('.replace-btn').click(function(){
                    var dest = $('.replace-dest > textarea');
                    var src = $('.replace-src > select option:selected');
                    dest.val(dest.val().replace(/\#(.+?)\#/,src.text()));
                  });

                  loadTargetByPurposeId("<?php echo $this->request->data['MailTemplate']['purpose_id']?>",'#MailTemplateSelectName',"<?php echo $this->request->data['MailTemplate']['selectName']?>");
                  
                  $('#MailTemplatePurposeId').change(function(){

                    var cur_id = $(this).val();
                    loadTargetByPurposeId(cur_id,'#MailTemplateSelectName',0);
                    
                  });


});
</script>
<?php return;?>

<div class="mailTemplates form">
  <?php echo $this->Form->create('MailTemplate'); ?>
  <fieldset>
    <legend><?php echo __('Edit Mail Template'); ?></legend>
    <?php
    echo $this->Form->input('id');
    echo $this->Form->input('template');
    echo $this->Form->input('subject');
    echo $this->Form->input('body');
    echo $this->Form->input('ev_event_id');
    echo $this->Form->input('job_vote_id');
    echo $this->Form->input('screening_stage_id');
    echo $this->Form->input('purpose_id', array( 'options' => $purpose ));
    echo $this->Form->input('rec_recruiter_id');
    echo $this->Form->input('status', array( 'options' => $selStatus ));
    ?>
  </fieldset>
  <?php echo $this->Form->end(__('Submit')); ?>
</div>

<script>
$('.editable').each(function(){
    this.contentEditable = true;
});
</script>