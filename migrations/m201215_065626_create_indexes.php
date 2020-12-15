<?php

use yii\db\Migration;

/**
 * Class m201215_065626_create_indexes
 */
class m201215_065626_create_indexes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex('INDX_personality_type', '{{%recommendation}}', 'personality_type');
        $this->createIndex('INDX_characteristic_progress_user_id', '{{%characteristic_progress}}', 'user_id');
        $this->createIndex('INDX_available_recommendation_user_id', '{{%available_recommendation}}', 'user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('INDX_personality_type', '{{%recommendation}}');
        $this->dropIndex('INDX_characteristic_progress_user_id', '{{%characteristic_progress}}');
        $this->dropIndex('INDX_available_recommendation_user_id', '{{%available_recommendation}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201215_065626_create_indexes cannot be reverted.\n";

        return false;
    }
    */
}
