<?php

namespace app\modules\soc\models;

use Yii;
use yii\helpers\Json;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use app\components\SystemHelper;
use app\models\Uploads;


/**
 * This is the model class for table "events".
 *
 * @property int $id
 * @property string|null $ref
 * @property string|null $data_json
 * @property string $fname ชื่อ
 * @property string $lname สกุล
 * @property string|null $fullname ชื่อ-สกุล
 * @property int $person_type ประเภทบุคคล
 * @property string|null $department คณะ/หน่วยงาน/สถานที่ทำงาน/สถานศึกษา
 * @property string $address ที่อยู่ตามทะเบียนบ้าน
 * @property string $phone หมายเลขโทรศัพท์
 * @property string $event_date วันและเวลาที่เกิดเหตุ
 * @property int|null $event_type เหตุการณ์
 * @property string|null $orther รายละเอียดเพิ่มเติม
 * @property string $event_location_note บริเวณสถานที่เกิดเหตุ
 * @property string|null $las latitude
 * @property string|null $lng lngitude
 * @property string|null $work_img รูปภาพการปฏิบัติการ
 * @property string|null $docs เอกสารแนบใบคำขอ
 * @property int|null $result ผลการให้บริการดูกล้องวงจรปิด
 * @property string|null $note รายงานการดำเนินการ
 * @property int|null $backup_to การขอสำรองข้อมูลให้
 * @property int|null $backup_type ประเภทไฟล์ข้อมูล
 * @property int|null $reporter ผู้รายงานเหตุ
 * @property string|null $worker ผู้ร่วมปฏิบัติงาน
 * @property string|null $updated_at
 * @property string $created_at
 * @property int|null $created_by ผู้สร้าง
 * @property int|null $updated_by ผู้แก้ไข
 */
class Events extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
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
            [['event_date', 'updated_at', 'created_at'], 'safe'],
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
