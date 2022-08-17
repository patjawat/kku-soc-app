<?php

namespace app\components;

use Yii;
use yii\base\Component;
use app\modules\usermanager\models\User;
use app\modules\usermanager\models\UserSearch;

class UserHelper extends Component{
    public static function isUserReadyLogin(){
        return !\Yii::$app->user->isGuest;
    }

    public static function getUser($field){
        $model = User::findOne(['id' => Yii::$app->user->id]);
        return $model->$field;
    }
    public static function getDoctorIs($id=null){
        if($id){
            $model = User::findOne(['doctor_id' => $id]);
        }else{
            $model = User::findOne(['id' => Yii::$app->user->id]);
        }

        if($model){
            return $model;
        }else {
            return '';
        }
    }
    

}

