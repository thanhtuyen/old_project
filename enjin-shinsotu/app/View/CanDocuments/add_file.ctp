
    <?php echo $this->Form->create('CanDocuments',array('action'=>'add_file','type'=>'file', 'class'=>"form-horizontal")); ?>
    <?php echo $this->Form->input('can_candidate_id', array('type'=>'hidden', 'label'=>false, 'class'=>'form-control')); ?>
    <?php echo $this->Form->input('ev_history_id', array('type'=>'hidden', 'label'=>false, 'class'=>'form-control')); ?>
    <?php echo $this->Form->input('sel_history_id', array('type'=>'hidden', 'label'=>false, 'class'=>'form-control')); ?>
    <input type="hidden" name="_id" class="btn btn-primary btn-xs pull-right" value="<?php echo $can_candidate_id; ?>">

    <input type="file" name="file" class="chooseFile custom-file-input">
    <button class='btn btn-primary btn-xs pull-right btnAddFile' style="display: none;">ファイル追加</button>
    <?php echo $this->Form->end() ?>

<script>
    $(function(){
        $(this).on('change','.chooseFile',function (){
            // var fileName = $(this).val();
            $('.btnAddFile').click();
        });
        <?php
                if(isset($code)):
                ?>
        window.top.count_<?php echo $code; ?>.innerText=parseInt(window.top.count_<?php echo $code; ?>.innerText)+1;
        <?php     endif;   ?>
    });
</script>
<style>
    .chooseFile::before {
        content: 'ファイル追加';
        display: inline-block;
        border: 1px solid #2abbf0;
        border-radius: 3px;
        padding: 5px 8px;
        outline: none;
        white-space: nowrap;
        -webkit-user-select: none;
        cursor: pointer;
        font-weight: 400;
        font-size: 12px;
        background-color: #2abbf0;
        color: #FFFFFF;
    }
    .chooseFile:hover::before {
        border-color: #2abbf0;
    }
</style>
