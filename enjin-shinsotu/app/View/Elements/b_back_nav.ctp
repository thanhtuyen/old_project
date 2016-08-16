<?php
if(empty($url))
	$url = array('action' => 'index');
?>
<div class="page-footer dummy"></div>
<div class="row page-footer wrapper white-bg short-page">
	<div class="col-lg-10">
		<h2><?php
			if(empty($noBtn))
			echo $this->Html->link(__('< 戻る'),
				$url,
				array('class' => 'btn btn-sm btn-white'))?>
		</h2>
	</div>
</div>