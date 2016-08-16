<!DOCTYPE html>
<html>

<head>
  <?php echo $this->Html->charset('utf-8'); ?> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>求人票管理 − 求人詳細</title>

  <!-- css -->
  <?php echo $this->Html->css('bootstrap/animate.css'); ?>
  <?php echo $this->Html->css('bootstrap/bootstrap.min'); ?>
  <?php echo $this->Html->css('font-awesome/css/font-awesome'); ?>
  <?php echo $this->Html->css('plugins/iCheck/custom'); ?>
  <?php echo $this->Html->css('plugins/fullcalendar/fullcalendar.css'); ?>
  <?php echo $this->Html->css('bootstrap/style'); ?>
  
  <?php echo $this->Html->css('enjin/email'); ?>
  
  <?php echo $this->Html->css('enjin/global.code'); ?>
  <?php echo $this->Html->css('enjin/global.group'); ?>


  <!-- Mainly scripts -->
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
  <?php echo $this->Html->script('kiwi.js'); ?>

  <script>
  $(document).ready(function() {
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: ''
      },
      lang: 'ja',
      editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function() {
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                  }
                },
                events: [
                {
                  // edit event
                  // url: '/enjin/registration',
                  start: '2015-05-20',
                  //end: '2015-05-21',
                  overlap: false,
                  rendering: 'background',
                  color: '#ff9f89'
                },

                ]
              });
  });

</script>

</head>

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
            <div class="navbar-header">
              <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>    
            </div>

            <div class="nav navbar-top-links navbar-right logo_enjin">
              <img src="/enjin-shinsotu/img/logo_enjin2.png" alt="logo">
            </div>

            <div class="nav navbar-top-links navbar-right logo_enjin">
              <div class="btn-group">
                <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle h-30 l-h-7" aria-expanded="false">2015<span class="caret"></span></button>
                <ul id="wydd" class="dropdown-menu">
                  <li><a href="#">2015</a></li>
                </ul>
                <form id="f_wanted_year" method="post">
                  <input type="hidden" name="year" id="year">
                </form>
                <script>
                $( document ).ready(function(){
                  $("#wydd a").click(function (){
                    $("#year").val(this.innerText);
                    $("#wydd").prev().html(this.innerText+'<span class="caret"></span>');
                                    //console.log( $(this).prev().html());
                                    //return false;
                                    $.post("/enjin-shinsotu/JobVotes/api_set_wanted_year", $("#f_wanted_year").serialize(), function (data){if(!data.code) location.reload()});
                                    return false;
                                  });
                });
                </script>
              </div>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                    <!-- <li class="dropdown">
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
                                  </li> -->
                                  <li>
                                    <!--logout-->
                                    <a href="http://localhost/enjin-shinsotu/Companies/logout">Log out</a>                                        <!--end logout-->
                                  </li>
                                </ul>
                              </nav>
                            </div>

                            <!-- title -->
                            <div class="row wrapper border-bottom white-bg page-heading">
                              <div class="col-lg-10">
                                <h2><button class="btn btn-sm btn-white">
                                  &lt; 戻る
                                </button>   
                                イベント詳細｜ivent0123456-1~ 2 2015年5月10日 会社説明会</h2>
                              </div>
                            </div>
                            <!-- end title -->

                            <div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">
                              <!-- content -->   
                              <div class='full-content'>

                                <!-- イベント情報 -->
                                <div class='col-lg-8'>
                                  <div class="ibox">

                                    <div class="ibox-title">
                                      <h5>イベント情報</h5>
                                      <div class="ibox-tools">
                                        <a href="9b_06_eventschedule_detailsscreen" type="button" class="btn btn-primary btn-xs">編集</a>
                                      </div>
                                    </div>
                                    <div class="ibox-content bg-white p-sm">
                                      <form method="get" class="form-horizontal">
                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">イベント名</label>
                                          <div class="col-sm-8">
                                            <div class="form-control border-none">会社説明会</div>
                                          </div>
                                        </div>

                                        <div class="form-group"><label class="col-sm-4 control-label">求人票ID</label>
                                          <div class="col-sm-8">
                                            <div class="form-control border-none">2016年新卒・営業</div>     
                                          </div>               
                                        </div>

                                        <div class="form-group"><label class="col-sm-4 control-label">イベント種別</label>
                                          <div class="col-sm-8">
                                            <div class="form-control border-none">説明会</div>
                                          </div>
                                        </div>

                                        <div class="form-group"><label class="col-sm-4 control-label">ターゲット選考段階ID</label>
                                          <div class="col-sm-8">
                                            <div class="form-control border-none">1次選考</div>
                                          </div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-4 control-label">ターゲット選考段階比較タイプ</label>
                                          <div class="col-sm-8">
                                            <div class="form-control border-none">以前</div>
                                          </div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-4 control-label">ターゲット選考ステータス （（マスタ））</label>
                                          <div class="col-sm-8">
                                            <div class="form-control border-none">1次選考</div>
                                          </div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-4 control-label">イベント内容</label>
                                          <div class="col-sm-8">
                                            <div class="form-control border-none">1次選考候補者向け</div>                                
                                          </div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-4 control-label">リクナビID</label>
                                          <div class="col-sm-8">
                                            <div class="form-control border-none">ー</div>                                
                                          </div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-4 control-label">マイナビID</label>
                                          <div class="col-sm-8">
                                            <div class="form-control border-none">ー</div>                                
                                          </div>
                                        </div>
                                      </form>                                        
                                    </div>
                                  </div>
                                </div>
                                <!-- end イベント情報 -->

                                <!-- イベント担当者登録 -->
                                <div class="col-lg-4">
                                  <div class="ibox">
                                    <div class="ibox-title">
                                      <h5>イベント担当者</h5>
                                      <div class="ibox-tools">
                                        <a class="collapse-link">
                                          <i class="fa fa-chevron-up"></i>
                                        </a>                                                           
                                      </div>
                                    </div>
                                    <div class="ibox-content clearfix p-sm">
                                      <div class="">
                                        <div class="table-border">
                                          <table class="table table-bordered no-margin-bottom">
                                            <thead>
                                              <tr>
                                                <th>イベント担当者名</th>

                                              </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <td><a class="text-navy" href="">採用担当者A</a></td>

                                              </tr>      
                                              <tr>
                                                <td><a class="text-navy" href="">採用担当者B</a></td>

                                              </tr>                                  
                                            </tbody>
                                          </table>    
                                        </div>
                                      </div>  
                                    </div>

                                  </div>                      
                                </div>
                                <!-- end イベント担当者登録 -->

                              </div>

                              <!-- dot -->
                              <div class='col-lg-12 border-dot'></div>

                              <!-- イベント開催日程 -->
                              <div class='col-lg-12 wrapper-content-title top-title'>
                                <div class='title-tab'>
                                  <h3>イベント開催日程</h3>
                                </div>
                              </div>
                              <!-- end イベント開催日程 -->

                              <div class='full-content'>
                                <!-- tab 2015年5月20日 -->
                                <div class="col-lg-8">
                                  <div class="tabs-container ibox">
                                    <ul class="nav nav-tabs">
                                      <li class="active"><a data-toggle="tab" href="#tab-2" aria-expanded="true">2015年5月20日</a></li>
                                      <li class=""><a data-toggle="tab" href="#tab-1" aria-expanded="false">2015年5月27日</a></li>
                                    </ul>
                                    <div class="tab-content">
                                      <div id="tab-2" class="tab-pane active">
                                        <div class="panel-body">                            
                                          <div class="ibox-content" style="display: block;">
                                            <form method="get" class="form-horizontal">
                                              <div class="form-group"><label class="col-sm-4 control-label">開催日時</label>
                                                <div class="col-sm-8">
                                                  <div class="form-control border-none">2015年5月20日 14:00</div>
                                                </div>
                                              </div>    
                                              <div class="form-group"><label class="col-sm-4 control-label">終了日時</label>
                                                <div class="col-sm-8">
                                                  <div class="form-control border-none">2015年5月20日 14:45</div>
                                                </div>
                                              </div>  
                                              <div class="form-group"><label class="col-sm-4 control-label">個別テーマ</label>
                                                <div class="col-sm-8">
                                                  <div class="form-control border-none">弊社事業内容の説明と今後の展望</div>
                                                </div>
                                              </div>  
                                              <div class="form-group"><label class="col-sm-4 control-label">当日内容</label>
                                                <div class="col-sm-8">
                                                  <div class="form-control border-none h-auto">

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
                                              <div class="form-group"><label class="col-sm-4 control-label">定員数</label>
                                                <div class="col-sm-8">
                                                  <div class="form-control border-none">20人</div>
                                                </div>
                                              </div>  
                                              <div class="form-group"><label class="col-sm-4 control-label">募集締切日</label>
                                                <div class="col-sm-8">
                                                  <div class="form-control border-none">2015年5月16日</div>
                                                </div>
                                              </div>  
                                              <div class="form-group"><label class="col-sm-4 control-label">開催場所</label>
                                                <div class="col-sm-8">
                                                  <div class="form-control border-none">第2会議室</div>
                                                </div>
                                              </div>      
                                              <div class="form-group"><label class="col-sm-4 control-label">開催費用</label>
                                                <div class="col-sm-8">
                                                  <div class="form-control border-none">120,000円</div>
                                                </div>
                                              </div>                                                                                
                            <!--       <div class="btn-clear text-center">
                                    <button class="btn-tab btn-primary w-95" type="submit">編集</button>
                                  </div> -->
                                </form>
                              </div> 
                            </div>
                          </div>
                          <!-- end tab 2-->

                          <!-- tab 1 -->
                          <div id="tab-1" class="tab-pane">
                          <!--   <div class="panel-body">
                              <div class="ibox-title">
                                <h5>候補者情報</h5>

                              </div>

                              <div class="ibox-content" style="display: block;">
                                <form method="get" class="form-horizontal">
                                  <div class="form-group"><label class="col-sm-4 control-label">選考履歴ID</label>

                                    <div class="col-sm-8"><input type="text" class="form-control border-none" value="1234567"></div>
                                  </div>

                                  <div class="form-group"><label class="col-sm-4 control-label">候補者名</label>
                                    <div class="col-sm-8"><input type="text" class="form-control border-none" value="田中太朗">
                                    </div>
                                  </div>
                                  <div class="form-group"><label class="col-sm-4 control-label">候補者ID</label>

                                    <div class="col-sm-8"><input type="text" class="form-control border-none" value="987654"></div>
                                  </div>

                                  <div class="form-group"><label class="col-sm-4 control-label">選考段階名</label>
                                    <div class="col-sm-8"><input type="text" class="form-control border-none" value="２次面接">
                                    </div>
                                  </div>
                                  <div class="form-group"><label class="col-sm-4 control-label">選考ステータス</label>

                                    <div class="col-sm-8"><input type="text" class="form-control border-none" value="合格"></div>
                                  </div>

                                  <div class="form-group"><label class="col-sm-4 control-label">選考開始予定日時</label>
                                    <div class="col-sm-8"><input type="text" class="form-control border-none" value="YYYY/MM/DD HH:SS">
                                    </div>
                                  </div>
                                  <div class="form-group"><label class="col-sm-4 control-label">選考開始予定日時</label>
                                    <div class="col-sm-8"><input type="text" class="form-control border-none" value="YYYY/MM/DD HH:SS">
                                    </div>
                                  </div>
                                </form>

                    
                        

                          

                              </div>  
                        
                              <div class="ibox-content" style="display: block;">
                                <form method="get" class="form-horizontal">
                                  <div class="form-group"><label class="col-sm-4 control-label">求人票ID</label>

                                    <div class="col-sm-8"><input type="text" class="form-control border-none" value="ABC1 23456"></div>
                                  </div>
                                  <div class="form-group"><label class="col-sm-4 control-label">求人票タイトル</label>

                                    <div class="col-sm-8"><input type="text" class="form-control border-none" value="求人票タイトル"></div>
                                  </div>

                                </form>
                              </div> 
                            
                              <div class="ibox-content" style="display: block;">
                                <form method="get" class="form-horizontal">
                                  <div class="form-group"><label class="col-sm-4 control-label">選考ステータスオプション</label>

                                    <div class="col-sm-8"><input type="text" class="form-control border-none" value="オプション内容"></div>
                                  </div>
                                  <div class="form-group"><label class="col-sm-4 control-label">掲示年収</label>

                                    <div class="col-sm-8"><input type="text" class="form-control border-none" value="400万円"></div>
                                  </div>

                                  <div class="form-group"><label class="col-sm-4 control-label">コメント</label>

                                    <div class="col-sm-8"><input type="text" class="form-control border-none" value="選考履歴に対する、 コメント＆メモ"></div>
                                  </div>
                                  <div class="form-group"><label class="col-sm-4 control-label">訪問先情報</label>

                                    <div class="col-sm-8"><input type="text" class="form-control border-none" value="訪問先情報"></div>
                                  </div>

                                  <div class="form-group"><label class="col-sm-4 control-label">流入元企業への選考ステータスの公開可否</label>

                                    <div class="col-sm-8"><input type="text" class="form-control border-none" value="選考履歴に対する、 コメント＆メモ"></div>
                                  </div>
                                  <div class="form-group"><label class="col-sm-4 control-label">候補者への選考ステータスの公開可否</label>

                                    <div class="col-sm-8">
                                      <div class="switch">
                                        <div class="onoffswitch">
                                          <input type="checkbox" checked="" class="onoffswitch-checkbox" id="example2">
                                          <label class="onoffswitch-label" for="example2">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                          </label>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="form-group"><label class="col-sm-4 control-label">訪問先情報</label>

                                    <div class="col-sm-8">
                                      <div class="switch">
                                        <div class="onoffswitch">
                                          <input type="checkbox" checked="" class="onoffswitch-checkbox" id="example1">
                                          <label class="onoffswitch-label" for="example1">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                          </label>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="form-group"><label class="col-sm-4 control-label">最終更新者タイプ</label>

                                    <div class="col-sm-8"><input type="text" class="form-control border-none" value="採用担当者"></div>
                                  </div>

                                  <div class="form-group"><label class="col-sm-4 control-label">最終更新者採用担当者ID</label>

                                    <div class="col-sm-8"><input type="text" class="form-control border-none" value="live1234"></div>
                                  </div>

                                  <div class="form-group"><label class="col-sm-4 control-label">最終更新流入元担当者ID</label>

                                    <div class="col-sm-8"><input type="text" class="form-control border-none" value="mynavi12345678"></div>
                                  </div>

                                </form>
                              </div> 
                    


                             
                            </div>  -->
                          </div>
                          <!-- end tab -1-->


                          <!-- end tab 3-->
                        </div>
                      </div>
                    </div>
                    <!-- end tab 2015年5月20日 -->

                    <div class="col-lg-4">
                      <div class="ibox">
                        <div class="ibox-title">
                          <h5>カレンダー</h5>
                          <div class="ibox-tools">
                            <a class="collapse-link">
                              <i class="fa fa-chevron-up"></i>
                            </a>                                                           
                          </div>
                        </div>
                        <div class="ibox-content clearfix p-sm">
                          <div id="calendar" class="fc fc-ltr fc-unthemed">
                          </div>
                        </div>                                  
                      </div>

                      <!-- action table -->
                   <!--    <div class='b-cal four-action m-b'>
                        <div class="btn-group pull-right">
                          <button data-toggle="dropdown" class="btn bg-white dropdown-toggle h-30" aria-expanded="false">その他<span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li><a href="#">その他</a></li>
                            <li><a href="#">その他</a></li>
                          </ul>
                        </div>
                        <div class='pull-right'>
                          <button class='m-r-sm btn btn-sm btn-primary'>印刷</button>
                        </div>
                        <div class='pull-right'>
                          <button class='m-r-sm btn btn-sm btn-primary'>メール</button>
                        </div>
                        <div class="btn-group pull-right">
                          <button data-toggle="dropdown" class="m-r-sm btn bg-white dropdown-toggle h-30" aria-expanded="false">チェックのみ<span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li><a href="#">チェックのみ</a></li>
                          </ul>
                        </div>
                        <div class='clear'></div>
                      </div> -->
                      <!-- end action table -->

                    </div>

                    <!-- table イベント情報 -->
                    <div class='full-content col-lg-12'>
                      <div class='ibox'>
                        <div id="modal-form" class="modal fade" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-sm-12 b-r"><h3 class="m-t-none m-b">2015年5月10日 会社説明会 田中 太朗 の提出書類</h3>
                                    <div class="table-responsive enj_res">
                                      <table class="table table-center table-striped table-bordered">
                                        <thead>
                                          <tr>
                                            <th class="t-align-left">
                                              <div>
                                                <input type="checkbox" class="i-checks" name="input[]"></div>
                                              </div>
                                            </th>
                                            <th class="">
                                              <div class="b-cal four-action">
                                                <div class="pull-left m-r-sm">
                                                  <div class="no-borders ver-mid btn-group btn-block">

                                                    <select class='btn btn-white btn-sm'>
                                                      <option>採用担当者選択</option>
                                                      <option>2採用担当者選択</option>
                                                    </select>
                                                  </div>
                                                </div>

                                                <div class="pull-left">
                                                  <button class="m-r-sm btn btn-primary btn-sm">印刷</button>
                                                </div>

                                                <div class="pull-left">
                                                  <button class="btn btn-primary btn-sm m-r-sm">参加者CSV登録</button>
                                                </div>                    

                                                <div class="clear"></div>
                                              </div>
                                            </th>                                           
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>
                                              <input type="checkbox" class="i-checks" name="input[]"></div>
                                            </td>
                                            <td>
                                              <a class='text-navy' href="">田中太朗_提出書類.xlsx</a>
                                            </td>
                                          </tr>

                                          <tr>
                                            <td>
                                              <input type="checkbox" class="i-checks" name="input[]"></div>
                                            </td>
                                            <td>
                                              <a class='text-navy' href="">田中太朗_提出書類.xlsx</a>
                                            </td>
                                          </tr>

                                        </tbody>
                                      </table>
                                    </div>

                                  </div>

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>



                        <div class="ibox-title">
                          <h5>イベント参加履歴</h5>                          
                          <div class="ibox-tools">
                            <a class="collapse-link">
                              <i class="fa fa-chevron-up"></i>
                            </a>                                                           
                          </div>
                        </div>
                        <div class='ibox-content pd-none border-none'>                     
                          <div class="ibox-content p-sm bg-white">
                            <div class="">
                              <div class="row mrb15">
                                <div class="col-lg-8">
                                  <div class="btn-group">
                                    <select class="form-control pull-left btn h-30 linked">
                                      <option value="">チェックのみ</option>
                                      <option value="1">すべて</option>
                                    </select>
                                  </div>

                                  <button type="button" class="btn btn-sm btn-white mailIco" data-toggle="modal" data-target="#selTmpl">
                                    <i class="fa fa-envelope-o"></i>
                                  </button>
                                  <button type="submit" class="btn btn-sm btn-white">
                                    <i class="fa fa-print" onclick="window.print()"></i>
                                  </button>

                                <!--   <div class="btn-group p-r b-r2">
                                    <select class="form-control pull-left btn h-30 w-100">
                                      <option>その他</option>
                                      <option>その他</option>
                                      <option>その他</option>
                                    </select>  
                                  </div>

                                  <button class="btn btn-primary btn-sm  m-l m-r-sm" onclick="window.location.href='/enjin-shinsotu/CanCandidates/add'">新規候補者登録</button>
                                  <button class="btn btn-primary btn-sm m-r-sm" onclick="window.location.href='/enjin-shinsotu/CanCandidates/csv_add'">参加者CSV登録</button> -->
                                </div>

                                <!------------pagination--------------> 
                                <div class="col-lg-4">
                                  <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                    <ul class="pagination m-g-none">
                                      <li class="disabled"><a>Prev</a></li><li class="disabled"><a>Next</a></li>  
                                    </ul>
                                  </div>
                                  <div class="pull-right lh32">1件中1件表示&nbsp;&nbsp;</div>
                                </div>
                              </div>
                              <div class="table-responsive enj_res">
                                <table class="table table-striped table-bordered tb1-chb">
                                  <thead>
                                    <tr>
                                      <th>
                                        <div>
                                          <input type="checkbox" class="i-checks" name="input[]">
                                        </div>
                                      </th>
                                      <th>候補者ID</th>
                                      <th>名前</th>
                                      <th>大学名</th>
                                      <th>参加ステータス</th>
                                      <th>提出書類</th>
                                      <th>あなたの評価</th>
                                      <th>コメント</th>
                                <!--       <th>操作</th> -->
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>
                                        <div>
                                          <input type="checkbox" checked="" class="i-checks" name="input[]">
                                        </div>
                                      </td>
                                      <td><a href="#">987654</a></td>
                                      <td><a href="#">田中 太朗</a></td>
                                      <td><a href="#">東名</a></td>
                                     <!--  <td>
                                        <select class='form-control'>
                                          <option>候補者キャンセル</option>
                                        </select>
                                      </td> -->
                                      <td>予約中</td>
                                      <td>
                                        <span class='dp-inl full-width'>
                                          <a class='text-with-btn pull-left' href="">
                                            <div class='content_border_button text-with-btn pull-left'>
                                              <div>
                                                <a data-toggle="modal" class="" href="#modal-form">2</a>
                                              </div>
                                            </div>
                                          </a>
                                          <!-- <button class='btn btn-primary btn-xs pull-right'>ファイル追加</button> -->
                                        </span>

                                      </td>
                                      <!-- <td><input type='number' class='form-control' value='77' /></td> -->
                                      <td>77</td>
                                      <!-- <td><input type='text' class='form-control' value='ほぼ平均点だかあまり印象に残らず'/></td> -->
                                      <td>ほぼ平均点だかあまり印象に残らず</td>
                                      <!-- <td class="button_cen hover-button">                                 
                                        <a href="" type="button" class="btn btn-primary btn-xs cl-white">削除</a>            
                                      </td> -->
                                    </tr>
                                     <tr>
                                      <td>
                                        <div>
                                          <input type="checkbox" checked="" class="i-checks" name="input[]">
                                        </div>
                                      </td>
                                      <td><a href="#">987654</a></td>
                                      <td><a href="#">田中 太朗</a></td>
                                      <td><a href="#">東名</a></td>
                                     <!--  <td>
                                        <select class='form-control'>
                                          <option>候補者キャンセル</option>
                                        </select>
                                      </td> -->
                                      <td>予約中</td>
                                      <td>
                                        <span class='dp-inl full-width'>
                                          <a class='text-with-btn pull-left' href="">
                                            <div class='content_border_button text-with-btn pull-left'>
                                              <div>
                                                <a data-toggle="modal" class="" href="#modal-form">2</a>
                                              </div>
                                            </div>
                                          </a>
                                          <!-- <button class='btn btn-primary btn-xs pull-right'>ファイル追加</button> -->
                                        </span>

                                      </td>
                                      <!-- <td><input type='number' class='form-control' value='77' /></td> -->
                                      <td>77</td>
                                      <!-- <td><input type='text' class='form-control' value='ほぼ平均点だかあまり印象に残らず'/></td> -->
                                      <td>ほぼ平均点だかあまり印象に残らず</td>
                                      <!-- <td class="button_cen hover-button">                                 
                                        <a href="" type="button" class="btn btn-primary btn-xs cl-white">削除</a>            
                                      </td> -->
                                    </tr>
                                   <tr>
                                      <td>
                                        <div>
                                          <input type="checkbox" checked="" class="i-checks" name="input[]">
                                        </div>
                                      </td>
                                      <td><a href="#">987654</a></td>
                                      <td><a href="#">田中 太朗</a></td>
                                      <td><a href="#">東名</a></td>
                                     <!--  <td>
                                        <select class='form-control'>
                                          <option>候補者キャンセル</option>
                                        </select>
                                      </td> -->
                                      <td>予約中</td>
                                      <td>
                                        <span class='dp-inl full-width'>
                                          <a class='text-with-btn pull-left' href="">
                                            <div class='content_border_button text-with-btn pull-left'>
                                              <div>
                                                <a data-toggle="modal" class="" href="#modal-form">2</a>
                                              </div>
                                            </div>
                                          </a>
                                          <!-- <button class='btn btn-primary btn-xs pull-right'>ファイル追加</button> -->
                                        </span>

                                      </td>
                                      <!-- <td><input type='number' class='form-control' value='77' /></td> -->
                                      <td>77</td>
                                      <!-- <td><input type='text' class='form-control' value='ほぼ平均点だかあまり印象に残らず'/></td> -->
                                      <td>ほぼ平均点だかあまり印象に残らず</td>
                                      <!-- <td class="button_cen hover-button">                                 
                                        <a href="" type="button" class="btn btn-primary btn-xs cl-white">削除</a>            
                                      </td> -->
                                    </tr>
                                    <tr>
                                      <td>
                                        <div>
                                          <input type="checkbox" checked="" class="i-checks" name="input[]">
                                        </div>
                                      </td>
                                      <td><a href="#">987654</a></td>
                                      <td><a href="#">田中 太朗</a></td>
                                      <td><a href="#">東名</a></td>
                                     <!--  <td>
                                        <select class='form-control'>
                                          <option>候補者キャンセル</option>
                                        </select>
                                      </td> -->
                                      <td>予約中</td>
                                      <td>
                                        <span class='dp-inl full-width'>
                                          <a class='text-with-btn pull-left' href="">
                                            <div class='content_border_button text-with-btn pull-left'>
                                              <div>
                                                <a data-toggle="modal" class="" href="#modal-form">2</a>
                                              </div>
                                            </div>
                                          </a>
                                          <!-- <button class='btn btn-primary btn-xs pull-right'>ファイル追加</button> -->
                                        </span>

                                      </td>
                                      <!-- <td><input type='number' class='form-control' value='77' /></td> -->
                                      <td>77</td>
                                      <!-- <td><input type='text' class='form-control' value='ほぼ平均点だかあまり印象に残らず'/></td> -->
                                      <td>ほぼ平均点だかあまり印象に残らず</td>
                                      <!-- <td class="button_cen hover-button">                                 
                                        <a href="" type="button" class="btn btn-primary btn-xs cl-white">削除</a>            
                                      </td> -->
                                    </tr>
                                  </tbody>
                                  <tfoot>
                                    <tr>
                                      <th class='t-align-left'>
                                        <div>
                                          <input type="checkbox" class="i-checks" name="input[]">
                                        </div>
                                      </th>
                                      <th>候補者ID</th>
                                      <th>名前</th>
                                      <th>大学名</th>
                                      <th>参加ステータス</th>
                                      <th>提出書類</th>
                                      <th>あなたの評価</th>
                                      <th>コメント</th>                                     
                                    </tr>
                                  </tfoot>
                                </table>
                              </div>
                              <div class="row ">
                                <div class="col-lg-8">
                                  <div class="btn-group">
                                    <select class="form-control pull-left btn h-30 linked">
                                      <option value="">チェックのみ</option>
                                      <option value="1">すべて</option>
                                    </select>
                                  </div>

                                  <button type="button" class="btn btn-sm btn-white mailIco" data-toggle="modal" data-target="#selTmpl">
                                    <i class="fa fa-envelope-o"></i>
                                  </button>
                                  <button type="submit" class="btn btn-sm btn-white">
                                    <i class="fa fa-print" onclick="window.print()"></i>
                                  </button>

                               <!--    <div class="btn-group p-r b-r2">
                                    <select class="form-control pull-left btn h-30 w-100">
                                      <option>その他</option>
                                      <option>その他</option>
                                      <option>その他</option>
                                    </select>  
                                  </div>

                                  <button class="btn btn-primary btn-sm  m-l m-r-sm" onclick="window.location.href='/enjin-shinsotu/CanCandidates/add'">新規候補者登録</button>
                                  <button class="btn btn-primary btn-sm m-r-sm" onclick="window.location.href='/enjin-shinsotu/CanCandidates/csv_add'">参加者CSV登録</button> -->
                                </div>

                                <!------------pagination--------------> 
                                <div class="col-lg-4">
                                  <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                    <ul class="pagination m-g-none">
                                      <li class="disabled"><a>Prev</a></li><li class="disabled"><a>Next</a></li>  
                                    </ul>
                                  </div>
                                  <div class="pull-right lh32">1件中1件表示&nbsp;&nbsp;</div>
                                </div>
                              </div>                              
                            </div>
                          </div>
                        </div>  
                      </div>
                    </div>
                    <!-- end table イベント情報 -->

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
