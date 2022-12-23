<?php

use yii\db\Migration;

/**
 * Class m220916_115548_create_special_event_group
 */
class m220916_115548_create_special_event_group extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%special_event_group}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);
        $this->insert('special_event_group',['name' => 'งานด้านโจรกรรม/อาชญากรรม']);
        $this->insert('special_event_group',['name' => 'งานด้านการป้องปาม']);
        $this->insert('special_event_group',['name' => 'งานด้านการข่าว และความมั่นคง']);
        $this->insert('special_event_group',['name' => 'ด้านการจับกุม']);
        $this->insert('special_event_group',['name' => 'ผลการประสานงานนายตรวจเวรประจำวัน']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%special_event_group}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220916_115548_create_special_event_group cannot be reverted.\n";

        return false;
    }
    */
}
