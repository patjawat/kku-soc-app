<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%borrow_status}}`.
 */
class m230106_090359_create_borrow_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%borrow_status}}', [
            'id' => $this->primaryKey(),
            'name' =>$this->string(100)
        ]);
        $this->insert('borrow_status',['id' => 1,'name' => 'ขอเบิก']);
        $this->insert('borrow_status',['id' => 2,'name' => 'อนุมัติ']);
        $this->insert('borrow_status',['id' => 3,'name' => 'ส่งคืน']);
        $this->insert('borrow_status',['id' => 4,'name' => 'เสร็จสิ้น']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%borrow_status}}');
    }
}
