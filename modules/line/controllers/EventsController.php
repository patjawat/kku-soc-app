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


    public function actionMyevent()
    {
        $this->layout = 'main';

        return $this->renderContent('<h1 class="text-center">Soon</h1>');
    }
    

}
