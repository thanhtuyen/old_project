<?php ver_dump( $selHistory ); ?> 

<?php foreach( $selHistory['tabData'] as $row ): ?>

<?php echo $this->html->link($row['ScreeningStage']['name'], array('controller'=>'Selhistories','action'=>'edit',$row['SelHistory']['id']) );
 endforeach; ?>

<?php echo $this->element('jobvote',$selHistory['JobVote']); ?>
<?php echo $this->element('reccompany', $RecCompany['RecCompany']); ?>


<hr>
<?php var_dump($selHistory ); ?>