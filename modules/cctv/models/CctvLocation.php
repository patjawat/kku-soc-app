<?php

namespace app\modules\cctv\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\db\Expression;
/**
 * This is the model class for table "cctv_location".
 *
 * @property int $id
 * @property string|null $location_name สถานที่
 * @property string|null $data_json
 * @property int|null $active สถานะ
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class CctvLocation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cctv_location';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data_json'], 'string'],
            [['active', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['location_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'location_name' => 'Location Name',
            'data_json' => 'Data Json',
            'active' => 'Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
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
