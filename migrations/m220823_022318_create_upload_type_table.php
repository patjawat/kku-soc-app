<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%upload_type}}`.
 */
class m220823_022318_create_upload_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%upload_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->comment('ประเภทการ upload'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%upload_type}}');
    }
}
