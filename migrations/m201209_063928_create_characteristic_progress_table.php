<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%characteristic_progress}}`.
 */
class m201209_063928_create_characteristic_progress_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%characteristic_progress}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'characteristic_id' => $this->integer(),
            'points' => $this->integer(2)
        ]);

        $this->addForeignKey('FK_characteristic_progress_characteristic', '{{%characteristic_progress}}', 'characteristic_id', '{{%characteristic}}', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_characteristic_progress_characteristic', '{{%characteristic_progress}}');
        $this->dropTable('{{%characteristic_progress}}');
    }
}
