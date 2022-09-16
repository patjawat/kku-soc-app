<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%events}}`.
 */
class m220629_063218_create_events_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%events}}', [
            'id' => $this->primaryKey(),
            'ref' => $this->string(),
            'data_json' => $this->json(),
            'fname' => $this->string()->notNull()->comment('ชื่อ'),
            'lname' => $this->string()->notNull()->comment('สกุล'),
            'fullname' => $this->string()->comment('ชื่อ-สกุล'),
            'person_type' => $this->integer()->notNull()->comment('ประเภทบุคคล'),
            'department' => $this->string()->comment('คณะ/หน่วยงาน/สถานที่ทำงาน/สถานศึกษา'),
            'address' => $this->string()->comment('ที่อยู่ตามทะเบียนบ้าน'),
            'phone' => $this->string()->notNull()->comment('หมายเลขโทรศัพท์'),
            'event_date' => $this->datetime()->notNull()->comment('วันและเวลาที่เกิดเหตุ'),
            'event_type' => $this->integer()->comment('เหตุการณ์'),
            'event_group' => $this->integer()->comment('กลุ่มของหน่วยงาน'),
            'orther' => $this->string()->comment('รายละเอียดเพิ่มเติม'),
            'event_location_note' => $this->string()->comment('บริเวณสถานที่เกิดเหตุ'),
            'lat' => $this->string()->comment('latitude'),
            'lng' => $this->string()->comment('longitude'),
            'work_img' => $this->string()->comment('รูปภาพการปฏิบัติการ'),
            'docs' => $this->string()->comment('เอกสารแนบใบคำขอ'),
            'result' => $this->integer()->comment('ผลการให้บริการดูกล้องวงจรปิด'),
            'note' => $this->string()->comment('รายงานการดำเนินการ'),
            'backup_to' => $this->integer()->comment('การขอสำรองข้อมูลให้'),
            'backup_type' => $this->integer()->comment('ประเภทไฟล์ข้อมูล'),
            'reporter' => $this->integer()->comment('ผู้รายงานเหตุ'),
            'worker' => $this->json()->comment('ผู้ร่วมปฏิบัติงาน'),
            'accept_pdpa' => $this->string(1)->notNull()->comment('การกำหนดว่า “หากข้าพเจ้าไม่ตกลงยอมรับข้อกำหนดและเงื่อนไขนี้ ผู้ให้บริการสงวนสิทธิไม่ให้บริการแก่ข้าพเจ้าได้”  มีผลเท่ากับเป็นการบังคับว่าเจ้าของข้อมูลส่วนบุคคลจะต้องให้ความยินยอม มิฉะนั้นจะไม่สามารถใช้บริการได้'),
            'signature' => $this->string()->comment('ลายเซ็นต์'),
            'updated_at' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
            'created_at' => $this->timestamp(),   
            'created_by' => $this->integer()->comment('ผู้สร้าง'),
            'updated_by' => $this->integer()->comment('ผู้แก้ไข')

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%events}}');
    }
}
