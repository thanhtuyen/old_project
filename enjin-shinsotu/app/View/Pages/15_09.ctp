<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page 15 version 0.92</title>

  <!-- css -->
  <?php echo $this->Html->css('bootstrap/animate'); ?>
  <?php echo $this->Html->css('bootstrap/bootstrap.min'); ?>
  <?php echo $this->Html->css('font-awesome/css/font-awesome'); ?>
  <?php echo $this->Html->css('plugins/iCheck/custom'); ?>
  <?php echo $this->Html->css('bootstrap/animate'); ?>
  <?php echo $this->Html->css('bootstrap/style'); ?>
  <?php echo $this->Html->css('enjin/global'); ?>
  <?php echo $this->Html->css('enjin/email'); ?>

  <!-- end css -->

  <!-- script -->
  <?php echo $this->Html->script('jquery-2.1.1.js'); ?>
  <?php echo $this->Html->script('bootstrap.min.js'); ?>
  <?php echo $this->Html->script('plugins/metisMenu/jquery.metisMenu.js'); ?>
  <?php echo $this->Html->script('plugins/slimscroll/jquery.slimscroll.min.js'); ?>
  <!-- Peity -->
  <?php echo $this->Html->script('plugins/peity/jquery.peity.min.js'); ?>
  <!-- Custom and plugin javascript -->
  <?php echo $this->Html->script('inspinia.js'); ?>
  <?php echo $this->Html->script('plugins/pace/pace.min.js'); ?>
  <!-- iCheck -->
  <?php echo $this->Html->script('plugins/iCheck/icheck.min.js'); ?>
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
            <div class="dropdown profile-element"> <span>
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
              <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">マスタ管理</span></a>
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
              <!-- <li class="dropdown">
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
              </li> -->

              <li>
                <a href="login.html">
                  <i class="fa fa-sign-out"></i> Log out
                </a>
              </li>
            </ul>

          </nav>
        </div>

        <!-- title content -->
        <div class="row wrapper border-bottom white-bg page-heading">
          <div class="col-lg-10">
            <h2>重複候補者検索</h2>
          </div>
        </div>
        <!-- end title content -->

        <!-- content -->
        <div class="wrapper wrapper-content row animated fadeInRight clearfix">

          <div class="col-lg-12">

            <!-- check option -->
            <div class="ibox">
              <div class="ibox-title">
                <h5>重複候補者 抽出条件</h5>
              </div>
              <div class="ibox-content clearfix form-edit2 p-sm">
                <form>
                  <div class='col-lg-6'>
                    <fieldset>
                      <legend>OR検索項目</legend>
                      <div class="col-sm-12">
                        <div class='col-sm-6'> 
                          <div class="i-checks">
                            <label> <input type="checkbox" value=""> <i></i>氏名一致</label>
                          </div>
                          <div class="i-checks">
                            <label> <input type="checkbox" value=""> <i></i>携帯電話番号一致</label>
                          </div>  

                          <div class="i-checks">
                            <label> <input type="checkbox" value=""> <i></i>電話番号一致</label>
                          </div>                               
                        </div>
                        <div class='col-sm-6'> 
                          <div class="i-checks">
                            <label> <input type="checkbox" value=""> <i></i>氏名フリガナ一致</label>
                          </div>
                          <div class="i-checks">
                            <label> <input type="checkbox" value=""> <i></i>携帯メールアドレス一致</label>
                          </div>  

                          <div class="i-checks">
                            <label> <input type="checkbox" value=""> <i></i>メールアドレス一致</label>
                          </div>                               
                        </div>
                      </div>
                    </fieldset>
                  </div>
                  <div class='col-lg-6'>
                    <fieldset>
                      <legend>AND検索項目（左記条件に加えて）</legend>
                      <div class="col-sm-12">
                        <div class="i-checks">
                          <label> <input type="checkbox" value=""> <i></i>大学名一致</label>
                        </div>
                        <div class="i-checks">
                          <label> <input type="checkbox" value=""> <i></i>生年月日</label>
                        </div>  
                      </div>
                    </fieldset>
                  </div>
                  <div class="from_calen col-lg-12">
                    <button type="button" class="btn btn-primary">検索</button>
                    <a class="text-navy">クリア</a>
                  </div>
                </form>
              </div>
            </div>
            <!-- end check option -->

            <!-- data -->
            <div class="ibox  no-margin-bottom">
              <div class="ibox-title">
                <h5>抽出結果</h5>
              </div>

              <!-- data 1 -->
              <div class="ibox-content clearfix p-sm bg-ccc">
                <h3>「氏名」と「携帯電話番号」が一致した情報が３件あります。</h3>
                <div class='row'>

                  <!-- first column -->
                  <div class='col-lg-4'>
                    <div class="ibox">
                      <div class="ibox-title">
                        <h5>候補者情報</h5>
                      </div>
                      <div class="ibox-content bg-white">
                        <table class="table table-bordered no-margin-bottom subcontents-sb-1">
                          <tbody>
                            <tr>
                              <th class="w-47per">候補者ID</th>
                              <td class="">12345678</td>
                            </tr>   
                            <tr>
                              <th>氏名</th>
                              <td class="  color_red">田中 太郎</td>
                            </tr> 
                            <tr>
                              <th  >フリガナ</th>
                              <td class="  ">タナカ タロウ</td>
                            </tr> 
                            <tr>
                              <th  >大学名</th>
                              <td class="  ">輪瀬田大学</td>
                            </tr> 
                            <tr>
                              <th  >生年月日</th>
                              <td class="  ">1994/10/02</td>
                            </tr> 
                            <tr>
                              <th  >電話番号</th>
                              <td class="  ">-</td>
                            </tr> 
                            <tr>
                              <th  >メールアドレス</th>
                              <td class="  ">t-taro@pmai l.com</td>
                            </tr> 
                            <tr>
                              <th  >携帯電話番号</th>
                              <td class="  color_red">090xxxxxxxx</td>
                            </tr> 
                            <tr>
                              <th  >携帯メールアドレス</th>
                              <td class="  ">t-taro@dododo.ne.jp</td>
                            </tr>              
                          </tbody>
                        </table>                    
                      </div>
                      <div class="ibox-content clearfix bg-sl-btn pd-9">
                        <div class='hover-button'>
                          <a href="" type="button" class="full-width cl-white btn btn-primary btn-sm m-b-sm">候補者情報を編集</a>
                        </div>
                        <div class='hover-button'>
                          <a href="" type="button" class="full-width cl-white btn btn-primary btn-sm">この候補者を削除する</a>
                        </div>

                      </div>
                    </div>
                  </div>

                  <!-- second column -->
                  <div class='col-lg-4'>
                    <div class="ibox ">
                      <div class="ibox-title">
                        <h5>選考履歴</h5>
                      </div>
                      <div class="ibox-content clearfix p-sm">

                        <h5><a class="text-navy" href="">2016年新卒・営業</a></h5>

                        <table class="table table-bordered sb-3">
                          <tbody>
                            <tr>
                              <th>選考段階</th>
                              <td>2次選考</td>
                            </tr>
                            <tr>
                              <th>選考ステータス</th>
                              <td>合格</td>
                            </tr>                               
                          </tbody>
                        </table>

                        <h5><a class="text-navy" href="">2016年新卒・一般</a></h5>

                        <table class="table table-bordered subcontents-sb-1">
                          <tbody>
                            <tr>
                              <th>選考段階</th>
                              <td>書類選考</td>
                            </tr>
                            <tr>
                              <th>選考ステータス</th>
                              <td>不合格</td>
                            </tr>                               
                          </tbody>
                        </table>


                      </div>                              
                    </div>
                  </div>

                  <!-- third column -->
                  <div class='col-lg-4'>
                    <div class="ibox ">
                      <div class="ibox-title">
                        <h5>イベント参加履歴</h5>
                      </div>
                      <div class="ibox-content clearfix p-sm pd-bottom-none">

                        <h5><a class="text-navy" href="">2016年新卒就職フェア</a></h5>                
                        <table class="table table-bordered sb-3">
                          <tbody>
                            <tr>
                              <th>開催日時</th>
                              <td>2015/07/30 12:00</td>
                            </tr>
                            <tr>
                              <th>参加ステータス</th>
                              <td>参加済</td>
                            </tr>              
                            <tr>
                              <th>ファイル</th>
                              <td><a class="text-navy" href="">アンケート.xlsx <br> チェックシート.jpg</a></td>
                            </tr>          
                            <tr>
                              <th>評価</th>
                              <td>80</td>
                            </tr>    
                            <tr>
                              <th>コメント</th>
                              <td>受講態度良し、提出書類も高評価</td>
                            </tr>    
                          </tbody>
                        </table>

                        <h5><a class="text-navy" href="">2016年新卒・一般</a></h5>                
                        <table class="table table-bordered sb-3">
                          <tbody>
                            <tr>
                              <th>開催日時</th>
                              <td>2015/07/30 12:00</td>
                            </tr>
                            <tr>
                              <th>参加ステータス</th>
                              <td>ファイル</td>
                            </tr>              
                            <tr>
                              <th>ファイル</th>
                              <td><a class="text-navy" href="">アンケート.xlsx <br> チェックシート.jpg</a></td>
                            </tr>          
                            <tr>
                              <th>評価</th>
                              <td>80</td>
                            </tr>    
                            <tr>
                              <th>コメント</th>
                              <td>受講態度良し、提出書類も高評価</td>
                            </tr>    
                          </tbody>
                        </table>

                      </div>                         
                    </div>
                  </div>

                </div>
              </div>

              <!-- data 2 -->
              <div class="ibox-content clearfix p-sm bg-ccc">
                <div class='row'>

                  <!-- first column -->
                  <div class='col-lg-4'>
                    <div class="ibox">
                      <div class="ibox-title">
                        <h5>候補者情報</h5>
                      </div>
                      <div class="ibox-content bg-white">
                        <table class="table table-bordered no-margin-bottom subcontents-sb-1">
                          <tbody>
                            <tr>
                              <th class="text-right w-47per">候補者ID</th>
                              <td class="  ">12345678</td>
                            </tr>   
                            <tr>
                              <th  >氏名</th>
                              <td class="  color_red">田中 太郎</td>
                            </tr> 
                            <tr>
                              <th  >フリガナ</th>
                              <td class="  ">タナカ タロウ</td>
                            </tr> 
                            <tr>
                              <th  >大学名</th>
                              <td class="  ">輪瀬田大学</td>
                            </tr> 
                            <tr>
                              <th  >生年月日</th>
                              <td class="  ">1994/10/02</td>
                            </tr> 
                            <tr>
                              <th  >電話番号</th>
                              <td class="  ">-</td>
                            </tr> 
                            <tr>
                              <th  >メールアドレス</th>
                              <td class="  ">t-taro@pmai l.com</td>
                            </tr> 
                            <tr>
                              <th  >携帯電話番号</th>
                              <td class="  color_red">090xxxxxxxx</td>
                            </tr> 
                            <tr>
                              <th  >携帯メールアドレス</th>
                              <td class="  ">t-taro@dododo.ne.jp</td>
                            </tr>              
                          </tbody>
                        </table>                    
                      </div>
                      <div class="ibox-content clearfix bg-sl-btn pd-9">
                        <div class='hover-button'>
                          <a href="" type="button" class="full-width cl-white btn btn-primary btn-sm m-b-sm">候補者情報を編集</a>
                        </div>
                        <div class='hover-button'>
                          <a href="" type="button" class="full-width cl-white btn btn-primary btn-sm">この候補者を削除する</a>
                        </div>

                      </div>
                    </div>
                  </div>

                  <!-- second column -->
                  <div class='col-lg-4'>
                    <div class="ibox ">
                      <div class="ibox-title">
                        <h5>求人票一覧</h5>
                      </div>
                      <div class="ibox-content clearfix p-sm pd-bottom-none">                             
                       <h5><a class="text-navy" href="">2016年新卒・営業</a></h5>

                       <table class="table table-bordered sb-3">
                        <tbody>
                          <tr>
                            <th>選考段階</th>
                            <td>2次選考</td>
                          </tr>
                          <tr>
                            <th>選考ステータス</th>
                            <td>合格</td>
                          </tr>                               
                        </tbody>
                      </table>

                    </div>                              
                  </div>
                </div>

                <!-- third column -->
                <div class='col-lg-4'>
                  <div class="ibox ">
                    <div class="ibox-title">
                      <h5>イベント参加履歴</h5>
                    </div>
                    <div class="ibox-content clearfix p-sm pd-bottom-none">
                      <h5><a class="text-navy" href="">2016年新卒・一般</a></h5>                
                        <table class="table table-bordered sb-3">
                          <tbody>
                            <tr>
                              <th>開催日時</th>
                              <td>2015/07/30 12:00</td>
                            </tr>
                            <tr>
                              <th>参加ステータス</th>
                              <td>ファイル</td>
                            </tr>              
                            <tr>
                              <th>ファイル</th>
                              <td><a class="text-navy" href="">アンケート.xlsx <br> チェックシート.jpg</a></td>
                            </tr>          
                            <tr>
                              <th>評価</th>
                              <td>80</td>
                            </tr>    
                            <tr>
                              <th>コメント</th>
                              <td>受講態度良し、提出書類も高評価</td>
                            </tr>    
                          </tbody>
                        </table>                             
                    </div>                         
                  </div>
                </div>

              </div>
            </div>

            <!-- data 3 -->
            <div class="ibox-content clearfix p-sm bg-ccc">
              <div class='row'>

                <!-- first column -->
                <div class='col-lg-4'>
                  <div class="ibox">
                    <div class="ibox-title">
                      <h5>候補者情報</h5>
                    </div>
                    <div class="ibox-content bg-white">
                      <table class="table table-bordered no-margin-bottom subcontents-sb-1">
                        <tbody>
                          <tr>
                            <th class="text-right w-47per">候補者ID</th>
                            <td class="  ">12345678</td>
                          </tr>   
                          <tr>
                            <th  >氏名</th>
                            <td class="  color_red">田中 太郎</td>
                          </tr> 
                          <tr>
                            <th  >フリガナ</th>
                            <td class="  ">タナカ タロウ</td>
                          </tr> 
                          <tr>
                            <th  >大学名</th>
                            <td class="  ">輪瀬田大学</td>
                          </tr> 
                          <tr>
                            <th  >生年月日</th>
                            <td class="  ">1994/10/02</td>
                          </tr> 
                          <tr>
                            <th  >電話番号</th>
                            <td class="  ">-</td>
                          </tr> 
                          <tr>
                            <th  >メールアドレス</th>
                            <td class="  ">t-taro@pmai l.com</td>
                          </tr> 
                          <tr>
                            <th  >携帯電話番号</th>
                            <td class="  color_red">090xxxxxxxx</td>
                          </tr> 
                          <tr>
                            <th  >携帯メールアドレス</th>
                            <td class="  ">t-taro@dododo.ne.jp</td>
                          </tr>              
                        </tbody>
                      </table>                    
                    </div>
                    <div class="ibox-content clearfix bg-sl-btn pd-9">
                      <div class='hover-button'>
                        <a href="" type="button" class="full-width cl-white btn btn-primary btn-sm m-b-sm">候補者情報を編集</a>
                      </div>
                      <div class='hover-button'>
                        <a href="" type="button" class="full-width cl-white btn btn-primary btn-sm">この候補者を削除する</a>
                      </div>

                    </div>
                  </div>
                </div>

                <!-- second column -->
                <div class='col-lg-4'>
                  <div class="ibox ">
                    <div class="ibox-title">
                      <h5>求人票一覧</h5>
                    </div>
                    <div class="ibox-content clearfix p-sm pd-bottom-none">                             

                      <!-- data -->

                    </div>                              
                  </div>
                </div>

                <!-- third column -->
                <div class='col-lg-4'>
                  <div class="ibox ">
                    <div class="ibox-title">
                      <h5>イベント参加履歴</h5>
                    </div>
                    <div class="ibox-content clearfix p-sm pd-bottom-none">

                      <!-- data -->

                    </div>                         
                  </div>
                </div>

              </div>
            </div>

          </div>
          <!-- data -->

        </div>


      </div>
      <!-- end content -->



      <br>
      <br>
      <div class="clearfix"></div>
      <!-- footer -->
      <div class="footer">
        <div>
          <strong>Copyright</strong>© enjin
        </div>
      </div>
    </div>

  </body>

  </html>
