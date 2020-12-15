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
 * @property bool $balance_levels_before_save - пересчитать сортировку рекомендаций после сохранения
 *
 * @property Quality $quality
 */
class Recommendation extends BaseModel
{
    public $balance_levels_before_save = true;
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

    public function afterSave($insert, $changedAttributes)
    {
        if (self::find()
            ->where([
                'quality_id' => $this->quality_id,
                'personality_type' => $this->personality_type,
                'level' => $this->level
            ])
            ->andWhere(['<>', 'id', $this->id])
            ->count()) {

            $nextRecommendations = self::find()
                ->where(['quality_id' => $this->quality_id,'personality_type' => $this->personality_type])
                ->andWhere(['>=', 'level', $this->level])
                ->andWhere(['<>', 'id' , $this->id])
                ->orderBy(['level' => SORT_ASC])->all();

            $prevLevel = $this->level;
            /** @var self $recommendation */
            foreach ($nextRecommendations as $recommendation) {
                if ($prevLevel == $recommendation->level) {
                    $prevLevel++;
                    $recommendation->level = $prevLevel;
                    $recommendation->balance_levels_before_save = false;
                    $recommendation->save(false);
                }
            }

        }
        parent::afterSave($insert, $changedAttributes);
    }
}
