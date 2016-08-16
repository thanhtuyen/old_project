<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>候補者管理 − 候補者詳細</title>

  <!-- css -->
  <?php echo $this->Html->css('bootstrap/bootstrap.min.css'); ?>
  <?php echo $this->Html->css('font-awesome/css/font-awesome.css'); ?>
  <?php echo $this->Html->css('plugins/iCheck/custom.css'); ?>
  <?php echo $this->Html->css('bootstrap/animate.css'); ?>
  <?php echo $this->Html->css('bootstrap/style.css'); ?>
  <?php echo $this->Html->css('plugins/clockpicker/clockpicker'); ?>
  <?php echo $this->Html->css('plugins/datapicker/datepicker3'); ?>
  <?php echo $this->Html->css('plugins/daterangepicker/daterangepicker-bs3'); ?>
  <?php echo $this->Html->css('plugins/fullcalendar/fullcalendar.css'); ?>
  <?php echo $this->Html->css('plugins/switchery/switchery'); ?>
  <?php echo $this->Html->css('enjin/candidatesdetails.css'); ?>
  <?php echo $this->Html->css('enjin/global.css'); ?>
  <!-- end css -->


  <!-- script -->
  <?php echo $this->Html->script('plugins/fullcalendar/moment.min.js'); ?>
  <?php echo $this->Html->script('jquery-2.1.1.js'); ?>
  <?php echo $this->Html->script('bootstrap.min.js'); ?>
  <?php echo $this->Html->script('plugins/metisMenu/jquery.metisMenu.js'); ?>
  <?php echo $this->Html->script('plugins/slimscroll/jquery.slimscroll.min.js'); ?>
  <?php echo $this->Html->script('inspinia.js'); ?>
  <?php echo $this->Html->script('plugins/pace/pace.min.js'); ?>
  <?php echo $this->Html->script('jquery-ui.custom.min.js'); ?>
  <?php echo $this->Html->script('plugins/iCheck/icheck.min.js'); ?>
  <?php echo $this->Html->script('plugins/fullcalendar/fullcalendar.min.js'); ?>
  <?php echo $this->Html->script('plugins/daterangepicker/daterangepicker.js'); ?>
  <?php echo $this->Html->script('plugins/datapicker/bootstrap-datepicker.js'); ?>
  <?php echo $this->Html->script('kiwi.js'); ?>
  <!-- end script -->

</head>

<body>
  <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
      <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
          <li class="nav-header">
            <div class="dropdown profile-element"> 
              <span>
                <?php echo $this->Html->image("bootstrap/profile_small.jpg", array("class" => "img-circle",)); ?>
              </span>
              <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David
                  Williams</strong>
                </span> <span class="text-muted text-xs block">Art Director <b
                class="caret"></b></span> </span> 
              </a>
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
            <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">ダッシュボード</span> <span
              class="fa arrow"></span>
            </a>
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
            <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">イベント管理</span><span
              class="fa arrow"></span>
            </a>
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
            <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">メール送信管理</span><span
              class="fa arrow"></span>
            </a>
            <ul class="nav nav-second-level collapse">
              <li><a href="form_basic.html">Basic form</a></li>
              <li><a href="form_advanced.html">Advanced Plugins</a></li>
              <li><a href="form_wizard.html">Wizard</a></li>
              <li><a href="form_file_upload.html">File Upload</a></li>
              <li><a href="form_editors.html">Text Editor</a></li>
            </ul>
          </li>
          <li>
            <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">マスタ管理</span> </a>
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
            <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">マイページ</span><span
              class="fa arrow"></span>
            </a>
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
                          <?php echo $this->Html->image("logo_enjin2.png", array("alt" => "logo",)); ?>
                        </div>
                        <div class="select_option m-t-sm">

                        </div>
                        <div class='nav navbar-top-links navbar-right logo_enjin'>
                          <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle h-30 l-h-7" aria-expanded="false">2015<span class="caret"></span></button>
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
                                <a href="profile.html" class="pull-left"></a>
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
                                <a href="profile.html" class="pull-left"></a>
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
                                <a href="profile.html" class="pull-left"></a>
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

        <!-- title -->
        <div class="row wrapper border-bottom white-bg page-heading">
          <div class="col-lg-10">
            <h2>候補者登録</h2>
          </div>
        </div>
        <!-- end title -->

        <!-- content -->
        <div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">
          <div class="col-lg-8">
            <div class='ibox'>
              <div class="ibox-title">
                <h5>候補者情報</h5>
                <div class="ibox-tools">
                  <button type='button' class='btn btn-primary btn-xs'>編集</button>
                </div>
              </div>
              <div class='ibox-content bg-white p-sm'>
                <div class="">
                  <div class="tabs-container">
                    <ul class="nav nav-tabs">
                      <li class=""><a href="87_10">付随データ </a></li>
                      <li class="active"><a  href="#tab-2">基本データ</a></li>
                    </ul>
                    <div class="tab-content">
                      <!-- tab container 1 -->
                      <div id="tab-2" class="tab-pane active">
                        <div class="panel-body form-edit p-sm">
                          <div class='ibox no-margin-bottom'>
                            <div class="ibox-title">
                              <h5>提出書類</h5>
                              <div class="ibox-tools">
                                <a class="close-link">
                                  <i class="fa fa-times"></i>
                                </a>
                              </div>
                            </div>
                            <div class="ibox-content bg-white p-sm pd-bottom-none pd-right-none">
                              <form method="get" class="form-horizontal">
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">ファイル</label>
                                  <div class="col-sm-8">
                                    <span class="fileUpload btn btn-primary pull-left">
                                      <span>ファイル選択</span>
                                      <input id="uploadfile" type="file" class="upload">
                                    </span>
                                    <input type="text" placeholder="" id="filename" class="form-control bg-white w60" readonly="true">
                                    <div class="clear"></div>
                                  </div>
                                </div>                                                    
                              </form>
                            </div>  
                          </div>

                          <div class='ibox no-margin-bottom'>
                            <div class="ibox-title">
                              <h5>語学</h5>
                              <div class="ibox-tools">
                                <a class="close-link">
                                  <i class="fa fa-times"></i>
                                </a>
                              </div>
                            </div>
                            <div class="ibox-content bg-white p-sm pd-bottom-none pd-right-none">
                              <form method="get" class="form-horizontal">
                                <div class="form-group"><label class="col-sm-4 control-label">言語</label>
                                  <div class="col-sm-4">
                                    <div class="no-borders ver-mid btn-group btn-block">
                                      <select class="form-control" id='sl-language' onchange='sllanguage()'>
                                        <option selected="selected">英語</option>
                                        <option>英語</option>
                                        <option>その他</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>  

                                <div class="form-group sl-language-hiden fr-hiden"><label class="col-sm-4 control-label">外国語</label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control" value="スワヒリ語">
                                  </div>
                                </div>

                                <div class="form-group"><label class="col-sm-4 control-label">レベル</label>
                                  <div class="col-sm-4"><input type="number" class="form-control" value="10"></div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">海外在住年数</label>
                                  <div class="col-sm-8">
                                    <select class='btn btn-white'>
                                      <option>2年</option>
                                      <option>2年</option>
                                    </select>                                             
                                  </div>
                                </div>                                                
                              </form>
                            </div>  
                          </div>

                          <div class='ibox no-margin-bottom'>
                            <div class="ibox-title">
                              <h5>特記事項</h5>
                              <div class="ibox-tools">
                                <a class="close-link">
                                  <i class="fa fa-times"></i>
                                </a>
                              </div>
                            </div>
                            <div class="ibox-content bg-white p-sm pd-bottom-none pd-right-none">
                              <form method="get" class="form-horizontal">
                                <div class="form-group"><label class="col-sm-4 control-label">コメント</label>
                                  <div class="col-sm-8">
                                    <textarea class='full-width form-control' rows='5'>海外青年協力隊での功績が認められ、東アフリカより特別市民権を与えられている。</textarea>
                                  </div>
                                </div>  

                                <div class="form-group"><label class="col-sm-4 control-label">言語</label>
                                  <div class="col-sm-4">
                                    <div class="no-borders ver-mid btn-group btn-block">

                                      <select class="form-control">
                                        <option selected="selected">最要 担当朗</option>
                                        <option>最要 担当朗</option>
                                        <option>最要 担当朗</option>
                                        <option>最要 担当朗</option>
                                      </select>
                                    </div>
                                  </div>
                                </div> 

                              </form>
                            </div>  
                          </div>

                          <div class='ibox no-margin-bottom'>
                            <div class="ibox-title">
                              <h5>候補者カスタム属性</h5>
                              <div class="ibox-tools">
                                <a class="close-link">
                                  <i class="fa fa-times"></i>
                                </a>
                              </div>
                            </div>
                            <div class="ibox-content bg-white p-sm pd-bottom-none pd-right-none">
                              <div method="get" class="form-horizontal">
                                <div id="modal-form" class="modal fade" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h3>カスタム項目追加 </h3>
                                        <div class="ibox-title">
                                          <h5>カスタム項目</h5>      
                                        </div>
                                        <div class='ibox-content bg-white p-sm'>
                                          <div class="row">

                                            <div class="col-sm-12">
                                              <form method="get" class="form-horizontal form-edit">
                                              <div class="form-group"><label class="col-sm-4 control-label">カスタム項目名</label>
                                                <div class="col-sm-8">
                                                  <input type="text" class="form-control" value="入力">
                                                </div>
                                              </div>  
                                              <div class="form-group"><label class="col-sm-4 control-label">タイプ</label>
                                                <div class="col-sm-4">
                                                  <div class="no-borders ver-mid btn-group btn-block">
                                                    <select class="form-control">
                                                      <option selected="selected">テキスト</option>                 
                                                    </select>
                                                  </div>
                                                </div>
                                              </div> 

                                              <div class='button_cen'>
                                                <button type='submit' class='btn btn-primary btn-sm w-95'>追加</button>
                                              </div>
                                            </form>








                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-4 control-label">カスタム項目</label>
                                <div class="col-sm-4">
                                  <div class="no-borders ver-mid btn-group btn-block">    
                                    <select class="form-control">
                                      <option selected="selected">カスタム項目名</option>
                                      <option>カスタム項目名</option>
                                      <option>カスタム項目名</option>
                                      <option>カスタム項目名</option>
                                    </select>
                                  </div>
                                </div>

                                <div class="col-sm-4">
                                  <div class="no-borders ver-mid btn-group btn-block">    
                                    <button type='button' data-toggle="modal" class="btn btn-primary" href="#modal-form">
                                      マスタ項目追加
                                    </button>
                                  </div>
                                </div>

                              </div>   

                              <div class="form-group"><label class="col-sm-4 control-label">値</label>
                                <div class="col-sm-8"><input type="text" class="form-control" value="入力"></div>
                              </div>   

                            </div>
                          </div>  
                        </div>

                        <div class='ibox no-margin-bottom'>
                          <div class="ibox-title">
                            <h5>資格</h5>
                            <div class="ibox-tools">
                              <a class="close-link">
                                <i class="fa fa-times"></i>
                              </a>
                            </div>
                          </div>
                          <div class="ibox-content bg-white p-sm pd-bottom-none pd-right-none">
                            <form method="get" class="form-horizontal">

                              <div class="form-group">
                                <label class="col-sm-4 control-label">資格</label>
                                <div class="col-sm-8">                                
                                  <select class='btn btn-white' id='sl-pro' onchange='slpro()'>
                                    <option>介護ヘルパー2級</option>
                                    <option>介護ヘルパー2級</option>
                                    <option>その他</option>
                                  </select>
                                </div>
                              </div>  

                              <div class="form-group sl-pro-hiden fr-hiden">
                                <label class="col-sm-4 control-label">資格</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" value="入力">
                                </div>
                              </div> 

                              <div class="form-group">
                                <label class="col-sm-4 control-label">スコア</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" value="入力">
                                </div>
                              </div> 

                              <div class="form-group"><label class="col-sm-4 control-label">取得年月</label>
                                <div class="col-sm-8">
                                  <div class='pull-left m-r-10'>
                                    <select class='btn btn-white'>
                                      <option>2015年</option>
                                    </select>
                                  </div>
                                  <div>
                                    <select class='btn btn-white'>
                                      <option>4月</option>
                                    </select>
                                  </div>
                                  <div class='clearfix'></div>
                                </div>
                              </div>                                                  
                            </form>
                          </div>  
                        </div>

                        <div class='ibox no-margin-bottom'>
                          <div class="ibox-title">
                            <h5>学歴</h5>
                            <div class="ibox-tools">
                              <a class="close-link">
                                <i class="fa fa-times"></i>
                              </a>
                            </div>
                          </div>
                          <div class="ibox-content bg-white p-sm pd-bottom-none pd-right-none">
                            <form method="get" class="form-horizontal">
                              <div class="form-group"><label class="col-sm-4 control-label">学校</label>
                                <div class="col-sm-8">
                                  <div class="no-borders ver-mid btn-group pull-left m-r-10">
                                    <select class="form-control">
                                      <option>国立AA大学</option>
                                      <option>国立AA大学</option>
                                      <option>国立AA大学</option>
                                      <option>国立AA大学</option>
                                    </select>
                                  </div>
                                  <button class='pull-left btn btn-primary m-r-10'>マスタ項目追加</button>
                                  <button class='btn btn-primary'>マスタ項目変更</button>
                                  <div class='clearfix'></div>
                                </div>
                              </div>    
                              <div class="form-group"><label class="col-sm-4 control-label">学部</label>
                                <div class="col-sm-4">
                                  <div class="no-borders ver-mid btn-group btn-block">
                                    <select class="form-control">
                                      <option selected="selected">経済学部</option>
                                      <option>経済学部</option>
                                      <option>経済学部</option>
                                      <option>経済学部</option>
                                    </select>
                                  </div>
                                </div>
                              </div>    
                              <div class="form-group">
                                <label class="col-sm-4 control-label">学科名</label>
                                <div class="col-sm-8"><input type="text" class="form-control" value="経営学科"></div>
                              </div>  
                              <div class="form-group">
                                <label class="col-sm-4 control-label">学生申請文理区分</label>
                                <div class="col-sm-4">
                                  <div class="no-borders ver-mid btn-group btn-block">
                                    <select class="form-control">
                                      <option selected="selected">文系</option>
                                      <option>文系</option>
                                      <option>文系</option>
                                      <option>文系</option>
                                    </select>
                                  </div>
                                </div>
                              </div>    
                              <div class="form-group">
                                <label class="col-sm-4 control-label">管理用文理区分</label>
                                <div class="col-sm-4">
                                  <div class="no-borders ver-mid btn-group btn-block">
                                    <select class="form-control">
                                      <option selected="selected">文系</option>
                                      <option>文系</option>
                                      <option>文系</option>
                                      <option>文系</option>
                                    </select>
                                  </div>
                                </div>
                              </div>  
                              <div class="form-group"><label class="col-sm-4 control-label">ゼミ</label>
                                <div class="col-sm-8"><input type="text" class="form-control" value="現代経済"></div>
                              </div>  
                              <div class="form-group"><label class="col-sm-4 control-label">専攻テーマ</label>
                                <div class="col-sm-8"><input type="text" class="form-control" value="現代経済"></div>
                              </div>  
                              <div class="form-group"><label class="col-sm-4 control-label">サークル</label>
                                <div class="col-sm-8"><input type="text" class="form-control" value="旅と鉄道研究会"></div>
                              </div>    
                              <div class="form-group data_1" id=""><label class="col-sm-4 control-label">入学年月</label>
                                <div class="col-sm-4">
                                  <div class="input-group date">
                                    <span class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" class="form-control" value="2012/04">
                                  </div>
                                </div>
                              </div>  

                              <div class="form-group data_1" id=""><label class="col-sm-4 control-label">卒業(予定)年月</label>
                                <div class="col-sm-4">
                                  <div class="input-group date">
                                    <span class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" class="form-control" value="2016/03">
                                  </div>
                                </div>
                              </div> 
                            </form>
                          </div>  
                        </div>
                      </div>
                      <div class="row ibox-content clearfix bg-sl-btn pd-9">
                        <table class="table no-margin-bottom">
                          <tbody class='pull-right'>
                            <tr>
                              <td class="no-borders ver-mid btn-group btn-block">
                                <select class="form-control">
                                  <option selected="selected">訪問先情報</option>
                                  <option>訪問先情報</option>
                                  <option>訪問先情報</option>
                                  <option>訪問先情報</option>
                                </select>
                              </td>   
                              <td class="no-borders ver-mid">
                                <button class="w-75 btn btn-primary btn-sm">追加</button>
                              </td>
                              <div class='clearfix'></div>
                            </tr>
                          </tbody>
                        </table>
                      </div>                                            
                      <div class='button_cen element-detail-box '>
                        <button class='w-75 btn btn-default btn-sm'>削除</button>
                        <button class='w-75 btn btn-primary btn-sm'>更新</button>
                      </div>
                    </div>
                    <!-- tab container 1 -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end content -->
      <br>
      <br>              
      <div class='clearfix'></div>
      <div class="footer">
        <div>
          <strong>Copyright</strong>© enjin
        </div>
      </div>
    </body>
    </html>


    <script>
    document.getElementById("uploadfile").onchange = function () {
      var filename = this.value;
      var lastIndex = filename.lastIndexOf("\\");
      if (lastIndex >= 0) {
        filename = filename.substring(lastIndex + 1);
      }
      document.getElementById("filename").value = filename;
    };

    function sllanguage() {
      var x = document.getElementById("sl-language").value;
      if (x == 'その他') {
        $(".sl-language-hiden").removeClass("fr-hiden");
      } else {
        $(".sl-language-hiden").addClass("fr-hiden");
      }
    };

    function slpro() {
      var x = document.getElementById("sl-pro").value;
      if (x == 'その他') {
        $(".sl-pro-hiden").removeClass("fr-hiden");
      } else {
        $(".sl-pro-hiden").addClass("fr-hiden");
      }
    };
    </script>