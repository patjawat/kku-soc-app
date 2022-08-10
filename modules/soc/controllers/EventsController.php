<?php

namespace app\modules\soc\controllers;

use Yii;
use app\modules\soc\models\Events;
use app\models\Uploads;
use app\models\EventsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use dosamigos\google\maps\LatLng;

use yii\helpers\Url;
use yii\helpers\html;
use yii\web\UploadedFile;

use yii\web\Response;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use app\components\SystemHelper;



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
        // $searchModel = new EventsSearch();
        // $dataProvider = $searchModel->search($this->request->queryParams);

        // return $this->render('index', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        // ]);
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
        
                for($i = 1; $i <= 50; $i++){
                    
                    $markers[] = ['place' => 'ทดสอบ '.$i, 'lat_long' => new LatLng(['lat' => rand($min_lat, $max_lat), 'lng' => rand($min_long, $max_long)])];
                }

                $model = $this->findModel($id);
                list($initialPreview,$initialPreviewConfig) = $this->getInitialPreview($model->ref);

        return $this->render('view', [
            'model' => $model,
            'initialPreview'=>$initialPreview,
          'initialPreviewConfig'=>$initialPreviewConfig,
            'markers' => $markers
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
            'ref' => substr(Yii::$app->getSecurity()->generateRandomString(),10)
        ]);

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        if($this->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return[
                'title' => '<i class="fas fa-user-plus"></i> สร้างใหม่',
                'content' => $this->renderAjax('create', ['model' => $model]),
                'footer' =>''
            ];
        }else {

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    public function actionUserRequest()
    {
        $this->layout = 'blank';
        $model = new Events([
            'ref' => substr(Yii::$app->getSecurity()->generateRandomString(),10)
        ]);

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save(false)) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('_form_public', [
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
        list($initialPreview,$initialPreviewConfig) = $this->getInitialPreview($model->ref);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'initialPreview'=>$initialPreview,
            'initialPreviewConfig'=>$initialPreviewConfig
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
//     private function getInitialPreview($ref) {
//         $datas = Uploads::find()->where(['ref'=>$ref])->all();
//         $initialPreview = [];
//         $initialPreviewConfig = [];
//         foreach ($datas as $key => $value) {
//             array_push($initialPreview, $this->getTemplatePreview($value));
//             array_push($initialPreviewConfig, [
//                 'caption'=> $value->file_name,
//                 'width'  => '120px',
//                 'url'    => Url::to(['/photo-library/deletefile-ajax']),
//                 'key'    => $value->upload_id
//             ]);
//         }
//         return  [$initialPreview,$initialPreviewConfig];
// }



private function getInitialPreview($ref) {
    // $visit_ = TCDSHelper::getVisit();
    // $datas = Documentqr::find()
    //         ->where(['hn' => $hn, 'document_qr_map_id' => $id])
    //         ->orderBy([
    //             // 'created_at' => 'SORT_DESC',
    //             // 'create_time' => 'SORT_DESC',
    //             // 'file_name' => 'SORT_ASC',
    //             'his_an' => 'SORT_DESC',
    //             'document_qr_map_id' => 'SORT_ASC',
    //             'file_name' => 'SORT_ASC',
    //         ])
    //         ->all();
    $datas = Uploads::find()->where(['ref'=>$ref])->all();
    $initialPreview = [];
    $initialPreviewConfig = [];
    foreach ($datas as $value) {
        array_push($initialPreview, SystemHelper::getImageUpload($value->real_filename));
        array_push($initialPreviewConfig, [
            'caption' => $value->file_name,
            'width' => '120px',
            'url' => Url::to('index.php?r=document/documentqr/deletefile-ajax'),
            'key' => $value->upload_id,
        ]);
    }
    return [$initialPreview, $initialPreviewConfig];
}


public function isImage($filePath){
        return @is_array(getimagesize($filePath)) ? true : false;
}

private function getTemplatePreview(Uploads $model){
        $filePath = SystemHelper::getUploadUrl().$model->ref.'/thumbnail/'.$model->real_filename;
        $isImage  = $this->isImage($filePath);
        if($isImage){
            $file = Html::img($filePath,['class'=>'file-preview-image', 'alt'=>$model->file_name, 'title'=>$model->file_name]);
        }else{
            $file =  "<div class='file-preview-other'> " .
                     "<h2><i class='glyphicon glyphicon-file'></i></h2>" .
                     "</div>";
        }
        return $file;
}

private function createThumbnail($folderName,$fileName,$width=250){
  $uploadPath   = SystemHelper::getUploadPath().'/'.$folderName.'/';
  $file         = $uploadPath.$fileName;
  $image        = Yii::$app->image->load($file);
  $image->resize($width);
  $image->save($uploadPath.'thumbnail/'.$fileName);
  return;
}

public function actionDeletefileAjax(){

    $model = Uploads::findOne(Yii::$app->request->post('key'));
    if($model!==NULL){
        $filename  = SystemHelper::getUploadPath().$model->ref.'/'.$model->real_filename;
        $thumbnail = SystemHelper::getUploadPath().$model->ref.'/thumbnail/'.$model->real_filename;
        if($model->delete()){
            @unlink($filename);
            @unlink($thumbnail);
            echo json_encode(['success'=>true]);
        }else{
            echo json_encode(['success'=>false]);
        }
    }else{
      echo json_encode(['success'=>false]);  
    }
}

protected function setHttpHeaders() {
    Yii::$app->getResponse()->getHeaders()
            ->set('Pragma', 'public')
            ->set('Expires', '0')
            ->set('Cache-Control', 'must-revalidate, post-check=0, pre-check=0')
            ->set('Content-Transfer-Encoding', 'binary')
            ->set('Content-type', 'image/jpg');
}

// public function actionImage(string $file_path, int $width = 1080, int $height = 1080) {
public function actionImage() {
    try {
    $file_path = $this->request->get('file_path');
    $width = 1080;
    $height = 1080;
    // $this->setHttpHeaders();
    Yii::$app->response->format = Response::FORMAT_RAW;
        $files = SystemHelper::getImage($file_path, $width, $height);
        // if($files['type' == 'png'])
        // {
        //     return $files['data'];
        // }
        return $files;
    
    } catch (\ImagickException $ex) {
        
    }
}
}