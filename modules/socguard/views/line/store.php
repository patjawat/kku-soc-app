<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>รหัส</th>
            <th>ผู้เบิก</th>
            <th>สถานะ</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;?>
    <?php foreach($dataProvider->getModels() as $model):?>
        <tr>
            <td><?=$i++;?></td>
            <td><?=$model->item_code?></td>
            <td><?=$model->item_code?></td>
            <td>
                <?php if($model->active == 1):?>
<p>เบิก</p>
                    <?php else:?>
<p>ว่าง</p>
                <?php endif;?>
            </td>
        </ะ>
        <?php endforeach; ?>
    </tbody>
    </tfoot>
</table>