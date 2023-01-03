<?php

namespace app\modules\socguard\models;

use Yii;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\db\Expression;

use \yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
/**
 * This is the model class for table "borrow".
 *
 * @property int $id
 * @property string|null $item_code รหัสเลขเครื่อง
 * @property string|null $product_id หมายเลขเครื่อง
 * @property string|null $data_json
 * @property int|null $active สถานะ
 * @property string|null $pull_date วันที่รับคืน
 * @property string|null $pull_user_id ผู้รับคืน
 * @property string|null $updated_at
 * @property string $created_at
 * @property int|null $created_by ผู้สร้าง
 * @property int|null $updated_by ผู้แก้ไข
 */
class Borrow extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'borrow';
    }

    /**
     * {@inheritdoc}
     */

     public function behaviors() {
        return [
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at']],
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at'],
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ]
        ];
     }

    public function rules()
    {
        return [
            [['data_json'], 'string'],
            [['active', 'created_by', 'updated_by'], 'integer'],
            [['pull_date', 'pull_user_id', 'updated_at', 'created_at','push_date'], 'safe'],
            [['item_code', 'product_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_code' => 'รหัสเลขเครื่อง',
            'product_id' => 'หมายเลขเครื่อง',
            'data_json' => 'Data Json',
            'active' => 'สถานะ',
            'pull_date' => 'วันที่รับคืน',
            'pull_user_id' => 'ผู้รับคืน',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
            'created_by' => 'ผู้สร้าง',
            'updated_by' => 'ผู้แก้ไข',
        ];
    }
}
