<?php

namespace app\modules\cctv\controllers;

use yii\web\Controller;

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
    
}
