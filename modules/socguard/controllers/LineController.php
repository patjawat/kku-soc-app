<?php

namespace app\modules\socguard\controllers;

use app\modules\socguard\models\Borrow;
use app\modules\socguard\models\BorrowSearch;
use Yii;
use yii\db\Expression;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use app\modules\socguard\models\Product;
use app\modules\socguard\models\ProductSearch;

class LineController extends \yii\web\Controller

{

    public function beforeAction($action)
    {
        if ($action->id == 'callback') {
            $this->enableCsrfValidation = false; //ปิดการใช้งาน csrf
        }
       
        

        return parent::beforeAction($action);
    }

// รายการขอเบิก
    public function actionIndex()
    {
        $this->layout = 'line';

        $searchModel = new BorrowSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->where(['status_id' => 1]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    //รายการส่งคืน
    public function actionSendReturn()
    {
        $this->layout = 'line';

        $searchModel = new BorrowSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->where(['status_id' => 3]);

        return $this->render('send_return', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionHistory()
    {
        $this->layout = 'line';
return $this->renderContent('<h1>History</h1>');
        // $searchModel = new BorrowSearch();
        // $dataProvider = $searchModel->search($this->request->queryParams);
        // $dataProvider->query->where(['not',['status_id' => 4]]);

        // return $this->render('send_return', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        // ]);
    }

    public function actionStore()
    {
        $this->layout = 'line';
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('store', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

        // $searchModel = new BorrowSearch();
        // $dataProvider = $searchModel->search($this->request->queryParams);
        // $dataProvider->query->where(['not',['status_id' => 4]]);

        // return $this->render('send_return', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        // ]);
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

            $accessToken = "CGMsehpiB4zpT9UZLIvE8BGTlzyYUWdh+lYbIOxgKeVW3HJhfo4qkWzVRhZMrvGKhEtSHMUsZ3PTm+4e5VabAWnyDIMP60blEBeEGH+iK6bsp5Bo7JjQhLQ+/EaoaFbgYQVO45dsCaOUQUkNy/tZlQdB04t89/1O/w1cDnyilFU="; //copy Channel access token ตอนที่ตั้งค่ามาใส่

            $content = file_get_contents('php://input');
            $arrayJson = json_decode($content, true);

            $arrayHeader = array();
            $arrayHeader[] = "Content-Type: application/json";
            $arrayHeader[] = "Authorization: Bearer {$accessToken}";

            //รับข้อความจากผู้ใช้
            $message = $arrayJson['events'][0]['message']['text'];
            #ตัวอย่าง Message Type "Text"
            if ($message == "A") {
                $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
                $arrayPostData['actions'][0]['type'] = "url";
                $arrayPostData['actions'][0]['uri'] = "https://tsd.kku.ac.th/site/login";
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

        // Yii::$app->response->format = Response::FORMAT_JSON;
        $this->layout = 'line';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);

    }

    public function actionAdd()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new Borrow([
            'active' => 1,
            'status_id' => 1
        ]);
        if ($model->save(false)) {
            return [
                'status' => true,
                'msg' => 'ส่งคำขอเบิกเรียบร้อย',
            ];
        }
        return $model->save(false);
    }
//รับเครื่องคืน
    public function actionCheckAccept($id)
    {
        $this->layout = 'line';

        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
       
            if($model->status_id == 3){
                $product = Product::findOne($model->product_id);
                $product->active = 0;
                $product->save(false);
                // $model->approve_date = new Expression('NOW()');
                $model->status_id = 4;
                $model->active = 0;
            }
            if($model->save(false)){
                return $this->render('update_success');
            }

           

        }else{
            return $this->render('check_accept', [
                'model' => $model,
            ]);
            
          
        }
    }
    //ส่งคืน
    public function actionReturnTo()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $userId = Yii::$app->user->id;
        $model = Borrow::findOne([
            'created_by' => $userId,
            'active' => 1,
            'status_id' => 2
        ]);
        if($model){
            $model->status_id = 3;
            $model->save(false);
            return [
                'status' => true,
                'msg' => 'ส่งคำขอเบิกเรียบร้อย',
            ];
        }
    }

    public function actionCreate()
    {

        $this->layout = 'line';

        $userId = Yii::$app->user->id;
        $check = Borrow::findOne([
            'created_by' => $userId,
            'active' => 1
        ]);

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
    private function UpdateProduct($id){
        $model = Product::findOne($id);
        $model->active = 1;
        return $model->save();

    }
    public function actionUpdate($id)
    {
        $this->layout = 'line';
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {

            
            $model->active = 1;
            if($model->status_id == 1){
                $model->approve_date = new Expression('NOW()');
                $model->status_id = 2;
                $this->UpdateProduct($model->product_id);
            }
            if($model->save()){
                return $this->render('update_success');
            }
        }


        return $this->render('update', [
            'model' => $model,
        ]);
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
