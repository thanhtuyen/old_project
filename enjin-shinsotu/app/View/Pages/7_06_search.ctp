<!DOCTYPE html>
<html>
<head>
  <title>イベント管理 − イベント開催日程 − 詳細画面</title>
  <!-- css -->
  <?php echo $this->Html->css('bootstrap/bootstrap.min.css'); ?>
  <?php echo $this->Html->css('font-awesome/css/font-awesome.css'); ?>
  <?php echo $this->Html->css('plugins/iCheck/custom.css'); ?>
  <?php echo $this->Html->css('bootstrap/animate.css'); ?>
  <?php echo $this->Html->css('bootstrap/style.css'); ?>
  <?php echo $this->Html->css('enjin/25_08_recruiters_details.css'); ?>
  <?php echo $this->Html->css('enjin/global'); ?>
  <!-- end css -->
  <!-- script -->
  <!-- Mainly scripts -->
  <?php echo $this->Html->script('jquery-2.1.1.js'); ?>
  <?php echo $this->Html->script('bootstrap.min.js'); ?>
  <!-- Custom and plugin javascript -->
  <?php echo $this->Html->script('inspinia.js'); ?>
  <?php echo $this->Html->script('plugins/slimscroll/jquery.slimscroll.min.js'); ?>
  <!-- MENU -->
  <?php echo $this->Html->script('plugins/metisMenu/jquery.metisMenu.js'); ?>
  

</head>

<body>

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
                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David
                  Williams</strong>
                </span> <span class="text-muted text-xs block">Art Director <b
                class="caret"></b></span> </span> </a>
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


              <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                  <h2>  
                    イベント登録</h2>
                  </div>
                </div>

                <div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">

                  <div class="plist-two-layout">
                    <!--layout left-->
                    <div class="col-lg-8">
                      <div class="ibox">

                        <div class="ibox-title">
                          <h5>イベント情報</h5>

                        </div>
                        <div class="ibox-content bg-white">



                          <form method="get" class="form-horizontal form-edit clearfix" >
                            <div class="form-group">
                              <label class="col-sm-4 control-label text-left">イベント名</label>
                              <div class="col-sm-8"><input type="text" class="form-control" value="イベント名入力"></div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label text-left text-left">求人票</label>
                              <div class="col-sm-8">
                                <select class="form-control">
                                  <option>求人票選択</option>
                                  <option>求人票選択</option>
                                  <option>求人票選択</option>

                                </select>
                              </div>
                            </div>



                            <div class="form-group">
                              <label class="col-sm-4 control-label text-left">イベント種別</label>
                              <div class="col-sm-8">
                                <select class="form-control">
                                  <option>説明会</option>
                                  <option>説明会</option>
                                  <option>説明会</option>

                                </select>

                              </div>
                            </div>

                            <!-- textarea -->
                            <div class="form-group">
                              <label class="col-sm-4 control-label text-left">ターゲット選考段階</label>

                              <div class="col-sm-8">

                                <select class="form-control">
                                  <option>1次選考</option>
                                  <option>1次選考</option>
                                  <option>1次選考</option>

                                </select>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-4 control-label text-left">ターゲット選考段階比較タイプ  
                              </label>
                              <div class="col-sm-8">
                                <select class="form-control">
                                  <option>以前</option>
                                  <option>以前</option>
                                  <option>以前</option>

                                </select>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-4 control-label text-left">ターゲット選考ステータス （マスタ）</label>
                              <div class="col-sm-8">
                                <select class="form-control">
                                  <option>ステータス選択</option>
                                  <option>ステータス選択</option>
                                  <option>以前</option>

                                </select>

                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-4 control-label text-left">イベント内容</label>
                              <div class="col-sm-8"><textarea class="form-control">イベント内容入力</textarea></div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-4 control-label text-left">リクナビID</label>
                              <div class="col-sm-8"><input type="text" class="form-control" value="ID入力"></div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-4 control-label text-left">マイナビID</label>
                              <div class="col-sm-8"><input type="text" class="form-control" value="ID入力"></div>
                            </div>
                            <div class="col-lg-12 btn-clear text-center">
                              <a class='text-navy btn-reset' href="#">クリア</a>
                              <button class="btn w-95 btn-primary" type="submit">登録する</button>
                            </div> 
                          </form>   

                        </div>

                      </div>


                    </div>


                    <!--layout right-->
                    <div class="col-lg-4">
                      <!--layout calender-->
                      <div class="ibox">
                        <div class="ibox-title">
                          <h5>求人担当者登録</h5>
                          <div class="ibox-tools">
                            <a class="collapse-link">
                              <i class="fa fa-chevron-up"></i>
                            </a>                                                           
                          </div>
                        </div>


                        <div class="ibox-content bg-white">


                          <table class="table table-bordered no-margin-bottom subcontents-sb-1">
                          <tbody>
                            <tr>
                              <th>求人票ID</th>
                              <td><a class="text-navy" href="">ABC123456</a></td>
                            </tr>   
                            <tr>
                              <th>氏フリガナ</th>
                              <td>求人票タイトル</td>
                            </tr> 
                            <tr>
                              <th>募集要項</th>
                              <td>仕事の内容を掲載</td>
                            </tr> 
                            <tr>
                              <th>職種タイプ</th>
                              <td>営業</td>
                            </tr> 
                            <tr>
                              <th>初任給</th>
                              <td>24万円</td>
                            </tr> 
                            <tr>
                              <th>待遇</th>
                              <td>待遇内容を掲載</td>
                            </tr> 
                            <tr>
                              <th>応募資格</th>
                              <td>応募資格を掲載</td>
                            </tr> 
                            <tr>
                              <th>募集人数</th>
                              <td>10人</td>
                            </tr> 
                            <tr>
                              <th>募集期限</th>
                              <td>YYYY / MM / DD</td>
                            </tr> 
                             <tr>
                              <th>公開開始日時</th>
                              <td>yyyy / mm / dd hh:mm</td>
                            </tr> 
                             <tr>
                              <th>募集エリア</th>
                              <td>エリア名</td>
                            </tr> 

                                        
                          </tbody>
                        </table>


                    


                        </div>



                      </div>

                    </div>
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



              </div>



            </body>

            </html>
