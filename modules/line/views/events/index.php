<?php
use kartik\detail\DetailView;
use yii\helpers\Html;
use yii\web\View;
$title = "ยังไม่รับเรื่อง";
/** @var yii\web\View $this */
?>

<h1 data-aos="fade-down" class="text-center">ยังไม่รับเรื่อง</h1>
<?php $i = 3;?>
<?php foreach ($models as $model): ?>


<div class="card card-primary collapsed-card" data-aos="fade-up" data-aos-delay="<?=($i++) * 100?>">
    <div class="card-header">
        <div class="user-block">
            <?=Html::img('@web/img/check_item.png', ['class' => 'img-circle', 'data-cfsrc' => '@web/img/check_item.png']);?>
            <span class="username"><?=$model->eventType->name;?></a></span>
            <span class="description text-light bg-dark">เวลาเกิดเหตุ <?=$model->event_date;?></span>
        </div>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
            </button>
        </div>
        

    </div>

    <div class="card-body p-0" style="display: none;">
    <?php echo DetailView::widget([
    'model' => $model,
    'responsive' => true,
    'attributes' => [
        [
            'columns' => [
                [
                    'attribute' => 'fname',
                    'displayOnly' => true,
                    'valueColOptions' => ['style' => 'width:30%'],
                    'value' => $model->fname . ' ' . $model->lname,
                ],
                [
                    'attribute' => 'person_type',
                    'format' => 'raw',
                    'valueColOptions' => ['style' => 'width:30%'],
                    'displayOnly' => true,
                    'type' => DetailView::INPUT_TEXT,
                    'value' => $model->personType->name,
                ],
            ],
        ],
        [
            'columns' => [
                [
                    'attribute' => 'phone',
                    'displayOnly' => true,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'event_type',
                    'format' => 'raw',
                    'valueColOptions' => ['style' => 'width:30%'],
                    'displayOnly' => true,
                    'value' => $model->eventType->name,
                ],
            ],
        ],
        [
            'columns' => [
                [
                    'attribute' => 'fname',
                    'displayOnly' => true,
                    'valueColOptions' => ['style' => 'width:30%'],
                    'format' => 'raw',
                    'value' => $model->fname . ' ' . $model->lname,
                ],
                [
                    'attribute' => 'event_date',
                    'displayOnly' => true,
                    'format' => 'raw',
                    'type' => DetailView::INPUT_DATE,
                    'widgetOptions' => [
                        'pluginOptions' => ['format' => 'yyyy-mm-dd'],
                    ],
                ],
            ],
        ],
        [
            'columns' => [

                [
                    'attribute' => 'orther',
                    'displayOnly' => true,
                    'valueColOptions' => ['style' => 'width:30%'],
                    'format' => 'raw',
                    // 'label' => 'Provincia Nascita'
                ],
                [
                    'attribute' => 'orther',
                    'displayOnly' => true,
                    'valueColOptions' => ['style' => 'width:30%'],
                    'format' => 'raw',
                    // 'label' => 'Provincia Nascita'
                ],
            ],
        ],
        [
            'columns' => [
                [
                    'attribute' => 'orther',
                    'displayOnly' => true,
                    'format' => 'raw',
                ],
            ],
        ],

        
    ],
]);
?>
    </div>

</div>

<?php endforeach;?>


<!-- <img id="pictureUrl"> -->
<!-- <button id="btnLogIn" onclick="logIn()">Log In</button>
  <button id="btnLogOut" onclick="logOut()">Log Out</button> -->

<?php
$js = <<< JS

function logOut() {
      liff.logout()
      window.location.reload()
    }
    function logIn() {
      liff.login({ redirectUri: window.location.href })
    }
    async function getUserProfile() {
      const profile = await liff.getProfile()
      document.getElementById("pictureUrl").style.display = "block"
      document.getElementById("pictureUrl").src = profile.pictureUrl
    }
    async function main() {
      await liff.init({ liffId: "1657538565-5Az1zNYA" })
      if(!liff.isLoggedIn()) {
        liff.login({ redirectUri: window.location.href })
      }
      // if (liff.isInClient()) {
      //   getUserProfile()
      // } else {
      //   if (liff.isLoggedIn()) {
      //     getUserProfile()
      //     document.getElementById("btnLogIn").style.display = "none"
      //     document.getElementById("btnLogOut").style.display = "block"
      //   } else {
      //     logIn()
      //     document.getElementById("btnLogIn").style.display = "block"
      //     document.getElementById("btnLogOut").style.display = "none"
      //   }
      // }
    }
    // main()

JS;
$this->registerJS($js, View::POS_END)
?>