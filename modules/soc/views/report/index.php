<?php
use yii\helpers\Url;
?>
<div class="row">
<div class="col-4">

<?php echo $this->render('_search', ['model' => $searchModel]); ?>

</div>
<div class="col-8">
    

<?php if ($searchModel->q_date): ?>

<?php
echo '<iframe src="https://docs.google.com/viewerng/viewer?url=' . Url::to(Yii::getAlias('@web') . '/msword/ms_word_result.docx', true) . '&embedded=true"  style="width:98%; height:800px;border: none;"></iframe>';
    ?>
    <?php endif; ?>
</div>
</div>
 
