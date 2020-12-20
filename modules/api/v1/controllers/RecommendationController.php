<?php

namespace app\modules\api\v1\controllers;

use app\models\AvailableRecommendation;
use app\models\forms\OpenNewRecommendation;
use app\models\search\RecommendationSearch;
use app\models\User;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\web\HttpException;

/**
 * Recommendation controller for the `v1` module
 */
class RecommendationController extends MainController
{
    public $modelClass = 'app\models\Recommendation';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access']['only'][] = 'get-new-recommendation';
        $behaviors['access']['rules'][] = [
                'actions' => ['get-new-recommendation'],
                'allow' => true,
                'roles' => [User::ROLE_USER, User::ROLE_ADMIN],
        ];
        return $behaviors;
    }

    /**
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
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
     * Rest Description: Get all Recommendation <br>
     * Filter "sort" can take values - "-level" or "level" <br>
     * Admin can view all recommendations, User can view only available recommendations.
     * Rest Fields: ['id', 'level', 'text', 'quality_id', 'personality_type'].
     * Rest Filters: ['quality_id', 'personality_type', 'sort'].
     */
    public function actionIndex()
    {
        $dataProvider = $this->prepareDataProvider();
        return $dataProvider;
    }

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


    /**
     * Rest Description: Open new recommendation.
     * Rest Fields: ['user_id', 'person_id', 'trans_id', 'payload' => ['quality_id', 'person_type']].
     */
    public function actionOpenNew()
    {
        if (!\Yii::$app->user->identity->isBought()) {
            throw new HttpException(402, 'Payment required');
        }

        try {

            $form = new OpenNewRecommendation();
            $form->load(\Yii::$app->request->post(), '');

            if (!$form->validate()) {
                return $form;
            }

            return AvailableRecommendation::getNew($form);
        }
        catch (Exception $e) {
            \Yii::$app->response->statusCode = 404;
            return ['message' => $e->getMessage()];
        }
    }

}
