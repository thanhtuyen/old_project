<?php
/*edited by [V]*/
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset('utf-8'); ?> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ダッシュボード</title>
	<?php echo $this->Html->css('bootstrap/bootstrap.min'); ?>
	<?php echo $this->Html->css('font-awesome/css/font-awesome'); ?>
	<?php echo $this->Html->css('plugins/iCheck/custom'); ?>
	<?php echo $this->Html->css('bootstrap/animate'); ?>
	<?php echo $this->Html->css('bootstrap/style'); ?>
	<?php echo $this->Html->css('enjin/global'); ?>
	<?php echo $this->Html->css('plugins/fullcalendar/fullcalendar.css'); ?>
	<?php echo $this->Html->css('bootstrap/dashboard_08'); ?>
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
							<div class="navbar-header">
								<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
							</div>
							<div class="nav navbar-top-links navbar-right logo_enjin">
								<?php echo $this->Html->image("bootstrap/logo_enjin.png", array(
									"alt" => "logo",
									)); ?>
								</div>
								<div class="select_option">
                  <select id="select" name="select">
                    <option value="1">2016</option>
                    <option value="2">2017</option>
                    <option value="3">2018</option>
                  </select>
                </div>
							</nav>
						</div>
						<div class="wrapper wrapper-content animated fadeInRight">
							<h2 class="page-heading">選考履歴サマリ</h2>
							<div class="ibox-content">
								<select class="btn btn-white btn-sm">
									<option value="1">求人票選択</option>
									<option value="2">求人票選択</option>
									<option value="3">求人票選択</option>
								</select>
								<div class="table-responsive">
									<table class="table table-striped">
										<tbody>
											<tr>
												<th>選考段階</th>
												<th colspan="3">書類選考</th>               
												<th colspan="3">1次選考</th>
												<th colspan="3">2 次選考</th>
												<th colspan="3">3 次次選</th>
												<th colspan="3">4 次選考</th>
												<th colspan="3">最終選考</th>
											</tr>
											<tr>
												<td rowspan="3">目標</td>
												<td colspan="9" class="">5月 1 日 ま でに2次選考以下の 合格者を 50名　現在50名</td>
												<td colspan="3">&nbsp;</td>
												<td colspan="3">&nbsp;</td>
												<td colspan="3">&nbsp;</td>
											</tr>
											<tr>
												<td colspan="3">&nbsp;</td>
												<td colspan="3">&nbsp;</td>
												<td colspan="12" class="bg_pink">5月3日までに3次選考以上の合格者を30名　現在<span class="color_red">40</span>名</td>
											</tr>
											<tr>
												<td colspan="3">&nbsp;</td>
												<td colspan="3">&nbsp;</td>
												<td colspan="3">&nbsp;</td>
												<td colspan="3">&nbsp;</td>
												<td colspan="3">&nbsp;</td>
												<td colspan="3" class="bg_lorange text-justify">5月10日までに最終選考の合格<br>
													者を5名　　現在<span class="color_red">0</span>名</td>
												</tr>
												<tr class="text-nowrap">
													<th rowspan="2">実数</th>
													<td>合格</td>
													<td>不合格</td>
													<td>その他</td>
													<td>合格</td>
													<td>不合格</td>
													<td>その他</td>
													<td>合格</td>
													<td>不合格</td>
													<td>その他</td>
													<td>合格</td>
													<td>不合格</td>
													<td>その他</td>
													<td>合格</td>
													<td>不合格</td>
													<td>その他</td>
													<td>合格</td>
													<td>不合格</td>
													<td>その他</td>
												</tr>
												<tr>
													<td>20</td>
													<td>10</td>
													<td>0</td>
													<td>20</td>
													<td>5</td>
													<td>1</td>
													<td>10</td>
													<td>7</td>
													<td>0</td>
													<td>20</td>
													<td>0</td>
													<td>0</td>
													<td>0</td>
													<td>0</td>
													<td>0</td>
													<td>0</td>
													<td>0</td>
													<td>0</td>
												</tr>

											</tbody>
										</table>
									</div>
								</div>
								<!-------------------------->
								<h5>候補者属性別x選考履歴&イベント統計情報</h5>
								<div class="ibox-content">
									<label for="">選考履歴別</label>
									<select class="btn btn-white btn-sm toast-bottom-full-width toast-bottom-full-width">
										<option value="1">求人票選択</option>
										<option value="2">求人票選択</option>
										<option value="3">求人票選択</option>
									</select>

									<div class="table-responsive">
										<table class="table table-striped">
											<tbody>
												<tr>
													<th></th>
													<th colspan="3">書類選考</th>								
													<th colspan="3">１次選考</th>
													<th colspan="3">２ 次選考</th>
													<th colspan="3">３ 次次選</th>
													<th colspan="3">４ 次選考</th>
													<th colspan="3">最終選考</th>
												</tr>
												<tr>
													<th>ステータス</th>
													<td>合格</td>
													<td>不合格</td>
													<td>その他</td>

													<td></td>
													<td></td>
													<td></td>

													<td></td>
													<td></td>
													<td></td>

													<td></td>
													<td></td>
													<td></td>

													<td></td>
													<td></td>
													<td></td>

													<td></td>
													<td></td>
													<td></td>
												</tr>
												<tr>
													<th>英語</th>
													<td>32</td>
													<td>−</td>
													<td>−</td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
												<tr>
													<th>中国語</th>
													<td>10</td>
													<td>−</td>
													<td>−</td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
												<tr>
													<th>フランス語</th>
													<td>2</td>
													<td>−</td>
													<td>−</td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
												<tr>
													<th>その他</th>
													<td>7</td>
													<td>−</td>
													<td>−</td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
											</tbody>
										</table>
									</div>
									<label class="m-t" for="">イベント参加別</label>
									<select class="btn btn-white btn-sm toast-bottom-full-width toast-bottom-full-width">
										<option value="1">求人票選択</option>
										<option value="2">求人票選択</option>
										<option value="3">求人票選択</option>
									</select>

									<div class="table-responsive">
										<table class="table table-striped">
											<tbody><tr>
												<th></th>
												<th>来た</th>
												<th>来てない</th>
												<th>無断欠勤</th>
											</tr>
											<tr class="bg_grey">
												<th>英語</th>
												<td>103</td>
												<td>37</td>
												<td>3</td>
											</tr>
											<tr>
												<th>中国語</th>
												<td>21</td>
												<td>5</td>
												<td>1</td>
											</tr>
											<tr>
												<th>フランス語</th>
												<td>8</td>
												<td>0</td>
												<td>0</td>
											</tr>
											<tr>
												<th>その他</th>
												<td>13</td>
												<td>0</td>
												<td>3</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<!-------------------------->
							<h5>選考履歴と採用担当者選考履歴と候補者情報のリスト</h5>
							<div class="ibox-content">
								<label for="">採用担者</label><br>
								<select class="btn btn-white btn-sm toast-bottom-full-width toast-bottom-full-width">
									<option value="1">ソリューション営業チーム</option>
									<option value="2">ソリューション営業チーム</option>
									<option value="3">ソリューション営業チーム</option>
								</select>
								<select class=" ">
									<option value="1">根尾　加里矢</option>
									<option value="2">根尾　加里矢</option>
									<option value="3">根尾　加里矢</option>
								</select>

								<div class="table-responsive">
									<table class="table table-striped">
										<tbody>
											<tbody>
												<tr>
													<th>候補者名</th>
													<th>選考段階</th>               
													<th>面接予定日</th>
													<th>2次選考評価</th>
													<th>1次選考評価</th>
													<th>評価</th>
												</tr>
												<tr>
													<td>田中　太朗</td>
													<td>3次選考　｜　設定中</td>
													<td>2015/03/04　OK</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>合格</td>
												</tr>
												<tr>
													<td>高橋　美咲</td>
													<td>2次選考　｜　設定済 </td>
													<td>済 2015/05/06　FIX</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>未評価</td>
												</tr>
											</tbody>
										</table>
									</div>
									<!-------------------------->
									<h5>　　イベント評価後スコア別　　候補者x選考履歴リストアップ</h5>
									<div class="ibox-content">
										<div class="row">
											<div class="col-md-2">
												<label for="">イベント</label><br>
												<select class="btn btn-white btn-sm toast-bottom-full-width">
													<option value="1">第一回会社説明会</option>
													<option value="2">第一回会社説明会</option>
													<option value="3">第一回会社説明会</option>
												</select>
											</div>
											<div class="col-md-1">
												<label for="">評価</label><br>
												<select class=" ">
													<option value="1">全て</option>
													<option value="2">全て</option>
													<option value="3">全て</option>
												</select>
											</div>
											<div class="col-md-2">
												<label for="">選考履歴</label><br>
												<select class="btn btn-white btn-sm toast-bottom-full-width">
													<option value="1">あり</option>
													<option value="2">あり</option>
													<option value="3">あり</option>
												</select>
											</div>
										</div>

										<div class="row">
											<div class="col-md-2">
												<select class="btn btn-white btn-sm toast-bottom-full-width">
													<option value="1">チェックのみ</option>
													<option value="2">チェックのみ</option>
													<option value="3">チェックのみ</option>
												</select>
											</div>
											<div class="col-md-2">
												<button  class="btn btn-primary btn-xs" type="submit">メール</button>
											</div>
										</div>

										<div class="table-responsive">
											<table class="table table-striped">
												<tbody>
													<tr>
														<th>
															<div class="i-checks"><label> <input type="checkbox" value="" > <i></i></label></div>
														</th>
														<th>候補者名</th>               
														<th>評価</th>
														<th>選考履歴</th>
													</tr>
													<tr>
														<td>
															<div class="i-checks"><label> <input type="checkbox" value="" > <i></i></label></div>
														</td>
														<td>田中　太朗</td>
														<td>最高</td>
														<td>2次　｜　合格</td>
													</tr>
													<tr>
														<td>
															
														</td>
														<td>高橋　美咲</td>
														<td>低</td>
														<td>2次　｜　不合格</td>
													</tr>
												</tbody>
											</table>
										</div>
										<!-------------------------->
										<h5>採用担当者別　　最終選考通過率リスト</h5>
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
												<div class="col-md-6 h31-c">
													<label for="">最終選考通過率グラフ</label><br>
													<div class="col-md-3 color_text">
														梅原　洸太
													</div>
													<div class="col-md-9">
														<div class="progress bg_dgrey m0">
															<div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar bg_grey">
																<span class="sr-only">40% Complete</span>
															</div>
														</div>
													</div>
													<div class="col-md-3 color_text">
														丹野　優華
													</div>
													<div class="col-md-9">
														<div class="progress bg_dgrey m0">
															<div style="width: 30%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="30" role="progressbar" class="progress-bar bg_grey">
																<span class="sr-only">30% Complete</span>
															</div>
														</div>
													</div>
													<div class="col-md-3 color_text">
														根尾　加里矢
													</div>
													<div class="col-md-9">
														<div class="progress bg_dgrey m0">
															<div style="width: 13.3%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="13.3" role="progressbar" class="progress-bar bg_grey">
																<span class="sr-only">13.3% Complete</span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-------------------------->
										<h5>イベント参加履歴リスト</h5>
										<div class="ibox-content">
											<label for="">イベント</label><br>
											<select class="btn btn-white btn-sm toast-bottom-full-width">
												<option value="1">全て</option>
												<option value="2">全て</option>
												<option value="3">全て</option>
											</select>

											<div class="table-responsive">
												<table class="table table-striped">
													<tbody>
														<tr>
															<th>イベント</th>
															<th>日程</th>               
															<th>開催場所</th>
															<th>予約中</th>
															<th>参加申込済</th>
															<th>キャンセル</th>
															<th>欠席</th>
														</tr>
														<tr>
															<td rowspan="3" class="bg_white va-m">会社説明会</td>
															<td>2015/03/04</td>
															<td>東京</td>
															<td>3</td>
															<td>8</td>
															<td>2</td>
															<td>4</td>
														</tr>
														<tr>
															<td>2015/03/05</td>
															<td>神奈川</td>
															<td>8</td>
															<td>15</td>
															<td>1</td>
															<td>5</td>
														</tr>
														<tr>
															<td>2015/03/06</td>
															<td>北海道</td>
															<td>2</td>
															<td>6</td>
															<td>3</td>
															<td>2</td>
														</tr>
														<tr>
															<td>セミナー</td>
															<td>2015/03/10</td>
															<td>東京</td>
															<td>6</td>
															<td>21</td>
															<td>10</td>
															<td>1</td>
														</tr>
													</tbody>
												</table>
											</div>
											<!-------------------------->
											<h5>イベントスケジュールと出欠簿</h5>
											<div class="ibox-content">
												<div class="row">
													<div class="col-md-2">
														<label for="">イベント</label><br>
														<select class="btn btn-white btn-sm toast-bottom-full-width">
															<option value="1">第一回会社説明会</option>
															<option value="2">第一回会社説明会</option>
															<option value="3">第一回会社説明会</option>
														</select>
													</div>
													<div class="col-md-5">
														<label for="">開催日程</label><br>
														<select class="btn btn-white btn-sm toast-bottom-full-width">
															<option value="1">2015年5月20日　14:00 - 2015年5月20日　16:00</option>
															<option value="2">2015年5月20日　14:00 - 2015年5月20日　16:00</option>
															<option value="3">2015年5月20日　14:00 - 2015年5月20日　16:00</option>
														</select>
													</div>
													<div class="col-md-1">
														<br><button  class="btn btn-primary btn-xs" type="submit">印刷</button>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<div class="b">イベント名</div>
														<div>第一回会社説明会</div>
														<br>
														<div class="b">開催日時</div>
														<div>開始：2015年5月20日　14:00</div>
														<div>終了：2015年5月20日　16:00</div>
														<br>
														<div class="b">開催場所</div>
														<div>本社第2会議室</div>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<table class="table table-striped">
																<tbody>
																	<tr>
																		<th>候補者名</th>
																		<th>大学</th>               
																		<th>メール</th>
																		<th>電話</th>
																		<th>ステータス</th>
																	</tr>
																	<tr>
																		<td>田中　太朗</td>
																		<td>T大学</td>
																		<td>t-taro@gmail.com</td>
																		<td>090xxxxxxxx</td>
																		<td>出席</td>
																	</tr>
																	<tr>
																		<td>高橋　美咲</td>
																		<td>W大学</td>
																		<td>misamisa-0214@docomo.jp</td>
																		<td>090xxxxxxxx</td>
																		<td>キャンセル</td>
																	</tr>
																	<tr>
																		<td>太田　希美</td>
																		<td>A学院</td>
																		<td>ota-nozomi-1992@nifty.ne.jp</td>
																		<td>090xxxxxxxx</td>
																		<td>欠席</td>
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
											<!-------------------------->
											<div class="">イベントカレンダー</div>
											<div class="ibox-content">
												<div class="row">

													<div id="calendar"></div>
												</div>
											</div>
											<!-------------------------->
											<h5>定員割れイベント開催日程リスト&アラート</h5>
											<div class="ibox-content">
												<div class="table-responsive">
													<table class="table table-striped">
														<tbody>
															<tr>
																<th>イベント名</th>
																<th>開催日</th>
																<th>応募締切日</th>
																<th>定員</th>
																<th>申込数</th>
																<th>ターゲット</th>
																<th>ターゲットステータス</th>
															</tr>
															<tr>
																<td>就職説明会</td>
																<td>2015/09/20</td>
																<td>2015/09/10</td>
																<td>20</td>
																<td class="bg_white color_red">10</td>
																<td>3次選考</td>
																<td>合格者</td>
															</tr>
															<tr>
																<td>内定者向けセミナー</td>
																<td>2015/09/20</td>
																<td>2015/09/10</td>
																<td>10</td>
																<td class="bg_white color_red">5</td>
																<td>内定者</td>
																<td>内定者</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
											<!-------------------------->
											<h5>媒体別 申込数と採用率</h5>
											<div class="ibox-content">
												<div class="row">
													<div class="col-md-2 b">流入元</div>
													<div class="col-md-1 b">申込数</div>
													<div class="col-md-1 b">採用数</div>
													<div class="col-md-1 b">採用率</div>
													<div class="col-md-7"></div>
												</div>

												<div class="row">
													<div class="col-md-2">トータル</div>
													<div class="col-md-1 color_blue">100</div>
													<div class="col-md-1 color_blue">5</div>
													<div class="col-md-1 color_blue">5%</div>
													<div class="col-md-7">
														<div class="progress bg_dgrey -xs">
															<div style="width: 5%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg_grey">
																<span class="sr-only">5% Complete</span>
															</div>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-2">マイナビ</div>
													<div class="col-md-1 color_blue">25</div>
													<div class="col-md-1 color_blue">1</div>
													<div class="col-md-1 color_blue">4%</div>
													<div class="col-md-7">
														<div class="progress bg_dgrey -xs">
															<div style="width: 4%" aria-valuemax="25" aria-valuemin="0" aria-valuenow="4" role="progressbar" class="progress-bar bg_grey">
																<span class="sr-only">4% Complete</span>
															</div>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-2">リクナビ</div>
													<div class="col-md-1 color_blue">25</div>
													<div class="col-md-1 color_blue">1</div>
													<div class="col-md-1 color_blue">4%</div>
													<div class="col-md-7">
														<div class="progress bg_dgrey -xs">
															<div style="width: 4%" aria-valuemax="25" aria-valuemin="0" aria-valuenow="4" role="progressbar" class="progress-bar bg_grey">
																<span class="sr-only">4% Complete</span>
															</div>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-2">自社</div>
													<div class="col-md-1 color_blue">20</div>
													<div class="col-md-1 color_blue">2</div>
													<div class="col-md-1 color_blue">10%</div>
													<div class="col-md-7">
														<div class="progress bg_dgrey -xs">
															<div style="width: 10%" aria-valuemax="20" aria-valuemin="0" aria-valuenow="10" role="progressbar" class="progress-bar bg_grey">
																<span class="sr-only">10% Complete</span>
															</div>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-2">就職ナビ</div>
													<div class="col-md-1 color_blue">5</div>
													<div class="col-md-1 color_blue">0</div>
													<div class="col-md-1 color_blue">0%</div>
													<div class="col-md-7">
														<div class="progress bg_dgrey -xs">
															<div style="width: 0%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="0" role="progressbar" class="progress-bar bg_grey">
																<span class="sr-only">0% Complete</span>
															</div>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-2">はたらいく</div>
													<div class="col-md-1 color_blue">5</div>
													<div class="col-md-1 color_blue">0</div>
													<div class="col-md-1 color_blue">0%</div>
													<div class="col-md-7">
														<div class="progress bg_dgrey -xs">
															<div style="width: 0%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="0" role="progressbar" class="progress-bar bg_grey">
																<span class="sr-only">0% Complete</span>
															</div>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-2">その他</div>
													<div class="col-md-1 color_blue">20</div>
													<div class="col-md-1 color_blue">1</div>
													<div class="col-md-1 color_blue">10%</div>
													<div class="col-md-7">
														<div class="progress bg_dgrey -xs">
															<div style="width: 10%" aria-valuemax="20" aria-valuemin="0" aria-valuenow="10" role="progressbar" class="progress-bar bg_grey">
																<span class="sr-only">10% Complete</span>
															</div>
														</div>
													</div>
												</div>
											</div>
											<!-------------------------->
											<h5>求人票別採用コスト</h5>
											<div class="ibox-content">
												<div class="table-responsive">
													<table class="table table-striped">
														<tbody>
															<tr>
																<th>求人票</th>
																<th>内定数</th>
																<th>固定契約</th>
																<th>年収割合契約</th>
																<th>年間契約</th>
																<th>ナビ代</th>
																<th>メールマガジン代</th>
																<th>トータル</th>
															</tr>
															<tr>
																<td>2016年新卒・営業</td>
																<td>5</td>
																<td>300万（3）</td>
																<td>50万（1）</td>
																<td>100万（1）</td>
																<td>100万</td>
																<td>50万</td>
																<td>600万</td>
															</tr><tr>
															<td>2016年新卒・技術 </td>
															<td>2</td>
															<td>200万（2）</td>
															<td>0</td>
															<td>0</td>
															<td>0</td>
															<td>0</td>
															<td>200万</td>
														</tr><tr>
														<td>2016年新卒・一般</td>
														<td>3</td>
														<td>0</td>
														<td>150万（3）</td>
														<td>0</td>
														<td>100万</td>
														<td>0</td>
														<td>250万</td>
													</tr>
												</tbody>
											</table>
										</div>
										<!-------------------------->
										<h5>求人票別　　流入元企業割当リスト</h5>
										<div class="ibox-content">
											<div class="row">
												<div class="col-md-3">
													<label for="">求人票</label><br>
													<select class="btn btn-white btn-sm toast-bottom-full-width">
														<option value="1">2016年新卒・営業</option>
														<option value="2">2016年新卒・営業</option>
														<option value="3">2016年新卒・営業</option>
													</select>
												</div>
											</div>

											<div class="row">
												<div class="col-md-2">
													<select class="btn btn-white btn-sm toast-bottom-full-width">
														<option value="1">チェックのみ</option>
														<option value="2">チェックのみ</option>
														<option value="3">チェックのみ</option>
													</select>
												</div>
												<div class="col-md-2">
													<button  class="btn btn-primary btn-xs" type="submit">メール</button>
												</div>
											</div>

											<div class="table-responsive">
												<table class="table table-striped">
													<tbody>
														<tr>
															<th>流入元</th>               
															<th colspan="3">書類選考</th>
															<th colspan="3">1次選考</th>
															<th colspan="3">2次選考</th>
															<th>割当</th>
															<th>メール送信</th>
														</tr>
														<tr>
															<td>&nbsp;</td>

															<td>合格</td>
															<td>不合格</td>
															<td>その他</td><!--//-->
															<td>合格</td>
															<td>不合格</td>
															<td>その他</td><!--//-->
															<td>合格</td>
															<td>不合格</td>
															<td>その他</td><!--//-->

															<td>&nbsp;</td>
															<td>&nbsp;</td>
														</tr>

														<tr>
															<td>マイナビ</td>

															<td>10</td>
															<td>20</td>
															<td>0</td><!--//-->
															<td>10</td>
															<td>20</td>
															<td>0</td><!--//-->
															<td>10</td>
															<td>20</td>
															<td>0</td><!--//-->

															<td>済</td>
															<td>
																<div class="i-checks"><label> <input type="checkbox" value="" > <i></i></label></div>
															</td>
														</tr><tr>
														<td>リクナビ</td>

														<td>10</td>
														<td>20</td>
														<td>0</td><!--//-->
														<td>10</td>
														<td>20</td>
														<td>0</td><!--//-->
														<td>10</td>
														<td>20</td>
														<td>0</td><!--//-->

														<td>済</td>
														<td>
															<div class="i-checks"><label> <input type="checkbox" value="" > <i></i></label></div>
														</td>
													</tr><tr>
													<td>就職ナビ</td>

													<td>10</td>
													<td>10</td>
													<td>2</td><!--//-->
													<td>10</td>
													<td>10</td>
													<td>2</td><!--//-->
													<td>10</td>
													<td>10</td>
													<td>2</td><!--//-->

													<td><button class="btn btn-primary btn-xs">割り当てる</button></td>
													<td>
														<div class="i-checks"><label> <input type="checkbox" value="checked" > <i></i></label></div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
				<!--<table class="table">
					<tbody>
						<tr>
							<th>流入元</th>               
							<th>書類選考</th>
							<th>1次選考</th>
							<th>2次選考</th>
							<th>割当</th>
							<th>メール送信</th>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td class="bg_white hasTbl" rowspan="4">
							<table class="table">
								<tbody>
									<tr>
										<th>合格</th>
										<th>不合格</th>
										<th>その他</th>
									</tr>
									<tr>
										<td>10</td>
										<td>20</td>
										<td>0</td>
									</tr><tr>
										<td>10</td>
										<td>20</td>
										<td>0</td>
									</tr><tr>
										<td>10</td>
										<td>10</td>
										<td>2</td>
									</tr>
								</tbody>
							</table>
							</td>
							<td class="bg_white hasTbl" rowspan="4">
							<table class="table">
								<tbody>
									<tr>
										<th>合格</th>
										<th>不合格</th>
										<th>その他</th>
									</tr>
									<tr>
										<td>10</td>
										<td>20</td>
										<td>0</td>
									</tr><tr>
										<td>10</td>
										<td>20</td>
										<td>0</td>
									</tr><tr>
										<td>10</td>
										<td>10</td>
										<td>2</td>
									</tr>
								</tbody>
							</table>
							</td>
							<td class="bg_white hasTbl" rowspan="4">
							<table class="table">
								<tbody>
									<tr>
										<th>合格</th>
										<th>不合格</th>
										<th>その他</th>
									</tr>
									<tr>
										<td>10</td>
										<td>20</td>
										<td>0</td>
									</tr><tr>
										<td>10</td>
										<td>20</td>
										<td>0</td>
									</tr><tr>
										<td>10</td>
										<td>10</td>
										<td>2</td>
									</tr>
								</tbody>
							</table>
							</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						
						<tr>
							<td>マイナビ</td>
							<td>済</td>
							<td><input type="checkbox" name="input1[]" checked></td>
						</tr><tr>
							<td>リクナビ</td>
							<td>済</td>
							<td><input type="checkbox" name="input1[]" checked></td>
						</tr><tr>
							<td>就職ナビ</td>
							<td><button>割り当てる</button></td>
							<td><input type="checkbox" name="input1[]" checked></td>
						</tr>
					</tbody>
				</table>-->
				
				<div class="">
					<div class="col-md-2">
						<select class="btn btn-white btn-sm toast-bottom-full-width">
							<option value="1">チェックのみ</option>
							<option value="2">チェックのみ</option>
							<option value="3">チェックのみ</option>
						</select>
					</div>
					<div class="col-md-2">
						<button  class="btn btn-primary btn-xs" type="submit">メール</button>
					</div>
				</div>
			</div>
			<!-------------------------->

		</div>
	</div>
</div>


</body>

</html>
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
<!-- Calendar -->
<?php echo $this->Html->script('plugins/fullcalendar/moment.min.js'); ?>
<?php echo $this->Html->script('plugins/fullcalendar/fullcalendar.min.js'); ?>
<?php echo $this->Html->script('plugins/fullcalendar/lang-all.js'); ?>
<script>
	$(document).ready(function(){
		$('.i-checks').iCheck({
			checkboxClass: 'icheckbox_square-green',
			radioClass: 'iradio_square-green',
		});
    //checkbox group
    $('.cbgroup').click(function(){
    	var tmp=this.checked;
    	$(this).parents("table").find("input[type=checkbox]").each(function(){
    		$(this).prop("checked", tmp);
    	});
    });
	//progress adjustment
	$('.progress').each(function (){
		var tmp=$(this).children(0).attr("aria-valuemax");
		if(tmp > 0)
			$(this).width(tmp+"%");
	});

        /* initialize the calendar
        -----------------------------------------------------------------*/
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $('#calendar').fullCalendar({
        	header: {
        		left: 'prev,next today',
        		center: 'title',
        		right: ''
        	},
        	lang: 'ja',
        	editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function() {
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                  }
                },
                events: [
                {
                	title: 'イベント名',
                	start: new Date(y, m, 1)
                },
                {
                	title: 'イベント名',
                	start: new Date(y, m, d, 10, 30),
                	allDay: false
                },
                {
                	title: 'イベント名',
                	start: new Date(y, m, d, 12, 0),
                	end: new Date(y, m, d, 14, 0),
                	allDay: false
                },
                {
                	title: 'イベント名',
                	start: new Date(y, m, d+1, 19, 0),
                	end: new Date(y, m, d+1, 22, 30),
                	allDay: false
                },
                {
                	title: 'イベント名',
                	start: new Date(y, m, 28),
                	end: new Date(y, m, 29),
                	url: 'http://google.com/'
                }
                ]
              });
});
</script>