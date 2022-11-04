<?php

namespace app\modules\line\controllers;

use Yii;
use yii\web\Controller;
use app\modules\line\models\SignupForm;
use app\modules\usermanager\models\User;

/**
 * Default controller for the `line` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = 'main';
        return $this->render('index');
    }

    public function actionDashboard()
    {
        $this->layout = 'main';
        return $this->render('dashboard');
    }

    public function actionRegister()
    {
        $this->layout = 'main';
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->setPassword($model->password);
            $model->generateAuthKey();
            if($model->save()){
              $model->assignment();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('register', [
                'model' => $model,
            ]);
        }
    }
}
