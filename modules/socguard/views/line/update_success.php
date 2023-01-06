
<?php
use yii\web\View;
$js = <<< JS

Swal.fire(
          'บันทึกสำเร็จ!',
          'You clicked the button!',
          'success',
        )
        setTimeout(
          function()
          {
            liff.closeWindow();
          }, 2000);
        
        
JS;
$this->registerJs($js, View::POS_END)
?>