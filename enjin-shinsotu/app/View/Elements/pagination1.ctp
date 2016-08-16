<div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
	<ul class="pagination">
		<?php
		echo $this->Paginator->prev('Prev', array('tag'=>'li','disabledTag'=>'a', 'class' => 'paginate_button previous'), null, array('class' => 'disabled'));
		echo $this->Paginator->numbers(array('separator' => '','tag'=>'li','class'=>'paginate_button','currentClass'=>'active','currentTag'=>'a'));
		echo $this->Paginator->next('Next', array('tag'=>'li','disabledTag'=>'a', 'class' => 'paginate_button next'), null, array('class' => 'disabled'));
		?>	
	</ul>
</div>
<div class="pull-right lh32"><?php echo $this->Paginator->counter("{:page}件中{:pages}件表示")?>&nbsp;&nbsp;</div>
