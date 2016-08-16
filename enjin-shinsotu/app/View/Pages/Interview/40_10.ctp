<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Application management</title>

  <?php echo $this->Html->css('bootstrap/bootstrap.min'); ?>
  <?php echo $this->Html->css('font-awesome/css/font-awesome'); ?>
  <?php echo $this->Html->css('plugins/iCheck/custom'); ?>
  <?php echo $this->Html->css('plugins/switchery/switchery'); ?>
  <?php echo $this->Html->css('bootstrap/animate'); ?>
  <?php echo $this->Html->css('bootstrap/style'); ?>
  <?php echo $this->Html->css('enjin/global.group'); ?>
  <?php echo $this->Html->css('enjin/global.code'); ?>
  <?php echo $this->Html->css('enjin/email'); ?>
  <?php echo $this->Html->css('enjin/02_selection.css'); ?>
  <?php echo $this->Html->css('plugins/dataTables/dataTables.bootstrap'); ?>
  <?php echo $this->Html->css('plugins/dataTables/dataTables.responsive'); ?>
  <?php echo $this->Html->css('plugins/dataTables/dataTables.tableTools.min'); ?>
  <?php echo $this->Html->css('plugins/datapicker/datepicker3'); ?>
  <?php echo $this->Html->css('plugins/daterangepicker/daterangepicker-bs3'); ?>
  <?php echo $this->Html->css('plugins/fullcalendar/fullcalendar.css'); ?>


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
  <!-- Chosen -->
  <?php echo $this->Html->script('plugins/chosen/chosen.jquery.js'); ?>
  <!-- JSKnob -->
  <!--<?php echo $this->Html->script('plugins/plugins/jsKnob/jquery.knob.js'); ?>-->
  <!-- Input Mask-->
  <?php echo $this->Html->script('plugins/jasny/jasny-bootstrap.min.js'); ?>
  <!-- Data picker -->
  <?php echo $this->Html->script('plugins/datapicker/bootstrap-datepicker.js'); ?>
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
  <?php echo $this->Html->script('kiwi.js'); ?>

</head>

	<body class="pace-done"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="-webkit-transform: translate3d(100%, 0px, 0px);">
				<div class="pace-progress-inner"></div>
			</div>
			<div class="pace-activity"></div></div>
		<div id="wrapper">
			<nav class="navbar-default navbar-static-side" role="navigation">
				<div class="sidebar-collapse">
					<!--menu recruiter-->
					<ul class="nav metismenu" id="side-menu">
						<li class="nav-header">
						</li>
						<li>
							<a href="/Companies/dashbord">
								<i class="fa fa-th-large"></i>
								<span class="nav-label">ダッシュボード</span>
								<span></span>
							</a>
						</li>
						<li>
							<a href="/SelHistories/index">
								<i class="fa fa-diamond"></i>
								<span class="nav-label">選考管理</span>
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-bar-chart-o"></i>
								<span class="nav-label">イベント管理</span>
								<span class="fa arrow"></span>
							</a>
							<ul class="nav nav-second-level collapse">
								<li><a href="/EvEvents/index">イベントカレンダー</a></li>
								<li><a href="/EvEvents/search">イベント一覧</a></li>
								<li><a href="/EvEvents/add">イベント登録</a></li>
							</ul>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-envelope"></i>
								<span class="nav-label">候補者管理</span>
								<span class="fa arrow"></span>
							</a>
							<ul class="nav nav-second-level collapse">
								<li><a href="/CanCandidates/index">候補者一覧</a></li>
								<li><a href="/CanCandidates/add">候補者登録</a></li>
								<li><a href="/CanCandidates/csv_add">候補者CSV登録</a></li>
							</ul>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-pie-chart"></i>
								<span class="nav-label">求人票管理</span>
								<span class="fa arrow"></span>
							</a>
							<ul class="nav nav-second-level collapse">
								<li><a href="/JobVotes/index">求人票一覧</a></li>
								<li><a href="/JobVotes/add">求人票登録</a></li>
							</ul>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-flask"></i>
								<span class="nav-label">エージェント管理</span>
								<span class="fa arrow"></span>
							</a>
							<ul class="nav nav-second-level collapse">
								<li><a href="/RefererCompanies/index">エージェント企業一覧</a></li>
								<li><a href="/RefererCompanies/add">エージェント企業登録</a></li>
							</ul>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-edit"></i>
								<span class="nav-label">メール送信管理</span>
								<span class="fa arrow"></span>
							</a>
							<ul class="nav nav-second-level collapse">
								<li><a href="/MlSendHistories/">送信履歴</a></li>
								<li><a href="/MailTemplates/">テンプレート</a></li>
							</ul>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-desktop"></i>
								<span class="nav-label">マスタ管理</span>
								<span class="fa arrow"></span>
							</a>
							<ul class="nav nav-second-level collapse">
								<li><a href="/RecDepartments/">自社情報</a></li>
								<li><a href="/ScreeningStages/">選考段階</a></li>
								<li><a href="/RecruitmentAreas/">求人募集エリア</a></li>
								<li><a href="/Schools/index">学校マスタ</a></li>
							</ul>
						</li>
					</ul>
					<!--end menu recruiter-->
				</div>
			</nav>

			<div id="page-wrapper" class="gray-bg" style="min-height: 377px;">
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

				<div id="content-wrapper">
					<link rel="stylesheet" type="text/css" href="/css/enjin/page26_08.css"><link rel="stylesheet" type="text/css" href="/css/plugins/switchery/switchery.css"><div class="row wrapper border-bottom white-bg page-heading">
						<div class="col-lg-10">
							<h2>選考段階</h2>
						</div>
					</div>

					<div class="wrapper wrapper-content animated fadeInRight">
	
						<div class="ibox">
							<div class="ibox-title">
								<h5>選考履歴と採用担当者選考履歴と候補者情報のリスト</h5>
								<div class="ibox-tools">
									<a class="collapse-link">
										<i class="fa fa-chevron-up"></i>
									</a>
								</div>
							</div>
							<div class="ibox-content">
								<h5>採用担者</h5>
								<p>ソリューション営業チーム 根尾　加里矢</p>
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>候補者名</th>
											<th>選考段階</th>
											<th>面接予定日</th>
											<th>2次選考評価</th>
											<th>1次選考評価</th>
											<th>評価</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><a>田中　太朗</a></td>
											<td>3次選考　｜　設定中</td>
											<td>2015/03/04　OK</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>合格</td>
										</tr>
										<tr>
											<td><a>高橋　美咲</a></td>
											<td>3次選考　｜　設定中</td>
											<td>2015/05/06　FIX</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>未評価</td>
										</tr>
									</tbody>
								</table>

								<!-- table -->
							</div>
						</div>
						
						<div class="ibox">
							<div class="ibox-title">
								<h5>選考履歴サマリ</h5>
								<div class="ibox-tools">
									<a class="collapse-link">
										<i class="fa fa-chevron-up"></i>
									</a>
								</div>
							</div>
							<div class="ibox-content">
								<select class="btn btn-white btn-sm toast-bottom-full-width toast-bottom-full-width">
									<option value="1">求人票選択</option>
									<option value="2">求人票選択</option>
									<option value="3">求人票選択</option>
								</select>
									
								<table class="table table-bordered white-bg">
									<tbody>
										<tr>
											<th class="cl-bg-f5f">選考段階</th>
											<th colspan="3" class="cl-bg-f5f">書類選考</th>
											<th colspan="3" class="cl-bg-f5f">1次選考</th>
											<th colspan="3" class="cl-bg-f5f">2 次選考</th>
											<th colspan="3" class="cl-bg-f5f">3 次次選</th>
											<th colspan="3" class="cl-bg-f5f">4 次選考</th>
											<th colspan="3" class="cl-bg-f5f">最終選考</th>
										</tr>
                                      
                                      
                                      
										<tr>
											<th rowspan="2" class="cl-bg-f5f td-vertical-align">実数</th>
											<th class="cl-bg-f9f">合格</th>
											<th class="cl-bg-f9f">不合格</th>
											<th class="cl-bg-f9f">その他</th>
											<th class="cl-bg-f9f">合格</th>
											<th class="cl-bg-f9f">不合格</th>
											<th class="cl-bg-f9f">その他</th>
											<th class="cl-bg-f9f">合格</th>
											<th class="cl-bg-f9f">不合格</th>
											<th class="cl-bg-f9f">その他</th>
											<th class="cl-bg-f9f">合格</th>
											<th class="cl-bg-f9f">不合格</th>
											<th class="cl-bg-f9f">その他</th>
											<th class="cl-bg-f9f">合格</th>
											<th class="cl-bg-f9f">不合格</th>
											<th class="cl-bg-f9f">その他</th>
											<th class="cl-bg-f9f">合格</th>
											<th class="cl-bg-f9f">不合格</th>
											<th class="cl-bg-f9f">その他</th>
										</tr>
										<tr>
											<td class="text-cl18a"><a href="">20</a></td>
											<td class="text-cl18a"><a href="">10</a></td>
											<td class="text-cl18a"><a href="">0</a></td>
											<td class="text-cl18a"><a href="">20</a></td>
											<td class="text-cl18a"><a href="">6</a></td>
											<td class="text-cl18a"><a href="">1</a></td>
											<td class="text-cl18a"><a href="">10</a></td>
											<td class="text-cl18a"><a href="">7</a></td>
											<td class="text-cl18a"><a href="">0</a></td>
											<td class="text-cl18a"><a href="">10</a></td>
											<td class="text-cl18a"><a href="">0</a></td>
											<td class="text-cl18a"><a href="">0</a></td>
											<td class="text-cl18a"><a href="">0</a></td>
											<td class="text-cl18a"><a href="">0</a></td>
											<td class="text-cl18a"><a href="">0</a></td>
											<td class="text-cl18a"><a href="">0</a></td>
											<td class="text-cl18a"><a href="">0</a></td>
											<td class="text-cl18a"><a href="">10</a></td>
										</tr>
									</tbody>
								</table>

								<!-- table -->
							</div>
						</div>
						
						<div class="ibox">
							<div class="ibox-title">
								<h5>選考履歴と採用担当者選考履歴と候補者情報のリスト</h5>
								<div class="ibox-tools">
									<a class="collapse-link">
										<i class="fa fa-chevron-up"></i>
									</a>
								</div>
							</div>
							
							<div class="ibox-content">
											<div class="row">
												<div class="col-md-6">
													<div class="table-responsive">
														<table class="table table-striped">
															<tbody>
																<tr>
																	<th>面接官</th>               
																	<th>選考通過</th>
																	<th>不合格者</th>
																	<th>最終選考通過率</th>
																	<th>内定辞退</th>
																</tr>
																<tr>
																	<td>梅原　洸太</td>
																	<td>20</td>
																	<td>8</td>
																	<td><span>8</span>／20　40.0％</td>
																	<td><span>5</span>／8</td>
																</tr>
																<tr>
																	<td>丹野　優華</td>
																	<td>10</td>
																	<td>5</td>
																	<td><span>3</span>／10　30.0%</td>
																	<td><span>2</span>／3</td>
																</tr>
																<tr>
																	<td>根尾　加里矢</td>
																	<td>30</td>
																	<td>10</td>
																	<td><span>4</span>／30　13.3%</td>
																	<td><span>1</span>／4</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
												<div class="col-md-6">
												
												
												<table class="table border-none">
															<tbody>
																<tr>
																	<td colspan="2">最終選考通過率グラフ</td>
																</tr>
																<tr>
																	<td class="col-md-3"><a href="">梅原　洸太</a></td>
																	<td><div class="progress bg_dgrey m-l-m15" style="width: 100%;">
															<div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar bg_grey">
																<span class="sr-only">40% Complete</span>
															</div>
														</div></td>
																</tr>
																<tr>
																	<td class="col-md-3"><a href="">丹野　優華</a></td>
																	<td><div class="progress bg_dgrey m-l-m15" style="width: 100%;">
															<div style="width: 30%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="30" role="progressbar" class="progress-bar bg_grey">
																<span class="sr-only">30% Complete</span>
															</div>
														</div></td>
																</tr>
																<tr>
																	<td class="col-md-3"><a href="">根尾　加里矢</a></td>
																	<td><div class="progress bg_dgrey m-l-m15" style="width: 100%;">
															<div style="width: 13.3%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="13.3" role="progressbar" class="progress-bar bg_grey">
																<span class="sr-only">13.3% Complete</span>
															</div>
														</div></td>
																</tr>
															</tbody>
														</table>
												
												</div>
											</div>
										</div>
						</div>
						
						<div class="ibox">
							<div class="ibox-title">
								<h5>運営からのメッセージ</h5>
								<div class="ibox-tools">
									<a class="collapse-link">
										<i class="fa fa-chevron-up"></i>
									</a>
								</div>
							</div>
							
							<div class="ibox-content clearfix">
								<div class="fl w100">
									 <?php echo $this->Html->image("/img/bootstrap/icon_avatar.png", array("alt" => "logo", 'width'=>'100%')); ?>
								</div>
								<div class="fl">
									<h3>システムメンテナンスが終わりました。</h3>
									<p>2015/07/21　14:20</p>
									<p class="m-t-20">システムメンテナンスが完了いたしました。<br>お手数ですが一旦ログアウトしていただき、再ログインしていただきますようお願いいたします。
	</p>
								</div>
							</div>
							
							<div class="ibox-content clearfix">
								<div class="fl w100">
									<?php echo $this->Html->image("/img/bootstrap/icon_avatar.png", array("alt" => "logo", 'width'=>'100%')); ?>
								</div>
								<div class="fl">
									<h3>システムメンテナンスが終わりました。</h3>
									<p>2015/07/21　14:20</p>
									<p class="m-t-20">システムメンテナンスが完了いたしました。<br>お手数ですが一旦ログアウトしていただき、再ログインしていただきますようお願いいたします。
	</p>
								</div>
							</div>
							
							<div class="ibox-content clearfix">
								<div class="fl w100">
									<?php echo $this->Html->image("/img/bootstrap/icon_avatar.png", array("alt" => "logo", 'width'=>'100%')); ?>
								</div>
								<div class="fl">
									<h3>システムメンテナンスが終わりました。</h3>
									<p>2015/07/21　14:20</p>
									<p class="m-t-20">システムメンテナンスが完了いたしました。<br>お手数ですが一旦ログアウトしていただき、再ログインしていただきますようお願いいたします。
	</p>
								</div>
							</div>
							
							<div class="ibox-content txt-align">
								<button class="btn btn-primary w50per">もっと読む</button>
							</div>
						</div>
						
					</div><!-- end box .wrapper-content -->
				</div>
  
				<div class="footer">
					<div>
						<strong>Copyright</strong> Enjin Company © 2015
					</div>
				</div>

			</div>
			<!--end #page-wrapper-->
		</div>
		<!-- end #wrapper -->
	
	</body></html>