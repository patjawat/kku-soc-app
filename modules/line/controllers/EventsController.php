<?php

namespace app\modules\line\controllers;

class EventsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
