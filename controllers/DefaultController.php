<?php

namespace app\modules\document\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\Html;
use yii\helpers\Json;
use app\components\EmrHelper;
use app\modules\document\models\Documentqr;
use app\modules\document\models\DocumentqrSearch;

class DefaultController extends Controller {

    public function actionIndex() {

        //$visit_ = TCDSHelper::getVisit();
        $hn = Yii::$app->request->get('hn');

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $this->renderAjax('index', [
                        'hn' => $hn
            ]);
        } else {
            return $this->render('index', [
                        'hn' => $hn
            ]);
        }
    }

    /**
     * EMR เอกสารอื่นๆ
     */
    public function actionOther() {
        $model = new Documentqr();
        $hn = Yii::$app->request->get('hn');
        $searchModel = new DocumentqrSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->joinWith(['docMap']);
        $dataProvider->query->andWhere(['hn' => $hn, 'document_qr_map.document_qr_group_id' => 3]);
        $dataProvider->pagination = ['pageSize' => 100];
        $dataProvider->setSort([
            'defaultOrder' => [
                'created_at' => SORT_DESC,
                'create_time' => SORT_DESC,
                'file_name' => SORT_ASC
            ],
        ]);
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $this->renderAjax('other', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider, 'hn' => $hn, 'model' => $model,]);
        } else {
            return $this->render('other', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider, 'hn' => $hn, 'model' => $model,]);
        }
    }

    public function actionTest() {
        $hn = Yii::$app->request->get('hn');
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $this->renderAjax('test', [
                        'hn' => $hn
            ]);
        } else {
            return $this->render('test', [
                        'hn' => $hn
            ]);
        }
    }

    /**
     * Return image
     * @param string $file_path
     * @return type
     */
    public function actionImage(string $file_path, int $width = 1080, int $height = 1080) {
        $this->setHttpHeaders();
        Yii::$app->response->format = Response::FORMAT_RAW;
        return EmrHelper::getImage($file_path, $width, $height);
    }

    /**
     * Return image
     * @param string $file_path
     * @return type
     */
    public function actionImage2(string $file_path, int $width = 50, int $height = 50) {
        $this->setHttpHeaders();
        Yii::$app->response->format = Response::FORMAT_RAW;
        return EmrHelper::getImage($file_path, $width, $height);
    }

    /**
     * Sets the HTTP headers needed by image response.
     */
    protected function setHttpHeaders() {
        Yii::$app->getResponse()->getHeaders()
                ->set('Pragma', 'public')
                ->set('Expires', '0')
                ->set('Cache-Control', 'must-revalidate, post-check=0, pre-check=0')
                ->set('Content-Transfer-Encoding', 'binary')
                ->set('Content-type', 'image/jpg');
    }

    /**
     * Note Edit
     * @param type $id
     * @return type
     */
    public function actionEditable($id) {
        if (Yii::$app->request->post('hasEditable')) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            // $id = Yii::$app->request->post('editableKey');
            //$edit = Yii::$app->request->post('hasEditable');
            $notes = Yii::$app->request->post('notes');
            $model = Documentqr::findOne($id);
            // $posted = current($_POST['Medication']);
            // $post['Medication'] = $posted;
            if (Yii::$app->request->isPost) {
                $model->data_json = [
                    'notes' => $notes
                ];
                $model->save(false);
                //$value = $_POST['PccMedication'];
                return ['output' => '', 'message' => ''];
            }
            // return Yii::$app->request->post();
        }
    }

    function actionAddComment($id){
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $model = Documentqr::findOne($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->save(false);

            return [
                'id' => $model->id,
                'data' => Json::decode($model->data_json)
            ];
        }

            return [
                'title' => 'Note',
                'content' => $this->renderAjax('form_add_comment',['model' => $model]),
            ];
    
    }

}
