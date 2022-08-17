<?php

namespace app\modules\soc\models;

use Yii;
use yii\helpers\Json;
use yii\db\Expression;
use \yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use app\components\SystemHelper;
use app\models\Uploads;
use app\models\Category;

class Events extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $q_date;

    public static function tableName()
    {
        return 'events';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data_json', 'worker'], 'string'],
            [['fname', 'lname', 'person_type', 'address', 'phone', 'event_date', 'event_location_note'], 'required'],
            [['person_type', 'event_type', 'result', 'backup_to', 'backup_type', 'reporter', 'created_by', 'updated_by'], 'integer'],
            [['event_date', 'updated_at', 'created_at','q_date'], 'safe'],
            [['ref', 'fname', 'lname', 'fullname', 'department', 'address', 'phone', 'orther', 'event_location_note', 'lat', 'lng', 'work_img', 'docs', 'note'], 'string', 'max' => 255],
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
            'fname' => 'ชื่อ',
            'lname' => 'สกุล',
            'fullname' => 'ชื่อ-สกุล',
            'person_type' => 'ประเภทบุคคล',
            'department' => 'คณะ/หน่วยงาน/สถานที่ทำงาน/สถานศึกษา',
            'address' => 'ที่อยู่ตามทะเบียนบ้าน',
            'phone' => 'หมายเลขโทรศัพท์',
            'event_date' => 'วันและเวลาที่เกิดเหตุ',
            'event_type' => 'เหตุการณ์',
            'orther' => 'รายละเอียดเพิ่มเติม',
            'event_location_note' => 'บริเวณสถานที่เกิดเหตุ',
            'lat' => 'latitude',
            'lng' => 'lngitude',
            'work_img' => 'รูปภาพการปฏิบัติการ',
            'docs' => 'เอกสารแนบใบคำขอ',
            'result' => 'ผลการให้บริการดูกล้องวงจรปิด',
            'note' => 'รายงานการดำเนินการ',
            'backup_to' => 'การขอสำรองข้อมูลให้',
            'backup_type' => 'ประเภทไฟล์ข้อมูล',
            'reporter' => 'ผู้รายงานเหตุ',
            'worker' => 'ผู้ร่วมปฏิบัติงาน',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
            'created_by' => 'ผู้สร้าง',
            'updated_by' => 'ผู้แก้ไข',
        ];
    }

    public function behaviors() {
       return [
//            [
//                'class' => AttributeBehavior::className(),
//                'attributes' => [ActiveRecord::EVENT_BEFORE_INSERT => ['id']],
//                'value' => function() {
//                    return DateTimeHelper::getDbDateTimeNow();
//                }
//            ],
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

    public function afterFind() {
        $this->data_json = Json::decode($this->data_json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        return parent::afterFind();
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            $this->data_json = Json::encode($this->data_json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            $this->fullname = $this->fname.' '.$this->lname;
         
            return true;
        } else {
            return false;
        }
    }


    public function getThumbnails($ref,$event_name){
        $uploadFiles   = Uploads::find()->where(['ref'=>$ref])->all();
        $preview = [];
       foreach ($uploadFiles as $file) {
           $preview[] = [
               'url'=>SystemHelper::getUploadUrl(true).$ref.'/'.$file->real_filename,
               'src'=>SystemHelper::getUploadUrl(true).$ref.'/thumbnail/'.$file->real_filename,
               'options' => ['title' => $event_name]
           ];
       }
       return $preview;
   }


    public function getEventType() {
        return $this->hasOne(Category::className(), ['id' => 'event_type']);
    }

    public function getPersonType() {
        return $this->hasOne(Category::className(), ['id' => 'person_type']);
    }
    

    public function getUploads() {
        return $this->hasMany(Uploads::className(), ['ref' => 'ref']);
    }

}
