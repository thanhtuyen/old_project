<!DOCTYPE html>
<html>

<head>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Schools</title>



  <?php echo $this->Html->css('enjin/animate'); ?>
  <?php echo $this->Html->css('bootstrap/bootstrap.min'); ?>
  <?php echo $this->Html->css('font-awesome/css/font-awesome'); ?>
  <?php echo $this->Html->css('plugins/iCheck/custom'); ?>
  
  
  <?php echo $this->Html->css('enjin/10_ver06.css'); ?>
  <?php echo $this->Html->css('bootstrap/style'); ?>
  <?php echo $this->Html->css('enjin/global'); ?>
  <?php echo $this->Html->css('plugins/dataTables/dataTables.bootstrap'); ?>
  <?php echo $this->Html->css('plugins/dataTables/dataTables.responsive'); ?>
  <?php echo $this->Html->css('plugins/dataTables/dataTables.tableTools.min'); ?>
  <?php echo $this->Html->css('enjin/02_selection.css'); ?>

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

                <div class="row wrapper border-bottom white-bg page-heading">
                  <div class="col-lg-10">
                    <h2>Schools</h2>
                  </div>
                </div>

                <div class="wrapper wrapper-content row animated fadeInRight clearfix no-margin-bottom">
                  <div class="col-lg-12">

                    <div class="ibox  no-margin-bottom">
                      <div class="ibox-title">
                        <h5>School</h5>
                        <div class="ibox-tools">
                          <button type='button' class='btn btn-primary btn-xs'>New</button>
                        </div>
                      </div>

                      <!-- action form -->
                      <div class="ibox-content bg-gray clearfix form-edit2 p-sm">
                        <form>
                          <div class="clear"></div>
                          <div class="form-group">
                            <div class="pull-left row m-r-md">
                              <label class="pull-left p-xs">Class Schools</label>
                              <select class="form-control ct-select2">
                                <option value="1">21</option>
                                <option value="2">22</option>
                                <option value="3">42</option>
                              </select>
                            </div>
                            <div class="pull-left row m-r-md ">
                              <label class="pull-left p-xs">Pub/Pri Class</label>
                              <select class="form-control ct-select2">
                                <option value="1">Pubic</option>
                                <option value="2">Private</option>
                                <option value="3">None</option>
                              </select>
                            </div>
                            <div class="pull-left row">
                              <label class="pull-left p-xs">Name</label>
                              <input class='form-control ct-select2' type='text'>
                            </div>
                          </div>
                          <div class="clear"></div>
                          <div class="from_calen">
                            <button type="button" class="btn btn-primary btn-sm">Search</button>
                          </div>
                        </form>
                      </div>
                      <!-- end form action -->

                    </div>
                    <div class="ibox-content">

                      <!-- pagination -->
                      <div class='bottom_pagination1 pull-right'>
                        <ul class="pagination m-t-none">
                          <li class="paginate_button previous disabled" aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_previous"><a href="#">Prev</a>
                          </li>
                          <li class="paginate_button active" aria-controls="DataTables_Table_0" tabindex="0"><a href="#">1</a></li>
                          <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0"><a href="#">2</a></li>
                          <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0"><a href="#">3</a></li>
                          <li class="paginate_button next" aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_next"><a href="#">Next</a></li>
                        </ul>
                      </div>
                      <div class='clearfix'></div>
                      <!-- end pagination -->

                      <!-- table -->
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered dataTables-example">
                          <thead>
                            <tr>
                              <th>Id</th>          
                              <th>Rec Company</th>
                              <th>Name</th>
                              <th>School Class</th>
                              <th>Public Private Class</th>
                              <th>School Rank</th>
                              <th>Coutry</th>
                              <th>Prefecture</th>
                              <th>Rec Recruiter</th>
                              <th>Status</th>
                              <th>Created</th>
                              <th>Modified</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>                                    
                              <td>709</td>
                              <td><a class='text-navy' href="">2</a></td>
                              <td><a class='text-navy' href="">3</a></td>
                              <td>4</td>
                              <td>5</td>
                              <td>6</td>
                              <td><a class='text-navy' href="">7</a></td>
                              <td><a class='text-navy' href="">8</a></td>
                              <td><a class='text-navy' href="">9</a></td>
                              <td>10</td>
                              <td>11</td>
                              <td>12</td>
                              <td>
                                <div class='full-width'>
                                  <button class="btn btn-primary btn-xs">View</button>
                                  <button class="btn btn-primary btn-xs">Edit</button>
                                  <button class="btn btn-primary btn-xs">Delete</button>
                                  <div class='clearfix'></div>
                                </div>
                              </td>
                            </tr>
                            <tr>                                    
                              <td>709</td>
                              <td><a class='text-navy' href="">2</a></td>
                              <td><a class='text-navy' href="">3</a></td>
                              <td>4</td>
                              <td>5</td>
                              <td>6</td>
                              <td><a class='text-navy' href="">7</a></td>
                              <td><a class='text-navy' href="">8</a></td>
                              <td><a class='text-navy' href="">9</a></td>
                              <td>10</td>
                              <td>11</td>
                              <td>12</td>
                              <td>
                                <div class='full-width'>
                                  <button class="btn btn-primary btn-xs">View</button>
                                  <button class="btn btn-primary btn-xs">Edit</button>
                                  <button class="btn btn-primary btn-xs">Delete</button>
                                  <div class='clearfix'></div>
                                </div>
                              </td>
                            </tr>
                            <tr>                                    
                              <td>709</td>
                              <td><a class='text-navy' href="">2</a></td>
                              <td><a class='text-navy' href="">3</a></td>
                              <td>4</td>
                              <td>5</td>
                              <td>6</td>
                              <td><a class='text-navy' href="">7</a></td>
                              <td><a class='text-navy' href="">8</a></td>
                              <td><a class='text-navy' href="">9</a></td>
                              <td>10</td>
                              <td>11</td>
                              <td>12</td>
                              <td>
                                <div class='full-width'>
                                  <button class="btn btn-primary btn-xs">View</button>
                                  <button class="btn btn-primary btn-xs">Edit</button>
                                  <button class="btn btn-primary btn-xs">Delete</button>
                                  <div class='clearfix'></div>
                                </div>
                              </td>
                            </tr>
                            <tr>                                    
                              <td>709</td>
                              <td><a class='text-navy' href="">2</a></td>
                              <td><a class='text-navy' href="">3</a></td>
                              <td>4</td>
                              <td>5</td>
                              <td>6</td>
                              <td><a class='text-navy' href="">7</a></td>
                              <td><a class='text-navy' href="">8</a></td>
                              <td><a class='text-navy' href="">9</a></td>
                              <td>10</td>
                              <td>11</td>
                              <td>12</td>
                              <td>
                                <div class='full-width'>
                                  <button class="btn btn-primary btn-xs">View</button>
                                  <button class="btn btn-primary btn-xs">Edit</button>
                                  <button class="btn btn-primary btn-xs">Delete</button>
                                  <div class='clearfix'></div>
                                </div>
                              </td>
                            </tr>
                          </tbody>                     
                        </table>
                      </div>
                      <!-- end table -->

                      <!-- pagination -->
                      <div class='bottom_pagination1 pull-right'>
                        <ul class="pagination m-t-none">
                          <li class="paginate_button previous disabled" aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_previous"><a href="#">Prev</a>
                          </li>
                          <li class="paginate_button active" aria-controls="DataTables_Table_0" tabindex="0"><a href="#">1</a></li>
                          <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0"><a href="#">2</a></li>
                          <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0"><a href="#">3</a></li>
                          <li class="paginate_button next" aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_next"><a href="#">Next</a></li>
                        </ul>
                      </div>
                      <div class='clearfix'></div>
                      <!-- end pagination -->

                    </div>

                  </div>

                </div>

                <br>
                <br>
                <div class="clearfix"></div>
                <div class="footer">
                  <div>
                    <strong>Copyright</strong>© enjin
                  </div>

                </div>

              </div>

            </div>


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
            });
            </script>
            <!-- Chosen -->
            <?php echo $this->Html->script('plugins/chosen/chosen.jquery.js'); ?>

            <!-- JSKnob -->
            <!--<?php echo $this->Html->script('plugins/plugins/jsKnob/jquery.knob.js'); ?>-->

            <!-- Input Mask-->

            <?php echo $this->Html->script('plugins/jasny/jasny-bootstrap.min.js'); ?>

            <!-- Data picker -->

            <?php echo $this->Html->script('plugins/datapicker/bootstrap-datepicker.js'); ?>

            <!-- NouSlider -->
            <!--<script src="js/plugins/nouslider/jquery.nouislider.min.js"></script>-->

            <!-- Switchery -->
            <?php echo $this->Html->script('plugins/switchery/switchery.js'); ?>

            <!-- IonRangeSlider -->
            <?php echo $this->Html->script('plugins/ionRangeSlider/ion.rangeSlider.min.js'); ?>

            <!-- iCheck -->
            <?php echo $this->Html->script('plugins/iCheck/icheck.min.js'); ?>

            <!-- MENU -->
            <?php echo $this->Html->script('plugins/metisMenu/jquery.metisMenu.js'); ?>

            <!-- Color picker -->
            <?php echo $this->Html->script('plugins/colorpicker/bootstrap-colorpicker.min.js'); ?>

            <!-- Clock picker -->
            <?php echo $this->Html->script('plugins/clockpicker/clockpicker.js'); ?>

            <!-- Image cropper -->
            <?php echo $this->Html->script('plugins/cropper/cropper.min.js'); ?>

            <!-- Date range use moment.js same as full calendar plugin -->
            <?php echo $this->Html->script('plugins/fullcalendar/moment.min.js'); ?>

            <!-- Date range picker -->
            <?php echo $this->Html->script('plugins/daterangepicker/daterangepicker.js'); ?>
            <!-- Data Tables -->
            <?php echo $this->Html->script('plugins/jeditable/jquery.jeditable.js'); ?>
            <?php echo $this->Html->script('plugins/dataTables/jquery.dataTables.js'); ?>
            <?php echo $this->Html->script('plugins/dataTables/dataTables.bootstrap.js'); ?>
            <?php echo $this->Html->script('plugins/dataTables/dataTables.responsive.js'); ?>
            <?php echo $this->Html->script('plugins/dataTables/dataTables.tableTools.min.js'); ?>

            <script>
            $(document).ready(function() {
              $('.dataTables-example').dataTable({
                responsive: true,
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                  "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                },
                "bPaginate": false,
                "order":[[1, 'asc']]
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
<style>
.DTTT_container{
  display: none;
}
.dataTables_info{
  display: none;
}
.dataTables_length{
  display: none;
}

.dataTables_filter{
  display: none;
}
</style>
</body>

</html>
