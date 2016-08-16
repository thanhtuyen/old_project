<!-- title -->
<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
<h2>候補者基本データ編集 ｜ <?php echo h($CanCandidate['CanCandidate']['id']);?> <?php echo h($CanCandidate['CanCandidate']['last_name']); ?> <?php echo h($CanCandidate['CanCandidate']['first_name']); ?></h2>
</div>
</div>
<!-- end title -->

<div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">
<div class="col-lg-8">
<div class='ibox'>
  <div class="ibox-title">
    <h5>候補者情報</h5>
    <div class="ibox-tools">
      <button type='button' class='btn btn-primary btn-xs' onclick="$('#CanCandidateEditForm').submit();">編集</button>
    </div>
  </div>
  <div class='ibox-content bg-white p-sm'>
    <div class="">
      <div class="tabs-container">
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#tab-1">基本データ</a></li>
          <li class=""><a href="../associated/<?php echo $CanCandidate['CanCandidate']['id']; ?>">付随データ</a></li>
        </ul>
        <div class="tab-content">

          <!-- tab container 2 -->
          <div id="tab-1" class="tab-pane active">
            <div class="panel-body form-edit">   
              <div class="ibox-content bg-white p-sm pd-right-none">
				<?php echo $this->Form->create('CanCandidate', array('class' =>'form-horizontal form-edit')); ?>
					<?php echo $this->Form->hidden('id');?>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">氏</label>
                    <div class="col-sm-8">
						<?php echo $this->Form->input('last_name',array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false)); ?>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">Last name</label>
                    <div class="col-sm-8">
						<?php echo $this->Form->input('last_name_en',array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false)); ?>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">氏フリガナ</label>
                    <div class="col-sm-8">
						<?php echo $this->Form->input('last_name_kana',array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false)); ?>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">ミドルネーム</label>
                    <div class="col-sm-8">
						<?php echo $this->Form->input('mid_name',array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false)); ?>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">Midname</label>
                    <div class="col-sm-8">
						<?php echo $this->Form->input('mid_name_en',array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false)); ?>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">名</label>
                    <div class="col-sm-8">
						<?php echo $this->Form->input('first_name',array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false)); ?>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">First name</label>
                    <div class="col-sm-8">
						<?php echo $this->Form->input('first_name_en',array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false)); ?>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">名フリガナ</label>
                    <div class="col-sm-8">
						<?php echo $this->Form->input('first_name_kana',array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false)); ?>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">顔写真URL</label>
                    <div class="col-sm-8">
						<?php echo $this->Form->input('face_photo',array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false)); ?>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">メールアドレス</label>
                    <div class="col-sm-8">
						<?php echo $this->Form->input('mail_address',array('class'=>'form-control','div'=>false,'type'=>'email','label'=>false)); ?>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">電話番号</label>
                    <div class="col-sm-8">
						<?php echo $this->Form->input('tel',array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false)); ?>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">携帯電話番号</label>
                    <div class="col-sm-8">
						<?php echo $this->Form->input('cell_number',array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false)); ?>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">携帯メールアドレス</label>
                    <div class="col-sm-8">
						<?php echo $this->Form->input('cell_mail',array('class'=>'form-control','div'=>false,'type'=>'email','label'=>false)); ?>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">居住国</label>
                    <div class="col-sm-8">
                      <div class="no-borders ver-mid btn-group btn-block">
	                        <?php
	                            echo $this->Form->input('country_id', array(
	                                'empty'    => '選択',
	                                'type'     => 'select',
	                                'options'  => $countries,
	                                'class'    => 'form-control',
	                                'label'    => false,
	                                'div'      => false,
	                                'error'    => false,
	                                'required' => false,
	                            ));
	                        ?>
                      </div>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">郵便番号</label>
                    <div class="col-sm-8">
						<?php echo $this->Form->input('post_code',array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false)); ?>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">都道府県</label>
                    <div class="col-sm-8">
                      	<div class="no-borders ver-mid btn-group btn-block">
	                        <?php
	                            echo $this->Form->input('prefecture_id', array(
	                                'empty'    => '選択',
	                                'type'     => 'select',
	                                'options'  => $prefectures,
	                                'class'    => 'form-control',
	                                'label'    => false,
	                                'div'      => false,
	                                'error'    => false,
	                                'required' => false,
	                            ));
	                        ?>
                        </div>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">居住地</label>
                    <div class="col-sm-8">
						<?php echo $this->Form->input('residence',array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false)); ?>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">帰省先国</label>
                    <div class="col-sm-8">
                      	<div class="no-borders ver-mid btn-group btn-block">
	                        <?php
	                            echo $this->Form->input('home_country_id', array(
	                                'empty'    => '選択',
	                                'type'     => 'select',
	                                'options'  => $countries,
	                                'class'    => 'form-control',
	                                'label'    => false,
	                                'div'      => false,
	                                'error'    => false,
	                                'required' => false,
	                            ));
	                        ?>
                        </div>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">帰省先郵便番号</label>
                    <div class="col-sm-8">
						<?php echo $this->Form->input('home_post_code',array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false)); ?>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">帰省先都道府県</label>
                    <div class="col-sm-8">
                      <div class="no-borders ver-mid btn-group btn-block">
	                        <?php
	                            echo $this->Form->input('home_prefecture_id', array(
	                                'empty'    => '選択',
	                                'type'     => 'select',
	                                'options'  => $prefectures,
	                                'class'    => 'form-control',
	                                'label'    => false,
	                                'div'      => false,
	                                'error'    => false,
	                                'required' => false,
	                            ));
	                        ?>
                      </div>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">帰省先居住地</label>
                    <div class="col-sm-8">
						<?php echo $this->Form->input('home_residence',array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false)); ?>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">帰省先電話番号</label>
                    <div class="col-sm-8">
						<?php echo $this->Form->input('home_tel',array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false)); ?>
                    </div>
                  </div> 

                  <div class="form-group data_1" id="">
                    <label class="col-sm-4 control-label">生年月日</label>
                    <div class="col-sm-8">
                      <div class="input-group date">
                        <span class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </span>
						<?php echo $this->Form->input('birthday',array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false)); ?>
                      </div>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">性別</label>
                    <div class="col-sm-8" style="padding-top:4px;">
						<?php echo $this->Form->input('sex',array(
							'legend'    => false,
							'type'      => 'radio',
							'separator' => '　　',
							'options'   => $sex,
							'error'     => false,
							'required'  => false,
							'label'     => true,
							'class'     => '',
							'div'       => false,
						)); ?>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">所属グループ</label>
                    <div class="col-sm-8">
						<?php echo $this->Form->input('membership',array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false)); ?>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">流入元企業ID</label>
                    <div class="col-sm-8">
                      	<div class="no-borders ver-mid btn-group btn-block">
	                        <?php
	                            echo $this->Form->input('referer_company_id', array(
	                                'empty'    => '選択',
	                                'type'     => 'select',
	                                'options'  => $refererCompanies,
	                                'class'    => 'form-control',
	                                'label'    => false,
	                                'div'      => false,
	                                'error'    => false,
	                                'required' => false,
	                                'default'  => '',
	                            ));
                        ?>
                      	</div>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">流入元契約ID</label>
                    <div class="col-sm-8">
						<?php echo $this->Form->input('inf_contract_id',array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false)); ?>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">入社可能年月</label>
                    <div class="col-sm-8">
                      <div class=''>
                        <div class="no-borders ver-mid btn-group pull-left">
                        <?php
                        	$def['join_possible_date_y'] = date('Y', strtotime($this->data['CanCandidate']['join_possible_date']));
                            echo $this->Form->input('join_possible_date_y', array(
                                'empty'    => '選択',
                                'type'     => 'select',
                                'options'  => $years,
                                'class'    => 'form-control',
                                'label'    => false,
                                'div'      => false,
                                'error'    => false,
                                'required' => false,
                                'default'  => $def['join_possible_date_y'],
                            ));
                        ?>
                       </div>
                        <div class="no-borders ver-mid btn-group pull-left col-sm-5">
	                        <?php
        	                	$def['join_possible_date_m'] = date('m', strtotime($this->data['CanCandidate']['join_possible_date']));
	                            echo $this->Form->input('join_possible_date_m', array(
	                                'empty'    => '選択',
	                                'type'     => 'select',
	                                'options'  => $month,
	                                'class'    => 'form-control',
	                                'label'    => false,
	                                'div'      => false,
	                                'error'    => false,
	                                'required' => false,
	                                'default'  => $def['join_possible_date_m'],
	                            ));
	                        ?>
                        </div>
                        <div class='clearfix'></div>
                      </div>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">マイナビID</label>
                    <div class="col-sm-8">
						<?php echo $this->Form->input('mynavi_id',array('class'=>'form-control','div'=>false,'type'=>'isUnique','label'=>false)); ?>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">リクナビID</label>
                    <div class="col-sm-8">
						<?php echo $this->Form->input('rikunavi_id',array('class'=>'form-control','div'=>false,'type'=>'isUnique','label'=>false)); ?>
                    </div>
                  </div> 
                  <div class="form-group">
                    <label class="col-sm-4 control-label">学生登録日時</label>
                    <div class="col-sm-8">
                      <?php echo h($this->enjin->getDateTime($CanCandidate['CanCandidate']['created'])); ?>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">学生更新日時</label>
                    <div class="col-sm-8">
                      <?php echo h($this->enjin->getDateTime($CanCandidate['CanCandidate']['modified'])); ?>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-4 control-label">最終ログイン日</label>
                    <div class="col-sm-8">
                      <?php echo !empty($CanCandidate['CanCandidate']['last_login_date'])? h($this->enjin->getDate($CanCandidate['CanCandidate']['last_login_date'] . ' ')): ''; ?>
                    </div>
                  </div> 
                  <div class='button_cen element-detail-box'>
                    <button type='submit' class='w-95 btn btn-primary'>更新</button>
                  </div>
                </form>
              </div>                                       
            </div>
          </div>
          <!-- end tab container 2 -->

          <!-- tab container 1 -->

          <!-- tab container 1 -->

        </div>

      </div>
    </div>

  </div>
</div>