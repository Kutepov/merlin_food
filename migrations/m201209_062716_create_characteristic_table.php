<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%characteristic}}`.
 */
class m201209_062716_create_characteristic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%characteristic}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'max_points' => $this->integer(2)->defaultValue(10)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%characteristic}}');
    }
}
