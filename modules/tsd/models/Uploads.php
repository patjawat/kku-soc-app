<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "uploads".
 *
 * @property int $upload_id
 * @property string|null $ref
 * @property string|null $file_name ชื่อไฟล์
 * @property string|null $real_filename ชื่อไฟล์จริง
 * @property string|null $create_date
 * @property int|null $type ประเภท
 */
class Uploads extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uploads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_date'], 'safe'],
            [['type'], 'integer'],
            [['ref'], 'string', 'max' => 50],
            [['file_name', 'real_filename'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'upload_id' => 'Upload ID',
            'ref' => 'Ref',
            'file_name' => 'ชื่อไฟล์',
            'real_filename' => 'ชื่อไฟล์จริง',
            'create_date' => 'Create Date',
            'type' => 'ประเภท',
        ];
    }
}
