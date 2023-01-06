<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\web\View;
?>


<div class="row justify-content-center mt-3" id="warp-content">
<div class="text-center" >
  <?=Html::img('@web/images/join2.png',['width' => '300px'])?>
  <h1><?=$model->product->item_code;?></h1>
</div>

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'product_id')->hiddenInput(['maxlength' => true])->label(false) ?>
    <div class="form-group">
        <?= Html::submitButton('รับคืน', ['class' => 'btn btn-lg btn-primary','id' => 'btn-save','style' => 'font-size: 3rem;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<div>



<?php
$checkMe = Url::to(['/socguard/line-auth/checkme']);
$addUrl = Url::to(['/socguard/line/add']);
$js = <<< JS

// $('#create-success').hide();


// $('#btn-save').click(function (e) {
//   e.preventDefault();
//   var form = $('#w0');
//   $.ajax({
//     type: form.attr('method'),
//     url: form.attr('action'),
//     data: form.serialize(),
//     dataType: "json",
//     beforeSend: function(){
//             $('#warp-content').hide();
//             $('#awaitLogin').show();
//             $('#content-container').hide();
//           },
//     success: function (response) {
//         console.log(response);
//       if(response.status == true){
//         $('#create-success').show();
//         $('.borrow-create').text(response.msg);
//         $('#awaitLogin').hide();
//         $('#content-container').show();
//         Swal.fire(
//           'บันทึกสำเร็จ!',
//           'You clicked the button!',
//           'success',
//         )
//         setTimeout(
//           function()
//           {
//             liff.closeWindow();
//           }, 2000);
//         }
//     }
//   });

// });

JS;
$this->registerJs($js, View::POS_END)
?>