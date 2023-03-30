<?php

namespace app\modules\line\controllers;

use Yii;
class HookController extends \yii\web\Controller
{
    public function actionIndex()
    {
        // return $this->render('index');
        return Yii::$app->response->statusCode = 200;
    }

}
