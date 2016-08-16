<div class="row clearfix">
    <div style = "margin-top:10px;margin-left:15px;" class="col-lg-12 mrb200">
        <div class="ibox float-e-margins"  style="width: 300px; margin: auto;">
            <div class="header-login">
                <img src="<?php echo $this->webroot; ?>img/logo_enjin_login.png" width="300px" />
                <label class="mrb20 mrt30">Welcome to enjin</label>
            </div>
            <div class="clearfix">
                <?php echo $this->Form->create('rec_recruiters'); ?>
                <div class="form-group">
                    <?php echo $this->Form->input('mail',array('class'=>'form-control','label'=>false,'placeholder'=>'ユーザーネーム')); ?>
                </div>
                <div class="form-group mtop15 clearfix">
                    <?php echo $this->Form->input('password',array('class'=>'form-control','label'=>false,'placeholder'=>'パスワード')); ?>
                </div>
                <div class="form-group mtop15">
                    <button class="btn btn-primary full-width" type="submit">ログイン</button>
                </div>
                <div class="form-group mtop15 txt-align">
                    <label class="cl909">© 2015 enjin</label>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>

