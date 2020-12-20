<?php

namespace app\models;

use app\models\forms\OpenNewRecommendation;
use yii\base\Exception;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "available_recommendation".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $recommendation_id
 * @property string $transaction_id
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
            [['user_id', 'recommendation_id', 'transaction_id'], 'required'],
            [['transaction_id'], 'unique'],
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
     * @param OpenNewRecommendation $form
     * @return array|self
     * @throws Exception
     */
    public static function getNew(OpenNewRecommendation $form)
    {
        $maxAvailableRecommendation = self::getRecommendationActiveQuery($form->payload['quality_id'], $form->payload['person_type'])
            ->rightJoin(self::tableName(), self::tableName().'.recommendation_id = '.Recommendation::tableName().'.id and user_id = '.$form->person_id)
            ->max('level');

        $nextRecommendation = self::getRecommendationActiveQuery($form->payload['quality_id'], $form->payload['person_type'])
            ->orderBy(['level' => SORT_ASC])
            ->limit(1);
        if (!is_null($maxAvailableRecommendation)) {
            $nextRecommendation->andWhere(['>', 'level', $maxAvailableRecommendation]);
        }

        $modelRecommendation = $nextRecommendation->one();
        if (!is_null($modelRecommendation)) {

            $availableRecommendation = new self();
            $availableRecommendation->user_id = $form->person_id;
            $availableRecommendation->recommendation_id = $modelRecommendation->id;
            $availableRecommendation->transaction_id = $form->trans_id;
            if (!$availableRecommendation->validate()) {
                return $availableRecommendation;
            }

            $availableRecommendation->save();
            return $modelRecommendation;
        }
        elseif (is_null($maxAvailableRecommendation)) {
            throw new Exception('No recommendation found for opening');
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
