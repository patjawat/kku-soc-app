
    <?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use edofre\markerclusterer\Map;
use edofre\markerclusterer\Marker;
use app\components\SystemHelper;


/* @var $this yii\web\View */
/* @var $model app\models\Events */

$this->title = 'แสดงรายละเอียเเหตุการณ์';
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>

<div class="justify-content-center mt-5">

<div class="alert alert-success" role="alert">
<strong>บันทึกข้อมูลสำเร็จ</strong> : เจ้าหน้าที่จะทำการตวจสอบขอบคุณค่ะ
</div>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fullname',
            'person_type',
            'department',
            'address',
            'phone',
            'event_date',
            'event_type',
            'orther',
        ],
    ]) ?>

</div>



<!-- <div class="d-flex justify-content-center">
    <h1>บันทึกข้อมูลสำเร็จ!</h1>
    </div> -->