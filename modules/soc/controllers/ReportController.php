<?php

namespace app\modules\soc\controllers;

use app\components\Processor;
use app\modules\soc\models\Events;
use app\modules\soc\models\EventsSearch;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

class ReportController extends \yii\web\Controller

{
    public function actionIndex()
    {
        $searchModel = new EventsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        //*****/ เรียงลำดับวันที่และเวลา
        $dataProvider->setSort([
            'defaultOrder' => [
                'created_at' => SORT_DESC,
            ],
        ]);

        if ($searchModel->q_date) { // ค้นตามวันเวลาที่ระบบ
            $date_explode = explode(" - ", $searchModel->q_date);
            $date1 = trim($date_explode[0]);
            $date2 = trim($date_explode[1]);
            $dataProvider->query->andFilterWhere(['between', 'created_at', $date1, $date2]);

            // $templateProcessor = new TemplateProcessor(Yii::getAlias('@webroot').'/msword/template_in.docx');//เลือกไฟล์ template ที่เราสร้างไว้
            $templateProcessor = new Processor(Yii::getAlias('@webroot') . '/msword/template_in.docx'); //เลือกไฟล์ template ที่เราสร้างไว้
            $templateProcessor->setValue('date1', $date1);
            $templateProcessor->setValue('date2', $date2);
            $templateProcessor->setValue('totalCount', $dataProvider->getTotalCount());


            $templateProcessor2 = new Processor(Yii::getAlias('@webroot') . '/msword/template_in2.docx'); //เลือกไฟล์ template ที่เราสร้างไว้
            $templateProcessor2->setValue('date1', $date1);
            $templateProcessor2->setValue('date2', $date2);
            $templateProcessor2->setValue('totalCount', $dataProvider->getTotalCount());

            $sqlCount = "SELECT *,(SELECT COUNT(events.id) FROM events WHERE events.event_type = category.id AND events.created_at BETWEEN :date1 AND :date2)  as total
        FROM `category`
        WHERE category.category_type = 2

        ORDER BY category.id";

            $counts = Yii::$app->db->createCommand($sqlCount)
                ->bindValue(':date1', $date1)
                ->bindValue(':date2', $date2)
                ->queryAll();
            $templateProcessor->cloneRow('name', sizeof($counts));
            $templateProcessor2->cloneRow('name', sizeof($counts));

            $iCount = 1;
            foreach ($counts as $count) {
                $templateProcessor->setValue('name#' . $iCount, $count['name']);
                $templateProcessor->setValue('total#' . $iCount, $count['total'] > 0 ? $count['total'] : '-');

                $templateProcessor2->setValue('name#' . $iCount, $count['name']);
                $templateProcessor2->setValue('total#' . $iCount, $count['total'] > 0 ? $count['total'] : '-');

                $iCount++;
            }

            $templateProcessor->cloneRow('item', sizeof($dataProvider->getModels()));
            $templateProcessor2->cloneRow('item', sizeof($dataProvider->getModels()));

            $i = 1;
            foreach ($dataProvider->getModels() as $item) {
                $templateProcessor->setValue('no#' . $i, $i);
                $templateProcessor->setValue('no#' . $i, $i);
                $templateProcessor->setValue('item#' . $i, $item->eventType->name);
                $templateProcessor->setValue('approve#' . $i, $item->created_at);
                $templateProcessor->setValue('process_time#' . $i, $item->CountDate());
                $templateProcessor->setValue('result#' . $i, isset($item->resultType) ? $item->resultType->name : '-');
                $templateProcessor->setValue('person_type#' . $i, $item->personType->name);

                $templateProcessor2->setValue('no#' . $i, $i);
                $templateProcessor2->setValue('no#' . $i, $i);
                $templateProcessor2->setValue('item#' . $i, $item->eventType->name);
                $templateProcessor2->setValue('approve#' . $i, $item->created_at);
                $templateProcessor2->setValue('process_time#' . $i, $item->CountDate());
                $templateProcessor2->setValue('result#' . $i, isset($item->resultType) ? $item->resultType->name : '-');
                $templateProcessor2->setValue('person_type#' . $i, $item->personType->name);
                try {
                    //code...
             
                if ($item->ViewPhoto(0)) {
                    $templateProcessor2->setImg('photo1#' . $i, ['src' => Yii::getAlias('@webroot') . '/' . $item->ViewPhoto(0), 'swh' => 150]); //ที่อยู่รูป frontend/web/img/logo.png, swh ความกว้าง/สูง 150
                } else {
                    $templateProcessor2->setValue('photo1#' . $i, '-');
                }
                if ($item->ViewPhoto(1)) {
                    $templateProcessor2->setImg('photo2#' . $i, ['src' => Yii::getAlias('@webroot') . '/' . $item->ViewPhoto(1), 'swh' => 150]); //ที่อยู่รูป frontend/web/img/logo.png, swh ความกว้าง/สูง 150
                } else {
                    $templateProcessor2->setValue('photo2#' . $i, '-');
                }
            } catch (\Throwable $th) {
                //throw $th;
            }

                $i++;
            }

            $templateProcessor->saveAs(Yii::getAlias('@webroot') . '/msword/ms_word_result.docx'); //สั่งให้บันทึกข้อมูลลงไฟล์ใหม่
            $templateProcessor2->saveAs(Yii::getAlias('@webroot') . '/msword/ms_word_result2.docx'); //สั่งให้บันทึกข้อมูลลงไฟล์ใหม่

        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionWord()
    {
        $searchModel = new EventsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        //*****/ เรียงลำดับวันที่และเวลา
        $dataProvider->setSort([
            'defaultOrder' => [
                'created_at' => SORT_DESC,
            ],
        ]);
        $dataProvider->pagination->pageSize = 0;

        if ($searchModel->q_date) { // ค้นตามวันเวลาที่ระบบ
            $date_explode = explode(" - ", $searchModel->q_date);
            $date1 = trim($date_explode[0]);
            $date2 = trim($date_explode[1]);
            $dataProvider->query->andFilterWhere(['between', 'created_at', $date1, ($date2.' 23:59:00')]);

            // $templateProcessor = new TemplateProcessor(Yii::getAlias('@webroot').'/msword/template_in.docx');//เลือกไฟล์ template ที่เราสร้างไว้
            $templateProcessor = new Processor(Yii::getAlias('@webroot') . '/msword/template_in.docx'); //เลือกไฟล์ template ที่เราสร้างไว้
            $templateProcessor->setValue('date1', $date1);
            $templateProcessor->setValue('date2', $date2);
            $templateProcessor->setValue('totalCount', $dataProvider->getTotalCount());


            $templateProcessor2 = new Processor(Yii::getAlias('@webroot') . '/msword/template_in2.docx'); //เลือกไฟล์ template ที่เราสร้างไว้
            $templateProcessor2->setValue('date1', $date1);
            $templateProcessor2->setValue('date2', $date2);
            $templateProcessor2->setValue('totalCount', $dataProvider->getTotalCount());

            $sqlCount = "SELECT *,(SELECT COUNT(events.id) FROM events WHERE events.event_type = category.id AND events.created_at BETWEEN :date1 AND :date2)  as total
        FROM `category`
        WHERE category.category_type = 2

        ORDER BY category.id";

            $counts = Yii::$app->db->createCommand($sqlCount)
                ->bindValue(':date1', $date1)
                ->bindValue(':date2', $date2.' 23:59:00')
                ->queryAll();
            $templateProcessor->cloneRow('name', sizeof($counts));
            $templateProcessor2->cloneRow('name', sizeof($counts));

            $iCount = 1;
            foreach ($counts as $count) {
                $templateProcessor->setValue('name#' . $iCount, $count['name']);
                $templateProcessor->setValue('total#' . $iCount, $count['total'] > 0 ? $count['total'] : '-');

                $templateProcessor2->setValue('name#' . $iCount, $count['name']);
                $templateProcessor2->setValue('total#' . $iCount, $count['total'] > 0 ? $count['total'] : '-');

                $iCount++;
            }

            $templateProcessor->cloneRow('item', sizeof($dataProvider->getModels()));
            $templateProcessor2->cloneRow('item', sizeof($dataProvider->getModels()));

            $i = 1;
            foreach ($dataProvider->getModels() as $item) {
                $templateProcessor->setValue('no#' . $i, $i);
                $templateProcessor->setValue('no#' . $i, $i);
                $templateProcessor->setValue('item#' . $i, $item->eventType->name);
                $templateProcessor->setValue('approve#' . $i, $item->created_at);
                $templateProcessor->setValue('process_time#' . $i, $item->CountDate());
                $templateProcessor->setValue('result#' . $i, isset($item->resultType) ? $item->resultType->name : '-');
                $templateProcessor->setValue('person_type#' . $i, $item->personType->name);

                $templateProcessor2->setValue('no#' . $i, $i);
                $templateProcessor2->setValue('no#' . $i, $i);
                $templateProcessor2->setValue('item#' . $i, $item->eventType->name);
                $templateProcessor2->setValue('approve#' . $i, $item->created_at);
                $templateProcessor2->setValue('process_time#' . $i, $item->CountDate());
                $templateProcessor2->setValue('result#' . $i, isset($item->resultType) ? $item->resultType->name : '-');
                $templateProcessor2->setValue('person_type#' . $i, $item->personType->name);
                try {
                    //code...
             
                if ($item->ViewPhoto(0)) {
                    $templateProcessor2->setImg('photo1#' . $i, ['src' => Yii::getAlias('@webroot') . '/' . $item->ViewPhoto(0), 'swh' => 150]); //ที่อยู่รูป frontend/web/img/logo.png, swh ความกว้าง/สูง 150
                } else {
                    $templateProcessor2->setValue('photo1#' . $i, '-');
                }
                if ($item->ViewPhoto(1)) {
                    $templateProcessor2->setImg('photo2#' . $i, ['src' => Yii::getAlias('@webroot') . '/' . $item->ViewPhoto(1), 'swh' => 150]); //ที่อยู่รูป frontend/web/img/logo.png, swh ความกว้าง/สูง 150
                } else {
                    $templateProcessor2->setValue('photo2#' . $i, '-');
                }
            } catch (\Throwable $th) {
                //throw $th;
            }

                $i++;
            }

            $templateProcessor->saveAs(Yii::getAlias('@webroot') . '/msword/ms_word_result.docx'); //สั่งให้บันทึกข้อมูลลงไฟล์ใหม่
            $templateProcessor2->saveAs(Yii::getAlias('@webroot') . '/msword/ms_word_result2.docx'); //สั่งให้บันทึกข้อมูลลงไฟล์ใหม่
            echo '<p>' . Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web') . '/msword/ms_word_result.docx'), ['class' => 'btn btn-info']) .' | '.Html::a('ดาวน์โหลดเอกสารมีภาพ', Url::to(Yii::getAlias('@web') . '/msword/ms_word_result2.docx'), ['class' => 'btn btn-info']).
            '</p><iframe src="https://docs.google.com/viewerng/viewer?url=' . Url::to(Yii::getAlias('@web') . '/msword/ms_word_result.docx', true) . '&embedded=true"  style="position: absolute;width:100%; height:800px;border: none;"></iframe>';
        }

    }


    
    // public function actionWordStyle1()
    // {

    //     $date1 = $this->request->get('date1');
    //     $date2 = $this->request->get('date2');
    //     // $templateProcessor = new TemplateProcessor(Yii::getAlias('@webroot').'/msword/template_in.docx');//เลือกไฟล์ template ที่เราสร้างไว้
    //     $templateProcessor = new Processor(Yii::getAlias('@webroot') . '/msword/template_in.docx'); //เลือกไฟล์ template ที่เราสร้างไว้
    //     $templateProcessor->setValue('date1', $date1);
    //     $templateProcessor->setValue('date2', $date2);

    //     $templateProcessor2 = new Processor(Yii::getAlias('@webroot') . '/msword/template_in2.docx'); //เลือกไฟล์ template ที่เราสร้างไว้
    //     $templateProcessor2->setValue('date1', $date1);
    //     $templateProcessor2->setValue('date2', $date2);
        
    //     // $templateProcessor->setValue('src1', Yii::getAlias('@webroot') . '/images/auth/login-bg.jpg');
    //     $templateProcessor->setValue('src1', Yii::getAlias('@webroot') . '/var/files/zYbRX_a6c1AzcRUvZn4ttI/0bfd40f5f26ed1c268f3fd16384a2dd4.png');
    //     $templateProcessor->setImg('img1', ['src' => Yii::getAlias('@webroot') . '/images/auth/login-bg.jpg', 'swh' => 150]); //ที่อยู่รูป frontend/web/img/logo.png, swh ความกว้าง/สูง 150

    //     $sqlCount = "SELECT *,(SELECT COUNT(events.id) FROM events WHERE events.event_type = category.id AND events.created_at BETWEEN :date1 AND :date2)  as total
    //     FROM `category`
    //     WHERE category.category_type = 2

    //     ORDER BY category.id";

    //     $counts = Yii::$app->db->createCommand($sqlCount)
    //         ->bindValue(':date1', $date1)
    //         ->bindValue(':date2', $date2)
    //         ->queryAll();
    //     $templateProcessor->cloneRow('name', sizeof($counts));

    //     $iCount = 1;
    //     foreach ($counts as $count) {
    //         $templateProcessor->setValue('name#' . $iCount, $count['name']);
    //         $templateProcessor->setValue('total#' . $iCount, $count['total'] > 0 ? $count['total'] : '-');
    //         $iCount++;
    //     }

    //     if (isset($date1)) {
    //         $datas = Events::find()
    //             ->where(['between', 'created_at', $date1, $date2])->all();
    //     } else {

    //     }

    //     $templateProcessor->cloneRow('item', sizeof($datas));
    //     $i = 1;
    //     foreach ($datas as $item) {
    //         $templateProcessor->setValue('no#' . $i, $i);
    //         $templateProcessor->setValue('no#' . $i, $i);
    //         $templateProcessor->setValue('item#' . $i, $item->eventType->name);
    //         $templateProcessor->setValue('approve#' . $i, $item->created_at);
    //         $templateProcessor->setValue('process_time#' . $i, $item->CountDate());
    //         $templateProcessor->setValue('result#' . $i, isset($item->resultType) ? $item->resultType->name : '-');
    //         $templateProcessor->setValue('person_type#' . $i, $item->personType->name);
    //         $i++;
    //     }

    //     $templateProcessor->saveAs(Yii::getAlias('@webroot') . '/msword/ms_word_result.docx'); //สั่งให้บันทึกข้อมูลลงไฟล์ใหม่
    //     return '<p>' . Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web') . '/msword/ms_word_result.docx'), ['class' => 'btn btn-info']) .
    //     '</p><iframe src="https://docs.google.com/viewerng/viewer?url=' . Url::to(Yii::getAlias('@web') . '/msword/ms_word_result.docx', true) . '&embedded=true"  style="position: absolute;width:100%; height: 100%;border: none;"></iframe>';

    // }

    // public function actionWordStyle2()
    // {

    //     $date1 = $this->request->get('date1');
    //     $date2 = $this->request->get('date2');
    //     // $templateProcessor = new TemplateProcessor(Yii::getAlias('@webroot').'/msword/template_in.docx');//เลือกไฟล์ template ที่เราสร้างไว้
    //     $templateProcessor = new Processor(Yii::getAlias('@webroot') . '/msword/template_in2.docx'); //เลือกไฟล์ template ที่เราสร้างไว้
    //     $templateProcessor->setValue('date1', $date1);
    //     $templateProcessor->setValue('date2', $date2);
    //     $templateProcessor->setImg('img1', ['src' => Yii::getAlias('@webroot') . '/images/auth/login-bg.jpg', 'swh' => 150]); //ที่อยู่รูป frontend/web/img/logo.png, swh ความกว้าง/สูง 150

    //     $sqlCount = "SELECT *,(SELECT COUNT(events.id) FROM events WHERE events.event_type = category.id AND events.created_at BETWEEN :date1 AND :date2)  as total
    //     FROM `category`
    //     WHERE category.category_type = 2

    //     ORDER BY category.id";

    //     $counts = Yii::$app->db->createCommand($sqlCount)
    //         ->bindValue(':date1', $date1)
    //         ->bindValue(':date2', $date2)
    //         ->queryAll();
    //     $templateProcessor->cloneRow('name', sizeof($counts));

    //     $iCount = 1;
    //     foreach ($counts as $count) {
    //         $templateProcessor->setValue('name#' . $iCount, $count['name']);
    //         $templateProcessor->setValue('total#' . $iCount, $count['total'] > 0 ? $count['total'] : '-');
    //         $iCount++;
    //     }

    //     if (isset($date1)) {
    //         $datas = Events::find()
    //             ->where(['between', 'created_at', $date1, $date2])->all();
    //     } else {

    //     }

    //     $templateProcessor->cloneRow('item', sizeof($datas));
    //     $i = 1;
    //     foreach ($datas as $item) {
    //         $templateProcessor->setValue('no#' . $i, $i);
    //         $templateProcessor->setValue('no#' . $i, $i);
    //         $templateProcessor->setValue('item#' . $i, $item->eventType->name);
    //         $templateProcessor->setValue('approve#' . $i, $item->created_at);
    //         $templateProcessor->setValue('process_time#' . $i, $item->CountDate());
    //         $templateProcessor->setValue('result#' . $i, isset($item->resultType) ? $item->resultType->name : '-');
    //         $templateProcessor->setValue('person_type#' . $i, $item->personType->name);
    //         // $templateProcessor->setValue('photo#'.$i,  $item->ViewPhoto(0));
    //         // $templateProcessor->setImg('photo#'.$i, ['src' => Yii::getAlias('@webroot') . '/uploads-file/PEpHFrzSVf4mZ-vwL4bAU7/e5f901976856dd287b1fc60e91827822.jpg', 'swh' => 150]);//ที่อยู่รูป frontend/web/img/logo.png, swh ความกว้าง/สูง 150
    //         if ($item->ViewPhoto(0)) {
    //             $templateProcessor->setImg('photo1#' . $i, ['src' => Yii::getAlias('@webroot') . '/' . $item->ViewPhoto(0), 'swh' => 150]); //ที่อยู่รูป frontend/web/img/logo.png, swh ความกว้าง/สูง 150
    //         } else {
    //             $templateProcessor->setValue('photo1#' . $i, '-');
    //         }
    //         if ($item->ViewPhoto(1)) {
    //             $templateProcessor->setImg('photo2#' . $i, ['src' => Yii::getAlias('@webroot') . '/' . $item->ViewPhoto(1), 'swh' => 150]); //ที่อยู่รูป frontend/web/img/logo.png, swh ความกว้าง/สูง 150
    //         } else {
    //             $templateProcessor->setValue('photo2#' . $i, '-');
    //         }

    //         $i++;
    //     }

    //     $templateProcessor->saveAs(Yii::getAlias('@webroot') . '/msword/ms_word_result2.docx'); //สั่งให้บันทึกข้อมูลลงไฟล์ใหม่
    //     return '<p>' . Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web') . '/msword/ms_word_result2.docx'), ['class' => 'btn btn-info']) .
    //     '</p><iframe src="https://docs.google.com/viewerng/viewer?url=' . Url::to(Yii::getAlias('@web') . '/msword/ms_word_result.docx', true) . '&embedded=true"  style="position: absolute;width:100%; height: 100%;border: none;"></iframe>';

    // }

}
