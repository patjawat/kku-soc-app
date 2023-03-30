<?php

namespace app\modules\api\controllers;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class EventController extends \yii\web\Controller
{

    public function beforeAction($action)
    {
        if ($action->id == 'create') {
            $this->enableCsrfValidation = false; //ปิดการใช้งาน csrf
        }
    
        return parent::beforeAction($action);
    }

    public function behaviors(): array
{
    $behaviors = parent::behaviors();
    $behaviors['corsFilter'] = [
        'class' => \yii\filters\Cors::class,
        'cors' => [
            'Origin' => [Yii::$app->request->getOrigin()],
            'Access-Control-Allow-Credentials' => true,
        ],
    ];
    return $behaviors;
}

    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        Yii::$app->response->statusCode = 200;
        // return $this->render('index');
        return [
            'data' => ['a' => 'A', 'b' => 'B', 'c' => 'C']
        ];
    }

    public function actionCreate(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        Yii::$app->response->statusCode = 200;
        return $this->request->post();


    }

}
