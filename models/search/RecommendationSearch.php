<?php

namespace app\models\search;

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
        ]);

        $this->load($params, '');

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'personality_type' => $this->personality_type,
            'quality_id' => $this->quality_id,
        ]);

        return $dataProvider;
    }

}