<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m220418_131905_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'category_type' => $this->string()->notNull()->comment('ประเภทข้อมูล'),
            'name' => $this->string()->notNull()->comment('ชื่อ'),
            'title' => $this->string()
        ]);
        $this->insert('category',['category_type' => 1,'name' => 'นักศึกษา','title' => 'นักศึกษา']);
        $this->insert('category',['category_type' => 1,'name' => 'บุคลากร','title' =>'บุคลากร']);
        $this->insert('category',['category_type' => 1,'name' => 'ภายนอก','title' => 'ภายนอก']);
        $this->insert('category',['category_type' => 1,'name' => 'เจ้าหน้าที่ทหาร/ตำรวจ/หน่วยงานความมั่นคง','title' =>'จ้าหน้าที่ทหาร/ตำรวจ/หน่วยงานความมั่นคง']);
        $this->insert('category',['category_type' => 2,'name' => 'ติดตามตรวจสอบ ยานพาหนะ','title' =>'ติดตามตรวจสอบ ยานพาหนะ']);
        $this->insert('category',['category_type' => 2,'name' => 'ติดตามตรวจสอบ เหตุการณ์','title' =>'ติดตามตรวจสอบ เหตุการณ์']);
        $this->insert('category',['category_type' => 2,'name' => 'โจรกรรมทรัพย์สิน','title' =>'โจรกรรมทรัพย์สิน']);
        $this->insert('category',['category_type' => 2,'name' => 'โจรกรรมรถจักรยานยนต์','title' =>'โจรกรรมรถจักรยานยนต์']);
        $this->insert('category',['category_type' => 2,'name' => 'เหตุทำลายทรัพย์สิน','title' =>'เหตุทำลายทรัพย์สิน']);
        $this->insert('category',['category_type' => 2,'name' => 'อุบัติเหตุ','title' =>'อุบัติเหตุ']);
        $this->insert('category',['category_type' => 2,'name' => 'งานวิจัยจราจร','title' =>'งานวิจัยจราจร']);
        $this->insert('category',['category_type' => 2,'name' => 'ทรัพย์สินตกหล่น','title' =>'ทรัพย์สินตกหล่น']);
        $this->insert('category',['category_type' => 2,'name' => 'โจรกรรมรถยนต์','title' =>'โจรกรรมรถยนต์']);
        $this->insert('category',['category_type' => 2,'name' => 'อื่นๆ','title' =>'อื่นๆ']);
        $this->insert('category',['category_type' => 3,'name' => 'บัตรประชาชน','title' =>'บัตรประชาชน']);
        $this->insert('category',['category_type' => 3,'name' => 'ภาพทั่วไป','title' =>'ภาพทั่วไป']);
        $this->insert('category',['category_type' => 3,'name' => 'ภาพทั่วไป','title' =>'ภาพทั่วไป']);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
