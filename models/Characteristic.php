<?php

namespace app\models;

/**
 * This is the model class for table "characteristic".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $max_points
 *
 * @property CharacteristicProgress[] $characteristicProgresses
 * @property Quality[] $qualities
 */
class Characteristic extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['max_points'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * Gets query for [[CharacteristicProgresses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCharacteristicProgresses()
    {
        return $this->hasMany(CharacteristicProgress::class, ['characteristic_id' => 'id']);
    }

    /**
     * Gets query for [[Qualities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQualities()
    {
        return $this->hasMany(Quality::class, ['characteristic_id' => 'id']);
    }
}
