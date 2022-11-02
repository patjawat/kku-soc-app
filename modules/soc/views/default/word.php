<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<iframe src="http://docs.google.com/viewer?url='<?=Url::to(Yii::getAlias('@web').'/msword/ms_word_result.docx', true);?>'&embedded=true"  style="position: absolute;width:100%; height: 100%;border: none;"></iframe>

    <!-- <iframe src="https://docs.google.com/viewer?url=<?php // Url::to(Yii::getAlias('@web').'/msword/ms_word_result.docx', true);?>" height="500px" width="400px"></iframe> -->
        <!-- <iframe src='https://docs.google.com/viewer?url="<?php // Url::to(Yii::getAlias('@web').'/msword/ms_word_result.docx', true);?>" width='500px' height='500px' frameborder='0'> -->
        <iframe src='https://docs.google.com/a/http://127.0.0.1:81/viewer?url="<?=Url::to(Yii::getAlias('@web').'/msword/ms_word_result.docx', true);?>"&embedded=true width='500px' height='500px' frameborder='0'>
</iframe>
<?=Url::to(Yii::getAlias('@web').'/msword/ms_word_result.docx', true);?>