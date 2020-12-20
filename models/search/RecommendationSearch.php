<?php

namespace app\models\search;

use app\models\AvailableRecommendation;
use Yii;
use app\models\Recommendation;
use yii\data\ActiveDataProvider;

/**
 * Class RecommendationSearch
 * @package app\models\search
 */
class RecommendationSearch extends Recommendation
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['personality_type'], 'string'],
            [['quality_id'], 'integer'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Recommendation::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'level'
                ]
            ],
            'pagination' => [
                'pageSize' => 100
            ]
        ]);

        $this->load($params, '');

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'personality_type' => $this->personality_type,
            'quality_id' => $this->quality_id,
        ]);


        $models = $dataProvider->models;
        $updatedModels = [];
        /** @var self $model */
        foreach ($models as $model) {
            if (!$model->isBoughtUser(Yii::$app->user->id)) {
                $model->text = null;
                $model->is_bought = false;
            }
            $updatedModels[] = $model;
        }
        $dataProvider->models = $updatedModels;

        return $dataProvider;
    }

}
