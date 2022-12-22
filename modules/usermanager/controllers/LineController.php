<?php

namespace app\modules\usermanager\controllers;

use Yii;
use yii\web\Response;
use app\modules\usermanager\models\User;
use app\modules\usermanager\models\Auth;

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
        $userId = Yii::$app->user->id;
        
        // $model = User::findOne(['line_id' => $lineId]);
        $auth = Auth::find()->where(['user_id' => $userId,'source_id' => $lineId])->one();
       
        if(!$auth){
            $newAuth = new Auth();
            $newAuth->source = 'line';
            $newAuth->user_id = $userId;
            $newAuth->source_id = $lineId;
            if($newAuth->save(false)){
                return $this->redirect(['/me']);
            }
        }else{
            return $this->redirect(['/me']);

        }

    }


    public function actionLineAuth(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $lineId = $this->request->post('line_id');
        $auth = Auth::findOne(['source_id' => $lineId]);
        if($auth){
            $user = User::findOne($auth->user_id);
           return Yii::$app->user->login($user);
            // return $this->redirect(['/vehicle/line']);
        }else{

        }
        

    }

    // public function actionAdd()
    // {
    //     $this->layout = 'line';
    //     Yii::$app->response->format = Response::FORMAT_JSON;
    //     $lineId = $this->request->post('line_id');
    //     $userId = Yii::$app->user->id;
        
    //     $user = User::findOne($userId);
    //     $user->line;
       

    // }

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
