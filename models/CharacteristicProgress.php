<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "characteristic_progress".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $characteristic_id
 * @property int|null $points
 *
 * @property Characteristic $characteristic
 * @property User $user
 */
class CharacteristicProgress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'characteristic_progress';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'characteristic_id', 'points'], 'integer'],
            [['characteristic_id'], 'exist', 'skipOnError' => true, 'targetClass' => Characteristic::class, 'targetAttribute' => ['characteristic_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'characteristic_id' => 'Characteristic ID',
            'points' => 'Points',
        ];
    }

    /**
     * Gets query for [[Characteristic]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCharacteristic()
    {
        return $this->hasOne(Characteristic::class, ['id' => 'characteristic_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
