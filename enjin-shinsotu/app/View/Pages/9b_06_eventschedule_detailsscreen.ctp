<!DOCTYPE html>
<html>

<head>
	<?php echo $this->Html->charset('utf-8'); ?> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>求人票管理 − 求人詳細</title>

	<?php echo $this->Html->css('enjin/animate'); ?>
	<?php echo $this->Html->css('bootstrap/bootstrap.min'); ?>
	<?php echo $this->Html->css('font-awesome/css/font-awesome'); ?>
	<?php echo $this->Html->css('plugins/iCheck/custom'); ?>
	<?php echo $this->Html->css('bootstrap/style'); ?>
	<?php echo $this->Html->css('enjin/global'); ?>
	<?php echo $this->Html->css('enjin/email'); ?>

	<?php echo $this->Html->css('plugins/fullcalendar/fullcalendar.css'); ?>
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

									<div class="wrapper wrapper-content row animated fadeInRight clearfix"> 

										<!-- イベント情報 -->
										<div class='full-content'>
											<div class='col-lg-6'>
												<div class="ibox">
													<div class="ibox-title">
														<h5>イベント情報</h5>      
														<div class="ibox-tools">
															<button type="button" id="show-fr-edit" class="show-data btn btn-primary btn-xs">編集</button> 
														</div>                           
													</div>
													<div class="ibox-content bg-white p-sm clearfix show-data">
														<div class="col-lg-12 form-edit">
															<form method="get" class="form-horizontal">

																<div class="form-group">
																	<label class="col-sm-4 control-label">イベント名</label>
																	<div class="col-sm-8">
																		<input type='text' class='form-control'>
																	</div>
																</div>

																<div class="form-group">
																	<label class="col-sm-4 control-label">求人票ID</label>
																	<div class="col-sm-8">
																		<div class="no-borders ver-mid btn-group btn-block">
																			<button data-toggle="dropdown" class="btn btn-white btn-sm dropdown-toggle btn-block t-align-left">2016年新卒・営業<span class="caret sl-btn"></span></button>
																			<ul class="dropdown-menu">
																				<li><a href="#">2016年新卒・営業</a></li>
																				<li><a href="#">2016年新卒・営業</a></li>        
																			</ul>
																		</div>
																	</div>
																</div>

																<div class="form-group">
																	<label class="col-sm-4 control-label">イベント種別</label>
																	<div class="col-sm-8">
																		<div class="no-borders ver-mid btn-group btn-block">
																			<button data-toggle="dropdown" class="btn btn-white btn-sm dropdown-toggle btn-block t-align-left">説明会<span class="caret sl-btn"></span></button>
																			<ul class="dropdown-menu">
																				<li><a href="#">説明会</a></li>
																				<li><a href="#">説明会</a></li>        
																			</ul>
																		</div>
																	</div>
																</div>

																<div class="form-group">
																	<label class="col-sm-4 control-label">ターゲット選考段階ID</label>
																	<div class="col-sm-8">
																		<div class="no-borders ver-mid btn-group btn-block">
																			<button data-toggle="dropdown" class="btn btn-white btn-sm dropdown-toggle btn-block t-align-left">1次選考<span class="caret sl-btn"></span></button>
																			<ul class="dropdown-menu">
																				<li><a href="#">1次選考</a></li>
																				<li><a href="#">1次選考</a></li>        
																			</ul>
																		</div>
																	</div>
																</div>

																<div class="form-group">
																	<label class="col-sm-4 control-label">ターゲット選考段階比較タイプ</label>
																	<div class="col-sm-8">
																		<div class="no-borders ver-mid btn-group btn-block">
																			<button data-toggle="dropdown" class="btn btn-white btn-sm dropdown-toggle btn-block t-align-left">以前<span class="caret sl-btn"></span></button>
																			<ul class="dropdown-menu">
																				<li><a href="#">以前</a></li>
																				<li><a href="#">以前</a></li>        
																			</ul>
																		</div>
																	</div>
																</div>

																<div class="form-group">
																	<label class="col-sm-4 control-label">ターゲット選考ステータス （（マスタ））</label>
																	<div class="col-sm-8">
																		<div class="no-borders ver-mid btn-group btn-block">
																			<button data-toggle="dropdown" class="btn btn-white btn-sm dropdown-toggle btn-block t-align-left">ステータス選択<span class="caret sl-btn"></span></button>
																			<ul class="dropdown-menu">
																				<li><a href="#">ステータス選択</a></li>
																				<li><a href="#">ステータス選択</a></li>        
																			</ul>
																		</div>
																	</div>
																</div>

																<div class="form-group">
																	<label class="col-sm-4 control-label">イベント内容</label>
																	<div class="col-sm-8">
																		<input type='text' class='form-control' value='1次選考候補者向け'>
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-4 control-label">リクナビID</label>
																	<div class="col-sm-8">
																		<input type='text' class='form-control'>
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-4 control-label">マイナビID</label>
																	<div class="col-sm-8">
																		<input type='text' class='form-control'>
																	</div>
																</div>    
																<div class='upload_content'>
																	<a class='text-navy' href="">キャンセル</a>
																	<button class='btn btn-sm btn-primary w-75'>更新</button>
																</div>
															</form>
														</div>
													</div>
												</div>

												<div class='clear'></div>
											</div> 
										</div>
										<!-- end イベント情報 -->

										<!-- footer -->
										<div class="footer">
											<div>
												<strong>Copyright</strong>© enjin
											</div>
										</div>
										<!-- end footer -->

									</div>
								</div>

							</div>

						</div>   

					</div>


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



				</body>

				</html>
