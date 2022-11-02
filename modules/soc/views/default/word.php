<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<iframe src="https://docs.google.com/viewerng/viewer?url='<?=Url::to(Yii::getAlias('@web').'/msword/ms_word_result.docx', true)?>.'&embedded=true"  style="position: absolute;width:100%; height: 100%;border: none;"></iframe>