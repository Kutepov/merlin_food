<?php

namespace app\modules\api\v1\controllers;

use app\models\search\RecommendationSearch;
use yii\data\ActiveDataProvider;

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

    /**
     * Rest Title: TEST.1
     * Rest Description: Get all Recommendation <br>
     * Filter "sort" can take values - "-level" or "level" <br>
     * Admin can view all recommendations, User can view only available recommendations.
     * Rest Fields: ['id', 'level', 'text', 'quality_id', 'personality_type'].
     * Rest Filters: ['quality_id', 'personality_type', 'sort'].
     */
    public function actionIndex() {}

    /**
     * Rest Description: Create Recommendation.
     * Rest Fields: ['level', 'text', 'quality_id', 'personality_type'].
     */
    public function actionCreate() {}

    /**
     * Rest Description: Update Recommendation.
     * Rest Fields: ['level', 'text', 'quality_id', 'personality_type'].
     */
    public function actionUpdate() {}

    /**
     * Rest Description: View Recommendation.
     */
    public function actionView() {}

    /**
     * Rest Description: Delete Recommendation.
     */
    public function actionDelete() {}

}
