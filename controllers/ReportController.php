<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use kartik\mpdf\Pdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;

class ReportController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionQrcode() {
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $this->renderPartial('index'),
            'cssFile' => '@app/web/css/kv-mpdf-bootstrap.css',
            'cssInline' => '.bd{border:1.5px solid; text-align: center;} .ar{text-align:right} .imgbd{border:1px solid}
            .pdfqr{width:3cm;text-align: center;/*border:1px solid #000*/;}
            .pdfdetail{width:17cm;/*border:1px solid red;border-spacing:5px;background-color:#ccc;*/}',
            
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
