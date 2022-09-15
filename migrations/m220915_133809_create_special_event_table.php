<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%special_event}}`.
 */
class m220915_133809_create_special_event_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%special_event}}', [
            'id' => $this->primaryKey(),
            'ref' => $this->string(),
            'data_json' => $this->json(),
            'special_date' => $this->date()->comment('วันที่'),
            'location' => $this->string()->comment('สถานที่'),
            'title' => $this->string()->comment('หัวเรื่อง'),
            'special_event_id' => $this->integer()->comment('เหตุการณ์')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%special_event}}');
    }
}
