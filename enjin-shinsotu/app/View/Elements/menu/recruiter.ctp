                <!--menu recruiter-->
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                    </li>
                    <li>
                        <a href="<?php echo $this->webroot;?>Companies/dashbord">
                            <i class="fa fa-th-large"></i>
                            <span class="nav-label">ダッシュボード</span>
                            <span></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $this->webroot;?>SelHistories/index">
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
                            <li><a href="<?php echo $this->webroot;?>EvEvents/index">イベントカレンダー</a></li>
                            <li><a href="<?php echo $this->webroot;?>EvEvents/search">イベント一覧</a></li>
                            <li><a href="<?php echo $this->webroot;?>EvEvents/add">イベント登録</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-envelope"></i>
                            <span class="nav-label">候補者管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="<?php echo $this->webroot;?>CanCandidates/index">候補者一覧</a></li>
                            <li><a href="<?php echo $this->webroot;?>CanCandidates/add">候補者登録</a></li>
                            <li><a href="<?php echo $this->webroot;?>CanCandidates/csv_add">候補者CSV登録</a></li>
                            <li><a href="<?php echo $this->webroot;?>CanCandidates/unlock">ロック管理</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-pie-chart"></i>
                            <span class="nav-label">求人票管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="<?php echo $this->webroot;?>JobVotes/index">求人票一覧</a></li>
                            <li><a href="<?php echo $this->webroot;?>JobVotes/add">求人票登録</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-flask"></i>
                            <span class="nav-label">エージェント管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="<?php echo $this->webroot;?>RefererCompanies/index">エージェント企業一覧</a></li>
                            <li><a href="<?php echo $this->webroot;?>RefererCompanies/add">エージェント企業登録</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-edit"></i>
                            <span class="nav-label">メール送信管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="<?php echo $this->webroot;?>MlSendHistories/">送信履歴</a></li>
                            <li><a href="<?php echo $this->webroot;?>MailTemplates/">テンプレート</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-desktop"></i>
                            <span class="nav-label">マスタ管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="<?php echo $this->webroot;?>RecDepartments/">自社情報</a></li>
                            <li><a href="<?php echo $this->webroot;?>ScreeningStages/">選考段階</a></li>
                            <li><a href="<?php echo $this->webroot;?>RecruitmentAreas/">求人募集エリア</a></li>
                            <li><a href="<?php echo $this->webroot;?>Schools/index">学校マスタ</a></li>
                        </ul>
                    </li>
                </ul>
                <!--end menu recruiter-->
