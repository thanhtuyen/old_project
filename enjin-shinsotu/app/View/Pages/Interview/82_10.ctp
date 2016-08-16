<?php
/*edited by [V]*/
?>
<!DOCTYPE html>
<html><head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">	<title>enjin -新卒採用-</title>
		<?php
		echo $this->Html->css('bootstrap/bootstrap.min');
		//echo $this->Html->css('cake.generic');
		echo $this->Html->css('font-awesome/css/font-awesome');
		//echo $this->Html->css('plugins/iCheck/custom');

		echo $this->Html->css('bootstrap/animate');
		echo $this->Html->css('bootstrap/style');
		echo $this->Html->css('plugins/iCheck/custom.css');

		echo $this->Html->css('enjin/02_selection.css');

		echo $this->Html->css('plugins/dataTables/dataTables.bootstrap');
		echo $this->Html->css('plugins/dataTables/dataTables.responsive');
		echo $this->Html->css('plugins/dataTables/dataTables.tableTools.min');
		echo $this->Html->css('plugins/daterangepicker/daterangepicker-bs3.css');
		echo $this->Html->css('plugins/clockpicker/clockpicker.css');
		echo $this->Html->css('plugins/datapicker/datepicker3.css');
		echo $this->Html->css('plugins/fullcalendar/fullcalendar.css');
		echo $this->Html->css('plugins/clockpicker/clockpicker');
		echo $this->Html->css('plugins/daterangepicker/daterangepicker-bs3');
		echo $this->Html->css('plugins/switchery/switchery');
		echo $this->Html->css('enjin/email');
		echo $this->Html->css('enjin/global');
		?>

		<?php
		echo $this->Html->script('jquery-2.1.1');
		echo $this->Html->script('jquery-ui.custom.min');
		echo $this->Html->script('jquery.tmpl');
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('plugins/metisMenu/jquery.metisMenu');
		echo $this->Html->script('plugins/slimscroll/jquery.slimscroll.min');

		echo $this->Html->script('plugins/iCheck/icheck.min');
		echo $this->Html->script('plugins/datapicker/bootstrap-datepicker');

		echo $this->Html->script('inspinia');

		echo $this->Html->script('plugins/fullcalendar/moment.min');
		echo $this->Html->script('plugins/fullcalendar/fullcalendar.min');
		echo $this->Html->script('plugins/jeditable/jquery.jeditable');
		echo $this->Html->script('plugins/dataTables/jquery.dataTables');
		echo $this->Html->script('plugins/dataTables/dataTables.bootstrap');
		echo $this->Html->script('plugins/dataTables/dataTables.responsive');
		echo $this->Html->script('plugins/dataTables/dataTables.tableTools.min');
		echo $this->Html->script('plugins/clockpicker/clockpicker');
		echo $this->Html->script('plugins/daterangepicker/daterangepicker');
		echo $this->Html->script('plugins/pace/pace.min');
		echo $this->Html->script('plugins/peity/jquery.peity.min');
		echo $this->Html->script('plugins/switchery/switchery');

		echo $this->Html->script('kiwi');
		?>
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
						<div class="navbar-header">
							<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i></a>    
						</div>

						<div class="nav navbar-top-links navbar-right logo_enjin">
							<img src="/img/logo_enjin2.png" alt="logo">
						</div>

						<div class="nav navbar-top-links navbar-right logo_enjin">
							<div class="btn-group">
							</div>
						</div>
						<ul class="nav navbar-top-links navbar-right">
							<li>
								<!--logout-->
								<a href="http://localhost/Companies/logout">Log out</a>                                        <!--end logout-->
							</li>
						</ul>
					</nav>
				</div>

				<div id="content-wrapper">
					
					<div class="row wrapper border-bottom white-bg page-heading">
						<div class="col-lg-10">
							<h2><a href="/selHistories" class="btn btn-sm btn-white color-676a6c">&lt; 戻る</a>       選考履歴|123456 田中　太朗</h2>
						</div>
					</div>

					<div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">
						<div class="full-content">
							<div class="">
								<div class="">
									<div class="col-lg-8">
										<div class="tabs-container ibox">
											<ul class="nav nav-tabs">

												<li class="active">
													<a href="/SelHistories/view/2">書類選考</a></li>

                                                <li class="">
                                                    <a href="/SelHistories/view/3">1次選考</a></li>

                                                <li class="">
                                                    <a href="/SelHistories/view/3">2 次選考</a></li>

                                                <li class="">
                                                    <a href="/SelHistories/view/3">3 次次選</a></li>

                                                <li class="">
                                                    <a href="/SelHistories/view/3">4 次選考</a></li>

                                                <li class="">
                                                    <a href="/SelHistories/view/3">最終選考</a></li>

											</ul>
											<div class="tab-content">

												<!-- tab2 -->
												<div id="tab-2" class="tab-pane active">
													<div class="panel-body  pd-bottom-none">
														<div class="ibox-title">
															<h5>候補者情報</h5>
														</div>

														<div class="ibox-content">
															<form action="/SelHistories/delete/2" method="post" class="form-horizontal" id="1022018360">

																<div class="form-group"><label class="col-sm-4 control-label">選考履歴ID</label>
																	<div class="col-sm-8">
																		<div class="form-control border-none">
																			2</div>
																	</div>
																</div>

																<div class="form-group"><label class="col-sm-4 control-label">候補者名</label>
																	<div class="col-sm-8">
																		<div class="form-control border-none">
																			<a href="/CanCandidates/edit/2" class="text-navy">アクサス次郎</a></div>
																	</div>
																</div>

																<div class="form-group"><label class="col-sm-4 control-label">候補者ID</label>
																	<div class="col-sm-8">
																		<div class="form-control border-none">
																			<a href="/CanCandidates/edit/2" class="text-navy">2</a></div>
																	</div>
																</div>

																<div class="form-group"><label class="col-sm-4 control-label">選考段階名</label>
																	<div class="col-sm-8">
																		<div class="form-control border-none">
																			説明会</div>
																	</div>
																</div>

																<div class="form-group"><label class="col-sm-4 control-label">選考ステータス</label>
																	<div class="col-sm-8">
																		<div class="form-control border-none">
																			合格</div>
																	</div>
																</div>

																<div class="form-group"><label class="col-sm-4 control-label">選考開始予定日時</label>                        
																	<div class="col-sm-8">
																		<div class="form-control border-none">
																			2015-08-01 00:00:00</div>
																	</div>
																</div>
																<div class="form-group"><label class="col-sm-4 control-label">選考終了予定日時</label>
																	<div class="col-sm-8">
																		<div class="form-control border-none">
																			2015-08-02 00:00:00</div>
																	</div>
																</div>
          

																<!-- end table 2-->
																<!-- form 2 -->

																<!-- end form 2 -->

      
																<!-- form 2 -->   
              

																<div class="form-group"><label class="col-sm-4 control-label">求人票ID</label>
																	<div class="col-sm-8">
																		<div class="form-control border-none">
																			<a href="/JobVotes/view/1" class="text-navy">1</a></div>
																	</div>
																</div>

																<div class="form-group"><label class="col-sm-4 control-label">求人票タイトル</label>
																	<div class="col-sm-8">
																		<div class="form-control border-none">
																			新卒採用(技術)</div>
																	</div>
																</div>

   
																<!-- end form 2 -->
																<!-- form 3 -->   


																<div class="form-group"><label class="col-sm-4 control-label">選考ステータスオプション</label>
																	<div class="col-sm-8">
																		<div class="form-control border-none">
																		</div>
																	</div>                             
																</div>

																<div class="form-group"><label class="col-sm-4 control-label">掲示年収</label>
																	<div class="col-sm-8">
																		<div class="form-control border-none">
																			4000000</div>
																	</div>                                 
																</div>

																<div class="form-group"><label class="col-sm-4 control-label">コメント</label>
																	<div class="col-sm-8">
																		<div class="form-control border-none">
																			テストコメント</div>
																	</div>                                  
																</div>

																<div class="form-group"><label class="col-sm-4 control-label">訪問先情報</label>
																	<div class="col-sm-8">
																		<div class="form-control border-none">
																			アクサス</div>
																	</div>
																</div>

																<div class="btn-clear">
																</div>
															</form>
														</div> 
														<!-- end form 3-->



													</div>
												</div>
												<!-- end tab 2-->

												<!-- tab 1 -->
												<div id="tab-1" class="tab-pane">
												</div>
												<!-- end tab -1-->

												<!-- tab 3 -->
												<div id="tab-3" class="tab-pane">
												</div>
												<!-- end tab 3-->

												<!-- tab 4-->

												<!-- tab 5-->



											</div>
										</div>
										
									</div>



									<div class="col-lg-4">
										<!--ibox 1-->
										<div class="ibox">
											<div class="ibox-title">
												<h5>求人票情報</h5>

												<div class="ibox-tools">
													<a class="collapse-link">
														<i class="fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="ibox-content clearfix" style="display: block;">

												<table class="table table-bordered no-margin-bottom subcontents-sb-1">
													<tbody>
														<tr>
															<th class="w-47per">求人票ID</th>
															<td class="right-table-td">1</td>
														</tr>   
														<tr>
															<th class="">求人票タイトル</th>
															<td class="right-table-td">新卒採用(技術)</td>
														</tr> 
														<tr>
															<th class="">募集要項</th>
															<td class="right-table-td">プログラマー募集</td>
														</tr> 
														<tr>
															<th class="">職種タイプ</th>
															<td class="right-table-td">IT系</td>
														</tr> 
														<tr>
															<th class="">初任給</th>
															<td class="right-table-td">200,000円</td>
														</tr> 
														<tr>
															<th class="">待遇</th>
															<td class="right-table-td">サンプル</td>
														</tr> 
														<tr>
															<th class="">応募資格</th>
															<td class="right-table-td">新卒</td>
														</tr> 
														<tr>
															<th class="">募集人数</th>
															<td class="right-table-td">50人</td>
														</tr> 
														<tr>
															<th class="">募集期限</th>
															<td class="right-table-td">2015年12月31日 00:00:00</td>
														</tr>      
														<tr>
															<th class="">公開開始日時</th>
															<td class="right-table-td">2015年08月01日 00:00:00</td>
														</tr>     
														<tr>
															<th class="">募集エリア</th>
															<td class="right-table-td">東京</td>
														</tr>             
													</tbody>
												</table>













  
    
											</div>
											<!--end table 1-->
										</div>
										<!--end ibox 1--><!--ibox 2-->
										<div class="ibox">
											<div class="ibox-title">
												<h5>企業情報</h5>
												<div class="ibox-tools">
													<a class="collapse-link">
														<i class="fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="ibox-content clearfix" style="display: block;">
												<table class="table table-bordered no-margin-bottom subcontents-sb-1">
													<tbody>
														<tr>
															<th>企業名</th>
															<td>AXAS株式会社</td>
														</tr>      
														<tr>
															<th>都道府県</th>
															<td>東京都</td>
														</tr>  
														<tr>
															<th>市区町村</th>
															<td>新宿区</td>
														</tr>  
														<tr>
															<th>契約期間</th>
															<td>2015年08月31日</td>
														</tr>  
														<tr>
															<th>設立年月日</th>
															<td>2007年06月</td>
														</tr>  
														<tr>
															<th>従業員数</th>
															<td>1,000人</td>
														</tr>  
														<tr>
															<th>売上高</th>
															<td>560,000,000円</td>
														</tr>  
														<tr>
															<th>業種</th>
															<td>サービス業</td>
														</tr>  
														<tr>
															<th>市場</th>
															<td>その他</td>
														</tr>  
														<tr>
															<th>備考</th>
															<td>ユーザー企業１</td>
														</tr>                                            
													</tbody>
												</table>


        
											</div>

										</div>
										<!--end ibox 2-->
										<!--end table 2-->
									</div>
								</div>
							</div>
							<!-- end content -->

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