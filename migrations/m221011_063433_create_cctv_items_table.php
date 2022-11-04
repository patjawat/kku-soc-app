<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cctv_items}}`.
 */
class m221011_063433_create_cctv_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cctv_items}}', [
            'id' => $this->primaryKey(),
            'cctv_location_id' => $this->integer()->comment('สถานที่ตั้ง'),
            'title' => $this->string(),
            'name' => $this->string(),
            'address' => $this->string(),
            'description' => $this->string()->comment('รายละเอีดยเพิ่มเติม'),
            'active' => $this->boolean()->comment('สถานะ'),
            'data_json' => $this->json(),
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
        $this->dropTable('{{%cctv_items}}');
    }
}
