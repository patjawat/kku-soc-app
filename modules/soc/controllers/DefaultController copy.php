<?php

namespace app\modules\soc\controllers;

use app\modules\soc\models\Events;
use kartik\wordreport\TemplateReport as KTemplateReport;
use PhpOffice\PhpWord\TemplateProcessor;
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
        $templateProcessor = new TemplateProcessor(Yii::getAlias('@webroot') . '/msword/template_in.docx'); //เลือกไฟล์ template ที่เราสร้างไว้
        // $templateProcessor->setValue('doc_department', 'สำนักเทคโนโลยีสารสนเทศ'); //อัดตัวแปร รายตัว

        // $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(\Yii::$app->basePath . '\web\resources\Sample_07_TemplateCloneRow.docx' );
 
        // Variables on different parts of document
        $templateProcessor->setValue('weekday', date('l')); // On section/content
        $templateProcessor->setValue('time', date('H:i')); // On footer
        // $templateProcessor->setValue('serverName', realpath(__DIR__)); // On header
        // $templateProcessor->setImg('img1', ['src' => Yii::getAlias('@webroot') . '/img/logo.png', 'swh' => 150]);//ที่อยู่รูป frontend/web/img/logo.png, swh ความกว้าง/สูง 150
        $templateProcessor->setImg('img2', ['src' => Yii::getAlias('@webroot') . '/images/cctv.png', 'swh' => 350]);//ที่อยู่รูป frontend/web/images/cell.jpg, swh ความกว้าง/สูง 350




        // Simple table
        $templateProcessor->cloneRow('rowValue', 10);
        
        $templateProcessor->setValue('rowValue#1', htmlspecialchars('Sun'));
        $templateProcessor->setValue('rowValue#2', htmlspecialchars('Mercury'));
        $templateProcessor->setValue('rowValue#3', htmlspecialchars('Venus'));
        $templateProcessor->setValue('rowValue#4', htmlspecialchars('Earth'));
        $templateProcessor->setValue('rowValue#5', htmlspecialchars('Mars'));
        $templateProcessor->setValue('rowValue#6', htmlspecialchars('Jupiter'));
        $templateProcessor->setValue('rowValue#7', htmlspecialchars('Saturn'));
        $templateProcessor->setValue('rowValue#8', htmlspecialchars('Uranus'));
        $templateProcessor->setValue('rowValue#9', htmlspecialchars('Neptun'));
        $templateProcessor->setValue('rowValue#10', htmlspecialchars('Pluto'));
        
        $templateProcessor->setValue('rowNumber#1', htmlspecialchars('1'));
        $templateProcessor->setValue('rowNumber#2', htmlspecialchars('2'));
        $templateProcessor->setValue('rowNumber#3', htmlspecialchars('3'));
        $templateProcessor->setValue('rowNumber#4', htmlspecialchars('4'));
        $templateProcessor->setValue('rowNumber#5', htmlspecialchars('5'));
        $templateProcessor->setValue('rowNumber#6', htmlspecialchars('6'));
        $templateProcessor->setValue('rowNumber#7', htmlspecialchars('7'));
        $templateProcessor->setValue('rowNumber#8', htmlspecialchars('8'));
        $templateProcessor->setValue('rowNumber#9', htmlspecialchars('9'));
        $templateProcessor->setValue('rowNumber#10', htmlspecialchars('10'));
        
        // // Table with a spanned cell
        // $templateProcessor->cloneRow('userId', 3);
        
        // $templateProcessor->setValue('userId#1', htmlspecialchars('1'));
        // $templateProcessor->setValue('userFirstName#1', htmlspecialchars('James'));
        // $templateProcessor->setValue('userName#1', htmlspecialchars('Taylor'));
        // $templateProcessor->setValue('userPhone#1', htmlspecialchars('+1 428 889 773'));
        
        // $templateProcessor->setValue('userId#2', htmlspecialchars('2'));
        // $templateProcessor->setValue('userFirstName#2', htmlspecialchars('Robert'));
        // $templateProcessor->setValue('userName#2', htmlspecialchars('Bell'));
        // $templateProcessor->setValue('userPhone#2', htmlspecialchars('+1 428 889 774'));
        
        // $templateProcessor->setValue('userId#3', htmlspecialchars('3'));
        // $templateProcessor->setValue('userFirstName#3', htmlspecialchars('Michael'));
        // $templateProcessor->setValue('userName#3', htmlspecialchars('Ray'));
        // $templateProcessor->setValue('userPhone#3', htmlspecialchars('+1 428 889 775'));

        
        $templateProcessor->saveAs(Yii::getAlias('@webroot') . '/msword/ms_word_result.docx'); //สั่งให้บันทึกข้อมูลลงไฟล์ใหม่

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

        return '<p>' . Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web') . '/msword/ms_word_result.docx'), ['class' => 'btn btn-info']) .
        '</p><iframe src="https://docs.google.com/viewerng/viewer?url=' . Url::to(Yii::getAlias('@web') . '/msword/ms_word_result.docx', true) . '&embedded=true"  style="position: absolute;width:100%; height: 100%;border: none;"></iframe>';

    }

    public function actionWord2()
    {
        $report = new KTemplateReport([
            'format' => KTemplateReport::FORMAT_BOTH,
            'inputFile' => 'Invoice_Template_01.docx',
            'outputFile' => 'Invoice_Report_' . date('Y-m-d'),
            'values' => ['invoice_no' => 2001, 'invoice_date' => '2020-02-21'],
            'images' => ['company_logo' => '@webroot/images/cctv.png', 'customer_logo' => '@webroot/images/cctv.png'],
            'rows' => [
                'item' => [
                    ['item' => 1, 'name' => 'Potato', 'price' => '$10.00'],
                    ['item' => 2, 'name' => 'Tomato', 'price' => '$20.00'],
                ],
            ],
            'blocks' => [
                'customer_block' => [
                    ['customer_name' => 'John', 'customer_address' => 'Address for John'],
                    ['customer_name' => 'Bill', 'customer_address' => 'Address for Bill'],
                ],
            ],
        ]);
        // Generate the report
        $report->generate();
    }

}
