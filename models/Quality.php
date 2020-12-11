<?php

namespace app\models;

/**
 * This is the model class for table "quality".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $characteristic_id
 *
 * @property Characteristic $characteristic
 * @property Recommendation[] $recommendations
 */
class Quality extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['characteristic_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['characteristic_id'], 'exist', 'skipOnError' => true, 'targetClass' => Characteristic::class, 'targetAttribute' => ['characteristic_id' => 'id']],
            [['name', 'characteristic_id'], 'required'],
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
     * Gets query for [[Recommendations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRecommendations()
    {
        return $this->hasMany(Recommendation::class, ['quality_id' => 'id']);
    }
}
