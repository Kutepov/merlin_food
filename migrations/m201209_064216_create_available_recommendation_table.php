<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%available_recommendation}}`.
 */
class m201209_064216_create_available_recommendation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%available_recommendation}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'recommendation_id' => $this->integer()
        ]);

        $this->addForeignKey('FK_available_recommendation_user', '{{%available_recommendation}}', 'user_id', '{{%user}}', 'id');
        $this->addForeignKey('FK_available_recommendation_recommendation', '{{%available_recommendation}}', 'user_id', '{{%user}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_available_recommendation_user', '{{%available_recommendation}}');
        $this->dropForeignKey('FK_available_recommendation_recommendation', '{{%available_recommendation}}');
        $this->dropTable('{{%available_recommendation}}');
    }
}
