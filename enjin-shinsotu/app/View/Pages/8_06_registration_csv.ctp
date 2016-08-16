<!DOCTYPE html>
<html>

<head>
  <?php echo $this->Html->charset('utf-8'); ?> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>候補者管理 − 候補者登録</title>

  <!-- css -->
  <?php echo $this->Html->css('bootstrap/animate'); ?>
  <?php echo $this->Html->css('bootstrap/bootstrap.min'); ?>
  <?php echo $this->Html->css('font-awesome/css/font-awesome'); ?>
  <?php echo $this->Html->css('plugins/iCheck/custom'); ?>
  <?php echo $this->Html->css('bootstrap/style'); ?>
  <?php echo $this->Html->css('plugins/datapicker/datepicker3'); ?>
  <?php echo $this->Html->css('plugins/daterangepicker/daterangepicker-bs3'); ?>
  <?php echo $this->Html->css('enjin/global'); ?>
  <?php echo $this->Html->css('enjin/email'); ?>

  <!-- end css -->

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
  <?php echo $this->Html->script('kiwi.js'); ?>
  <!-- Data picker -->
  <?php echo $this->Html->script('plugins/datapicker/bootstrap-datepicker.js'); ?>
  <!-- iCheck -->
  <?php echo $this->Html->script('plugins/iCheck/icheck.min.js'); ?>
  <!-- Date range use moment.js same as full calendar plugin -->
  <?php echo $this->Html->script('plugins/fullcalendar/moment.min.js'); ?>
  <!-- Date range picker -->
  <?php echo $this->Html->script('plugins/daterangepicker/daterangepicker.js'); ?>
  <?php echo $this->Html->script('kiwi.js'); ?>

  <!-- end script -->

</head>

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

                    <!-- </div> -->
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

                  <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-10">
                      <h2><button class="btn btn-sm btn-white">
                        &lt; 戻る
                      </button>   
                      イベント参加者CSV登録</h2>
                    </div>
                  </div>

                  <!-- content -->   
                  <div class="wrapper wrapper-content animated fadeInRight title-button pd-bottom-none">
                    <div class='wrapper-content-large-border white-bg'>
                      <form method="get" class="form-horizontal">
                        <div class="col-lg-12">
                          <div class="ibox float-e-margins  mrt30">
                            <div class="ibox-content p-md border-none">

                              <div class="col-lg-8 form-edit">

                                <div class="form-group">
                                  <label class="col-sm-2 control-label">言語</label>
                                  <div class="col-sm-4">
                                    <select class="form-control" id="select" name="select">
                                      <option value="1">部署選択</option>
                                      <option value="2">2017</option>
                                      <option value="3">2018</option>
                                    </select>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-sm-2 control-label">言語</label>
                                  <div class="col-sm-4">
                                    <select class="form-control" id="select" name="select">
                                      <option value="1">部署選択</option>
                                      <option value="2">2017</option>
                                      <option value="3">2018</option>
                                    </select>
                                  </div>
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">応募期限</label>
                                  <div class="col-sm-4">
                                    <div class="form-group data_4 mg-left-none" id="">
                                      <div class="input-group date">
                                        <span class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control" value="2014/04">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="clearfix"></div>

                              <div class=" text-center col-lg-2 mag-right-upload pull-left">
                                <div class="fileUpload btn btn-upload row">
                                  <span>ファイル選択</span>
                                  <input id="uploadfile" type="file" class="upload">
                                </div>
                              </div>
                              <div class="col-lg-9 no-padding-right upload-form-name">
                                <input type="text" placeholder="" id="filename" class="form-control bg-white" readonly="true">
                              </div>
                              <div class="clear"></div>

                            </div>
                          </div>
                        </div>
                        <div class="form-submit-button clear">
                          <button class="btn " type="submit">ファイル送信</button>
                        </div>
                      </form>
                    </div>
                    <div class='ibox wrapper-content-large-border wrapper-content-theight white-bg'>
                      <div class='wraper-process-bar'>
                        <div class='proress-bar'>
                          <div class="progress progress-striped active m-b-sm p-bar-status">
                            <div style="width: 100%;" class="progress-bar"></div>
                          </div>
                        </div>
                        <div class='proress-bar title-upload-progress'>
                          <label class='control-label'>登録成功20件／登録エラー2件</label>
                        </div>
                        <table class="table table-bordered ">
                          <thead>
                            <tr>
                              <th class="">行 </th>               
                              <th class="">名前</th>
                              <th class="">エラー内容</th>
                            </tr>
                          </thead>
                          <tbody>                            
                            <tr>
                              <td>7行目</td>
                              <td>田中 太朗  </td>
                              <td>データ形式の不整合</td>
                            </tr>
                            <tr>
                              <td>11行目</td>
                              <td> -  </td>
                              <td>必要なデータがありません</td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="border-bar google-map">
                          <div class="progress-textarea">
                            <textarea rows='13' class='form-control border-none bg-white' readonly='true'>福元庄一,フクモトショウイチ,FukumotoShouichi,男,469215183,367-0113,埼玉県,児玉郡美里町,甘粕,4-16,,1959/12/26
                              渡邊智恵,ワタナベチエ,WatanabeChie,女,390234732,105-0011,東京都,港区,芝公園,2-1,ガーデン芝公園109,1981/05/26
                            </textarea>
                          </div>
                        </div>

                      </div>
                    </div>             
                  </div>
                  <!-- end content -->

                  <div class="row wrapper border-bottom white-bg page-heading clearfix">
                    <div class="col-lg-10">
                      <h2><button class="btn btn-sm btn-white">
                        &lt; 戻る
                      </button>   
                    </h2></div>
                  </div>
                  <br>
                  <br>
                  <div class='clearfix'></div>
                  <div class="footer">
                    <div>
                      <strong>Copyright</strong>© enjin
                    </div>
                  </div>
                </div>       
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



          </script>