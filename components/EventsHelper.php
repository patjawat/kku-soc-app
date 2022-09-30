<?php

namespace app\components;

use Yii;
use yii\base\Component;
use app\modules\usermanager\models\User;
use app\modules\soc\models\Events;


class EventsHelper extends Component{
    
    public static function CountPersonType($id=null){

        $model = Events::find()
        ->where(['person_type' => $id])
        ->andwhere(['not',['event_type' => null]])
        ->count();
        return $model;
        // if($id){
        //     $model = User::findOne(['doctor_id' => $id]);
        // }else{
        //     $model = User::findOne(['id' => Yii::$app->user->id]);
        // }

        // if($model){
        //     return $model;
        // }else {
        //     return '';
        // }
    }
    

}

