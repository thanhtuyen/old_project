<!DOCTYPE html>
<html>

<head>
  <?php echo $this->Html->charset('utf-8'); ?> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>候補者管理 − 候補者登録</title>

  <!-- css -->
  <?php echo $this->Html->css('enjin/email'); ?>
  <?php echo $this->Html->css('enjin/master'); ?>
  <?php echo $this->Html->css('plugins/datapicker/datepicker3.css'); ?>
  <?php echo $this->Html->css('plugins/daterangepicker/daterangepicker-bs3.css'); ?>

  <?php echo $this->Html->css('enjin/6_06_event_schedule.css'); ?>
  
  <?php echo $this->Html->css('enjin/02_selection.css'); ?>
  <?php echo $this->Html->css('bootstrap/animate'); ?>
  <?php echo $this->Html->css('bootstrap/bootstrap.min'); ?>
  <?php echo $this->Html->css('font-awesome/css/font-awesome'); ?>
  <?php echo $this->Html->css('plugins/iCheck/custom'); ?>
  <?php echo $this->Html->css('bootstrap/style'); ?>
  <?php echo $this->Html->css('enjin/global'); ?>

  <!-- end css -->
  <!-- script -->
  <?php echo $this->Html->script('jquery-2.1.1.js'); ?>
  <?php echo $this->Html->script('bootstrap.min.js'); ?>
  <?php echo $this->Html->script('plugins/metisMenu/jquery.metisMenu.js'); ?>
  <?php echo $this->Html->script('plugins/slimscroll/jquery.slimscroll.min.js'); ?>


  <!-- Custom and plugin javascript -->
  <?php echo $this->Html->script('inspinia.js'); ?>
  <?php echo $this->Html->script('plugins/pace/pace.min.js'); ?>

  <!-- iCheck -->
  <?php echo $this->Html->script('plugins/iCheck/icheck.min.js'); ?>

  <!-- Peity -->
  <?php echo $this->Html->script('plugins/peity/jquery.peity.min.js'); ?>

  <!-- Chosen -->
  <?php echo $this->Html->script('plugins/chosen/chosen.jquery.js'); ?>

  <!-- JSKnob -->
  <!--<?php echo $this->Html->script('plugins/plugins/jsKnob/jquery.knob.js'); ?>-->

  <!-- Input Mask-->

  <?php echo $this->Html->script('plugins/jasny/jasny-bootstrap.min.js'); ?>

  <!-- Data picker -->

  <?php echo $this->Html->script('plugins/datapicker/bootstrap-datepicker.js'); ?>

  <!-- NouSlider -->
  <!--<script src="js/plugins/nouslider/jquery.nouislider.min.js"></script>-->

  <!-- Switchery -->
  <?php echo $this->Html->script('plugins/switchery/switchery.js'); ?>

  <!-- IonRangeSlider -->
  <?php echo $this->Html->script('plugins/ionRangeSlider/ion.rangeSlider.min.js'); ?>

  <!-- iCheck -->
  <?php echo $this->Html->script('plugins/iCheck/icheck.min.js'); ?>

  <!-- MENU -->
  <?php echo $this->Html->script('plugins/metisMenu/jquery.metisMenu.js'); ?>

  <!-- Color picker -->
  <?php echo $this->Html->script('plugins/colorpicker/bootstrap-colorpicker.min.js'); ?>

  <!-- Clock picker -->
  <?php echo $this->Html->script('plugins/clockpicker/clockpicker.js'); ?>

  <!-- Image cropper -->
  <?php echo $this->Html->script('plugins/cropper/cropper.min.js'); ?>

  <!-- Date range use moment.js same as full calendar plugin -->
  <?php echo $this->Html->script('plugins/fullcalendar/moment.min.js'); ?>

  <!-- Date range picker -->
  <?php echo $this->Html->script('plugins/daterangepicker/daterangepicker.js'); ?>
  <!-- Data Tables -->
  <?php echo $this->Html->script('kiwi.js'); ?>





</head>
<!-- ------------start header and menu---------------- -->
<!-- ------------start header and menu---------------- -->

<body class="csv">

  <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
      <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
          <li class="nav-header">
            <div class="dropdown profile-element"> 
              <span>
                <?php echo $this->Html->image("bootstrap/profile_small.jpg", array(
                  "class" => "img-circle",
                  )); ?>
                </span>
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                  <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                  </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                  <ul class="dropdown-menu animated fadeInRight m-t-xs">
                    <li><a href="profile.html">Profile</a></li>
                    <li><a href="contacts.html">Contacts</a></li>
                    <li><a href="mailbox.html">Mailbox</a></li>
                    <li class="divider"></li>
                    <li><a href="login.html">Logout</a></li>
                  </ul>
                </div>
                <div class="logo-element">
                  IN+
                </div>
              </li>
              <li>
                <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">ダッシュボード</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                  <li><a href="index.html">Dashboard v.1</a></li>
                  <li><a href="dashboard_2.html">Dashboard v.2</a></li>
                  <li><a href="dashboard_3.html">Dashboard v.3</a></li>
                  <li><a href="dashboard_4_1.html">Dashboard v.4</a></li>
                </ul>
              </li>
              <li>
                <a href="layouts.html"><i class="fa fa-diamond"></i> <span class="nav-label">選考管理</span></a>
              </li>
              <li>
                <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">イベント管理</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                  <li><a href="graph_flot.html">Flot Charts</a></li>
                  <li><a href="graph_morris.html">Morris.js Charts</a></li>
                  <li><a href="graph_rickshaw.html">Rickshaw Charts</a></li>
                  <li><a href="graph_chartjs.html">Chart.js</a></li>
                  <li><a href="graph_chartist.html">Chartist</a></li>
                  <li><a href="graph_peity.html">Peity Charts</a></li>
                  <li><a href="graph_sparkline.html">Sparkline Charts</a></li>
                </ul>
              </li>
              <li>
                <a href="mailbox.html"><i class="fa fa-envelope"></i> <span class="nav-label">候補者管理 </span></a>
                <ul class="nav nav-second-level collapse">
                  <li><a href="mailbox.html">Inbox</a></li>
                  <li><a href="mail_detail.html">Email view</a></li>
                  <li><a href="mail_compose.html">Compose email</a></li>
                  <li><a href="email_template.html">Email templates</a></li>
                </ul>
              </li>
              <li>
                <a href="metrics.html"><i class="fa fa-pie-chart"></i> <span class="nav-label">求人票管理</span> </a>
              </li>
              <li>
                <a href="widgets.html"><i class="fa fa-flask"></i> <span class="nav-label">エージェント管理</span></a>
              </li>
              <li>
                <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">メール送信管理</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                  <li><a href="form_basic.html">Basic form</a></li>
                  <li><a href="form_advanced.html">Advanced Plugins</a></li>
                  <li><a href="form_wizard.html">Wizard</a></li>
                  <li><a href="form_file_upload.html">File Upload</a></li>
                  <li><a href="form_editors.html">Text Editor</a></li>
                </ul>
              </li>
              <li>
                <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">マスタ管理</span>  </a>
                <ul class="nav nav-second-level collapse">
                  <li><a href="contacts.html">Contacts</a></li>
                  <li><a href="profile.html">Profile</a></li>
                  <li><a href="projects.html">Projects</a></li>
                  <li><a href="project_detail.html">Project detail</a></li>
                  <li><a href="teams_board.html">Teams board</a></li>
                  <li><a href="social_feed.html">Social feed</a></li>
                  <li><a href="clients.html">Clients</a></li>
                  <li><a href="full_height.html">Outlook view</a></li>
                  <li><a href="file_manager.html">File manager</a></li>
                  <li><a href="calendar.html">Calendar</a></li>
                  <li><a href="issue_tracker.html">Issue tracker</a></li>
                  <li><a href="blog.html">Blog</a></li>
                  <li><a href="article.html">Article</a></li>
                  <li><a href="faq.html">FAQ</a></li>
                  <li><a href="timeline.html">Timeline</a></li>
                  <li><a href="pin_board.html">Pin board</a></li>
                </ul>
              </li>
              <li>
                <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">マイページ</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                  <li><a href="search_results.html">Search results</a></li>
                  <li><a href="lockscreen.html">Lockscreen</a></li>
                  <li><a href="invoice.html">Invoice</a></li>
                  <li><a href="login.html">Login</a></li>
                  <li><a href="login_two_columns.html">Login v.2</a></li>
                  <li><a href="forgot_password.html">Forget password</a></li>
                  <li><a href="register.html">Register</a></li>
                  <li><a href="404.html">404 Page</a></li>
                  <li><a href="500.html">500 Page</a></li>
                  <li><a href="empty_page.html">Empty page</a></li>
                </ul>
              </li>
            </ul>

          </div>
        </nav>

        <div id="page-wrapper" class="gray-bg">
          <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
              <div>
                <div class="navbar-header">
                  <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>

                </div>
                <div class="nav navbar-top-links navbar-right logo_enjin">
                  <?php echo $this->Html->image("bootstrap/logo_enjin.png", array(
                    "alt" => "logo",
                    )); ?>
                  </div>
                  <div class="select_option m-t-sm">
                    <div class="btn-group">
                      <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle h-30" aria-expanded="false">2015<span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        <li><a href="#">2016</a></li>
                        <li><a href="#">2017</a></li>
                        <li><a href="#">2018</a></li>
                      </ul>
                    </div>
                  </div>
                  <ul class="nav navbar-top-links navbar-right">               
                    <li class="dropdown">
                      <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-comment"></i>  <span class="label label-danger">16</span>
                      </a>
                      <ul class="dropdown-menu dropdown-messages">
                        <li>
                          <div class="dropdown-messages-box">
                            <a href="profile.html" class="pull-left">
                              <?php echo $this->Html->image("bootstrap/a7.jpg", array(
                                "class" => "img-circle",
                                )); ?>
                              </a>
                              <div class="media-body">
                                <small class="pull-right">46h ago</small>
                                <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                              </div>
                            </div>
                          </li>
                          <li class="divider"></li>
                          <li>
                            <div class="dropdown-messages-box">
                              <a href="profile.html" class="pull-left">
                                <?php echo $this->Html->image("bootstrap/a7.jpg", array(
                                  "class" => "img-circle",
                                  )); ?>
                                </a>
                                <div class="media-body ">
                                  <small class="pull-right text-navy">5h ago</small>
                                  <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                  <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                </div>
                              </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                              <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                  <?php echo $this->Html->image("bootstrap/a7.jpg", array(
                                    "class" => "img-circle",
                                    )); ?>
                                  </a>
                                  <div class="media-body ">
                                    <small class="pull-right">23h ago</small>
                                    <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                    <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                  </div>
                                </div>
                              </li>
                              <li class="divider"></li>
                              <li>
                                <div class="text-center link-block">
                                  <a href="mailbox.html">
                                    <i class="fa fa-comment"></i> <strong>Read All Messages</strong>
                                  </a>
                                </div>
                              </li>
                            </ul>
                          </li>



                          <li>
                            <a href="login.html">
                              <i class="fa fa-sign-out"></i> Log out
                            </a>
                          </li>
                        </ul>

                      </nav>
                    </div>
                    <!-- -----------end header and menu---------- -->
                    <!-- -----------end header and menu---------- -->

                    <!-- ------------start contents----------------- -->
                    <!-- ------------start contents----------------- -->
                    <!-- ------------start contents----------------- -->
                    <!-- ------------start contents----------------- -->


                    <div class="row wrapper border-bottom white-bg page-heading">
                      <div class="col-lg-10">
                        <h2>  
                          イベント一覧</h2>
                        </div>
                      </div>

                      <div class="row wrapper wrapper-content animated fadeInRight title-button pd-bottom-none"> <!-- --thiv div content and footer-- -->

                        <!-- start contents -->  
                        <div class="margin-top-20 wrapper wrapper-content row animated fadeInRight clearfix">
                          <div class="col-lg-12">

                            <div class="ibox  no-margin-bottom">
                              <div class="ibox-title">
                               <h5>会社説明会</h5>
                               <div class="ibox-tools">
                                 <button type="button" class="btn btn-primary btn-xs">編集</button>                       
                               </div>
                             </div>
                             <div class="ibox-content bg-gray clearfix form-edit2 p-sm">
                              <form>
                                <!--to do start1-->
                                <div class="clear"></div>
                                <div>
                                  <div class="content-fr clearfix">
                                    <div class="col-lg-12 clearfix margin-top20">
                                      <div class="fix-size-row ">
                                        <label>開催期間</label>
                                        <div class="form-group data_1" id="">
                                          <div class="input-group date">
                                            <span class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" class="form-control fixed-size-input" value="03/04/2014" name="year_month_day">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="fix-size-row1">
                                        <label><p>から</p></label>
                                        <div class="form-group data_1" id="">
                                          <div class="input-group date">
                                            <span class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" class="form-control fixed-size-input" value="03/04/2014" name="year_month_day">
                                          </div>
                                        </div>
                                      </div>
                                      <div style = "width:260px" class="fix-size-row2">
                                        <label><p>まで</p></label>                              
                                        <div>
                                          <label>
                                            <div class="icheckbox_square-green" >
                                              <input type="checkbox" class="i-checks" style="copacity:0;">
                                            </div>

                                            <label>
                                            </div>
                                            <div class = "padding-top6">日程未設定イベントを表示する </div>
                                          </div>
                                        </div>
                                        <div class="col-lg-12 clearfix">
                                          <div class="fix-size-row3 margin-bottom20">
                                            <div style = "float:left"><label class="label-padding-right15">イベント種別</label></div>
                                            <div style = "float:left; width: 150px;">
                                              <select class="form-control fixed-size-select" name="agent_id">
                                                <option>説明会</option>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="fix-size-row4 margin-bottom20">
                                            <div style = "float:left"><label class="label-padding-right15">求人票</label></div>
                                            <div style = "float:left;width: 150px;"> 
                                              <select class="form-control fixed-size-select1" name="agent_id">
                                                <option>会社説明会</option>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="fix-size-row3 margin-bottom20">
                                            <div style = "float:left"><label class="label-padding-right15">選考段階</label></div>
                                            <div style = "float:left;width: 150px;">
                                              <select class="form-control fixed-size-select" name="agent_id">
                                                <option>1次選考</option>
                                              </select>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-lg-12 clearfix">
                                          <div class="fix-size-row5 margin-bottom20">
                                            <div style = "float:left"><label class="label-padding-right15">マイナビID</label></div>
                                            <div  style = "float:left;width: 150px;">
                                              <input type="text" name="other_language" placeholder="マイナビID" class="form-control fixed-size-input-small">
                                            </div>
                                          </div>
                                          <div class="fix-size-row5 margin-bottom20">
                                            <div style = "float:left"><label class="label-padding-right15">リクナビID</label></div>
                                            <div  style = "float:left;width: 150px;">
                                              <input type="text" name="other_language" placeholder="マイナビID" class="form-control fixed-size-input-small"></div>
                                            </div>
                                          </div>
                                          
                                        </div>
                                      </div>


                                      <!--end1-->
                                      <div class="from_calen">
                                        <button type="button" class="btn btn-primary btn-sm">検索</button>
                                        <button type="button" class="btn btn-primary btn-sm">クリア</button>
                                        
                                      </div>
                                    </form>
                                  </div>
                                </div>
                                <div class="ibox-content">

                                  <!-- table -->
                                  <div class="table-responsive">
                                    <div class="b-cal four-action mrb20">
                                      <div class="bottom_pagination1 pull-right">
                                        <ul class="pagination ma10 no-margin-bottom ">
                                          <li class="paginate_button previous disabled" aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_previous"><a href="#">Prev</a>
                                          </li>
                                          <li class="paginate_button active" aria-controls="DataTables_Table_0" tabindex="0"><a href="#">1</a></li>
                                          <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0"><a href="#">2</a></li>
                                          <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0"><a href="#">3</a></li>
                                          <li class="paginate_button next" aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_next"><a href="#">Next</a></li>
                                        </ul>
                                      </div>
                                      <span class="pull-right sp-text-pg m-t-sm m-r-sm">10件中10件表示</span>
                                      <div class="clear"></div>
                                    </div>
                                    <table class="table table-center white-tb-th table-striped table-bordered table-center-th-td">
                                      <thead>
                                        <tr class = "bg-white">
                                          <th>イベントID</th>                             
                                          <th>イベント名</th>                             
                                          <th>求人票</th>                             
                                          <th>開始日時</th>
                                          <th>終了日時</th>                             
                                          <th>イベント種別</th>                             
                                          <th>選考段階</th>
                                          <th>定員数</th>                             
                                          <th>申込数</th>                             
                                          <th>申込済</th>  
                                          <th>候補者 キャンセ ル</th>                             
                                          <th>主催者 キャンセ ル</th>                             
                                          <th>参加済</th>  
                                          <th>無断欠席</th>                             
                                          <th>イベント 担当者</th>                                                         
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>                                    
                                          <td class='button_cen'><a href="">vent123456</a></td>                              
                                          <td class='button_cen'><a href="">会社説明会</a></td>
                                          <td class='button_cen'><a href="">2016年新卒・営業</a></td>
                                          <td class='button_cen'>2015年5月10日 10:30</td>
                                          <td class='button_cen'>2015年6月10日 10:30</td>
                                          <td class='button_cen'>ナビ</td>
                                          <td class='button_cen'>1</td>
                                          <td class='button_cen'>1</td>
                                          <td class='button_cen'><a href="">20</a></td>
                                          <td class='button_cen'>1</td>
                                          <td class='button_cen'>1</td>
                                          <td class='button_cen'>1</td>
                                          <td class='button_cen'>1</td>
                                          <td class='button_cen'>0</td>
                                          <td class='button_cen'><a href="">3</a></td>
                                        </tr>
                                        <tr>                                    
                                          <td class='button_cen'><a href="">vent123456</a></td>                              
                                          <td class='button_cen'><a href="">会社説明会</a></td>
                                          <td class='button_cen'><a href="">2016年新卒・営業</a></td>
                                          <td class='button_cen'>2015年5月10日 10:30</td>
                                          <td class='button_cen'>2015年6月10日 10:30</td>
                                          <td class='button_cen'>ナビ</td>
                                          <td class='button_cen'>1</td>
                                          <td class='button_cen'>1</td>
                                          <td class='button_cen'><a href="">20</a></td>
                                          <td class='button_cen'>1</td>
                                          <td class='button_cen'>1</td>
                                          <td class='button_cen'>1</td>
                                          <td class='button_cen'>1</td>
                                          <td class='button_cen'>0</td>
                                          <td class='button_cen'><a href="">3</a></td>
                                        </tr> 
                                        <tr>                                    
                                          <td class='button_cen'><a href="">vent123456</a></td>                              
                                          <td class='button_cen'><a href="">会社説明会</a></td>
                                          <td class='button_cen'><a href="">2016年新卒・営業</a></td>
                                          <td class='button_cen'>2015年5月10日 10:30</td>
                                          <td class='button_cen'>2015年6月10日 10:30</td>
                                          <td class='button_cen'>ナビ</td>
                                          <td class='button_cen'>1</td>
                                          <td class='button_cen'>1</td>
                                          <td class='button_cen'><a href="">20</a></td>
                                          <td class='button_cen'>1</td>
                                          <td class='button_cen'>1</td>
                                          <td class='button_cen'>1</td>
                                          <td class='button_cen'>1</td>
                                          <td class='button_cen'>0</td>
                                          <td class='button_cen'><a href="">3</a></td>
                                        </tr> 
                                        <tr>                                    
                                          <td class='button_cen'><a href="">vent123456</a></td>                              
                                          <td class='button_cen'><a href="">会社説明会</a></td>
                                          <td class='button_cen'><a href="">2016年新卒・営業</a></td>
                                          <td class='button_cen'>2015年5月10日 10:30</td>
                                          <td class='button_cen'>2015年6月10日 10:30</td>
                                          <td class='button_cen'>ナビ</td>
                                          <td class='button_cen'>1</td>
                                          <td class='button_cen'>1</td>
                                          <td class='button_cen'><a href="">20</a></td>
                                          <td class='button_cen'>1</td>
                                          <td class='button_cen'>1</td>
                                          <td class='button_cen'>1</td>
                                          <td class='button_cen'>1</td>
                                          <td class='button_cen'>0</td>
                                          <td class='button_cen'><a href="">3</a></td>
                                        </tr> 
                                      </tbody>
                                      <tfoot>
                                        <tr>
                                          <th>イベントID</th>                             
                                          <th>イベント名</th>                             
                                          <th>求人票</th>                             
                                          <th>開始日時</th>
                                          <th>終了日時</th>                             
                                          <th>イベント種別</th>                             
                                          <th>選考段階</th>
                                          <th>定員数</th>                             
                                          <th>申込数</th>                             
                                          <th>申込済</th>  
                                          <th>候補者 キャンセ ル</th>                             
                                          <th>主催者 キャンセ ル</th>                             
                                          <th>参加済</th>  
                                          <th>無断欠席</th>                             
                                          <th>イベント 担当者</th>      
                                        </tr>
                                      </tfoot>
                                    </table>
                                    <div class="b-cal four-action mrb20">
                                      <div class="bottom_pagination1 pull-right">
                                        <ul class="pagination ma10 no-margin-bottom ">
                                          <li class="paginate_button previous disabled" aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_previous"><a href="#">Prev</a>
                                          </li>
                                          <li class="paginate_button active" aria-controls="DataTables_Table_0" tabindex="0"><a href="#">1</a></li>
                                          <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0"><a href="#">2</a></li>
                                          <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0"><a href="#">3</a></li>
                                          <li class="paginate_button next" aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_next"><a href="#">Next</a></li>
                                        </ul>
                                      </div>
                                      <span class="pull-right sp-text-pg m-t-sm m-r-sm">10件中10件表示</span>
                                      <div class="clear"></div>
                                    </div>                                    
                                  </div>
                                  <!-- end table -->

                                </div>

                              </div>

                            </div>

                            <!-- ------------end contents--------------- --> 

                            <br>
                            <br>
                            <div class='clearfix'></div>
                            <div class="footer">
                              <div>
                                <strong>Copyright</strong>© enjin
                              </div>
                            </div>
                          </div> 
                          <!--  -----end contents and footer----- -->

                        </div>
                      </div>



                    </body>

                    </html>
