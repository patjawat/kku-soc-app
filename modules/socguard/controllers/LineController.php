<?php

namespace app\modules\socguard\controllers;

use app\modules\socguard\models\Borrow;
use app\modules\socguard\models\BorrowSearch;
use Yii;
use yii\db\Expression;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class LineController extends \yii\web\Controller

{

    public function beforeAction($action)
    {
        if ($action->id == 'callback') {
            $this->enableCsrfValidation = false; //ปิดการใช้งาน csrf
        }

        return parent::beforeAction($action);
    }

    private function replyMsg($arrayHeader, $arrayPostData)
    {

        $strUrl = "https://api.line.me/v2/bot/message/reply";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
    }

    public function actionCallback()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        Yii::$app->response->statusCode = 200;
        if ($this->request->isPost) {

            $accessToken = "I8Wrppm5TEPvTnL8hvsfRWPFMDME86w9c7mepmtp5j0V23FyuSyIxmjDNGhqJDb5hEtSHMUsZ3PTm+4e5VabAWnyDIMP60blEBeEGH+iK6Z6LwmfweiuqyLfWdag7gwxLuz0iKqyOboW3VUBnD9NPAdB04t89/1O/w1cDnyilFU="; //copy Channel access token ตอนที่ตั้งค่ามาใส่

            $content = file_get_contents('php://input');
            $arrayJson = json_decode($content, true);

            $arrayHeader = array();
            $arrayHeader[] = "Content-Type: application/json";
            $arrayHeader[] = "Authorization: Bearer {$accessToken}";

            //รับข้อความจากผู้ใช้
            $message = $arrayJson['events'][0]['message']['text'];
            #ตัวอย่าง Message Type "Text"
            if ($message == "สวัสดี") {
                $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
                $arrayPostData['messages'][0]['type'] = "text";
                $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา";
                $this->replyMsg($arrayHeader, $arrayPostData);
            }

            #ตัวอย่าง Message Type "Sticker"
            else if ($message == "ฝันดี") {
                $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
                $arrayPostData['messages'][0]['type'] = "sticker";
                $arrayPostData['messages'][0]['packageId'] = "2";
                $arrayPostData['messages'][0]['stickerId'] = "46";
                $this->replyMsg($arrayHeader, $arrayPostData);
            }
            #ตัวอย่าง Message Type "Image"
            else if ($message == "cat") {
                $image_url = "https://i.pinimg.com/originals/cc/22/d1/cc22d10d9096e70fe3dbe3be2630182b.jpg";
                $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
                $arrayPostData['messages'][0]['type'] = "image";
                $arrayPostData['messages'][0]['originalContentUrl'] = $image_url;
                $arrayPostData['messages'][0]['previewImageUrl'] = $image_url;
                $this->replyMsg($arrayHeader, $arrayPostData);
            }
            #ตัวอย่าง Message Type "Location"
            else if ($message == "พิกัดสยามพารากอน") {
                $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
                $arrayPostData['messages'][0]['type'] = "location";
                $arrayPostData['messages'][0]['title'] = "สยามพารากอน";
                $arrayPostData['messages'][0]['address'] = "13.7465354,100.532752";
                $arrayPostData['messages'][0]['latitude'] = "13.7465354";
                $arrayPostData['messages'][0]['longitude'] = "100.532752";
                $this->replyMsg($arrayHeader, $arrayPostData);
            }
            #ตัวอย่าง Message Type "Text + Sticker ใน 1 ครั้ง"
            else if ($message == "ลาก่อน") {
                $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
                $arrayPostData['messages'][0]['type'] = "text";
                $arrayPostData['messages'][0]['text'] = "อย่าทิ้งกันไป";
                $arrayPostData['messages'][1]['type'] = "sticker";
                $arrayPostData['messages'][1]['packageId'] = "1";
                $arrayPostData['messages'][1]['stickerId'] = "131";
                $this->replyMsg($arrayHeader, $arrayPostData);
            }
        }

    }

    public function actionView($id)
    {

        Yii::$app->response->format = Response::FORMAT_JSON;
        $this->layout = 'line';

        return [
            'title' => 'zz',
            'content' => $this->renderAjax('view', [
                'model' => $this->findModel($id),
            ]),
        ];

    }

    public function actionAdd()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new Borrow();
        if ($model->save(false)) {
            return [
                'status' => true,
                'msg' => 'ส่งคำขอเบิกเรียบร้อย',
            ];
        }
        return $model->save(false);
    }

    public function actionCreate()
    {

        $this->layout = 'line';

        $userId = Yii::$app->user->id;
        $check = Borrow::findOne([
            'created_by' => $userId,
        ]);
        // if($check){
        //     return $this->renderContent('<h1 class="text-center">ท่านได้ส่งคำขอไปแล้ว</h1>');
        // }
        $model = new Borrow();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;

                $model->save(false);
                // return $model;
                // return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'check' => $check,
        ]);
    }

    /**
     * Updates an existing Borrow model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {

            $model->push_date = new Expression('NOW()');
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        if ($this->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return [
                'title' => 'zz',
                'content' => $this->renderAjax('update', [
                    'model' => $model,
                ]),
            ];
        }
        // return $this->render('update', [
        //     'model' => $model,
        // ]);
    }

    /**
     * Deletes an existing Borrow model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Borrow model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Borrow the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Borrow::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
