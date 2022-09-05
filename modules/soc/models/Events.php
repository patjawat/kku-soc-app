<?php

namespace app\modules\soc\models;
use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\db\Expression;
use \yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use app\components\SystemHelper;
use app\components\UserHelper;
use app\models\Uploads;
use app\models\Category;
use app\modules\usermanager\models\User;


class Events extends \yii\db\ActiveRecord
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
            [['fname', 'lname', 'person_type', 'address', 'phone', 'event_date', 'event_location_note', 'accept_pdpa'], 'required'],
            [['person_type', 'event_type', 'result', 'backup_to', 'backup_type', 'reporter', 'created_by', 'updated_by'], 'integer'],
            [['event_date', 'updated_at', 'created_at'], 'safe'],
            [['ref', 'fname', 'lname', 'fullname', 'department', 'address', 'phone', 'orther', 'event_location_note', 'lat', 'lng', 'work_img', 'docs', 'note'], 'string', 'max' => 255],
            [['accept_pdpa'], 'string', 'max' => 1],
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
            'lng' => 'longitude',
            'work_img' => 'รูปภาพการปฏิบัติการ',
            'docs' => 'เอกสารแนบใบคำขอ',
            'result' => 'ผลการให้บริการดูกล้องวงจรปิด',
            'note' => 'รายงานการดำเนินการ',
            'backup_to' => 'การขอสำรองข้อมูลให้',
            'backup_type' => 'ประเภทไฟล์ข้อมูล',
            'reporter' => 'ผู้รายงานเหตุ',
            'worker' => 'ผู้ร่วมปฏิบัติงาน',
            'accept_pdpa' => 'การกำหนดว่า “หากข้าพเจ้าไม่ตกลงยอมรับข้อกำหนดและเงื่อนไขนี้ ผู้ให้บริการสงวนสิทธิไม่ให้บริการแก่ข้าพเจ้าได้”  มีผลเท่ากับเป็นการบังคับว่าเจ้าของข้อมูลส่วนบุคคลจะต้องให้ความยินยอม มิฉะนั้นจะไม่สามารถใช้บริการได้',
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
         $this->worker = Json::decode($this->worker, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
         return parent::afterFind();
     }
 
     public function beforeSave($insert) {
         if (parent::beforeSave($insert)) {
             $this->data_json = Json::encode($this->data_json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
             $this->worker = Json::encode($this->worker, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
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
 

    public function getIdCart()
    {
        $model = Uploads::find()->where(['ref' =>$this->ref,'type' =>15])->One();
        if ($model) {
            $file_path = SystemHelper::getUploadPath() . $model->ref . '/' . $model->real_filename;
            $file_ = pathinfo($file_path);
            if (file_exists($file_path)) {
                $file_path = "/soc/events/image?file_path=$file_path&width=490&height=200";
              
                if (strtolower($file_['extension']) == ('png' || 'jpg')) {
                    return Html::img($file_path, ['class' => 'file-preview-image', 'loading' => 'lazy']);
                }
                
  
            }
        }else{
            return Html::img('@web/img/dc_1.png', ['width' => '350px','style' => 'margin-top: -64px;']);
        }
    }
 
    public function getUser(){
        $model = User::findOne(['id' => $this->reporter]);
        return $model->fullname;
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
