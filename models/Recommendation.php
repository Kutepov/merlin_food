<?php

namespace app\models;

/**
 * This is the model class for table "recommendation".
 *
 * @property int $id
 * @property int|null $level - порядок
 * @property string|null $text
 * @property int|null $quality_id
 * @property string $personality_type - типаж личности
 *
 * @property Quality $quality
 */
class Recommendation extends BaseModel
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
            [['level', 'quality_id'], 'integer'],
            [['text'], 'string'],
            [['quality_id'], 'exist', 'skipOnError' => true, 'targetClass' => Quality::class, 'targetAttribute' => ['quality_id' => 'id']],
            [['level', 'text', 'quality_id', 'personality_type'], 'required'],
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
