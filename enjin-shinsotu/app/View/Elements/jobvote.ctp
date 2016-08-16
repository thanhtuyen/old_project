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
                                      <td class="right-table-td"><?php echo h($id); ?></td>
                                    </tr>   
                                    <tr>
                                      <th class="">求人票タイトル</th>
                                      <td class="right-table-td"><?php echo h($title); ?></td>
                                    </tr> 
                                    <tr>
                                      <th class="">募集要項</th>
                                      <td class="right-table-td"><?php echo $this->Enjin->nl2brh($requirement); ?></td>
                                    </tr> 
                                    <tr>
                                      <th class="">職種タイプ</th>
                                      <td class="right-table-td"><?php echo $this->Enjin->getJobTypeName($jobtype_id); ?></td>
                                    </tr> 
                                    <tr>
                                      <th class="">初任給</th>
                                      <td class="right-table-td"><?php echo number_format( $start_salary ); ?>円</td>
                                    </tr> 
                                    <tr>
                                      <th class="">待遇</th>
                                      <td class="right-table-td"><?php echo $this->Enjin->nl2brh($treatment); ?></td>
                                    </tr> 
                                    <tr>
                                      <th class="">応募資格</th>
                                      <td class="right-table-td"><?php echo $this->Enjin->nl2brh($qualification_require); ?></td>
                                    </tr> 
                                    <tr>
                                      <th class="">募集人数</th>
                                      <td class="right-table-td"><?php echo number_format($wanted_person ); ?>人</td>
                                    </tr> 
                                    <tr>
                                      <th class="">募集期限</th>
                                      <td class="right-table-td"><?php echo $this->Enjin->getDateTime( $wanted_deadline); ?></td>
                                    </tr>      
                                    <tr>
                                      <th class="">公開開始日時</th>
                                      <td class="right-table-td"><?php echo $this->Enjin->getDateTime( $start_date ); ?></td>
                                    </tr>     
                                    <tr>
                                      <th class="">募集エリア</th>
                                      <td class="right-table-td"><?php echo h( $recruitment_area_name ); ?></td>
                                    </tr>             
                                  </tbody>
                                </table>













  
	
		</div>
		<!--end table 1-->
	</div>
<!--end ibox 1-->