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
            'address' => $this->string()->notNull()->comment('ที่อยู่ตามทะเบียนบ้าน'),
            'phone' => $this->string()->notNull()->comment('หมายเลขโทรศัพท์'),
            'event_date' => $this->datetime()->notNull()->comment('วันและเวลาที่เกิดเหตุ'),
            'event_type' => $this->integer()->comment('เหตุการณ์'),
            'orther' => $this->string()->comment('รายละเอียดเพิ่มเติม'),
            'event_location_note' => $this->string()->notNull()->comment('บริเวณสถานที่เกิดเหตุ'),
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
