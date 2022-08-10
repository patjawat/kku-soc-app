<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use kartik\detail\DetailView;
use app\models\Category;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Persons */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Persons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$attributes = [
    [
        'group' => true,
        'label' => 'SECTION 1: Identification Information',
        'rowOptions' => ['class' => 'table-info'],
    ],
    [
        'columns' => [
            [
                'attribute' => 'fname',
                'format' => 'raw',
                'value' => Html::a('John Steinbeck', '#', [
                    'class' => 'kv-author-link',
                ]),
                'type' => DetailView::INPUT_TEXT,
                'inputWidth' => '100%',
            ],
            [
                'attribute' => 'lname',
                'format' => 'raw',
                'value' => Html::a('John Steinbeck', '#', [
                    'class' => 'kv-author-link',
                ]),
                'type' => DetailView::INPUT_TEXT,
                'inputWidth' => '100%',
            ],
        ],
    ],
    [
        'columns' => [
            [
                'attribute' => 'study',
                'format' => 'raw',
                'value' => Html::a('John Steinbeck', '#', [
                    'class' => 'kv-author-link',
                ]),
                'type' => DetailView::INPUT_SELECT2,
                'widgetOptions' => [
                    'data' => ArrayHelper::map(
                        Category::find()
                            ->orderBy('name')
                            ->asArray()
                            ->all(),
                        'id',
                        'name'
                    ),
                    'options' => ['placeholder' => 'Select ...'],
                    'pluginOptions' => ['allowClear' => true],
                ],
                'inputWidth' => '100%',
            ],
            [
                'attribute' => 'organization',
                'format' => 'raw',
                'value' => Html::a('John Steinbeck', '#', [
                    'class' => 'kv-author-link',
                ]),
                'type' => DetailView::INPUT_SELECT2,
                'widgetOptions' => [
                    'data' => ArrayHelper::map(
                        Category::find()
                            ->orderBy('name')
                            ->asArray()
                            ->all(),
                        'id',
                        'name'
                    ),
                    'options' => ['placeholder' => 'Select ...'],
                    'pluginOptions' => ['allowClear' => true],
                ],
                'inputWidth' => '100%',
            ],
        ],
    ],
    [
        'columns' => [
            [
                'attribute' => 'position',
                'format' => 'raw',
                'value' => Html::a('John Steinbeck', '#', [
                    'class' => 'kv-author-link',
                ]),
                'type' => DetailView::INPUT_SELECT2,
                'widgetOptions' => [
                    'data' => ArrayHelper::map(
                        Category::find()
                            ->orderBy('name')
                            ->asArray()
                            ->all(),
                        'id',
                        'name'
                    ),
                    'options' => ['placeholder' => 'Select ...'],
                    'pluginOptions' => ['allowClear' => true],
                ],
                'inputWidth' => '40%',
            ],
        ],
    ],

   

    

];
?>


<?php
// echo Date("Y-m-d", strtotime("2021-09-22 +3 Month"));
// echo Date("Y-m-d", strtotime("2013-01-01 +1 Month -1 Day"));
?>
<p>
    <?php Html::a(
            'Update',
            ['update', 'id' => $model->id],
            ['class' => 'btn btn-primary']
        ) ?>
    <?php  Html::a(
            'Delete',
            ['delete', 'id' => $model->id],
            [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]
        ) ?>
</p>

<?php echo DetailView::widget([
        'model' => $model,
        'attributes' => $attributes,
        // 'mode' => 'view',
        'mode' => 'edit',
        'enableEditMode' => true,
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'hAlign' => true,
        'vAlign' => true,
        'fadeDelay' => true,
        'panel' => [
            'type' => 'primary',
            'heading' => 'Contratto' . ' : ' . $model->id . ' ' . $model->fname,
        ],
        // 'panel' => [
        //     'type' => $panelType,
        //     'heading' => $panelHeading,
        //     'footer' => '<div class="text-center text-muted">This is a sample footer message for the detail view.</div>'
        // ],
        'deleteOptions' => [
            // your ajax delete parameters
            'params' => ['id' => 1000, 'kvdelete' => true],
        ],
        'container' => ['id' => 'kv-demo'],
        'formOptions' => ['action' => Url::current(['#' => 'kv-demo'])], // your action to delete
    ]);
//  DetailView::widget([
//     'model' => $model,
//     'attributes' => [
//         'fname',
//         'lname',
//         'organization',
//         'position',
//         'study',
//     ],
// ])
?>




<div class="card card-primary card-outline card-outline-tabs">
    <div class="card-header p-0 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                    href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home"
                    aria-selected="true">กระบวนการ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                    href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                    aria-selected="false">Profile</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-four-tabContent">
            <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel"
                aria-labelledby="custom-tabs-four-home-tab">
                <?=Html::a('add',['/task/create'],['class' => 'btn btn-primary create-task']);?>
<div id="view-task">Loading...</div>
<table class="table">
    <thead>
        <tr>
            <th>1</th>
            <th>2</th>
            <th>3</th>
        </tr>
    </thead>
    <tbody id="tbTask">

    </tbody>
</table>

            </div>
            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                aria-labelledby="custom-tabs-four-profile-tab">
                Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula
                tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas
                sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus.
                Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
            </div>

        </div>
    </div>

</div>



<?php
$id = $model->id;
$getTaskUrl = Url::to(['/task/get-task']);
$js = <<< JS
getTasks() ;
$('.create-task').click(function (e) {
    e.preventDefault();
    $.ajax({
        type: "get",
        url: "/task/create",
        data:{id:$id},
        dataType: "json",
        success: function (response) {
            $('#main-modal').modal('show');
           $('#main-modal-label').html(response.title);
            $('.modal-body').html(response.content);
            $('.modal-footer').html(response.footer);
            $(".modal-dialog").removeClass('modal-sm');
            $(".modal-dialog").addClass('modal-lg');
            $('.modal-content').addClass('card-outline card-primary');
        }
    });

});


function getTasks() {
    $.ajax({
        type: "get",
        url: '$getTaskUrl',
        data:{id:$id},
        dataType: "json",
        success: function (res) {
            $('#view-task').html(res);
            res.each(Result, function (key, value) 
  {
    //  $('#tbTask').append('<tr> <td>' + value.id + '</td>  <td>' + value.id + '</td> <td>' + value.Gender + '</td> <td>' + value.StateId + '</td> <td>' + value.CityId + '</td> <td>' + value.PhoneNumber + '</td> <td>' + value.Salary + '</td></tr>');
  })
        }
    });
}

JS;
$this->registerJS($js,View::POS_END);
?>