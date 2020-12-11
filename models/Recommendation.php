<?php

namespace app\models;

/**
 * This is the model class for table "recommendation".
 *
 * @property int $id
 * @property int|null $sort
 * @property string|null $text
 * @property int|null $quality_id
 * @property string $personality_type - типаж личности
 *
 * @property Quality $quality
 */
class Recommendation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'recommendation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sort', 'quality_id'], 'integer'],
            [['text'], 'string'],
            [['quality_id'], 'exist', 'skipOnError' => true, 'targetClass' => Quality::class, 'targetAttribute' => ['quality_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sort' => 'Sort',
            'text' => 'Text',
            'quality_id' => 'Quality ID',
        ];
    }

    /**
     * Gets query for [[Quality]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuality()
    {
        return $this->hasOne(Quality::class, ['id' => 'quality_id']);
    }
}
