<?php
 $sql = "SELECT *,(SELECT COUNT(events.id) FROM events WHERE events.person_type = category.id AND events.created_at)  as total
 FROM `category`
 WHERE category.category_type = 1
 ORDER BY category.id;";
 $querys = Yii::$app->db->createCommand($sql)
 ->queryAll();

 $data = [];
 foreach ($querys as $key => $row) {
    $data[] = [
        'name' =>  $row['name'],
        'y' =>  $row['total'],
        'sliced'=> $key == 0 ? true : false,
        'selected'=> $key == 0 ? true : false,
    ];
 }
 ?>

<div class="card shadow">
<?php 

echo miloschuman\highcharts\Highcharts::widget([
    'options' => [

        'type'=> 'pie',
        'title' => ['text' => 'Sample title - pie chart'],
        'plotBackgroundColor'=> null,
        'plotBorderWidth'=> null,
        'colorByPoint'=> true,
        'plotShadow'=> false,
            'title'=> [
        'text'=> 'สถิติแบ่งตามประเภทบุคลากร',
        'align'=> 'left'
    ],
    'tooltip'=> [
        'pointFormat'=> '[series.name]=> <b>[point.percentage=>.1f]%</b>'
    ],

    'accessibility'=> [
        'point'=> [
            'valueSuffix'=> '%'
        ]
    ],
        'plotOptions' => [
            'pie'=> [
                            'allowPointSelect'=> true,
                            'cursor'=> 'pointer',
                            // 'dataLabels'=> [
                            //     'enabled'=> true,
                            //     'format'=> '<b>[point.name]</b>=> [point.percentage=>.1f] %'
                            // ]
                        ]
        ],
        
        'series' => [
            [ // new opening bracket
                'type' => 'pie',
                'name' => 'Elements',
                'data' => $data
                // 'data' => [
                //     [
                //                     'name' =>  'Chrome',
                //                     'y' =>  70.67,
                //                     'sliced'=> true,
                //                     'selected'=> true
                //                 ],[
                //                     'name' =>  'Edge',
                //                     'y' =>  14.77
                //                 ],[
                //                     'name' =>  'Firefox',
                //                     'y' =>  4.86
                //                 ]
                // ],
            ] // new closing bracket
        ],
    ],
]);

?>
</div>