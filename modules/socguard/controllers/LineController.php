<?php

namespace app\modules\socguard\controllers;

use Yii;
use app\modules\socguard\models\Borrow;
use app\modules\socguard\models\BorrowSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

class LineController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new BorrowSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionAdd()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new Borrow();
        if($model->save(false)){
            return [
                'status' => true,
                'msg' => 'ส่งคำขอเบิกเรียบร้อย'
            ];
        }
        return $model->save(false);
    }

    public function actionCreate()
    {
        
        $this->layout = 'line';

        // $userId = Yii::$app->user->id;
        // $check = Borrow::findOne([
        //     'created_by' => $userId
        // ]);
        // if($check){
        //     return $this->renderContent('<h1 class="text-center">ท่านได้ส่งคำขอไปแล้ว</h1>');
        // }
        $model = new Borrow();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
        Yii::$app->response->format = Response::FORMAT_JSON;

                $model->save(false);
                // return $model;
                // return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

     /**
     * Updates an existing Borrow model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Borrow model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Borrow model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Borrow the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Borrow::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
