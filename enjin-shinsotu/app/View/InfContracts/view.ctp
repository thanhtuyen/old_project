<?php echo $this->element( 'back_nav',  array('text' => __('流入元契約詳細｜%d %s', $infContract['InfContract']['id'], $infContract['InfContract']['title']), 'url' => array('controller'=>'RefererCompanies', 'action'=>'detail', $infContract['InfContract']['referer_company_id'])) );?>

<div class="row wrapper wrapper-content animated fadeInRight title-button pd-bottom-none">
    <!-- start contents -->
    <div class='col-lg-8'>
        <div class='ibox'>
            <div class="ibox-title">
                <h5>求人担当者登録</h5>
                <div class="ibox-tools">
                    <?php
                    echo $this->Html->link(
                        '編集',
                        array(
                        'controller' => 'InfContracts',
                        'action' => 'edit',$infContract['InfContract']['id'],
                        'full_base' => true,
                        ),
                        array(
                        'class'=>'btn btn-primary btn-xs'
                        )
                        );
                    ?>
                </div>
            </div>
            <div class='ibox-content bg-white p-sm'>
                <form method="get" class="form-horizontal form-info">
                    <div class="form-group"><label class="col-sm-4 control-label">流入元契約 I D</label>
                        <div class="col-sm-8">
                            <div class="form-control border-none">
                                <?php echo h($infContract['InfContract']['id']);?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-4 control-label">タイトル</label>
                        <div class="col-sm-8">
                            <div class="form-control border-none">
                                <?php echo h($infContract['InfContract']['title']);?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-4 control-label">契約開始日</label>
                        <div class="col-sm-8">
                            <div class="form-control border-none">
                                <?php
                                    $date = new DateTime($infContract['InfContract']['start_contract_date']);
                                    echo $date->format('Y/m/d');
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-4 control-label">契約終了日</label>
                        <div class="col-sm-8">
                            <div class="form-control border-none">
                                <?php
                                    $date = new DateTime($infContract['InfContract']['end_contract_date']);
                                    echo $date->format('Y/m/d');
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-4 control-label">契約タイプ</label>
                        <div class="col-sm-8">
                            <div class="form-control border-none">
                                <?php echo $this->Enjin->getContractType( $infContract['InfContract']['contract_type']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-4 control-label">金額・割合</label>
                        <div class="col-sm-8">
                            <div class="form-control border-none">
                                <?php echo $this->Enjin->getInfContactFee( $infContract['InfContract'] ); ?>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
