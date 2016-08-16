<span class="sp-text-pg"><?php echo $this->Paginator->counter("{:page}件中{:pages}件表示")?>&nbsp;&nbsp;</span>
<div class="bottom_pagination1 pull-right">
<ul class="pagination m-t-none">
	<?php
		echo $this->Paginator->prev('Prev', array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'paginate_button previous disabled'));
		echo $this->Paginator->numbers(array('separator' => '','tag'=>'li','class'=>'paginate_button','currentClass'=>'paginate_button active','currentTag'=>'a'));
		echo $this->Paginator->next('Next', array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'paginate_button next disabled'));
	?>	
</ul>
</div>