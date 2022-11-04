<?php

namespace app\controllers;
use Yii;
use app\models\Tracking;
use app\models\TrackingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;


/**
 * TrackingController implements the CRUD actions for Tracking model.
 */
class TrackingController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Tracking models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TrackingSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tracking model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tracking model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Tracking();
        $id = $this->request->get('id');
        $model->person_id = $id ? $id :'';

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['/person/view', 'id' => $model->person_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        if($this->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return[
                'title' => 'สร้างใหม่',
                'content' => $this->renderAjax('create', ['model' => $model]),
                'footer' =>''
            ];
        }else {

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Tracking model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['/person/view', 'id' => $model->person_id]);

        }

        if($this->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return[
                'title' => 'แก้ไข',
                'content' => $this->renderAjax('update', ['model' => $model]),
                'footer' =>''
            ];
        }else {

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Tracking model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->delete()){
            return $this->redirect(['/person/view', 'id' => $model->person_id]);
        }

    }

    /**
     * Finds the Tracking model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Tracking the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tracking::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
