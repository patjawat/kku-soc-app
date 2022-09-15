<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%special_category}}`.
 */
class m220915_115534_create_special_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%special_category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('ชื่อ')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%special_category}}');
    }
}
