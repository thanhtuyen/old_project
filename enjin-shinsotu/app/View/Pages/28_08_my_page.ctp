<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>イベント管理 − イベント開催日程 − 詳細画面</title>
  <?php echo $this->Html->css('bootstrap/bootstrap.min.css'); ?>
  <?php echo $this->Html->css('font-awesome/css/font-awesome.css'); ?>
  <?php echo $this->Html->css('bootstrap/animate.css'); ?>
  <?php echo $this->Html->css('bootstrap/style.css'); ?>
  <?php echo $this->Html->css('plugins/iCheck/custom'); ?>
  <?php echo $this->Html->css('enjin/25_08_recruiters_details.css'); ?>
  <?php echo $this->Html->css('enjin/global'); ?>




  <!-- JSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS -->
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

                      <script>

                      $(document).ready(function () {

                        $('.i-checks').iCheck({
                          checkboxClass: 'icheckbox_square-green',
                          radioClass: 'iradio_square-green'
                        });

                        $('#show-fr-edit').click(function () {
                          $(".show-data").addClass("fr-hiden");
                          $(".show-fr-input").removeClass("fr-hiden");
                          $(".l-bt-edit").removeClass("fr-hiden");
                        });

                        $('#btn-save').click(function () {
                          $(".show-data").removeClass("fr-hiden");
                          $(".show-fr-input").addClass("fr-hiden");
                          $(".fr-child").addClass("fr-hiden");
                          $(".l-bt-edit").addClass("fr-hiden");




                        });

                        $('#btn-save-1').click(function () {
                          $(".show-data").removeClass("fr-hiden");
                          $(".show-fr-input").addClass("fr-hiden");
                          $(".fr-child").addClass("fr-hiden");
                          $(".l-bt-edit").addClass("fr-hiden");
                          
                          


                        });


                        $('#show-fr-child').click(function () {
                          $(".fr-child").removeClass("fr-hiden");
                          $(".show-fr-input").addClass("fr-hiden");
                        });

                        $('#btn-child-save').click(function () {
                          $(".fr-child").addClass("fr-hiden");
                        });
                      });

</script>


  <!-- End JS -->

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
                        <div class="row wrapper border-bottom white-bg page-heading">
                          <div class="col-lg-10">
                            <h2>マイページ</h2>
                          </div>
                        </div>


                        <div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">
                          <!-- content -->   

                          <div class="full-content">
                            <div class="col-lg-6">
                              <div class="ibox">
                                <div class="ibox-title">
                                  <h5>個人情報</h5>
                                  <div class="ibox-tools">
                                    <button type="button" id="show-fr-edit" class="show-data btn btn-primary btn-xs">編集</button> 
                                  </div>
                                </div>
                                <div class="ibox-content bg-white p-sm clearfix show-data">
                                  <div class="col-lg-3 m-t-lg">
                                      
                                        <?php echo $this->Html->image("bootstrap/icon_avatar.png", array(
                                    "class" => "img-reponsive center-block",
                                    )); ?>
                                    <p class="text-center m-t">顔写真</p>
                                                                  
                                  </div>
                                  <div class="col-lg-9">
                                    <form method="get" class="form-horizontal">
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label">名前</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">根尾 加里矢</div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label">担当者タイプ</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">採用担当</div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label">メールアドレス（ログインID）</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none"><a class='text-navy' href="">kariya_neo@enjin.jp</a></div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label">パスワード</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">・・・・・・・</div>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label">電話</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">090xxxxxxxx</div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label">決済者フラグ</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">なし</div>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label">作成運営管理者</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">円陣 勘里</div>
                                        </div>
                                      </div>      
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label">最終ログイン</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">2015/07/22</div>
                                        </div>
                                      </div>                                  
                                    </form>
                                  </div>
                                </div>

                                <div class="ibox-content bg-white p-sm clearfix show-fr-input fr-hiden">
                                  
                                   <div class="col-lg-3 m-t-lg">
                                      
                                        <?php echo $this->Html->image("bootstrap/icon_avatar.png", array(
                                    "class" => "img-reponsive center-block",
                                    )); ?>
                                    <p class="text-center m-t">顔写真</p>
                                                                  
                                  </div>
                                 
                                  <div class='col-lg-9'>
                                    <form method="get" class="form-horizontal">
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label">氏</label>
                                        <div class="col-sm-8">
                                          <div class="">
                                            <input class='form-control border-none' type='text' value='梅原'>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label">名</label>
                                        <div class="col-sm-8">
                                          <div class="">
                                            <input class='form-control border-none' type='text' value='加里矢'>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label">担当者タイプ</label>
                                        <div class="col-sm-8">
                                          <div class="">
                                            <div class="no-borders ver-mid btn-group btn-block">
                                            
                                              <select class="form-control">
                                                <option>採用担当</option>
                                                <option>採用担当</option>
                                                <option>採用担当</option>
                                              </select>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label">メールアドレス（ログインID）</label>
                                        <div class="col-sm-8">
                                          <div class="">
                                            <input class='form-control border-none' type='text' value='kariya_neo@enjin.jp'>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label">パスワード</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">
                                            ............
                                            <div class="pull-right">
                                              <button class="btn btn-primary btn-xs" id="show-fr-child" type="button">変更</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label">電話</label>
                                        <div class="col-sm-8">
                                          <div class="">
                                            <input class='form-control border-none' type='text' value='090xxxxxxxx'>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label">決済者フラグ</label>
                                        <div class="col-sm-8">
                                          <div class="">
                                            <div class="no-borders ver-mid btn-group btn-block">
                                              
                                               <select class="form-control">
                                                <option>なし</option>
                                                <option>なし</option>
                                                <option>なし</option>
                                              </select>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label">作成運営管理者</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">
                                            円陣 勘里
                                          </div>
                                        </div>
                                      </div> 
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label">最終ログイン</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">
                                            2015/07/22
                                          </div>
                                        </div>
                                      </div>                      
                                    </form>  

                                  </div> 
                                  <div class='col-lg-12'>
                                    <div class="tb-footer">
                                      <a class='text-navy' href="#">キャンセル</a>
                                      <button class="btn btn-primary btn-sm" id="btn-save" type="button">変更</button>
                                    </div>
                                  </div>
                                </div>    


                                <div class="ibox-content bg-white p-sm clearfix fr-child fr-hiden">
                                  <div class='col-lg-12'>
                                    <form method="get" class="form-horizontal">
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label">現在のパスワード</label>
                                        <div class="col-sm-8">
                                          <input class='form-control border-none' type='text' value='・・・・・・・・・'>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label">新しいパスワード</label>
                                        <div class="col-sm-8">
                                          <div class="">
                                            <input class='form-control border-none' type='text' value='・・・・・・・・・'>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label">新しいパスワード（確認）</label>
                                        <div class="col-sm-8">
                                          <input class='form-control border-none' type='text' value='・・・・・・・・・'>
                                        </div>
                                      </div>
                                    </form>  
                                    <div class="tb-footer">
                                      <a class='text-navy' href="#">キャンセル</a>
                                      <button class="btn btn-primary btn-sm" id="btn-save-1" type="button">変更</button>
                                    </div>
                                  </div>
                                </div> 


                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="wrapper wrapper-content animated fadeInRight row">
                          <div class="plist-two-layout clearfix">
                            <!--layout left-->
                            <div class="col-lg-7 fr-hiden">
                              <!--from child-->
                              <div class="">
                                <div class="header-fr">
                                  <div class="title pull-left">
                                    <h4>パスワード変更</h4>
                                  </div>
                                </div>
                                <div class="content-s col-lg-12">
                                  <table class="custom-tb margin-bottom15">
                                    <tr>
                                      <td class="row1 first">現在のパスワード</td>
                                      <td class="row2"><input type="text" name="firstname" placeholder="・・・・・・・・・" class="form-control"></td>
                                    </tr>
                                    <tr>
                                      <td class="first">新しいパスワード</td>
                                      <td><input type="text" name="firstname" placeholder="・・・・・・・・・" class="form-control"></td>
                                    </tr>
                                    <tr>
                                      <td class="first">新しいパスワード（確認）</td>
                                      <td><input type="text" name="firstname" placeholder="・・・・・・・・・" class="form-control"></td>
                                    </tr>
                                  </table>
                                  <div class="tb-footer">
                                    <a href="#">キャンセル</a>
                                    <button class="btn btn-primary btn-sm" id="btn-child-save" type="button">変更</button>
                                  </div>
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



