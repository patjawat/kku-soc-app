<?php

use app\modules\socguard\models\Borrow;
use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\modules\socguard\models\BorrowSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Borrows';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row mt-5" id="warp-content">


<?php foreach($dataProvider->getModels() as $model):?>
    <div class="col-sm-6">
    <div class="card border-0 shadow-lg mb-3 bg-body-tertiary rounded">
      <div class="card-body">
        <h6 class="card-title product-description"><i class="fa-solid fa-book-open-reader"></i>  นายปัจวัฒน์ ศรีบุญเรือง<span class="text-danger"> <?=$model->item_code?></span></h6>
        <p class="card-text"><i class="fa-regular fa-calendar-days"></i> <span class="badge text-bg-warning"><?php // $model->start;?></span>  <i class="fa-solid fa-arrow-right-to-bracket"></i>   <span class="badge text-bg-success"><?php // $model->end;?></span></p>
        <div class="d-flex">

        <!-- Flex -->
  <div class="p-0">
      <!-- <a href="#" class="btn btn-primary"><i class="fa-regular fa-hand-pointer"></i> เพิ่มเติม...</a> -->
      <?=Html::a('<i class="fa-regular fa-hand-pointer"></i> เพิ่มเติม...',['/socguard/line/update','id' => $model->id],['class' => 'btn btn-primary a-modal']);?>
  </div>
  <div class="ms-auto p-2">
    สถานะ : <?php // $this->render('booking_status',['model'=>$model])?>
      <!-- <a href="#" class="btn btn-primary">เพิ่มเติม...</a> -->
  </div>
</div>
<!-- End Flex -->
      </div>
    </div>
  </div>

  <?php endforeach; ?>
</div>



<?php
$checkMe = Url::to(['/socguard/line-auth/checkme']);
$addUrl = Url::to(['/socguard/line/add']);
$js = <<< JS

// $('#create-success').hide();

// $('#loading').show();
$('#warp-content').hide();
function runApp() {
      liff.getProfile().then(profile => {
        // document.getElementById("pictureUrl").src = profile.pictureUrl;
        $('#line_id').val(profile.userId)

        $.ajax({
          type: "post",
          url: "$checkMe",
          data: {line_id:profile.userId},
          dataType: "json",
          beforeSend: function(){
            $('#loading').show();
            $('#warp-content').hide();

            $('#awaitLogin').show();
            $('#content-container').hide();
          },
          success: function (response) {
            console.log(response);
            $('#loading').hide();
            $('#warp-content').show();
            $('#awaitLogin').hide();
            $('#content-container').show();
            if(response == true){
              liff.closeWindow();
            }
          }
        });

      }).catch(err => console.error(err));
    }

    liff.init({ liffId: "1657785530-G9evoe9k" }, () => {
      if (liff.isLoggedIn()) {
        runApp()
        // getUser();
      } else {
        liff.login();
      }
    }, err => console.error(err.code, error.message));


JS;
$this->registerJs($js, View::POS_END)
?>