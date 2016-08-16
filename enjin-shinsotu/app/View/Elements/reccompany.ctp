<!--ibox 2-->
<div class="ibox">
	<div class="ibox-title">
		<h5>自社情報</h5>
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
                                     	<th>会社名</th>
                                     	<td><?php echo h($company_name); ?></td>
                                    </tr>      
                                    <tr>
                                     	<th>都道府県</th>
                                     	<td><?php echo h($Prefecture_name); ?></td>
                                    </tr>  
                                    <tr>
                                     	<th>市区町村</th>
                                     	<td><?php echo h($City_name); ?></td>
                                    </tr>  
                                    <tr>
                                     	<th>契約期間</th>
                                     	<td><?php echo $this->Enjin->getDate( $deadline); ?></td>
                                    </tr>  
                                    <tr>
                                     	<th>設立年月日</th>
                                     	<td><?php echo $this->Enjin->getDateYm( $establish_date); ?></td>
                                    </tr>  
                                    <tr>
                                     	<th>従業員数</th>
                                     	<td><?php echo number_format( $employee ); ?>人</td>
                                    </tr>  
                                    <tr>
                                     	<th>売上高</th>
                                     	<td><?php echo number_format( $figure ); ?>円</td>
                                    </tr>  
                                    <tr>
                                     	<th>業種</th>
                                     	<td><?php echo $this->Enjin->getBusinessName($business_id); ?></td>
                                    </tr>  
                                    <tr>
                                     	<th>市場</th>
                                     	<td><?php echo $this->Enjin->getMarketName($market_id); ?></td>
                                    </tr>  
                                    <tr>
                                     	<th>備考</th>
                                     	<td><?php echo $this->Enjin->nl2brh($remark); ?></td>
                                    </tr>                                            
                                  </tbody>
                                </table>


		
	</div>

</div>
<!--end ibox 2-->
