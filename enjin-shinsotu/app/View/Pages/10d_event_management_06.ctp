<!DOCTYPE html>
<html>

<head>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>10_Even Management_06 イベントカレンダー</title>

  <!-- css -->
  <?php echo $this->Html->css('enjin/10_ver06.css'); ?>
  <?php echo $this->Html->css('bootstrap/animate'); ?>
  <?php echo $this->Html->css('bootstrap/bootstrap.min'); ?>
  <?php echo $this->Html->css('font-awesome/css/font-awesome'); ?>
  <?php echo $this->Html->css('bootstrap/style'); ?>
  <?php echo $this->Html->css('enjin/global'); ?>
  <?php echo $this->Html->css('plugins/clockpicker/clockpicker'); ?>
  <?php echo $this->Html->css('plugins/datapicker/datepicker3'); ?>
  <?php echo $this->Html->css('plugins/daterangepicker/daterangepicker-bs3'); ?>
  <?php echo $this->Html->css('plugins/fullcalendar/fullcalendar.css'); ?>
  <?php echo $this->Html->css('plugins/clockpicker/clockpicker.css'); ?>


  <!-- script -->
  <!-- script for display a list inside areatext -->

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
  <?php echo $this->Html->script('plugins/fullcalendar/moment.min.js'); ?>
  <?php echo $this->Html->script('plugins/fullcalendar/fullcalendar.min.js'); ?>
  <!-- Date range picker -->
  <?php echo $this->Html->script('plugins/daterangepicker/daterangepicker.js'); ?>
  <!-- Data picker -->
  <?php echo $this->Html->script('plugins/datapicker/bootstrap-datepicker.js'); ?>
  <!-- Clock picker -->
  <?php echo $this->Html->script('plugins/clockpicker/clockpicker.js'); ?>
  <!-- end script -->

  <script>
  $(document).ready(function() {


    $('.data_1 .input-group.date').datepicker({
      todayBtn: "linked",
      keyboardNavigation: false,
      forceParse: false,
      calendarWeeks: true,
      autoclose: true
    });

    $('.clockpicker').clockpicker();

        /* full calendar
        --------------------------------*/


      });

  </script>



</head>


</style>

<body class='detailsscreen'>

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
                          <img src="/enjin_main/enjin-shinsotu/img/bootstrap/a7.jpg" class="img-circle" alt="">                          </a>
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
                            <img src="/enjin_main/enjin-shinsotu/img/bootstrap/a7.jpg" class="img-circle" alt="">                            </a>
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
                              <img src="/enjin_main/enjin-shinsotu/img/bootstrap/a7.jpg" class="img-circle" alt="">                              </a>
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

                <!-- titile -->
                <div class="row wrapper border-bottom white-bg page-heading">
                  <div class="col-lg-10">
                    <h2><button class="btn btn-sm btn-white">
                      &lt; 戻る
                    </button>   
                    イベント詳細｜ivent0123456　会社説明会</h2>
                  </div>
                </div>
                <!-- end title -->

                <div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">
                  <!-- content -->   
                  <div class='full-content'>
                    <div class="col-lg-8">
                      <div class="tabs-container ibox">
                        <ul class="nav nav-tabs">
                          <li class="active"><a  data-toggle="tab" href="#tab-2">登録してください</a></li>
                          <li class=""><a href="10c_event_management_06">+</a></li>
                        </ul>
                        <div class="tab-content">

                          <!-- tab container 2 -->
                          <div id="tab-2" class="tab-pane active">
                            <div id="" class="">
                              <div class="panel-body show-return">
                                <div class="ibox-content" style="display: block;">
                                  <form method="get" class="form-horizontal form-edit">
                                    <div class="form-group"><label class="col-sm-4 control-label">開催日時</label>
                                      <div class="col-sm-8">
                                        <div class="form-group f_left col-sm-4 data_1" id="">
                                          <div class="input-group date">
                                            <span class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" class="form-control" value="2015/05/20">
                                          </div>
                                        </div>
                                        <div class="input-group clockpicker f_right_calendar" data-autoclose="true">
                                          <span class="input-group-addon">
                                            <span class="fa fa-clock-o"></span>
                                          </span>
                                          <input type="text" class="form-control" value="14:45" >
                                        </div>                                                                        
                                      </div>
                                    </div>    

                                    <div class="form-group"><label class="col-sm-4 control-label">終了日時</label>
                                      <div class="col-sm-8">
                                        <div class="form-group f_left col-sm-4 data_1" id="">
                                          <div class="input-group date">
                                            <span class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" class="form-control" value="2015/05/20">
                                          </div>
                                        </div>
                                        <div class="input-group clockpicker f_right_calendar" data-autoclose="true">
                                          <span class="input-group-addon">
                                            <span class="fa fa-clock-o"></span>
                                          </span>
                                          <input type="text" class="form-control" value="14:45" >
                                        </div>                                                                        
                                      </div>
                                    </div>  

                                    <div class="form-group"><label class="col-sm-4 control-label">個別テーマ</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control" value="弊社事業内容の説明と今後の展望">
                                      </div>
                                    </div>

                                    <div class="form-group"><label class="col-sm-4 control-label">当日内容</label>
                                      <div class="col-sm-8">                                       
                                        <div class="note-editable" contenteditable="true">
                                          <div class="form-control h-auto">
                                            <li>1次選考・書類選考者向け会社説明会</li>
                                            <li>リーフレットの配布</li>
                                            <li>業界に関する意識調査アンケート</li>
                                            <li>1次選考・書類選考者向け会社説明会</li>
                                            <li>リーフレットの配布</li>
                                            <li>業界に関する意識調査アンケート</li>
                                            <li>1次選考・書類選考者向け会社説明会</li>
                                            <li>リーフレットの配布</li>
                                            <li>業界に関する意識調査アンケート</li>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="form-group"><label class="col-sm-4 control-label">数字入力</label>
                                      <div class="col-sm-8">
                                        <span>
                                          <input type="text" class="form-control w40 pull-left m-r-sm" value="20">
                                          <span class='sp-text-pg'>人</span>
                                          <div class='clearfix'></div>
                                        </span>
                                      </div>
                                    </div>

                                    <div class="form-group"><label class="col-sm-4 control-label">募集締切日</label>
                                      <div class="col-sm-8">
                                        <div class="form-group f_left col-sm-4 data_1" id="">
                                          <div class="input-group date">
                                            <span class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" class="form-control" value="2015年5月16">
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="form-group"><label class="col-sm-4 control-label">開催場所</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control" value="第2会議室">
                                      </div>
                                    </div>

                                    <div class="form-group"><label class="col-sm-4 control-label">開催費用</label>
                                      <div class="col-sm-8">
                                        <span>
                                          <input type="text" class="form-control w40 pull-left m-r-sm" value="120,000">
                                          <span class='sp-text-pg'>円</span>
                                          <div class='clearfix'></div>
                                        </span>
                                      </div>
                                    </div>                                                            
                                  </form>
                                  <div class="btn-clear text-center">
                                    <a class='text-navy' href="">キャンセル</a>
                                    <button class="btn-tab btn-primary w-95" id='return-edit' type="">登録する</button>
                                  </div>
                                </div> 
                                <!-- end form 3-->
                              </div> 
                            </div>
                            
                          </div>
                          <!-- end tab 2-->

                          

                        </div>
                      </div>
                    </div>                
                  </div>
                </div>   

                <!-- footer -->
                <div class="row wrapper border-bottom white-bg page-heading clearfix">
                  <div class="col-lg-10">
                    <h2>
                      <button class="btn btn-sm btn-white">&lt; 戻る</button>
                    </h2>
                  </div>
                </div>
                <br>
                <br>              
                <div class='clearfix'></div>
                <div class="footer">
                  <div>
                    <strong>Copyright</strong>© enjin
                  </div>
                </div>
                <!-- end footer -->

              </div>
            </div>








            

          </body>

          </html>
