<?php
if(empty($url))
	$url = array('action' => 'index');
?>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2><?php
			if(empty($noBtn))
     		echo $this->Html->link(__('< 戻る'),
        		$url,
        		array('class' => 'btn btn-sm btn-white color-676a6c'))?>
    	<?php echo $text?>
		</h2>
	</div>
</div>