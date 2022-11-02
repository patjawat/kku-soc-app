<?php

namespace app\modules\soc\controllers;

use app\modules\soc\models\Events;
use yii\helpers\BaseFileHelper;
use yii\web\Controller;
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

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        // $this->CreateDir($ref);
        $basePath = SystemHelper::getUploadPath().$ref;
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

        $zipArchive = new \ZipArchive();
        $zipFile = "@web/download/example-zip-file.zip";
        if ($zipArchive->open($zipFile, \ZipArchive::CREATE) !== true) {
            exit("Unable to open file.");
        }
        // $folder = 'example-folder/';
        $folder = $basePath;
        $this->createZip($zipArchive, $folder);
        $zipArchive->close();
        return 'Zip file created.';

    }


    private function createZip($zipArchive, $folder)
{
    if (is_dir($folder)) {
        if ($f = opendir($folder)) {
            while (($file = readdir($f)) !== false) {
                if (is_file($folder . $file)) {
                    if ($file != '' && $file != '.' && $file != '..') {
                        $zipArchive->addFile($folder . $file);
                    }
                } else {
                    if (is_dir($folder . $file)) {
                        if ($file != '' && $file != '.' && $file != '..') {
                            $zipArchive->addEmptyDir($folder . $file);
                            $folder = $folder . $file . '/';
                            createZip($zipArchive, $folder);
                        }
                    }
                }
            }
            closedir($f);
        } else {
            exit("Unable to open directory " . $folder);
        }
    } else {
        exit($folder . " is not a directory.");
    }
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
