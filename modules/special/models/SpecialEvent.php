<?php

namespace app\modules\special\models;

use Yii;
use yii\helpers\Json;
/**
 * This is the model class for table "special_event".
 *
 * @property int $id
 * @property string|null $ref
 * @property string|null $data_json
 * @property string|null $special_date วันที่
 * @property string|null $location สถานที่
 * @property string|null $title หัวเรื่อง
 * @property int|null $special_event_id เหตุการณ์
 */
class SpecialEvent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'special_event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data_json'], 'string'],
            [['special_date'], 'safe'],
            [['special_event_id'], 'integer'],
            [['ref', 'location', 'title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ref' => 'Ref',
            'data_json' => 'Data Json',
            'special_date' => 'วันที่',
            'location' => 'สถานที่',
            'title' => 'หัวเรื่อง',
            'special_event_id' => 'เหตุการณ์',
        ];
    }

    public function afterFind() {
        $this->data_json = Json::decode($this->data_json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        return parent::afterFind();
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            $this->data_json = Json::encode($this->data_json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
           
         
            return true;
        } else {
            return false;
        }
    }
}
