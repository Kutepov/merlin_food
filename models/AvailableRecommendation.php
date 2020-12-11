<?php

namespace app\models;

/**
 * This is the model class for table "available_recommendation".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $recommendation_id
 *
 * @property User $user
 * @property Recommendation $recommendation
 */
class AvailableRecommendation extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'recommendation_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['recommendation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Recommendation::class, 'targetAttribute' => ['recommendation_id' => 'id']],
        ];
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

    /**
     * Gets query for [[Recommendation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRecommendation()
    {
        return $this->hasOne(Recommendation::class, ['id' => 'recommendation_id']);
    }
}
