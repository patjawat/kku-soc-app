<?php

namespace app\modules\line\controllers;
use Yii;
use app\modules\soc\models\Events;
class EventsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $this->layout = 'main';

        $models  = Events::find()->where(['reporter' => NULL])->all();
        return $this->render('index',['models' => $models]);
    }

}
