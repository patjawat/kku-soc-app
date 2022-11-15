<?php

namespace app\modules\soc\controllers;

use app\modules\soc\models\Events;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Settings;
use Yii;
use yii\helpers\BaseFileHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;

/**
 * Default controller for the `cctv` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionZip($ref)
    {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        // $this->CreateDir($ref);
        // $basePath = SystemHelper::getUploadPath().$ref;
        // $zip = new \ZipArchive();
        // $opening_zip = $zip->open($basePath);

        // $files = Uploads::find()->where(['ref' =>$ref])->all(); //

        // $datas= [];
        // $destination="@web/download/filename.zip";
        // $zip->open($destination, \ZipArchive::CREATE);

        // foreach ($files as $key => $file) {
        //     $filename = $basePath.$ref.'/'.$file->real_filename;
        //             if(file_exists($filename)) {
        //                $zip->addFile($filename);
        //             }
        //         }
        // $zip->close();

        // $zipArchive = new \ZipArchive();
        // $zipFile = "./example-zip-file.zip";
        // if ($zipArchive->open($zipFile, \ZipArchive::CREATE) !== true) {
        //     exit("Unable to open file.");
        // }
        // $folder = 'example-folder/';
        // createZip($zipArchive, $folder);
        // $zipArchive->close();
        // return 'Zip file created.';

    }

    private function CreateDir($folderName)
    {
        if ($folderName != null) {
            // $basePath = SystemHelper::getUploadPath();
            $basePath = Events::getDownloadPath();
            if (BaseFileHelper::createDirectory($basePath . $folderName, 0777)) {

            }
        }
        return;
    }
    public function actionWord()
    {
        $date1 = $this->request->get('date1');
        $date2 = $this->request->get('date2');

        $templateProcessor = new TemplateProcessor(Yii::getAlias('@webroot').'/msword/template_in.docx');//เลือกไฟล์ template ที่เราสร้างไว้
        $templateProcessor->setValue('date1', $date1);
        $templateProcessor->setValue('date2', $date2);

        $sqlCount  = "SELECT *,(SELECT COUNT(events.id) FROM events WHERE events.event_type = category.id AND events.created_at BETWEEN :date1 AND :date2)  as total 
        FROM `category`
        WHERE category.category_type = 2
        
        ORDER BY category.id";

        $counts = Yii::$app->db->createCommand($sqlCount)
        ->bindValue(':date1', $date1)
        ->bindValue(':date2', $date2)
        ->queryAll();
        $templateProcessor->cloneRow('name', sizeof($counts));

        $iCount = 1;
        foreach($counts as $count){
                    $templateProcessor->setValue('name#'.$iCount, $count['name']);
                    $templateProcessor->setValue('total#'.$iCount, $count['total']);
                    $iCount++;
                }

        if(isset($date1)){
            $datas = Events::find()
            ->where(['between', 'created_at',$date1, $date2 ])->all();
        }else{

        }
        
        $templateProcessor->cloneRow('item', sizeof($datas));
        $i = 1;
    foreach($datas as $item){
    $templateProcessor->setValue('no#'.$i, $i);
            $templateProcessor->setValue('no#'.$i, $i);
            $templateProcessor->setValue('item#'.$i, $item->eventType->name);
            $templateProcessor->setValue('approve#'.$i, $item->created_at);
            $templateProcessor->setValue('process_time#'.$i, '-');
            $templateProcessor->setValue('result#'.$i, isset($item->resultType) ? $item->resultType->name : '-');
            $templateProcessor->setValue('person_type#'.$i, $item->personType->name);
            $i++;
        }

        $templateProcessor->saveAs(Yii::getAlias('@webroot').'/msword/ms_word_result.docx');//สั่งให้บันทึกข้อมูลลงไฟล์ใหม่
        return '<p>' . Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web') . '/msword/ms_word_result.docx'), ['class' => 'btn btn-info']) .
        '</p><iframe src="https://docs.google.com/viewerng/viewer?url=' . Url::to(Yii::getAlias('@web') . '/msword/ms_word_result.docx', true) . '&embedded=true"  style="position: absolute;width:100%; height: 100%;border: none;"></iframe>';
   
        }


}
