        <div class="ibox">
            <div class="ibox-title">
            <h5>イベント担当者登録</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>                                                           
            </div>
        </div>
        <div class="ibox-content clearfix p-sm">
            <div class="">
                <div class="table-border">
                    <table class="table table-bordered no-margin-bottom" id="eventRegister">
                        <thead>
                        <tr>
                            <th>イベント担当者名</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($wEvPersonnel as $recRecruiter): ?>
                        <tr>
                            <td><a class="text-navy" href=""><?php echo $RecRecruiter['name']; ?></a></td>
                            <td class="table-button-tdright"><button class="full-width btn btn-default btn-xs ev-histories-delete" data-id="<?php echo $EvPersonnel['id']; ?>">削除</button></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>    
                </div>
            </div>
        </div>
        <div class="ibox-content clearfix bg-gray pd-9">
            <table class="table no-margin-bottom">
            <tbody>
                <tr>
                <td class="no-borders ver-mid btn-group btn-block">
                  <select class="form-control" id="recRecruiters">
                    <?php foreach ($wRecRecruiter as $key=>$val): ?>
                    <option value='<?php echo $key; ?>'><?php echo h($val); ?></option>
                    <?php endforeach; ?>
                  </select>
                </td>
                <td class="no-borders ver-mid">
                  <button class="full-width btn btn-primary btn-sm" id="EvHistories">追加</button>
                </td>
                </tr>
            </tbody>
            </table>
        </div>