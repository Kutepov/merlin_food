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
 */
class CharacteristicProgress extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'characteristic_id', 'points'], 'integer'],
            [['characteristic_id'], 'exist', 'skipOnError' => true, 'targetClass' => Characteristic::class, 'targetAttribute' => ['characteristic_id' => 'id']],
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

}
