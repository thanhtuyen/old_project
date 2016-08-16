<!DOCTYPE html>
<html>

<head>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>求人票管理 − 求人一覧</title>
  <?php echo $this->Html->css('bootstrap/bootstrap.min'); ?>
  <?php echo $this->Html->css('font-awesome/css/font-awesome'); ?>
  <?php echo $this->Html->css('bootstrap/animate'); ?>
  <?php echo $this->Html->css('bootstrap/style'); ?>

  <?php echo $this->Html->css('enjin/02_selection.css'); ?>
  <?php echo $this->Html->css('enjin/global.code'); ?>
  <?php echo $this->Html->css('enjin/global.group'); ?>
  <?php echo $this->Html->css('enjin/master'); ?>

  <?php echo $this->Html->css('plugins/dataTables/dataTables.bootstrap'); ?>
  <?php echo $this->Html->css('plugins/dataTables/dataTables.responsive'); ?>
  <?php echo $this->Html->css('plugins/dataTables/dataTables.tableTools.min'); ?>


  <!-- Mainly scripts -->
  <?php echo $this->Html->script('jquery-2.1.1.js'); ?>
  <?php echo $this->Html->script('bootstrap.min.js'); ?>
  <?php echo $this->Html->script('plugins/metisMenu/jquery.metisMenu.js'); ?>
  <?php echo $this->Html->script('plugins/slimscroll/jquery.slimscroll.min.js'); ?>

  <!-- Custom and plugin javascript -->
  <?php echo $this->Html->script('inspinia.js'); ?>
  <?php echo $this->Html->script('plugins/pace/pace.min.js'); ?>

  <!-- Peity -->
  <?php echo $this->Html->script('plugins/peity/jquery.peity.min.js'); ?>

  <!-- Data Tables -->
  <?php echo $this->Html->script('plugins/jeditable/jquery.jeditable.js'); ?>
  <?php echo $this->Html->script('plugins/dataTables/jquery.dataTables.js'); ?>
  <?php echo $this->Html->script('plugins/dataTables/dataTables.bootstrap.js'); ?>
  <?php echo $this->Html->script('plugins/dataTables/dataTables.responsive.js'); ?>
  <?php echo $this->Html->script('plugins/dataTables/dataTables.tableTools.min.js'); ?>

  <script>
  $(document).ready(function() {
    $('.dataTables-example').dataTable({        
      "tableTools": {
        "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
      }
    });
    /* Init DataTables */
    var oTable = $('#editable').dataTable();
    /* Apply the jEditable handlers to the table */
    oTable.$('td').editable( '../example_ajax.php', {
      "callback": function( sValue, y ) {
        var aPos = oTable.fnGetPosition( this );
        oTable.fnUpdate( sValue, aPos[0], aPos[1] );
      },
      "submitdata": function ( value, settings ) {
        return {
          "row_id": this.parentNode.getAttribute('id'),
          "column": oTable.fnGetPosition( this )[2]
        };
      },
      "width": "90%",
      "height": "100%"
    } );
  });
  </script>


  <!-- Page-Level Scripts -->


</head>
<!-- ------------start header and menu-------------- -->


<body class='job_list'>

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

        <!-- -------------end header and menu----------- -->

        <div class="row wrapper border-bottom white-bg page-heading">
          <div class="col-lg-10">
            <h2>求人票一覧</h2>                    
          </div>
        </div>
        <!---------------------------end cotent title------------------------------>



        <div class="wrapper wrapper-content row animated fadeInRight clearfix">
          <div class='full-content'>
            <div class='col-lg-12'>
              <div>
                <div class='ibox-title'> 
                  <h5>求人票一覧</h5>                  
                </div>
                <div class="ibox-content p-sm">
                  <div class="text-right four-action">
                         <!--    <div class="pull-left">
                              <button class="btn btn-primary btn-sm">新規候補者登録</button>
                            </div>  -->                          
                            <div>
                              <span class="sp-text-pg">10件中10件表示</span>
                              <div class="bottom_pagination1 pull-right">
                                <ul class="pagination margin-pag mg-none-bottom pag-pd">
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

                          <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover tb1">
                              <thead>
                                <tr>                          
                                  <th>求人票ID</th>
                                  <th>求人票タイトル</th>
                                  <th>求人担当者</th>
                                  <th>イベント名</th>
                                  <th>職種</th>
                                  <th>募集エリア</th>
                                  <th>募集人数</th>
                                  <th>書類選考</th>
                                  <th>1次選考</th>
                                  <th>2次選考</th>
                                  <th>最終選考</th>
                                  <th>募集期限</th>
                                  <th>公開開始日時</th>
                                  <th>ステータス</th>
                                  <th>登録日</th>
                                  <th>最終更新日</th>
                                  <th>操作</th>
                                </tr>                                
                              </thead>
                              <tbody>
                                <tr>
                                  <td><a href="">123456</a></td>
                                  <td><a href="">2016年度新卒営業</a></td>
                                  <td><a href="">根尾 加里矢 最要 担当朗 綿節 嘆斗</a></td>
                                  <td><a href="">会社説明会 2015/5/10</a></td>
                                  <td>営業</td>
                                  <td>港区</td>
                                  <td>1</td>
                                  <td><a href="">50</a></td>
                                  <td><a  href="">4</a></td>
                                  <td><a href="">3</a></td>
                                  <td><a href="">0</a></td>
                                  <td>2016/09/30</td>
                                  <td>2016/05/07</td>
                                  <td>有効</td>
                                  <td>2015/06/15</td>
                                  <td>2015/06/15</td>
                                  <td class = "hover-button"><a href="" type="button" class="btn btn-primary btn-xs cl-white">詳細</a></td>
                                </tr>      
                                <tr>
                                  <td><a href="#">456789</a></td>
                                  <td><a href="#">2015年度新卒営業</a></td>
                                  <td><a href="#">根尾 加里矢 最要 担当朗 綿節 嘆斗</a></td>
                                  <td><a href="#">会社説明会 2015/5/10</a></td>
                                  <td>営業</td>
                                  <td>港区</td>
                                  <td>1</td>
                                  <td><a href="#">50</a></td>
                                  <td><a class="text-red" href="#">4</a></td>
                                  <td><a href="#">3</a></td>
                                  <td><a href="#">0</a></td>
                                  <td>2015/09/30</td>
                                  <td>2015/05/07</td>
                                  <td>有効</td>
                                  <td>2017/06/15</td>
                                  <td>2017/06/15</td>
                                  <td class = "hover-button"><a href="" type="button" class="btn btn-primary btn-xs cl-white">詳細</a></td>
                                </tr>
                                <tr>
                                  <td><a href="#">987654</a></td>
                                  <td><a href="#">2017年度新卒営業</a></td>
                                  <td><a href="#">根尾 加里矢 最要 担当朗 綿節 嘆斗</a></td>
                                  <td><a href="#">会社説明会 2017/5/10</a></td>
                                  <td>営業</td>
                                  <td>港区</td>
                                  <td>1</td>
                                  <td><a href="#">5</a></td>
                                  <td><a href="#">4</a></td>
                                  <td><a href="#">3</a></td>
                                  <td><a href="#">0</a></td>
                                  <td>2017/09/30</td>
                                  <td>2017/05/07</td>    
                                  <td>有効</td>
                                  <td>2017/06/15</td>
                                  <td>2017/06/15</td>
                                  <td class = "hover-button"><a href="" type="button" class="btn btn-primary btn-xs cl-white">詳細</a></td>
                                </tr>            
                              </tbody>   
                              <tfoot>
                                <tr>                          
                                  <th>求人票ID</th>
                                  <th>求人票タイトル</th>
                                  <th>求人担当者</th>
                                  <th>イベント名</th>
                                  <th>職種</th>
                                  <th>募集エリア</th>
                                  <th>募集人数</th>
                                  <th>書類選考</th>
                                  <th>1次選考</th>
                                  <th>2次選考</th>
                                  <th>最終選考</th>
                                  <th>募集期限</th>
                                  <th>公開開始日時</th>
                                  <th>ステータス</th>
                                  <th>登録日</th>
                                  <th>最終更新日</th>
                                  <th>操作</th>
                                </tr>                                
                              </tfoot>
                            </table>

                            
                          </div>
                          <div class="text-right four-action">
                             <!--  <div class="pull-left">
                                <button class="btn btn-primary btn-sm">新規候補者登録</button>
                              </div>                   -->         
                              <div>
                                <span class="sp-text-pg">10件中10件表示</span>
                                <div class="bottom_pagination1 pull-right">
                                  <ul class="pagination margin-pag mg-none-bottom pag-pd">
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
                  </div>
                  <!---------------------------end cotent------------------------------>


                </div>  
                <div class='clearfix'></div>
                <br>
                <br>
                <div class="footer">
                  <div>
                    <strong>Copyright</strong>© enjin
                  </div>
                </div>      
              </div>   
            </body>
            </html>
