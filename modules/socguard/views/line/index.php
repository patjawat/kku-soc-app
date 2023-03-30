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

$this->title = 'รายการเบิก';
$this->params['breadcrumbs'][] = $this->title;
?>



<style>
body {
    background-color: #f7f6f6
}

.card {

    border: none;
    box-shadow: 5px 6px 6px 2px #e9ecef;
    border-radius: 4px;
}


.dots {

    height: 4px;
    width: 4px;
    margin-bottom: 2px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block;
}

.badge {

    padding: 7px;
    padding-right: 9px;
    padding-left: 16px;
    box-shadow: 5px 6px 6px 2px #e9ecef;
}

.user-img {

    margin-top: 4px;
}

.check-icon {

    font-size: 17px;
    color: #c3bfbf;
    top: 1px;
    position: relative;
    margin-left: 3px;
}

.form-check-input {
    margin-top: 6px;
    margin-left: -24px !important;
    cursor: pointer;
}


.form-check-input:focus {
    box-shadow: none;
}


.icons i {

    margin-left: 8px;
}

.reply {

    margin-left: 12px;
}

.reply small {

    color: #b7b4b4;

}


.reply small:hover {

    color: green;
    cursor: pointer;

}
</style>

<div class="container mt-5" id="warp-content">

    <div class="row  d-flex justify-content-center">

        <div class="col-md-8">

            <div class="headings d-flex justify-content-between align-items-center mb-3">
                <h5>Unread comments(6)</h5>

                <div class="buttons">

                    <span class="badge bg-white d-flex flex-row align-items-center">
                        <span class="text-primary">Comments "ON"</span>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>

                        </div>
                    </span>

                </div>

            </div>


            <?php foreach($dataProvider->getModels() as $model):?>
            <?php if($model->status_id == 3):?>
                <a href="<?=Url::to(['/socguard/line/check-accept','id' => $model->id])?>">
                <?php else:?>
                    <a href="<?=Url::to(['/socguard/line/update','id' => $model->id])?>">
                        <?php endif;?>

            <div class="card p-3">

                <div class="d-flex justify-content-between align-items-center">

                    <div class="user d-flex flex-row align-items-center">

                        <img src="https://i.imgur.com/hczKIze.jpg" width="40" class="user-img rounded-circle mr-2">
                        <span><small class="font-weight-bold text-primary">james_olesenn</small> <small
                                class="font-weight-bold">Hmm, This poster looks cool</small></span>

                    </div>


                    <small>2 days ago</small>

                </div>


                <div class="action d-flex justify-content-between mt-2 align-items-center">

                    <div class="reply px-4">
                        <small><?=$model->status->name?></small>
                        <span class="dots"></span>
                        <small>Reply</small>
                        <span class="dots"></span>
                        <small>Translate</small>

                    </div>

                    <div class="icons align-items-center">

                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-check-circle-o check-icon"></i>

                    </div>
                </div>
            </div>
            </a>
<?php endforeach; ?>
        </div>
    </div>

</div>









 


<?php
$checkMe = Url::to(['/socguard/line-auth/checkme']);
$addUrl = Url::to(['/socguard/line/add']);
$js = <<< JS


$('#warp-content').hide();
$('#awaitLogin').show();
$('#content-container').hide();

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
            $('#warp-content').hide();

            $('#awaitLogin').show();
            $('#content-container').hide();
          },
          success: function (response) {
            console.log(response);
            $('#warp-content').show();
            $('#awaitLogin').hide();
            $('#content-container').show();
            // if(response == true){
            //   liff.closeWindow();
            // }
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