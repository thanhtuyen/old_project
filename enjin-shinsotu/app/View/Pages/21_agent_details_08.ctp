<!DOCTYPE html>
<html>

<head>
  <?php echo $this->Html->charset('utf-8'); ?> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>流入元企業詳細</title>

  <?php echo $this->Html->css('bootstrap/animate.css'); ?>
  <?php echo $this->Html->css('bootstrap/bootstrap.min'); ?>
  <?php echo $this->Html->css('font-awesome/css/font-awesome'); ?>
  <?php echo $this->Html->css('plugins/iCheck/custom'); ?>
  <?php echo $this->Html->css('bootstrap/style'); ?>
  <?php echo $this->Html->css('enjin/global'); ?>
  <?php echo $this->Html->css('enjin/email'); ?>
  <?php echo $this->Html->css('plugins/datapicker/datepicker3.css'); ?>
  <?php echo $this->Html->css('plugins/daterangepicker/daterangepicker-bs3.css'); ?>

  <!-- script -->
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
  <!-- Data picker -->
  <?php echo $this->Html->script('plugins/datapicker/bootstrap-datepicker.js'); ?>
  <?php echo $this->Html->script('kiwi.js'); ?>
  <!-- end script -->


</head>

<body class='page21'>

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

                <!-- title -->
                <div class="row wrapper border-bottom white-bg page-heading">
                  <div class="col-lg-10">
                    <h2><button class="btn btn-sm btn-white">
                      &lt; 戻る
                    </button>   
                    流入元企業詳細｜ 123456 エンジン</h2>
                  </div>
                </div>
                <!-- end title -->

                <!-- content -->
                <div class="wrapper wrapper-content row animated fadeInRight clearfix">
                  <!-- content -->   
                  <div class='full-content'>

                    <!-- left col 8 -->
                    <div class='col-lg-8'>
                      <div class='ibox'>
                        <div class="ibox-title">
                          <h5>流入元企業情報</h5>
                          <div class="ibox-tools">
                            <button type='button' class='btn btn-primary btn-xs'>編集</button>                                
                          </div>
                        </div>
                        <div class='ibox-content bg-white'>
                          <table class="table no-border-th-td no-margin-bottom no-borders">
                            <tbody>
                              <tr>
                                <th class="text-right w-30per">企業名</th>
                                <td class="right-table-td">エンジン</td>
                              </tr>   
                              <tr>
                                <th class="text-right">流入元企業ID</th>
                                <td class="right-table-td">123456</td>
                              </tr> 
                              <tr>
                                <th class="text-right">流入元タイプ</th>
                                <td class="right-table-td">ナビ</td>
                              </tr> 
                              <tr>
                                <th class="text-right">都道府県</th>
                                <td class="right-table-td">東京都</td>
                              </tr> 
                              <tr>
                                <th class="text-right">市区町村</th>
                                <td class="right-table-td">新宿区</td>
                              </tr> 
                              <tr>
                                <th class="text-right">契約</th>
                                <td class="right-table-td">あり</td>
                              </tr> 
                              <tr>
                                <th class="text-right">最終更新担当者</th>
                                <td class="right-table-td"><a class='text-navy' href="">宮崎 範浩</a></td>
                              </tr>                 
                            </tbody>
                          </table>                    
                        </div>
                      </div>
                      <div class='ibox no-margin-bottom'>
                        <div class="ibox-title">
                          <h5>この企業から流入している候補者一覧</h5>                          
                          <div class="ibox-tools">
                            <a class="collapse-link">
                              <i class="fa fa-chevron-up"></i>
                            </a>                                                           
                          </div>
                        </div>
                        <div class='ibox-content pd-none  bg-gray'>
                          <div class=''>
                            <div class=' bg-gray p-sm'>
                              <form method="get" class="form-horizontal">
                                <div class='pull-left btn-group display-inl'>
                                  <label class='lb-inl'>求人票</label>                                
                                  <select class='btn'>
                                    <option>2016年度新卒・営業</option>
                                    <option>2017年度新卒・営業</option>
                                  </select>
                                </div>
                                <div class='pull-left btn-group display-inl'>
                                  <label class='lb-inl'>選考段階</label>

                                  <select class='btn'>
                                    <option>書類審査</option>
                                    <option>書類審査2</option>
                                  </select>
                                </div>
                                <div class='clearfix'></div>
                                <div class="margin-pag">           
                                  <button type='submit' class='btn btn-primary btn-sm'>検索</button>
                                  <button type='button' class='btn btn-primary btn-sm'>クリア</button>
                                  <div class="clear"></div>
                                </div>
                              </form>
                            </div>
                          </div>

                        </div>
                      </div>
                      <div class="ibox-content p-sm bg-white">
                        <div class="">
                          <div class="text-right four-action">
                            <div class="pull-left">
                              <div class='pull-left btn-group display-inl'>

                               <select class='btn btn-white btn-sm  btn-block'>
                                <option>チェックのみ</option>
                                <option>チェックのみ2</option>
                              </select>
                            </div>
                            <button class="btn btn-primary btn-sm">メール</button>
                            <button class="btn btn-primary btn-sm">印刷</button>
                          </div>                           
                          <div>
                            <span class="sp-text-pg">10件中10件表示</span>
                            <div class="bottom_pagination1 pull-right">
                              <ul class="pagination pag-pd">
                                <li class="paginate_button previous disabled" aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_previous"><a href="#">Prev</a>
                                </li>
                                <li class="paginate_button active" aria-controls="DataTables_Table_0" tabindex="0"><a href="#">1</a></li>
                                <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0"><a href="#">2</a></li>
                                <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0"><a href="#">3</a></li>
                                <li class="paginate_button next" aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_next"><a href="#">Next</a></li>
                              </ul>
                            </div>
                          </div>
                          <div class="clear"></div>
                        </div>
                        <div class="table-responsive enj_res">
                          <table class="table table-center white-tb-th table-striped table-bordered">
                            <thead>
                              <tr class="">
                                <th class='t-align-left'>
                                  <input type="checkbox" class="i-checks" name="input[]">
                                </th>
                                <th class="th-cl-">名前</th>
                                <th class="th-cl-">求人票</th>
                                <th class="th-cl-">選考段階</th>
                                <th class="th-cl-">流入元契約</th>
                                <th class="th-cl-">操作</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <input type="checkbox" class="i-checks" name="input[]">
                                </td>
                                <td><a href="">田中 太朗</a></td>
                                <td><a href="">2016年度新卒・営業</a></td>
                                <td>書類審査</td>
                                <td>エンジン固定契約</td>
                                <td>
                                  <a href="" type="button" class="cl-white btn btn-primary btn-xs">詳細</a>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <input type="checkbox" class="i-checks" name="input[]">
                                </td>
                                <td><a href="">田中 太朗</a></td>
                                <td><a href="">2016年度新卒・営業</a></td>
                                <td>書類審査</td>
                                <td>エンジン固定契約</td>
                                <td>
                                   <a href="" type="button" class="cl-white btn btn-primary btn-xs">詳細</a>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <input type="checkbox" class="i-checks" name="input[]">
                                </td>
                                <td><a href="">田中 太朗</a></td>
                                <td><a href="">2016年度新卒・営業</a></td>
                                <td>書類審査</td>
                                <td>エンジン固定契約</td>
                                <td>
                                   <a href="" type="button" class="cl-white btn btn-primary btn-xs">詳細</a>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <input type="checkbox" class="i-checks" name="input[]">
                                </td>
                                <td><a href="">田中 太朗</a></td>
                                <td><a href="">2016年度新卒・営業</a></td>
                                <td>書類審査</td>
                                <td>エンジン固定契約</td>
                                <td>
                                   <a href="" type="button" class="cl-white btn btn-primary btn-xs">詳細</a>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <div class="text-right four-action">
                          <div class="pull-left">
                            <div class='pull-left btn-group display-inl'>                            
                              <select class='btn btn-white btn-sm  btn-block'>
                                <option>チェックのみ</option>
                                <option>チェックのみ2</option>
                              </select>
                            </div>
                            <button class="btn btn-primary btn-sm">メール</button>
                            <button class="btn btn-primary btn-sm">印刷</button>
                          </div>                           
                          <div>
                            <span class="sp-text-pg">10件中10件表示</span>
                            <div class="bottom_pagination1 pull-right">
                              <ul class="pagination pag-pd">
                                <li class="paginate_button previous disabled" aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_previous"><a href="#">Prev</a>
                                </li>
                                <li class="paginate_button active" aria-controls="DataTables_Table_0" tabindex="0"><a href="#">1</a></li>
                                <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0"><a href="#">2</a></li>
                                <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0"><a href="#">3</a></li>
                                <li class="paginate_button next" aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_next"><a href="#">Next</a></li>
                              </ul>
                            </div>
                          </div>
                          <div class="clear"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- end left col 8 -->

                  <!-- right col 4 -->
                  <div class="col-lg-4">
                    <div class="ibox">
                      <div class="ibox-title">
                        <h5>公開求人票一覧</h5>
                        <div class="ibox-tools">                                                                         
                        </div>
                      </div>
                      <div class="ibox-content clearfix">
                        <div class="">
                          <div class="table-border">
                            <table class="table table-bordered no-margin-bottom">
                              <thead>
                                <tr>
                                  <th>求人票</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td><a class='text-navy' href="">2016年度新卒・営業</a></td>
                                </tr>      
                                <tr>
                                  <td><a class='text-navy' href="">2016年度新卒・開発</a></td>
                                </tr>                                                 
                              </tbody>
                            </table>    
                          </div>
                        </div>  
                      </div>                      
                    </div>



                    <!-- 流入元契約一覧 -->
                    <div class="ibox ">
                      <div class="ibox-title">
                        <h5>流入元担当者一覧</h5>
                        <div class="ibox-tools">
                          <a type="button" class="btn btn-primary btn-xs">新規追加</a>                                
                        </div>
                      </div>
                      <div class="ibox-content clearfix p-sm pd-bottom-none">
                        <div class="ibox-title pd-none-left">
                          <h5><a class="text-navy" href="">一ノ瀬 裕太郎</a></h5>
                        </div>

                        <div class="ibox-content bg-white p-sm">
                          <form method="get" class="form-horizontal form-text-left">
                            <div class="form-group"><label class="col-sm-5 control-label">メールアドレス</label>
                              <div class="col-sm-7">
                                <div class="form-control border-none">chinose@enjin.biz</div>
                              </div>
                            </div>        
                            <div class="form-group"><label class="col-sm-5 control-label">電話番号</label>
                              <div class="col-sm-7">
                                <div class="form-control border-none">090xxxxxxxxx</div>
                              </div>
                            </div>    
                            <div class="form-group"><label class="col-sm-5 control-label">ステータス</label>
                              <div class="col-sm-7">
                                <div class="form-control border-none">ステータス表示</div>
                              </div>
                            </div>   
                          </form>
                        </div>



                        <div class="ibox-title pd-none-left">
                          <h5><a class="text-navy" href="">東海林 美奈</a></h5>
                        </div>

                        <div class="ibox-content bg-white p-sm">
                          <form method="get" class="form-horizontal form-text-left">
                            <div class="form-group"><label class="col-sm-5 control-label">メールアドレス</label>
                              <div class="col-sm-7">
                                <div class="form-control border-none">chinose@enjin.biz</div>
                              </div>
                            </div>        
                            <div class="form-group"><label class="col-sm-5 control-label">電話番号</label>
                              <div class="col-sm-7">
                                <div class="form-control border-none">090xxxxxxxxx</div>
                              </div>
                            </div>    
                            <div class="form-group"><label class="col-sm-5 control-label">ステータス</label>
                              <div class="col-sm-7">
                                <div class="form-control border-none">ステータス表示</div>
                              </div>
                            </div>   
                          </form>
                        </div>


                      </div>                  
                    </div>
                    <!-- end 流入元契約一覧 -->


                    <!-- 流入元担当者一覧 -->
                    <div class="ibox ">
                      <div class="ibox-title">
                        <h5>新規追加</h5>
                        <div class="ibox-tools">
                          <a type="button" class="btn btn-primary btn-xs">新規追加</a>                                
                        </div>
                      </div>
                      <div class="ibox-content clearfix p-sm pd-bottom-none">
                        <div class="ibox-title pd-none-left">
                          <h5><a class="text-navy" href="">エンジン固定契約</a></h5>
                        </div>
                        <div class="ibox-content bg-white p-sm">
                          <form method="get" class="form-horizontal form-text-left">
                            <div class="form-group"><label class="col-sm-5 control-label">契約開始日</label>
                              <div class="col-sm-7">
                                <div class="form-control border-none">2015/04/01</div>
                              </div>
                            </div>        
                            <div class="form-group"><label class="col-sm-5 control-label">契約終了日</label>
                              <div class="col-sm-7">
                                <div class="form-control border-none">2016/03/31</div>
                              </div>
                            </div>    
                            <div class="form-group"><label class="col-sm-5 control-label">契約タイプ</label>
                              <div class="col-sm-7">
                                <div class="form-control border-none">固定</div>
                              </div>
                            </div>    
                            <div class="form-group"><label class="col-sm-5 control-label">採用Fee</label>
                              <div class="col-sm-7">
                                <div class="form-control border-none">100,000円／人</div>
                              </div>
                            </div>    
                            <div class="form-group"><label class="col-sm-5 control-label">契約済求人票</label>
                              <div class="col-sm-7">
                                <div class="form-control border-none"><a class='text-navy' href="">2016年度新卒・営業</a></div>
                              </div>
                            </div>  
                          </form>
                        </div>
                        <div class="ibox-title pd-none-left">
                          <h5><a class="text-navy" href="">エンジン固定契約</a></h5>
                        </div>
                        <div class="ibox-content bg-white p-sm">
                          <form method="get" class="form-horizontal form-text-left">

                            <div class="form-group"><label class="col-sm-5 control-label">タイトル</label>
                              <div class="col-sm-7">
                                <div class="form-control border-none">エンジン固定契約</div>
                              </div>
                            </div>
                            <div class="form-group"><label class="col-sm-5 control-label">契約開始日</label>
                              <div class="col-sm-7">
                                <div class="form-control border-none">2015/04/01</div>
                              </div>
                            </div>        
                            <div class="form-group"><label class="col-sm-5 control-label">契約終了日</label>
                              <div class="col-sm-7">
                                <div class="form-control border-none">2016/03/31</div>
                              </div>
                            </div>    
                            <div class="form-group"><label class="col-sm-5 control-label">契約タイプ</label>
                              <div class="col-sm-7">
                                <div class="form-control border-none">固定</div>
                              </div>
                            </div>    
                            <div class="form-group"><label class="col-sm-5 control-label">採用Fee</label>
                              <div class="col-sm-7">
                                <div class="form-control border-none">100,000円／人</div>
                              </div>
                            </div>    
                            <div class="form-group"><label class="col-sm-5 control-label">契約済求人票</label>
                              <div class="col-sm-7">
                                <div class="form-control border-none"><a class='text-navy' href="">2016年度新卒・営業</a></div>
                              </div>
                            </div>                   

                          </form>
                        </div>
                      </div>                   
                    </div>
                    <!-- end 流入元担当者一覧 -->
                  </div>
                  <!-- end right col-4 -->

                  <!-- footer -->
                  <div class="footer">
                    <div>
                      <strong>Copyright</strong>© enjin
                    </div>
                  </div>
                  <!-- end footer -->

                </div>
              </div>
              <!-- content -->

            </body>

            </html>
