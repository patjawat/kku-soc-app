<?php
use yii\helpers\Html;
?>
<?=Html::a('<i class="fas fa-folder"></i>View',['/person/view','id' => $model->id],['class' => 'btn btn-primary btn-sm'])?>
                            <a class="btn btn-info btn-sm" href="#">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                            <a class="btn btn-danger btn-sm" href="#">
                                <i class="fas fa-trash">
                                </i>
                                Delete
                            </a>