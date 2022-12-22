<?php

namespace app\modules\usermanager\controllers;
use Yii;
use app\modules\usermanager\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use dektrium\user\models\RegistrationForm;
use dektrium\user\models\User as BaseUser;
use yii\web\UploadedFile;
use mdm\upload\FileModel;
use app\modules\vehicle\models\Booking;
use app\modules\vehicle\models\BookingSearch;

class MeController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $this->layout = '@app/modules/vehicle/views/layouts/main';
        $model = $this->findModel();

        return $this->render('@app/modules/usermanager/views/me/index',[
            'model' => $model,
        ]);
    }



    public function actionUpdate()
    {
        $this->layout = '@app/modules/vehicle/views/layouts/main';
        $model = $this->findModel();
        $model->getRoleByUser();
        $model->password = $model->password_hash;
        $model->confirm_password = $model->password_hash;
        $oldPass = $model->password_hash;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
          if($oldPass!==$model->password){
            $model->setPassword($model->password);
          }

          // Upload image
            // $file = UploadedFile::getInstance($model, 'file');
            // if($fileModel = FileModel::saveAs($file,['uploadPath' => Yii::getAlias('@webroot').'/uploads/users'])){
            // $model->id = $fileModel->id;
            // // End Upload File
            // }

          if($model->save()){
            $model->assignment();
          }

            return $this->redirect(['/me']);
        } else {
            return $this->render('@app/modules/usermanager/views/me/update', [
                'model' => $model,
            ]);
        }
    }


    public function actionLineConnect()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'title' =>'Line Connect',
            'content' => $this->renderAjax('@app/modules/usermanager/views/me/line_connect')
        ];
    }

    protected function findModel()
    {
        if (($model = User::findOne(Yii::$app->user->id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
