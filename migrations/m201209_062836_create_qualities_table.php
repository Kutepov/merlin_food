<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%qualities}}`.
 */
class m201209_062836_create_qualities_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%quality}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'characteristic_id' => $this->integer()
        ]);

        $this->addForeignKey('FK_quality_characteristic_id', '{{%quality}}', 'characteristic_id', '{{%characteristic}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_quality_characteristic_id', '{{%quality}}');
        $this->dropTable('{{%quality}}');
    }
}
