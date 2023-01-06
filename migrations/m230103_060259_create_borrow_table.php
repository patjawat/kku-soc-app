<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%borrow}}`.
 */
class m230103_060259_create_borrow_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%borrow}}', [
            'id' => $this->primaryKey(),
            'item_code' => $this->string(100)->comment('รหัสเลขเครื่อง'),
            'product_id' => $this->string(100)->comment('หมายเลขเครื่อง'),
            'data_json' => $this->json(),
            'active' => $this->boolean()->comment('สถานะ'),
            'pull_date' => $this->date()->comment('วันที่รับคืน'),
            'pull_user_id' => $this->date()->comment('ผู้รับคืน'),
            'approve_date' => $this->date()->comment('จ่ายเมื่อ'),
            'approve_id' => $this->integer()->comment('ผู้จ่าย'),
            'status_id' => $this->integer()->comment('สถานะ'),
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
        $this->dropTable('{{%borrow}}');
    }
}
