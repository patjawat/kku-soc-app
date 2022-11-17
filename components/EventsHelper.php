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

    // คำนวน วัน เวลา ที่ผ่านมา
    public static function Duration($begin,$end){
        $remain=intval(strtotime($end)-strtotime($begin));
        $wan=floor($remain/86400);
        $l_wan=$remain%86400;
        $hour=floor($l_wan/3600);
        $l_hour=$l_wan%3600;
        $minute=floor($l_hour/60);
        $second=$l_hour%60;
        // return ($wan > 0 ? $wan." วัน " : "").($hour > 0 ? $hour ." ชั่วโมง " : "").($minute > 0 ? $minute ." นาที " : "").$second." วินาที";
        return ($wan > 0 ? $wan." วัน " : "").($hour > 0 ? $hour ." ชั่วโมง " : "").($minute > 0 ? $minute ." นาที " : "");
    }
    

}

