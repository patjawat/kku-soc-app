<?php

namespace app\modules\cctv\models;

use Yii;

/**
 * This is the model class for table "cctv_items".
 *
 * @property int $id
 * @property int|null $cctv_location_id สถานที่ตั้ง
 * @property string|null $title
 * @property string|null $name
 * @property string|null $address
 * @property string|null $description รายละเอีดยเพิ่มเติม
 * @property int|null $active สถานะ
 * @property string|null $data_json
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class CctvItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cctv_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cctv_location_id', 'active', 'created_by', 'updated_by'], 'integer'],
            [['data_json'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'name', 'address', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cctv_location_id' => 'Cctv Location ID',
            'title' => 'Title',
            'name' => 'Name',
            'address' => 'Address',
            'description' => 'รายบะเอียดเพิ่มเติม',
            'active' => 'Active',
            'data_json' => 'Data Json',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
