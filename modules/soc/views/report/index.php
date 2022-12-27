<?php
use yii\helpers\Url;
?>
<?php echo $this->render('_search', ['model' => $searchModel]); ?>
<?php if ($searchModel->q_date): ?>
<!-- <iframe src="https://tsd.kku.ac.th/" width="100%" height="500">
</iframe> -->
<?php
echo '<iframe src="https://docs.google.com/viewerng/viewer?url=' . Url::to(Yii::getAlias('@web') . '/msword/ms_word_result.docx', true) . '&embedded=true"  style="position: absolute;width:92%; height: 100%;border: none;"></iframe>';
?>
    <?php endif; ?>
