<?php
 $sqlm1 = "SELECT *,
 (SELECT COUNT(events.id) FROM events WHERE events.event_type = category.id) as total,
 CONCAT(category.name,' จำนวน ',(SELECT COUNT(events.id) FROM events WHERE events.event_type = category.id),' ครั้ง') as total_name,
 (SELECT COUNT(events.id) FROM events WHERE events.event_type = category.id AND MONTH(events.created_at) = 1 )  as m1,
 (SELECT COUNT(events.id) FROM events WHERE events.event_type = category.id AND MONTH(events.created_at) = 2 )  as m2,
 (SELECT COUNT(events.id) FROM events WHERE events.event_type = category.id AND MONTH(events.created_at) = 3 )  as m3,
 (SELECT COUNT(events.id) FROM events WHERE events.event_type = category.id AND MONTH(events.created_at) = 4 )  as m4,
 (SELECT COUNT(events.id) FROM events WHERE events.event_type = category.id AND MONTH(events.created_at) = 5 )  as m5,
 (SELECT COUNT(events.id) FROM events WHERE events.event_type = category.id AND MONTH(events.created_at) = 6 )  as m6,
 (SELECT COUNT(events.id) FROM events WHERE events.event_type = category.id AND MONTH(events.created_at) = 7 )  as m7,
 (SELECT COUNT(events.id) FROM events WHERE events.event_type = category.id AND MONTH(events.created_at) = 8 )  as m8,
 (SELECT COUNT(events.id) FROM events WHERE events.event_type = category.id AND MONTH(events.created_at) = 9 )  as m9,
 (SELECT COUNT(events.id) FROM events WHERE events.event_type = category.id AND MONTH(events.created_at) = 10 )  as m10,
 (SELECT COUNT(events.id) FROM events WHERE events.event_type = category.id AND MONTH(events.created_at) = 11 )  as m11,
 (SELECT COUNT(events.id) FROM events WHERE events.event_type = category.id AND MONTH(events.created_at) = 12 )  as m12
     FROM `category`
     WHERE category.category_type = 2
     ORDER BY total DESC;";
 $querys = Yii::$app->db->createCommand($sqlm1)
 ->queryAll();


 $totalm1 = [];
 foreach($querys as $query){
    $totalm1[] = [
        'type' => 'column',
       'name' => $query['total_name'],
       'data' => [$query['m1'],$query['m2'],$query['m3'],$query['m4'],$query['m5'],$query['m6'],$query['m7'],$query['m8'],$query['m9'],$query['m10'],$query['m11'],$query['m12']]
    ];
    
}

 ?>

<?php 
echo miloschuman\highcharts\Highcharts::widget([
   'options' => [
    'type'=> 'column',
      'title' => ['text' => 'สถิติแยกตามประเภท'],
      'xAxis' => [
         'categories' => ['ม.ค.', 'ก.พ.', 'มี.ค.','เม.ษ.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']
      ],
      'yAxis' => [
         'title' => ['text' => 'สถิติรวมแยกตามรายเดือน'],

      ],
      'legend'=> [
        'layout'=> 'vertical',
        'align'=> 'right',
        'verticalAlign'=> 'middle'
      ],
      'plotOptions'=> [
        'area'=> [
            'pointStart'=> 1940,
            'marker'=> [
                'enabled'=> false,
                'symbol'=> 'circle',
                'radius'=> 2,
                'states'=> [
                    'hover'=> [
                        'enabled'=> true
                    ]
                ]
            ]
        ]
    ],

      'series' => $totalm1
        ,],

]);

?>

