<?php

namespace app\modules\soc\controllers;

use Yii;
use yii\helpers\BaseFileHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Settings;
use app\components\Processor;
use app\modules\soc\models\Events;
use app\modules\soc\models\EventsSearch;

class ReportController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new EventsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        if ($searchModel->q_date) { // ค้นตามวันเวลาที่ระบบ
            $date_explode = explode(" - ", $searchModel->q_date);
            $date1 = trim($date_explode[0]);
            $date2 = trim($date_explode[1]);
            $dataProvider->query->andFilterWhere(['between', 'created_at', $date1, $date2]);

            $sqlCount  = "SELECT *,(SELECT COUNT(events.id) FROM events WHERE events.event_type = category.id AND events.created_at BETWEEN :date1 AND :date2)  as total 
            FROM `category`
            WHERE category.category_type = 2
            
            ORDER BY category.id";
    
            $counts = Yii::$app->db->createCommand($sqlCount)
            ->bindValue(':date1', $date1)
            ->bindValue(':date2', $date2)
            ->queryAll();

        }
        //*****/ เรียงลำดับวันที่และเวลา
        $dataProvider->setSort([
            'defaultOrder' => [
                'created_at' => SORT_DESC,
            ],
        ]);


        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'counts' =>  isset($counts) ? $counts : []
        ]);
    }

    public function actionWordStyle1()
    {

        $date1 = $this->request->get('date1');
        $date2 = $this->request->get('date2');
        // $templateProcessor = new TemplateProcessor(Yii::getAlias('@webroot').'/msword/template_in.docx');//เลือกไฟล์ template ที่เราสร้างไว้
        $templateProcessor = new Processor(Yii::getAlias('@webroot').'/msword/template_in.docx');//เลือกไฟล์ template ที่เราสร้างไว้
        $templateProcessor->setValue('date1', $date1);
        $templateProcessor->setValue('date2', $date2);
        // $templateProcessor->setValue('src1', Yii::getAlias('@webroot') . '/images/auth/login-bg.jpg');
        $templateProcessor->setValue('src1', Yii::getAlias('@webroot') . '/var/files/zYbRX_a6c1AzcRUvZn4ttI/0bfd40f5f26ed1c268f3fd16384a2dd4.png');
        $templateProcessor->setImg('img1', ['src' => Yii::getAlias('@webroot') . '/images/auth/login-bg.jpg', 'swh' => 150]);//ที่อยู่รูป frontend/web/img/logo.png, swh ความกว้าง/สูง 150 
        // $templateProcessor->setImageValue('img1', ['src' => Yii::getAlias('@webroot') . '/images/auth/login-bg.jpg', 'swh' => 150]);//ที่อยู่รูป frontend/web/img/logo.png, swh ความกว้าง/สูง 150 
        // $templateProcessor->setImageValue('img1', ['src' => Yii::getAlias('@webroot') . '/images/auth/login-bg.jpg', 'swh' => 150]);//ที่อยู่รูป frontend/web/img/logo.png, swh ความกว้าง/สูง 150 
        // $templateProcessor->setImg('img2', ['src' => Yii::getAlias('@webroot') . '/images/cctv.png', 'swh' => 350]);//ที่อยู่รูป frontend/web/images/cell.jpg, swh ความกว้าง/สูง 350



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
                    $templateProcessor->setValue('total#'.$iCount, $count['total'] > 0 ? $count['total'] : '-');
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
            $templateProcessor->setValue('process_time#'.$i, $item->CountDate());
            $templateProcessor->setValue('result#'.$i, isset($item->resultType) ? $item->resultType->name : '-');
            $templateProcessor->setValue('person_type#'.$i, $item->personType->name);
            $i++;
        }


        $templateProcessor->saveAs(Yii::getAlias('@webroot').'/msword/ms_word_result.docx');//สั่งให้บันทึกข้อมูลลงไฟล์ใหม่
        return '<p>' . Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web') . '/msword/ms_word_result.docx'), ['class' => 'btn btn-info']) .
        '</p><iframe src="https://docs.google.com/viewerng/viewer?url=' . Url::to(Yii::getAlias('@web') . '/msword/ms_word_result.docx', true) . '&embedded=true"  style="position: absolute;width:100%; height: 100%;border: none;"></iframe>';
   
        }

}
