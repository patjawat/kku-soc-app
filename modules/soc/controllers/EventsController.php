<?php

namespace app\modules\soc\controllers;

use app\components\SystemHelper;
use app\components\UserHelper;
use app\models\Uploads;
use app\modules\soc\models\Events;
use app\modules\soc\models\EventsSearch;
use dominus77\sweetalert2\Alert;
use dosamigos\google\maps\LatLng;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;
use linslin\yii2\curl;
use yii\helpers\Json;

use kartik\mpdf\Pdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;


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

    public function beforeAction($action)
    {
        if ($action->id == 'callback') {
            $this->enableCsrfValidation = false; //ปิดการใช้งาน csrf
        }
    
        return parent::beforeAction($action);
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
        //*****/ เรียงลำดับวันที่และเวลา
        $dataProvider->setSort([
            'defaultOrder' => [
                'created_at' => SORT_DESC,
            ],
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
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

    public function actionFormUpload()
    {
        $id = $this->request->get('id');

        $model = $this->findModel($id);
        SystemHelper::initialsetDataSession($model->ref);
        list($initialPreview, $initialPreviewConfig) = $this->getInitialPreviewCid($model->ref);

        if ($this->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return [
                'title' => '',
                'content' => $this->renderAjax('_form_upload', [
                    'model' => $model,
                    'initialPreview' => $initialPreview,
                    'initialPreviewConfig' => $initialPreviewConfig,
                ]),
            ];
        } else {
            return $this->render('_form_upload', [
                'model' => $model,
                'initialPreview' => $initialPreview,
                'initialPreviewConfig' => $initialPreviewConfig,
            ]);
        }
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
            $model->accept_pdpa = 0;
            if ($model->load($this->request->post()) && $model->save(false)) {
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
            if ($model->load($this->request->post())) {
                $this->Uploads(false);
                if($model->save(false)) {
                    //ส่ง messages line
                    $this->BroadcastMassage($model);
                }
                return $model->save(false);
                // return $this->redirect(['success', 'id' => $model->id]);

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

    private function BroadcastMassage($model){


         $arrayPostData['messages'][0]['type'] = "text";
         $arrayPostData['messages'][0]['text'] = '#เหตุ : '.$model->eventType->name."\n".'#ผู้เจ้งเหตุ : '.$model->fname.' '.$model->lname ."\n".'เป็น ('.$model->personType->name.')'."\n".'#ข้อมูลเบื้องต้น : '.$model->orther;
    
         $accessToken = "YjWJdP9wvDyfuSnOGB3QPcRY9iDZUjkydzBcXwCB4e6JQGP6JRgufrHP/FhSL/3P9YR1ID09ch6HrWfezByh93J7hd+kgenJPlhebLox9dpw6jszm/tdjfsFfyCdnbpHfwJPXEr9hpHXAPVdnLRMGAdB04t89/1O/w1cDnyilFU=";//copy ข้อความ Channel access token ตอนที่ตั้งค่า
         $arrayHeader = [];
         $arrayHeader[] = "Content-Type: application/json";
         $arrayHeader[] = "Authorization: Bearer {$accessToken}";

        $strUrl = "https://api.line.me/v2/bot/message/broadcast";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
        curl_setopt($ch, CURLOPT_POSTFIELDS, Json::encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
    }


    private function PushMessage($model)
    {
        // Yii::$app->response->format = Response::FORMAT_JSON;

    $accessToken = "YjWJdP9wvDyfuSnOGB3QPcRY9iDZUjkydzBcXwCB4e6JQGP6JRgufrHP/FhSL/3P9YR1ID09ch6HrWfezByh93J7hd+kgenJPlhebLox9dpw6jszm/tdjfsFfyCdnbpHfwJPXEr9hpHXAPVdnLRMGAdB04t89/1O/w1cDnyilFU=";//copy ข้อความ Channel access token ตอนที่ตั้งค่า

    $arrayHeader = [];
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
    $arrayPostData['to'] = 'Uf1f8aae531d88418c5755f8cc4ba6dd1';

    $arrayPostData['messages'][0]['type'] = "text";
    $arrayPostData['messages'][0]['text'] = '#เหตุ : '.$model->eventType->name."\n".'#ผู้เจ้งเหตุ : '.$model->fname.' '.$model->lname ."\n".'เป็น ('.$model->personType->name.')'."\n".'#ข้อมูลเบื้องต้น : '.$model->orther;
    
    $strUrl = "https://api.line.me/v2/bot/message/push";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$strUrl);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
    curl_setopt($ch, CURLOPT_POSTFIELDS, Json::encode($arrayPostData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close ($ch);
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

        $user = UserHelper::getUser('fullname');
        // ถ้าไม่ใช่ผู้รับเหตุ
        // if ($model->reporter !== Yii::$app->user->identity->id) {
        //     return $this->renderContent('<h1 class="text-center mt-5">' . $user . ' ไม่ใช่ผู้รับเรื่อง</h1>');
        // }
        SystemHelper::initialsetDataSession($model->ref);
        list($initialPreview, $initialPreviewConfig) = $this->getInitialPreview($model->ref);

        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($model->save(false)) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        if ($model->reporter == '') {

        }
        return $model->reporter == '' ? $this->renderContent('<h1 class="text-center mt-5">ยังไม่มีผู้รับเรื่อง</h1>') : $this->render('update', [
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
        $model = $this->findModel($id);

        $user = UserHelper::getUser('fullname');
        if ($model->reporter !== Yii::$app->user->identity->id) {
            return $this->renderContent('<h1 class="text-center mt-5">' . $user . ' ไม่ใช่ผู้รับเรื่อง</h1>');
        }

        if ($model->reporter == Yii::$app->user->id) {
            $model->delete();
            return $this->redirect(['index']);
        } else {
            throw new NotFoundHttpException('ไมาสามารถลบข้อมูลของคนอื่นได้');
        }

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

        $datas = Uploads::find()->where(['ref' => $ref])
            ->andWhere(['<>', 'type', 15])
            ->all();
        $initialPreview = [];
        $initialPreviewConfig = [];
        foreach ($datas as $value) {
            array_push($initialPreview, SystemHelper::getFileUpload($value->upload_id));
            array_push($initialPreviewConfig, [
                'caption' => $value->file_name,
                'width' => '300px',
                'url' => Url::to(['/soc/events/deletefile-ajax']),
                'key' => $value->upload_id,
            ]);
        }
        return [$initialPreview, $initialPreviewConfig];
    }

    //แสดงบัตรประชาชน
    private function getInitialPreviewCid($ref)
    {

        $datas = Uploads::find()->where(['ref' => $ref])
            ->andWhere(['type' => 15])
            ->all();
        $initialPreview = [];
        $initialPreviewConfig = [];
        foreach ($datas as $value) {
            array_push($initialPreview, SystemHelper::getFileUpload($value->upload_id));
            array_push($initialPreviewConfig, [
                'caption' => $value->file_name,
                'width' => '300px',
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

    public function actionImage(string $file_path, int $width, int $height)
    {
        Yii::$app->response->format = Response::FORMAT_RAW;
        $file_path = $this->request->get('file_path');
        $files = SystemHelper::getFiles($file_path, $width, $height);

        return $files;
    }

    public function actionVideo()
    {

        Yii::$app->response->format = Response::FORMAT_RAW;
        $id = Yii::$app->request->get('id');
        Yii::$app->getResponse()->getHeaders()
            ->set('Pragma', 'public')
            ->set('Expires', '0')
            ->set('Cache-Control', 'must-revalidate, post-check=0, pre-check=0')
            ->set('Content-Transfer-Encoding', 'binary')
            ->set('Content-type', 'video/mp4');

        $model = Uploads::find()->where(['upload_id' => $id])->One();
        $path = SystemHelper::getUploadPath() . $model->ref . '/' . $model->real_filename;
        $video_data = file_get_contents($path);
        return $video_data;

    }

    public function actionUploadForm()
    {

        if ($this->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return [
                'title' => '<i class="fas fa-cloud-upload-alt"></i> FileUpload',
                'content' => $this->renderAjax('_form_upload', [
                    'initialPreview' => [],
                    'initialPreviewConfig' => [],
                ]),
            ];
        } else {
            return $this->render('_form_upload', [
                'initialPreview' => [],
                'initialPreviewConfig' => [],
            ]);
        }
    }

    public function actionConfirmJob()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $id = $this->request->get('id');
        $model = $this->findModel($id);
        if ($model->reporter !== '') {
            $model->reporter = Yii::$app->user->identity->id;
        }
        if ($model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

    }

    public function actionSaveImage()
    {

        if ($this->request->isPost) {
            $img = $this->request->post('image');
            $ref = $this->request->post('ref');
            // $this->CreateDir($ref);

            Yii::$app->response->format = Response::FORMAT_JSON;

            $savePath = Events::UPLOAD_FOLDER . '/' . $ref . '.jpg';
            $saveFile = file_put_contents($savePath, file_get_contents($img));

            $model = Events::findOne(['ref' => $ref]);
            if ($saveFile) {

                Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                    [
                        'title' => 'บันทึกสำเร็จ!',
                        'text' => 'Your message',
                        'confirmButtonText' => 'เสร็จสิ้น!',
                        'timer' => 1500,
                    ],
                ]);

                //    return $this->redirect(['update', 'id' => $model->id]);
                return $this->redirect(['success', 'id' => $model->id]);
            } else {
                return null;
            }
        }

    }

    /* |*********************************************************************************|
    |================================ Upload Ajax ====================================|
    |*********************************************************************************| */

    public function actionUploadAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $this->Uploads(true);
    }

    private function CreateDir($folderName)
    {
        if ($folderName != null) {
            $basePath = SystemHelper::getUploadPath();
            if (BaseFileHelper::createDirectory($basePath . $folderName, 0777)) {
                // BaseFileHelper::createDirectory($basePath . $folderName . '/thumbnail', 0777);
            }
        }
        return;
    }

    private function removeUploadDir($dir)
    {
        BaseFileHelper::removeDirectory(SystemHelper::getUploadPath() . $dir);
    }

    private function Uploads($isAjax = false)
    {
        if (Yii::$app->request->isPost) {

            $images = UploadedFile::getInstancesByName('upload_ajax');

            if ($images) {

                if ($isAjax === true) {
                    $ref = Yii::$app->request->post('ref');
                    $type = Yii::$app->request->post('category_id');
                } else {
                    $Uploads = Yii::$app->request->post('Events');
                    $ref = $Uploads['ref'];
                    $type = $Uploads['type'];
                }

                $this->CreateDir($ref);

                foreach ($images as $file) {
                    $fileName = $file->baseName . '.' . $file->extension;
                    $realFileName = md5($file->baseName . time()) . '.' . $file->extension;
                    $savePath = SystemHelper::UPLOAD_FOLDER . '/' . $ref . '/' . $realFileName;
                    if ($file->saveAs($savePath)) {

                        if ($this->isImage(Url::base(true) . '/' . $savePath)) {
                            $this->createThumbnail($ref, $realFileName);
                        }

                        $model = new Uploads;
                        $model->ref = $ref;
                        $model->file_name = $fileName;
                        $model->real_filename = $realFileName;
                        $model->type = $type;
                        $model->save();

                        if ($isAjax === true) {
                            return ['success' => 'true'];
                        }

                    } else {
                        if ($isAjax === true) {
                            return ['success' => 'false', 'eror' => $file->error];
                        }
                    }

                }
            }
        }
    }



    public function actionReport() {
       $date1 = $this->request->get('date1');
       $date2 = $this->request->get('date2');

        $searchModel = new EventsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andFilterWhere(['between', 'created_at', $date1, $date2]);

        $doc_ = ['title' => 'สถิติผู้ขอความอนุเคราะ ห์ดูภาพเหตุการณ', 'patient_form' => ''];
    
                $pdf = new Pdf([
                    'mode' => Pdf::MODE_UTF8,
                    // A4 paper format
                    'format' => Pdf::FORMAT_A4,
                    // portrait orientation
                    'orientation' => Pdf::ORIENT_PORTRAIT,
                    // stream to browser inline
                    'destination' => Pdf::DEST_BROWSER,
                    // your html content input
                    'content' => $this->renderPartial('report', ['doc_' => $doc_,'dataProvider' => $dataProvider,'date1' => $date1,'date2' => $date2]),
                    'cssFile' => '@app/web/css/kv-mpdf-bootstrap.css',
                    'cssInline' => '.bd{border:1.5px solid; text-align: center;} .ar{text-align:right} .imgbd{border:1px solid}
                    .pdfhead {height: 3cm;}
                    .pdfqr{width:3cm;text-align: center;/*border:1px solid #000*/;}
                    .pdfdetail{width:17cm;/*border:1px solid red;border-spacing:5px;background-color:#ccc;*/}',
                    'methods' => [
                        'SetTitle' => $doc_['title'],
//                        'SetHeader' => $this->renderPartial('../default/opd_header_1', ['model' => $model, 'doc_' => $doc_, 'qrcode' => $qrcode, 'headtype' => 'OPD']),
                        // 'SetFooter' => ['<table style="font-size: 7pt; width:100%"><tr><td>Print Date :)</td>' . '<td style="text-align:right; width:10%;">Page {PAGENO}</td></tr></table>'],
                    ],
                    'marginLeft' => 4, 'marginRight' => 4, 'marginTop' => 5, 'marginBottom' => 10, 'marginFooter' => 5,
                    'options' => [
                        'defaultheaderline' => 0, //for header
                        'defaulfooterline' => 0  //for footer
                    ],
                ]);
                // Fonts Config
                $defaultConfig = (new ConfigVariables())->getDefaults();
                $fontDirs = $defaultConfig['fontDir'];

                $defaultFontConfig = (new FontVariables())->getDefaults();
                $fontData = $defaultFontConfig['fontdata'];

                $pdf->options['fontDir'] = array_merge($fontDirs, [Yii::getAlias('@webroot') . '/fonts',]);
                $pdf->options['fontdata'] = $fontData + ['angsana' => ['R' => 'Angsana.ttf', 'TTCfontID' => ['R' => 1,],], 'sarabun' => ['R' => 'thsarabunnew-webfont.ttf',],];
               return $pdf->render();
       
    }




}
