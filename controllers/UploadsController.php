<?php

namespace app\controllers;

use Yii;
use app\models\Uploads;
use app\models\UploadsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\html;
use yii\web\UploadedFile;

use yii\web\Response;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use app\components\SystemHelper;


/**
 * UploadsController implements the CRUD actions for Uploads model.
 */
class UploadsController extends Controller
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
     * Lists all Uploads models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UploadsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Uploads model.
     * @param int $upload_id Upload ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($upload_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($upload_id),
        ]);
    }

    /**
     * Creates a new Uploads model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Uploads();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'upload_id' => $model->upload_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Uploads model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $upload_id Upload ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($upload_id)
    {
        $model = $this->findModel($upload_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'upload_id' => $model->upload_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Uploads model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $upload_id Upload ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($upload_id)
    {
        $this->findModel($upload_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Uploads model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $upload_id Upload ID
     * @return Uploads the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($upload_id)
    {
        if (($model = Uploads::findOne(['upload_id' => $upload_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


     /* |*********************************************************************************|
      |================================ Upload Ajax ====================================|
      |*********************************************************************************| */

      public function actionUploadAjax() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $this->Uploads(true);
    }

    private function CreateDir($folderName) {
        if ($folderName != null) {
            $basePath = SystemHelper::getUploadPath();
            if (BaseFileHelper::createDirectory($basePath . $folderName, 0777)) {
                // BaseFileHelper::createDirectory($basePath . $folderName . '/thumbnail', 0777);
            }
        }
        return;
    }

    private function removeUploadDir($dir) {
        BaseFileHelper::removeDirectory(SystemHelper::getUploadPath() . $dir);
    }

    private function Uploads($isAjax=false) {
        if (Yii::$app->request->isPost) {
           $images = UploadedFile::getInstancesByName('upload_ajax');
           if ($images) {

               if($isAjax===true){
                   $ref =Yii::$app->request->post('ref');
               }else{
                   $Uploads = Yii::$app->request->post('Uploads');
                   $ref = $Uploads['ref'];
               }

               $this->CreateDir($ref);

               foreach ($images as $file){
                   $fileName       = $file->baseName . '.' . $file->extension;
                   $realFileName   = md5($file->baseName.time()) . '.' . $file->extension;
                   $savePath       = SystemHelper::UPLOAD_FOLDER.'/'.$ref.'/'. $realFileName;
                   if($file->saveAs($savePath)){

                       if($this->isImage(Url::base(true).'/'.$savePath)){
                            $this->createThumbnail($ref,$realFileName);
                       }

                       $model                  = new Uploads;
                       $model->ref             = $ref;
                       $model->file_name       = $fileName;
                       $model->real_filename   = $realFileName;
                       $model->save();

                       if($isAjax===true){
                           return ['success' => 'true'];
                       }

                   }else{
                       if($isAjax===true){
                           return ['success'=>'false','eror'=>$file->error];
                       }
                   }

               }
           }
       }
}


    // private function Uploads($isAjax = false) {
    //     Yii::$app->response->format = Response::FORMAT_JSON;
    //     $hn = Yii::$app->request->post('hn');
    //     // $hn = $visit_['hn'];
    //     if (Yii::$app->request->isPost) {
    //         $images = UploadedFile::getInstancesByName('upload_ajax');
    //         if ($images) {

    //             // if ($isAjax === true) {
    //             //     $document_qr_map_id = Yii::$app->request->post('document_qr_map_id');
    //             // } else {
    //             //     $Documentqr = Yii::$app->request->post('Documentqr');
    //             //     $document_qr_map_id = $Documentqr['document_qr_map_id'];
    //             // }

    //             $this->CreateDir($hn);

    //             foreach ($images as $file) {
    //                 $date_array = explode(" ", microtime());
    //                 $date = date("Ymd-His", $date_array[1]);
    //                 $date_min = explode(".", $date_array[0]);
    //                 $fileName = $file->baseName . '.' . $file->extension;
    //                 $realFileName =  $date . $date_min[1] . '.' . $file->extension;
    //                 $savePath = SystemHelper::UPLOAD_FOLDER . '/' . $hn . '/' . $realFileName;
    //                 if ($file->saveAs($savePath)) {
    //                     if ($id) {
    //                         // ถ้ามีการ load ภาพจากแผนกต้อนรับโดยการส่งค่า id มา
    //                         $model = Documentqr::findOne($id);
    //                         $model->page = 1;
    //                         $model->file_name = $fileName;
    //                         $model->real_filename = $realFileName;
    //                         $model->print = 0;
    //                         $model->save(false);
    //                     } else {
    //                         // การ upload ปกติมาจาก EMR
    //                         $model = new Documentqr;
    //                         $model->id = substr(Yii::$app->getSecurity()->generateRandomString(), 10);
    //                         $model->hn = $hn;
    //                         $model->his_an = $an;
    //                         $model->page = 1;
    //                         $model->document_qr_map_id = $document_qr_map_id;
    //                         $model->file_name = $fileName;
    //                         $model->real_filename = $realFileName;
    //                         $model->save(false);
    //                     }


    //                     if ($isAjax === true) {
    //                         return ['success' => 'true'];
    //                     }
    //                 } else {
    //                     if ($isAjax === true) {
    //                         return ['success' => 'false', 'eror' => $file->error];
    //                     }
    //                 }
    //             }
    //         }
    //     }
    // }

    private function getInitialPreviewIpd($hn, $id) {
       

        $datas = Documentqr::find()
                ->where(['hn' => $hn, 'document_qr_map_id' => $id])
                ->orderBy([
                    'created_at' => 'SORT_DESC',
                    'create_time' => 'SORT_DESC',
                    'file_name' => 'SORT_ASC',
                ])
                ->all();
        $initialPreview = [];
        $initialPreviewConfig = [];
        foreach ($datas as $key => $value) {
            array_push($initialPreview, SystemHelper::getImageUpload($value->hn, $value->real_filename));
            array_push($initialPreviewConfig, [
                'caption' => $value->file_name,
                'width' => '120px',
                'url' => Url::to('index.php?r=document/documentqr/deletefile-ajax'),
                'key' => $value->id,
            ]);
        }
        return [$initialPreview, $initialPreviewConfig];
        //    return 'zz';
    }

    /**
     * Preview Upload no barcode
     * @param int $hn
     * @param int $id
     * @return string
     */
    private function getInitialPreview($hn, $id) {
        $datas = Documentqr::find()
                ->where(['hn' => $hn, 'document_qr_map_id' => $id])
                ->orderBy([
                    // 'created_at' => 'SORT_DESC',
                    // 'create_time' => 'SORT_DESC',
                    // 'file_name' => 'SORT_ASC',
                    'his_an' => 'SORT_DESC',
                    'document_qr_map_id' => 'SORT_ASC',
                    'file_name' => 'SORT_ASC',
                ])
                ->all();
        $initialPreview = [];
        $initialPreviewConfig = [];
        foreach ($datas as $value) {
            array_push($initialPreview, SystemHelper::getImageUpload($value->hn, $value->real_filename));
            array_push($initialPreviewConfig, [
                'caption' => $value->file_name,
                'width' => '120px',
                'url' => Url::to('index.php?r=document/documentqr/deletefile-ajax'),
                'key' => $value->id,
            ]);
        }
        return [$initialPreview, $initialPreviewConfig];
    }

    public function isImage($filePath) {
        return @is_array(getimagesize($filePath)) ? true : false;
    }

    public function actionDeletefileAjax() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (!SystemHelper::isCanDel()) {
            exit('<span style="font-size:24pt;">! ไม่มีสิทธิลบรูปภาพ กรุณาแจ้งพยาบาลหรือแพทย์เพื่อลบภาพ</span>');
        }
        $model = Documentqr::findOne(Yii::$app->request->post('key'));
        if ($model !== null) {
            $filename = SystemHelper::getUploadPath() . $model->hn . '/' . $model->real_filename;

            if (@unlink($filename) && $model->delete()) {
                return ['success' => true];
            } else {
                throw new NotFoundHttpException('ไม่สามารถลบ ' . $filename . ' ได้');
            }
        } else {
            return ['success' => false];
        }
    }




}
