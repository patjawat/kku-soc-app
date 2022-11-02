<?php

namespace app\modules\soc\controllers;

use app\modules\soc\models\Events;
use yii\base\Response;
use yii\helpers\BaseFileHelper;
use yii\web\Controller;
use app\models\Uploads;
use app\components\SystemHelper;

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

        // $zip_file_name_with_location = "/zip-file/all-image.zip";
        // touch($zip_file_name_with_location); // just create a zip file
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $this->CreateDir($ref);
        $basePath = SystemHelper::getUploadPath().$ref;
        $zip = new \ZipArchive();
        $opening_zip = $zip->open($basePath);
 
        $files = Uploads::find()->where(['ref' =>$ref])->all(); //
       
        $datas= [];
        $zipname = "example_zip"; // give zip file name
        $zip->open($zipname, \ZipArchive::CREATE); 

        foreach ($files as $key => $file) {
            $filename = $basePath.$ref.'/'.$file->real_filename;
                    if(file_exists($filename)) {
                       $zip->addFile($filename); 
                    }
                }
                $zip->close();
    //  return $files;
            // $zip = new ZipArchive(); //Create an object of ZipArchive class
            
        // $zipname = "example_zip"; // give zip file name
        // $zip->open($zipname, ZipArchive::CREATE); //example_zip zip file created

        // foreach ($files as $key => $file) {
        //     $zip->addFile($file); //add each file into example_zip zip file
        // }

        // $zip->close(); // zip file with files created successful now close it
        // return $files;

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

}
