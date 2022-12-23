<?php

use yii\db\Migration;

/**
 * Class m220916_115555_create_special_event_items
 */
class m220916_115555_create_special_event_items extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%special_event_items}}', [
            'id' => $this->primaryKey(),
            'special_event_group_id' => $this->integer(),
            'name' => $this->string(),
        ]);
        $this->insert('special_event_items',['special_event_group_id' => 1,'name' => 'เหตุลักทรัพย์รถจักรยานยนต์']);
        $this->insert('special_event_items',['special_event_group_id' => 1,'name' => 'เหตุลักทรัพย์ตามบ้านพัก/แฟลตหอพัก/สำนักงาน']);
        $this->insert('special_event_items',['special_event_group_id' => 1,'name' => 'เหตุลักทรัพย์']);
        $this->insert('special_event_items',['special_event_group_id' => 1,'name' => 'เหตุลักทรัพย์รถจักรยานสองล้อ']);
        $this->insert('special_event_items',['special_event_group_id' => 1,'name' => 'เหตุอาชญากรรม']);
        $this->insert('special_event_items',['special_event_group_id' => 1,'name' => 'เหตุวิ่งราว/ชิงทรัพย์ ในพื้นที่มหาวิทยาลัยขอนแก่น']);
        $this->insert('special_event_items',['special_event_group_id' => 1,'name' => 'เหตุทะเลาวิวาท/ทำร้ายร่างกาย ในพื้นที่มหาวิทยาลัยขอนแก่น']);
        $this->insert('special_event_items',['special_event_group_id' => 2,'name' => 'ตรวจตราลาดตะเวนตามกลุ่มบ้านพัก/แฟลตที่พักอาศัยของบุคลากร/ตรวจโครงการฝากบ้าน']);
        $this->insert('special_event_items',['special_event_group_id' => 2,'name' => 'ตรวจตราลาดตะเวนตามลานจอดรถยนต์/รถจักรยานยนต์ตามลานจอดคณะหน่วยงานต่างๆ เพื่อป้องปรามเหตุ']);
        $this->insert('special_event_items',['special_event_group_id' => 2,'name' => 'ตรวจตราลาดตะเวนแจกแผ่นใบปลิวแจ้งเตือนรถจักรยานยนต์ที่เป็นกลุ่มเสี่ยงต่อการเกิดเหตุโจรกรรม และรถจักรยานยนต์จอดไม่ล็อคคอ']);
        $this->insert('special_event_items',['special_event_group_id' => 3,'name' => 'งานด้านการข่าว และความมั่นคง']);
        $this->insert('special_event_items',['special_event_group_id' => 4,'name' => 'ด้านการจับกุม']);
        $this->insert('special_event_items',['special_event_group_id' => 5,'name' => 'ผลการประสานงานนายตรวจเวรประจำวัน']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%special_event_items}}');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220916_115555_create_special_event_items cannot be reverted.\n";

        return false;
    }
    */
}
