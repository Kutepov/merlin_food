<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%recommendation}}`.
 */
class m201209_063125_create_recommendation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%recommendation}}', [
            'id' => $this->primaryKey(),
            'sort' => $this->integer(2),
            'text' => $this->text(),
            'quality_id' => $this->integer(),
            'personality_type' => $this->string(3)
        ]);

        $this->addForeignKey('FK_recommendation_quality', '{{%recommendation}}', 'quality_id', '{{%quality}}', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_recommendation_quality', '{{%recommendation}}');
        $this->dropTable('{{%recommendation}}');
    }
}
