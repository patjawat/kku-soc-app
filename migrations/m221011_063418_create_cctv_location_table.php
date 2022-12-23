<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cctv_location}}`.
 */
class m221011_063418_create_cctv_location_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cctv_location}}', [
            'id' => $this->primaryKey(),
            'location_name'  => $this->string()->comment('สถานที่'),
            'data_json' => $this->json(),
            'active' => $this->boolean()->comment('สถานะ'),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cctv_location}}');
    }
}
