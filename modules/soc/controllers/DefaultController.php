<?php

namespace app\modules\soc\controllers;
use Yii;
use app\modules\soc\models\Events;
use yii\helpers\BaseFileHelper;
use yii\web\Controller;
use app\models\Uploads;
use kartik\wordreport\TemplateReport;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;
use yii\web\Response;
use yii\helpers\Html;
use yii\helpers\Url;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;



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

    // public function actionCreateZip($ref){
    //     $zip=new \ZipArchive();
    //     $destination=Yii::getAlias('@webroot').'/'."/filename.zip";
    //     if($zip->open($destination,\ZIPARCHIVE::CREATE) !== true) {
    //         return false;
    //     }
    //     // $doclist=CUploadedFile::getInstancesByName('files');
    //     $files = Uploads::find()->where(['ref' =>$ref])->all();
    //     foreach($files as $thefile)
    //     {
    //         $random=rand(11111,99999);
    //         $filename=$random.$thefile->real_filename;      
    //         $zip->addFile($thefile->tempname,$filename);
    //     }
    //     $zip->close();   
    // }

    public function actionWord()
    {
        // Settings::setTempDir(Yii::getAlias('@webroot').'/temp/'); //กำหนด folder temp สำหรับ windows server ที่ permission denied temp (อย่ายลืมสร้างใน project ล่ะ)
        $templateProcessor = new TemplateProcessor(Yii::getAlias('@webroot').'/msword/template_in.docx');//เลือกไฟล์ template ที่เราสร้างไว้
        $templateProcessor->setValue('doc_department', 'สำนักเทคโนโลยีสารสนเทศ');//อัดตัวแปร รายตัว
        $templateProcessor->setValue(
            [
                'doc_no',
                'doc_date',
                'doc_title',
                'doc_to',
                'doc_detail1',
                'doc_detail2',
                'doc_detail3',
                'doc_name',
                'doc_position'
            ],
            [
                'ทน1234/2345',
                '18 กรกฏาคม 2560',
                'การสร้างระบบออกเอกสารราชการ',
                'ผู้อำนวยการสถาบันเทคโนโลยีสารสนเทศแห่งชาติ',
                'เนื่องด้วยการพัฒนาระบบ Web-based Application ในปัจจุบันประสบปัญหาในการสร้างเอกสารราชการ',
                'กระผมนายมานพ กองอุ่น มีความประสงค์จะพัฒนาระบบการออกเอกสารราชการตามแม่แบบราชการสำหรับใช้งานในระบบ Web-based Application ดังนั้น กระผมจึงพัฒนาตัวอย่างของการออกเอกสารหนังสือราชการ เพื่อเป็นแนวทางให้กับหน่วยงานต่างๆ สามารถนำไปปรับใช้ในระบบ Web-based ของตัวเองได้',
                'จึงเรียนมาเพื่อโปรดทราบ',
                'นายมานพ กองอุ่น',
                'นักเทคโนโลยีสารสนเทศแห่งประเทศไทย'
            ]);//อัดตัวแปรแบบชุด
        $templateProcessor->saveAs(Yii::getAlias('@webroot').'/msword/ms_word_result.docx');//สั่งให้บันทึกข้อมูลลงไฟล์ใหม่

        /*
        //ตัวอย่างการสร้างไฟล์ ms word แบบไม่มี template
        $PHPWord = new PHPWord();
        $PHPWord->setDefaultFontName('TH Sarabun New');
        $PHPWord->setDefaultFontSize(16);

        $section = $PHPWord->createSection();

        $section->addText('ทดสอบข้อความ');
        $section->addTextBreak(2);

        $objWriter = IOFactory::createWriter($PHPWord, 'Word2007');
        $objWriter->save(Yii::getAlias('@webroot').'/msword/ms_word_test.docx');

        $objReader = IOFactory::load(Yii::getAlias('@webroot').'/msword/ms_word_test.docx');
        */

        // echo '<p>';
        // echo Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web').'/msword/ms_word_result.docx'), ['class' => 'btn btn-info']);//สร้าง link download
        // echo '</p>';
        //ลองให้ google doc viewer แสดงข้อมูลไฟล์ให้เห็นผ่าน iframe (อาจเพี้ยนๆ บ้าง)
        // \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return  '<iframe src="https://docs.google.com/viewer?url='.Url::to(Yii::getAlias('@web').'/msword/ms_word_result.docx', true).'&embedded=true"  style="position: absolute;width:100%; height: 100%;border: none;"></iframe>';
    }


}
