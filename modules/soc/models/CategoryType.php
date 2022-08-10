<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category_type".
 *
 * @property int $id
 * @property string $type_name ประเภท
 * @property string $title ชื่อ
 */
class CategoryType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_name', 'title'], 'required'],
            [['type_name', 'title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_name' => 'ประเภท',
            'title' => 'ชื่อ',
        ];
    }
}
