<?php
$this->title = 'Dashboard';
use yii\helpers\Html;

$this->title = '<i class="fas fa-tachometer-alt"></i> Dashboard';
use miloschuman\highcharts\Highcharts;
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<style>
.small-box {
    border-radius: 1.2rem;
    box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
    display: block;
    margin-bottom: 20px;
    position: relative;
}
</style>
<div class="container-fluid">


<?=$this->render('counter-style1')?>
<?php $this->render('counter-style2')?>
    <div class="row">
        <div class="col-8">
           <?=$this->render('map', [
            'markers' => $markers
        ]);?>
        </div>
        <div class="col-md-4">

        <?php
        //  echo Highcharts::widget([
        //         'options' => [
        //             'chart' => [
        //                 'type' => 'column',
        //             ],
        //             'title' => ['text' => 'สถิติแบ่งตามคณะ'],
        //             'xAxis' => [
        //                 'categories' => [
        //                     'คณะแพทยศาสตร์',
        //                     'คณะมนุษยศาสตร์และสังคมศาสตร์',
        //                     'คณะวิศวกรรมศาสตร์',
        //                     'คณะศิลปกรรมศาสตร์',
        //                     'คณะวิทยาศาสตร์',
        //                     'คณะเทคโนโลยี',
        //                     'คณะเภสัชศาสตร์',
        //                     'คณะเกษตรศาสตร์',
        //                 ],
        //             ],
        //             'yAxis' => [
        //                 'title' => ['text' => 'Fruit eaten'],
        //             ],
        //             'series' => [
        //                 ['name' => 'คน', 'data' => [5, 17, 3, 5, 10, 4, 4, 2]],
        //             ],
        //         ],
        //     ]);
             ?>
           


            <?=$this->render('event_type')?>

        </div>
    </div>
</div>
<?php // $this->render('event')?>