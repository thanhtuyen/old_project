<!DOCTYPE html>
<html>
<head>
  <?php echo $this->Html->charset('utf-8'); ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>求人票管理 − 求人詳細</title>

  <!-- css -->
  <?php echo $this->Html->css('bootstrap/animate'); ?>
  <?php echo $this->Html->css('bootstrap/bootstrap.min'); ?>
  <?php echo $this->Html->css('font-awesome/css/font-awesome'); ?>
  <?php echo $this->Html->css('plugins/iCheck/custom'); ?>
  <?php echo $this->Html->css('bootstrap/style'); ?>
  <?php echo $this->Html->css('enjin/email'); ?>
  <?php echo $this->Html->css('enjin/global'); ?>
  <?php echo $this->Html->css('plugins/datapicker/datepicker3.css'); ?>
  <?php echo $this->Html->css('plugins/daterangepicker/daterangepicker-bs3.css'); ?>
  <!-- css -->

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
  <!-- Data picker -->
  <?php echo $this->Html->script('plugins/datapicker/bootstrap-datepicker.js'); ?>
  <!-- Peity -->
  <?php echo $this->Html->script('plugins/peity/jquery.peity.min.js'); ?>
  <?php echo $this->Html->script('kiwi.js'); ?>
  <!-- end script -->


</head>

<body class='morejob'>

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
              <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">ダッシュボード</span> <span
                class="fa arrow"></span></a>
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
                  class="fa arrow"></span></a>
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
                    class="fa arrow"></span></a>
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
                      class="fa arrow"></span></a>
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
                          <!---------------------------cotent title------------------------------>
                          <div class="row wrapper border-bottom white-bg page-heading">
                            <div class="col-lg-10">
                              <h2>
                                <button class="btn btn-sm btn-white">
                                  &lt; 戻る
                                </button>
                                求人票詳細｜ ID123456 2016年度新卒・営業募集
                              </h2>
                            </div>
                          </div>
                          <!---------------------------end cotent title------------------------------>

                          <!---------------------------content------------------------------>
                          <div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">
                            <div class='full-content'>

                              <!-- left view data -->
                              <div class='col-lg-8'>
                                <div class='ibox'>
                                  <div class="ibox-title">
                                    <h5>求人票詳細</h5>
                                    <div class="ibox-tools hover-button">
                                      <a href="" type="button" class="cl-white btn btn-primary btn-xs">編集</a>
                                    </div>
                                  </div>
                                  <div class='ibox-content bg-white p-sm'>
                                    <form method="get" class="form-horizontal">
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label">タイトル</label>

                                        <div class="col-sm-8">
                                          <div class="form-control border-none">2016年度新卒・営業募集</div>
                                        </div>
                                      </div>

                                      <!-- textarea -->
                                      <div class="form-group"><label class="col-sm-4 control-label">募集要項</label>

                                        <div class="col-sm-8">
                                          <div class="form-control border-none mul-text">【職種/仕事内容】
                                            ＜仕事の一日の流れ＞
                                            8:15～ 社員全員で朝礼
                                            9:00～ エリア担当ごとで情報交換､共有
                                            9:30～ 営業先へ一日10件程度訪問
                                            17:30～18:00 帰社OR直帰（お客様先による）
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group"><label class="col-sm-4 control-label">職種タイプ</label>

                                        <div class="col-sm-8">
                                          <div class="form-control border-none">営業</div>
                                        </div>
                                      </div>

                                      <!-- textarea -->
                                      <div class="form-group"><label class="col-sm-4 control-label">待遇</label>

                                        <div class="col-sm-8">
                                          <div class="form-control border-none mul-text">【勤務時間】
                                            8:15～17:00
                                            【給与】
                                            月給21万円以上
                                            【休日休暇】
                                            GW､年末年始･年一回創立記念
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group"><label class="col-sm-4 control-label">応募資格</label>

                                        <div class="col-sm-8">
                                          <div class="form-control border-none">2016年度4月に新卒の資格を持っているもの</div>
                                        </div>
                                      </div>

                                      <div class="form-group"><label class="col-sm-4 control-label">募集人数</label>

                                        <div class="col-sm-8">
                                          <div class="form-control border-none">2人</div>
                                        </div>
                                      </div>
                                      <div class="form-group"><label class="col-sm-4 control-label">応募期限</label>

                                        <div class="col-sm-8">
                                          <div class="form-control border-none">2015年9月30日</div>
                                        </div>
                                      </div>
                                      <div class="form-group"><label class="col-sm-4 control-label">公開開始日時</label>

                                        <div class="col-sm-8">
                                          <div class="form-control border-none">2015年6月15日</div>
                                        </div>
                                      </div>
                                      <div class="form-group"><label class="col-sm-4 control-label">募集エリアID</label>

                                        <div class="col-sm-8">
                                          <div class="form-control border-none">港区</div>
                                        </div>
                                      </div>
                                      <div class="form-group"><label class="col-sm-4 control-label">募集年度</label>

                                        <div class="col-sm-8">
                                          <div class="form-control border-none">2016年</div>
                                        </div>
                                      </div>

                                      <div class="form-group"><label class="col-sm-4 control-label">リリククナナビビID</label>

                                        <div class="col-sm-8">
                                          <div class="form-control border-none">-</div>
                                        </div>
                                      </div>

                                      <div class="form-group"><label class="col-sm-4 control-label">ママイイナナビビID </label>

                                        <div class="col-sm-8">
                                          <div class="form-control border-none">-</div>
                                        </div>
                                      </div>
                                      
                                      

                                      <div class="form-group"><label class="col-sm-4 control-label">リクナビID</label>

                                        <div class="col-sm-8">
                                          <div class="form-control border-none">マイナビID</div>
                                        </div>
                                      </div>
                                      <div class="form-group"><label class="col-sm-4 control-label">最終更新担当者</label>

                                        <div class="col-sm-8">
                                          <div class="form-control border-none"><a class='text-navy' href="">宮崎 範浩</a>
                                          </div>
                                        </div>
                                      </div>
                                    </form>
                                  </div>
                                </div>

                                <div class='ibox'>

                                  <div class="ibox-title">
                                    <h5>求人選考段階目標</h5>

                                    <div class="ibox-tools">
                                      <button id='p17-show-fr-edit' type="button" class="btn btn-primary btn-xs">編集</button>
                                    </div>
                                  </div>
                                  <div class='ibox-content bg-white p-sm'>
                                    <table class="table table-bordered no-margin-bottom show-data hiden-return">
                                      <thead>
                                        <tr class=''>
                                          <th class=''>段階</th>
                                          <th class=''>目標値</th>
                                          <th class=''>達成期限年月日</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td class="table-button-tdleft">3次選考以下</td>
                                          <td class="table-button-tdleft">50</td>
                                          <td class="table-button-tdleft">2015年10月31日</td>
                                        </tr>
                                        <tr>
                                          <td class="table-button-tdleft">4次選考以上</td>
                                          <td class="table-button-tdleft">20</td>
                                          <td class="table-button-tdleft">2015年11月31日</td>
                                        </tr>
                                        <tr>
                                          <td class="table-button-tdleft">最終選考</td>
                                          <td class="table-button-tdleft">2</td>
                                          <td class="table-button-tdleft">2015年12月31日</td>
                                        </tr>
                                      </tbody>
                                    </table>
                                    <table class="table table-bordered no-margin-bottom table-center show-return fr-hiden">
                                      <thead>
                                        <tr>
                                          <th>選考段階</th>
                                          <th>選考段階判定タイプ</th>
                                          <th class='w-15per'>目標値</th>
                                          <th class='w-30per'>達成期限年月日</th>
                                          <th class='w-16per'></th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td class='td-data-pick1'>
                                            <select class='form-control'>  
                                              <option>3次選考</option>
                                            </select>
                                          </td>
                                          <td class='td-data-pick1'>
                                            <select  class='form-control'>
                                              <option>以下</option>
                                              <option>option 2</option>
                                            </select>
                                          </td>
                                          <td class='td-data-pick1'>
                                            <input class='form-control' type='number' value='50' />
                                          </td>
                                          <td class='td-data-pick4'>
                                            <div class="data_1" >
                                              <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" placeholder='2015年11月31日'>
                                              </div>
                                            </div>
                                          </td>
                                          <td class='ver-mid'>
                                            <div>
                                              <button  class='btn pull-left btn-xs w-40 btn-primary'/>更新</button>
                                              <button  class='btn pull-right btn-xs w-40 btn-primary'>削除</button>
                                              <div class='clear'></div>
                                            </div>
                                          </td>
                                        </tr>  
                                        <tr>
                                          <td class='td-data-pick1'>
                                            <select class='form-control'>  
                                              <option>4次選考</option>
                                            </select>
                                          </td>
                                          <td class='td-data-pick1'>
                                            <select  class='form-control'>
                                              <option>以下</option>
                                              <option>option 2</option>
                                            </select>
                                          </td>
                                          <td class='td-data-pick1'>
                                            <input class='form-control' type='number' value='50' />
                                          </td>
                                          <td class='td-data-pick4'>
                                            <div class="data_1" id="">
                                              <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" placeholder='2015年11月31日'>
                                              </div>
                                            </div>
                                          </td>


                                          <td class='ver-mid'>
                                            <div>
                                              <button  class='btn pull-left btn-xs w-40 btn-primary'/>更新</button>
                                              <button  class='btn pull-right btn-xs w-40 btn-primary'>削除</button>
                                              <div class='clear'></div>
                                            </div>
                                          </td>
                                        </tr>  
                                        <tr>
                                          <td class='td-data-pick1'>
                                            <select class='form-control'>  
                                              <option>5次選考</option>
                                            </select>
                                          </td>
                                          <td class='td-data-pick1'>
                                            <select  class='form-control'>
                                              <option>以下</option>
                                              <option>option 2</option>
                                            </select>
                                          </td>
                                          <td class='td-data-pick1'>
                                            <input class='form-control' type='number' value='50' />
                                          </td>
                                          <td class='td-data-pick4'>
                                            <div class="data_1" id="">
                                              <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" placeholder='2015年11月31日'>
                                              </div>
                                            </div>
                                          </td>


                                          <td class='ver-mid'>
                                            <div>
                                              <button  class='btn pull-left btn-xs w-40 btn-primary'/>更新</button>
                                              <button  class='btn pull-right btn-xs w-40 btn-primary'>削除</button>
                                              <div class='clear'></div>
                                            </div>
                                          </td>
                                        </tr>  
                                        <tr>
                                          <td class='td-data-pick1'>
                                            <select class='form-control'>  
                                              <option>選考段階選択</option>
                                            </select>
                                          </td>
                                          <td class='td-data-pick1'>
                                            <select  class='form-control'>
                                              <option>以下</option>
                                              <option>option 2</option>
                                            </select>
                                          </td>
                                          <td class='td-data-pick1'>
                                            <input class='form-control' type='number' value='50' />
                                          </td>
                                          <td class='td-data-pick4'>
                                            <div class="data_1" id="">
                                              <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" placeholder='YYYY / MM / DD'>
                                              </div>
                                            </div>
                                          </td>


                                          <td class='ver-mid hover-button'>
                                            <span>
                                              <a type="button" class='btn pull-left btn-xs w-40 btn-primary m-l-md cl-white'/>更新</a>
                                              <div class='clear'></div>
                                            </span>
                                          </td>
                                        </tr>  
                                      </tbody>
                                    </table>
                                    <div class="row show-return fr-hiden"> 
                                      <div class="text-center m-t">
                                        <a class="text-navy m-r-lg" href="#">キ ャンセル</a>
                                        <a type="button" class="btn btn-sm btn-primary w-95" id='p17-return-edit' type="submit">更新</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- end left view data  -->

                              <!-- right data select -->
                              <div class="col-lg-4">
                                <div class="ibox">
                                  <div class="ibox-title">
                                    <h5>求人担当者登録</h5>
                                  </div>
                                  <div class="ibox-content clearfix p-sm">
                                    <div class=''>
                                      <div class="table-border">
                                        <table class="table table-bordered no-margin-bottom">
                                          <thead>
                                            <tr>
                                              <th>求人担当者名</th>
                                              <th>操作</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td><a class='text-navy' href="">宮崎 範浩</a></td>
                                              <td class="table-button-tdright">
                                                <button class="full-width btn btn-default btn-xs">削除</button>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td><a class='text-navy' href="">高橋 紗季</a></td>
                                              <td class="table-button-tdright">
                                                <button class="full-width btn btn-default btn-xs">削除</button>
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>

                                  </div>
                                  <div class='ibox-content clearfix bg-sl-btn pd-9'>
                                    <table class='table no-margin-bottom'>
                                      <tbody>

                                        <tr>
                                          <td class='no-borders ver-mid btn-group btn-block'>
                                            <select class="btn btn-sm full-width">
                                              <option>採用担当者選択</option>
                                              <option>2採用担当者選択</option>
                                              <option>4採用担当者選択</option>
                                            </select>
                                          </td>
                                          <td class='no-borders ver-mid hover-button'>
                                            <a href="" type="button" class="cl-white btn btn-primary btn-sm full-width">追加</a>
                                          </td>
                                        </tr>

                                      </tbody>
                                    </table>
                                  </div>
                                </div>

                                <div class="ibox ">
                                  <div class="ibox-title">
                                    <h5>イベント登録</h5>



                                    <div class="ibox-tools hover-button">
                                      <a type="button" class="cl-white btn btn-primary btn-xs">新規追加</a>
                                    </div>

                                  </div>
                                  <div class="ibox-content clearfix p-sm">

                                    <div class=''>
                                      <div class="table-border">
                                        <table class="table table-bordered no-margin-bottom">
                                          <thead>
                                            <tr>
                                              <th>登録イベント名</th>
                                              <th>操作</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td><a class='text-navy' href="">宮崎 範浩</a></td>
                                              <td class="table-button-tdright">
                                                <button class="full-width btn btn-default btn-xs">削除</button>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td><a class='text-navy' href="">高橋 紗季</a></td>
                                              <td class="table-button-tdright">
                                                <button class="full-width btn btn-default btn-xs">削除</button>
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>

                                  </div>
                                  <div class='ibox-content clearfix bg-sl-btn pd-9'>
                                    <table class='table no-margin-bottom'>
                                      <tbody>
                                        <tr>
                                          <td class='no-borders ver-mid btn-group btn-block'>

                                            <select class="btn btn-sm">
                                              <option>採用担当者選択</option>
                                              <option>2採用担当者選択</option>
                                              <option>4採用担当者選択</option>
                                            </select>

                                          </td>

                                          <td class='no-borders ver-mid hover-button'>
                                            <a type="button" class="cl-white btn btn-primary btn-sm">日程追加</a>
                                          </td>
                                          <td class='no-borders ver-mid hover-button'>
                                            <a type="button" class="cl-white btn btn-primary btn-sm">追加</a>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>

                                <div class="ibox ">
                                  <div class="ibox-title">
                                    <h5>求人票公開先流入元企業</h5>
                                    <div class="ibox-tools">
                                      <button type="button" class="btn btn-primary btn-xs">新規追加</button>
                                    </div>
                                  </div>
                                  <div class="ibox-content clearfix p-sm">
                                    <div class=''>
                                      <div class="table-border">
                                        <table class="table table-bordered no-margin-bottom">
                                          <thead>
                                            <tr>
                                              <th>求人票公開先流入元企業名</th>
                                              <th>状況</th>
                                              <th>操作</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td>マイナビ</td>
                                              <td>公開中</td>
                                              <td></td>
                                            </tr>
                                            <tr>
                                              <td>リクナビ</td>
                                              <td>公開中</td>
                                              <td></td>
                                            </tr>
                                            <tr>

                                              <td class='no-borders ver-mid btn-group btn-block'>
                                               <select class="btn btn-white btn-sm h-30 btn-block">
                                                <option>流入元企業選択</option>
                                                <option>流入元企業選択2</option>
                                                <option>流入元企業選択3</option>
                                              </select>
                                            </td>
                                            <td class='w-95'>
                                             <select class="btn btn-white btn-sm  btn-block">
                                              <option>状況選択</option>
                                              <option>状況選択2</option>
                                              <option>状況選択3</option>
                                            </select>
                                          </td>
                                          <td class="ver-mid">
                                            <button class="full-width btn btn-primary btn-xs">更新</button>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>

                              </div>


                            </div>
                          </div>
                          <!-- end right data select -->

                        </div>
                        <!---------------------------end cotent------------------------------>
                      </div>
                      <!-- end content  -->
                      
                      <div class='clearfix'></div>
                      <!-- footer -->
                      <div class="row wrapper border-bottom white-bg page-footer clearfix">
                        <div class="col-lg-10">
                          <h2>
                            <button class="btn btn-sm btn-white">
                              &lt; 戻る
                            </button>
                          </h2>
                        </div>
                      </div>

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
