<?php

namespace app\modules\special\controllers;
use Yii;
use app\components\SystemHelper;
use app\models\Uploads;
use app\modules\special\models\SpecialEvent;
use app\modules\special\models\SpecialEventSearch;
class LineController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        $this->layout = 'blank';
        $model = new SpecialEvent([
            'ref' => substr(Yii::$app->getSecurity()->generateRandomString(), 10),
        ]);

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        if ($this->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => '<i class="fas fa-user-plus"></i> สร้างใหม่',
                'content' => $this->renderAjax('create', ['model' => $model]),
                'footer' => '',
            ];
        } else {

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

}
