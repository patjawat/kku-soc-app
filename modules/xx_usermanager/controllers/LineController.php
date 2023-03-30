<?php

namespace app\modules\usermanager\controllers;

use Yii;
use yii\web\Response;
use app\modules\usermanager\models\User;

class LineController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $this->layout = 'line';
        return $this->render('index');
    }

    public function actionProfile()
    {
        $this->layout = 'line';
        Yii::$app->response->format = Response::FORMAT_JSON;
        $lineId = $this->request->post('line_id');
        
        $model = User::findOne(['line_id' => $lineId]);
       
        if(!$model){
            $userModel = new User();

        
                return $this->render('checkphone', [
                    'model' => $userModel,
                ]);
        
            // return $this->renderAjax('register');
        }else{
             return $this->renderAjax('profile');

        }

    }

    public function actionRegisterUser(){
        // if (Yii::$app->request->post()) {
        //     Yii::$app->response->format = Response::FORMAT_JSON;
        //     // $user = Yii::$app->request->post('User');

        //     // $userModel->setPassword($userModel->password);
        //     // $userModel->generateAuthKey();
        //     // if($userModel->save()){
        //     //   $userModel->assignment();
        //     // }
        //     // return $this->redirect(['view', 'id' => $userModel->id]);
        // }
        $this->layout = 'line';
        $data = Yii::$app->request->post('User');
        $user = User::findOne(['phone' => $data['phone']]);
        if($user)
        {
            // Yii::$app->response->format = Response::FORMAT_JSON;
            return $this->render('_form_user',[
                'model' => $user
            ]);

        }else{
            return $this->renderContent('<h1 class="text-center">ไม่มี user </h1>');
        }
        return $this->render('checkup');
    
    }

    public function actionSaveUser()
    {
        if (Yii::$app->request->post()) 
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

           $req = Yii::$app->request->post('User');
           $model = User::findOne($req['id']);
           if($model)
           {
            
           }
        }
    }
    

}
