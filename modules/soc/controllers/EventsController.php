<?php

namespace app\modules\soc\controllers;

use app\components\SystemHelper;
use app\models\Uploads;
use app\modules\soc\models\Events;
use app\modules\soc\models\EventsSearch;
use dominus77\sweetalert2\Alert;
use dosamigos\google\maps\LatLng;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use buttflattery\videowall\Videowall;


/**
 * EventsController implements the CRUD actions for Events model.
 */
class EventsController extends Controller
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
     * Lists all Events models.
     *
     * @return string
     */
    public function actionIndex()
    {
        SystemHelper::initialDataSession();
        $searchModel = new EventsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        if ($searchModel->q_date) { // ค้นตามวันเวลาที่ระบบ
            $date_explode = explode(" - ", $searchModel->q_date);
            $date1 = trim($date_explode[0]);
            $date2 = trim($date_explode[1]);
            $dataProvider->query->andFilterWhere(['between', 'created_at', $date1, $date2]);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Events model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $markers = [];
        //กำหนดพิกัดในประเทศไทยเป็นตัวอย่าง
        $min_lat = 8;
        $max_lat = 19;
        $min_long = 98;
        $max_long = 105;

        for ($i = 1; $i <= 50; $i++) {

            $markers[] = ['place' => 'ทดสอบ ' . $i, 'lat_long' => new LatLng(['lat' => rand($min_lat, $max_lat), 'lng' => rand($min_long, $max_long)])];
        }

        $model = $this->findModel($id);
        list($initialPreview, $initialPreviewConfig) = $this->getInitialPreview($model->ref);

        return $this->render('view', [
            'model' => $model,
            'initialPreview' => $initialPreview,
            'initialPreviewConfig' => $initialPreviewConfig,
            'markers' => $markers,
        ]);
    }

    /**
     * Creates a new Events model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Events([
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

    public function actionUserRequest()
    {
        $this->layout = 'blank';
        $model = new Events([
            'ref' => substr(Yii::$app->getSecurity()->generateRandomString(), 10),
        ]);

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save(false)) {

                return $this->redirect(['success', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('_form_public', [
            'model' => $model,
            'initialPreview' => [],
            'initialPreviewConfig' => [],
        ]);
    }

    public function actionSuccess($id)
    {
        $this->layout = 'blank';
        Yii::$app->session->setFlash(Alert::TYPE_SUCCESS, [
            'title' => 'บันทึกสำเร็จ!',
            'text' => 'กองป้องกันและรักษาความปลอดภัย',
            'showConfirmButton' => false,
            'timer' => 1500,

        ]);
        $model = $this->findModel($id);
        return $this->render('success', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Events model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        SystemHelper::initialsetDataSession($model->ref);
        list($initialPreview, $initialPreviewConfig) = $this->getInitialPreview($model->ref);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save(false)) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        if ($model->reporter == '') {

        }
        return $this->render('update', [
            'model' => $model,
            'initialPreview' => $initialPreview,
            'initialPreviewConfig' => $initialPreviewConfig,
        ]);
    }

    /**
     * Deletes an existing Events model.
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
     * Finds the Events model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Events the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Events::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    // การแสดงภาพ
    private function getInitialPreview($ref)
    {

        $datas = Uploads::find()->where(['ref' => $ref])->all();
        $initialPreview = [];
        $initialPreviewConfig = [];
        foreach ($datas as $value) {
            array_push($initialPreview, SystemHelper::getFileUpload($value->upload_id));
            array_push($initialPreviewConfig, [
                'caption' => $value->file_name,
                'width' => '120px',
                'url' => Url::to(['/soc/events/deletefile-ajax']),
                'key' => $value->upload_id,
            ]);
        }
        return [$initialPreview, $initialPreviewConfig];
    }

    public function isImage($filePath)
    {
        return @is_array(getimagesize($filePath)) ? true : false;
    }

    // private function getTemplatePreview(Uploads $model)
    // {
    //     $filePath = SystemHelper::getUploadUrl() . $model->ref . '/thumbnail/' . $model->real_filename;
    //     $isImage = $this->isImage($filePath);
    //     if ($isImage) {
    //         $file = Html::img($filePath, ['class' => 'file-preview-image', 'alt' => $model->file_name, 'title' => $model->file_name]);
    //     } else {
    //         $file = "<div class='file-preview-other'> " .
    //             "<h2><i class='glyphicon glyphicon-file'></i></h2>" .
    //             "</div>";
    //     }
    //     return $file;
    // }

    private function createThumbnail($folderName, $fileName, $width = 250)
    {
        $uploadPath = SystemHelper::getUploadPath() . '/' . $folderName . '/';
        $file = $uploadPath . $fileName;
        $image = Yii::$app->image->load($file);
        $image->resize($width);
        $image->save($uploadPath . 'thumbnail/' . $fileName);
        return;
    }

    public function actionDeletefileAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = Uploads::findOne(['upload_id' => Yii::$app->request->post('key')]);
        if ($model !== null) {
            $filename = SystemHelper::getUploadPath() . $model->ref . '/' . $model->real_filename;
            // $thumbnail = SystemHelper::getUploadPath().$model->ref.'/thumbnail/'.$model->real_filename;
            if ($model->delete()) {
                @unlink($filename);
                @unlink($thumbnail);
                return ['success' => true];
            } else {
                return ['success' => false];
            }
        } else {
            return ['success' => false];
        }
    }

    protected function setHttpHeaders()
    {
        Yii::$app->getResponse()->getHeaders()
            ->set('Pragma', 'public')
            ->set('Expires', '0')
            ->set('Cache-Control', 'must-revalidate, post-check=0, pre-check=0')
            ->set('Content-Transfer-Encoding', 'binary')
            ->set('Content-type', 'image/jpg');
    }

public function actionImage(string $file_path, int $width, int $height) {
    // public function actionImage()
    // {
        // $width = 1080;
        //     $height = 1080;
            Yii::$app->response->format = Response::FORMAT_RAW;
            $file_path = $this->request->get('file_path');
            $files = SystemHelper::getFiles($file_path, $width, $height);
            
            return $files;

        // try {
        //     Yii::$app->response->format = Response::FORMAT_RAW;
        //     $file_path = $this->request->get('file_path');
        //     $width = 1080;
        //     $height = 1080;
        //     // $this->setHttpHeaders();

        //     $files = SystemHelper::getImage($file_path, $width, $height);

        //     // return $files;
        //     $b = explode('/','ss/aa');
        //     return $b;

        // } catch (\ImagickException$ex) {

        // }
    }

    public function actionVideo()
    {

        Yii::$app->response->format = Response::FORMAT_JSON;
        Yii::$app->getResponse()->getHeaders()
        // ->set('Pragma', 'public')
        // ->set('Expires', '0')
        // ->set('Cache-Control', 'must-revalidate, post-check=0, pre-check=0')
        // ->set('Content-Transfer-Encoding', 'binary')
        ->set('Content-type', 'video/mp4');
        $id = 5;
        // // $path = 'file.mp4';
        $model = Uploads::find()->where(['upload_id' => $id])->One();
        $path = SystemHelper::getUploadPath(). $model->ref.'/'.$model->real_filename;
        $video_data = file_get_contents($path);
        return $video_data;

    }

    public function actionUploadForm(){
        
        if($this->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return [
                'title' => '<i class="fas fa-cloud-upload-alt"></i> FileUpload',
                'content' => $this->renderAjax('_form_upload',[
                    'initialPreview'=>[],
                    'initialPreviewConfig'=>[]
                ]),
            ];
        }else{
            return $this->render('_form_upload',[
                'initialPreview'=>[],
                'initialPreviewConfig'=>[]
            ]);
        }
    }
}
