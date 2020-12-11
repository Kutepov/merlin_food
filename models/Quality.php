<?php

namespace app\models;

use Yii;

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
class Quality extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quality';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['characteristic_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['characteristic_id'], 'exist', 'skipOnError' => true, 'targetClass' => Characteristic::class, 'targetAttribute' => ['characteristic_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'characteristic_id' => 'Characteristic ID',
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
