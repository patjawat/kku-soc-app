<?php
use yii\helpers\Html;
?>
<ul class="list-inline">
                                <?php foreach($model->readers as $reader):?>
                                <li class="list-inline-item">
                                    <?=Html::img('@web/img/avatar.png',['class' => 'brand-image img-circle elevation-3','width' =>50]);?>
                    
                                </li>
                                <?php endforeach;?>
                            </ul>