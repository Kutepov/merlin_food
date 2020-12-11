<?php

namespace app\modules\api\v1\controllers;

use app\models\Recommendation;
use app\models\search\RecommendationSearch;
use yii\data\ActiveDataProvider;
use function GuzzleHttp\Psr7\parse_request;

/**
 * Recommendation controller for the `v1` module
 */
class RecommendationController extends MainController
{
    public $modelClass = 'app\models\Recommendation';

    /**
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    /**
     * @return ActiveDataProvider
     */
    public function prepareDataProvider()
    {
        $searchModel = new RecommendationSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        return $dataProvider;
    }
}
