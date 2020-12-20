<?php

use yii\db\Migration;

/**
 * Class m201220_100607_extend_available_recommendation_table
 */
class m201220_100607_extend_available_recommendation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%available_recommendation}}', 'transaction_id', $this->string(255)->unique());
        $this->createIndex('INDX_available_recommendation_transaction_id', '{{%available_recommendation}}', 'transaction_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('INDX_available_recommendation_transaction_id', '{{%available_recommendation}}');
        $this->dropColumn('{{%available_recommendation}}', 'transaction_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201220_100607_extend_available_recommendation_table cannot be reverted.\n";

        return false;
    }
    */
}
