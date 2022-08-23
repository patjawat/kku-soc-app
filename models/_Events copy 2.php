<?php

namespace app\models;

use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "events".
 *
 * @property int $id
 * @property string|null $ref
 * @property string|null $data_json
 * @property string $fname ชื่อ
 * @property string $lname สกุล
 * @property string $fullname ชื่อ-สกุล
 * @property int $person_type ประเภทบุคคล
 * @property string|null $department คณะ/หน่วยงาน/สถานที่ทำงาน/สถานศึกษา
 * @property string $address ที่อยู่ตามทะเบียนบ้าน
 * @property string $phone หมายเลขโทรศัพท์
 * @property string $event_date วันและเวลาที่เกิดเหตุ
 * @property int|null $event_type เหตุการณ์
 * @property int|null $orther รายละเอียดเพิ่มเติม
 * @property string $event_location_note บริเวณสถานที่เกิดเหตุ
 * @property string $las latitude
 * @property string $long longitude
 * @property string $work_img รูปภาพการปฏิบัติการ
 * @property string $docs เอกสารแนบใบคำขอ
 * @property int $result ผลการให้บริการดูกล้องวงจรปิด
 * @property int $note รายงานการดำเนินการ
 * @property int $backup_to การขอสำรองข้อมูลให้
 * @property int $backup_type ประเภทไฟล์ข้อมูล
 * @property int $reporter ผู้รายงานเหตุ
 * @property string $worker ผู้ร่วมปฏิบัติงาน
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
            [['fname', 'lname', 'fullname', 'person_type', 'address', 'phone', 'event_date', 'event_location_note','work_img', 'docs', 'result', 'note', 'backup_to', 'backup_type', 'reporter', 'worker'], 'required'],
            [['person_type', 'event_type', 'orther', 'result', 'note', 'backup_to', 'backup_type', 'reporter', 'created_by', 'updated_by'], 'integer'],
            [['event_date', 'updated_at', 'created_at'], 'safe'],
            [['ref', 'fname', 'lname', 'fullname', 'department', 'address', 'phone', 'event_location_note', 'las', 'long', 'work_img', 'docs'], 'string', 'max' => 255],
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
            'las' => 'latitude',
            'long' => 'longitude',
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

    public function initialPreview($data,$field,$type='file'){
        $initial = [];
        $files = Json::decode($data);
        if(is_array($files)){
             foreach ($files as $key => $value) {
                if($type=='file'){
                    $initial[] = "<div class='file-preview-other'><h2><i class='glyphicon glyphicon-file'></i></h2></div>";
                }elseif($type=='config'){
                    $initial[] = [
                        'caption'=> $value,
                        'width'  => '120px',
                        'url'    => Url::to(['/freelance/deletefile','id'=>$this->id,'fileName'=>$key,'field'=>$field]),
                        'key'    => $key
                    ];
                }
                else{
                    $initial[] = Html::img(self::getUploadUrl().$this->ref.'/'.$value,['class'=>'file-preview-image', 'alt'=>$model->file_name, 'title'=>$model->file_name]);
                }
             }
     }
    return $initial;
}
}
