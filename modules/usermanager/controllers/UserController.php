<?php

namespace app\modules\usermanager\controllers;

use Yii;
use app\modules\usermanager\models\User;
use app\modules\usermanager\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use dektrium\user\models\RegistrationForm;
use dektrium\user\models\User as BaseUser;
use yii\web\UploadedFile;
use mdm\upload\FileModel;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['pageSize' => 20];
        // $dataProvider->query->andFilterWhere(['username' => $searchModel->q]);
        $dataProvider->query->andFilterWhere(['or',
        ['like', 'username', $searchModel->q],
        ['like', 'fullname', $searchModel->q],
        ['like', 'email', $searchModel->q]

    ]);
        if (Yii::$app->request->isAjax) {
        Yii::$app->response->format = Response::FORMAT_JSON;
            return $this->renderAjax('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }else {
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->setPassword($model->password);
            $model->generateAuthKey();

            //  // Upload image
            //  $file = UploadedFile::getInstance($model, 'file');
            //  if($fileModel = FileModel::saveAs($file,['uploadPath' => Yii::getAlias('@webroot').'/uploads/users'])){
            //  $model->photo = $fileModel->id;
            //  // End Upload File
            //  }
             
            if($model->save()){
              $model->assignment();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->getRoleByUser();
        $model->password = $model->password_hash;
        $model->confirm_password = $model->password_hash;
        $oldPass = $model->password_hash;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->saveUploadedFile() !== false) {
          if($oldPass!==$model->password){
            $model->setPassword($model->password);
          }

          if($model->save()){
            $model->assignment();
          }

            return $this->redirect(['view', 'id' => $model->id]);
        }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
