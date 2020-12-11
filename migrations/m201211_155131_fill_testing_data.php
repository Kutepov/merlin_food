<?php

use yii\db\Migration;
use \Faker\Provider\Lorem;

/**
 * Class m201211_155131_fill_testing_data
 */
class m201211_155131_fill_testing_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS = 0;');
        $this->truncateTable('{{%characteristic}}');
        $this->batchInsert(
            '{{%characteristic}}',
            ['id', 'name', 'max_points'],
            [[1, 'Интеллект', 10], [2, 'Эмоции', 10], [3, 'Духовность', 10], [4, 'Тело', 10]]
        );

        $this->truncateTable('{{%quality}}');
        $this->batchInsert(
            '{{%quality}}',
            ['id', 'name', 'characteristic_id'],
            [
                [1, 'Сообразительность', 1],
                [2, 'Память', 1],
                [3, 'Агрессия', 2],
                [4, 'Амплитуда', 2],
                [5, 'Спокойствие', 3],
                [6, 'Воздушность', 3],
                [7, 'Мускулистость', 4],
                [8, 'Баланс', 4],
            ]
        );

        $this->truncateTable('{{%recommendation}}');
        $this->batchInsert(
          '{{%recommendation}}',
          ['sort', 'text', 'quality_id', 'personality_type'],
          [
              [1, Lorem::sentence(6), 1, 'ex1'],
              [2, Lorem::sentence(6), 1, 'ex1'],
              [1, Lorem::sentence(6), 1, 'ex2'],
              [2, Lorem::sentence(6), 1, 'ex2'],

              [1, Lorem::sentence(6), 2, 'ex1'],
              [2, Lorem::sentence(6), 2, 'ex1'],
              [1, Lorem::sentence(6), 2, 'ex2'],
              [2, Lorem::sentence(6), 2, 'ex2'],

              [1, Lorem::sentence(6), 3, 'ex1'],
              [2, Lorem::sentence(6), 3, 'ex1'],
              [1, Lorem::sentence(6), 3, 'ex2'],
              [2, Lorem::sentence(6), 3, 'ex2'],

              [1, Lorem::sentence(6), 4, 'ex1'],
              [2, Lorem::sentence(6), 4, 'ex1'],
              [1, Lorem::sentence(6), 4, 'ex2'],
              [2, Lorem::sentence(6), 4, 'ex2'],

              [1, Lorem::sentence(6), 5, 'ex1'],
              [2, Lorem::sentence(6), 5, 'ex1'],
              [1, Lorem::sentence(6), 5, 'ex2'],
              [2, Lorem::sentence(6), 5, 'ex2'],

              [1, Lorem::sentence(6), 6, 'ex1'],
              [2, Lorem::sentence(6), 6, 'ex1'],
              [1, Lorem::sentence(6), 6, 'ex2'],
              [2, Lorem::sentence(6), 6, 'ex2'],

              [1, Lorem::sentence(6), 7, 'ex1'],
              [2, Lorem::sentence(6), 7, 'ex1'],
              [1, Lorem::sentence(6), 7, 'ex2'],
              [2, Lorem::sentence(6), 7, 'ex2'],

              [1, Lorem::sentence(6), 8, 'ex1'],
              [2, Lorem::sentence(6), 8, 'ex1'],
              [1, Lorem::sentence(6), 8, 'ex2'],
              [2, Lorem::sentence(6), 8, 'ex2'],
          ]
        );
        $this->execute('SET FOREIGN_KEY_CHECKS = 1;');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS = 0;');
        $this->truncateTable('{{%recommendation}}');
        $this->truncateTable('{{%quality}}');
        $this->truncateTable('{{%characteristic}}');
        $this->execute('SET FOREIGN_KEY_CHECKS = 1;');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201211_155131_fill_testing_data cannot be reverted.\n";

        return false;
    }
    */
}
