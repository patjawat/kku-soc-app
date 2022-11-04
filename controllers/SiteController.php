<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Events;
use dosamigos\google\maps\LatLng;
use chillerlan\QRCode\QRCode;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $markers = [];
        //กำหนดพิกัดในประเทศไทยเป็นตัวอย่าง
                $min_lat = 8;
                $max_lat = 19;
                $min_long = 98;
                $max_long = 105;
        
                for($i = 1; $i <= 50; $i++){
                    
                    $markers[] = ['place' => 'ทดสอบ '.$i, 'lat_long' => new LatLng(['lat' => rand($min_lat, $max_lat), 'lng' => rand($min_long, $max_long)])];
                }
        return $this->render('index',[
            'markers' => $markers
        ]);
    }
    public function actionIndexOri()
    {
        return $this->render('index_ori');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionMap()
    {
        $markers = [];
//กำหนดพิกัดในประเทศไทยเป็นตัวอย่าง
        $min_lat = 8;
        $max_lat = 19;
        $min_long = 98;
        $max_long = 105;

        for($i = 1; $i <= 50; $i++){
            
            $markers[] = ['place' => 'ทดสอบ '.$i, 'lat_long' => new LatLng(['lat' => rand($min_lat, $max_lat), 'lng' => rand($min_long, $max_long)])];
        }

        return $this->render('map', [
            'markers' => $markers
        ]);
    }

    public function actionQr()
    {
        $hn = Yii::$app->request->post('hn');
        $requester = Yii::$app->request->post('requester');
        // Yii::$app->response->format = Response::FORMAT_JSON;
        // $id = substr(Yii::$app->getSecurity()->generateRandomString(), 10);
       
        $data = 'otpauth://totp/test?secret=B3JX4VCVJDVNXNZ5&issuer=chillerlan.net';
            // $data = Url::base(true).'/index.php?r=reception/default/form-upload&id=';
            $qr = new QRCode();
            
            return $qr->render($data);
            // return '<img src="'.(new QRCode)->render($data).'" alt="QR Code" width="30%"/>';
        }
    

    public function actionQrcode(){
        $this->layout = 'blank';
   return $this->render('qrcode');
   }


   public function actionTest(){
    return $this->render('test');
   }
   
}
