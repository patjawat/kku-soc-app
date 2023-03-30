<?php

namespace app\modules\socguard\controllers;

use app\components\LineHelper;
use app\components\SiteHelper;
use app\components\UserHelper;
use app\modules\usermanager\models\Auth;
use app\modules\usermanager\models\User;
use app\modules\usermanager\models\UserSearch;
use Yii;
use yii\web\Response;
use yii\helpers\Json;

class LineAuthController extends \yii\web\Controller

{
    public function actionIndex()
    {
        $this->layout = 'line';
        return $this->render('index');
    }


    public function actionCheckme()
    {
        $this->layout = 'line';
        $site = SiteHelper::info();
        Yii::$app->response->format = Response::FORMAT_JSON;
        $lineId = $this->request->post('line_id');
        $userId = Yii::$app->user->id;
        //return $site['guard_richmenu_register'];

        $auth = Auth::find()->where(['source_id' => $lineId])->one();
      
        // if ($auth && Yii::$app->user->login($auth->user)) {
           
        //     LineHelper::setMainMenuSocGuard($lineId);
        //     return [
        //         'login' => Yii::$app->user->isGuest ? false : true,
        //         'auth' => $auth
        //     ];
        //     return true;
        // }else{
        //     LineHelper::setRegisterMenuSocGuard($lineId);
        //     return false;
        // }

        if (Yii::$app->user->isGuest) {
            if ($auth && Yii::$app->user->login($auth->user)) {
                LineHelper::setMainMenuSocGuard($lineId);
                return [
                    'isLogin' => Yii::$app->user->isGuest ? false : true
                ];
            } else {
                LineHelper::setRegisterMenuSocGuard($lineId);
                return [
                    'isLogin' => Yii::$app->user->isGuest ? false : true
                ];

            }
        }else{
            LineHelper::setMainMenuSocGuard($lineId);
            return [
                'isLogin' => Yii::$app->user->isGuest ? false : true
            ];
        }
    }


    public function actionSignup()
    {
        $this->layout = 'line';
        // ตรวจสอบการเคยลงทะเบียนจากเยอร์โทรศัพท์
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $site = SiteHelper::info();

        $model = new User([
            'phone' => $searchModel->phone,
            // 'username' => 'admin',
            // 'email' => 'admin@local.com',
            // 'password' => 'admin112233',
            // 'confirm_password' => 'admin112233',
            // 'fullname' => 'admin',
        ]);

        if (isset($searchModel->phone) && $dataProvider->getTotalCount() == 1) {
        // Yii::$app->response->format = Response::FORMAT_JSON;
        $lineId = $searchModel->line_id;
        $phone = $searchModel->phone;


        $user = UserHelper::getUserByPhone($phone);
        
            $auth =  Auth::findOne(['source_id' => $lineId]);
            // return $auth;
            
            if(!$auth){
                return 'new auth';
                $newAuth = new Auth();
                $newAuth->source = 'line';
                $newAuth->user_id = $user['user']->id;
                $newAuth->source_id = $lineId;
                if($newAuth->save(false)){
                    // Yii::$app->user->login($newAuth->user);
                    LineHelper::setMainMenuSocGuard($lineId);
                    return $this->redirect('success');
                }else{
                     return Yii::$app->user->login($user['user']);
                     LineHelper::setMainMenuSocGuard($lineId);
                    return $this->redirect('success');
                }
            }else{
                 Yii::$app->user->login($user['user']);
                     LineHelper::setMainMenuSocGuard($lineId);
                     return $this->redirect('success');
            }

        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // try {
            $model->setPassword($model->password);
            $model->generateAuthKey();

            if ($model->saveUploadedFile() !== false) {
                if ($model->save()) {
                    $model->assignment();
                    $newAuth = new Auth();
                    $newAuth->source = 'line';
                    $newAuth->user_id = $model->id;
                    $newAuth->source_id = $model->line_id;
                    if ($newAuth->save(false)) {
                        LineHelper::setMainMenuSocGuard($model->line_id);

                        if (Yii::$app->user->login($newAuth->user)) {
                            return $this->redirect('success');

                        };
                    }
                }
            }
            // } catch (\Throwable$th) {
            //     //throw $th;
            //     return 'error';
            // }
        } else {
            return $this->render('signup', [
                'model' => $model,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    private function checkRegister($data)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $site = SiteHelper::info();
        $model = UserHelper::getUserByPhone($data->phone);
        // return [
        //     'line_id1' => $data->line_id,
        //     'line_id2' => $data->line
        // ];
        if ($model && ($data->line_id == $model['line_id'])) {
            // $lineId = $model->auth->line_id;
            LineHelper::setMainMenu($model['line_id']);
        }

    }

    public function actionSuccess()
    {
        $this->layout = 'line';

        return $this->render('signup_success', [
        ]);

    }

    public function actionRegisterUser()
    {
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
        if ($user) {
            // Yii::$app->response->format = Response::FORMAT_JSON;
            return $this->render('_form_user', [
                'model' => $user,
            ]);

        } else {
            return $this->renderContent('<h1 class="text-center">ไม่มี user </h1>');
        }
        return $this->render('checkup');

    }

    public function actionSaveUser()
    {
        if (Yii::$app->request->post()) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            $req = Yii::$app->request->post('User');
            $model = User::findOne($req['id']);
            if ($model) {

            }
        }
    }

}
