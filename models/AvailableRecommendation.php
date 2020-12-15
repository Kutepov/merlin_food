<?php

namespace app\models;

use yii\base\Exception;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "available_recommendation".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $recommendation_id
 *
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
            [['recommendation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Recommendation::class, 'targetAttribute' => ['recommendation_id' => 'id']],
            [['user_id', 'recommendation_id'], 'required']
        ];
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

    /**
     * Выдать пользователю новую рекомендацию
     *
     * @param $quality_id
     * @param $personality_type
     * @param $user_id
     * @return array|\yii\db\ActiveRecord
     * @throws Exception
     */
    public static function getNew($quality_id, $personality_type, $user_id)
    {
        $maxAvailableRecommendation = self::getRecommendationActiveQuery($quality_id, $personality_type)
            ->rightJoin(self::tableName(), self::tableName().'.recommendation_id = '.Recommendation::tableName().'.id and user_id = '.$user_id)
            ->max('level');

        $nextRecommendation = self::getRecommendationActiveQuery($quality_id, $personality_type)
            ->orderBy(['level' => SORT_ASC])
            ->limit(1);
        if (!is_null($maxAvailableRecommendation)) {
            $nextRecommendation->andWhere(['>', 'level', $maxAvailableRecommendation]);
        }

        $modelRecommendation =  $nextRecommendation->one();
        if (!is_null($modelRecommendation)) {

            $availableRecommendation = new self();
            $availableRecommendation->user_id = $user_id;
            $availableRecommendation->recommendation_id = $modelRecommendation->id;
            $availableRecommendation->save();

            return $modelRecommendation;
        }
        elseif (is_null($maxAvailableRecommendation)) {
            throw new Exception('Not found');
        }

        throw new Exception('All recommendations are open');
    }

    /**
     * @param $quality_id
     * @param $personality_type
     * @return \yii\db\ActiveQuery
     */
    private static function getRecommendationActiveQuery($quality_id, $personality_type): ActiveQuery
    {
        return Recommendation::find()
            ->where(['quality_id' => $quality_id, 'personality_type' => $personality_type]);
    }
}
