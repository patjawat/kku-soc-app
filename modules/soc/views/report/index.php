
<?php echo $this->render('_search', ['model' => $searchModel]); ?>

<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>ลำดับ</th>
            <th>เรื่อง/เหตุการณ์</th>
            <th>ดำเนินการเมื่อวันที่</th>
            <th>ระยะเวลาในการดำเนินการ</th>
            <th>ผลการดำเนินการ</th>
            <th>ประเภทผู้ขอความอนุเคราะห์</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;?>
        <?php if ($searchModel->q_date): ?>
        <?php foreach ($dataProvider->getModels() as $model): ?>
        <tr>
            <td><?=$i++;?></td>
            <td><?=$model->eventType->name?></td>
            <td><?=$model->created_at?></td>
            <td><?=$model->CountDate()?></td>
            <td><?=isset($model->resultType) ? $model->resultType->name : '-'?></td>
            <td><?=$model->personType->name?></td>
        </tr>
        <?php endforeach;?>
        <?php endif;?>
    </tbody>
</table>
<?php if ($searchModel->q_date): ?>
<div class="row justify-content-start">
    <div class="col-4">
        <table class="table table-light">
            <tbody>
                <?php foreach ($counts as $count): ?>
                <tr>
                    <td><?=$count['name']?></td>
                    <td><?=$count['total']?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<?php endif;?>