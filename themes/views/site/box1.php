

    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '150',
                'text' => 'ยื่นขอทั้งหมด',
                'icon' => 'fas fa-shopping-cart',
            ]) ?>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '150',
                'text' => 'ขอทบทวน',
                'icon' => 'fas fa-shopping-cart',
                'theme' => 'warning',
            ]) ?>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '150',
                'text' => 'อว.ตรวจสอบไม่ผ่าน',
                'icon' => 'fas fa-shopping-cart',
                'theme' => 'danger',
            ]) ?>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <?php $smallBox = \hail812\adminlte\widgets\SmallBox::begin([
                'title' => '150',
                'text' => 'เสร็จสิ้นขบวนการ',
                'icon' => 'fas fa-shopping-cart',
                'theme' => 'success',
            ]); ?>
            <?= \hail812\adminlte\widgets\Ribbon::widget([
                'id' => $smallBox->id . '-ribbon',
                'text' => 'Ribbon',
                'theme' => 'warning',
                'size' => 'lg',
                'textSize' => 'lg',
            ]) ?>
            <?php \hail812\adminlte\widgets\SmallBox::end(); ?>
        </div>

    </div>

